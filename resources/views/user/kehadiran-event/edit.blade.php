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
				<form action="{{url('admin/kehadiran-event/update/'.$ikmToEvent->EVT_ID.'/'.$ikmToEvent->IKM_ID)}}" method="post" id="form-kehadiran-ikm">
					@csrf
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
						<div class="form-group form-control-material @if($errors->has('srtId')) has-danger @endif">
							<input type="text" class="form-control" id="srtId" readonly="" placeholder="Nama Event" value="{{ $ikmToEvent->IKM_NAMA}}">
							<label>NAMA IKM</label>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-control-material @if($errors->has('srtId')) has-danger @endif">
							<input type="text" class="form-control" id="srtId" readonly="" placeholder="Nama Event" value="{{ $ikmToEvent->IKM_PEMILIK}}">
							<label>Nama Pemilik</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group form-control-material @if($errors->has('srtId')) has-danger @endif">
							<input type="text" class="form-control" id="srtId" readonly="" placeholder="Nama Event" value="{{ $ikmToEvent->provinsi}}">
							<label>Provinsi</label>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-control-material @if($errors->has('srtId')) has-danger @endif">
							<input type="text" class="form-control" id="srtId" readonly="" placeholder="Nama Event" value="{{ $ikmToEvent->kabkot}}">
							<label>Kabupaten</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group form-control-material @if($errors->has('srtId')) has-danger @endif">
							<input type="text" class="form-control" id="srtId" readonly="" placeholder="Nama Event" value="{{ $ikmToEvent->kecamatan}}">
							<label>Kecamatan</label>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-control-material @if($errors->has('srtId')) has-danger @endif">
							<input type="text" class="form-control" id="srtId" readonly="" placeholder="Nama Event" value="{{ $ikmToEvent->desa}}">
							<label>Desa</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group form-control-material @if($errors->has('ITE_NILAI')) has-danger @endif">
							<input type="number" class="form-control" id="ITE_NILAI" name="ITE_NILAI" placeholder="Nilai" value="{{ old('ITE_NILAI', $ikmToEvent->ITE_NILAI) }}">
							<label>Nilai</label>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group  @if($errors->has('ITE_HADIR')) has-danger @endif">
							<label>Kehadiran</label>
							<select name="ITE_HADIR" class="form-control">
								@php
									$belumDatang = "";
									$hadir = "";
									$tidakHadir = "";
									if($ikmToEvent->ITE_HADIR == 0){
										$belumDatang = "selected";
									}elseif($ikmToEvent->ITE_HADIR == 1){
										$hadir = "selected";
									}elseif($ikmToEvent->ITE_HADIR == 1){
										$tidakHadir = "selected";
									}
								@endphp
								<option value="">(Pilih)</option>
								<option value="0" {{ $belumDatang }}>Belum Datang</option>
								<option value="1" {{ $hadir }}>Hadir</option>
								<option value="2" {{ $tidakHadir }}>Tidak Hadir</option>
							</select>
						</div>
					</div>
				</div>
				
					<button type="button" id="btn-save" class="btn btn-primary"><i class="fa fa-save"></i> SIMPAN</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection


@push('scripts')
<script type="text/javascript">
	$(function(){
		confirmStore('btn-save','form-kehadiran-ikm',"Your previous data will change");
	});
</script>
@endpush
