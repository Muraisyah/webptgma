@extends('layouts.app')
@section('title','Detail Galeri')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                @if($galeri->foto_jemaah)
                    @php
                        $src = $galeri->foto_jemaah;
                        if(!preg_match('#^https?://#i',$src)){
                            $src = asset(ltrim($src,'/'));
                        }
                    @endphp
                    <img src="{{ $src }}" class="card-img-top" alt="{{ $galeri->judul_foto }}">
                @endif
                <div class="card-body">
                    <h4>{{ $galeri->judul_foto }}</h4>
                    <p class="text-muted">{{ $galeri->deskripsi_foto }}</p>
                    <p class="small text-muted">Diunggah: {{ $galeri->created_at }}</p>
                    <a href="{{ route('admin.galeri.edit',$galeri->id_galeri) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.galeri.destroy',$galeri->id_galeri) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Hapus</button></form>
                    <a href="{{ route('admin.galeri.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h6>Informasi</h6>
                    <p><strong>Pengunggah:</strong> {{ $galeri->user->nama_lengkap ?? '-' }}</p>
                    <p><strong>ID:</strong> {{ $galeri->id_galeri }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
