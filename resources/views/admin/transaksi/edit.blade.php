@extends('layouts.app')
@section('title','Edit Transaksi')
@section('content')
<h3>Edit Transaksi</h3>
@include('partials.alerts')
<form action="{{ route('admin.transaksi.update',$transaksi->id_transaksi) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3"><label class="form-label">Status Verifikasi</label><select name="status_verifikasi" class="form-select"><option value="Menunggu" {{ $transaksi->status_verifikasi=='Menunggu'?'selected':'' }}>Menunggu</option><option value="Diterima" {{ $transaksi->status_verifikasi=='Diterima'?'selected':'' }}>Diterima</option><option value="Ditolak" {{ $transaksi->status_verifikasi=='Ditolak'?'selected':'' }}>Ditolak</option></select></div>
    <div class="mb-3"><label class="form-label">Nominal</label><input name="nominal_bayar" type="number" class="form-control" value="{{ old('nominal_bayar',$transaksi->nominal_bayar) }}"></div>
    <button class="btn btn-primary">Perbarui</button>
    <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
