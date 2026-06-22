@extends('layouts.app')
@section('title','Data Vaksin')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Data Vaksin</h3>
    <a href="{{ route('admin.data-vaksin.create') }}" class="btn btn-primary">Buat</a>
</div>
@include('partials.alerts')
@include('partials.filters')
<div class="card"><div class="card-body">
<table class="table"><thead><tr><th>No.</th><th>Nama</th><th>Foto</th><th>Aksi</th></tr></thead><tbody>
@foreach($vaksins as $v)
<tr>
<td>{{ $v->id_vaksin }}</td>
<td>{{ $v->nama_vaksin }}</td>
<td>@if($v->foto_vaksin)<img src="{{ asset(ltrim($v->foto_vaksin,'/')) }}" style="height:40px">@endif</td>
<td>
<a href="{{ route('admin.data-vaksin.show',$v->id_vaksin) }}" class="btn btn-sm btn-info">Detail</a>
<a href="{{ route('admin.data-vaksin.edit',$v->id_vaksin) }}" class="btn btn-sm btn-warning">Edit</a>
<form action="{{ route('admin.data-vaksin.destroy',$v->id_vaksin) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Hapus</button></form>
</td>
</tr>
@endforeach
</tbody></table>
{{ $vaksins->links() }}
</div></div>
@endsection
