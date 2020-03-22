<?php
/**
 * Created by PhpStorm.
 * User: Antonio
 * Date: 18/11/2017
 * Time: 20:02
 */

namespace App\SupportFunctions;

use DB;
use Auth;

class HelperNotificationsAdmin
{
    public static function getMessages()
    {
        return DB::table('contactos')->select('*')->where('created_at','>',DB::table('users')->select('user_last_login')->where(['id'=>Auth::user()->id])->first()->user_last_login)->count();
    }

    public static function getBudget(){
        return DB::table('presupuestos')->select('*')->where('created_at','>',DB::table('users')->select('user_last_login')->where(['id'=>Auth::user()->id])->first()->user_last_login)->count();
    }

    public static function getOrders(){
        return DB::table('pedidos')->select('*')->where('created_at','>',DB::table('users')->select('user_last_login')->where(['id'=>Auth::user()->id])->first()->user_last_login)->count();
    }
}