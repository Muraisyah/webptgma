@extends('layouts.app')
@section('title','Kelola Hotel')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Daftar Hotel</h3>
    <a href="{{ route('admin.hotel.create') }}" class="btn btn-primary">Buat Hotel</a>
</div>
@include('partials.alerts')
@include('partials.filters')
<div class="card"><div class="card-body">
<table class="table table-striped"><thead><tr><th>No.</th><th>Nama</th><th>Kota</th><th>Kategori</th><th>Aksi</th></tr></thead><tbody>
@foreach($hotels as $h)
<tr><td>{{ $h->id_hotel }}</td><td>{{ $h->nama_hotel }}</td><td>{{ $h->kota }}</td><td>{{ $h->kategori_hotel }}</td><td>
<a href="{{ route('admin.hotel.edit',$h->id_hotel) }}" class="btn btn-sm btn-warning">Edit</a>
<form action="{{ route('admin.hotel.destroy',$h->id_hotel) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Hapus</button></form>
</td></tr>
@endforeach
</tbody></table>
{{ $hotels->links() }}
</div></div>
@endsection
