<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{background:#f8f9fa}
        /* Sidebar responsive + animations */
        .sidebar { width: 250px; min-height: 100vh; transition: transform .3s ease, box-shadow .3s ease; background: #f6f7f9 !important; border-right: 1px solid rgba(0,0,0,.04); }
        .sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: .5rem;
            height: 44px;
            width: 100%;
            box-sizing: border-box;
            font-size: .95rem;
            transition: transform .18s cubic-bezier(.2,.9,.2,1), background .15s ease, color .15s ease;
            border-radius:6px; padding:.45rem 1rem;
            justify-content: flex-start;
            text-align: left;
        }
        .sidebar .nav-pills .nav-link, .sidebar .nav-pills .nav-link.active { display:flex; width:100%; }
        .sidebar .nav-link:hover { transform: translateX(6px); background: #e9ecef; }
        .sidebar .nav-link:focus { outline: none; }
        .sidebar .nav-link:active { transform: translateX(6px); }
        /* Theme color: purple */
        :root{ --theme-color: #782f6a; --theme-color-dark: #5e2352; --bs-primary: #782f6a; }
        .navbar.bg-primary { background-color: var(--theme-color) !important; }
        .navbar .navbar-brand, .navbar .nav-link, .navbar .btn { color: #fff !important; }
        /* Buttons use theme color instead of Bootstrap blue */
        .btn-primary { background-color: var(--theme-color) !important; border-color: var(--theme-color) !important; color: #fff !important; }
        .btn-primary:hover { background-color: var(--theme-color-dark) !important; border-color: var(--theme-color-dark) !important; color: #fff !important; }
        .btn-primary:focus, .btn-primary.focus { box-shadow: 0 0 0 .2rem rgba(120,47,106,.25) !important; color: #fff !important; }
        .btn-primary:active, .btn-primary.active, .btn-primary.dropdown-toggle.show {
            background-color: var(--theme-color-dark) !important;
            border-color: var(--theme-color-dark) !important;
            color: #fff !important;
            box-shadow: none !important;
        }
        /* Generic button focus/active use theme tint */
        .btn:focus, .btn:focus-visible { box-shadow: 0 0 0 .15rem rgba(120,47,106,.15) !important; }
        .btn:active, .btn.active { transform: translateY(0.2px); }
        /* Ensure small admin buttons (like logout) contrast well */
        .btn-light { background: #fff; color: var(--theme-color) !important; border-color: rgba(0,0,0,.05); }
        .sidebar .nav-link.active { background: var(--theme-color) !important; color: #fff !important; box-shadow: none !important; }
        .sidebar .nav-link.active, .sidebar .nav-link.active:hover { transform: none; }
        .sidebar .nav-link:hover { background: #f0eef3; }
        .sidebar { background: #f6f7f9 !important; }
        .sidebar .nav-link.active:hover { transform: translateX(6px); background: var(--theme-color-dark); color: #fff; }
        /* Strong overrides for focus/active states to remove Bootstrap blue */
        .sidebar .nav-pills .nav-link:focus,
        .sidebar .nav-pills .nav-link:active,
        .sidebar .nav-pills .nav-link:focus-visible {
            background: var(--theme-color) !important;
            color: #fff !important;
            box-shadow: none !important;
        }
        /* Ensure generic buttons don't flash Bootstrap blue on click */
        button.btn:active, a.btn:active, input[type="button"].btn:active { background-color: var(--theme-color-dark) !important; border-color: var(--theme-color-dark) !important; color: #fff !important; }
        .sidebar .fs-5 { font-weight:600 }

        @media (max-width: 992px) {
            .sidebar { position: fixed; top: 0; left: 0; height: 100vh; transform: translateX(-100%); z-index: 1040; }
            body.sidebar-open .sidebar { transform: translateX(0); box-shadow: 0 8px 30px rgba(0,0,0,.25); }
            .sidebar-overlay { position: fixed; inset: 0; background: rgba(0,0,0,.3); z-index: 1030; }
        }
    </style>
</head>
<body>
<div class="d-flex">
    @include('partials.admin_sidebar')
    <div class="flex-grow-1">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <button id="sidebarToggle" class="btn btn-sm btn-outline-light d-lg-none me-2" aria-label="Toggle menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#">Admin Panel</a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><span class="nav-link">{{ auth()->user()->nama_lengkap ?? auth()->user()->username }}</span></li>
                        <li class="nav-item">
                            <form method="POST" action="/logout" class="d-inline">@csrf<button class="btn btn-sm btn-light">Logout</button></form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="container mt-4">
            @yield('content')
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    (function(){
        var toggle = document.getElementById('sidebarToggle');
        function closeSidebar(){ document.body.classList.remove('sidebar-open'); var ov=document.getElementById('sidebarOverlay'); if(ov) ov.remove(); }
        function openSidebar(){ document.body.classList.add('sidebar-open');
            if(!document.getElementById('sidebarOverlay')){
                var ov = document.createElement('div'); ov.id = 'sidebarOverlay'; ov.className='sidebar-overlay'; ov.addEventListener('click', closeSidebar); document.body.appendChild(ov);
            }
        }
        if(toggle){ toggle.addEventListener('click', function(){ if(document.body.classList.contains('sidebar-open')){ closeSidebar(); } else { openSidebar(); } }); }
        var closeBtn = document.getElementById('sidebarClose'); if(closeBtn){ closeBtn.addEventListener('click', closeSidebar); }
        // ensure sidebar closed on larger resize
        window.addEventListener('resize', function(){ if(window.innerWidth >= 992){ closeSidebar(); } });
    })();
</script>
@stack('scripts')
</body>
</html>
