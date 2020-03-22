<?php
/**
 * Created by PhpStorm.
 * User: Antonio
 * Date: 15/10/2017
 * Time: 21:00
 */

namespace App\SupportFunctions;

use DB;


class HelperConfig
{
    public static function getConfig($key)
    {
    return DB::table('configs')->select('value')->where(['config_is_active'=>1,'config_key'=>$key])->first()->value;
    }
}