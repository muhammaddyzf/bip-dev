@extends('layouts.app-admin')
@section('title', 'Dashboard')
@section('navbar')
navbar
@endsection

@section('content')
<div class="page-section">
	<h1 class="text-display-1">Dashboard</h1>
</div>

{{-- {{ Breadcrumbs::render('dashboard') }} --}}

<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-4">
						
						<div class="panel panel-default">
			              <div class="media v-middle">
			                <div class="media-left">
			                  <div class="bg-green-400 text-white">
			                    <div class="panel-body">
			                      <i class="fa fa-institution fa-fw fa-2x"></i>
			                    </div>
			                  </div>
			                </div>
			                <div class="media-body">	
			                	<p>Total IKM</p>		                  
		                        <h4 class="margin-none">{{ $totalIkm }}</h4>
			                </div>
			              </div>
			            </div>

					</div>
					<div class="col-md-4">
						
						<div class="panel panel-default">
			              <div class="media v-middle">
			                <div class="media-left">
			                  <div class="bg-green-400 text-white">
			                    <div class="panel-body">
			                      <i class="fa fa-building fa-fw fa-2x"></i>
			                    </div>
			                  </div>
			                </div>
			                <div class="media-body">
			                	<p>Total Industri Besar</p>		                  
		                        <h4 class="margin-none">{{ $totalIndustriBesar }}</h4>
			                </div>
			              </div>
			            </div>

					</div>
					<div class="col-md-4">
						
						<div class="panel panel-default">
			              <div class="media v-middle">
			                <div class="media-left">
			                  <div class="bg-green-400 text-white">
			                    <div class="panel-body">
			                      <i class="fa fa-dropbox fa-fw fa-2x"></i>
			                    </div>
			                  </div>
			                </div>
			                <div class="media-body">
			                	<p>Total Produk</p>		                  
		                        <h4 class="margin-none">{{ $totalProduk }}</h4>
			                </div>
			              </div>
			            </div>

					</div>
				</div>
				

				<h1 class="lead">Agenda Kegiatan Pelatihan</h1>
				<div class="row">
					<div class="col-md-8 col-lg-12">
						<div class="panel panel-default paper-shadow" data-z="0.5">
							<div class="panel-body">
								<table class="table table-bordered table-striped" id="event">
									<thead>
										<tr>
											<th class="text-center">Nama Event</th>
											<th class="text-center">Tema</th>
											<th class="text-center">Tanggal Mulai</th>
											<th class="text-center">Tanggal Berakhir</th>
											<th class="text-center">Proses</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
@endsection


@push('scripts')
<script type="text/javascript">
$(function() {
    $('#event').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! url('admin/event/data-event') !!}',
        columns: [
            { data: 'EVT_NAMA', name: 'EVT_NAMA' },
            { data: 'EVT_TEMA', name: 'EVT_TEMA' },
            { data: 'EVT_DTDARI', name: 'EVT_DTDARI' },
            { data: 'EVT_DTSAMPAI', name: 'EVT_DTSAMPAI' },
            { data: 'action', name: 'action' },
        ]
    });
});
</script>
@endpush

