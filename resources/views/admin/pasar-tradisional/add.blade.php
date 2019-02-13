@extends('layouts.app-admin')
@section('title', 'Tambah Pasar Tradisional')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Pasar Tradisional</h1>
{{ Breadcrumbs::render('tambah-pasar-tradisional') }}

<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<form action="{{url('admin/simpan/pasar-tradisional')}}" method="post" id="form-pasar-tradisional">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('kategoriPasar')) has-danger @endif">
								<input type="text" class="form-control" id="kode" placeholder="Kategori Pasar" name="kategoriPasar" value="Pasar Tradisional">
								
								<label>Kategori Pasar</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('namaPasar')) has-danger @endif static required">
								<input type="text" class="form-control" id="kode" placeholder="Nama Pasar" name="namaPasar">
								
								<label>Nama Pasar</label>
							</div>

							<div class="form-group form-control-material @if($errors->has('provinsi')) has-danger @endif static required">
								<select name="provinsi" class="form-control">
									<option value="">(Pilih)</option>
									@foreach ($provinsi as $dataProvinsi)
									<option value="{{ $dataProvinsi->id }}">{{ $dataProvinsi->name }}</option>
									@endforeach
								</select>

								<label>Provinsi</label>
							</div>

							<div class="form-group form-control-material @if($errors->has('kabkot')) has-danger @endif static required">				
								<select name="kabkot" class="form-control">
									<option value="">(Pilih)</option>
									@foreach ($kabkot as $dataKabkot)
									<option value="{{ $dataKabkot->id }}">{{ $dataKabkot->name }}</option>
									@endforeach
								</select>
								<label>Kabkot</label>
							</div>

							<div class="form-group form-control-material @if($errors->has('kecamatan')) has-danger @endif static required">				
								<select name="kecamatan" class="form-control">
									<option value="">(Pilih)</option>
									@foreach ($kecamatan as $dataKecamatan)
									<option value="{{ $dataKecamatan->id }}">{{ $dataKecamatan->name }}</option>
									@endforeach
								</select>
								<label>Kecamatan</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('alamat')) has-danger @endif static required">
								<textarea class="form-control" id="kode" placeholder="Alamat" name="alamat"></textarea>
								<label>Alamat</label>
							</div>


						</div>
						<div class="col-md-6">

							<div class="form-group form-control-material @if($errors->has('luasTanah')) has-danger @endif static required">
								<input type="text" class="form-control" id="kode" placeholder="Luas Tanah" name="luasTanah">
								<label>Luas Tanah (m2)</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('luasBangunan')) has-danger @endif static required">
								<input type="text" class="form-control" id="kode" placeholder="Luas Bangunan" name="luasBangunan">
								<label>Luas Bangunan (m2)</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('bangunanKios')) has-danger @endif static required">
								<input type="text" class="form-control" id="kode" placeholder="Bangunan Kios" name="bangunanKios">
								<label>Bangunan Kios (Unit)</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('bangunanLos')) has-danger @endif static required">
								<input type="text" class="form-control" id="kode" placeholder="Bangunan Los" name="bangunanLos">
								<label>Bangunan Los (Unit)</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('jumlahPedagang')) has-danger @endif static required">
								<input type="text" class="form-control" id="kode" placeholder="Jumlah Pedagang" name="jumlahPedagang">
								<label>Jumlah Pedagang</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('status')) has-danger @endif static required">
								<input type="text" class="form-control" id="kode" placeholder="Status" name="status">
								<label>Status</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('pengelola')) has-danger @endif static required">
								<input type="text" class="form-control" id="kode" placeholder="pengelola" name="pengelola">
								<label>Pengelola</label>
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
		confirmStore('btn-save','form-pasar-tradisional',"Your previous data will change");
	});
</script>
@endpush