<?php
/**
 * Created by PhpStorm.
 * User: Antonio
 * Date: 12/11/2017
 * Time: 12:37
 */

namespace App\SupportFunctions;


class HelperMail
{

    public static function transformDateOrder($date)
    {
        $days = array(1 => 'Lunes', 2 => 'Martes', 3 => 'Miércoles', 4 => 'Jueves', 5 => 'Viernes', 6 => 'Sabado', 7 => 'Domingo');
        $months = array(1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 7 => 'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre');
        $semana = $days[date('N', strtotime($date))];
        $day = date('j', strtotime($date));
        $mes = $months[date('n', strtotime($date))];
        $year = date('Y', strtotime($date));
        return $semana . ', ' . $day . ' de ' . $mes . ' de ' . $year;
    }
}