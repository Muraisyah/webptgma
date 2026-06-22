@extends('layouts.app')
@section('title','Data Jemaah')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Data Jemaah</h3>
    <a href="{{ route('admin.data-jemaah.create') }}" class="btn btn-primary">Buat</a>
</div>
@include('partials.alerts')
@include('partials.filters')
<div class="card"><div class="card-body">
<table class="table"><thead><tr><th>No.</th><th>Nama</th><th>NIK</th><th>Passport</th><th>Visa</th><th>Vaksin</th><th>Aksi</th></tr></thead><tbody>
@foreach($jemaahs as $j)
<tr>
<td>{{ $j->id_jemaah }}</td>
<td>{{ $j->nama_jemaah }}</td>
<td>{{ $j->nik }}</td>
<td>{{ $j->passport->nomor_passport ?? '-' }}</td>
<td>{{ $j->visa->nomor_visa ?? '-' }}</td>
<td>{{ $j->vaksin->nama_vaksin ?? '-' }}</td>
<td>
<a href="{{ route('admin.data-jemaah.show',$j->id_jemaah) }}" class="btn btn-sm btn-info">Detail</a>
<a href="{{ route('admin.data-jemaah.edit',$j->id_jemaah) }}" class="btn btn-sm btn-warning">Edit</a>
<form action="{{ route('admin.data-jemaah.destroy',$j->id_jemaah) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Hapus</button></form>
</td>
</tr>
@endforeach
</tbody></table>
{{ $jemaahs->links() }}
</div></div>
@endsection
