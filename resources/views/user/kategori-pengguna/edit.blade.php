@extends('layouts.app-admin')
@section('title', 'Tambah Kategori Pengguna')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Kategori Pengguna</h1>
{{ Breadcrumbs::render('edit-kategori-pengguna', $data) }}


<div class="row">
	<div class="col-md-8 col-lg-6">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<form action="{{url('user/pengguna/kategori-pengguna/update/'. $data->KTPNG_ID)}}" method="post" id="form-kategori-pengguna">
					@csrf
					<div class="row">
						<div class="col-md-12">
							<div class="form-group form-control-material @if($errors->has('kategoriPengguna')) has-danger @endif">
								<input type="text" class="form-control" id="kategoriPengguna" placeholder="Kategori Pengguna" name="kategoriPengguna" value="{{old('kategoriPengguna', $data->KTPNG_NAMA)}}">
								
								<label>Kategori Pengguna</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('keteranganKategoriPengguna')) has-danger @endif">
								<textarea class="form-control" id="keteranganKategoriPengguna" name="keteranganKategoriPengguna">{{ old('keteranganKategoriPengguna', $data->KTPNG_KET) }}</textarea>
								<label>Keterangan Kategori Pengguna</label>
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
		confirmStore('btn-save','form-kategori-pengguna',"Your previous data will change");
	});
</script>
@endpush