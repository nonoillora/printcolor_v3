<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Config;


class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administracion/configs/listadoConfigs',['title'=>'Variables de configuración','configs'=>DB::table('configs')->select('idConfig','config_key','description')->where('config_is_active',1)->get()]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $config = DB::table('configs')->select('*')->where(['config_is_active'=>1,'idConfig'=>$id])->first();
        if(is_null($config)){
            abort('404');
        }else{
            return view('administracion/configs/detailsConfig',['title'=>$config->config_key,'config'=>$config]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $config = Config::find($request->get('idConfig'));
        $config->value = $request->get('config_value');
        $config->updated_at = Carbon::now('Europe/Madrid');
        $status = $config->save();
        if($status){
            return redirect()->back()->with('successEditConfig','Configuración actualizada correctamente');
        }else{
            return redirect()->back()->with('ErrorEditConfig','Algo salió mal, intentalo nuevamente');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
