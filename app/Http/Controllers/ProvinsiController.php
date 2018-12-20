<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provinsi;
class ProvinsiController extends Controller
{
    public function getKabkot(Provinsi $provinsi)
    {
        return $provinsi->kabkot()->select('id', 'name')->get();
    }
}
