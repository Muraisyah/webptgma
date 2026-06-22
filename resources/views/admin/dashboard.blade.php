@extends('layouts.app')

@section('title','Admin Dashboard')

@section('content')
	<div class="row mb-3">
		<div class="col-12">
			<h3>Dashboard Admin</h3>
			<p class="text-muted">Ringkasan singkat statistik dan pendapatan.</p>
		</div>
	</div>

	<div class="row g-3">
		<div class="col-md-3">
			<div class="card shadow-sm">
				<div class="card-body">
					<h6 class="text-muted">Transaksi</h6>
					<h3>{{ number_format($transaksiCount,0,',','.') }}</h3>
					<small class="text-muted">Total transaksi keseluruhan</small>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card shadow-sm">
				<div class="card-body">
					<h6 class="text-muted">Pendapatan Hari Ini</h6>
					<h3>Rp {{ number_format($pendapatanHari ?? 0,0,',','.') }}</h3>
					<small class="text-muted">Total pembayaran hari ini</small>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card shadow-sm">
				<div class="card-body">
					<h6 class="text-muted">Pendapatan Bulan Ini</h6>
					<h3>Rp {{ number_format($pendapatanBulan ?? 0,0,',','.') }}</h3>
					<small class="text-muted">Total pembayaran bulan ini</small>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card shadow-sm">
				<div class="card-body">
					<h6 class="text-muted">Pendapatan Tahun Ini</h6>
					<h3>Rp {{ number_format($pendapatanTahun ?? 0,0,',','.') }}</h3>
					<small class="text-muted">Total pembayaran tahun ini</small>
				</div>
			</div>
		</div>
	</div>

	<div class="row g-3 mt-3">
		<div class="col-md-3">
			<div class="card shadow-sm">
				<div class="card-body">
					<h6 class="text-muted">Paket</h6>
					<h3>{{ number_format($paketCount,0,',','.') }}</h3>
					<small class="text-muted">Jumlah paket tersedia</small>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card shadow-sm">
				<div class="card-body">
					<h6 class="text-muted">Reservasi</h6>
					<h3>{{ number_format($reservasiCount,0,',','.') }}</h3>
					<small class="text-muted">Total reservasi</small>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card shadow-sm">
				<div class="card-body">
					<h6 class="text-muted">Pengguna</h6>
					<h3>{{ number_format($userCount,0,',','.') }}</h3>
					<small class="text-muted">Total user terdaftar</small>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card shadow-sm">
				<div class="card-body">
					<h6 class="text-muted">Transaksi Pending</h6>
					<h3>{{ number_format($pendingTransaksi,0,',','.') }}</h3>
					<small class="text-muted">Menunggu verifikasi</small>
				</div>
			</div>
		</div>
	</div>

	<div class="row mt-4">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h5>Catatan</h5>
					<p class="text-muted">Data di atas adalah ringkasan cepat. Untuk laporan lengkap, gunakan halaman laporan atau ekspor data.</p>
				</div>
			</div>
		</div>
	</div>
@endsection