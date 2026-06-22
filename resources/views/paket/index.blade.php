@extends('layouts.frontend')
@section('title','Paket')
@section('content')
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Paket Tersedia</h3>
    <form method="GET" action="{{ route('paket.index') }}" class="d-flex">
      <input name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Cari paket...">
      <button class="btn btn-sm btn-primary ms-2">Cari</button>
    </form>
  </div>
  <div class="row g-3">
    @forelse($pakets as $paket)
      @php
        $foto = $paket->foto_paket;
        if (!$foto) {
            $img = asset('images/placeholder.svg');
        } elseif (preg_match('/^https?:\/\//', $foto)) {
            $img = $foto;
        } elseif (preg_match('#^/storage/#', $foto)) {
            $img = asset(ltrim($foto, '/'));
        } else {
            $img = asset('storage/' . ltrim($foto, '/'));
        }
      @endphp
      <div class="col-12 col-md-4">
        <div class="card h-100 shadow-sm">
          <img src="{{ $img }}" class="card-img-top" style="height:320px;object-fit:cover;object-position:center top;" alt="{{ $paket->nama_paket }}">
          <div class="card-body d-flex flex-column">
            <div class="mb-2 small text-muted">Keberangkatan: <strong>{{ $paket->tgl_keberangkatan ? $paket->tgl_keberangkatan->format('d M Y') : '-' }}</strong></div>
            <div class="mb-2 small text-muted">Durasi: <strong>{{ $paket->durasi_perjalanan ?? '-' }} hari</strong></div>
            <div class="mb-3 fw-bold">Rp {{ $paket->harga_paket ? number_format($paket->harga_paket,0,',','.') : '0' }}</div>
            <div class="mt-auto d-grid">
              <a href="{{ route('paket.show', $paket->id_paket ?? $paket->id) }}" class="btn btn-primary btn-sm">Lihat Detail</a>
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="alert alert-info">Belum ada paket untuk ditampilkan.</div>
      </div>
    @endforelse
  </div>
  <div class="mt-4">{{ $pakets->links() }}</div>
</div>
@endsection
