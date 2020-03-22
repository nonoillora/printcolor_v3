<?php

namespace App\SupportFunctions;

use App\LineaPedido;
use App\Producto;
use DB;

/**
 * Created by PhpStorm.
 * User: Antonio
 * Date: 24/01/2017
 * Time: 10:02
 */
class HelperProduct
{
    public function esPresupuesto($id)
    {
        switch ($id) {
            case 8:
            case 17:
            case 22:
            case 23:
            case 26:
                return true;
                break;
            default:
                return false;
                break;
        }
    }

    public static function getImageProductForCartView($idLinea)
    {
        return Producto::find(LineaPedido::find($idLinea)->idProduct)->cover;
    }

    public static function getIVA($price,$type){
        switch($type){
            case 'onlyIVA':
                $data = $price/100*21;
                break;
            case 'priceWithIVA':
                $data = $price + ($price/100*21);
                break;
        }
        return round($data,2);
    }

    public static function getOffers()
    {
        return DB::table('productos')->select('id','cover','name')->where(['product_is_active'=>1,'is_offer'=>1])->get();
    }

    public static function esOferta($id){
        return DB::table('productos')->select('is_offer')->join('categories','productos.idCategoria','=','categories.id')->where(['productos.id'=>$id,'product_is_active'=>1])->first()->is_offer;
    }
}