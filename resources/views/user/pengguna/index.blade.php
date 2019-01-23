@extends('layouts.app-admin')
@section('title', 'Pengguna')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Pengguna</h1>
{{ Breadcrumbs::render('pengguna') }}

<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<a href="{{route('user.pengguna.tambah')}}" class="btn btn-white"><i class="fa fa-plus"></i> Tambah Pengguna</a>
				<br>
				<table class="table table-bordered table-striped" id="data-pengguna">
					<thead>
						<tr>
							<th class="text-center">Nama</th>
							<th class="text-center">Username</th>
							<th class="text-center">Email</th>
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
    $('#data-pengguna').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! url('user/pengguna/data-pengguna') !!}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'username', name: 'username' },
            { data: 'email', name: 'email' },
            { data: 'action', name: 'action' },
        ]
    });
});
</script>
@endpush