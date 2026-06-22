@extends('layouts.frontend')

@section('title','Galeri')

@section('content')
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Galeri</h2>
    <form class="row gx-2 gy-1 align-items-center" method="get" action="{{ route('galeri.index') }}">
      <div class="col-auto">
        <input type="search" name="q" class="form-control form-control-sm" placeholder="Cari judul atau deskripsi" value="{{ request('q') }}">
      </div>
      <div class="col-auto">
        <input type="date" name="date_from" class="form-control form-control-sm" value="{{ request('date_from') }}">
      </div>
      <div class="col-auto">
        <input type="date" name="date_to" class="form-control form-control-sm" value="{{ request('date_to') }}">
      </div>
      <div class="col-auto">
        <button class="btn btn-primary btn-sm">Cari</button>
        <a href="{{ route('galeri.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
      </div>
    </form>
  </div>

  @if($galeris->count())
  <div class="row g-3">
    @foreach($galeris as $g)
      @php
        $foto = $g->foto_jemaah;
        if (!$foto) {
          $src = asset('images/placeholder.svg');
        } elseif (preg_match('/^https?:\/\//', $foto)) {
            $src = $foto;
        } elseif (preg_match('#^/storage/#', $foto)) {
            $src = asset(ltrim($foto, '/'));
        } elseif (preg_match('#^storage/#', $foto)) {
            $src = asset($foto);
        } elseif (preg_match('#^/#', $foto)) {
            $src = asset(ltrim($foto, '/'));
        } else {
            // assume path relative to storage/app/public
            $src = asset('storage/' . ltrim($foto, '/'));
        }
      @endphp
      <div class="col-6 col-md-4 col-lg-3">
        <div class="card h-100 shadow-sm">
          <a href="#" class="galeri-thumb" data-bs-toggle="modal" data-bs-target="#galeriModal" data-src="{{ $src }}" data-title="{{ e($g->judul_foto) }}">
            <img src="{{ $src }}" class="card-img-top" style="object-fit:cover;height:160px;" alt="{{ $g->judul_foto }}">
          </a>
          <div class="card-body p-2">
            <h6 class="card-title mb-1">{{ \Illuminate\Support\Str::limit($g->judul_foto, 40) }}</h6>
            <p class="small text-muted mb-1">{{ \Illuminate\Support\Str::limit($g->deskripsi_foto, 60) }}</p>
            <p class="small text-muted mb-0">Oleh: {{ optional($g->user)->nama_lengkap ?? optional($g->user)->username ?? 'Admin' }}</p>
            <p class="small text-muted">{{ $g->created_at->format('d M Y') }}</p>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <div class="mt-4">
    {{ $galeris->links() }}
  </div>
  @else
    <div class="alert alert-light">Belum ada foto di galeri.</div>
  @endif
</div>
<!-- Modal Lightbox -->
<div class="modal fade" id="galeriModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="galeriModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center bg-dark">
        <img id="galeriModalImg" src="" alt="" style="max-width:100%;height:auto;" class="img-fluid">
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('.galeri-thumb').forEach(function(el){
      el.addEventListener('click', function(e){
        var src = el.getAttribute('data-src');
        var title = el.getAttribute('data-title') || '';
        var img = document.getElementById('galeriModalImg');
        var label = document.getElementById('galeriModalLabel');
        if(img) img.src = src;
        if(label) label.textContent = title;
      });
    });
    // clear src when modal hidden to stop downloading large images
    var galeriModal = document.getElementById('galeriModal');
    if(galeriModal) {
      galeriModal.addEventListener('hidden.bs.modal', function(){
        var img = document.getElementById('galeriModalImg'); if(img) img.src = '';
      });
    }
  });
</script>
@endpush
@endsection
