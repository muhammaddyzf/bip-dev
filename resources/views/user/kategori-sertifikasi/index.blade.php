@extends('layouts.app-admin')
@section('title', 'Kategori Sertifikasi')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Kategori Sertifikasi</h1>
{{ Breadcrumbs::render('kategori-sertifikasi') }}

<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<a href="{{route('user.sertifikasi.kategori-sertifikasi.tambah')}}" class="btn btn-white"><i class="fa fa-plus"></i> Tambah Kategori Sertifikasi</a>
				<br>
				<table class="table table-bordered table-striped" id="kategori-sertifikasi">
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
    $('#kategori-sertifikasi').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! url('user/sertifikasi/data-kategori-sertifikasi') !!}',
        columns: [
            { data: 'KTSRT_NAMA', name: 'KTSRT_NAMA' },
            { data: 'KTSRT_KET', name: 'KTSRT_KET' },
            { data: 'action', name: 'action' },
        ]
    });
});
</script>
@endpush