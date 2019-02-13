@extends('layouts.app-admin')
@section('title', 'Sentra')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Sentra</h1>
{{ Breadcrumbs::render('tambah-sentra') }}

<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<form action="{{url('admin/simpan/sentra')}}" method="post" id="form-sentra">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('namaSentra')) has-danger @endif static required">
								<input type="text" class="form-control" id="kode" placeholder="Nama Sentra" name="namaSentra">
								
								<label>Nama Sentra</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('jenisProduk')) has-danger @endif static required">
								<input type="text" class="form-control" id="kode" placeholder="Jenis Produk" name="jenisProduk">
								
								<label>Jenis Produk</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('jumlahUnitUsaha')) has-danger @endif static required">
								<input type="number" class="form-control" id="kode" placeholder="Jumlah Unit Usaha" name="jumlahUnitUsaha">
								
								<label>Jumlah Unit Usaha</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('kontakPerson')) has-danger @endif static required">
								<input type="text" class="form-control" id="kode" placeholder="Kontak Person" name="kontakPerson">
								
								<label>Kontak Person</label>
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

							<div class="form-group form-control-material @if($errors->has('tenagaKerja')) has-danger @endif static required">
								<input type="number" class="form-control" id="kode" placeholder="Tenaga Kerja" name="tenagaKerja">
								<label>Tenaga Kerja</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('nilaiInvestasi')) has-danger @endif static required">
								<input type="number" class="form-control" id="kode" placeholder="Nilai Investasi" name="nilaiInvestasi">
								<label>Nilai Investasi</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('kapasitasProduksi')) has-danger @endif static required">
								<input type="number" class="form-control" id="kode" placeholder="Kapasitas Produksi" name="kapasitasProduksi">
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
