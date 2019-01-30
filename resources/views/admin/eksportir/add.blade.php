@extends('layouts.app-admin')
@section('title', 'Tambah Eksportir')
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
				<form action="{{route('eksportir.store')}}" method="post" id="form-eksportir">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('namaPerusahaan')) has-danger @endif">
								<input type="text" class="form-control" id="namaPerusahaan" placeholder="Nama Perusahaan" name="namaPerusahaan">
								<label>Nama Perusahaan</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('npwp')) has-danger @endif">
								<input type="text" class="form-control" id="npwp" placeholder="NPWP" name="npwp">
								<label>NPWP</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('namaPemilik')) has-danger @endif">
								<input type="text" class="form-control" id="namaPemilik" placeholder="Nama Pemilik" name="namaPemilik">
								<label>Nama Pemilik</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('email')) has-danger @endif">
								<input type="text" class="form-control" id="email" placeholder="Email" name="email">
								<label>Email</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('telp')) has-danger @endif">
								<input type="text" class="form-control" id="telp" placeholder="Telephone" name="telp">
								<label>Telephone</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('nomorApi')) has-danger @endif">
								<input type="text" class="form-control" id="nomorApi" placeholder="Nomor API" name="nomorApi">
								<label>Nomor API</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('uraianBarang')) has-danger @endif">
								<input type="text" class="form-control" id="uraianBarang" placeholder="Uraian Barang" name="uraianBarang">
								<label>Uraian Barang</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('posTaris')) has-danger @endif">
								<input type="text" class="form-control" id="posTaris" placeholder="Pos Taris" name="posTaris">
								<label>Pos Taris</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('volumeKuantitas')) has-danger @endif">
								<input type="text" class="form-control" id="volumeKuantitas" placeholder="Volume Kuantitas" name="volumeKuantitas">
								<label>Volume Kuantitas</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('volumeSatuan')) has-danger @endif">
								<input type="text" class="form-control" id="volumeSatuan" placeholder="Volume Satuan" name="volumeSatuan">
								<label>Volume Satuan</label>
							</div>
						

						</div>
						<div class="col-md-6">		

						
							<div class="form-group form-control-material @if($errors->has('nilai')) has-danger @endif">
								<input type="text" class="form-control" id="nilai" placeholder="Nilai" name="nilai">
								<label>Nilai</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('nilaiSatuan')) has-danger @endif">
								<input type="text" class="form-control" id="nilaiSatuan" placeholder="Nilai Satuan" name="nilaiSatuan">
								<label>Nilai Satuan</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('negaraAsal')) has-danger @endif">
								<input type="text" class="form-control" id="negaraAsal" placeholder="Negara Asal" name="negaraAsal">
								<label>Negara Asal</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('pelabuhanBongkar')) has-danger @endif">
								<input type="text" class="form-control" id="pelabuhanBongkar" placeholder="Pelabuhan Bongkar" name="pelabuhanBongkar">
								<label>Pelabuhan Bongkar</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('pibNomor')) has-danger @endif">
								<input type="text" class="form-control" id="pibNomor" placeholder="PIB Nomor" name="pibNomor">
								<label>PIB Nomor</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('pibTanggal')) has-danger @endif">
								<input type="text" class="form-control datepicker" id="pibTanggal" placeholder="PIB Tanggal" name="pibTanggal">
								<label>PIB Tanggal</label>
							</div>
				
							<div class="form-group form-control-material @if($errors->has('alamatPerusahaan')) has-danger @endif">
								<textarea class="form-control" id="alamatPerusahaan" placeholder="Alamat Perusahaan" name="alamatPerusahaan"></textarea>
								<label>Alamat Perusahaan</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('keterangan')) has-danger @endif">
								<textarea class="form-control" id="keterangan" placeholder="Keterangan" name="keterangan"></textarea>
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