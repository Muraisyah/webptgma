@extends('layouts.app')
@section('title','Kelola Transaksi')
@section('content')
<h3>Daftar Transaksi</h3>
@include('partials.alerts')
@include('partials.filters')
<div class="card"><div class="card-body">
<table class="table table-bordered"><thead><tr><th>No.</th><th>Kode</th><th>Reservasi</th><th>Nominal</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
@foreach($transaksis as $t)
<tr><td>{{ $t->id_transaksi }}</td><td>{{ $t->kode_transaksi }}</td><td>{{ $t->reservasi->kode_reservasi ?? '-' }}</td><td>{{ number_format($t->nominal_bayar,0,',','.') }}</td><td>{{ $t->status_verifikasi }}</td><td>
<a href="{{ route('admin.transaksi.edit',$t->id_transaksi) }}" class="btn btn-sm btn-warning">Edit</a>
<form action="{{ route('admin.transaksi.destroy',$t->id_transaksi) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Hapus</button></form>
</td></tr>
@endforeach
</tbody></table>
{{ $transaksis->links() }}
</div></div>
@endsection
