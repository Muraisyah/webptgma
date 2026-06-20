@extends('layouts.app')
@section('title','Edit Galeri')
@section('content')
<h3>Edit Foto Galeri</h3>
@include('partials.alerts')
<form action="{{ route('admin.galeri.update',$galeri->id_galeri) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="mb-3"><label class="form-label">Judul</label><input name="judul_foto" class="form-control" value="{{ old('judul_foto',$galeri->judul_foto) }}" required></div>
    <div class="mb-3"><label class="form-label">Deskripsi</label><textarea name="deskripsi_foto" class="form-control">{{ old('deskripsi_foto',$galeri->deskripsi_foto) }}</textarea></div>
    <div class="mb-3"><label class="form-label">Ganti Foto</label><input type="file" name="foto_jemaah_file" class="form-control"></div>
    <button class="btn btn-primary">Perbarui</button>
    <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
