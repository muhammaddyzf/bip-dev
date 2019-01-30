@extends('layouts.app-admin')
@section('title', 'Edit Sertifikasi')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Edit Sertifikasi</h1>
{{-- {{ Breadcrumbs::render('tambah-sertifikasi') }} --}}


<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<form action="{{url('admin/sertifikasi/update/'. $sertifikasi->SRT_ID)}}" method="post" id="form-sertifikasi" enctype="multipart/form-data">
					@csrf
					<div class="form-group @if($errors->has('ktsrtkId')) has-danger @endif">
						<label>Kategori Sertifikasi</label>
						<div class="form-group">
			                <select style="width: 100%;" data-toggle="select2" name="ktsrtId">
			                	<option>(Pilih)</option>
			                    @foreach($kategoriSertifikasi as $ktsrt)
			                    	<option value="{{$ktsrt->KTSRT_ID}}"
			                    	@if ($sertifikasi->KTSRT_ID == old('ktsrtId', $sertifikasi->KTSRT_ID))
			                    	selected="selected"
			                    	@endif
			                    	>{{$ktsrt->KTSRT_NAMA}}</option>
			                    @endforeach
			                </select>
			            </div>
					</div>			
					<div class="row">
						<div class="col-md-12">
							<div class="form-group form-control-material @if($errors->has('srtNama')) has-danger @endif">
								<input type="text" class="form-control" id="srtNama" placeholder="Nama Sertifikasi" name="srtNama" value="{{ $sertifikasi->SRT_NAMA }}">
								<label>Nama Sertifikasi</label>
							</div>
						</div>
					</div>

					<div class="form-group form-control-material @if($errors->has('srtSyarat')) has-danger @endif">
						<textarea class="form-control" id="srtSyarat" name="srtSyarat">{{ $sertifikasi->SRT_SYARAT }}</textarea>
						<label>Syarat</label>
					</div>

					<div class="form-group form-control-material @if($errors->has('srtSpek')) has-danger @endif">
						<textarea class="form-control" id="srtSpek" name="srtSpek">{{ $sertifikasi->SRT_SPEK }}</textarea>
						<label>Spesifikasi</label>
					</div>

					<div class="form-group form-control-material @if($errors->has('srtKet')) has-danger @endif">
						<textarea class="form-control" id="srtKet" name="srtKet">{{ $sertifikasi->SRT_KET }}</textarea>
						<label>Keterangan</label>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('srtBobot')) has-danger @endif">
								<input type="number" class="form-control" id="srtBobot" placeholder="Bobot" name="srtBobot" value="{{ $sertifikasi->SRT_BOBOT }}">
								<label>Bobot</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group @if($errors->has('event')) has-danger @endif">
								<label>Status Event</label><br>
								@php
									$ya = "";
									$tidak = "";
									if($sertifikasi->SRT_NEEDEVENT == 1){
										$ya = "checked";
									}else
									if($sertifikasi->SRT_NEEDEVENT == 0){
										$tidak = "checked";
									}
								@endphp
								<div class="radio radio-info radio-inline">
									<input type="radio" id="inlineRadio1" value="1" name="event" {{ $ya }}>
									<label for="inlineRadio1">Ya</label>
								</div>
								<div class="radio radio-inline">
									<input type="radio" id="inlineRadio2" value="0" name="event" {{ $tidak }}>
									<label for="inlineRadio2">Tidak</label>
								</div>
							</div>
						</div>
					</div>

{{-- 					<div class="form-group form-control-material @if($errors->has('srtImage')) has-danger @endif">
						<input type="file" class="form-control" id="srtImage" placeholder="Image" name="lampiran">
					</div> --}}

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
		confirmStore('btn-save','form-sertifikasi',"Your previous data will change");
	});
</script>
@endpush