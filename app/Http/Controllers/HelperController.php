<?php

namespace App\Http\Controllers;

use App\Pedido;
use Illuminate\Http\Request;
use Helper;

class HelperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    public function getBill($id)
    {
        $pedido = Pedido::where('idPedido',$id)->first();
        if(empty($pedido)){
            return 'No existe este pedido';
        }
        $factura = Pedido::where('idPedido', $id)->first()->factura();
        if (empty($factura)) {
            FacturaController::createNewFactura($pedido);

            Helper::saveBillPDF($id);
        }
        $month = date_format(date_create($pedido->created_at),'n');
        $year =  date_format(date_create($pedido->created_at),'Y');
        //Check if directory is created..
        Helper::checkExistsThisFolder($year . '/' . $month . '/');
        return Helper::doBillPDF('ver', $id);

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
}
