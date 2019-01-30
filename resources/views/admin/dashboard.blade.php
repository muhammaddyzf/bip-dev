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
				Selamat Datang di Halaman Admin.
			</div>
		</div>
	</div>
</div>
@endsection

