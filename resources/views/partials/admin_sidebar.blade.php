<div id="adminSidebar" class="sidebar d-flex flex-column p-3 bg-light">
    <div class="d-flex align-items-center mb-3 mb-md-0">
        <span class="fs-5">Menu</span>
        <button id="sidebarClose" class="btn btn-sm btn-outline-secondary ms-auto d-lg-none" aria-label="Close menu">&times;</button>
    </div>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item"><a href="/admin/dashboard" class="nav-link link-dark {{ request()->is('admin/dashboard*') ? 'active' : '' }}">Dashboard</a></li>
        <li class="nav-item"><a href="/admin/users" class="nav-link link-dark {{ request()->is('admin/users*') ? 'active' : '' }}">Akun Pengguna</a></li>
        <li class="nav-item"><a href="/admin/paket" class="nav-link link-dark {{ request()->is('admin/paket*') ? 'active' : '' }}">Paket</a></li>
        <li class="nav-item"><a href="/admin/hotel" class="nav-link link-dark {{ request()->is('admin/hotel*') ? 'active' : '' }}">Hotel</a></li>
        <li class="nav-item"><a href="/admin/reservasi" class="nav-link link-dark {{ request()->is('admin/reservasi*') ? 'active' : '' }}">Reservasi</a></li>
        <li class="nav-item"><a href="/admin/transaksi" class="nav-link link-dark {{ request()->is('admin/transaksi*') ? 'active' : '' }}">Transaksi</a></li>
        <li class="nav-item"><a href="/admin/rekening" class="nav-link link-dark {{ request()->is('admin/rekening*') ? 'active' : '' }}">Rekening</a></li>
        <li class="nav-item"><a href="/admin/galeri" class="nav-link link-dark {{ request()->is('admin/galeri*') ? 'active' : '' }}">Galeri</a></li>
        <li class="nav-item"><a href="/admin/dokumen" class="nav-link link-dark {{ request()->is('admin/dokumen*') ? 'active' : '' }}">Dokumen</a></li>
        <li class="nav-item"><a href="/admin/laporan" class="nav-link link-dark {{ request()->is('admin/laporan*') ? 'active' : '' }}">Laporan</a></li>
    </ul>
    <hr>
    <div class="mt-auto">
        <small class="text-muted">Logged as: {{ optional(auth()->user())->nama_lengkap ?? optional(auth()->user())->username ?? 'Guest' }}</small>
    </div>
</div>
