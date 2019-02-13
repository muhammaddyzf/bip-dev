@extends('layouts.app-admin')
@section('title', 'Tambah Industri Besar')
@section('navbar')
navbar
@endsection

@section('content')
<h1 class="lead">Industri Besar</h1>
{{-- {{ Breadcrumbs::render('tambah-ikm') }} --}}


<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="panel panel-default paper-shadow" data-z="0.5">
			<div class="panel-body">
				<form action="{{ route('admin.industri-besar.import') }}" method="post" enctype="multipart/form-data">
					@csrf
					<label>Format File : .xlsx</label>
					<input class="form-control" type="file" name="file"><br>
					<input type="submit" class="btn btn-primary" value="upload">
				</form>
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
	$(function(){
		confirmStore('btn-save','form-ikm',"Your previous data will change");
	});
</script>
@endpush

