@extends('layouts.app')
@section('title','Daftar Akun Jemaah (Pimpinan)')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Daftar Akun Jemaah</h3>
  <a href="{{ route('pimpinan.dashboard') }}" class="btn btn-secondary">Kembali</a>
</div>
@include('partials.alerts')
<div class="card">
  <div class="card-body p-0">
    <table class="table mb-0">
      <thead>
        <tr>
          <th>No.</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Username</th>
          <th>No. HP</th>
          <th>Detail</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $i => $u)
        <tr>
          <td>{{ $users->firstItem() + $i }}</td>
          <td>{{ $u->nama_lengkap }}</td>
          <td>{{ $u->email }}</td>
          <td>{{ $u->username }}</td>
          <td>{{ $u->no_hp }}</td>
          <td>
            @php $dj = \App\Models\DataJemaah::where('id_user',$u->id_user)->first(); @endphp
            @if($dj)
              <a href="{{ route('pimpinan.data-jemaah.show', $dj->id_jemaah) }}" class="btn btn-sm btn-primary">Lihat Detail</a>
            @else
              <span class="text-muted small">-</span>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="card-footer">{{ $users->links() }}</div>
</div>
@endsection
