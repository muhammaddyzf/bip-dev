@extends('layouts.app-admin')
@section('title', 'Tambah Sertifikasi IKM')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Sertifikasi</h1>
{{ Breadcrumbs::render('tambah-sertifikasi-ikm') }}


<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<form action="{{url('user/sertifikasi/simpan-ikm')}}" method="post" id="form-sertifikasi-ikm" enctype="multipart/form-data">
					@csrf
							
					<div class="row">
						<div class="col-md-12">
							<div class="form-group form-control-material @if($errors->has('srtId')) has-danger @endif">
								<input type="hidden" name="srtId" value="{{$sertifikasi->SRT_ID}}">
								<input type="text" class="form-control" id="srtId" readonly="" placeholder="Nama Sertifikasi" value="{{$sertifikasi->SRT_NAMA}}">
								<label>Nama Sertifikasi</label>
							</div>
						</div>
					</div>

					<div class="form-group">
					<label>IKM</label>
	                <select multiple="multiple" style="width: 100%;" data-toggle="select2" data-placeholder="Select a Ikm .." data-allow-clear="true" name="ikm[]">
	                  <optgroup label="(Pilih Data IKM)">
	                  	@foreach($ikm as $item)
	                    <option value="{{$item->IKM_ID}}">{{$item->IKM_NAMA}}</option>
	                    @endforeach
	                  </optgroup>
	                </select>
	              </div>

					<div class="row">
						<div class="col-md-3">
							<div class="form-group form-control-material @if($errors->has('dtDaftar')) has-danger @endif">
								<input type="text" class="form-control datepicker" id="dtDaftar" readonly="" placeholder="Tanggal Daftar" name="dtDaftar">
								<label>Tanggal Daftar</label>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group form-control-material @if($errors->has('dtAcc')) has-danger @endif">
								<input type="text" class="form-control datepicker" id="dtAcc" readonly="" placeholder="Tanggal ACC" name="dtAcc">
								<label>Tanggal ACC</label>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group form-control-material @if($errors->has('dtDari')) has-danger @endif">
								<input type="text" class="form-control datepicker" id="dtDari" readonly="" placeholder="Tanggal Masa Berlaku Dari" name="dtDari">
								<label>Masa Berlaku Dari</label>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group form-control-material @if($errors->has('dtSampai')) has-danger @endif">
								<input type="text" class="form-control datepicker" id="dtSampai" readonly="" placeholder="Tanggal Masa Berlaku Sampai" name="dtSampai">
								<label>Masa Berlaku Sampai</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('itsKet')) has-danger @endif">
								<textarea class="form-control" id="itsKet" name="itsKet"></textarea>
								<label>Keterangan</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group @if($errors->has('acc')) has-danger @endif">
								<label>Status ACC</label><br>
								<div class="radio radio-info radio-inline">
									<input type="radio" id="inlineRadio1" value="1" name="acc" checked="">
									<label for="inlineRadio1">Ya</label>
								</div>
								<div class="radio radio-inline">
									<input type="radio" id="inlineRadio2" value="0" name="acc">
									<label for="inlineRadio2">Tidak</label>
								</div>
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
		confirmStore('btn-save','form-sertifikasi-ikm',"Your previous data will change");
	});
</script>
@endpush