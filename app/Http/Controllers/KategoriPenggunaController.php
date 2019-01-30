<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KategoriPengguna;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth; 
use App\Pengguna;

class KategoriPenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $request)
    {
        $rand = rand(1000, 9000);
        $this->id        = 'KTPNGID'.$rand.date('His');
        $this->kode      = $rand.date('His');
        $this->dateInsert= date('Y-m-d H:i:s');
        $this->dateUpdate= date('Y-m-d H:i:s');
    }

    public function index()
    {
        $data = KategoriPengguna::all();
        return view('admin.kategori-pengguna.index', compact('data'));
    }

    public function getData()
    {
        $KategoriPengguna = KategoriPengguna::all();

        $data = Datatables::of($KategoriPengguna)
               
                ->addColumn('KTPNG_NAMA', function($row){
                     return $html = '<a href="#" data-href="'.url('admin/pengguna/kategori-pengguna/edit/').'" data-id="'.$row->KTPNG_ID.'" onclick="actionButton(this)">'.$row->KTPNG_NAMA.'</a>'; 
                  })
                  ->addColumn('action', function($row){
                      $html = '<div class="text-center">
                                <a disabled href="#" onclick="confirmLink(this)" data-href="'.url('admin/pengguna/kategori-pengguna/hapus/'.$row->KTPNG_ID).'" data-text="Your previous data will change" type="button" class="btn btn-danger btn-sm" title="delete"><i class="fa fa-trash"></i>
                                </a>
                            </div>
                            ';
                      return $html;
                  })
                  ->rawColumns(['KTPNG_NAMA','action','confirmed'])
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
        return view('admin.kategori-pengguna.add');
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
            'kategoriPengguna'           => 'required',
            'keteranganKategoriPengguna' => 'required',
        ]);

        $data = new KategoriPengguna;

        $data->KTPNG_ID      = $this->id;
        $data->KTPNG_KODE    = $this->kode;
        $data->KTPNG_NAMA    = $request->kategoriPengguna;
        $data->KTPNG_KET     = $request->keteranganKategoriPengguna;
        $data->KTPNG_DTINS   = $this->dateInsert;
        $data->KTPNG_DTUPDT  = $this->dateUpdate;
        $data->KTPNG_USERINS = $idUser;
        $data->KTPNG_USERUPDT= $idUser;

        $data->save();
        return redirect('admin/pengguna/kategori-pengguna')->with('message','Transaction Success');
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
        $data = KategoriPengguna::where('KTPNG_ID', $id)->first();

        return view('admin.kategori-pengguna.edit', compact('data'));
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
            'kategoriPengguna'           => 'required',
            'keteranganKategoriPengguna' => 'required',
        ]);

        $data = KategoriPengguna::where('KTPNG_ID', $id)->update([
            'KTPNG_NAMA'    => $request->kategoriPengguna,
            'KTPNG_KET'     => $request->keteranganKategoriPengguna,
            'KTPNG_DTUPDT'  => $this->dateUpdate,
            'KTPNG_USERUPDT'=> $idUser,
        ]);

        return redirect('admin/pengguna/kategori-pengguna')->with('message','Transaction Success'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cek = Pengguna::where('KTPNG_ID', $id)->get();
        if($cek->count() == 0){
            $data = KategoriPengguna::where('KTPNG_ID', $id);
            $data->delete();
            return redirect('admin/pengguna/kategori-pengguna')->with('message','Transaction Success');
        }else{
            return redirect('admin/pengguna/kategori-pengguna')->with('message-failed','Data Sedang Digunakan');
        }

    }
}
