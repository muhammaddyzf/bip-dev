@extends('layouts.app-admin')
@section('title', 'Event IKM')
@section('navbar')
navbar
@endsection

@push('styles')
<style type="text/css">
	.scrolling-wrapper {
  display: flex;
  flex-wrap: nowrap;
  overflow-x: auto;
}
</style>
@endpush

@section('content')
<h1 class="lead">Event IKM</h1>
{{-- {{ Breadcrumbs::render('tambah-ikm') }} --}}


<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-heading">
				{{ $ikm->IKM_NAMA }}
			</div>
			<div class="panel-body">
				<div class="scrolling-wrapper">
				@if(isset($eventData))
				<table class="table table-bordered">
					<thead>
						<th>Nama</th> 
		               <th>Panitia</th> 
		               <th>Ketua Panitia</th>
		               <th>Tema</th> 
		               <th>Tlp</th> 
		                <th>Web</th>  
		                <th>Tanggal Mulai</th> 
		                <th>Tanggal Akhir</th>  
		                <th>Keterangan</th>  
		                <th>Provinsi</th> 
		                <th>Kabupaten</th> 
		                <th>Kecamatan</th> 
		                <th>Desa</th> 
		                <th>Alamat</th> 
		                <th>Status Kehadiran</th> 
		                <th>Tanggal Datang</th> 
		                <th>Tanggal Pulang</th> 
		                <th>Nilai</th>
					</thead>
					@foreach($eventData as $item)
						<tbody>
							<tr>
								<td>{{ $item['nama'] }}</td> 
				               <td>{{ $item['panitia'] }}</td> 
				               <td>{{ $item['ketuaPanitia'] }}</td>
				               <td>{{ $item['tema'] }}</td> 
				               <td>{{ $item['tlp'] }}</td> 
				                <td>{{ $item['web'] }}</td>  
				                <td>{{ $item['tanggalMulai'] }}</td> 
				                <td>{{ $item['tanggalAkhir'] }}</td> 
				                <td>{{ $item['keterangan'] }}</td>  
				                <td>{{ $item['provinsi'] }}</td> 
				                <td>{{ $item['kabupaten'] }}</td> 
				                <td>{{ $item['kecamatan'] }}</td>
				                <td>{{ $item['desa'] }}</td>
				                <td>{{ $item['alamat'] }}</td>
				                <td>
				                	@if($item['statusKehadiran'] == 1)
										<span class="label label-success">Hadir</span>
				                	@else
										<span class="label label-danger">Tidak Hadir</span>
				                	@endif
				            	</td>
				                <td>{{ $item['tanggalDatang'] }}</td>
				                <td>{{ $item['tanggalPulang'] }}</td>
				                <td>{{ $item['tanggalNilai'] }}</td>
							</tr>
						</tbody>
					
					@endforeach
				</table>
				</div>
            	@else
					<center>Tidak ada data yang ditampilkan</center>
            	@endif

			</div>
		</div>
	</div>
</div>

@endsection
