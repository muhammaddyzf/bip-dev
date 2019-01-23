@extends('layouts.app-admin')
@section('title', 'Produk IKM')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Produk IKM</h1>
{{-- {{ Breadcrumbs::render('tambah-ikm') }} --}}


<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-heading">
				{{ $ikm->IKM_NAMA }}
			</div>
			<div class="panel-body">

				@if(isset($dataArray))
				<div class="row" data-toggle="isotope">
					@foreach($dataArray as $item)
					<div class="item col-xs-12 col-sm-6 col-lg-3">
						<div class="panel panel-default paper-shadow" data-z="0.5">
							<div class="cover overlay cover-image-full hover">
								<span class="img icon-block height-150 bg-default"></span>
								<a href="#" class="padding-none overlay overlay-full icon-block bg-default">
									<span class="v-center">
										<img src="{{ $item['thumbnail'] }}" style="width: 100%;height: 200px;">
									</span>
								</a>

								<a href="#" class="overlay overlay-full overlay-hover overlay-bg-white">
									<span class="v-center">
										<span class="btn btn-circle btn-white btn-lg"><i class="fa fa-dropbox"></i></span>
									</span>
								</a>
							</div>

							<div class="panel-body">
								<h4><a href="#">{{ $item['nama'] }}</a></h4>
								<strong>KBLI :</strong>
								<p>{{ $item['kbli'] }}</p>
								<strong>Komposisi :</strong>
								<p>{{ $item['komposisi'] }}</p>
								<p class="small margin-none">
									@for($i=1; $i <= 5; $i++)
										@if($i <= $item['rating'])
											<span class="fa fa-fw fa-star text-yellow-800"></span>
										@else
											<span class="fa fa-fw fa-star-o text-yellow-800"></span>
										@endif
									@endfor
								</p>
							</div>
						</div>
					</div>
					@endforeach
            	</div>
            	@else
					<center>Tidak ada data yang ditampilkan</center>
            	@endif

{{-- 	            <ul class="pagination margin-top-none">
	            	{{ $dataArray->links() }}
	            </ul> --}}

			</div>
		</div>
	</div>
</div>

@endsection
