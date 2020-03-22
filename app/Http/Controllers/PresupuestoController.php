<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PresupuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listadoPresupuestos()
    {
        return view('presupuestos/listadoPresupuestos',
            ['title' => 'Presupuestos',
                'presupuestos' => DB::table('presupuestos')
                    ->select('presupuestos.id', 'name', 'presupuestos.created_at', 'nombre','respondido','presupuestos.updated_at')
                    ->join('productos', 'productos.id', '=', 'presupuestos.idProducto')
                    ->orderBy('presupuestos.id', 'desc')
                    ->paginate(22)
            ]);
    }

    public function mostrarPresupuesto($id)
    {
        return view('presupuestos/mostrarPresupuesto',
            ['title' => 'Presupuesto',
                'presupuestos' => DB::table('presupuestos')
                    ->select('presupuestos.id', 'name', 'presupuestos.created_at', 'nombre','comentario','dataAboutIt')
                    ->join('productos', 'productos.id', '=', 'presupuestos.idProducto')
                    ->where('presupuestos.id','=',$id)
                    ->orderBy('presupuestos.id', 'desc')
                    ->first()
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
