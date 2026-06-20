@extends('layouts.app')
@section('title','Kelola Rekening')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Daftar Rekening</h3>
    <a href="{{ route('admin.rekening.create') }}" class="btn btn-primary">Buat Rekening</a>
</div>
@include('partials.alerts')
<div class="card"><div class="card-body">
<table class="table"><thead><tr><th>#</th><th>Bank</th><th>Nomor</th><th>Atas Nama</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
@foreach(App\Models\Rekening::paginate(15) as $r)
<tr><td>{{ $r->id_rekening }}</td><td>{{ $r->nama_bank }}</td><td>{{ $r->nomor_rekening }}</td><td>{{ $r->atas_nama }}</td><td>{{ $r->status }}</td><td>
<a href="{{ route('admin.rekening.edit',$r->id_rekening) }}" class="btn btn-sm btn-warning">Edit</a>
<form action="{{ route('admin.rekening.destroy',$r->id_rekening) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Hapus</button></form>
</td></tr>
@endforeach
</tbody></table>
{{ App\Models\Rekening::paginate(15)->links() }}
</div></div>
@endsection
