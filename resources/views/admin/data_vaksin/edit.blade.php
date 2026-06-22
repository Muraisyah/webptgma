@extends('layouts.app')
@section('title','Edit Vaksin')
@section('content')
<h3>Edit Vaksin</h3>
@include('partials.alerts')
<form action="{{ route('admin.data-vaksin.update',$vaksin->id_vaksin) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="mb-3"><label class="form-label">Nama Vaksin</label><input name="nama_vaksin" class="form-control" value="{{ old('nama_vaksin',$vaksin->nama_vaksin) }}" required maxlength="35"></div>
    <div class="mb-3"><label class="form-label">Foto (opsional)</label><input type="file" name="foto_vaksin" class="form-control"></div>
    @if(!empty($vaksin->foto_vaksin))
        <div class="mb-3"><img src="{{ $vaksin->foto_vaksin }}" style="max-width:260px;border:1px solid #ddd;padding:6px;border-radius:4px"></div>
    @endif
    <div><button class="btn btn-primary">Perbarui</button> <a href="{{ route('admin.data-vaksin.index') }}" class="btn btn-secondary">Batal</a></div>
</form>
@endsection
