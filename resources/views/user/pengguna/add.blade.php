@extends('layouts.app-admin')
@section('title', 'Tambah Pengguna')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Pengguna</h1>
{{ Breadcrumbs::render('tambah-pengguna') }}


<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<form action="{{url('user/pengguna/simpan')}}" method="post" id="form-pengguna" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group form-control-material @if($errors->has('nik')) has-danger @endif">
										<input type="text" class="form-control" id="nik" placeholder="NIK" name="nik">
										<label>NIK</label>
									</div>
								</div>
								<div class="col-md-6">
									<label>Kategori Pengguna</label>
									<div class="form-group form-control-material @if($errors->has('ktpng')) has-danger @endif">
						                <select style="width: 100%;" class="form-control" name="ktpng">
						                	<option>(Pilih)</option>
						                    @foreach($kategoriPengguna as $ktpng)
						                    	<option value="{{$ktpng->KTPNG_ID}}">{{$ktpng->KTPNG_NAMA}}</option>
						                    @endforeach
						                </select>
						            </div>
								</div>
							</div>
							<div class="form-group form-control-material @if($errors->has('nama')) has-danger @endif">
								<input type="text" class="form-control" id="nama" placeholder="Nama Lengkap" name="nama">
								<label>Nama Lengkap</label>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group form-control-material @if($errors->has('email')) has-danger @endif">
										<input type="email" class="form-control" id="email" placeholder="Email" name="email">
										<label>Email</label>
									</div>		
								</div>
								<div class="col-md-6">
									<div class="form-group form-control-material @if($errors->has('password')) has-danger @endif">
										<input type="password" class="form-control" id="password" placeholder="Password" name="password">
										<label>Password</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group form-control-material @if($errors->has('pendidikan')) has-danger @endif">
										<label>Pendidikan</label>
										<div class="form-group">
							                <select style="width: 100%;" class="form-control" name="pendidikan">
							                    <option>(Pilih)</option>
							                    <option value="SD">SD</option>
							                    <option value="SMP">SMP</option>
							                    <option value="SMA">SMA</option>
							                    <option value="Diploma">Diploma</option>
							                    <option value="S1">S1</option>
							                    <option value="S2">S2</option>
							                    <option value="S3">S3</option>
							                </select>
							            </div>
									</div>		
								</div>
								<div class="col-md-6">
									<div class="form-group form-control-material @if($errors->has('tlp')) has-danger @endif">
										<input type="text" class="form-control" id="tlp" placeholder="Telephone" name="tlp">
										<label>Telephone</label>
									</div>
								</div>
							</div>
							<div class="form-group form-control-material @if($errors->has('alamat')) has-danger @endif">
								<textarea class="form-control" id="alamat" name="alamat"></textarea>
								<label>Alamat</label>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group form-control-material @if($errors->has('userImage')) has-danger @endif">
										<input type="file" class="form-control" id="userImage" placeholder="Image" name="userImage">
									</div>
								</div>
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
		confirmStore('btn-save','form-pengguna',"Your previous data will change");
	});
</script>
@endpush