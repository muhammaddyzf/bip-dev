<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IkmToEvent;
use App\GenerateFormatDate;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Ikm;
use App\Event;
use App\Notifications;

class IkmToEventController extends Controller
{
	public function __construct(Request $request)
    {
        $rand = rand(1000, 9000);
        $this->id        = 'ITEID'.$rand.date('His');
        $this->kode      = $rand.date('His');
        $this->dateInsert= date('Y-m-d H:i:s');
        $this->dateUpdate= date('Y-m-d H:i:s');
    }

	public function create(Request $request, $id)
	{
		$event = Event::where('EVT_ID', $id)->first();
		$ikm   = Ikm::with('ikmToEvent.event')->get();

		$data = array(
			'ikm'   => $ikm,
			'event' => $event
		);
		return view('user.ikm-to-event.add')->with($data);
	}

	public function kirimUndangan(Request $request)
	{
		$idUser  = Auth::id();
		$idIkm   = $request->idIkm;
		$idEvent = $request->idEvent;

		if($request->idSend > 0){	

			$cekEvent = IkmToEvent::where('IKM_ID', $idIkm)
					->where('EVT_ID', $idEvent)
					->first();		

			if(!isset($cekEvent)){
				$data = new IkmToEvent;
				$data->ITE_ID      = $this->id;
				$data->EVT_ID      = $idEvent;
				$data->IKM_ID      = $idIkm;
				$data->PNG_ID 	   = '';
				$data->ITE_HADIR   = 0;
				$data->ITE_PLNG    = $this->dateInsert;		
				$data->ITE_DTNG    = $this->dateInsert;
				$data->ITE_NILAI   = 0;
				$data->ITE_LONGI   = '';
				$data->ITE_LATI    = '';
				$data->ITE_DTINS   = $this->dateInsert;
		        $data->ITE_DTUPDT  = $this->dateUpdate;
		        $data->ITE_USERINS = $idUser;
		        $data->ITE_USERUPDT= $idUser;
			    $data->save();

			    Notifications::mailInvitation($idUser, $idIkm, $idEvent);
	        }
	    }else{
	    	IkmToEvent::where('IKM_ID', $idIkm)
					->where('EVT_ID', $idEvent)
					->delete();
	    }

        return json_encode(1);
	}
}
