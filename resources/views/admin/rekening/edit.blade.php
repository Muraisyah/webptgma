@extends('layouts.app')
@section('title','Edit Rekening')
@section('content')
<h3>Edit Rekening</h3>
@include('partials.alerts')
<form action="{{ route('admin.rekening.update',$rekening->id_rekening) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label">Nama Bank</label>
        <input type="text" name="nama_bank" class="form-control" value="{{ old('nama_bank',$rekening->nama_bank) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nomor Rekening</label>
        <input type="text" name="nomor_rekening" class="form-control" value="{{ old('nomor_rekening',$rekening->nomor_rekening) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Atas Nama</label>
        <input type="text" name="atas_nama" class="form-control" value="{{ old('atas_nama',$rekening->atas_nama) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="Aktif" {{ $rekening->status=='Aktif'?'selected':'' }}>Aktif</option>
            <option value="Nonaktif" {{ $rekening->status=='Nonaktif'?'selected':'' }}>Nonaktif</option>
        </select>
    </div>
    <button class="btn btn-primary">Perbarui</button>
    <a href="{{ route('admin.rekening.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
