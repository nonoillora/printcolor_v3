<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Storage;
use App\Producto;

class FicherosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Storage::files('public/categoria/');
        $products = Storage::files('public/productos/');
        $bills = Storage::allFiles('bills/');
        $offers = Storage::allFiles('public/ofertas');
        $auxOffer = [];
        foreach ($bills as $bill) {
            $aux = new \stdClass();
            $aux->file = $bill;
            $a = explode('/', $bill);
            array_shift($a);
            $aux->url = str_replace('/', '**', implode('/', $a));
            array_push($auxOffer, $aux);
        }
        return view('administracion/files/listadoFicheros', ['title' => 'Ficheros', 'categories' => $categories, 'products' => $products,'bills' => $auxOffer, 'offers' => $offers]);
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

    function getFile($type, $file)
    {
        switch ($type) {
            case 'categoria':
                $folder = storage_path() . '/app/public/categoria/';
                $disk = "categorias";
                break;
            case 'productos':
                $folder = storage_path() . '/app/public/productos/';
                $disk = "productos";
                break;
            case 'factura':
                $folder = storage_path() . '/app/bills/';
                $disk = "facturas";
                break;
            case 'oferta':
                $folder = storage_path() . '/app/public/ofertas/';
                $disk = "ofertas";
                break;
        }

        if ($disk == 'facturas') {
            $count = count(explode('**', $file)) - 1;
            $filename = explode('**', $file)[$count];
            $params = explode('**', $file);
            $d = array_pop($params);
            $params = implode('/',$params) .'/';
            return response()->file($folder .$params . $filename);
        } else {
            if (Storage::disk($disk)->has($file)) {
                return response()->file($folder . $file);
            }
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
