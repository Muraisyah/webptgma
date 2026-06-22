@extends('layouts.app')
@section('title','Data Passport')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Data Passport</h3>
    <a href="{{ route('admin.data-passport.create') }}" class="btn btn-primary">Buat</a>
</div>
@include('partials.alerts')
@include('partials.filters')
<div class="card"><div class="card-body">
<table class="table"><thead><tr><th>No.</th><th>Nama</th><th>Nomor</th><th>Exp</th><th>Aksi</th></tr></thead><tbody>
@foreach($passports as $p)
<tr>
<td>{{ $p->id_passport }}</td>
<td>{{ $p->nama_passport }}</td>
<td>{{ $p->nomor_passport }}</td>
<td>{{ $p->exp_passport }}</td>
<td>
<a href="{{ route('admin.data-passport.show',$p->id_passport) }}" class="btn btn-sm btn-info">Detail</a>
<a href="{{ route('admin.data-passport.edit',$p->id_passport) }}" class="btn btn-sm btn-warning">Edit</a>
<form action="{{ route('admin.data-passport.destroy',$p->id_passport) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Hapus</button></form>
</td>
</tr>
@endforeach
</tbody></table>
{{ $passports->links() }}
</div></div>
@endsection
