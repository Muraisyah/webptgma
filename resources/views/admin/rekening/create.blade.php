@extends('layouts.app')
@section('title','Buat Rekening')
@section('content')
<h3>Buat Rekening Baru</h3>
@include('partials.alerts')
<form action="{{ route('admin.rekening.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Nama Bank</label>
        <input type="text" name="nama_bank" class="form-control" value="{{ old('nama_bank') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nomor Rekening</label>
        <input type="text" name="nomor_rekening" class="form-control" value="{{ old('nomor_rekening') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Atas Nama</label>
        <input type="text" name="atas_nama" class="form-control" value="{{ old('atas_nama') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="Aktif">Aktif</option>
            <option value="Nonaktif">Nonaktif</option>
        </select>
    </div>
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.rekening.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
