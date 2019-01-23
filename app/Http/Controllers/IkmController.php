<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use App\Ikm;
use App\Provinsi;
use App\Kecamatan;
use App\Images;
use App\Kabkot;
use App\Desa;
use App\Produk;
use App\Sentra;
use App\IkmToSertifikasi;
use App\IkmToEvent;
use Carbon\Carbon;
use App\GenerateFormatDate;
use File;
use Response;

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
                     return $html = '<a href="#" data-href="'.url('user/ikm/edit/').'" data-id="'.$row->IKM_ID.'" onclick="actionButton(this)">'.$row->IKM_NAMA.'</a>'; 
                  })
                  ->addColumn('action', function($row){
                      $html = '<div class="text-center">
                                <a style="display:none" href="#" disabled onclick="confirmLink(this)" data-href="'.url('user/pengguna/kategori-pengguna/hapus/'.$row->IKM_ID).'" data-text="Your previous data will change" type="button" class="btn btn-danger btn-sm" title="delete"><i class="fa fa-trash"></i>
                                </a>
                                <a href="'.url('user/ikm/produk/'.$row->IKM_ID).'" type="button" class="btn btn-default btn-sm" title="Produk">
                                  <i class="fa fa-dropbox"></i>
                                </a>
                                <a href="'.url('user/ikm/sertifikasi/'.$row->IKM_ID).'" type="button" class="btn btn-default btn-sm" title="Sertifikasi">
                                  <i class="fa fa-folder"></i>
                                </a>
                                <a href="'.url('user/ikm/event/'.$row->IKM_ID).'" type="button" class="btn btn-default btn-sm" title="Event">
                                  <i class="fa fa-calendar"></i>
                                </a>
                            </div>
                            ';
                      return $html;
                  })
                  ->rawColumns(['IKM_NAMA','action','confirmed'])
                  ->make(true);

        return $data;
    }

    public function import()
    {
      return view('user.ikm.import');
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
            'ikmThnDiKeluarkanIjin' => 'required',
            'ikmBentukBadan' => 'required',
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
        $data->IKM_DTBERDIRI  = GenerateFormatDate::formatDate($request->ikmDtBerdiri);
        $data->IKM_JENISUSAHA = $request->ikmJenisUsaha;
        $data->IKM_TLP        = $request->ikmTlp;
        $data->IKM_EMAIL      = $request->ikmEmail;
        $data->IKM_LONGI      = $request->ikmLongi;
        $data->IKM_LATI       = $request->ikmLati;;
        $data->IKM_PROV       = $request->provinsi;
        $data->IKM_BENTUKBADAN= $request->ikmBentukBadan;
        $data->IKM_THNDIKELUARKANIJIN= $request->ikmThnDiKeluarkanIjin;
        $data->IKM_KABKOT     = $request->kabkot;
        $data->IKM_KEC        = $request->kecamatan;
        $data->IKM_DESA       = $request->desa;
        $data->IKM_ALMTDET    = $request->ikmAlmtDet;
        $data->IKM_KET        = $request->ikmKet;
        $data->IKM_DTINS      = $this->dateInsert;
        $data->IKM_DTUPDT     = $this->dateUpdate;
        $data->IKM_USERINS    = $idUser;
        $data->IKM_USERUPDT   = $idUser;

        $data->save();

        //update images
        $foto         = "";
        $originalName = "";
        if($request->hasFile('ikmImage')){
            $originalName    = $request->file('ikmImage')->getClientOriginalName();
        
            $imageName = time().'.'.$request->ikmImage->getClientOriginalExtension();
            $foto      = 'images/ikm/'.$imageName;

            $request->ikmImage->move(public_path('/images/ikm/'), $imageName);   
        }

        $rand = rand(1000, 9000);
        $images = new Images;   
        $images->IMG_ID        = 'IMG'.$rand.date('His'); 
        $images->ID            = $this->id; 
        $images->IMG_GROUP     = 'IKM'; 
        $images->IMG_NAMA      = $foto; 
        $images->IMG_KET       = $originalName; 
        $images->IMG_DTINS     = $this->dateInsert;
        $images->IMG_DTUPDT    = $this->dateUpdate;
        $images->IMG_USERINS   = $idUser;
        $images->IMG_USERUPDT  = $idUser;

        $images->save();

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
        $ikm = Ikm::where('IKM_ID', $id)->first();
        $data = array(
            'ikm'      => $ikm,
            'provinsi' => Provinsi::all(),
            'kabkot'   => Kabkot::where('id', $ikm->IKM_KABKOT)->first(),
            'kecamatan'=> Kecamatan::where('id', $ikm->IKM_KEC)->first(),
            'desa'     => Desa::where('id', $ikm->IKM_DESA)->first(),
            'image'    => Images::where('ID', $id)->first(),
        );
        return view('user.ikm.edit')->with($data);
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
            'ikmNama'       => 'required',
            'ikmNpwp'       => 'required',
            'nikPemilik'    => 'required',
            'nikPemilik'    => 'required',
            'ikmPemilik'    => 'required',
            'ikmNoPendirian'=> 'required',
            'ikmDtBerdiri'  => 'required',
            'ikmJenisUsaha' => 'required',
            'ikmTlp'        => 'required',
            'ikmThnDiKeluarkanIjin' => 'required',
            'ikmBentukBadan' => 'required',
            'ikmEmail'      => 'required',
            'provinsi'      => 'required',
            'kabkot'        => 'required',
            'kecamatan'     => 'required',
        ]);

        $data = Ikm::where('IKM_ID', $id)->update([
            'IKM_NAMA'=> $request->ikmNama,
            'IKM_NPWP'=> $request->ikmNpwp,
            'IKM_NIKPEMILIK'=> $request->nikPemilik,
            'IKM_PEMILIK'=> $request->ikmPemilik,
            'IKM_NOPENDIRIAN'=> $request->ikmNoPendirian,
            'IKM_DTBERDIRI'=> GenerateFormatDate::formatDate($request->ikmDtBerdiri),
            'IKM_JENISUSAHA'=> $request->ikmJenisUsaha,
            'IKM_TLP'=> $request->ikmTlp,
            'IKM_EMAIL'=> $request->ikmEmail,
            'IKM_LONGI'=> $request->ikmLongi,
            'IKM_LATI'=> $request->ikmLati,
            'IKM_PROV'=> $request->provinsi,
            'IKM_BENTUKBADAN'=> $request->ikmBentukBadan,
            'IKM_THNDIKELUARKANIJIN'=> $request->ikmThnDiKeluarkanIjin,
            'IKM_KABKOT'=> $request->kabkot,
            'IKM_KEC'=> $request->kecamatan,
            'IKM_DESA'=> $request->desa,
            'IKM_ALMTDET'=> $request->ikmAlmtDet,
            'IKM_KET'=> $request->ikmKet,
            'IKM_DTUPDT'=> $this->dateUpdate,
            'IKM_USERUPDT'=> $idUser,
        ]);

        //update images
        if($request->hasFile('ikmImage')){

            $originalName    = $request->file('ikmImage')->getClientOriginalName();
        
            $imageName = time().'.'.$request->ikmImage->getClientOriginalExtension();
            $foto      = 'images/ikm/'.$imageName;

            $getImage = Images::where('ID', $id)->first();

            File::delete(public_path($getImage->IMG_NAMA));

            $request->ikmImage->move(public_path('/images/ikm/'), $imageName);   
        }else{

            if($request->oldIkmImage == ""){
              $foto         = "";
              $originalName = "";
            }else{
              $foto         = $request->oldIkmImage;
              $originalName = $request->oldIkmImage;
            }
        }

        $rand = rand(1000, 9000);
        $images = Images::where('ID', $id)->update([

          'IMG_NAMA'      => $foto, 
          'IMG_KET'       => $originalName, 
          'IMG_DTUPDT'    => $this->dateUpdate,
          'IMG_USERUPDT'  => $idUser,

        ]);   

    
        return redirect('user/ikm')->with('message','Transaction Success');
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

    public function produk($id)
    {
        $ikm  = Ikm::where('IKM_ID', $id)->first();
        $data = Produk::with('produkToKategoriProduk.kategoriProduk', 'ratingProduk', 'sukaProduk', 'ikm', 'images')->where('IKM_ID', $id)->paginate(30);

        $ratingProduk = 0;
        $sukaProduk   = 0;
        foreach($data as $row)
        {
            if($row->images['IMG_NAMA'] == ""){
                $images = Images::imageDefault();
            }else{
                $images = url($row->images['IMG_NAMA']);
            }

            if($row->ratingProduk->count() > 0){
                $ratingProduk = $row->ratingProduk->sum('RAT_BOBOT');
            }

            if($row->sukaProduk->count() > 0){
                $sukaProduk = $row->sukaProduk->sum('RAT_BOBOT');
            }

            $dataArray[] = array(
                'id_produk'      => $row->PRDK_ID, 
                'thumbnail'      => $images,
                'nama'           => $row->PRDK_NAMA,
                'komposisi'      => $row->PRDK_KOMPOSISI,
                'kbli'           => $row->PRDK_KBLI,
                'ikm'            => $row->ikm['IKM_NAMA'],
                'rating'         => $ratingProduk,
                'suka'           => $sukaProduk
            );
        }

        return view('user.ikm.produk', compact('dataArray', 'ikm'));
    }

    public function sertifikasi($id)
    {
        $sertifikasi  = IkmToSertifikasi::with('sertifikasi', 'ikm')->where('IKM_ID', $id)->get();
        $ikm          = Ikm::where('IKM_ID', $id)->first();

        foreach($sertifikasi as $item){
            $sertifikasiArray[] = array(
                'id_sertifikat'    => $item->sertifikasi['SRT_ID'],
                'no_sertifikat'    => '',
                'name'             => $item->sertifikasi['SRT_NAMA'],
                'register'         => date('d-m-Y', strtotime($item['ITS_DTDAFTAR'])),
                'tanggalAcc'       => date('d-m-Y', strtotime($item['ITS_DTACC'])),
                'masaBerlakuDari'  => date('d-m-Y', strtotime($item['ITS_DTDARI'])),
                'masaBerlakuSampai'=> date('d-m-Y', strtotime($item['ITS_DTSAMPAI'])),
                'keterangan'       => $item['ITS_KET'],
            );
        }

        return view('user.ikm.sertifikasi', compact('ikm', 'sertifikasiArray'));
    }

    public function event($id)
    {
        $getEvent = IkmToEvent::with('event', 'ikm','event.provinsi', 'event.kabkot', 'event.kecamatan', 'event.desa')->where('IKM_ID', $id)->get();
         $ikm          = Ikm::where('IKM_ID', $id)->first();
        foreach($getEvent as $item){
            $eventData[] = array(
               'nama' => $item->event['EVT_NAMA'],
               'panitia' => $item->event['EVT_PANITIA'],
               'ketuaPanitia' => $item->event['EVT_KETPANITIA'],
               'tema' => $item->event['EVT_TEMA'],
               'tlp' => $item->event['EVT_TLP'], 
                'web' => $item->event['EVT_WEB'], 
                'tanggalMulai' => date('d-m-Y', strtotime($item->event['EVT_DTDARI'])), 
                'tanggalAkhir' => date('d-m-Y', strtotime($item->event['EVT_DTSAMPAI'])), 
                'keterangan' => $item->event['EVT_KET'], 
                'eventLongi'=> $item->event['EVT_LONGI'], 
                'eventLati'=> $item->event['EVT_LATI'], 
                'provinsi'=> $item->event->provinsi['name'], 
                'kabupaten'=> $item->event->kabkot['name'], 
                'kecamatan'=> $item->event->kecamatan['name'], 
                'desa'=> $item->event->desa['name'], 
                'alamat'=> $item->event['EVT_ALMTDET'], 
                'statusKehadiran' => $item['ITE_HADIR'],
                'tanggalDatang' => date('d-m-Y', strtotime($item['ITE_DTNG'])),
                'tanggalPulang' => date('d-m-Y', strtotime($item['ITE_PLNG'])),
                'tanggalNilai' => $item['ITE_NILAI'],
                'datangLongi' => $item['ITE_LONGI'],
                'datangLati' => $item['ITE_LATI'],
            );
        }

        return view('user.ikm.event', compact('ikm', 'eventData'));
    }

    public function downloadExcel() 
    {
        $file= public_path(). "/doc/format-ikm.xlsx";

        $headers = array(
                  'Content-Type: application/xlsx',
                );

        return Response::download($file, 'format-data-ikm.xlsx', $headers);
    }

    
}
