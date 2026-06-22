@extends('layouts.app')
@section('title','Edit Hotel')
@section('content')
<h3>Edit Hotel</h3>
@include('partials.alerts')
<form action="{{ route('admin.hotel.update',$hotel->id_hotel) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="mb-3"><label class="form-label">Nama Hotel</label><input name="nama_hotel" class="form-control" value="{{ old('nama_hotel',$hotel->nama_hotel) }}" required maxlength="50"></div>
    <div class="mb-3"><label class="form-label">Kota</label><input name="kota" class="form-control" value="{{ old('kota',$hotel->kota) }}" required maxlength="30"></div>
    <div class="mb-3"><label class="form-label">Kategori (opsional)</label><input name="kategori_hotel" class="form-control" value="{{ old('kategori_hotel',$hotel->kategori_hotel) }}" maxlength="15"></div>
    <button class="btn btn-primary">Perbarui</button>
    <a href="{{ route('admin.hotel.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
