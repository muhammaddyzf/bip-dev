@extends('layouts.app-admin')
@section('title', 'Tambah Produk')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Produk</h1>
{{-- {{ Breadcrumbs::render('tambah-produk') }}
 --}}

<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<form action="{{url('user/produk/simpan')}}" method="post" id="form-produk" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="idIkm" value="{{$ikm->IKM_ID}}">
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
							<div class="form-group form-control-material @if($errors->has('ikmNama')) has-danger @endif">
								<input type="text" class="form-control" value="{{$ikm->IKM_NAMA}}" id="ikmNama" placeholder="IKM" name="ikmNama">
								<label>IKM</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-control-material @if($errors->has('prdkNama')) has-danger @endif">
								<input type="text" class="form-control" id="prdkNama" placeholder="Nama Produk" name="prdkNama">
								<label>Nama Produk</label>
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