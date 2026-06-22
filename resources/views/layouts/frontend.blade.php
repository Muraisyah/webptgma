<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Beranda')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      :root{ --theme:#782f6a; --theme-dark:#5e2352; }
      body{background:#fff;color:#222}
      .topbar{background:var(--theme);color:#fff;padding:.25rem 0;font-size:.9rem; position:fixed; top:0; left:0; right:0; z-index:1080; height:40px}
      .topbar .container{display:flex;align-items:center;justify-content:space-between;gap:12px}
      .topbar .contacts{display:flex;gap:18px;align-items:center}
      .topbar .contact-item{display:flex;gap:8px;align-items:center;font-size:.9rem}
      .topbar .contact-item a{color:rgba(255,255,255,.95);text-decoration:none}
      .topbar .contact-item .wa-badge{display:inline-flex;align-items:center;justify-content:center;width:22px;height:22px;border-radius:6px;background:rgba(255,255,255,.12);margin-left:4px}
      .mainnav{background:#fff;border-bottom:1px solid rgba(0,0,0,.06); position:fixed; top:40px; left:0; right:0; z-index:1070; height:72px}
      .mainnav .nav-link{color:#222;padding:.8rem 1rem}
      .mainnav .btn-primary{background:var(--theme);border-color:var(--theme)}
      .logo-img{height:44px;object-fit:contain}
      .social-icons{display:flex;gap:8px;align-items:center}
      .social-icon{display:inline-flex;align-items:center;justify-content:center;width:28px;height:28px;border-radius:50%;background:rgba(255,255,255,.08);color:#fff;text-decoration:none}
      .social-icon:hover{background:rgba(255,255,255,.18);transform:translateY(-1px)}
    </style>
</head>
<body>
  <div class="topbar">
    <div class="container d-flex justify-content-between align-items-center">
      <div class="contacts">
        <div class="contact-item">
          <strong>Kantor Cikampek</strong>
          <a href="tel:+6285218907162" class="text-white text-decoration-none">+62 852-1890-7162</a>
          <a href="https://wa.me/6285218907162" target="_blank" rel="noopener" class="wa-badge" title="WhatsApp Cikampek">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill="#fff" d="M20.52 3.48A11.94 11.94 0 0012 0C5.373 0 .09 5.283.09 11.91c0 2.094.54 4.142 1.56 5.93L0 24l6.36-1.65a11.85 11.85 0 005.64 1.41c6.627 0 11.91-5.283 11.91-11.91 0-3.18-1.24-6.168-3.39-8.85zM12 21.6a10.66 10.66 0 01-5.52-1.47l-.4-.24L4.2 20.1l1.29-1.83-.28-.42A10.66 10.66 0 011.8 11.91c0-5.67 4.62-10.26 10.2-10.26 2.73 0 5.28 1.06 7.2 2.99a10.18 10.18 0 012.99 7.27c0 5.67-4.62 10.26-10.2 10.26z"/></svg>
          </a>
        </div>
        <div class="contact-item">
          <strong>Kantor Tasikmalaya</strong>
          <a href="tel:+628138755744" class="text-white text-decoration-none">+62 813-8755-744</a>
          <a href="https://wa.me/628138755744" target="_blank" rel="noopener" class="wa-badge" title="WhatsApp Tasikmalaya">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill="#fff" d="M20.52 3.48A11.94 11.94 0 0012 0C5.373 0 .09 5.283.09 11.91c0 2.094.54 4.142 1.56 5.93L0 24l6.36-1.65a11.85 11.85 0 005.64 1.41c6.627 0 11.91-5.283 11.91-11.91 0-3.18-1.24-6.168-3.39-8.85zM12 21.6a10.66 10.66 0 01-5.52-1.47l-.4-.24L4.2 20.1l1.29-1.83-.28-.42A10.66 10.66 0 011.8 11.91c0-5.67 4.62-10.26 10.2-10.26 2.73 0 5.28 1.06 7.2 2.99a10.18 10.18 0 012.99 7.27c0 5.67-4.62 10.26-10.2 10.26z"/></svg>
          </a>
        </div>
      </div>
      <div class="social-icons">
        <a href="https://www.facebook.com/almukaromah.umroh" target="_blank" rel="noopener" class="social-icon" title="Facebook">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M12 2.04c0-.62.5-1.04 1.1-1.04h.62v2.2h-1.03c-.28 0-.5.22-.5.5V6h2.1l-.28 2.2h-1.82v6H9.48v-6H7.63V6h1.85V4.54c0-1.77 1.08-2.5 2.52-2.5z"/></svg>
        </a>
        <a href="https://www.instagram.com/almukaromah_hajidanumroh/?hl=en" target="_blank" rel="noopener" class="social-icon" title="Instagram">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M7 2C4.243 2 2 4.243 2 7v10c0 2.757 2.243 5 5 5h10c2.757 0 5-2.243 5-5V7c0-2.757-2.243-5-5-5H7zm0 2h10c1.657 0 3 1.343 3 3v10c0 1.657-1.343 3-3 3H7c-1.657 0-3-1.343-3-3V7c0-1.657 1.343-3 3-3zm5 3.5A4.5 4.5 0 1 0 16.5 12 4.505 4.505 0 0 0 12 7.5zm0 2A2.5 2.5 0 1 1 14.5 12 2.503 2.503 0 0 1 12 9.5zM18.5 6a.9.9 0 1 1-.9-.9.9.9 0 0 1 .9.9z"/></svg>
        </a>
        <a href="https://www.tiktok.com/@almukaromah_hajiumroh" target="_blank" rel="noopener" class="social-icon" title="TikTok">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M16 3v10.5A4.5 4.5 0 1 1 11.5 9V6h-2v6.5A6.5 6.5 0 1 0 16 3z"/></svg>
        </a>
      </div>
    </div>
  </div>
  <nav class="mainnav">
    <div class="container">
      <div class="d-flex align-items-center justify-content-between" style="height:72px">
        <div class="d-flex align-items-center">
          <a href="{{ url('/') }}" class="d-flex align-items-center text-decoration-none">
            @if(
              \Illuminate\Support\Facades\File::exists(public_path('images/logo.png'))
            )
              <img src="{{ asset('images/logo.png') }}" alt="logo" class="logo-img me-3">
            @endif
            <span class="fw-bold text-dark">PT GRAHA MULYA AZAMNYNDO</span>
          </a>
        </div>
        <div class="d-none d-lg-flex gap-3">
          <a class="nav-link" href="#tentang">Tentang Kami</a>
          <a class="nav-link" href="{{ route('paket.index') }}">Paket</a>
          <a class="nav-link" href="{{ route('galeri.index') }}">Galeri</a>
          <a class="nav-link" href="#kontak">Kontak</a>
        </div>
        <div>
          <a href="{{ route('login') }}" class="btn btn-primary">Masuk</a>
        </div>
      </div>
    </div>
  </nav>
  

  <main style="padding-top:calc(36px + 72px)">
    @yield('content')
  </main>

  <footer class="py-4 bg-light border-top mt-5">
    <div class="container d-flex justify-content-between">
      <div>
        &copy; {{ date('Y') }} PT Graha Mulya Azamnyndo
      </div>
      <div>Hubungi: 0812-3456-7890</div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>
