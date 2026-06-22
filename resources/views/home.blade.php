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
   <section class="container py-5 my-4">
    <div class="row g-4 align-items-stretch">

      <!-- Kiri: Deskripsi -->
      <div class="col-lg-6 d-flex flex-column justify-content-center">
        <h1 class="display-4 fw-bold text-dark mb-4" style="font-family: 'Segoe UI', system-ui, sans-serif;">
          Program Paket Tabungan
        </h1>
        <p class="fs-6 text-secondary lh-lg mb-4" style="max-width: 95%;">
          Memiliki impian untuk menunaikan ibadah haji atau umroh adalah sebuah cita-cita mulia setiap Muslim. Namun, biaya yang perlu dipersiapkan seringkali terasa besar dan memberat jika tanpa perencanaan yang matang. Untuk itulah, 
          <span class="fw-semibold text-dark bg-light px-2 py-1 rounded-pill d-inline-block" style="background-color: #e9f0f3 !important;">PT Graha Mulya</span> 
          melalui 
          <span class="fw-semibold text-dark bg-light px-2 py-1 rounded-pill d-inline-block" style="background-color: #e9f0f3 !important;">Azamyndo</span> 
          menghadirkan Program Tabungan Haji/Umroh yang dirancang khusus sebagai solusi pintar bagi Anda untuk mewujudkan impian tersebut dengan cara yang lebih mudah, disiplin, dan bebas dari beban finansial yang berat.
        </p>
      </div>

      <!-- Kanan: Timeline -->
      <div class="col-lg-6 d-flex flex-column justify-content-center ps-lg-4">

        <!-- Item 1 -->
        <div class="d-flex align-items-start gap-3 mb-3 opacity-0 animate__animated" style="animation: fadeSlide 0.4s ease forwards 0.1s;">
          <div class="d-flex flex-column align-items-center flex-shrink-0" style="width: 44px;">
            <div class="d-flex align-items-center justify-content-center rounded-circle border border-2 border-secondary-subtle bg-light" 
                 style="width: 44px; height: 44px; font-weight: 800; color: #0f4c5c; background-color: #eef6f9 !important;">
              1
            </div>
            <div class="bg-secondary bg-opacity-25" style="width: 2px; height: 28px; margin-top: 4px;"></div>
          </div>
          <div class="pt-1">
            <span class="badge bg-light text-dark rounded-pill px-4 py-2 fw-semibold" 
                  style="background-color: #f0f6f9 !important; font-size: 1rem; border: 1px solid rgba(15,76,92,0.06);">
              Pengajuan Program tabungan Melalui Whatsapp/di tempat
            </span>
          </div>
        </div>

        <!-- Item 2 -->
        <div class="d-flex align-items-start gap-3 mb-3 opacity-0" style="animation: fadeSlide 0.4s ease forwards 0.2s;">
          <div class="d-flex flex-column align-items-center flex-shrink-0" style="width: 44px;">
            <div class="d-flex align-items-center justify-content-center rounded-circle border border-2 border-secondary-subtle bg-light" 
                 style="width: 44px; height: 44px; font-weight: 800; color: #0f4c5c; background-color: #eef6f9 !important;">
              2
            </div>
            <div class="bg-secondary bg-opacity-25" style="width: 2px; height: 28px; margin-top: 4px;"></div>
          </div>
          <div class="pt-1">
            <span class="badge bg-light text-dark rounded-pill px-4 py-2 fw-semibold" 
                  style="background-color: #f0f6f9 !important; font-size: 1rem; border: 1px solid rgba(15,76,92,0.06);">
              Kesepakatan pemilihan paket dan dana awal pada tabungan
            </span>
          </div>
        </div>

        <!-- Item 3 -->
        <div class="d-flex align-items-start gap-3 mb-3 opacity-0" style="animation: fadeSlide 0.4s ease forwards 0.3s;">
          <div class="d-flex flex-column align-items-center flex-shrink-0" style="width: 44px;">
            <div class="d-flex align-items-center justify-content-center rounded-circle border border-2 border-secondary-subtle bg-light" 
                 style="width: 44px; height: 44px; font-weight: 800; color: #0f4c5c; background-color: #eef6f9 !important;">
              3
            </div>
            <div class="bg-secondary bg-opacity-25" style="width: 2px; height: 28px; margin-top: 4px;"></div>
          </div>
          <div class="pt-1">
            <span class="badge bg-light text-dark rounded-pill px-4 py-2 fw-semibold" 
                  style="background-color: #f0f6f9 !important; font-size: 1rem; border: 1px solid rgba(15,76,92,0.06);">
              Dibuatkan dan diberikan buku tabungan
            </span>
          </div>
        </div>

        <!-- Item 4 -->
        <div class="d-flex align-items-start gap-3 mb-3 opacity-0" style="animation: fadeSlide 0.4s ease forwards 0.4s;">
          <div class="d-flex flex-column align-items-center flex-shrink-0" style="width: 44px;">
            <div class="d-flex align-items-center justify-content-center rounded-circle border border-2 border-secondary-subtle bg-light" 
                 style="width: 44px; height: 44px; font-weight: 800; color: #0f4c5c; background-color: #eef6f9 !important;">
              4
            </div>
            <div class="bg-secondary bg-opacity-25" style="width: 2px; height: 28px; margin-top: 4px;"></div>
          </div>
          <div class="pt-1">
            <span class="badge bg-light text-dark rounded-pill px-4 py-2 fw-semibold" 
                  style="background-color: #f0f6f9 !important; font-size: 1rem; border: 1px solid rgba(15,76,92,0.06);">
              Penyetoran dana berkelanjutan bebas (tidak ada limit)
            </span>
          </div>
        </div>

        <!-- Item 5 -->
        <div class="d-flex align-items-start gap-3 mb-0 opacity-0" style="animation: fadeSlide 0.4s ease forwards 0.5s;">
          <div class="d-flex flex-column align-items-center flex-shrink-0" style="width: 44px;">
            <div class="d-flex align-items-center justify-content-center rounded-circle border border-2 border-secondary-subtle bg-light" 
                 style="width: 44px; height: 44px; font-weight: 800; color: #0f4c5c; background-color: #eef6f9 !important;">
              5
            </div>
            <!-- garis bawah tidak muncul di item terakhir -->
          </div>
          <div class="pt-1">
            <span class="badge bg-light text-dark rounded-pill px-4 py-2 fw-semibold" 
                  style="background-color: #f0f6f9 !important; font-size: 1rem; border: 1px solid rgba(15,76,92,0.06);">
              Setelah lunas akan di proses pemberangkatan
            </span>
          </div>
        </div>

      </div>
    </div>
  </section>
  


  <!-- Galeri Section -->
  <section id="galeri" class="py-5" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="display-5 fw-bold text-dark mb-3">Galeri Perjalanan</h2>
        <p class="lead text-muted" style="max-width: 600px; margin: 0 auto;">
          Lihat momen-momen indah dari perjalanan haji dan umroh jamaah kami yang telah menunaikan ibadah mereka
        </p>
      </div>

      @if($galeris->count() > 0)
        <div class="row g-4 mb-5">
          @foreach($galeris as $g)
            @php
              $foto = $g->foto_jemaah;
              if (!$foto) {
                  $src = asset('images/placeholder.svg');
              } elseif (preg_match('/^https?:\/\//', $foto)) {
                  $src = $foto;
              } elseif (preg_match('#^/storage/#', $foto)) {
                  $src = asset(ltrim($foto, '/'));
              } elseif (preg_match('#^storage/#', $foto)) {
                  $src = asset($foto);
              } elseif (preg_match('#^/#', $foto)) {
                  $src = asset(ltrim($foto, '/'));
              } else {
                  $src = asset('storage/' . ltrim($foto, '/'));
              }
            @endphp
            <div class="col-md-6 col-lg-4">
              <div class="galeri-card h-100 position-relative overflow-hidden rounded-4 shadow-sm" 
                   style="cursor: pointer; transition: all 0.3s ease; background: #fff;">
                <a href="#" class="galeri-link text-decoration-none position-relative d-block h-100" 
                   data-bs-toggle="modal" data-bs-target="#galeriModal" 
                   data-src="{{ $src }}" data-title="{{ e($g->judul_foto) }}"
                   style="min-height: 280px;">
                  
                  <!-- Image -->
                  <img src="{{ $src }}" class="w-100 h-100 object-fit-cover" style="object-fit: cover; display: block;" 
                       alt="{{ $g->judul_foto }}">
                  
                  <!-- Overlay -->
                  <div class="position-absolute top-0 start-0 w-100 h-100 galeri-overlay" 
                       style="background: linear-gradient(135deg, rgba(15,76,92,0.7) 0%, rgba(31,124,140,0.7) 100%); 
                               opacity: 0; transition: opacity 0.4s ease;">
                    <div class="d-flex flex-column justify-content-end h-100 p-4 text-white">
                      <h6 class="mb-2 fw-bold text-truncate-2" style="line-height: 1.3;">
                        {{ \Illuminate\Support\Str::limit($g->judul_foto, 50) }}
                      </h6>
                      <p class="small mb-3 text-white-50" style="font-size: 0.85rem; line-height: 1.4;">
                        {{ \Illuminate\Support\Str::limit($g->deskripsi_foto, 80) }}
                      </p>
                      <div class="d-flex justify-content-between align-items-center">
                        <small class="text-white-50">{{ $g->created_at->format('d M Y') }}</small>
                        <span class="badge bg-white text-dark">
                          <i class="bi bi-zoom-in"></i> Lihat
                        </span>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          @endforeach
        </div>

        <div class="text-center">
          <a href="{{ route('galeri.index') }}" class="btn btn-primary btn-lg px-5 py-3" style="border-radius: 50px; font-weight: 600;">
            <i class="bi bi-images me-2"></i> Lihat Semua Galeri
          </a>
        </div>
      @else
        <div class="text-center py-5">
          <i class="bi bi-image" style="font-size: 3rem; color: #ccc;"></i>
          <p class="text-muted mt-3">Galeri masih kosong. Galeri akan ditampilkan setelah ada foto perjalanan.</p>
        </div>
      @endif
    </div>
  </section>

    <section class="container py-5">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="display-4 fw-bold text-dark">Kantor</h1>
                <p class="text-secondary fs-5">
                    Kami memiliki jaringan kantor cabang yang tersebar di berbagai daerah. 
                    Silakan kunjungi di kota tersebut.
                </p>
            </div>
        </div>

        <!-- Card + Maps -->
        <div class="row g-4">

            <!-- Card Cikampek -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-dark mb-3">Cikampek</h5>
                        <p class="card-text text-secondary">
                            <i class="bi bi-geo-alt text-primary me-2"></i>
                            Jl. Kp. Bumi Timur, Cikampek Kota, Kec. Cikampek,<br>
                            Kerajaan, Jawa Barat 41373
                        </p>
                        <hr>
                        <div class="d-flex align-items-start gap-2">
                            <i class="bi bi-clock text-primary mt-1"></i>
                            <div>
                                <span class="badge bg-success bg-opacity-10 text-success fw-semibold">Buka - Tutup</span>
                                <ul class="list-unstyled small text-secondary mt-2 mb-0">
                                    <li><i class="bi bi-calendar3 me-1"></i> Senin - Sabtu</li>
                                    <li><i class="bi bi-clock me-1"></i> 08.00 - 17.00 WIB</li>
                                    <li><i class="bi bi-calendar-check me-1"></i> Minggu</li>
                                    <li class="text-danger"><i class="bi bi-x-circle me-1"></i> Libur</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Maps Cikampek -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100 overflow-hidden">
                    <div class="card-body p-0">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126808.25332231447!2d107.3458209809761!3d-6.389328859581121!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6eb0a8bf376b2b%3A0x301e8f1fc28b380!2sCikampek%2C%20Karawang%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1700000000000" 
                            width="100%" 
                            height="100%" 
                            style="min-height: 280px; border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>

        </div>

        <!-- Row kedua: Kota Tasikmalaya -->
        <div class="row g-4 mt-3">

            <!-- Card Kota Tasikmalaya -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-dark mb-3">Kota Tasikmalaya</h5>
                        <p class="card-text text-secondary">
                            <i class="bi bi-geo-alt text-primary me-2"></i>
                            Jl. Mayor S.L. Tobeh No. 44, Mangkubumi, Kec. Mangkubumi,<br>
                            Kab. Tasikmalaya, Jawa Barat 46381 
                            <span class="badge bg-warning bg-opacity-10 text-warning">(di dalam SORT dimaklumat)</span>
                        </p>
                        <hr>
                        <div class="d-flex align-items-start gap-2">
                            <i class="bi bi-clock text-primary mt-1"></i>
                            <div>
                                <span class="badge bg-success bg-opacity-10 text-success fw-semibold">Buka - Tutup</span>
                                <ul class="list-unstyled small text-secondary mt-2 mb-0">
                                    <li><i class="bi bi-calendar3 me-1"></i> Senin - Sabtu</li>
                                    <li><i class="bi bi-clock me-1"></i> 08.00 - 17.00 WIB</li>
                                    <li><i class="bi bi-calendar-check me-1"></i> Minggu</li>
                                    <li class="text-danger"><i class="bi bi-x-circle me-1"></i> Libur</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Maps Kota Tasikmalaya -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100 overflow-hidden">
                    <div class="card-body p-0">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126665.50168651584!2d108.11803977079273!3d-7.327123634745771!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f57210b73e4d7%3A0x4027a76e3534a0!2sTasikmalaya%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1700000000000" 
                            width="100%" 
                            height="100%" 
                            style="min-height: 280px; border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>

        </div>

        <!-- Row ketiga: Kabupaten Tasikmalaya -->
        <div class="row g-4 mt-3">

            <!-- Card Kabupaten Tasikmalaya -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-dark mb-3">Kabupaten Tasikmalaya</h5>
                        <p class="card-text text-secondary">
                            <i class="bi bi-geo-alt text-primary me-2"></i>
                            Kp. pusat desa jaya untuk kecamatan pascaagah<br>
                            kawasan tasikmalaya
                        </p>
                        <hr>
                        <div class="d-flex align-items-start gap-2">
                            <i class="bi bi-clock text-primary mt-1"></i>
                            <div>
                                <span class="badge bg-success bg-opacity-10 text-success fw-semibold">Buka - Tutup</span>
                                <ul class="list-unstyled small text-secondary mt-2 mb-0">
                                    <li><i class="bi bi-calendar3 me-1"></i> Senin - Sabtu</li>
                                    <li><i class="bi bi-clock me-1"></i> 08.00 - 17.00 WIB</li>
                                    <li><i class="bi bi-calendar-check me-1"></i> Minggu</li>
                                    <li class="text-danger"><i class="bi bi-x-circle me-1"></i> Libur</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Maps Kabupaten Tasikmalaya -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100 overflow-hidden">
                    <div class="card-body p-0">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126665.50168651584!2d108.11803977079273!3d-7.327123634745771!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f57210b73e4d7%3A0x4027a76e3534a0!2sTasikmalaya%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1700000000000" 
                            width="100%" 
                            height="100%" 
                            style="min-height: 280px; border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>

        </div>

        <!-- Map Section (daftar lokasi) -->
        <div class="row mt-5 pt-4 border-top">
            <div class="col-12">
                <h4 class="fw-bold text-dark mb-3"><i class="bi bi-map text-primary me-2"></i>Map</h4>
                <div class="row g-2">
                    <div class="col-md-4">
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary"><i class="bi bi-geo-alt me-2 text-primary"></i>Map</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary"><i class="bi bi-mosque me-2 text-primary"></i>Masjid Darussalam</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary"><i class="bi bi-building me-2 text-primary"></i>Al Mukaromah Cikampek</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary"><i class="bi bi-school me-2 text-primary"></i>Al Mukaromah Islamia School</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary"><i class="bi bi-school me-2 text-primary"></i>Al Mukaromah Islamia School</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary"><i class="bi bi-school me-2 text-primary"></i>Al Mukarobah Islamia School</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary"><i class="bi bi-school me-2 text-primary"></i>Al Mukarobah Islamia School</a></li>
                            <li class="mb-2 fw-semibold text-dark"><i class="bi bi-pin-map me-2 text-primary"></i>Kp. Bukit Haji Al Mukaromah</li>
                            <li class="ms-4 mb-1 text-secondary small">- Nini suruh</li>
                            <li class="ms-4 text-secondary small">- SMKN 1</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </section>
    
    <section class="container py-5">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="display-4 fw-bold text-dark">Kontak Agen</h1>
                <p class="text-secondary fs-5">
                    Untuk memudahkan Anda, kami memiliki jaringan agen di berbagai kota. 
                    Silakan hubungi agen terdekat dari lokasi Anda.
                </p>
            </div>
        </div>

        <!-- Grid Card Agen -->
        <div class="row g-4">

            <!-- Cikampek -->
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-person-circle text-primary fs-4"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark mb-0">Cikampek</h5>
                        </div>
                        <p class="card-text text-secondary mb-2">
                            <i class="bi bi-person-badge text-primary me-2"></i>
                            Ibu Fatihatul Zulfa Nafisa
                        </p>
                        <p class="card-text text-secondary mb-0">
                            <i class="bi bi-whatsapp text-success me-2"></i>
                            <a href="https://wa.me/628970975595" class="text-decoration-none text-secondary">
                                +62 897-0975-595
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Karawang -->
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-person-circle text-primary fs-4"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark mb-0">Karawang</h5>
                        </div>
                        <p class="card-text text-secondary mb-2">
                            <i class="bi bi-person-badge text-primary me-2"></i>
                            Bapak H. Nurjaya Saputra
                        </p>
                        <p class="card-text text-secondary mb-0">
                            <i class="bi bi-whatsapp text-success me-2"></i>
                            <a href="https://wa.me/6285881823636" class="text-decoration-none text-secondary">
                                +62 858-8182-3636
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Subang -->
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-person-circle text-primary fs-4"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark mb-0">Subang</h5>
                        </div>
                        <p class="card-text text-secondary mb-2">
                            <i class="bi bi-person-badge text-primary me-2"></i>
                            Ibu Hj. Jupriati
                        </p>
                        <p class="card-text text-secondary mb-0">
                            <i class="bi bi-whatsapp text-success me-2"></i>
                            <a href="https://wa.me/6287830828002" class="text-decoration-none text-secondary">
                                +62 878-3082-8002
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Tasikmalaya (Kabupaten) -->
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-person-circle text-primary fs-4"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark mb-0">Tasikmalaya (Kabupaten)</h5>
                        </div>
                        <p class="card-text text-secondary mb-2">
                            <i class="bi bi-person-badge text-primary me-2"></i>
                            Pak H. Yayat Hidayatullah
                        </p>
                        <p class="card-text text-secondary mb-0">
                            <i class="bi bi-whatsapp text-success me-2"></i>
                            <a href="https://wa.me/6282300004352" class="text-decoration-none text-secondary">
                                +62 823-0000-4352
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Tasikmalaya (Kota) -->
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-person-circle text-primary fs-4"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark mb-0">Tasikmalaya (Kota)</h5>
                        </div>
                        <p class="card-text text-secondary mb-2">
                            <i class="bi bi-person-badge text-primary me-2"></i>
                            Ibu Hj. Ela Susilawati
                        </p>
                        <p class="card-text text-secondary mb-0">
                            <i class="bi bi-whatsapp text-success me-2"></i>
                            <a href="https://wa.me/6285323409980" class="text-decoration-none text-secondary">
                                +62 853-2340-9980
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Brebes -->
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-person-circle text-primary fs-4"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark mb-0">Brebes</h5>
                        </div>
                        <p class="card-text text-secondary mb-2">
                            <i class="bi bi-person-badge text-primary me-2"></i>
                            Bapak H. Rustono
                        </p>
                        <p class="card-text text-secondary mb-0">
                            <i class="bi bi-whatsapp text-success me-2"></i>
                            <a href="https://wa.me/6285229024848" class="text-decoration-none text-secondary">
                                +62 852-2902-4848
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Bandung -->
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-person-circle text-primary fs-4"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark mb-0">Bandung</h5>
                        </div>
                        <p class="card-text text-secondary mb-2">
                            <i class="bi bi-person-badge text-primary me-2"></i>
                            Bapak H. Khoeri Sujudi
                        </p>
                        <p class="card-text text-secondary mb-0">
                            <i class="bi bi-whatsapp text-success me-2"></i>
                            <a href="https://wa.me/6281222050515" class="text-decoration-none text-secondary">
                                +62 812-2205-0515
                            </a>
                        </p>
                    </div>
                </div>
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

<!-- Modal Lightbox Galeri -->
<div class="modal fade galeri-modal" id="galeriModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="galeriModalLabel">Foto Galeri</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img id="galeriModalImg" src="" alt="" class="img-fluid rounded" style="max-width: 100%; height: auto;">
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Handle galeri modal
  document.querySelectorAll('.galeri-link').forEach(function(element) {
    element.addEventListener('click', function(e) {
      e.preventDefault();
      const src = element.getAttribute('data-src');
      const title = element.getAttribute('data-title') || 'Foto Galeri';
      const img = document.getElementById('galeriModalImg');
      const label = document.getElementById('galeriModalLabel');
      
      if (img) img.src = src;
      if (label) label.textContent = title;
    });
  });

  // Clear image when modal is hidden to optimize performance
  const galeriModal = document.getElementById('galeriModal');
  if (galeriModal) {
    galeriModal.addEventListener('hidden.bs.modal', function() {
      const img = document.getElementById('galeriModalImg');
      if (img) img.src = '';
    });
  }
});
</script>
@endpush

@endsection
