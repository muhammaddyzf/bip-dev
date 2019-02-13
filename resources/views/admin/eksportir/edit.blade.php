@extends('layouts.app-admin')
@section('title', 'Edit Eksportir')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Eksportir</h1>
{{-- {{ Breadcrumbs::render('tambah-pasar-modern') }} --}}


<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<form action="{{route('eksportir.update', $eksportir->id)}}" method="post" id="form-eksportir">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('namaPerusahaan')) has-danger @endif static required">
								<input type="text" class="form-control" id="namaPerusahaan" placeholder="Nama Perusahaan" name="namaPerusahaan" value="{{ old('namaPerusahaan', $eksportir->nama_perusahaan) }}">
								<label>Nama Perusahaan</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('npwp')) has-danger @endif static required static required">
								<input type="text" class="form-control" id="npwp" placeholder="NPWP" name="npwp" value="{{ old('npwp', $eksportir->npwp) }}">
								<label>NPWP</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('namaPemilik')) has-danger @endif">
								<input type="text" class="form-control" id="namaPemilik" placeholder="Nama Pemilik" name="namaPemilik" value="{{ old('namaPemilik', $eksportir->nama_pemilik) }}">
								<label>Nama Pemilik</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('email')) has-danger @endif static required">
								<input type="text" class="form-control" id="email" placeholder="Email" name="email" value="{{ old('email', $eksportir->email) }}">
								<label>Email</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('telp')) has-danger @endif static required">
								<input type="text" class="form-control" id="telp" placeholder="Telephone" name="telp"value="{{ old('telp', $eksportir->telp) }}">
								<label>Telephone</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('nomorApi')) has-danger @endif static required">
								<input type="text" class="form-control" id="nomorApi" placeholder="Nomor API" name="nomorApi" value="{{ old('nomorApi', $eksportir->nomor_api) }}">
								<label>Nomor API</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('uraianBarang')) has-danger @endif static required">
								<input type="text" class="form-control" id="uraianBarang" placeholder="Uraian Barang" name="uraianBarang" value="{{ old('uraianBarang', $eksportir->uraian_barang) }}">
								<label>Uraian Barang</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('posTaris')) has-danger @endif static required">
								<input type="text" class="form-control" id="posTaris" placeholder="Pos Taris" name="posTaris" value="{{ old('posTaris', $eksportir->pos_taris) }}">
								<label>Pos Taris</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('volumeKuantitas')) has-danger @endif static required">
								<input type="text" class="form-control" id="volumeKuantitas" placeholder="Volume Kuantitas" name="volumeKuantitas" value="{{ old('volumeKuantitas', $eksportir->volume_kuantitas) }}">
								<label>Volume Kuantitas</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('volumeSatuan')) has-danger @endif static required">
								<input type="text" class="form-control" id="volumeSatuan" placeholder="Volume Satuan" name="volumeSatuan" value="{{ old('volumeSatuan', $eksportir->volume_satuan) }}">
								<label>Volume Satuan</label>
							</div>
						

						</div>
						<div class="col-md-6">		

						
							<div class="form-group form-control-material @if($errors->has('nilai')) has-danger @endif static required">
								<input type="text" class="form-control" id="nilai" placeholder="Nilai" name="nilai" value="{{ old('nilai', $eksportir->nilai) }}">
								<label>Nilai</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('nilaiSatuan')) has-danger @endif static required">
								<input type="text" class="form-control" id="nilaiSatuan" placeholder="Nilai Satuan" name="nilaiSatuan" value="{{ old('nilaiSatuan', $eksportir->nilai_satuan) }}">
								<label>Nilai Satuan</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('negaraAsal')) has-danger @endif static required">
								<input type="text" class="form-control" id="negaraAsal" placeholder="Negara Asal" name="negaraAsal" value="{{ old('negaraAsal', $eksportir->negara_asal) }}">
								<label>Negara Asal</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('pelabuhanBongkar')) has-danger @endif static required">
								<input type="text" class="form-control" id="pelabuhanBongkar" placeholder="Pelabuhan Bongkar" name="pelabuhanBongkar" value="{{ old('pelabuhanBongkar', $eksportir->pelabuhan_bongkar) }}">
								<label>Pelabuhan Bongkar</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('pibNomor')) has-danger @endif static required">
								<input type="text" class="form-control" id="pibNomor" placeholder="PIB Nomor" name="pibNomor" value="{{ old('pibNomor', $eksportir->pib_nomor) }}">
								<label>PIB Nomor</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('pibTanggal')) has-danger @endif static required">
								<input type="text" class="form-control datepicker" id="pibTanggal" placeholder="PIB Tanggal" name="pibTanggal" value="{{ old('pibTanggal', date('d/m/Y', strtotime($eksportir->pib_tanggal))) }}">
								<label>PIB Tanggal</label>
							</div>
				
							<div class="form-group form-control-material @if($errors->has('alamatPerusahaan')) has-danger @endif static required">
								<textarea class="form-control" id="alamatPerusahaan" placeholder="Alamat Perusahaan" name="alamatPerusahaan">{{ old('alamatPerusahaan', $eksportir->alamat_perusahaan) }}</textarea>
								<label>Alamat Perusahaan</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('keterangan')) has-danger @endif">
								<textarea class="form-control" id="keterangan" placeholder="Keterangan" name="keterangan">{{ old('keterangan', $eksportir->keterangan) }}</textarea>
								<label>Keterangan</label>
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
		confirmStore('btn-save','form-eksportir',"Your previous data will change");
	});
</script>
@endpush