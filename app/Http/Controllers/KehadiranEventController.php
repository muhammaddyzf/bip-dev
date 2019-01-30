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

class KehadiranEventController extends Controller
{
	public function index()
	{
		return view('admin.kehadiran-event.index');
	}

	public function getData()
	{
		$event = Event::all();
		$data = Datatables::of($event)
				->addColumn('EVT_NAMA', function($row){
                     return $html = '<a href="#" data-href="'.url('admin/kehadiran-event/show/').'" data-id="'.$row->EVT_ID.'" onclick="actionButton(this)">'.$row->EVT_NAMA.'</a>'; 
                })
				->editColumn('EVT_DTDARI', function ($event) {
	                 return $event->EVT_DTDARI ? with(new Carbon($event->EVT_DTDARI))->format('d/m/Y') : '';})
				->editColumn('EVT_DTSAMPAI', function ($event) {
	                 return $event->EVT_DTSAMPAI ? with(new Carbon($event->EVT_DTSAMPAI))->format('d/m/Y') : '';})
                ->addColumn('action', function($row){
                      $html = '<div class="text-center">
                                <a href="#" style="display:none" onclick="confirmLink(this)" data-href="'.url('admin/event/hapus/'.$row->EVT_ID).'" data-text="Your previous data will change" type="button" class="btn btn-danger btn-sm" title="delete"><i class="fa fa-trash"></i>
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

	public function show($id)
	{
		$event 		= Event::where('EVT_ID', $id)->first();
		$ikmToEvent = IkmToEvent::kehadiranEventIkm($id);

		return view('admin.kehadiran-event.show', compact('ikmToEvent', 'event'));
	}

	public function edit($idEvent, $idIkm)
	{
		$event 		= Event::where('EVT_ID', $idEvent)->first();
		$ikmToEvent = IkmToEvent::getKehadiranEventIkm($idEvent, $idIkm);
		return view('admin.kehadiran-event.edit', compact('ikmToEvent', 'event'));
	}

	public function update(Request $request, $idEvent, $idIkm)
	{	
		$ikmToEvent = IkmToEvent::where('EVT_ID', $idEvent)->where('IKM_ID', $idIkm)
						->update([
							'ITE_HADIR' => $request->ITE_HADIR,
							'ITE_NILAI' => $request->ITE_NILAI
						]);

		return back()->with('message','Transaction Success');
	}
}
