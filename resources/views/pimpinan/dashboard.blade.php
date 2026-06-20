<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pimpinan Dashboard</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
	<div class="container-fluid">
		<a class="navbar-brand" href="#">Pimpinan Panel</a>
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
<div class="container mt-4">
	<div class="row">
		<div class="col-md-3">
			<div class="list-group">
				<a href="/pimpinan/dashboard" class="list-group-item list-group-item-action active">Dashboard</a>
				<a href="/pimpinan/laporan" class="list-group-item list-group-item-action">Laporan</a>
				<a href="/pimpinan/reservasi" class="list-group-item list-group-item-action">Reservasi</a>
				<a href="/pimpinan/transaksi" class="list-group-item list-group-item-action">Transaksi</a>
			</div>
		</div>
		<div class="col-md-9">
			<div class="card">
				<div class="card-body">
					<h3 class="card-title">Selamat datang</h3>
					<p class="card-text">Anda masuk sebagai <strong>{{ auth()->user()->role }}</strong>.</p>
					<p class="card-text">Gunakan menu di samping untuk melihat laporan dan status reservasi.</p>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>