<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ikm;
use App\Produk;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalIkm           = Ikm::where('IKM_KAT_ID','=','KATIKMID111111')->count();
        $totalIndustriBesar = Ikm::where('IKM_KAT_ID','=','KATIKMID222222')->count();
        $totalProduk        = Produk::count();

        return view('admin.dashboard', compact('totalIkm', 'totalIndustriBesar', 'totalProduk'));
    }
}
