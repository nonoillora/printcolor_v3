<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administracion/contactos/listadoContactos',
            [
                'title' => 'Mensajes',
                'mensajes' => DB::table('contactos')->select('id', 'nombre', 'telefono', 'email', 'mensaje', 'created_at')->paginate(35)
            ]);
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

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mensaje = DB::table('contactos')->select('id', 'nombre', 'telefono', 'email', 'mensaje', 'created_at')->where(['id' => $id])->first();

        if (is_null($mensaje) || count($mensaje) == 0) {
            abort('404');
        } else {
            return view('administracion/contactos/mostrarMensaje',
                [
                    'title' => 'Mensaje de ' . $mensaje->nombre,
                    'mensaje' => $mensaje
                ]);
        }

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
