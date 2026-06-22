@extends('layouts.app')
@section('title','Tambah Passport')
@section('content')
<h3>Tambah Passport</h3>
@include('partials.alerts')
<form action="{{ route('admin.data-passport.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3"><label class="form-label">Nama</label><input name="nama_passport" class="form-control" value="{{ old('nama_passport') }}" required maxlength="35"></div>
    <div class="mb-3"><label class="form-label">Nama Tambahan (opsional)</label><input name="nama_tambahan" class="form-control" value="{{ old('nama_tambahan') }}" maxlength="35"></div>
    <div class="mb-3"><label class="form-label">Nomor Passport</label><input name="nomor_passport" class="form-control" value="{{ old('nomor_passport') }}" required maxlength="9"></div>
    <div class="mb-3"><label class="form-label">Tempat Lahir</label><input name="tempat_lahir_pass" class="form-control" value="{{ old('tempat_lahir_pass') }}" maxlength="30"></div>
    <div class="mb-3"><label class="form-label">Tanggal Lahir</label><input type="text" name="tgl_lahir_pass" class="form-control flatpickr" value="{{ old('tgl_lahir_pass') }}"></div>
    <div class="mb-3"><label class="form-label">Tempat Pembuatan</label><input name="tempat_pembuatan" class="form-control" value="{{ old('tempat_pembuatan') }}" maxlength="30"></div>
    <div class="mb-3"><label class="form-label">Tanggal Pembuatan</label><input type="text" name="tgl_pembuatan" class="form-control flatpickr" value="{{ old('tgl_pembuatan') }}"></div>
    <div class="mb-3"><label class="form-label">Expired</label><input type="text" name="exp_passport" class="form-control flatpickr" value="{{ old('exp_passport') }}"></div>
    <div class="mb-3"><label class="form-label">Foto Identitas (opsional)</label><input type="file" name="foto_identitas_pass" class="form-control"></div>
    <div class="mb-3"><label class="form-label">Foto Nama Tambahan (opsional)</label><input type="file" name="foto_nama_tambahan" class="form-control"></div>
    <div class="mb-3"><label class="form-label">Status</label><select name="status_passport" class="form-select"><option value="Aktif">Aktif</option><option value="Expired">Expired</option></select></div>
    <div><button class="btn btn-primary">Simpan</button> <a href="{{ route('admin.data-passport.index') }}" class="btn btn-secondary">Batal</a></div>
</form>
@endsection
