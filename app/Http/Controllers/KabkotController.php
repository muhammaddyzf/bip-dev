<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kabkot;
class KabkotController extends Controller
{
	public function getKecamatan(Kabkot $kabkot)
    {
        return $kabkot->kecamatan()->select('id', 'name')->get();
    }
}
