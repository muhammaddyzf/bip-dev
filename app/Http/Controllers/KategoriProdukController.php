<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KategoriProduk;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth; 
use App\ProdukToKategoriProduk;

class KategoriProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $request)
    {
        $rand = rand(1000, 9000);
        $this->id        = 'KTPRDKID'.$rand.date('His');
        $this->kode      = $rand.date('His');
        $this->dateInsert= date('Y-m-d H:i:s');
        $this->dateUpdate= date('Y-m-d H:i:s');
    }

    public function index()
    {
        $data = KategoriProduk::all();
        return view('admin.kategori-produk.index', compact('data'));
    }

    public function getData()
    {
        $kategoriProduk = KategoriProduk::all();

        $data = Datatables::of($kategoriProduk)
               
                ->addColumn('KTPRDK_NAMA', function($row){
                     return $html = '<a href="#" data-href="'.url('admin/produk/kategori-produk/edit/').'" data-id="'.$row->KTPRDK_ID.'" onclick="actionButton(this)">'.$row->KTPRDK_NAMA.'</a>'; 
                  })
                  ->addColumn('action', function($row){
                      $html = '<div class="text-center">
                                <a href="#" onclick="confirmLink(this)" data-href="'.url('admin/produk/kategori-produk/hapus/'.$row->KTPRDK_ID).'" data-text="Your previous data will change" type="button" class="btn btn-danger btn-sm" title="delete"><i class="fa fa-trash"></i>
                                </a>
                            </div>
                            ';
                      return $html;
                  })
                  ->rawColumns(['KTPRDK_NAMA','action','confirmed'])
                  ->make(true);

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kategori-produk.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idUser = Auth::id();

        $request->validate([
            'kategoriProduk'           => 'required',
            'keteranganKategoriProduk' => 'required',
        ]);

        $data = new KategoriProduk;

        $data->KTPRDK_ID      = $this->id;
        $data->KTPRDK_KODE    = $this->kode;
        $data->KTPRDK_NAMA    = $request->kategoriProduk;
        $data->KTPRDK_KET     = $request->keteranganKategoriProduk;
        $data->KTPRDK_DTINS   = $this->dateInsert;
        $data->KTPRDK_DTUPDT  = $this->dateUpdate;
        $data->KTPRDK_USERINS = $idUser;
        $data->KTPRDK_USERUPDT= $idUser;

        $data->save();
        return redirect('admin/produk/kategori-produk')->with('message','Transaction Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = KategoriProduk::where('KTPRDK_ID', $id)->first();

        return view('admin.kategori-produk.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $idUser = Auth::id();

        $request->validate([
            'kategoriProduk'           => 'required',
            'keteranganKategoriProduk' => 'required',
        ]);

        $data = KategoriProduk::where('KTPRDK_ID', $id)->update([
            'KTPRDK_NAMA'    => $request->kategoriProduk,
            'KTPRDK_KET'     => $request->keteranganKategoriProduk,
            'KTPRDK_DTUPDT'  => $this->dateUpdate,
            'KTPRDK_USERUPDT'=> $idUser,
        ]);

        return redirect('admin/produk/kategori-produk')->with('message','Transaction Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cek = ProdukToKategoriProduk::where('KTPRDK_ID', $id)->get();
        if($cek->count() == 0){
            $data = KategoriProduk::where('KTPRDK_ID', $id);
            $data->delete();
            return redirect('admin/produk/kategori-produk')->with('message','Transaction Success');
        }else{
            return redirect('admin/produk/kategori-produk')->with('message-failed','Data Sedang Digunakan');
        }
    }
}
