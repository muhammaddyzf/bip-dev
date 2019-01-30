@extends('layouts.app-admin')
@section('title', 'Kategori Produk')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Kategori Produk</h1>
{{ Breadcrumbs::render('kategori-produk') }}

<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<a href="{{route('admin.produk.kategori-produk.tambah')}}" class="btn btn-white"><i class="fa fa-plus"></i> Tambah Kategori Produk</a>
				<br>
				<table class="table table-bordered table-striped" id="kategori-produk">
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
    $('#kategori-produk').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! url('admin/produk/data-kategori-produk') !!}',
        columns: [
            { data: 'KTPRDK_NAMA', name: 'KTPRDK_NAMA' },
            { data: 'KTPRDK_KET', name: 'KTPRDK_KET' },
            { data: 'action', name: 'action' },
        ]
    });
});
</script>
@endpush