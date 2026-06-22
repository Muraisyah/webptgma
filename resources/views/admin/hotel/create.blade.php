@extends('layouts.app')
@section('title','Buat Hotel')
@section('content')
<h3>Buat Hotel</h3>
@include('partials.alerts')
<form action="{{ route('admin.hotel.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3"><label class="form-label">Nama Hotel</label><input name="nama_hotel" class="form-control" value="{{ old('nama_hotel') }}" required maxlength="50"></div>
    <div class="mb-3"><label class="form-label">Kota</label><input name="kota" class="form-control" value="{{ old('kota') }}" required maxlength="30"></div>
    <div class="mb-3"><label class="form-label">Kategori (opsional)</label><input name="kategori_hotel" class="form-control" value="{{ old('kategori_hotel') }}" maxlength="15"></div>
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.hotel.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
