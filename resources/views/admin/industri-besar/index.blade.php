@extends('layouts.app-admin')
@section('title', 'Industri Besar')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Industri Besar</h1>


<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
{{-- 				<a href="{{route('admin.ikm.cetak-laporan-excel', ['type'=>'xlsx'])}}" class="btn btn-white pull-right"><i class="fa fa-download"></i> Cetak Laporan </a> --}}
				
				{{-- <a href="{{route('admin.industri-besar.upload')}}" class="btn btn-white pull-right"><i class="fa fa-upload"></i> Import Excel </a>
				<a href="{{route('admin.industri-besar.download-excel')}}" class="btn btn-white pull-right"><i class="fa fa-download"></i> Download Format Excel </a> --}}
				<div class="row">
					<div class="col-md-6">
						<a href="{{route('admin.industri-besar.tambah')}}" class="btn btn-white"><i class="fa fa-plus"></i> Tambah </a>
					</div>
					<div class="col-md-6">
						<div class="pull-right">
							<form class="form-inline" role="form" action="{{ route('industri-besar.cetak-laporan') }}" method="post">@csrf
							 	 <div class="form-group @if($errors->has('daterange')) has-danger @endif">
									<input type="text" class="form-control" id="dates" placeholder="Tanggal" name="daterange" required="">
									<span class="ma-form-highlight"></span>
									<span class="ma-form-bar"></span>
								</div>

								<button type="submit" class="btn btn-white"><i class="fa fa-download"></i> Cetak Laporan </button>
							</form>
						</div>
					</div>
				</div>
				<br>
				<table class="table table-bordered table-striped" id="kategori-pengguna">
					<thead>
						<tr>
							<th class="text-center">Nama Industri</th>
							<th class="text-center">NPWP</th>
							<th class="text-center">NIK Pemilik</th>
							<th class="text-center">Nama Pemilik</th>
							<th class="text-center">Proses</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
$(function() {
    $('#kategori-pengguna').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! url('admin/industri-besar/data-industri-besar') !!}',
        columns: [
            { data: 'IKM_NAMA', name: 'IKM_NAMA' },
            { data: 'IKM_NPWP', name: 'IKM_NPWP' },
            { data: 'IKM_NIKPEMILIK', name: 'IKM_NIKPEMILIK' },
            { data: 'IKM_PEMILIK', name: 'IKM_PEMILIK' },
            { data: 'action', name: 'action' },
        ]
    });
});
</script>
@endpush