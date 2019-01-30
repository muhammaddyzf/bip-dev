@extends('layouts.app-admin')
@section('title', 'Tambah Pasar Modern')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Pasar Modern</h1>
{{ Breadcrumbs::render('tambah-pasar-modern') }}


<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<form action="{{url('admin/simpan/pasar-modern')}}" method="post" id="form-pasar-modern">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('kategoriPasar')) has-danger @endif">
								<input type="text" class="form-control" id="kode" placeholder="Kategori Pasar" name="kategoriPasar" value="Pasar Modern">
								
								<label>Kategori Pasar</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('namaToko')) has-danger @endif">
								<input type="text" class="form-control" id="kode" placeholder="Nama Toko" name="namaToko">
								
								<label>Nama Toko</label>
							</div>

							<div class="form-group form-control-material @if($errors->has('provinsi')) has-danger @endif">
								<select name="provinsi" class="form-control">
									<option value="">(Pilih)</option>
									@foreach ($provinsi as $dataProvinsi)
									<option value="{{ $dataProvinsi->id }}">{{ $dataProvinsi->name }}</option>
									@endforeach
								</select>

								<label>Provinsi</label>
							</div>

							<div class="form-group form-control-material @if($errors->has('kabkot')) has-danger @endif">				
								<select name="kabkot" class="form-control">
									<option value="">(Pilih)</option>
									@foreach ($kabkot as $dataKabkot)
									<option value="{{ $dataKabkot->id }}">{{ $dataKabkot->name }}</option>
									@endforeach
								</select>
								<label>Kabkot</label>
							</div>

							<div class="form-group form-control-material @if($errors->has('kecamatan')) has-danger @endif">				
								<select name="kecamatan" class="form-control">
									<option value="">(Pilih)</option>
									@foreach ($kecamatan as $dataKecamatan)
									<option value="{{ $dataKecamatan->id }}">{{ $dataKecamatan->name }}</option>
									@endforeach
								</select>
								<label>Kecamatan</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('alamat')) has-danger @endif">
								<textarea class="form-control" id="kode" placeholder="Alamat" name="alamat"></textarea>
								<label>Alamat</label>
							</div>


						</div>
						<div class="col-md-6">

							<div class="form-group form-control-material @if($errors->has('luasTanah')) has-danger @endif">
								<input type="text" class="form-control" id="kode" placeholder="Luas Tanah" name="luasTanah">
								<label>Luas Tanah (m2)</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('luasBangunan')) has-danger @endif">
								<input type="text" class="form-control" id="kode" placeholder="Luas Bangunan" name="luasBangunan">
								<label>Luas Bangunan (m2)</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('namaPerusahaan')) has-danger @endif">
								<input type="text" class="form-control" id="kode" placeholder="Nama Perusahaan" name="namaPerusahaan">
								
								<label>Nama Perusahaan</label>
							</div>							
							<div class="form-group form-control-material @if($errors->has('alamatPerusahaan')) has-danger @endif">
								<textarea class="form-control" id="kode" placeholder="Alamat Perusahaan" name="alamatPerusahaan"></textarea>
								<label>Alamat Perusahaan</label>
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
		confirmStore('btn-save','form-pasar-modern',"Your previous data will change");
	});
</script>
@endpush