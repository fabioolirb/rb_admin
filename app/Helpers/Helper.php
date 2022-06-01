<?php

namespace App\Helpers;

use Carbon\Carbon;

class Helper
{
    public static function inDate($date)
    {
        $date = empty($date) ? '' : Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        return strtoupper($date);
    }

    public static function outDate($date)
    {
        $date =  empty($date) ? '' : date( "d/m/Y", strtotime(str_replace('-', '/', $date) ));

        return $date;
    }
}
