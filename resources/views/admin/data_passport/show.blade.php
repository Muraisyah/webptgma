@extends('layouts.app')
@section('title','Detail Passport')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h3 class="mb-0">Passport: {{ $passport->nomor_passport ?? $passport->nama_passport }}</h3>
        <small class="text-muted">ID: {{ $passport->id_passport }}</small>
    </div>
    <div>
        <a href="{{ route('admin.data-passport.edit',$passport->id_passport) }}" class="btn btn-warning btn-sm">Edit</a>
        <a href="{{ route('admin.data-passport.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Detail Passport</h5>
                <table class="table table-sm">
                    <tr><th class="w-50">Nama</th><td>{{ $passport->nama_passport ?? '-' }}</td></tr>
                    <tr><th>Nama Tambahan</th><td>{{ $passport->nama_tambahan ?? '-' }}</td></tr>
                    <tr><th>Nomor</th><td>{{ $passport->nomor_passport ?? '-' }}</td></tr>
                    <tr><th>Tempat Lahir</th><td>{{ $passport->tempat_lahir_pass ?? '-' }}</td></tr>
                    <tr><th>Tgl Lahir</th><td>{{ $passport->tgl_lahir_pass ?? '-' }}</td></tr>
                    <tr><th>Tempat Pembuatan</th><td>{{ $passport->tempat_pembuatan ?? '-' }}</td></tr>
                    <tr><th>Tgl Pembuatan</th><td>{{ $passport->tgl_pembuatan ?? '-' }}</td></tr>
                    <tr><th>Exp Passport</th><td>{{ $passport->exp_passport ?? '-' }}</td></tr>
                    <tr><th>Status</th><td>{{ $passport->status_passport ?? '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Gambar</h5>
                @if($passport->foto_identitas_pass)
                    <div class="mb-3 text-center">
                        <a href="{{ asset(ltrim($passport->foto_identitas_pass,'/')) }}" target="_blank"><img src="{{ asset(ltrim($passport->foto_identitas_pass,'/')) }}" style="max-width:100%"></a>
                        <div class="text-muted small">Foto Identitas</div>
                    </div>
                @endif
                @if($passport->foto_nama_tambahan)
                    <div class="mb-3 text-center">
                        <a href="{{ asset(ltrim($passport->foto_nama_tambahan,'/')) }}" target="_blank"><img src="{{ asset(ltrim($passport->foto_nama_tambahan,'/')) }}" style="max-width:100%"></a>
                        <div class="text-muted small">Foto Nama Tambahan</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
