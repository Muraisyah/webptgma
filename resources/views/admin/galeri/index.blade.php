@extends('layouts.app')
@section('title','Kelola Galeri')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
	<h3>Galeri Jemaah</h3>
	<a href="{{ route('admin.galeri.create') }}" class="btn btn-primary">Tambah Foto</a>
</div>
@include('partials.alerts')
@include('partials.filters')
@if($galeris->count() == 0)
	<div class="alert alert-info">Belum ada foto di galeri. <a href="{{ route('admin.galeri.create') }}">Tambah foto sekarang</a>.</div>
@endif
<div class="row">
@foreach($galeris as $g)
@php
	$src = $g->foto_jemaah;
	if($src && !preg_match('#^https?://#i',$src)){
		$src = asset(ltrim($src,'/'));
	}
@endphp
<div class="col-md-3 mb-3">
	<div class="card">
		@if($src)
			<a href="{{ route('admin.galeri.show',$g->id_galeri) }}"><img src="{{ $src }}" class="card-img-top" alt="{{ $g->judul_foto }}"></a>
		@endif
		<div class="card-body">
			<h6>{{ $g->judul_foto }}</h6>
			<p class="small">{{ \Illuminate\Support\Str::limit($g->deskripsi_foto,60) }}</p>
			<div class="small text-muted text-break">Path: {{ $g->foto_jemaah ?? '-' }}</div>
			<div class="d-flex mt-2">
				<a href="{{ route('admin.galeri.edit',$g->id_galeri) }}" class="btn btn-sm btn-warning me-2">Edit</a>
				<form action="{{ route('admin.galeri.destroy',$g->id_galeri) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Hapus</button></form>
			</div>
		</div>
	</div>
</div>
@endforeach
</div>
<div>{{ $galeris->links() }}</div>
@endsection
