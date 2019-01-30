@extends('layouts.app-admin')
@section('title', 'Sertifikasi IKM')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Sertifikasi IKM</h1>
{{-- {{ Breadcrumbs::render('tambah-ikm') }} --}}


<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-heading">
				{{ $ikm->IKM_NAMA }}
			</div>
			<div class="panel-body">
				
				@if(isset($sertifikasiArray))
				<table class="table table-bordered">
					<thead>
						<th>Nama Sertifikat</th>
						<th>Tanggal Daftar</th>
						<th>Tanggal ACC</th>
						<th>Masa Berlaku Dari</th>
						<th>Masa Berlaku Sampai</th>
						<th>Keterangan</th>
					</thead>
					@foreach($sertifikasiArray as $item)
						<tbody>
							<tr>
								<td>{{ $item['name'] }}</td>
								<td>{{ $item['register'] }}</td>
								<td>{{ $item['tanggalAcc'] }}</td>
								<td>{{ $item['masaBerlakuDari'] }}</td>
								<td>{{ $item['masaBerlakuSampai'] }}</td>
								<td>{{ $item['keterangan'] }}</td>
							</tr>
						</tbody>
					
					@endforeach
				</table>
            	@else
					<center>Tidak ada data yang ditampilkan</center>
            	@endif

			</div>
		</div>
	</div>
</div>

@endsection
