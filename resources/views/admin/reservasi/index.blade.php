@extends('layouts.app')
@section('title','Kelola Reservasi')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Daftar Reservasi</h3>
</div>
@include('partials.alerts')
<div class="card"><div class="card-body">
<table class="table table-sm"><thead><tr><th>#</th><th>Kode</th><th>User</th><th>Paket</th><th>Jumlah</th><th>Total</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
@foreach(App\Models\Reservasi::with(['user','paket'])->paginate(15) as $r)
<tr><td>{{ $r->id_reservasi }}</td><td>{{ $r->kode_reservasi }}</td><td>{{ $r->user->username ?? '-' }}</td><td>{{ $r->paket->nama_paket ?? '-' }}</td><td>{{ $r->jumlah_jemaah }}</td><td>{{ number_format($r->total_biaya,0,',','.') }}</td><td>{{ $r->status_reservasi }}</td><td>
<a href="{{ route('admin.reservasi.edit',$r->id_reservasi) }}" class="btn btn-sm btn-warning">Edit</a>
<form action="{{ route('admin.reservasi.destroy',$r->id_reservasi) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Hapus</button></form>
</td></tr>
@endforeach
</tbody></table>
{{ App\Models\Reservasi::paginate(15)->links() }}
</div></div>
@endsection
