@extends('layouts.app')
@section('title','Detail Vaksin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h3 class="mb-0">Vaksin: {{ $vaksin->nama_vaksin }}</h3>
        <small class="text-muted">ID: {{ $vaksin->id_vaksin }}</small>
    </div>
    <div>
        <a href="{{ route('admin.data-vaksin.edit',$vaksin->id_vaksin) }}" class="btn btn-warning btn-sm">Edit</a>
        <a href="{{ route('admin.data-vaksin.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-sm">
            <tr><th class="w-50">Nama Vaksin</th><td>{{ $vaksin->nama_vaksin ?? '-' }}</td></tr>
        </table>
        <div class="mt-3 text-center">
            @if($vaksin->foto_vaksin)
                <a href="{{ asset(ltrim($vaksin->foto_vaksin,'/')) }}" target="_blank"><img src="{{ asset(ltrim($vaksin->foto_vaksin,'/')) }}" style="max-width:320px"></a>
                <div class="text-muted small mt-2">Foto Vaksin</div>
            @else
                <div class="text-muted">Tidak ada gambar</div>
            @endif
        </div>
    </div>
</div>

@endsection
