@extends('layouts.app-admin')
@section('title', 'Tambah Kategori Sertifikasi')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Kategori Sertifikasi</h1>
{{ Breadcrumbs::render('tambah-kategori-sertifikasi') }}


<div class="row">
	<div class="col-md-8 col-lg-6">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<form action="{{url('admin/sertifikasi/kategori-sertifikasi/simpan')}}" method="post" id="form-kategori-sertifikasi">
					@csrf
					<div class="row">
						<div class="col-md-12">
							<div class="form-group form-control-material @if($errors->has('kategoriSertifikasi')) has-danger @endif">
								<input type="text" class="form-control" id="kategoriSertifikasi" placeholder="Kategori Pengguna" name="kategoriSertifikasi">
								
								<label>Kategori Sertifikasi</label>
							</div>
							<div class="form-group form-control-material @if($errors->has('keteranganKategoriSertifikasi')) has-danger @endif">
								<textarea class="form-control" id="keteranganKategoriSertifikasi" name="keteranganKategoriSertifikasi"></textarea>
								<label>Keterangan Kategori Sertifikasi</label>
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
		confirmStore('btn-save','form-kategori-sertifikasi',"Your previous data will change");
	});
</script>
@endpush