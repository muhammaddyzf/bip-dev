@extends('layouts.app-admin')
@section('title', 'Event')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Event</h1>
{{ Breadcrumbs::render('event') }}

<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<a href="{{route('admin.event.tambah-event')}}" class="btn btn-white"><i class="fa fa-plus"></i> Tambah </a>
				<table class="table table-bordered table-striped" id="event">
					<thead>
						<tr>
							<th class="text-center">Nama Event</th>
							<th class="text-center">Tema</th>
							<th class="text-center">Tanggal Mulai</th>
							<th class="text-center">Tanggal Berakhir</th>
							<th class="text-center">Proses</th>
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
    $('#event').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! url('admin/event/data-event') !!}',
        columns: [
            { data: 'EVT_NAMA', name: 'EVT_NAMA' },
            { data: 'EVT_TEMA', name: 'EVT_TEMA' },
            { data: 'EVT_DTDARI', name: 'EVT_DTDARI' },
            { data: 'EVT_DTSAMPAI', name: 'EVT_DTSAMPAI' },
            { data: 'action', name: 'action' },
        ]
    });
});
</script>
@endpush