@extends('layouts.app-admin')
@section('title', 'Kategori pengguna')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Kategori Pengguna</h1>
{{ Breadcrumbs::render('kategori-pengguna') }}

<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<a href="{{route('admin.pengguna.kategori-pengguna.tambah')}}" class="btn btn-white"><i class="fa fa-plus"></i> Tambah Kategori Pengguna</a>
				<br>
				<table class="table table-bordered table-striped" id="kategori-pengguna">
					<thead>
						<tr>
							<th class="text-center">Nama Kategori</th>
							<th class="text-center">Keterangan</th>
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
        ajax: '{!! url('admin/pengguna/data-kategori-pengguna') !!}',
        columns: [
            { data: 'KTPNG_NAMA', name: 'KTPNG_NAMA' },
            { data: 'KTPNG_KET', name: 'KTPNG_KET' },
            { data: 'action', name: 'action' },
        ]
    });
});
</script>
@endpush