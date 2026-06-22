@extends('layouts.app')
@section('title','Tambah Vaksin')
@section('content')
<h3>Tambah Vaksin</h3>
@include('partials.alerts')
<form action="{{ route('admin.data-vaksin.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3"><label class="form-label">Nama Vaksin</label><input name="nama_vaksin" class="form-control" value="{{ old('nama_vaksin') }}" required maxlength="35"></div>
    <div class="mb-3"><label class="form-label">Foto (opsional)</label><input type="file" name="foto_vaksin" class="form-control"></div>
    <div><button class="btn btn-primary">Simpan</button> <a href="{{ route('admin.data-vaksin.index') }}" class="btn btn-secondary">Batal</a></div>
</form>
@endsection
