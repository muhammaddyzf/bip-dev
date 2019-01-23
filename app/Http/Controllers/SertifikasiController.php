<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KategoriSertifikasi;
use App\Ikm;
use App\Sertifikasi;
use App\Images;
use App\IkmToSertifikasi;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use File;
use App\GenerateFormatDate;

class SertifikasiController extends Controller
{

	  public function __construct(Request $request)
    {
        $rand = rand(1000, 9000);
        $this->id        = 'SRTID'.$rand.date('His');
        $this->kode      = $rand.date('His');
        $this->dateInsert= date('Y-m-d H:i:s');
        $this->dateUpdate= date('Y-m-d H:i:s');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.sertifikasi.index');
    }

    public function getData()
    {
        $sertifikasi = Sertifikasi::all();
        $data = Datatables::of($sertifikasi)
                ->addColumn('sertifikasi', function($row){
                     return $html = '<a href="#" data-href="'.url('user/sertifikasi/edit/').'" data-id="'.$row->SRT_ID.'" onclick="actionButton(this)">'.$row->SRT_NAMA.'</a>'; 
                })
                ->addColumn('action', function($row){
                      $event = "";
                      $ikm   = "";
                      if($row->SRT_NEEDEVENT != 0 ){
                        $event = '<a href="'.url('user/event/tambah/'.$row->SRT_ID).'" type="button" class="btn btn-success btn-sm" title="Tambah Event"><i class="fa fa-calendar"></i>
                                </a>';
                      }else{
                        $ikm = '<a href="'.url('user/sertifikasi/tambah-ikm/'.$row->SRT_ID).'" type="button" class="btn btn-primary btn-sm" title="Tambah IKM"><i class="fa fa-institution"></i>
                                </a>';
                      }
                      $html = '<div class="text-center">
                                <a href="#" onclick="confirmLink(this)" data-href="'.url('user/sertifikasi/hapus/'.$row->SRT_ID).'" data-text="Your previous data will change" type="button" class="btn btn-danger btn-sm" title="delete"><i class="fa fa-trash"></i>
                                </a>
                                '.$event.$ikm.'
                            </div>
                            ';
                      return $html;
                  })
                  ->rawColumns(['sertifikasi','action','confirmed'])
                  ->make(true);

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $kategoriSertifikasi = KategoriSertifikasi::all();

        return view('user.sertifikasi.add', compact('kategoriSertifikasi'));
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
            'ktsrtId'    => 'required',
            'srtNama'    => 'required',
            'srtSyarat'  => 'required',
            'srtSpek'    => 'required',
            'srtBobot'   => 'required|alpha_dash|max:4',
            'event'      => 'required',
        ]);

        $data = new Sertifikasi;
        $data->SRT_ID   	  = $this->id;
        $data->KTSRT_ID   	= $request->ktsrtId;
        $data->SRT_KODE 	  = $this->kode;
        $data->SRT_NAMA 	  = $request->srtNama;
        $data->SRT_SYARAT 	= $request->srtSyarat;
        $data->SRT_SPEK 	  = $request->srtSpek;
        $data->SRT_KET 		  = $request->srtKet;
        $data->SRT_BOBOT    = $request->srtBobot;
        $data->SRT_NEEDEVENT= $request->event;
        $data->SRT_DTINS    = $this->dateInsert;
        $data->SRT_DTUPDT   = $this->dateUpdate;
        $data->SRT_USERINS  = $idUser;
        $data->SRT_USERUPDT = $idUser;
        $data->save();

        //update images
        $foto         = "";
        $originalName = "";
        if($request->hasFile('srtImage')){
            $originalName    = $request->file('srtImage')->getClientOriginalName();
        
            $imageName = time().'.'.$request->srtImage->getClientOriginalExtension();
            $foto      = 'images/sertifikasi/'.$imageName;

            $request->srtImage->move(public_path('/images/sertifikasi/'), $imageName);   
        }

        $rand = rand(1000, 9000);
        $images = new Images;   
        $images->IMG_ID        = 'IMG'.$rand.date('His'); 
        $images->ID            = $this->id; 
        $images->IMG_GROUP     = 'SERTIFIKASI'; 
        $images->IMG_NAMA      = $foto; 
        $images->IMG_KET       = $originalName; 
        $images->IMG_DTINS     = $this->dateInsert;
        $images->IMG_DTUPDT    = $this->dateUpdate;
        $images->IMG_USERINS   = $idUser;
        $images->IMG_USERUPDT  = $idUser;

        $images->save();
        
        return redirect('user/sertifikasi/list')->with('message','Transaction Success');
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
        $images = Images::where('ID', $id)->get();

        foreach($images as $itemImage){
            if($itemImage->IMG_NAMA == ""){
                Images::where('ID', $id)->delete();
            }else{
                File::delete(public_path($itemImage->IMG_NAMA));
                Images::where('ID', $id)->delete();
            }
        }

        $data = Sertifikasi::where('SRT_ID', $id)->delete();
        return redirect('user/sertifikasi/list')->with('message','Transaction Success');
    }

    public function createIkmToSertifikasi(Request $request, $id)
    {
        $sertifikasi = Sertifikasi::where('SRT_ID', $id)->first();
        $ikm         = Ikm::all();
        $data = array(
            'sertifikasi' => $sertifikasi,
            'ikm'         => $ikm
        );
        return view('user.sertifikasi.add-ikm-to-sertifikasi')->with($data);
    }

    public function storeIkmToSertifikasi(Request $request)
    {
        $idUser = Auth::id();
        $request->validate([
          'dtDaftar' => 'required',
          'dtDari'   => 'required',
          'dtSampai' => 'required',
        ]);
        
        foreach($request->ikm as $itemIkm){
            $rand = rand(1000, 9000);
            $data = new IkmToSertifikasi;
            $data->SRT_ID       = $request->srtId;
            $data->ITS_ID       = 'ITSID'.$rand.date('His');;
            $data->IKM_ID       = $itemIkm;
            $data->ITS_DTDAFTAR = GenerateFormatDate::formatDate($request->dtDaftar);
            $data->ITS_ACC      = $request->acc;
            $data->ITS_DTACC    = GenerateFormatDate::formatDate($request->dtAcc);
            $data->ITS_DTDARI   = GenerateFormatDate::formatDate($request->dtDari);
            $data->ITS_DTSAMPAI = GenerateFormatDate::formatDate($request->dtSampai);
            $data->ITS_KET      = $request->itsKet;
            $data->ITS_DTINS    = $this->dateInsert;
            $data->ITS_DTUPDT   = $this->dateUpdate;
            $data->ITS_USERINS  = $idUser;
            $data->ITS_USERUPDT = $idUser;

            $data->save();
        }

        return back()->with('message','Transaction Success');
    }
}
