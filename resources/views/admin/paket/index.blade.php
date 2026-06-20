@extends('layouts.app')
@section('title','Kelola Paket')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Daftar Paket</h3>
    <a href="{{ route('admin.paket.create') }}" class="btn btn-primary">Buat Paket</a>
</div>
@include('partials.alerts')
<div class="card"><div class="card-body">
<table class="table table-hover"><thead><tr><th>#</th><th>Gambar</th><th>Nama Paket</th><th>Keberangkatan</th><th>Harga</th><th>Seat</th><th>Aksi</th></tr></thead><tbody>
@foreach(App\Models\Paket::with('hotels')->paginate(15) as $p)
<tr>
<td>{{ $p->id_paket }}</td>
<td>
    @if($p->foto_paket)
        <img src="{{ asset(ltrim($p->foto_paket,'/')) }}" alt="{{ $p->nama_paket }}" style="width:90px;height:60px;object-fit:cover;border-radius:4px" onerror="this.onerror=null;this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'160\' height=\'100\'><rect width=\'100%\' height=\'100%\' fill=\'%23f6f6f6\'/><text x=\'50%\' y=\'50%\' dominant-baseline=\'middle\' text-anchor=\'middle\' fill=\'%23888\' font-size=\'14\'>No Image</text></svg>'">
    @endif
</td>
<td>{{ $p->nama_paket }}</td>
<td>{{ $p->tgl_keberangkatan }}</td>
<td>{{ number_format($p->harga_paket,0,',','.') }}</td>
<td>{{ $p->seat_tersedia }}</td>
<td>
    <a href="{{ route('admin.paket.show',$p->id_paket) }}" class="btn btn-sm btn-info">Detail</a>
    <a href="{{ route('admin.paket.edit',$p->id_paket) }}" class="btn btn-sm btn-warning">Edit</a>
    <form action="{{ route('admin.paket.destroy',$p->id_paket) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Hapus</button></form>
</td>
</tr>
@endforeach
</tbody></table>
{{ App\Models\Paket::paginate(15)->links() }}
</div></div>
@endsection
