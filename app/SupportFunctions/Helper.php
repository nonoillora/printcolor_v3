<?php

namespace App\SupportFunctions;

use DB;
use Dompdf\Dompdf;
use App\Factura;
use Storage;
use App\Pedido;


class Helper
{
    public static function doBillPDF($tipo, $idPedido)
    {
        $cliente = DB::table('clientes')->select('*')->join('pedidos', 'idCliente', '=', 'id')->where('idPedido', $idPedido)->first();
        $lineas = DB::table('linea_pedidos')
            ->select('*')
            ->whereIn('id', unserialize(DB::table('pedidos')->select('idLineas')->where('idPedido',$idPedido)->first()->idLineas))
            ->where('lineaPedido_is_active',1)
            ->get();
        $pedido = DB::table('linea_pedidos')
            ->whereIn('id', unserialize(DB::table('pedidos')->select('idLineas')->where('idPedido',$idPedido)->first()->idLineas))
            ->sum('price');
        $factura = DB::table('facturas')->select('*')->where(['idPedido' => $idPedido])->first();
        $data = array();
        $data['lineas'] = $lineas;
        $data['cliente'] = $cliente;
        $data['pedido'] = $pedido;
        $data['factura'] = $factura;
        $dompdf = new Dompdf();

        view()->share('lineas', $lineas);
        view()->share('cliente', $cliente);
        view()->share('pedido', $pedido);
        view()->share('factura', $factura);
        $dompdf = \PDF::loadView('facturas/factura');
        $dompdf->setPaper('A4', 'portrait');
        if ($tipo == 'download') {
            //para que se adjunte en el mensaje
            return $dompdf->output();
        } else {
            //$dompdf->render();
            //para verlo en la noavegador
            //return $dompdf->download('invoice.pdf');
            return $dompdf->stream($cliente->numIdentificacionPedido . '.pdf');
        }
    }

    public static function saveBillPDF($idPedido)
    {
        //$s = Storage::disk('bills')->delete('2020/3/10b38740-568f-11ea-9eb0-adb7e376fdf7.pdf');
        //dd($s);
        $cliente = DB::table('clientes')->select('*')->join('pedidos', 'idCliente', '=', 'id')->where('idPedido', $idPedido)->first();
        $lineas = DB::table('linea_pedidos')
            ->select('*')
            ->whereIn('id', unserialize(DB::table('pedidos')->select('idLineas')->where('idPedido',$idPedido)->first()->idLineas))
            ->where('lineaPedido_is_active',1)
            ->get();
        $pedido = DB::table('linea_pedidos')
            ->whereIn('id', unserialize(DB::table('pedidos')->select('idLineas')->where('idPedido', $idPedido)->first()->idLineas))
            ->sum('price');
        $data = array();
        $data['lineas'] = $lineas;
        $data['cliente'] = $cliente;
        $data['pedido'] = $pedido;
        $dompdf = new Dompdf();
        $factura = Factura::select('*')->where('idPedido', $idPedido)->first();

        $date_pedido = Pedido::where('idPedido', $idPedido)->first();
        $month = date_format(date_create($date_pedido->created_at),'n');
        $year =  date_format(date_create($date_pedido->created_at),'Y');

        //return view('facturas/factura1',['lineas'=>$lineas,'cliente'=> $cliente,'pedido'=>$pedido,'factura'=>$factura]);
        view()->share('lineas', $lineas);
        view()->share('cliente', $cliente);
        view()->share('pedido', $pedido);
        view()->share('factura', $factura);
        $dompdf = \PDF::loadView('facturas/factura');
        $dompdf->setPaper('A4', 'portrait');
        //$dompdf->render();
        //$output = $dompdf->output();
        //$status = file_put_contents(storage_path() . '/app/bills/' . date('Y') . '/' . date('n') . '/' . $cliente->numIdentificacionPedido . '.pdf', $output);
        $status = $dompdf->save(storage_path() . '/app/bills/' . $year . '/' . $month . '/' . $cliente->numIdentificacionPedido . '.pdf');
        if (!$status) {
            return false;
        } else {
            return true;
        }
    }

    public static function checkExistsThisFolder($folder)
    {
        if (!Storage::disk('bills')->exists($folder)) {
            Storage::makeDirectory($folder,0775,true);
        }
    }

}