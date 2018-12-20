@extends('layouts.app-admin')
@section('title', 'Sentra')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Sentra</h1>
{{ Breadcrumbs::render('edit-sentra', $sentra) }}

<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<form action="{{url('user/update/sentra/'.$sentra->id)}}" method="post" id="form-sentra">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('namaSentra')) has-danger @endif">
								<input type="text" class="form-control" id="kode" placeholder="Nama Sentra" name="namaSentra" value="{{old('namaSentra', $sentra->nama_sentra)}}">
								
								<label>Nama Sentra</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('jenisProduk')) has-danger @endif">
								<input type="text" class="form-control" id="kode" placeholder="Jenis Produk" name="jenisProduk" value="{{old('jenisProduk', $sentra->jenis_produk)}}">
								
								<label>Jenis Produk</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('jumlahUnitUsaha')) has-danger @endif">
								<input type="number" class="form-control" id="kode" placeholder="Jumlah Unit Usaha" name="jumlahUnitUsaha" value="{{old('jumlahUnitUsaha', $sentra->jumlah_unit_usaha)}}">
								
								<label>Jumlah Unit Usaha</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('kontakPerson')) has-danger @endif">
								<input type="text" class="form-control" id="kode" placeholder="Kontak Person" name="kontakPerson" value="{{old('kontakPerson', $sentra->kontak_person)}}">
								
								<label>Kontak Person</label>
							</div>

							<div class="form-group form-control-material @if($errors->has('provinsi')) has-danger @endif">
								<select name="provinsi" class="form-control">
									<option value="">(Pilih)</option>
									@foreach ($provinsi as $dataProvinsi)
										<option value="{{ $dataProvinsi->id }}"
										@if ($dataProvinsi->id == old('provinsi', $sentra->id_provinsi))
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
										@if ($dataKabkot->id == old('kabkot', $sentra->id_kabkot))
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
											@if ($dataKecamatan->id == old('kecamatan', $sentra->id_kecamatan))
											selected="selected"
											@endif
											>{{ $dataKecamatan->name }}</option>
									@endforeach
								</select>
								<label>Kecamatan</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('alamat')) has-danger @endif">
								<textarea class="form-control" id="kode" placeholder="Alamat" name="alamat">{{old('alamat', $sentra->alamat)}}</textarea>
								<label>Alamat</label>
							</div>


						</div>
						<div class="col-md-6">

							<div class="form-group form-control-material @if($errors->has('tenagaKerja')) has-danger @endif">
								<input type="number" class="form-control" id="kode" placeholder="Tenaga Kerja" name="tenagaKerja" value="{{old('tenagaKerja', $sentra->tenaga_kerja)}}">
								<label>Tenaga Kerja</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('nilaiInvestasi')) has-danger @endif">
								<input type="number" class="form-control" id="kode" placeholder="Nilai Investasi" name="nilaiInvestasi" value="{{old('nilaiInvestasi', $sentra->nilai_investasi)}}">
								<label>Nilai Investasi</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('kapasitasProduksi')) has-danger @endif">
								<input type="number" class="form-control" id="kode" placeholder="Kapasitas Produksi" name="kapasitasProduksi" value="{{old('kapasitasProduksi', $sentra->kapasitas_produksi)}}">
								<label>Kapasitas Produksi</label>
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
		confirmStore('btn-save','form-sentra',"Your previous data will change");
	});
</script>
@endpush
