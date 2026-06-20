@extends('layouts.app')
@extends('layouts.app')
@section('title','Detail Paket')
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h3 class="mb-1">{{ $paket->nama_paket }}</h3>
                        <small class="text-muted">ID: {{ $paket->id_paket }} • Dibuat: {{ $paket->created_at ? $paket->created_at->format('d M Y') : '-' }}</small>
                    </div>
                    <div>
                        <a href="{{ route('admin.paket.edit',$paket->id_paket) }}" class="btn btn-sm btn-outline-light me-2">Edit</a>
                        <a href="{{ route('admin.paket.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
                    </div>
                </div>

                @if($paket->foto_paket)
                    <div class="mb-3 text-center">
                        <img src="{{ asset(ltrim($paket->foto_paket,'/')) }}" class="img-fluid rounded" style="max-height:420px;object-fit:cover;width:100%" alt="{{ $paket->nama_paket }}" onerror="this.onerror=null;this.src='data:image/svg+xml;utf8,<svg xmlns=\\'http://www.w3.org/2000/svg\\' width=\\'640\\' height=\\'360\\'><rect width=\\'100%\\' height=\\'100%\\' fill=\\'%23f6f6f6\\'/><text x=\\'50%\\' y=\\'50%\\' dominant-baseline=\\'middle\\' text-anchor=\\'middle\\' fill=\\'%23888\\' font-size=\\'24\\'>No Image</text></svg>'">
                    </div>
                @endif

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="bg-white p-3 rounded shadow-sm">
                            <div class="small text-muted">Durasi</div>
                            <div class="fw-bold">{{ $paket->durasi_perjalanan ?? '-' }} hari</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-white p-3 rounded shadow-sm">
                            <div class="small text-muted">Keberangkatan</div>
                            <div class="fw-bold">{{ $paket->tgl_keberangkatan ? $paket->tgl_keberangkatan->format('d M Y') : '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-white p-3 rounded shadow-sm">
                            <div class="small text-muted">Kepulangan</div>
                            <div class="fw-bold">{{ $paket->tgl_kepulangan ? $paket->tgl_kepulangan->format('d M Y') : '-' }}</div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="small text-muted">Harga</div>
                        <div class="h5">Rp {{ $paket->harga_paket ? number_format($paket->harga_paket,0,',','.') : '-' }}</div>
                    </div>
                    <div class="col-md-4">
                        <div class="small text-muted">Seat tersedia</div>
                        <div class="fw-bold">{{ $paket->seat_tersedia ?? '-' }}</div>
                    </div>
                    <div class="col-md-4">
                        <div class="small text-muted">Kuota</div>
                        <div class="fw-bold">{{ $paket->kuota_paket ?? '-' }}</div>
                    </div>
                </div>

                <hr>

                <div class="mb-3"><div class="small text-muted">Maskapai</div><div class="fw-bold">{{ $paket->maskapai ?? '-' }}</div></div>
                <div class="mb-3"><div class="small text-muted">Status</div>
                    @if($paket->status_paket == 'Aktif')
                        <span class="badge bg-success">Aktif</span>
                    @else
                        <span class="badge bg-secondary">Nonaktif</span>
                    @endif
                </div>

                <div class="mb-3"><div class="small text-muted">Deskripsi</div><div class="card p-3">{!! nl2br(e($paket->deskripsi)) !!}</div></div>

                <div class="small text-muted">Metadata</div>
                <ul class="list-inline small text-muted">
                    <li class="list-inline-item">Dibuat: {{ $paket->created_at ? $paket->created_at->format('d M Y H:i') : '-' }}</li>
                    <li class="list-inline-item">·</li>
                    <li class="list-inline-item">Terakhir diperbarui: {{ $paket->updated_at ? $paket->updated_at->format('d M Y H:i') : '-' }}</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="mb-3">Daftar Hotel ({{ $paket->hotels->count() }})</h5>
                @if($paket->hotels->isEmpty())
                    <div class="text-muted">Tidak ada hotel terkait.</div>
                @else
                    <div class="list-group">
                        @foreach($paket->hotels as $hotel)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="fw-bold">{{ $hotel->nama_hotel }}</div>
                                        <div class="small text-muted">{{ $hotel->alamat ?? '' }}</div>
                                    </div>
                                    @if(method_exists($hotel,'getKey'))
                                        <a href="/admin/hotel/{{ $hotel->id_hotel }}/edit" class="btn btn-sm btn-outline-secondary">Lihat</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-body text-center">
                @if($paket->foto_paket)
                    <a href="{{ asset(ltrim($paket->foto_paket,'/')) }}" target="_blank" class="d-block mb-2">Lihat gambar ukuran penuh</a>
                @endif
                <a href="{{ route('admin.paket.index') }}" class="btn btn-sm btn-secondary">Kembali ke Daftar Paket</a>
            </div>
        </div>
    </div>
</div>
@endsection
