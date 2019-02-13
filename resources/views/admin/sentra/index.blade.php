@extends('layouts.app-admin')
@section('title', 'Sentra')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Sentra</h1>
{{ Breadcrumbs::render('sentra') }}


<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
						<a href="{{route('admin.tambah.sentra')}}" class="btn btn-white"><i class="fa fa-plus"></i> Tambah Sentra</a>
					</div>
					<div class="col-md-6">
						<div class="pull-right">
							<form class="form-inline" role="form" action="{{ route('sentra.cetak-laporan') }}" method="post">@csrf
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
				<table class="table table-bordered table-striped" id="sentra">
					<thead>
						<tr>
							<th class="text-center">Nama Sentra</th>
							<th class="text-center">Alamat</th>
							<th class="text-center">Provinsi</th>
							<th class="text-center">Kabupaten/Kota</th>
							<th class="text-center">Kecamatan</th>
							<th class="text-center">Tanggal Entry</th>
							<th class="text-center"></th>
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
    $('#sentra').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! url('admin/data-sentra') !!}',
        columns: [
            { data: 'nama_sentra', name: 'nama_sentra' },
            { data: 'alamat', name: 'alamat' },
            { data: 'provinsi', name: 'provinsi' },
            { data: 'kabupaten', name: 'kabupaten' },
            { data: 'kecamatan', name: 'kecamatan' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' },
        ]
    });
});
</script>
@endpush