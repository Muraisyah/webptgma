@extends('layouts.app')
@section('title','Edit Hotel')
@section('content')
<h3>Edit Hotel</h3>
@include('partials.alerts')
<form action="{{ route('admin.hotel.update',$hotel->id_hotel) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="mb-3"><label class="form-label">Nama Hotel</label><input name="nama_hotel" class="form-control" value="{{ old('nama_hotel',$hotel->nama_hotel) }}" required></div>
    <div class="mb-3"><label class="form-label">Alamat</label><input name="alamat_hotel" class="form-control" value="{{ old('alamat_hotel',$hotel->alamat_hotel) }}"></div>
    <div class="mb-3"><label class="form-label">Ganti Foto (opsional)</label><input type="file" name="foto_hotel" class="form-control"></div>
    <button class="btn btn-primary">Perbarui</button>
    <a href="{{ route('admin.hotel.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
