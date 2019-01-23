@extends('layouts.app-admin')
@section('title', 'Produk')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Produk</h1>
{{ Breadcrumbs::render('produk') }}

<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<a href="{{route('user.produk.tambah')}}" class="btn btn-white"><i class="fa fa-plus"></i> Tambah Produk</a>
				<br>
				<table class="table table-bordered table-striped" id="data-produk">
					<thead>
						<tr>
							<th class="text-center">Produk</th>
							<th class="text-center">Image</th>
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
    $('#data-produk').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! url('user/produk/data-produk') !!}',
        columns: [
            { data: 'produk', name: 'produk' },
            { data: 'image', name: 'image' },
            { data: 'action', name: 'action' },
        ]
    });
});
</script>
@endpush