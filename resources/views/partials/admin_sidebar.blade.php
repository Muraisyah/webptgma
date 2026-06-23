<style>
    /* Kustomisasi CSS untuk Sidebar */
    .sidebar {
        min-height: 100vh;
        box-shadow: 2px 0 15px rgba(0,0,0,0.05); /* Memberikan bayangan lembut */
        background-color: #ffffff; /* Mengubah bg-light menjadi putih bersih */
    }
    
    .sidebar .nav-link {
        border-radius: 0.5rem;
        transition: all 0.3s ease;
        font-weight: 500;
        color: #4b5563; /* Warna teks abu-abu gelap */
        padding: 0.6rem 1rem;
    }
    
    .sidebar .nav-link i {
        font-size: 1.1rem;
        width: 24px;
        display: inline-block;
        text-align: center;
    }

    .sidebar .nav-link:hover {
        background-color: #f3f4f6;
        color: #111827;
        transform: translateX(4px); /* Efek geser kanan saat di-hover */
    }

    .sidebar .nav-link.active {
        background-color: #0d6efd; /* Warna biru Bootstrap */
        color: #ffffff !important;
        box-shadow: 0 4px 6px -1px rgba(13, 110, 253, 0.25);
    }
    
    .user-profile-card {
        background: #f8f9fa;
        border-radius: 0.5rem;
        padding: 0.75rem;
        border: 1px solid #e9ecef;
    }
</style>

<div id="adminSidebar" class="sidebar d-flex flex-column p-3">
    <!-- Header Sidebar -->
    <div class="d-flex align-items-center mb-4 px-2 mt-2">
        <i class="bi bi-hexagon-fill text-primary fs-3 me-2"></i>
        <span class="fs-4 fw-bold">Dashboard</span>
        <button id="sidebarClose" class="btn btn-sm btn-light ms-auto d-lg-none shadow-sm" aria-label="Close menu">&times;</button>
    </div>
    
    <span class="text-uppercase text-muted fw-bold mb-2 px-3" style="font-size: 0.75rem; letter-spacing: 1px;">Menu</span>
    
    <!-- Menu List -->
    <ul class="nav nav-pills flex-column mb-auto gap-1">
        <li class="nav-item">
            <a href="/admin/dashboard" class="nav-link {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="/admin/users" class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                <i class="bi bi-people-fill me-2"></i> Akun Pengguna
            </a>
        </li>
        <li class="nav-item">
            <a href="/admin/paket" class="nav-link {{ request()->is('admin/paket*') ? 'active' : '' }}">
                <i class="bi bi-box-seam-fill me-2"></i> Paket
            </a>
        </li>
        <li class="nav-item">
            <a href="/admin/hotel" class="nav-link {{ request()->is('admin/hotel*') ? 'active' : '' }}">
                <i class="bi bi-building-fill me-2"></i> Hotel
            </a>
        </li>
        <li class="nav-item">
            <a href="/admin/reservasi" class="nav-link {{ request()->is('admin/reservasi*') ? 'active' : '' }}">
                <i class="bi bi-calendar-check-fill me-2"></i> Reservasi
            </a>
        </li>
        <li class="nav-item">
            <a href="/admin/transaksi" class="nav-link {{ request()->is('admin/transaksi*') ? 'active' : '' }}">
                <i class="bi bi-wallet2 me-2"></i> Transaksi
            </a>
        </li>
        <li class="nav-item">
            <a href="/admin/rekening" class="nav-link {{ request()->is('admin/rekening*') ? 'active' : '' }}">
                <i class="bi bi-credit-card-fill me-2"></i> Rekening
            </a>
        </li>
        <li class="nav-item">
            <a href="/admin/galeri" class="nav-link {{ request()->is('admin/galeri*') ? 'active' : '' }}">
                <i class="bi bi-images me-2"></i> Galeri
            </a>
        </li>
        <li class="nav-item">
            <a href="/admin/dokumen" class="nav-link {{ request()->is('admin/dokumen*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text-fill me-2"></i> Dokumen
            </a>
        </li>
        <li class="nav-item">
            <a href="/admin/laporan" class="nav-link {{ request()->is('admin/laporan*') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-fill me-2"></i> Laporan
            </a>
        </li>
    </ul>
    
    <hr class="text-secondary opacity-25 my-3">
    
    <!-- User Profile Section -->
    <div class="mt-auto user-profile-card d-flex align-items-center">
        <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center me-3 shadow-sm" style="width: 40px; height: 40px;">
            <i class="bi bi-person-fill fs-5"></i>
        </div>
        <div class="d-flex flex-column text-truncate">
            <span class="fw-bold text-truncate text-dark" style="font-size: 0.9rem;">
                {{ optional(auth()->user())->nama_lengkap ?? optional(auth()->user())->username ?? 'Guest' }}
            </span>
            <span class="text-muted" style="font-size: 0.75rem;">
                <i class="bi bi-circle-fill text-success" style="font-size: 0.5rem; vertical-align: middle;"></i> Online
            </span>
        </div>
    </div>
</div>