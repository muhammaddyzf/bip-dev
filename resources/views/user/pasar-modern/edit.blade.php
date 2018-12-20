@extends('layouts.app-admin')
@section('title', 'Edit Pasar Modern')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Pasar Modern</h1>
{{ Breadcrumbs::render('edit-pasar-modern', $pasarModern) }}

<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<form action="{{url('user/update/pasar-modern/'.$pasarModern->id)}}" method="post" id="form-pasar-modern">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('kategoriPasar')) has-danger @endif">
								<input type="text" class="form-control" id="kode" placeholder="Kategori Pasar" name="kategoriPasar" value="Pasar Tradisional">
								
								<label>Kategori Pasar</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('namaToko')) has-danger @endif">
								<input type="text" class="form-control" id="kode" placeholder="Nama Pasar" name="namaToko" value="{{old('namaToko',$pasarModern->nama_toko)}}">
								
								<label>Nama Toko</label>
							</div>

							<div class="form-group form-control-material @if($errors->has('provinsi')) has-danger @endif">
								<select name="provinsi" class="form-control">
									<option value="">(Pilih)</option>
									@foreach ($provinsi as $dataProvinsi)
										<option value="{{ $dataProvinsi->id }}"
										@if ($dataProvinsi->id == old('provinsi', $pasarModern->id_provinsi))
										selected="selected"
										@endif
										>{{ $dataProvinsi->name }}</option>
									@endforeach
								</select>

								<label>Provinsi</label>
							</div>

							<div class="form-group form-control-material @if($errors->has('kabkot')) has-danger @endif">				
								<select name="kabkot" class="form-control">
									<option value="">(Pilih)</option>
									@foreach ($kabkot as $dataKabkot)

										<option value="{{ $dataKabkot->id }}"
										@if ($dataKabkot->id == old('kabkot', $pasarModern->id_kabkot))
										selected="selected"
										@endif
										>{{ $dataKabkot->name }}</option>

									@endforeach
								</select>
								<label>Kabkot</label>
							</div>

							<div class="form-group form-control-material @if($errors->has('kecamatan')) has-danger @endif">				
								<select name="kecamatan" class="form-control">
									<option value="">(Pilih)</option>
									@foreach ($kecamatan as $dataKecamatan)
										<option value="{{ $dataKecamatan->id }}"
											@if ($dataKecamatan->id == old('kecamatan', $pasarModern->id_kecamatan))
											selected="selected"
											@endif
											>{{ $dataKecamatan->name }}</option>
									@endforeach
								</select>
								<label>Kecamatan</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('alamat')) has-danger @endif">
								<textarea class="form-control" id="kode" placeholder="Alamat" name="alamat">{{old('alamat',$pasarModern->alamat)}}</textarea>
								<label>Alamat</label>
							</div>


						</div>
						<div class="col-md-6">

							<div class="form-group form-control-material @if($errors->has('luasTanah')) has-danger @endif">
								<input type="text" class="form-control" id="kode" placeholder="Luas Tanah" name="luasTanah" value="{{old('luasTanah',$pasarModern->luas_tanah)}}">
								<label>Luas Tanah (m2)</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('luasBangunan')) has-danger @endif">
								<input type="text" class="form-control" id="kode" placeholder="Luas Bangunan" name="luasBangunan" value="{{old('luasBangunan',$pasarModern->luas_bangunan)}}">
								<label>Luas Bangunan (m2)</label>
							</div>

							<div class="form-group form-control-material @if($errors->has('namaPerusahaan')) has-danger @endif">
								<input type="text" class="form-control" id="kode" placeholder="Nama Perusahaan" name="namaPerusahaan" value="{{old('namaPerusahaan', $pasarModern->nama_perusahaan)}}">
								
								<label>Nama Perusahaan</label>
							</div>							
							<div class="form-group form-control-material @if($errors->has('alamatPerusahaan')) has-danger @endif">
								<textarea class="form-control" id="kode" placeholder="Alamat Perusahaan" name="alamatPerusahaan">{{old('alamatPerusahaan', $pasarModern->alamat_perusahaan)}}</textarea>
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