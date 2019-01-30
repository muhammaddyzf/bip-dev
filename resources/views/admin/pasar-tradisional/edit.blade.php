@extends('layouts.app-admin')
@section('title', 'Edit Pasar Tradisional')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Pasar Tradisional</h1>
{{ Breadcrumbs::render('edit-pasar-tradisional', $pasarTradisional) }}

<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<form action="{{url('admin/update/pasar-tradisional/'.$pasarTradisional->id)}}" method="post" id="form-pasar-tradisional">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('kategoriPasar')) has-danger @endif">
								<input type="text" class="form-control" id="kode" placeholder="Kategori Pasar" name="kategoriPasar" value="Pasar Tradisional">
								
								<label>Kategori Pasar</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('namaPasar')) has-danger @endif">
								<input type="text" class="form-control" id="kode" placeholder="Nama Pasar" name="namaPasar" value="{{old('namaPasar',$pasarTradisional->nama_pasar)}}">
								
								<label>Nama Pasar</label>
							</div>

							<div class="form-group form-control-material @if($errors->has('provinsi')) has-danger @endif">
								<select name="provinsi" class="form-control">
									<option value="">(Pilih)</option>
									@foreach ($provinsi as $dataProvinsi)
										<option value="{{ $dataProvinsi->id }}"
										@if ($dataProvinsi->id == old('provinsi', $pasarTradisional->id_provinsi))
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
										@if ($dataKabkot->id == old('kabkot', $pasarTradisional->id_kabkot))
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
											@if ($dataKecamatan->id == old('kecamatan', $pasarTradisional->id_kecamatan))
											selected="selected"
											@endif
											>{{ $dataKecamatan->name }}</option>
									@endforeach
								</select>
								<label>Kecamatan</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('alamat')) has-danger @endif">
								<textarea class="form-control" id="kode" placeholder="Alamat" name="alamat">{{old('alamat',$pasarTradisional->alamat)}}</textarea>
								<label>Alamat</label>
							</div>


						</div>
						<div class="col-md-6">

							<div class="form-group form-control-material @if($errors->has('luasTanah')) has-danger @endif">
								<input type="text" class="form-control" id="kode" placeholder="Luas Tanah" name="luasTanah" value="{{old('luasTanah',$pasarTradisional->luas_tanah)}}">
								<label>Luas Tanah (m2)</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('luasBangunan')) has-danger @endif">
								<input type="text" class="form-control" id="kode" placeholder="Luas Bangunan" name="luasBangunan" value="{{old('luasBangunan',$pasarTradisional->luas_bangunan)}}">
								<label>Luas Bangunan (m2)</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('bangunanKios')) has-danger @endif">
								<input type="text" class="form-control" id="kode" placeholder="Bangunan Kios" name="bangunanKios" value="{{old('bangunanKios',$pasarTradisional->bangunan_kios)}}">
								<label>Bangunan Kios (Unit)</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('bangunanLos')) has-danger @endif">
								<input type="text" class="form-control" id="kode" placeholder="Bangunan Los" name="bangunanLos" value="{{old('bangunanLos',$pasarTradisional->bangunan_los)}}">
								<label>Bangunan Los (Unit)</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('jumlahPedagang')) has-danger @endif">
								<input type="text" class="form-control" id="kode" placeholder="Jumlah Pedagang" name="jumlahPedagang" value="{{old('jumlahPedagang',$pasarTradisional->jumlah_pedagang)}}">
								<label>Jumlah Pedagang</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('status')) has-danger @endif">
								<input type="text" class="form-control" id="kode" placeholder="Status" name="status" value="{{old('status',$pasarTradisional->status)}}">
								<label>Status</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('pengelola')) has-danger @endif">
								<input type="text" class="form-control" id="kode" placeholder="pengelola" name="pengelola" value="{{old('pengelola',$pasarTradisional->pengelola)}}">
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