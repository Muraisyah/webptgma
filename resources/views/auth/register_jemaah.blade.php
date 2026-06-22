<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun Jemaah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body{background:#f4f5f6}
      .theme-btn{background:#782f6a;border-color:#782f6a;color:#fff}
      .theme-btn:hover{background:#5e2352;border-color:#5e2352}
    </style>
</head>
<body>
<div class="container-fluid vh-100 d-flex align-items-center justify-content-center">
  <div class="row w-100 justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">
      <div class="card shadow-sm overflow-hidden">
        <div class="row g-0">
          <div class="col-md-6 p-4">
            <h4 class="mb-3">Daftar Akun Jemaah</h4>
            @if(session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
              <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif
            <form action="{{ route('register.jemaah.store') }}" method="POST">
              @csrf
              <div class="row g-3">
                <div class="col-12 col-md-6">
                  <label class="form-label">Nama Lengkap</label>
                  <input name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="form-control" placeholder="Nama lengkap" required>
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label">Email</label>
                  <input name="email" type="email" value="{{ old('email') }}" class="form-control" placeholder="contoh@domain.com" required>
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label">Username</label>
                  <input name="username" value="{{ old('username') }}" class="form-control" placeholder="username" required>
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label">No. HP</label>
                  <input name="no_hp" value="{{ old('no_hp') }}" class="form-control" placeholder="08xxxxxxxxxx">
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label">Password</label>
                  <input name="password" type="password" class="form-control" required>
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label">Konfirmasi Password</label>
                  <input name="password_confirmation" type="password" class="form-control" required>
                </div>
              </div>
              <div class="mt-3 d-grid"><button class="btn theme-btn">Daftar</button></div>
              <div class="mt-3 text-center"><a href="{{ route('login') }}">Kembali ke Login</a></div>
            </form>
          </div>
          <div class="col-md-6 d-none d-md-block" style="background:linear-gradient(180deg,#6b2f63,#3e2540);color:#fff;">
            <div class="p-4 h-100 d-flex flex-column justify-content-center">
              @if(\Illuminate\Support\Facades\File::exists(public_path('images/logo.png')))
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:64px;object-fit:contain;margin-bottom:18px;">
              @endif
              <h3>Selamat Datang Calon Jemaah</h3>
              <p class="small" style="opacity:.95">Isi data untuk membuat akun. Setelah terdaftar Anda dapat login dan melengkapi data pendaftaran.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
