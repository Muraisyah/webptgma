@extends('layouts.app')

@section('title','Admin Dashboard')

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h3 class="card-title">Selamat datang</h3>
					<p class="card-text">Anda masuk sebagai <strong>{{ auth()->user()->role }}</strong>.</p>
					<p class="card-text">Gunakan menu sebelah kiri untuk mengelola semua data.</p>
				</div>
			</div>
		</div>
	</div>
@endsection