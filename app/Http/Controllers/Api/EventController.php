<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Ikm;
use App\Event;
use App\IkmToEvent;
use App\GenerateFormatDate;

class EventController extends Controller
{
	public function index(Request $request, $id, $keyword)
	{
		$agendaIkm = IkmToEvent::getAgendaIkm($id, $keyword);

		foreach($agendaIkm as $itemAgendaIkm){
			$dataAgendaIkm[] = array(
			  'id_ikm'       => $itemAgendaIkm->IKM_ID,	
	 	      'id_pelatihan' => $itemAgendaIkm->id_pelatihan,
		      'nama' 		 => $itemAgendaIkm->nama,
		      'panitia' 	 => $itemAgendaIkm->panitia,
		      'tgl_dari' 	 => $itemAgendaIkm->tgl_dari,
		      'tgl_sampai' 	 => $itemAgendaIkm->tgl_sampai,
		      'provinsi' 	 => $itemAgendaIkm->provinsi,
		      'kabkot' 		 => $itemAgendaIkm->kabkot,
		      'kecamatan' 	 => $itemAgendaIkm->kecamatan,
		      'desa' 		 => $itemAgendaIkm->desa,
		      'alamat_detail'=> $itemAgendaIkm->alamat_detail,
		      'latitude' 	 => $itemAgendaIkm->latitude,
		      'longitude' 	 => $itemAgendaIkm->longitude,
		      'tema' 		 => $itemAgendaIkm->tema,
		      'hadir' 		 => $itemAgendaIkm->hadir
		      );	
		}

		if($agendaIkm->count() > 0){
			$res['is_ok']   = true;
            $res['message'] = 'Success';
            $res['data']    = $dataAgendaIkm;
		}else{
			$res['is_ok']   = false;
            $res['message'] = 'No Result Data';
		}

		return response($res);
	}

	public function show(Request $request, $id)
	{
		$agendaIkm = IkmToEvent::getDetailAgendaIkm($id);

		if($agendaIkm){

			$dataAgendaIkm = array(
			      'id_pelatihan' => $agendaIkm->id_pelatihan,
			      'nama' 		 => $agendaIkm->nama,
			      'panitia' 	 => $agendaIkm->panitia,
			      'tgl_dari' 	 => $agendaIkm->tgl_dari,
			      'tgl_sampai' 	 => $agendaIkm->tgl_sampai,
			      'provinsi' 	 => $agendaIkm->provinsi,
			      'kabkot' 		 => $agendaIkm->kabkot,
			      'kecamatan' 	 => $agendaIkm->kecamatan,
			      'desa' 		 => $agendaIkm->desa,
			      'alamat_detail'=> $agendaIkm->alamat_detail,
			      'latitude' 	 => $agendaIkm->latitude,
			      'longitude' 	 => $agendaIkm->longitude,
			      'tema' 		 => $agendaIkm->tema,
			      'hadir' 		 => $agendaIkm->hadir
			      );

			$res['is_ok']   = true;
            $res['message'] = 'Success';
            $res['data']    = $dataAgendaIkm;
		}else{
			$res['is_ok']   = false;
            $res['message'] = 'No Result Data';
		}

		return response($res);
	}

	public function scan(Request $request)
	{
		$idEvent = $request->post('id_pelatihan');
		$idIkm   = $request->post('id_ikm');

		$cek = IkmToEvent::where('EVT_ID', $idEvent)
				->where('IKM_ID', $idIkm)
				->get();

		if($cek->count() > 0){
			$data = IkmToEvent::where('EVT_ID', $idEvent)
					->where('IKM_ID', $idIkm)->update([
						'ITE_HADIR'     => 1,
						'ITE_DTNG'      => date('Y-m-d H:i:s'),
						'ITE_DTUPDT'    => date('Y-m-d H:i:s'),
					]);
			
			$agendaIkm = IkmToEvent::getScanAgendaIkm($idEvent, $idIkm);
						
			if($agendaIkm){
				$dataAgendaIkm = array(
				      'id_pelatihan' => $agendaIkm->id_pelatihan,
				      'nama' 		 => $agendaIkm->nama,
				      'panitia' 	 => $agendaIkm->panitia,
				      'tgl_dari' 	 => $agendaIkm->tgl_dari,
				      'tgl_sampai' 	 => $agendaIkm->tgl_sampai,
				      'provinsi' 	 => $agendaIkm->provinsi,
				      'kabkot' 		 => $agendaIkm->kabkot,
				      'kecamatan' 	 => $agendaIkm->kecamatan,
				      'desa' 		 => $agendaIkm->desa,
				      'alamat_detail'=> $agendaIkm->alamat_detail,
				      'latitude' 	 => $agendaIkm->latitude,
				      'longitude' 	 => $agendaIkm->longitude,
				      'tema' 		 => $agendaIkm->tema,
				      'hadir' 		 => $agendaIkm->hadir
				      );

				$res['is_ok']   = true;
	            $res['message'] = 'Success';
	            $res['data']    = $dataAgendaIkm;
			}else{
				$res['is_ok']   = false;
	            $res['message'] = 'No Result Data';
			}

		}else{
			$res['is_ok']   = false;
	        $res['message'] = 'Anda tidak terdaftar pada kegiatan ini';
		}

		return response($res);
	}
}
