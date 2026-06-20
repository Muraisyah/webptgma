@extends('layouts.app')
@section('title','Edit Reservasi')
@section('content')
<h3>Edit Reservasi</h3>
@include('partials.alerts')
<form action="{{ route('admin.reservasi.update',$reservasi->id_reservasi) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3"><label class="form-label">Status Reservasi</label><select name="status_reservasi" class="form-select"><option value="Pending" {{ $reservasi->status_reservasi=='Pending'?'selected':'' }}>Pending</option><option value="Berhasil" {{ $reservasi->status_reservasi=='Berhasil'?'selected':'' }}>Berhasil</option><option value="Batal" {{ $reservasi->status_reservasi=='Batal'?'selected':'' }}>Batal</option></select></div>
    <div class="mb-3"><label class="form-label">Jumlah Jemaah</label><input name="jumlah_jemaah" type="number" class="form-control" value="{{ old('jumlah_jemaah',$reservasi->jumlah_jemaah) }}"></div>
    <button class="btn btn-primary">Perbarui</button>
    <a href="{{ route('admin.reservasi.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
