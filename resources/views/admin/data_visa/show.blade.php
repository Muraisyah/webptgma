@extends('layouts.app')
@section('title','Detail Visa')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h3 class="mb-0">Visa: {{ $visa->nama_visa }}</h3>
        <small class="text-muted">ID: {{ $visa->id_visa }}</small>
    </div>
    <div>
        <a href="{{ route('admin.data-visa.edit',$visa->id_visa) }}" class="btn btn-warning btn-sm">Edit</a>
        <a href="{{ route('admin.data-visa.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Detail Visa</h5>
                <table class="table table-sm">
                    <tr><th class="w-50">Nama</th><td>{{ $visa->nama_visa ?? '-' }}</td></tr>
                    <tr><th>Nomor</th><td>{{ $visa->nomor_visa ?? '-' }}</td></tr>
                    <tr><th>Tgl Berlaku</th><td>{{ $visa->tgl_berlaku_visa ?? '-' }}</td></tr>
                    <tr><th>Tgl Exp</th><td>{{ $visa->tgl_exp_visa ?? '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-body text-center">
                <h5 class="card-title">Gambar</h5>
                @if($visa->foto_visa)
                    <a href="{{ asset(ltrim($visa->foto_visa,'/')) }}" target="_blank"><img src="{{ asset(ltrim($visa->foto_visa,'/')) }}" style="max-width:100%"></a>
                    <div class="text-muted small mt-2">Foto Visa</div>
                @else
                    <div class="text-muted">Tidak ada gambar</div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
