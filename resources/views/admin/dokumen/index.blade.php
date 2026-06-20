@extends('layouts.app')
@section('title','Kelola Dokumen')
@section('content')
<h3>Dokumen Keberangkatan</h3>
@include('partials.alerts')
<div class="card"><div class="card-body">
<table class="table"><thead><tr><th>#</th><th>Jemaah</th><th>Jenis</th><th>File</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
@foreach(App\Models\DokumenKeberangkatan::with('jemaah')->paginate(15) as $d)
<tr><td>{{ $d->id_dokumen }}</td><td>{{ $d->jemaah->nama_jemaah ?? '-' }}</td><td>{{ $d->jenis_dokumen }}</td><td>{{ $d->file_dokumen }}</td><td>{{ $d->status_dokumen }}</td><td>
<a href="{{ route('admin.dokumen.edit',$d->id_dokumen) }}" class="btn btn-sm btn-warning">Edit</a>
<form action="{{ route('admin.dokumen.destroy',$d->id_dokumen) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Hapus</button></form>
</td></tr>
@endforeach
</tbody></table>
{{ App\Models\DokumenKeberangkatan::paginate(15)->links() }}
</div></div>
@endsection
