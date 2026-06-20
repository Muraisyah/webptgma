@extends('layouts.app')
@section('title','Kelola Galeri')
@section('content')
<h3>Galeri Jemaah</h3>
@include('partials.alerts')
<div class="row">
@foreach(App\Models\Galeri::paginate(12) as $g)
<div class="col-md-3 mb-3"><div class="card"><img src="{{ $g->foto_jemaah }}" class="card-img-top" alt=""><div class="card-body"><h6>{{ $g->judul_foto }}</h6><p class="small">{{ Str::limit($g->deskripsi_foto,60) }}</p><div class="d-flex"><a href="{{ route('admin.galeri.edit',$g->id_galeri) }}" class="btn btn-sm btn-warning me-2">Edit</a><form action="{{ route('admin.galeri.destroy',$g->id_galeri) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Hapus</button></form></div></div></div></div>
@endforeach
</div>
<div>{{ App\Models\Galeri::paginate(12)->links() }}</div>
@endsection
