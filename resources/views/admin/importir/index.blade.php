@extends('layouts.app-admin')
@section('title', 'Importir')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Importir</h1>
{{-- {{ Breadcrumbs::render('importir') }} --}}

<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
						<a href="{{route('importir.add')}}" class="btn btn-white"><i class="fa fa-plus"></i> Tambah Importir</a>
					</div>
					<div class="col-md-6">
						<div class="pull-right">
							<form class="form-inline" role="form" action="{{ route('importir.cetak-laporan') }}" method="post">@csrf
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
				<table class="table table-bordered table-striped" id="importir">
					<thead>
						<tr>
							<th class="text-center">Nama Perusahaan</th>
							<th class="text-center">Alamat</th>
							<th class="text-center">NPWP</th>
							<th class="text-center">Nama Pemilik</th>
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
    $('#importir').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! url('admin/data-importir') !!}',
        columns: [
            { data: 'nama_perusahaan', name: 'nama_perusahaan' },
            { data: 'alamat_perusahaan', name: 'alamat_perusahaan' },
            { data: 'npwp', name: 'npwp' },
            { data: 'nama_pemilik', name: 'nama_pemilik' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' },
        ]
    });
});
</script>
@endpush