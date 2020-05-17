<?php

namespace App\Http\Controllers;

use App\CompanyShipping;
use App\Factura;
use App\LineaPedido;
use App\Mail\newOrder;
use App\Mail\OrderSent;
use App\NotificationOrder;
use App\Payer;
use App\Pedido;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Cliente;
use DB;
use Illuminate\Http\Response;
use Mail;
use Uuid;
use App\Mail\newOrderUser;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Helper;
use HelperConfig;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listadoPedidos()
    {
        $pedidos = Pedido::orderBy('created_at', 'DESC')->paginate(45);
        return view('administracion/pedidos/listadoPedidos', ['title' => 'Pedidos', 'pedidos' => $pedidos]);
    }

    public function pedidosPendientes()
    {
        $pedidos = Pedido::where(['isPaid' => 0, 'isSent' => 0])->whereNull('sent_at')->whereNull('paid_at')->orderBy('created_at', 'DESC')->paginate(13);
        return view('administracion/pedidos/pendientes', ['title' => 'Pedidos Pendientes', 'pedidos' => $pedidos]);
    }

    public function getRegistroClientePedido()
    {
        return view('pedidos/registroClientePedido', ['title' => 'Confirmaci&oacute;n del pedido']);
    }

    public function getrealizarPagoPedido()
    {
        return view('pedidos/realizarPagoClientePedido', ['title' => 'Realizar pago del pedido']);
    }

    public function getPedidoFinalizado(Request $request)
    {
        $request->get('tipoPago');

        $pedido = new Pedido();
        return view('pedidos/realizarPagoPedidoTransferenciaBancaria', ['title' => 'Pedido finalizado']);
    }

    public function getPedido($id)
    {
        if (!is_null($id)) {
            $pedido = Pedido::where('idPedido', $id)->get()->first();
            if (is_null($pedido)) {
                abort('404');
            } else {
                $cliente = Cliente::where('id', $pedido->idCliente)->get()->first();
                $lineas = LineaPedido::whereIn('id', unserialize($pedido->idLineas))->get();
                $companys = DB::table('company_shippings')->select('idCompany', 'name_company')->where('company_is_active', 1)->get();
                $companyPedido = DB::table('pedidos')->select('name_company')->leftJoin('company_shippings', 'company_shipping', '=', 'idCompany')->where(['company_is_active' => 1, 'idPedido' => $id])->first();
                if (empty($companyPedido)) {
                    $companyPedido = 'Sin definir';
                } else {
                    $companyPedido = $companyPedido->name_company;
                }
                $metodoPago = DB::table('pedidos')->select('nombre')->join('tipo_pagos', 'idTipoPago', '=', 'id')->where('idPedido', $id)->first();
                if (empty($metodoPago)) {
                    $metodoPago = 'Sin definir';
                } else {
                    $payer = Payer::where('idPedido', $id)->first();
                    $metodoPago = $metodoPago->nombre;

                }
                return view('administracion/pedidos/detailsPedido', ['title' => 'Pedido ' . $id,
                    'pedido' => $pedido,
                    'cliente' => $cliente,
                    'lineas' => $lineas,
                    'shipppings' => $companys,
                    'empresaTransporte' => $companyPedido,
                    'metodoPago' => $metodoPago,
                    'payer' => $payer]);
            }
        } else {
            abort('404');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //creamos el nuevo cliente
        $cliente = ClienteController::saveNewClient($request);
        //Obtenemos las lineas de producto seleccionadas
        $lineas = LineaPedido::where(['session_id' => $request->session()->getId()])->orderBy('updated_at', 'ASC')->get();
        $lines = array();
        foreach ($lineas as $linea) {
            array_push($lines, $linea->id);
        }

        /*$dataPedido = array('idCliente' => $cliente->id,
            'idLineas' => serialize($lines),
            'idTipoPago' => $request->get('methodPayUserSelected'),
            'totalPedido' => $request->get('totalPedido'),
            'numIdentificacionPedido' => Uuid::generate(),
            'totalIVA' => Cart::tax(),
            'withoutIVA' => Cart::subtotal());
        $pedido = new Pedido($dataPedido);
        $statusP = $pedido->save();*/
        //registramos el cliente
        $pedido = $this->saveNewPedido($cliente, $request, $lines);
        if ($cliente->status & $pedido->status) {
            //creamos la factura asociada al pedido en BBDD
            FacturaController::createNewFactura($pedido);
            //generamos el pdf de la factura -> quizas convenga hacerlo a traves de un cron como las notificaciones..
            Helper::saveBillPDF($pedido->idPedido);
            //Enviamos el pedido al metodo de pago seleccionado
            return $this->getGatewayOrder($request->get('methodPayUserSelected'), $pedido);
        } else {
            if ($pedido->status && !$cliente->status) {
                //dd('fallo cliente');
                return view('pedidos/orderSuccessRegistered', ['title' => 'falloPedido Registrado']);
            }
            if (!$pedido->status && $cliente->status) {
                //dd('fallo pedido');
                return view('pedidos/orderSuccessRegistered', ['title' => 'Fallo']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function setNumSeguimiento(Request $request)
    {
        $pedido = Pedido::find($request->get('idPedido'));
        $pedido->num_seguimiento = $request->get('numSeguimiento');
        $pedido->updated_at = Carbon::now('Europe/Madrid');
        $status = $pedido->save();
        return response()->json(['status' => $status]);
    }


    public function setPaid(Request $request)
    {
        $pedido = Pedido::find($request->get('idPedido'));
        $pedido->isPaid = 1;
        $now = Carbon::now('Europe/Madrid');
        $pedido->updated_at = $now;
        $pedido->paid_at = $now;
        $status = $pedido->save();
        return response()->json(['status' => $status, 'paid_at' => $now->toDateTimeString()]);
    }

    public function setIsSent(Request $request)
    {
        $pedido = Pedido::find($request->get('idPedido'));
        $pedido->isSent = 1;
        $now = Carbon::now('Europe/Madrid');
        $pedido->updated_at = $now;
        $pedido->sent_at = $now;
        $status = $pedido->save();
        //need cliente, peddio $linea, $factura
        $lineas = DB::table('linea_pedidos')
            ->select('*')
            ->whereIn('id', unserialize(DB::table('pedidos')->select('idLineas')->where('idPedido', $pedido->idPedido)->first()->idLineas))
            ->get();
        $idCompany = DB::table('company_shippings')->join('pedidos', 'idCompany', '=', 'company_shipping')->select('*')->where('idPedido', '=', $pedido->idPedido)->first()->idCompany;
        $shipping = CompanyShipping::find($idCompany);
        $idCliente = DB::table('clientes')->join('pedidos', 'id', '=', 'idCliente')->select('id')->where('idPedido', '=', $pedido->idPedido)->first()->id;
        $cliente = Cliente::find($idCliente);
        Mail::to($cliente->email)->send(new OrderSent($pedido, $cliente, $lineas, $shipping));
        return response()->json(['status' => $status, 'sent_at' => $now->toDateTimeString()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function setCompanyShipping(Request $request)
    {
        $pedido = Pedido::find($request->get('idPedido'));
        $pedido->company_shipping = $request->get('idCompany');
        $pedido->updated_at = carbon::now('Europe/Madrid');
        $status1 = $pedido->save();
        $company = CompanyShipping::find($request->get('idCompany'));
        $company->totalShipping = $company->totalShipping + 1;
        $company->updated_at = carbon::now('Europe/Madrid');
        $status2 = $company->save();
        $status = $status1 + $status2;
        return response()->json(['status' => $status]);
    }

    public static function getBill()
    {

        $cliente = \DB::table('clientes')->select('*')->where('id', 9)->first();
        $lineas = \DB::table('linea_pedidos')
            ->select('*')
            ->whereIn('id', unserialize('a:3:{i:0;i:5;i:1;i:6;i:2;i:7;}'))
            ->get();
        $pedido = \DB::table('linea_pedidos')
            ->whereIn('id', unserialize('a:3:{i:0;i:5;i:1;i:6;i:2;i:7;}'))
            ->sum('price');
        $data = array();
        $data['lineas'] = $lineas;
        $data['cliente'] = $cliente;
        $data['pedido'] = $pedido;
        $dompdf = new Dompdf();
        view()->share('lineas', $lineas);
        view()->share('cliente', $cliente);
        view()->share('pedido', $pedido);
        //ini_set('max_execution_time', 300);
        $dompdf = \PDF::loadView('facturas/factura');

        $dompdf->setPaper('A4', 'portrait');

        //$dompdf->render();
        //return $dompdf->output();

        return $dompdf->download('invoice.pdf');

        //return $dompdf->download('invoice.pdf');
    }

    public function getIsSent()
    {
        $pedidos = Pedido::where(['isSent' => 1])->orderBy('created_at', 'DESC')->paginate(13);
        return view('administracion/pedidos/listadoPedidosEnviados', ['title' => 'Pedidos Enviados', 'pedidos' => $pedidos]);
    }

    public function getNoPaid()
    {
        $pedidos = Pedido::where(['isPaid' => 0])->orderBy('created_at', 'DESC')->paginate(13);
        return view('administracion/pedidos/listadoPedidosNoPagados', ['title' => 'Pedidos no pagados', 'pedidos' => $pedidos]);
    }

    public function orderPaypalCompleted($idPedido)
    {
        $pedido = Pedido::where('idPedido', $idPedido)->first();
        $pedido->paid_at = Carbon::now();
        $pedido->isPaid = 1;
        $pedido->save();
        $this->clearOrder();
        return redirect()->to(
            'pedido/completado')
            ->with(['pago'=> 2,'idPedido'=>$pedido->idPedido]);
    }

    public function orderCompleted()
    {
        //creamos la notificacion que se le enviara al cliente sobre su pedido
        $notification = New NotificationOrder(['idPedido' => session()->get('idPedido')]);
        $notification->save();
        $pago = session()->get('pago');
        session()->forget(['pago','idPedido']);
        return view('pedidos/orderSuccessRegistered', ['title' => 'Pedido Registrado', 'pago' => $pago]);
    }

    public function clearOrder()
    {
        Cart::destroy();
        session()->regenerate();
    }

    public function updateOrder(Request $request)
    {
        $pedido = Pedido::where('idPedido', $request->get('idPedido'))->first();
        $pedido->idTipoPago = $request->get('methodPayUserSelected');
        $pedido->save();
        return $this->getGatewayOrder($request->get('methodPayUserSelected'), $pedido);
    }

    public function getGatewayOrder($type, Pedido $pedido)
    {
        switch ($type) {
            case "1"://Transferencia bancaria
                $this->clearOrder();
                return redirect()->to(
                    'pedido/completado')
                    ->with(['pago'=>1,'idPedido'=>$pedido->idPedido]);
                break;
            case "2"://Paypal
                return redirect()->to(
                    '/checkout/payment/' . encrypt($pedido->numIdentificacionPedido) . '/paypal'
                );
                break;
            default:
                dd('aqui');
                return redirect()->back()->withInput($request->all());
                break;
        }
    }

    public function saveNewPedido(Cliente $cliente, Request $request, $lines)
    {
        $dataPedido = array('idCliente' => $cliente->id,
            'idLineas' => serialize($lines),
            'idTipoPago' => $request->get('methodPayUserSelected'),
            'totalPedido' => $request->get('totalPedido'),
            'numIdentificacionPedido' => Uuid::generate(),
            'totalIVA' => Cart::tax(),
            'withoutIVA' => Cart::subtotal());
        $pedido = new Pedido($dataPedido);
        $statusP = $pedido->save();
        $pedido->status = $statusP;
        return $pedido;
    }
}

