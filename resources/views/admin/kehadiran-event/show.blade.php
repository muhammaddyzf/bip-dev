@extends('layouts.app-admin')
@section('title', 'Kehadiran IKM')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Kehadiran IKM </h1>
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
				<div class="row">
					<div class="col-md-6">
						
					</div>
					<div class="col-md-6">
						<div class="pull-right">
							<form class="form-inline" role="form" action="{{ route('kehadiran-event.cetak-laporan') }}" method="post">@csrf
							 	{{-- <div class="form-group @if($errors->has('daterange')) has-danger @endif">
									<input type="text" class="form-control" id="dates" placeholder="Tanggal" name="daterange" required="">
									<span class="ma-form-highlight"></span>
									<span class="ma-form-bar"></span>
								</div> --}}

								<input type="hidden" name="event_id" value="{{$event->EVT_ID}}">

								<button type="submit" class="btn btn-white"><i class="fa fa-download"></i> Cetak Laporan </button>
							</form>
						</div>
					</div>
				</div>
				
				<br>
				<table class="table table-bordered table-striped" id="ikm-to-event">
					<thead>
						<tr>
							<th class="text-center">Nama IKM</th>
							<th class="text-center">Nama Pemilik</th>
							<th class="text-center">Provinsi</th>
							<th class="text-center">Kabupaten/Kota</th>
							<th class="text-center">Kecamatan</th>
							<th class="text-center">Desa</th>
							<th class="text-center">Status Kehadiran</th>
						</tr>
					</thead>
					<tbody>
						@foreach($ikmToEvent as $item)
						<tr>
							<td><a href="{{ url('admin/kehadiran-event/edit/'.$item->EVT_ID.'/'.$item->IKM_ID) }}">{{ $item->IKM_NAMA }}</a></td>
							<td>{{ $item->IKM_PEMILIK }}</td>
							<td>{{ $item->provinsi }}</td>
							<td>{{ $item->kabkot }}</td>
							<td>{{ $item->kecamatan }}</td>
							<td>{{ $item->desa }}</td>
							<td><span class='label {{ $item->label_kehadiran }}'>{{ $item->kehadiran }}</span></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
