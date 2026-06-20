@extends('layouts.app')
@section('title','Edit Dokumen')
@section('content')
<h3>Edit Dokumen</h3>
@include('partials.alerts')
<form action="{{ route('admin.dokumen.update',$dokumen->id_dokumen) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="mb-3"><label class="form-label">Pilih Jemaah</label><select name="id_jemaah" class="form-select">@foreach(App\Models\DataJemaah::all() as $j)<option value="{{ $j->id_jemaah }}" {{ $dokumen->id_jemaah==$j->id_jemaah?'selected':'' }}>{{ $j->nama_jemaah }}</option>@endforeach</select></div>
    <div class="mb-3"><label class="form-label">Jenis Dokumen</label><input name="jenis_dokumen" class="form-control" value="{{ old('jenis_dokumen',$dokumen->jenis_dokumen) }}"></div>
    <div class="mb-3"><label class="form-label">Ganti File (opsional)</label><input type="file" name="file_dokumen" class="form-control"></div>
    <button class="btn btn-primary">Perbarui</button>
    <a href="{{ route('admin.dokumen.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
