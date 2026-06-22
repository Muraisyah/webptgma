@extends('layouts.app')
@section('title','Data Visa')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Data Visa</h3>
    <a href="{{ route('admin.data-visa.create') }}" class="btn btn-primary">Buat</a>
</div>
@include('partials.alerts')
@include('partials.filters')
<div class="card"><div class="card-body">
<table class="table"><thead><tr><th>No.</th><th>Nama</th><th>Nomor</th><th>Exp</th><th>Aksi</th></tr></thead><tbody>
@foreach($visas as $v)
<tr>
<td>{{ $v->id_visa }}</td>
<td>{{ $v->nama_visa }}</td>
<td>{{ $v->nomor_visa }}</td>
<td>{{ $v->tgl_exp_visa }}</td>
<td>
<a href="{{ route('admin.data-visa.show',$v->id_visa) }}" class="btn btn-sm btn-info">Detail</a>
<a href="{{ route('admin.data-visa.edit',$v->id_visa) }}" class="btn btn-sm btn-warning">Edit</a>
<form action="{{ route('admin.data-visa.destroy',$v->id_visa) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Hapus</button></form>
</td>
</tr>
@endforeach
</tbody></table>
{{ $visas->links() }}
</div></div>
@endsection
