@extends('layouts.app-admin')
@section('title', 'Tambah Produk')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Produk</h1>
{{ Breadcrumbs::render('edit-produk', $produk) }}

<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<form action="{{url('user/produk/update/'. $produk->PRDK_ID)}}" method="post" id="form-produk" enctype="multipart/form-data">
					@csrf
					<div class="form-group @if($errors->has('ktprdkId')) has-danger @endif">
						<label>Kategori Produk</label>
						<div class="form-group">
			                <select multiple="multiple" style="width: 100%;" data-toggle="select2" name="ktprdkId[]">
			                    @foreach($kategoriProduk as $ktprdk)
			                    	@foreach($ptkproduk as $itemPtkProduk)
									<option value="{{ $ktprdk->KTPRDK_ID }}"
			                    	@if ($ktprdk->KTPRDK_ID == old('ktprdk', $itemPtkProduk->KTPRDK_ID))
			                    	selected="selected"
			                    	@endif
			                    	>{{ $ktprdk->KTPRDK_NAMA }}</option>
			                    	@endforeach
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
				                      	<option value="{{ $dataIkm->IKM_ID }}"
				                    	@if ($dataIkm->IKM_ID == old('ikmId', $produk->IKM_ID))
				                    	selected="selected"
				                    	@endif
				                    	>{{ $dataIkm->IKM_NAMA }}</option>
				                      @endforeach
				                    </select>
				                  </div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('prdkNama')) has-danger @endif">
								<input type="text" class="form-control" id="prdkNama" placeholder="Nama Produk" name="prdkNama" value="{{ $produk->PRDK_NAMA }}">
								<label>Nama Produk</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('prdkPemasaran')) has-danger @endif">
								<input type="number" class="form-control" id="prdkPemasaran" placeholder="Pemasaran" name="prdkPemasaran" value="{{ old('prdkPemasaran', $produk->PRDK_PEMASARAN) }}">
								<label>Pemasaran</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('prdkBbbp')) has-danger @endif">
								<input type="number" class="form-control" id="prdkBbbp" placeholder="BBBP" name="prdkBbbp" value="{{ old('prdkBbbp', $produk->PRDK_BBBP) }}">
								<label>BBBP</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('prdkNilaiProduksi')) has-danger @endif">
								<input type="number" class="form-control" id="prdkNilaiProduksi" placeholder="Nilai Produksi" name="prdkNilaiProduksi" value="{{ old('prdkNilaiProduksi', $produk->PRDK_NILAIPRODUKSI) }}">
								<label>Nilai produksi</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('prdkSatuanKapasitas')) has-danger @endif">
								<input type="text" class="form-control" id="prdkSatuanKapasitas" placeholder="Satuan kapasitas" name="prdkSatuanKapasitas" value="{{ old('prdkSatuanKapasitas', $produk->PRDK_SATUANKAPASITASPRODUKSI) }}">
								<label>Satuan Kapasitas</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<div class="form-group form-control-material @if($errors->has('prdkJumlahKapasitasProduksi')) has-danger @endif">
								<input type="number" class="form-control" id="prdkJumlahKapasitasProduksi" placeholder="Jumlah Kapasitas Produksi" name="prdkJumlahKapasitasProduksi" value="{{ old('prdkJumlahKapasitasProduksi', $produk->PRDK_JUMLAHKAPASITASPRODUKSI) }}">
								<label>Jumlah Kapasitas Produksi</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group form-control-material @if($errors->has('prdkNilaiInvestasi')) has-danger @endif">
								<input type="number" class="form-control" id="prdkNilaiInvestasi" placeholder="Nilai Investasi" name="prdkNilaiInvestasi" value="{{ old('prdkNilaiInvestasi', $produk->PRDK_NILAIINVESTASI) }}">
								<label>Nilai Investasi</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group form-control-material @if($errors->has('prdkTenagaKerja')) has-danger @endif">
								<input type="number" class="form-control" id="prdkTenagaKerja" placeholder="Tenaga Kerja" name="prdkTenagaKerja" value="{{ old('prdkTenagaKerja', $produk->PRDK_TENAGAKERJA) }}">
								<label>Tenaga Kerja</label>
							</div>
						</div>
					</div>

					<div class="form-group form-control-material @if($errors->has('prdkKomposisi')) has-danger @endif">
						<textarea class="form-control" id="prdkKomposisi" name="prdkKomposisi">{{ $produk->PRDK_KOMPOSISI }}</textarea>
						<label>Komposisi</label>
					</div>

					<div class="form-group form-control-material @if($errors->has('prdkKeterangan')) has-danger @endif">
						<textarea class="form-control" id="prdkKeterangan" name="prdkKeterangan">{{ $produk->PRDK_KET }}</textarea>
						<label>Keterangan</label>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('prdkKbli')) has-danger @endif">
								<input type="text" class="form-control" id="prdkKbli" placeholder="KBLI" name="prdkKbli" value="{{ $produk->PRDK_KBLI }}">
								<label>KBLI</label>
							</div>
						</div>
						<div class="col-md-6">
							@if($image->IMG_NAMA != "")
							<img src="{{ asset($image->IMG_NAMA) }}" width="400">
							@endif
							<div class="form-group form-control-material @if($errors->has('prdkImage')) has-danger @endif">
								<input type="hidden" name="oldPrdkImage" value="{{ $image->IMG_NAMA }}">
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