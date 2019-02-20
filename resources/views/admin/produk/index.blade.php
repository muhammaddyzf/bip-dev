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
				<div class="row">
					<div class="col-md-6">	
						<a href="{{route('admin.produk.tambah')}}" class="btn btn-white"><i class="fa fa-plus"></i> Tambah Produk</a>
					</div>
					<div class="col-md-6">
						<div class="pull-right">
							<form class="form-inline" role="form" action="{{ route('ikm.cetak-laporan') }}" method="post">@csrf
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
        ajax: '{!! url('admin/produk/data-produk') !!}',
        columns: [
            { data: 'produk', name: 'produk' },
            { data: 'image', name: 'image' },
            { data: 'action', name: 'action' },
        ]
    });
});
</script>
@endpush