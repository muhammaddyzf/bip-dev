
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kecamatan;
class KecamatanController extends Controller
{
	public function getDesa(Kecamatan $kecamatan)
    {
        return $kecamatan->desa()->select('id', 'name')->get();
    }
}

