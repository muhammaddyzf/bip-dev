<div class="text-center">
    @php
    $id = request()->segment(count(request()->segments()));
    $ikmToEvent = App\IkmToEvent::where('EVT_ID', $id)->get();
    $event      = App\Event::where('EVT_ID', $id)->first();

    $currentDate = date('Y-m-d');
    $disableButton = "";

    if($currentDate > $event->EVT_DTSAMPAI){
        $disableButton = "disabled";
    }

    $defaultButton = '<a href="#" '.$disableButton.' id-send="1" id-ikm="'.$IKM_ID.'" onclick="sendInvitation(this)" data-href="'.url('admin/ikm-to-event/kirim-undangan').'" data-text="Apakah kamu akan mengirim undangan kepada IKM ini ?" type="button" class="btn btn-success btn-sm" title="Kirim Undangan"><i class="fa fa-envelope"></i> Kirim Undangan
    </a> ';

    foreach($ikmToEvent as $itemIkmToEvent){

    	if($itemIkmToEvent->IKM_ID == $IKM_ID){
    		$defaultButton = '<a href="#" '.$disableButton.' id-send="0" id-ikm="'.$IKM_ID.'" onclick="cancelInvitation(this)" data-href="'.url('admin/ikm-to-event/kirim-undangan').'" data-text="Apakah kamu akan membatalkan undangan kepada IKM ini ?" type="button" class="btn btn-warning btn-sm" title="Batalkan Undangan"><i class="fa fa-close"></i> Batal Undangan
    		</a>';
    	}
    }
        echo $defaultButton;
    @endphp
</div>

