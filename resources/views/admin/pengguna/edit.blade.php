@extends('layouts.app-admin')
@section('title', 'Edit Pengguna')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Pengguna</h1>
{{ Breadcrumbs::render('edit-pengguna', $user) }}


<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<form action="{{url('admin/pengguna/update/'. $user->id)}}" method="post" id="form-pengguna" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group form-control-material @if($errors->has('nik')) has-danger @endif">
										<input type="text" class="form-control" id="nik" placeholder="NIK" name="nik" value="{{ old('nik', $user->pengguna['PNG_NIK']) }}">
										<label>NIK</label>
									</div>
								</div>
								<div class="col-md-6">
									<label>Kategori Pengguna</label>
									<div class="form-group form-control-material @if($errors->has('ktpng')) has-danger @endif">
						                <input type="text" class="form-control" readonly="" value="{{ old('ktpng', $user->pengguna->kategoriPengguna['KTPNG_NAMA']) }}">
						            </div>
								</div>
							</div>
							<div class="form-group form-control-material @if($errors->has('nama')) has-danger @endif">
								<input type="text" class="form-control" id="nama" placeholder="Nama Lengkap" name="nama" value="{{ old('nama', $user->pengguna['PNG_NAMA']) }}">
								<label>Nama Lengkap</label>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group form-control-material @if($errors->has('email')) has-danger @endif">
										<input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ old('email', $user->pengguna['PNG_EMAIL']) }}" readonly="">
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
							                    <option value="SD" {{ old('pendidikan', $user->pengguna['PNG_PEND']) == 'SD' ? 'selected' : '' }}>SD</option>
							                    <option value="SMP" {{ old('pendidikan', $user->pengguna['PNG_PEND']) == 'SMP' ? 'selected' : '' }}>SMP</option>
							                    <option value="SMA" {{ old('pendidikan', $user->pengguna['PNG_PEND']) == 'SMA' ? 'selected' : '' }}>SMA</option>
							                    <option value="Diploma" {{ old('pendidikan', $user->pengguna['PNG_PEND']) == 'Diploma' ? 'selected' : '' }}>Diploma</option>
							                    <option value="S1" {{ old('pendidikan', $user->pengguna['PNG_PEND']) == 'S1' ? 'selected' : '' }}>S1</option>
							                    <option value="S2" {{ old('pendidikan', $user->pengguna['PNG_PEND']) == 'S2' ? 'selected' : '' }}>S2</option>
							                    <option value="S3" {{ old('pendidikan', $user->pengguna['PNG_PEND']) == 'S3' ? 'selected' : '' }}>S3</option>
							                </select>
							            </div>
									</div>		
								</div>
								<div class="col-md-6">
									<div class="form-group form-control-material @if($errors->has('tlp')) has-danger @endif">
										<input type="text" class="form-control" id="tlp" placeholder="Telephone" name="tlp" value="{{ old('tlp', $user->pengguna['PNG_TLP']) }}">
										<label>Telephone</label>
									</div>
								</div>
							</div>
							<div class="form-group form-control-material @if($errors->has('alamat')) has-danger @endif">
								<textarea class="form-control" id="alamat" name="alamat">{{ old('alamat', $user->pengguna['PNG_ALMNT']) }}</textarea>
								<label>Alamat</label>
							</div>
							<div class="row">
								<div class="col-md-6">
        							@if($user->images['IMG_NAMA'] != "")
									<img src="{{ asset($user->images['IMG_NAMA']) }}" width="400">
									@endif
									<div class="form-group form-control-material @if($errors->has('userImage')) has-danger @endif">
										<input type="hidden" name="oldUserImage" value="{{ $user->images['IMG_NAMA'] }}">
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