@extends('layouts.app')
@section('title','Tambah Dokumen')
@section('content')
<h3>Tambah Dokumen Keberangkatan</h3>
@include('partials.alerts')
<form action="{{ route('admin.dokumen.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3"><label class="form-label">Pilih Jemaah</label><select name="id_jemaah" class="form-select">@foreach(App\Models\DataJemaah::all() as $j)<option value="{{ $j->id_jemaah }}">{{ $j->nama_jemaah }}</option>@endforeach</select></div>
    <div class="mb-3"><label class="form-label">Jenis Dokumen</label><input name="jenis_dokumen" class="form-control" value="{{ old('jenis_dokumen') }}"></div>
    <div class="mb-3"><label class="form-label">File Dokumen</label><input type="file" name="file_dokumen" class="form-control" required></div>
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.dokumen.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
