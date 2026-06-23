<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
      body{background:#f8f9fa}
      /* Theme primary for standalone login page */
      .btn-primary{background:#782f6a;border-color:#782f6a;color:#fff}
      .btn-primary:hover{background:#5e2352;border-color:#5e2352}
      
      /* Navbar style */
      .navbar-custom {
          background: rgba(120, 47, 106, 0.95);
          backdrop-filter: blur(10px);
          box-shadow: 0 2px 15px rgba(0,0,0,0.1);
          position: fixed;
          top: 0;
          left: 0;
          right: 0;
          z-index: 1000;
          padding: 10px 0;
      }
      
      .navbar-custom .navbar-brand {
          color: #fff !important;
          font-weight: 600;
          font-size: 1.2rem;
      }
      
      .navbar-custom .navbar-brand i {
          margin-right: 8px;
      }
      
      .navbar-custom .nav-link {
          color: rgba(255,255,255,0.9) !important;
          transition: all 0.3s ease;
          font-weight: 500;
      }
      
      .navbar-custom .nav-link:hover {
          color: #fff !important;
          transform: translateY(-2px);
      }
      
      .navbar-custom .nav-link i {
          margin-right: 6px;
      }
      
      /* Adjust main content to account for fixed navbar */
      .container-fluid {
          padding-top: 70px;
      }
      
      /* Home button animation */
      .home-btn {
          background: rgba(255,255,255,0.15);
          border: 1px solid rgba(255,255,255,0.2);
          border-radius: 8px;
          padding: 8px 16px;
          transition: all 0.3s ease;
          color: #fff;
          text-decoration: none;
          display: inline-flex;
          align-items: center;
          gap: 8px;
      }
      
      .home-btn:hover {
          background: rgba(255,255,255,0.25);
          transform: translateY(-2px);
          color: #fff;
      }
    </style>
</head>
<body>
<!-- Menu Navigasi Kembali ke Home -->
<nav class="navbar navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="bi bi-house-fill"></i>
            Al-Mukaromah
        </a>
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('home') }}" class="home-btn">
                <i class="bi bi-arrow-left-circle-fill"></i>
                Kembali ke Home
            </a>
            <span class="text-white-50">|</span>
            <a href="#" class="text-white text-decoration-none opacity-75 hover-opacity-100" style="font-size:14px;">
                <i class="bi bi-question-circle"></i>
            </a>
        </div>
    </div>
</nav>

<div class="container-fluid vh-100 d-flex align-items-center p-0">
  <div class="row w-100 m-0">
    <div class="col-12 col-md-6 d-flex align-items-center justify-content-center" style="background:#f8f9fa;">
      <div style="max-width:420px;width:100%;padding:32px;">
        @if(\Illuminate\Support\Facades\File::exists(public_path('images/logo.png')))
          <div class="mb-3"><img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:64px;object-fit:contain;"></div>
        @endif
        <h2 class="mb-3">PT Graha Mulya Azamnyndo</h2>
        <p class="text-muted">Masuk untuk mengelola data dan laporan.</p>
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="/login">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email or Username</label>
                <input type="text" name="username" value="{{ old('username') }}" class="form-control" required />
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required />
            </div>
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <a href="#" class="text-decoration-none">Forgot password?</a>
            </div>
            <div class="d-grid">
              <button class="btn btn-primary">Sign In</button>
            </div>
            <div class="mt-3 text-center">
              Belum punya akun? <a href="{{ route('register.jemaah') }}">Daftar Akun Jemaah</a>
            </div>
        </form>
      </div>
    </div>
    <div class="col-12 col-md-6 d-none d-md-flex align-items-center justify-content-center p-0" style="position:relative;">
      <div style="position:relative;width:100%;height:100vh;overflow:hidden;">
        @if(\Illuminate\Support\Facades\File::exists(public_path('images/login-bg.jpg')))
            <img src="{{ asset('images/login-bg.jpg') }}" alt="Hero" style="width:100%;height:100%;object-fit:cover;filter:brightness(0.85);">
        @else
            <div style="width:100%;height:100%;background:linear-gradient(180deg,#6b2f63,#3e2540);"></div>
        @endif
        <div style="position:absolute;right:48px;bottom:48px;color:#fff;max-width:420px;">
            <h1 style="font-weight:700;font-size:34px;line-height:1.05;margin-bottom:8px;">Al-Mukaromah Tour & Travel Umrah Hajj Services</h1>
            <p style="opacity:.95;">Sucikan Hati, Mabrurkan umroh dan haji</p>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>