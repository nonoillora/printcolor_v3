<?php

namespace App\Http\Controllers;

use App\CompanyShipping;
use App\Factura;
use App\LineaPedido;
use App\Mail\newOrder;
use App\Mail\OrderSent;
use App\Pedido;
use Faker\Provider\ar_JO\Company;
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
                    $metodoPago = $metodoPago->nombre;
                }
                return view('administracion/pedidos/detailsPedido', ['title' => 'Pedido ' . $id,
                    'pedido' => $pedido,
                    'cliente' => $cliente,
                    'lineas' => $lineas,
                    'shipppings' => $companys,
                    'empresaTransporte' => $companyPedido,
                    'metodoPago' => $metodoPago]);
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
            $cliente = ClienteController::saveNewClient($request);
            $statusC = $cliente->status;
            $lineas = LineaPedido::where(['session_id' => $request->session()->getId()])->orderBy('updated_at', 'ASC')->get();
            $lines = array();
            foreach ($lineas as $linea) {
                array_push($lines, $linea->id);
            }

            $dataPedido = array('idCliente' => $cliente->id,
                'idLineas' => serialize($lines),
                'idTipoPago' => '1',
                'totalPedido' => $request->get('totalPedido'),
                'numIdentificacionPedido' => Uuid::generate(),
                'totalIVA' => Cart::tax(),
                'withoutIVA' => Cart::subtotal());
            $pedido = new Pedido($dataPedido);
            $statusP = $pedido->save();
            if ($statusC & $statusP) {
                Cart::destroy();
                $request->session()->regenerate();
                $lineas = DB::table('linea_pedidos')
                    ->select('*')
                    ->whereIn('id', unserialize(DB::table('pedidos')->select('idLineas')->where('idPedido', $pedido->idPedido)->first()->idLineas))
                    ->get();
                $numFac = DB::table('pedidos')->where('created_at', 'like', date('Y') . '-%')->count();
                $factura = new Factura(array('idPedido' => $pedido->idPedido, 'numeracionFactura' => $numFac . '/' . date('y')));
                $factura->save();
                //Mail::to($cliente->email)->send(new newOrderUser($pedido, $cliente, $lineas, $factura));
                //Mail::to(HelperConfig::getConfig('_EMAIL_SEND_NOTIFICATION_OWN'))->send(new newOrder($pedido, $cliente, $lineas, $factura));
                $statusSavePDF = Helper::saveBillPDF($pedido->idPedido);
                return view('pedidos/orderSuccessRegistered', ['title' => 'Pedido Registrado']);
            } else {
                if ($statusP && !$statusC) {
                    //dd('fallo cliente');
                    return view('pedidos/orderSuccessRegistered', ['title' => 'falloPedido Registrado']);
                }
                if (!$statusP && $statusC) {
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
        $idCompany = DB::table('company_shippings')->join('pedidos','idCompany','=','company_shipping')->select('*')->where('idPedido','=',$pedido->idPedido)->first()->idCompany;
        $shipping = CompanyShipping::find($idCompany);
        $idCliente = DB::table('clientes')->join('pedidos','id','=','idCliente')->select('id')->where('idPedido','=',$pedido->idPedido)->first()->id;
        $cliente = Cliente::find($idCliente);
        Mail::to($cliente->email)->send(new OrderSent($pedido, $cliente, $lineas,$shipping));
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
}
