<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;


class ClienteController extends Controller
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

    public function getRegistroClientePedido()
    {
        if (Cart::content()->count() == 0) {
            return redirect()->route('cesta');
        } else {
            return view('pedidos/registroClientePedido', ['title' => 'Confirmaci&oacute;n del pedido', 'total' => Cart::total()]);
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
    public static function saveNewClient(Request $request)
    {
        $dataClient = array('full_name' => $request->get('full_name'),
            'enterprise' => $request->get('enterprise'),
            'phone' => $request->get('phone'),
            'nif-cif' => $request->get('nif'),
            'address' => $request->get('address'),
            'poblation' => $request->get('poblation'),
            'postal_code' => $request->get('cp'),
            'provence' => $request->get('provence'),
            'email' => $request->get('email'),
            'observations' => $request->get('observations'),
            'session_id' => $request->session()->getId());

        $client = new Cliente($dataClient);
        $status = $client->save();
        $client->status = $status;
        return $client;
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
