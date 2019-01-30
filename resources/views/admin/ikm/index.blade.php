@extends('layouts.app-admin')
@section('title', 'IKM')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">IKM</h1>
{{ Breadcrumbs::render('ikm') }}

<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<a href="{{route('admin.ikm.cetak-laporan-excel', ['type'=>'xlsx'])}}" class="btn btn-white pull-right"><i class="fa fa-download"></i> Cetak Laporan </a>
				<a href="{{route('admin.ikm.tambah')}}" class="btn btn-white"><i class="fa fa-plus"></i> Tambah </a>
				<a href="{{route('admin.ikm.upload')}}" class="btn btn-white pull-right"><i class="fa fa-upload"></i> Import Excel </a>
				<a href="{{route('admin.ikm.download-excel')}}" class="btn btn-white pull-right"><i class="fa fa-download"></i> Download Format Excel </a>

				<br>
				<table class="table table-bordered table-striped" id="kategori-pengguna">
					<thead>
						<tr>
							<th class="text-center">Nama IKM</th>
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
        ajax: '{!! url('admin/ikm/data-ikm') !!}',
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