@extends('layouts.app-admin')
@section('title', 'Edit IKM')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">IKM</h1>
{{ Breadcrumbs::render('edit-ikm', $ikm) }}


<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<form action="{{url('user/ikm/update/'.$ikm->IKM_ID)}}" method="post" id="form-ikm" enctype="multipart/form-data">
					@csrf
					
					<div class="panel panel-default">
						<div class="panel-heading"><h4 class="panel-title">Data IKM</h4></div>
						<div class="panel-body">

							<div class="row">
								<div class="col-md-12">
									<div class="form-group form-control-material @if($errors->has('ikmNama')) has-danger @endif">
										<input type="text" class="form-control" id="ikmNama" placeholder="Nama IKM" name="ikmNama" value="{{ old('ikmNama',$ikm->IKM_NAMA) }}">
										<label>Nama IKM</label>
									</div>

									<div class="row">
										<div class="col-md-4">
											<div class="form-group form-control-material @if($errors->has('ikmNpwp')) has-danger @endif">
												<input type="text" class="form-control" id="ikmNpwp" placeholder="NPWP" name="ikmNpwp" value="{{ old('ikmNpwp', $ikm->IKM_NPWP) }}">
												<label>NPWP</label>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group form-control-material @if($errors->has('nikPemilik')) has-danger @endif">
												<input type="text" class="form-control" id="nikPemilik" placeholder="NIK Pemilik" name="nikPemilik" value="{{ old('nikPemilik', $ikm->IKM_NIKPEMILIK) }}">
												<label>NIK Pemilik</label>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group form-control-material @if($errors->has('ikmPemilik')) has-danger @endif">
												<input type="text" class="form-control" id="ikmPemilik" placeholder="Pemilik" name="ikmPemilik" value="{{ old('ikmPemilik', $ikm->IKM_PEMILIK) }}">
												<label>Pemilik</label>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-control-material @if($errors->has('ikmNoPendirian')) has-danger @endif">
												<input type="text" class="form-control" id="ikmNoPendirian" placeholder="Nomor Pendirian" name="ikmNoPendirian" value="{{ old('ikmNoPendirian', $ikm->IKM_NOPENDIRIAN) }}">
												<label>Nomor Pendirian</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-control-material @if($errors->has('ikmDtBerdiri')) has-danger @endif">
												<input type="text" class="form-control datepicker" id="ikmDtBerdiri" placeholder="Tanggal Pendirian" name="ikmDtBerdiri" value="{{ old('ikmDtBerdiri', $ikm->IKM_DTBERDIRI) }}">
												<label>Tanggal Pendirian</label>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-control-material @if($errors->has('ikmThnDiKeluarkanIjin')) has-danger @endif">
												<input type="text" class="form-control" id="ikmThnDiKeluarkanIjin" placeholder="YYYY" name="ikmThnDiKeluarkanIjin" value="{{ old('ikmThnDiKeluarkanIjin', $ikm->IKM_THNDIKELUARKANIJIN) }}">
												<label>Tahun Dikelarkan Ijin</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-control-material @if($errors->has('ikmBentukBadan')) has-danger @endif">
												<input type="text" class="form-control" id="ikmBentukBadan" placeholder="Bentuk Badan" name="ikmBentukBadan" value="{{ old('ikmBentukBadan', $ikm->IKM_BENTUKBADAN) }}">
												<label>Bentuk Badan</label>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-4">
											<div class="form-group form-control-material @if($errors->has('ikmJenisUsaha')) has-danger @endif">
												<input type="text" class="form-control" id="ikmJenisUsaha" placeholder="Jenis Usaha" name="ikmJenisUsaha" value="{{ old('ikmJenisUsaha', $ikm->IKM_JENISUSAHA ) }}">
												<label>Jenis Usaha</label>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group form-control-material @if($errors->has('ikmTlp')) has-danger @endif">
												<input type="text" class="form-control" id="ikmTlp" placeholder="Nomor Telephone" name="ikmTlp" value="{{ old('ikmTlp', $ikm->IKM_TLP) }}">
												<label>Nomor Telephone</label>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group form-control-material @if($errors->has('ikmEmail')) has-danger @endif">
												<input type="text" class="form-control" id="ikmEmail" placeholder="Email" name="ikmEmail" value="{{ old('ikmEmail', $ikm->IKM_EMAIL) }}">
												<label>Email</label>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-3">
											<div class="form-group form-control-material @if($errors->has('provinsi')) has-danger @endif">
												<select name="provinsi" class="form-control">
													<option value="">(Pilih)</option>
													@foreach ($provinsi as $dataProvinsi)
{{-- 													<option value="{{ $dataProvinsi->id }}">{{ $dataProvinsi->name }}</option> --}}
													<option value="{{ $dataProvinsi->id }}"
														@if ($dataProvinsi->id == old('provinsi', $ikm->IKM_PROV))
														selected="selected"
														@endif
														>{{ $dataProvinsi->name }}</option>
													@endforeach
												</select>

												<label>Provinsi</label>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group form-control-material @if($errors->has('kabkot')) has-danger @endif">	
												<select name="kabkot" class="form-control">
													<option value="{{ $kabkot->id }}">{{ $kabkot->name }}</option>
												</select>
												<label>Kabkot</label>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group form-control-material @if($errors->has('kecamatan')) has-danger @endif">	
												<select name="kecamatan" class="form-control">
													<option value="{{ $kecamatan->id }}">{{ $kecamatan->name }}</option>
												</select>
												<label>Kecamatan</label>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group form-control-material @if($errors->has('desa')) has-danger @endif">	
												<select name="desa" class="form-control">
													<option value="{{ $desa->id }}">{{ $desa->name }}</option>
												</select>
												<label>Desa</label>
											</div>
										</div>
									</div>
									<div class="form-group form-control-material @if($errors->has('ikmAlmtDet')) has-danger @endif">
										<textarea class="form-control" id="ikmAlmtDet" placeholder="Alamat" name="ikmAlmtDet">{{ old('ikmAlmtDet', $ikm->IKM_ALMTDET) }}</textarea>
										<label>Alamat</label>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-control-material @if($errors->has('ikmLati')) has-danger @endif">
												<input type="text" class="form-control" id="ikmLati" placeholder="Latitude" name="ikmLati" value="{{ old('ikmLati', $ikm->IKM_LATI) }}">
												<label>Latitude</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-control-material @if($errors->has('ikmLongi')) has-danger @endif">
												<input type="text" class="form-control" id="ikmLongi" placeholder="Longitude" name="ikmLongi" value="{{ old('ikmLongi', $ikm->IKM_LONGI) }}">
												<label>Longitude</label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-control-material @if($errors->has('ikmKet')) has-danger @endif">
												<textarea class="form-control" id="ikmKet" name="ikmKet">{{ old('ikmKet', $ikm->IKM_KET) }}</textarea>
												<label>Keterangan IKM</label>
											</div>
										</div>
										<div class="col-md-6">
											@if($image->IMG_NAMA != "")
											<img src="{{ asset($image->IMG_NAMA) }}" width="400px">
											@endif
											<div class="form-group form-control-material @if($errors->has('ikmImage')) has-danger @endif">
												<input type="hidden" name="oldIkmImage" value="{{ $image->IMG_NAMA }}">
												<input type="file" class="form-control" id="ikmImage" placeholder="Image" name="ikmImage">
											</div>
										</div>
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
		confirmStore('btn-save','form-ikm',"Your previous data will change");
	});
</script>
@endpush