@extends('layouts.app-admin')
@section('title', 'Tambah Produk')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Produk</h1>
{{ Breadcrumbs::render('tambah-produk') }}


<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<form action="{{url('admin/produk/simpan')}}" method="post" id="form-produk" enctype="multipart/form-data">
					@csrf
					<div class="form-group @if($errors->has('ktprdkId')) has-danger @endif">
						<label>Kategori Produk</label>
						<div class="form-group">
			                <select multiple="multiple" style="width: 100%;" data-toggle="select2" name="ktprdkId[]">
			                    @foreach($kategoriProduk as $ktprdk)
			                    	<option value="{{$ktprdk->KTPRDK_ID}}">{{$ktprdk->KTPRDK_NAMA}}</option>
			                    @endforeach
			                </select>
			            </div>
					</div>			
					<div class="row">
						<div class="col-md-6">
							<div class="form-group @if($errors->has('ikmId')) has-danger @endif">
				                  <div class="col-sm-12">
				                  	<label>IKM</label>
				                    <select name="ikmId" class="selectpicker" data-style="btn-white" data-live-search="true" data-size="5">
				                      <option>(Pilih)</option>
				                      @foreach($ikm as $dataIkm)
				                      <option value="{{$dataIkm->IKM_ID}}">{{$dataIkm->IKM_NAMA}}</option>
				                      @endforeach
				                    </select>
				                  </div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('prdkNama')) has-danger @endif">
								<input type="text" class="form-control" id="prdkNama" placeholder="Nama Produk" name="prdkNama">
								<label>Nama Produk</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('prdkPemasaran')) has-danger @endif">
								<input type="number" class="form-control" id="prdkPemasaran" placeholder="Pemasaran" name="prdkPemasaran">
								<label>Pemasaran</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('prdkBbbp')) has-danger @endif">
								<input type="number" class="form-control" id="prdkBbbp" placeholder="BBBP" name="prdkBbbp">
								<label>BBBP</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('prdkNilaiProduksi')) has-danger @endif">
								<input type="number" class="form-control" id="prdkNilaiProduksi" placeholder="Nilai Produksi" name="prdkNilaiProduksi">
								<label>Nilai produksi</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('prdkSatuanKapasitas')) has-danger @endif">
								<input type="text" class="form-control" id="prdkSatuanKapasitas" placeholder="Satuan kapasitas" name="prdkSatuanKapasitas">
								<label>Satuan Kapasitas</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<div class="form-group form-control-material @if($errors->has('prdkJumlahKapasitasProduksi')) has-danger @endif">
								<input type="number" class="form-control" id="prdkJumlahKapasitasProduksi" placeholder="Jumlah Kapasitas Produksi" name="prdkJumlahKapasitasProduksi">
								<label>Jumlah Kapasitas Produksi</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group form-control-material @if($errors->has('prdkNilaiInvestasi')) has-danger @endif">
								<input type="number" class="form-control" id="prdkNilaiInvestasi" placeholder="Nilai Investasi" name="prdkNilaiInvestasi">
								<label>Nilai Investasi</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group form-control-material @if($errors->has('prdkTenagaKerja')) has-danger @endif">
								<input type="number" class="form-control" id="prdkTenagaKerja" placeholder="Tenaga Kerja" name="prdkTenagaKerja">
								<label>Tenaga Kerja</label>
							</div>
						</div>
					</div>

					<div class="form-group form-control-material @if($errors->has('prdkKomposisi')) has-danger @endif">
						<textarea class="form-control" id="prdkKomposisi" name="prdkKomposisi"></textarea>
						<label>Komposisi</label>
					</div>

					<div class="form-group form-control-material @if($errors->has('prdkKeterangan')) has-danger @endif">
						<textarea class="form-control" id="prdkKeterangan" name="prdkKeterangan"></textarea>
						<label>Keterangan</label>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('prdkKbli')) has-danger @endif">
								<input type="text" class="form-control" id="prdkKbli" placeholder="KBLI" name="prdkKbli">
								<label>KBLI</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('prdkImage')) has-danger @endif">
								<input type="file" class="form-control" id="prdkImage" placeholder="Image" name="prdkImage">
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
		confirmStore('btn-save','form-produk',"Your previous data will change");
	});
</script>
@endpush