@extends('layouts.app')
@section('title','Kelola Transaksi')
@section('content')
<h3>Daftar Transaksi</h3>
@include('partials.alerts')
<div class="card"><div class="card-body">
<table class="table table-bordered"><thead><tr><th>#</th><th>Kode</th><th>Reservasi</th><th>Nominal</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
@foreach(App\Models\Transaksi::with(['reservasi','rekening','admin'])->paginate(15) as $t)
<tr><td>{{ $t->id_transaksi }}</td><td>{{ $t->kode_transaksi }}</td><td>{{ $t->reservasi->kode_reservasi ?? '-' }}</td><td>{{ number_format($t->nominal_bayar,0,',','.') }}</td><td>{{ $t->status_verifikasi }}</td><td>
<a href="{{ route('admin.transaksi.edit',$t->id_transaksi) }}" class="btn btn-sm btn-warning">Edit</a>
<form action="{{ route('admin.transaksi.destroy',$t->id_transaksi) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Hapus</button></form>
</td></tr>
@endforeach
</tbody></table>
{{ App\Models\Transaksi::paginate(15)->links() }}
</div></div>
@endsection
