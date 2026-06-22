@extends('layouts.app')
@section('title','Tambah Visa')
@section('content')
<h3>Tambah Visa</h3>
@include('partials.alerts')
<form action="{{ route('admin.data-visa.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3"><label class="form-label">Nama Visa</label><input name="nama_visa" class="form-control" value="{{ old('nama_visa') }}" required maxlength="35"></div>
    <div class="mb-3"><label class="form-label">Nomor Visa</label><input name="nomor_visa" class="form-control" value="{{ old('nomor_visa') }}" maxlength="15"></div>
    <div class="mb-3"><label class="form-label">Tanggal Berlaku</label><input type="text" name="tgl_berlaku_visa" class="form-control flatpickr" value="{{ old('tgl_berlaku_visa') }}"></div>
    <div class="mb-3"><label class="form-label">Tanggal Exp</label><input type="text" name="tgl_exp_visa" class="form-control flatpickr" value="{{ old('tgl_exp_visa') }}"></div>
    <div class="mb-3"><label class="form-label">Foto (opsional)</label><input type="file" name="foto_visa" class="form-control"></div>
    <div><button class="btn btn-primary">Simpan</button> <a href="{{ route('admin.data-visa.index') }}" class="btn btn-secondary">Batal</a></div>
</form>
@endsection
