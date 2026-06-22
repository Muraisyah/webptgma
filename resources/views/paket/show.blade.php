@extends('layouts.frontend')
@section('title', $paket->nama_paket ?? 'Detail Paket')
@section('content')
<div class="container py-5">
  <div class="row">
    <div class="col-lg-8">
      <div class="position-relative mb-4">
        @php
          $foto = $paket->foto_paket;
          if (!$foto) {
              $img = asset('images/placeholder.png');
          } elseif (preg_match('/^https?:\/\//', $foto)) {
              $img = $foto;
          } elseif (preg_match('#^/storage/#', $foto)) {
              $img = asset(ltrim($foto, '/'));
          } else {
              $img = asset('storage/' . ltrim($foto, '/'));
          }
        @endphp
        <div class="card">
          <img src="{{ $img }}" class="card-img-top" style="height:420px;object-fit:cover;" alt="{{ $paket->nama_paket }}">
          <div class="card-body">
            <h2 class="mb-2">{{ $paket->nama_paket }}</h2>
            <p class="text-muted">{{ $paket->deskripsi }}</p>
          </div>
        </div>
        <div style="position:absolute;right:16px;top:16px;z-index:2">
          <div class="bg-white shadow-sm rounded p-2 text-end" style="min-width:160px">
            <div class="small text-muted">Harga Mulai</div>
            <div class="h5 mb-0">Rp {{ $paket->harga_paket ? number_format($paket->harga_paket,0,',','.') : '-' }}</div>
            @if(isset($paket->status_paket))
              <div class="badge bg-{{ $paket->status_paket=='Aktif' ? 'success' : 'secondary' }} mt-1">{{ $paket->status_paket }}</div>
            @endif
          </div>
        </div>
      </div>

      <div class="mb-4">
        <h5>Deskripsi</h5>
        <div class="card p-3">
          {!! nl2br(e($paket->deskripsi)) !!}
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card shadow-sm p-3 mb-3">
        <h5 class="mb-3">Ringkasan Paket</h5>
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>Harga</div>
            <div class="text-end fw-bold">Rp {{ $paket->harga_paket ? number_format($paket->harga_paket,0,',','.') : '-' }}</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>Durasi</div>
            <div>{{ $paket->durasi_perjalanan ?? '-' }} hari</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>Keberangkatan</div>
            <div>{{ $paket->tgl_keberangkatan ? $paket->tgl_keberangkatan->format('d M Y') : '-' }}</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>Kepulangan</div>
            <div>{{ $paket->tgl_kepulangan ? $paket->tgl_kepulangan->format('d M Y') : '-' }}</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>Maskapai</div>
            <div>{{ $paket->maskapai ?? '-' }}</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>Hotel</div>
            <div>{{ optional($paket->hotel)->nama_hotel ?? '-' }}</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>Kuota</div>
            <div>{{ $paket->kuota_paket ?? '-' }}</div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>Seat Tersedia</div>
            <div>{{ $paket->seat_tersedia ?? '-' }}</div>
          </li>
        </ul>
        <div class="mt-3 d-grid">
          <a href="{{ route('login') }}" class="btn btn-primary">Masuk untuk Pesan</a>
        </div>
      </div>

      <div class="card p-3">
        <h6>Info Tambahan</h6>
        <p class="small text-muted mb-0">Hubungi kami untuk informasi fasilitas, dokumen, dan cara pembayaran.</p>
        <div class="mt-2"><a href="tel:+6285218907162" class="btn btn-outline-secondary btn-sm">Hubungi +62 852-1890-7162</a></div>
      </div>
    </div>
  </div>
</div>
@endsection
