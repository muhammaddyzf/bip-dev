@extends('layouts.app-admin')
@section('title', 'Sertifikasi')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Sertifikasi</h1>
{{ Breadcrumbs::render('sertifikasi') }}

<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<a href="{{route('user.sertifikasi.tambah')}}" class="btn btn-white"><i class="fa fa-plus"></i> Tambah Sertifikasi</a>
				<br>
				<table class="table table-bordered table-striped" id="data-sertifikasi">
					<thead>
						<tr>
							<th class="text-center">Sertifikasi</th>
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
    $('#data-sertifikasi').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! url('user/sertifikasi/data-sertifikasi') !!}',
        columns: [
            { data: 'sertifikasi', name: 'sertifikasi' },
            { data: 'action', name: 'action' },
        ]
    });
});
</script>
@endpush