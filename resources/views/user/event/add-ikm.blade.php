@extends('layouts.app-admin')
@section('title', 'Tambah IKM')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Kirim Undangan Untuk IKM</h1>
{{-- {{ Breadcrumbs::render('tambah-ikm-to-event') }} --}}

<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
						<input type="hidden" value="{{$event->EVT_ID}}" id="id-event">
						<div class="form-group form-control-material @if($errors->has('srtId')) has-danger @endif">
							<input type="text" class="form-control" id="srtId" readonly="" placeholder="Nama Event" value="{{$event->EVT_NAMA}}">
							<label>Nama Event</label>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-control-material @if($errors->has('srtId')) has-danger @endif">
							<input type="text" class="form-control" id="srtId" readonly="" placeholder="Nama Event" value="{{$event->EVT_TEMA}}">
							<label>Tema Event</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group form-control-material @if($errors->has('srtId')) has-danger @endif">
							<input type="text" class="form-control" id="srtId" readonly="" placeholder="Nama Event" value="{{date('d/m/Y', strtotime($event->EVT_DTDARI))}}">
							<label>Tanggal Mulai</label>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-control-material @if($errors->has('srtId')) has-danger @endif">
							<input type="text" class="form-control" id="srtId" readonly="" placeholder="Nama Event" value="{{date('d/m/Y', strtotime($event->EVT_DTSAMPAI))}}">
							<label>Tanggal Berakhir</label>
						</div>
					</div>
				</div>

				<table class="table table-bordered table-striped" id="ikm-to-event">
					<thead>
						<tr>
							<th class="text-center">Nama IKM</th>
							<th class="text-center">History Pelatihan</th>
							<th class="text-center">Kirim Undangan Pelatihan</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection


@push('scripts')
<script type="text/javascript">
$(function() {
    $('#ikm-to-event').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! url('user/event/data-ikmToEvent/'. $event->EVT_ID) !!}',
        columns: [
            { data: 'IKM_NAMA', name: 'IKM_NAMA' },
            { data: 'HISTORY_PELATIHAN', name: 'HISTORY_PELATIHAN' },
            { data: 'UNDANGAN', name: 'UNDANGAN' },
        ]
    });
});
</script>
@endpush

@push('scripts')
<script type="text/javascript">
	$(function(){
		confirmStore('btn-save','form-ikm-to-event',"Your previous data will change");
	});

	function cancelInvitation(el)
	{
	  var url 	  = $(el).attr('data-href');
      var idIkm   = $(el).attr('id-ikm');
      var idSend  = $(el).attr('id-send');
      var idEvent = $('#id-event').val();
      var textConfrim = $(el).attr('data-text');
      swal({
          title: "Apakah kamu yakin?",
          text: textConfrim,
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((action) => {
          if (action) {
          	$.ajax({
          		url      :  url,
          		type     : 'post',
          		dataType : 'json',
          		data : {idIkm : idIkm, idEvent : idEvent, idSend : idSend},
                   headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                success	 : function(data){
                	swal({
			        		title: "Transaction Success",
			        		text: "Undangan Berhasil Dikirim",
			        		icon: "success",
			        		button: "OK",
			        	});
                	location.reload(true);
                }
          	});
          } else {
            return false;
          }
        });
	}

	function sendInvitation(el)
    {
      var url 	  = $(el).attr('data-href');
      var idIkm   = $(el).attr('id-ikm');
      var idSend  = $(el).attr('id-send');
      var idEvent = $('#id-event').val();
      var textConfrim = $(el).attr('data-text');
      swal({
          title: "Apakah kamu yakin?",
          text: textConfrim,
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((action) => {
          if (action) {
          	$.ajax({
          		url      :  url,
          		type     : 'post',
          		dataType : 'json',
          		data : {idIkm : idIkm, idEvent : idEvent, idSend : idSend},
                   headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                success	 : function(data){
                	swal({
			        		title: "Transaction Success",
			        		text: "Undangan Berhasil Dikirim",
			        		icon: "success",
			        		button: "OK",
			        	});
                	location.reload(true);
                }
          	});
          } else {
            return false;
          }
        });

      //return el.preventDefault();
    }
</script>
@endpush