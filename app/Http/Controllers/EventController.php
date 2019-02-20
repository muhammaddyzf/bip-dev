<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\GenerateFormatDate;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use File;
use App\Images;
use App\Ikm;
use App\Sertifikasi;
use App\Provinsi;
use App\Kecamatan;
use App\Kabkot;
use App\Desa;
use App\IkmToEvent;
use Carbon\Carbon;
use QrCode;

class EventController extends Controller
{
	public function __construct(Request $request)
    {
        $rand = rand(1000, 9000);
        $this->id        = 'EVTID'.$rand.date('His');
        $this->kode      = $rand.date('His');
        $this->dateInsert= date('Y-m-d H:i:s');
        $this->dateUpdate= date('Y-m-d H:i:s');
    }

    public function index()
    {
    	return view('admin.event.index');
    }

	public function create(Request $request, $id)
	{
		$sertifikasi = Sertifikasi::where('SRT_ID', $id)->first();
		$data = array(
			'sertifikasi' => $sertifikasi,
			'provinsi' => Provinsi::all(),
            'kabkot'   => Kabkot::all(),
            'kecamatan'=> Kecamatan::all(),
            'desa'     => Desa::all()
		);
		return view('admin.event.add')->with($data);
	}

	public function createEvent(Request $request)
	{
		$sertifikasi = Sertifikasi::where('SRT_NEEDEVENT', 1)->get();

		$data = array(
			'sertifikasi' => $sertifikasi,
			'provinsi' => Provinsi::all(),
            'kabkot'   => Kabkot::all(),
            'kecamatan'=> Kecamatan::all(),
            'desa'     => Desa::all()
		);
		return view('admin.event.add-event')->with($data);
	}

	public function store(Request $request)
	{
		$idUser = Auth::id();
		$request->validate([
			'evtNama' 		=> 'required',
			'evtTema' 		=> 'required',
			'evtPanitia' 	=> 'required',
			'evtKetPanitia' => 'required',
			'evtTlp'   	 	=> 'required',
			'evtWeb'		=> 'required',
			'evtDtDari'		=> 'required',
			'evtDtSampai'	=> 'required',
			'provinsi'		=> 'required',
			'kabkot'		=> 'required',
			'kecamatan'		=> 'required',
		]);

		$data = new Event;
		$data->EVT_ID   	  = $this->id;
		$data->SRT_ID   	  = $request->srtId;
		$data->EVT_KODE 	  = $this->kode;
		$data->EVT_NAMA 	  = $request->evtNama;
		$data->EVT_TEMA 	  = $request->evtTema;
		$data->EVT_PANITIA 	  = $request->evtPanitia;
		$data->EVT_KETPANITIA = $request->evtKetPanitia;
		$data->EVT_TLP 		  = $request->evtTlp;
		$data->EVT_WEB        = $request->evtWeb;
		$data->EVT_DTDARI     = GenerateFormatDate::formatDate($request->evtDtDari);
		$data->EVT_DTSAMPAI   = GenerateFormatDate::formatDate($request->evtDtSampai);
		$data->EVT_PROV       = $request->provinsi;
		$data->EVT_KABKOT     = $request->kabkot;
		$data->EVT_KEC        = $request->kecamatan;
		$data->EVT_DESA       = $request->desa;
		$data->EVT_LATI       = $request->evtLati;
		$data->EVT_LONGI      = $request->evtLongi;
		$data->EVT_ALMTDET    = $request->evtAlmtDet;
		$data->EVT_KET        = $request->evtKet;
		$data->EVT_DTINS      = $this->dateInsert;
		$data->EVT_DTUPDT     = $this->dateUpdate;
		$data->EVT_USERINS    = $idUser;
		$data->EVT_USERUPDT   = $idUser;

		$data->save();


		//update images
        $foto         = "";
        $originalName = "";
        if($request->hasFile('evtImage')){
            $originalName    = $request->file('evtImage')->getClientOriginalName();
        
            $imageName = time().'.'.$request->evtImage->getClientOriginalExtension();
            $foto      = 'images/event/'.$imageName;

            $request->evtImage->move(public_path('/images/event/'), $imageName);   
        }

        $rand = rand(1000, 9000);
        $images = new Images;   
        $images->IMG_ID        = 'IMG'.$rand.date('His'); 
        $images->ID            = $this->id; 
        $images->IMG_GROUP     = 'EVENT'; 
        $images->IMG_NAMA      = $foto; 
        $images->IMG_KET       = $originalName; 
        $images->IMG_DTINS     = $this->dateInsert;
        $images->IMG_DTUPDT    = $this->dateUpdate;
        $images->IMG_USERINS   = $idUser;
        $images->IMG_USERUPDT  = $idUser;

        $images->save();

        if($request->hiddenId != 0){
        	return redirect()->back()->with('message','Transaction Success');
    	}else{
    		return redirect('admin/event/index')->with('message','Transaction Success');
    	}
	}

	public function edit(Request $request, $id)
	{
		$sertifikasi = Sertifikasi::all();
		$event       = Event::where('EVT_ID', $id)->first();

		$event->EVT_DTDARI     = GenerateFormatDate::backFormatDate($event->EVT_DTDARI);
		$event->EVT_DTSAMPAI   = GenerateFormatDate::backFormatDate($event->EVT_DTSAMPAI);

		$data = array(
			'event'		=> $event,
			'sertifikasi' => $sertifikasi,
			'provinsi' => Provinsi::all(),
            'kabkot'   => Kabkot::where('id', $event->EVT_KABKOT)->first(),
            'kecamatan'=> Kecamatan::where('id', $event->EVT_KEC)->first(),
            'desa'     => Desa::where('id', $event->EVT_DESA)->first(),
            'image'    => Images::where('ID', $id)->first(),
		);
		return view('admin.event.edit')->with($data);
	}

	public function update(Request $request, $id)
	{
		$idUser = Auth::id();
		$request->validate([
			'evtNama' 		=> 'required',
			'evtTema' 		=> 'required',
			'evtPanitia' 	=> 'required',
			'evtKetPanitia' => 'required',
			'evtTlp'   	 	=> 'required',
			'evtWeb'		=> 'required',
			'evtDtDari'		=> 'required',
			'evtDtSampai'	=> 'required',
			'provinsi'		=> 'required',
			'kabkot'		=> 'required',
			'kecamatan'		=> 'required',
		]);

		$data = Event::where('EVT_ID', $id)->update([
			'SRT_ID'   	  => $request->srtId,
			'EVT_KODE' 	  => $this->kode,
			'EVT_NAMA' 	  => $request->evtNama,
			'EVT_TEMA' 	  => $request->evtTema,
			'EVT_PANITIA' 	  => $request->evtPanitia,
			'EVT_KETPANITIA' => $request->evtKetPanitia,
			'EVT_TLP' 		  => $request->evtTlp,
			'EVT_WEB'        => $request->evtWeb,
			'EVT_DTDARI'     => GenerateFormatDate::formatDate($request->evtDtDari),
			'EVT_DTSAMPAI'   => GenerateFormatDate::formatDate($request->evtDtSampai),
			'EVT_PROV'       => $request->provinsi,
			'EVT_KABKOT'     => $request->kabkot,
			'EVT_KEC'        => $request->kecamatan,
			'EVT_DESA'       => $request->desa,
			'EVT_LATI'       => $request->evtLati,
			'EVT_LONGI'      => $request->evtLongi,
			'EVT_ALMTDET'    => $request->evtAlmtDet,
			'EVT_KET'        => $request->evtKet,
			'EVT_DTUPDT'     => $this->dateUpdate,
			'EVT_USERUPDT'   => $idUser,
		]);

		//update images
        if($request->hasFile('evtImage')){

            $originalName    = $request->file('evtImage')->getClientOriginalName();
        
            $imageName = time().'.'.$request->evtImage->getClientOriginalExtension();
            $foto      = 'images/event/'.$imageName;

            $getImage = Images::where('ID', $id)->first();

            File::delete(public_path($getImage->IMG_NAMA));

            $request->evtImage->move(public_path('/images/event/'), $imageName);   
        }else{

            if($request->oldEvtImage == ""){
              $foto         = "";
              $originalName = "";
            }else{
              $foto         = $request->oldEvtImage;
              $originalName = $request->oldEvtImage;
            }
        }

        $rand = rand(1000, 9000);
        $images = Images::where('ID', $id)->update([

          'IMG_NAMA'      => $foto, 
          'IMG_KET'       => $originalName, 
          'IMG_DTUPDT'    => $this->dateUpdate,
          'IMG_USERUPDT'  => $idUser,

        ]);   

		return redirect('admin/event/index')->with('message','Transaction Success');
	}

	public function getData()
	{
		$event = Event::all();
		$data = Datatables::of($event)
				->addColumn('EVT_NAMA', function($row){
                     return $html = '<a href="#" data-href="'.url('admin/event/edit/').'" data-id="'.$row->EVT_ID.'" onclick="actionButton(this)">'.$row->EVT_NAMA.'</a>'; 
                })
				->editColumn('EVT_DTDARI', function ($event) {
	                 return $event->EVT_DTDARI ? with(new Carbon($event->EVT_DTDARI))->format('d/m/Y') : '';})
				->editColumn('EVT_DTSAMPAI', function ($event) {
	                 return $event->EVT_DTSAMPAI ? with(new Carbon($event->EVT_DTSAMPAI))->format('d/m/Y') : '';})
                ->addColumn('action', function($row){
                      $html = '<div class="text-center">
                                <a href="#" style="display:none" onclick="confirmLink(this)" data-href="'.url('admin/event/hapus/'.$row->EVT_ID).'" data-text="Your previous data will change" type="button" class="btn btn-danger btn-sm" title="delete"><i class="fa fa-trash"></i>
                                </a>
                                <a href="'.url('admin/event/tambah-ikm/'.$row->EVT_ID).'" type="button" class="btn btn-primary btn-sm" title="Tambah IKM"><i class="fa fa-institution"></i>
                                </a>
                                <a href="'.url('admin/event/generate-qr/'.$row->EVT_ID).'" target="blank" type="button" class="btn btn-default btn-sm" title="Generate QR Code"><i class="fa fa-qrcode"></i>
                                </a>
                            </div>
                            ';
                      return $html;
                  })
                  ->rawColumns(['EVT_NAMA','EVT_DTDARI','EVT_DTSAMPAI','sertifikasi','action','confirmed'])
                  ->make(true);

        return $data;
	}

	public function generateQr(Request $request, $id)
	{
		return QrCode::size(500)->generate($id);
	}

	public function createIkm(Request $request, $id)
	{
		$event = Event::where('EVT_ID', $id)->first();
		$ikm   = Ikm::with('ikmToEvent.event')->get();

		$ikmToEvent = IkmToEvent::where('EVT_ID', $id)->get();
		$data = array(
			'ikm'   => $ikm,
			'event' => $event,
			'ikmToEvent' => $ikmToEvent,
		);

		return view('admin.event.add-ikm')->with($data);
	}

	public function getDataIkmToEvent(Request $request, $id)
	{
		$ikm   = Ikm::with('ikmToEvent.event')->get();

		$data = Datatables::of($ikm)
				->addColumn('IKM_NAMA', function($ikm){
                     return $html = $ikm->IKM_NAMA; 
                })
				->addColumn('HISTORY_PELATIHAN', function($ikm){
					$html  = '<strong>Hadir</strong><br>';
					$html .= '<ol>';

					foreach($ikm->ikmToEvent as $itemIkmToEvent){
							$html .= '<ol>';
							if($itemIkmToEvent->ITE_HADIR == 1){
								$html .= '<li>'.$itemIkmToEvent->event['EVT_NAMA'].'</li>';
							}
							$html .= '</ol>'; 
					}

					$html .= '</ol>'; 
					$html .= '<strong>Tidak Hadir</strong>';
					foreach($ikm->ikmToEvent as $itemIkmToEvent){
							$html .= '<ol>';
							if($itemIkmToEvent->ITE_HADIR == 2){
								$html .= '<li>'.$itemIkmToEvent->event['EVT_NAMA'].'</li>';
							}
							$html .= '</ol>'; 
					}
                    return $html;
                })
                ->addColumn('UNDANGAN', 'admin.event.action-undangan')
                ->rawColumns(['IKM_NAMA','HISTORY_PELATIHAN','UNDANGAN','confirmed'])
                ->make(true);

        return $data;
	}

	public function cetakLaporan(Request $request)
    {
        $type  = "xlsx";
        $array = explode('-', $request->daterange);
        
        $startDate  = Carbon::parse($array[0])->format('Y-m-d');
        $endDate    = Carbon::parse($array[1])->format('Y-m-d');

        $datas = Event::where('EVT_DTINS', '>=', $startDate)->where('EVT_DTINS', '<=', $endDate)->get();
        
        $no = 1;
        foreach($datas as $item){
            $provinsi    = Provinsi::where('id', $item->EVT_PROV)->first();
            $kabupaten   = Kabkot::where('id', $item->EVT_KABKOT)->first();
            $kecamatan   = Kecamatan::where('id', $item->EVT_KEC)->first();

            $data[] = array(
                'No'             => $no,
                'Nama Event'     => $item->EVT_NAMA,
                'Panitia'     	 => $item->EVT_PANITIA,
                'Ketua Panitia'  => $item->EVT_KETPANITIA,
                'Tema'  		 => $item->EVT_TEMA,
                'Telp'  		 => $item->EVT_TLP,
                'Web'  		 	 => $item->EVT_WEB,
                'Tanggal Mulai'  => $item->EVT_DTDARI,
                'Tanggal Berakhir'=> $item->EVT_DTSAMPAI,
                'Provinsi'       => $provinsi->name,
                'Kabupaten/Kota' => $kabupaten->name,
                'Kecamatan'      => $kecamatan->name,
                'Alamat'		 => $item->EVT_ALMTDET,
                'Keterangan'	 => $item->EVT_KET,
            );
            $no++;
        }

        if($datas->count() > 0){

            return \Excel::create('event', function($excel) use ($data) {
                $excel->sheet('event', function($sheet) use ($data)
                {
                    $sheet->fromArray($data);
                });
            })->download($type);

        }else{
            return redirect('admin/event/index')->with('message-failed','Transaction Success');
        }
    } 
}
