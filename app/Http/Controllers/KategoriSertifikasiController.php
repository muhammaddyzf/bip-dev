<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KategoriSertifikasi;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth; 
use App\Sertifikasi;

class KategoriSertifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $request)
    {
        $rand = rand(1000, 9000);
        $this->id        = 'KTSRTID'.$rand.date('His');
        $this->kode      = $rand.date('His');
        $this->dateInsert= date('Y-m-d H:i:s');
        $this->dateUpdate= date('Y-m-d H:i:s');
    }

    public function index()
    {
        $data = KategoriSertifikasi::all();
        return view('user.kategori-sertifikasi.index', compact('data'));
    }

    public function getData()
    {
        $kategoriSertifikasi = KategoriSertifikasi::all();

        $data = Datatables::of($kategoriSertifikasi)
               
                ->addColumn('KTSRT_NAMA', function($row){
                     return $html = '<a href="#" data-href="'.url('user/sertifikasi/kategori-sertifikasi/edit').'" data-id="'.$row->KTSRT_ID.'" onclick="actionButton(this)">'.$row->KTSRT_NAMA.'</a>'; 
                  })
                  ->addColumn('action', function($row){
                      $html = '<div class="text-center">
                                <a href="#" onclick="confirmLink(this)" data-href="'.url('user/sertifikasi/kategori-sertifikasi/hapus/'.$row->KTSRT_ID).'" data-text="Your previous data will change" type="button" class="btn btn-danger btn-sm" title="delete"><i class="fa fa-trash"></i>
                                </a>
                            </div>
                            ';
                      return $html;
                  })
                  ->rawColumns(['KTSRT_NAMA','action','confirmed'])
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
        return view('user.kategori-sertifikasi.add');
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
            'kategoriSertifikasi'           => 'required',
            'keteranganKategoriSertifikasi' => 'required',
        ]);

        $data = new KategoriSertifikasi;

        $data->KTSRT_ID      = $this->id;
        $data->KTSRT_KODE    = $this->kode;
        $data->KTSRT_NAMA    = $request->kategoriSertifikasi;
        $data->KTSRT_KET     = $request->keteranganKategoriSertifikasi;
        $data->KTSRT_DTINS   = $this->dateInsert;
        $data->KTSRT_DTUPDT  = $this->dateUpdate;
        $data->KTSRT_USERINS = $idUser;
        $data->KTSRT_USERUPDT= $idUser;

        $data->save();
        return redirect('user/sertifikasi/kategori-sertifikasi')->with('message','Transaction Success');
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
        $data = KategoriSertifikasi::where('KTSRT_ID', $id)->first();

        return view('user.kategori-sertifikasi.edit', compact('data'));
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
            'kategoriSertifikasi'           => 'required',
            'keteranganKategoriSertifikasi' => 'required',
        ]);

        $data = KategoriSertifikasi::where('KTSRT_ID', $id)->update([
            'KTSRT_NAMA'    => $request->kategoriSertifikasi,
            'KTSRT_KET'     => $request->keteranganKategoriSertifikasi,
            'KTSRT_DTUPDT'  => $this->dateUpdate,
            'KTSRT_USERUPDT'=> $idUser,
        ]);

        return redirect('user/sertifikasi/kategori-sertifikasi')->with('message','Transaction Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cek = Sertifikasi::where('KTSRT_ID', $id)->get();
        if($cek->count() == 0){
            $data = KategoriSertifikasi::where('KTSRT_ID', $id);
            $data->delete();
            return redirect('user/sertifikasi/kategori-sertifikasi')->with('message','Transaction Success');
        }else{
            return redirect('user/sertifikasi/kategori-sertifikasi')->with('message-failed','Data Sedang Digunakan');
        }
    }
}
