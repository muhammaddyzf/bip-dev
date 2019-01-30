@extends('layouts.app-admin')
@section('title', 'Tambah Sertifikasi')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Sertifikasi</h1>
{{ Breadcrumbs::render('tambah-sertifikasi') }}


<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<form action="{{url('admin/sertifikasi/simpan')}}" method="post" id="form-sertifikasi" enctype="multipart/form-data">
					@csrf
					<div class="form-group @if($errors->has('ktsrtkId')) has-danger @endif">
						<label>Kategori Sertifikasi</label>
						<div class="form-group">
			                <select style="width: 100%;" data-toggle="select2" name="ktsrtId">
			                	<option>(Pilih)</option>
			                    @foreach($kategoriSertifikasi as $ktsrt)
			                    	<option value="{{$ktsrt->KTSRT_ID}}">{{$ktsrt->KTSRT_NAMA}}</option>
			                    @endforeach
			                </select>
			            </div>
					</div>			
					<div class="row">
						<div class="col-md-12">
							<div class="form-group form-control-material @if($errors->has('srtNama')) has-danger @endif">
								<input type="text" class="form-control" id="srtNama" placeholder="Nama Sertifikasi" name="srtNama">
								<label>Nama Sertifikasi</label>
							</div>
						</div>
					</div>

					<div class="form-group form-control-material @if($errors->has('srtSyarat')) has-danger @endif">
						<textarea class="form-control" id="srtSyarat" name="srtSyarat"></textarea>
						<label>Syarat</label>
					</div>

					<div class="form-group form-control-material @if($errors->has('srtSpek')) has-danger @endif">
						<textarea class="form-control" id="srtSpek" name="srtSpek"></textarea>
						<label>Spesifikasi</label>
					</div>

					<div class="form-group form-control-material @if($errors->has('srtKet')) has-danger @endif">
						<textarea class="form-control" id="srtKet" name="srtKet"></textarea>
						<label>Keterangan</label>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('srtBobot')) has-danger @endif">
								<input type="number" class="form-control" id="srtBobot" placeholder="Bobot" name="srtBobot">
								<label>Bobot</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group @if($errors->has('event')) has-danger @endif">
								<label>Status Event</label><br>
								<div class="radio radio-info radio-inline">
									<input type="radio" id="inlineRadio1" value="1" name="event" checked="">
									<label for="inlineRadio1">Ya</label>
								</div>
								<div class="radio radio-inline">
									<input type="radio" id="inlineRadio2" value="0" name="event">
									<label for="inlineRadio2">Tidak</label>
								</div>
							</div>
						</div>
					</div>

{{-- 					<div class="form-group form-control-material @if($errors->has('srtImage')) has-danger @endif">
						<input type="file" class="form-control" id="srtImage" placeholder="Image" name="srtImage">
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