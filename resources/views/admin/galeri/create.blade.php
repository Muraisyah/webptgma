@extends('layouts.app')
@section('title','Tambah Galeri')
@section('content')
<h3>Tambah Foto Galeri</h3>
@include('partials.alerts')
<form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3"><label class="form-label">Judul</label><input name="judul_foto" class="form-control" value="{{ old('judul_foto') }}" required></div>
    <div class="mb-3"><label class="form-label">Deskripsi</label><textarea name="deskripsi_foto" class="form-control">{{ old('deskripsi_foto') }}</textarea></div>
    <div class="mb-3"><label class="form-label">Foto (URL atau upload)</label><input type="file" name="foto_jemaah_file" class="form-control"><small class="form-text text-muted">Jika mengupload, file akan disimpan dan path disimpan.</small></div>
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
