@extends('layouts.frontend')

@section('title','Beranda (Login)')

@section('content')
<div class="container-fluid p-0">
  <!-- navbar removed: uses frontend layout navbar -->

  <header style="height:420px;position:relative;overflow:hidden;">
    @if(\Illuminate\Support\Facades\File::exists(public_path('images/hero.jpg')))
      <img src="{{ asset('images/hero.jpg') }}" alt="Hero" style="width:100%;height:420px;object-fit:cover;filter:brightness(0.6)">
    @else
      <div style="width:100%;height:420px;background:linear-gradient(180deg,#6b2f63,#3e2540)"></div>
    @endif
    <div style="position:absolute;left:24px;top:60px;color:#fff;max-width:760px;">
      <h1 class="display-6 fw-bold">PT GRAHA MULYA AZAMNYNDO</h1>
      <p class="lead">Sucikan Hati, Mabrurkan Umrah dan Haji</p>
      <a href="#paket" class="btn btn-outline-light">Lihat Paket</a>
    </div>
  </header>

  <section id="tentang" class="py-5" style="background:#f8f9fa;">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-7">
          <h3>Tentang Kami</h3>
          <p>PT. Graha Mulya Azamnyndo adalah penyelenggara perjalanan ibadah umrah dan haji yang berpengalaman, menyediakan paket sesuai kebutuhan jamaah dengan layanan profesional dan pembimbing berkompeten.</p>
          <a href="#" class="btn btn-primary">Detail Selengkapnya</a>
        </div>
        <div class="col-md-5 text-center">
          @if(\Illuminate\Support\Facades\File::exists(public_path('images/logo.png')))
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="max-height:140px;object-fit:contain;">
          @endif
        </div>
      </div>
    </div>
  </section>

  <section id="paket" class="py-5">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Paket Tersedia</h3>
        <a href="{{ url('/paket') }}" class="btn btn-outline-primary">Lihat semua paket</a>
      </div>
      <div class="row g-3">
        @forelse($pakets as $paket)
          @php
            $foto = $paket->foto_paket ?? $paket->gambar ?? null;
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
    </div>
  </section>

  <footer id="kontak" class="py-4 bg-white border-top">
    <div class="container d-flex justify-content-between">
      <div>
        <strong>PT Graha Mulya Azamnyndo</strong><br>
        Jalan Contoh No.1, Jakarta
      </div>
      <div class="text-end">
        <small>Hubungi: 0812-3456-7890</small>
      </div>
    </div>
  </footer>
</div>
@endsection
