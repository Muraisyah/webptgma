@extends('layouts.app')
@section('title','Detail Jemaah')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h3 class="mb-0">{{ $jemaah->nama_jemaah }}</h3>
        <small class="text-muted">ID: {{ $jemaah->id_jemaah }} • Dibuat: {{ $jemaah->created_at? $jemaah->created_at->format('d-m-Y H:i'): '-' }}</small>
    </div>
    <div>
        <a href="{{ route('admin.data-jemaah.edit',$jemaah->id_jemaah) }}" class="btn btn-warning btn-sm">Edit</a>
        <a href="{{ route('admin.data-jemaah.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-7">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Informasi Pribadi</h5>
                <table class="table table-borderless mb-0">
                    <tr><th class="w-50">Nama</th><td>{{ $jemaah->nama_jemaah }}</td></tr>
                    <tr><th>Nama Ayah</th><td>{{ $jemaah->nama_ayah ?? '-' }}</td></tr>
                    <tr><th>NIK</th><td>{{ $jemaah->nik ?? '-' }}</td></tr>
                    <tr><th>Jenis Kelamin</th><td>{{ $jemaah->jenis_kelamin ?? '-' }}</td></tr>
                    <tr><th>Tempat Lahir</th><td>{{ $jemaah->tempat_lahir ?? '-' }}</td></tr>
                    <tr><th>Tanggal Lahir</th><td>{{ $jemaah->tgl_lahir ?? '-' }}</td></tr>
                    <tr><th>Alamat</th><td style="white-space:pre-wrap">{{ $jemaah->alamat ?? '-' }}</td></tr>
                    <tr><th>Kewarganegaraan</th><td>{{ $jemaah->kewarganegaraan ?? '-' }}</td></tr>
                    <tr><th>Status Pernikahan</th><td>{{ $jemaah->status_pernikahan ?? '-' }}</td></tr>
                    <tr><th>ID User</th><td>{{ $jemaah->id_user ?? '-' }}</td></tr>
                </table>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Relasi & Ringkasan</h5>
                <div class="mb-2">
                    <strong>Passport:</strong>
                    @if($jemaah->passport)
                        <a href="{{ route('admin.data-passport.show',$jemaah->passport->id_passport) }}">{{ $jemaah->passport->nomor_passport ?? $jemaah->passport->nama_passport }}</a>
                        <div class="text-muted small">Exp: {{ $jemaah->passport->exp_passport ?? '-' }} • Status: {{ $jemaah->passport->status_passport ?? '-' }}</div>
                    @else
                        -
                    @endif
                </div>
                <div class="mb-2">
                    <strong>Visa:</strong>
                    @if($jemaah->visa)
                        <a href="{{ route('admin.data-visa.show',$jemaah->visa->id_visa) }}">{{ $jemaah->visa->nama_visa }}</a>
                        <div class="text-muted small">Nomor: {{ $jemaah->visa->nomor_visa ?? '-' }} • Exp: {{ $jemaah->visa->tgl_exp_visa ?? '-' }}</div>
                    @else - @endif
                </div>
                <div>
                    <strong>Vaksin:</strong>
                    @if($jemaah->vaksin)
                        <a href="{{ route('admin.data-vaksin.show',$jemaah->vaksin->id_vaksin) }}">{{ $jemaah->vaksin->nama_vaksin }}</a>
                    @else - @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Galeri Dokumen</h5>
                <div class="d-flex flex-wrap">
                    @foreach(['foto_ktp'=>'KTP','foto_kk'=>'KK','foto_akte'=>'Akte','foto_buku_nikah'=>'Buku Nikah','foto_ktp_ayah'=>'KTP Ayah','foto_ktp_ibu'=>'KTP Ibu'] as $field=>$label)
                        @if(!empty($jemaah->{$field}))
                            <div class="me-2 mb-2 text-center">
                                <a href="{{ asset(ltrim($jemaah->{$field}, '/')) }}" target="_blank">
                                    <img src="{{ asset(ltrim($jemaah->{$field}, '/')) }}" style="max-width:220px;border:1px solid #ddd;padding:6px;border-radius:6px;display:block">
                                </a>
                                <small class="d-block mt-1">{{ $label }}</small>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
