@extends('layouts.app-admin')
@section('title', 'Tambah Kategori Produk')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Kategori Produk</h1>
{{ Breadcrumbs::render('edit-kategori-produk', $data) }}


<div class="row">
	<div class="col-md-8 col-lg-6">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<form action="{{url('user/produk/kategori-produk/update/'. $data->KTPRDK_ID)}}" method="post" id="form-kategori-produk">
					@csrf
					<div class="row">
						<div class="col-md-12">
							<div class="form-group form-control-material @if($errors->has('kategoriProduk')) has-danger @endif">
								<input type="text" class="form-control" id="kategoriProduk" placeholder="Kategori Produk" name="kategoriProduk" value="{{old('kategoriProduk', $data->KTPRDK_NAMA)}}">
								
								<label>Kategori Produk</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('keteranganKategoriProduk')) has-danger @endif">
								<textarea class="form-control" id="keteranganKategoriProduk" name="keteranganKategoriProduk">{{ old('keteranganKategoriProduk', $data->KTPRDK_KET) }}</textarea>
								<label>Keterangan Kategori Produk</label>
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
		confirmStore('btn-save','form-kategori-produk',"Your previous data will change");
	});
</script>
@endpush