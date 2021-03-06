@extends('layouts.app-admin')
@section('title', 'Edit Event')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Event</h1>
{{ Breadcrumbs::render('edit-event', $event) }}


<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<form action="{{url('admin/event/update/'. $event->EVT_ID)}}" method="post" id="form-event" enctype="multipart/form-data">
					@csrf	
					<input type="hidden" name="hiddenId" value="0">
					<div class="form-group @if($errors->has('ktprdkId')) has-danger @endif">
						<label>Nama Sertifikasi</label>
						<div class="form-group">
			                <select style="width: 100%;" name="srtId" class="form-control">
			                	<option value="">(Pilih)</option>
			                    @foreach($sertifikasi as $item)
									<option value="{{ $item->SRT_ID }}"
										@if ($item->SRT_ID == old('srtId', $event->SRT_ID))
										selected="selected"
										@endif
										>{{ $item->SRT_NAMA }}</option>
			                    @endforeach
			                </select>
			            </div>
					</div>

					<div class="form-group form-control-material @if($errors->has('evtNama')) has-danger @endif">
						<input type="text" class="form-control" id="evtNama" placeholder="Nama Event" name="evtNama" value="{{ old('evtNama', $event->EVT_NAMA) }}">
						<label>Nama Event</label>
					</div>
					<div class="form-group form-control-material @if($errors->has('evtTema')) has-danger @endif">
						<input type="text" class="form-control" id="evtTema" placeholder="Tema" name="evtTema" value="{{ old('evtTema', $event->EVT_TEMA) }}">
						<label>Tema</label>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('evtPanitia')) has-danger @endif">
								<input type="text" class="form-control" id="evtPanitia" placeholder="Panitia" name="evtPanitia" value="{{ old('evtPanitia', $event->EVT_PANITIA) }}">
								<label>Panitia</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('evtKetPanitia')) has-danger @endif">
								<input type="text" class="form-control" id="evtKetPanitia" placeholder="Ketua Panitia" name="evtKetPanitia" value="{{ old('evtKetPanitia', $event->EVT_KETPANITIA) }}">
								<label>Ketua Panitia</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('evtTlp')) has-danger @endif">
								<input type="text" class="form-control" id="evtTlp" placeholder="Telephone" name="evtTlp" value="{{ old('evtTlp', $event->EVT_TLP) }}">
								<label>Telephone</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('evtWeb')) has-danger @endif">
								<input type="text" class="form-control" id="evtWeb" placeholder="Webiste" name="evtWeb" value="{{ old('evtWeb', $event->EVT_WEB) }}">
								<label>Website</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('evtDtDari')) has-danger @endif">
								<input type="text" class="form-control datepicker" id="evtDtDari" readonly="" placeholder="Tanggal Mulai" name="evtDtDari" value="{{ old('evtDtDari', $event->EVT_DTDARI) }}">
								<label>Tanggal mulai</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('evtDtSampai')) has-danger @endif">
								<input type="text" class="form-control datepicker" id="evtDtSampai" readonly="" placeholder="Tanggal Berakhir" name="evtDtSampai" value="{{ old('evtDtSampai', $event->EVT_DTSAMPAI) }}">
								<label>Tanggal Berakhir</label>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-3">
							<div class="form-group form-control-material @if($errors->has('provinsi')) has-danger @endif">
								<select name="provinsi" class="form-control">
									<option value="">(Pilih)</option>
									@foreach ($provinsi as $dataProvinsi)
									<option value="{{ $dataProvinsi->id }}"
										@if ($dataProvinsi->id == old('provinsi', $event->EVT_PROV))
										selected="selected"
										@endif
										>{{ $dataProvinsi->name }}</option>
									@endforeach
								</select>

								<label>Provinsi</label>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group form-control-material @if($errors->has('kabkot')) has-danger @endif">	
								<select name="kabkot" class="form-control">
									<option value="{{ $kabkot->id }}">{{ $kabkot->name }}</option>
								</select>
								<label>Kabkot</label>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group form-control-material @if($errors->has('kecamatan')) has-danger @endif">	
								<select name="kecamatan" class="form-control">
									<option value="{{ $kecamatan->id }}">{{ $kecamatan->name }}</option>
								</select>
								<label>Kecamatan</label>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group form-control-material @if($errors->has('desa')) has-danger @endif">	
								<select name="desa" class="form-control">
									<option value="{{ $desa->id }}">{{ $desa->name }}</option>
								</select>
								<label>Desa</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('evtLati')) has-danger @endif">
								<input type="text" class="form-control" id="evtLati" placeholder="Latitude" name="evtLati"value="{{ old('evtLati', $event->EVT_LATI) }}">
								<label>Latitude</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('evtLongi')) has-danger @endif">
								<input type="text" class="form-control" id="evtLongi" placeholder="Longitude" name="evtLongi" value="{{ old('evtLongi', $event->EVT_LONGI) }}">
								<label>Longitude</label>
							</div>
						</div>
					</div>


					<div class="form-group form-control-material @if($errors->has('evtAlmtDet')) has-danger @endif">
						<textarea class="form-control" id="evtAlmtDet" name="evtAlmtDet">{{ old('evtAlmtDet', $event->EVT_ALMTDET) }}</textarea>
						<label>Alamat</label>
					</div>

					<div class="form-group form-control-material @if($errors->has('evtKet')) has-danger @endif">
						<textarea class="form-control" id="evtKet" name="evtKet">{{ old('evtKet', $event->EVT_KET) }}</textarea>
						<label>Keterangan</label>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('evtImage')) has-danger @endif">
								<input type="file" class="form-control" id="evtImage" placeholder="Image" name="evtImage">
							</div>
						</div>
						<div class="col-md-6">
							@if($image->IMG_NAMA != "")
								<img src="{{ asset($image->IMG_NAMA) }}" width="400px">
							@endif
							<input type="hidden" name="oldEvtImage" value="{{ $image->IMG_NAMA }}">
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
		confirmStore('btn-save','form-event',"Your previous data will change");
	});
</script>
@endpush