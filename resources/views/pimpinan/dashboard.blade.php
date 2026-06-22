@extends('layouts.app')
@section('title','Dashboard Pimpinan')
@section('content')
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Dashboard Pimpinan</h2>
  </div>
  <div class="row mb-4">
    <div class="col-md-3">
      <div class="card text-white bg-primary">
        <div class="card-body">
          <h5 class="card-title">Data Jemaah</h5>
          <p class="display-6">{{ $jemaahCount }}</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-white bg-success">
        <div class="card-body">
          <h5 class="card-title">Passport</h5>
          <p class="display-6">{{ $passportCount }}</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-white bg-warning">
        <div class="card-body">
          <h5 class="card-title">Vaksin</h5>
          <p class="display-6">{{ $vaksinCount }}</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-white bg-secondary">
        <div class="card-body">
          <h5 class="card-title">Visa</h5>
          <p class="display-6">{{ $visaCount }}</p>
        </div>
      </div>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h6>Total Transaksi</h6>
          <p class="h4">{{ $transaksiCount ?? 0 }}</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h6>Pendapatan Hari Ini</h6>
          <p class="h4">Rp {{ number_format($pendapatanHari ?? 0,0,',','.') }}</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h6>Pendapatan Bulan Ini</h6>
          <p class="h4">Rp {{ number_format($pendapatanBulan ?? 0,0,',','.') }}</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h6>Pendapatan Tahun Ini</h6>
          <p class="h4">Rp {{ number_format($pendapatanTahun ?? 0,0,',','.') }}</p>
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">Recent Jemaah</div>
    <div class="card-body p-0">
      <table class="table mb-0">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>NIK</th>
            <th>Passport</th>
            <th>Visa</th>
            <th>Vaksin</th>
          </tr>
        </thead>
        <tbody>
          @foreach($recentJemaah as $i => $j)
            <tr>
              <td>{{ $i+1 }}</td>
              <td><a href="{{ route('admin.data-jemaah.show', $j->id_jemaah) }}">{{ $j->nama_jemaah }}</a></td>
              <td>{{ $j->nik }}</td>
              <td>{{ $j->passport->nomor_passport ?? '-' }}</td>
              <td>{{ $j->visa->nomor_visa ?? '-' }}</td>
              <td>{{ $j->vaksin->nama_vaksin ?? '-' }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection