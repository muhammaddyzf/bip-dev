@extends('layouts.app-admin')
@section('title', 'Pasar Tradisional')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Pasar Tradisional</h1>
{{ Breadcrumbs::render('pasar-tradisional') }}

<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<a href="{{route('user.tambah.pasar-tradisional')}}" class="btn btn-white"><i class="fa fa-plus"></i> Tambah Pasar Tradisional</a>
				<br>
				<table class="table table-bordered table-striped" id="pasar-tradisional">
					<thead>
						<tr>
							<th class="text-center">Nama Pasar</th>
							<th class="text-center">Alamat</th>
							<th class="text-center">Provinsi</th>
							<th class="text-center">Kabupaten/Kota</th>
							<th class="text-center">Kecamatan</th>
							<th class="text-center">Status</th>
							<th class="text-center">Pengelola</th>
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
    $('#pasar-tradisional').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! url('user/data-pasar-tradisional') !!}',
        columns: [
            { data: 'nama_pasar', name: 'nama_pasar' },
            { data: 'alamat', name: 'alamat' },
            { data: 'provinsi', name: 'provinsi' },
            { data: 'kabupaten', name: 'kabupaten' },
            { data: 'kecamatan', name: 'kecamatan' },
            { data: 'status', name: 'status' },
            { data: 'pengelola', name: 'pengelola' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' },
        ]
    });
});
</script>
@endpush