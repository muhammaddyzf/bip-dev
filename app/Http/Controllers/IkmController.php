<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use App\Ikm;
use App\Provinsi;
use App\Kecamatan;
use App\Kabkot;
use App\Desa;
use App\Sentra;
use Carbon\Carbon;

class IkmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.ikm.index');
    }

    public function __construct(Request $request)
    {
        $rand = rand(1000, 9000);
        $this->id        = 'IKMID'.$rand.date('His');
        $this->kode      = $rand.date('His');
        $this->dateInsert= date('Y-m-d H:i:s');
        $this->dateUpdate= date('Y-m-d H:i:s');
    }

    public function getData()
    {
        $ikm = ikm::all();
        $data = Datatables::of($ikm)
               
                ->addColumn('IKM_NAMA', function($row){
                     return $html = '<a href="#" data-href="'.url('user/pengguna/kategori-pengguna/edit/').'" data-id="'.$row->IKM_ID.'" onclick="actionButton(this)">'.$row->IKM_NAMA.'</a>'; 
                  })
                  ->addColumn('action', function($row){
                      $html = '<div class="text-center">
                                <a href="#" onclick="confirmLink(this)" data-href="'.url('user/pengguna/kategori-pengguna/hapus/'.$row->IKM_ID).'" data-text="Your previous data will change" type="button" class="btn btn-danger btn-sm" title="delete"><i class="fa fa-trash"></i>
                                </a>
                                <a href="#" onclick="confirmLink(this)" data-href="'.url('user/produk/tambah/'.$row->IKM_ID).'" data-text="Your previous data will change" type="button" class="btn btn-success btn-sm" title="Tambah Produk"><i class="fa fa-dropbox"></i>
                                </a>
                                <a href="#" onclick="confirmLink(this)" data-href="'.url('user/sertifikasi/tambah/'.$row->IKM_ID).'" data-text="Your previous data will change" type="button" class="btn btn-primary btn-sm" title="Tambah Sertifikasi"><i class="fa fa-folder"></i>
                                </a>
                            </div>
                            ';
                      return $html;
                  })
                  ->rawColumns(['IKM_NAMA','action','confirmed'])
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
        $data = array(
            'provinsi' => Provinsi::all(),
            'kabkot'   => Kabkot::all(),
            'kecamatan'=> Kecamatan::all(),
            'desa'     => Desa::all()
        );
        return view('user.ikm.add')->with($data);
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
            'ikmNama'       => 'required',
            'ikmNpwp'       => 'required',
            'nikPemilik'    => 'required',
            'nikPemilik'    => 'required',
            'ikmPemilik'    => 'required',
            'ikmNoPendirian'=> 'required',
            'ikmDtBerdiri'  => 'required',
            'ikmJenisUsaha' => 'required',
            'ikmTlp'        => 'required',
            'ikmEmail'      => 'required',
            'provinsi'      => 'required',
            'kabkot'        => 'required',
            'kecamatan'     => 'required',
        ]);

        $data = new Ikm;

        $data->IKM_ID         = $this->id;
        $data->IKM_KODE       = $this->kode;
        $data->IKM_NAMA       = $request->ikmNama;
        $data->IKM_NPWP       = $request->ikmNpwp;
        $data->IKM_NIKPEMILIK = $request->nikPemilik;
        $data->IKM_PEMILIK    = $request->ikmPemilik;
        $data->IKM_NOPENDIRIAN= $request->ikmNoPendirian;
        $data->IKM_DTBERDIRI  = $request->ikmDtBerdiri;
        $data->IKM_JENISUSAHA = $request->ikmJenisUsaha;
        $data->IKM_TLP        = $request->ikmTlp;
        $data->IKM_EMAIL      = $request->ikmEmail;
        $data->IKM_LONGI      = '';
        $data->IKM_LATI       = '';
        $data->IKM_PROV       = $request->provinsi;
        $data->IKM_KABKOT     = $request->kabkot;
        $data->IKM_KEC        = $request->kecamatan;
        $data->IKM_DESA       = '';
        $data->IKM_ALMTDET    = $request->ikmAlmtDet;
        $data->IKM_KET        = $request->ikmKet;
        $data->IKM_DTINS      = $this->dateInsert;
        $data->IKM_DTUPDT     = $this->dateUpdate;
        $data->IKM_USERINS    = $idUser;
        $data->IKM_USERUPDT   = $idUser;

        $data->save();
        return redirect('user/ikm')->with('message','Transaction Success');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
