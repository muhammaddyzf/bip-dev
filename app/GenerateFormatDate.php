<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenerateFormatDate extends Model
{
    public static function formatDate($date)
    {
    	return date('Y-m-d', strtotime($date));
    }

    public static function backFormatDate($date)
    {
    	return date('d/m/Y', strtotime($date));
    }
}
