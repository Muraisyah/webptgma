@extends('layouts.app')
@section('title','Kelola Pengguna')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Pengguna</h3>
  <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Tambah Akun</a>
</div>
@include('partials.alerts')

<form method="GET" action="{{ route('admin.users.index') }}" class="mb-3">
  <div class="row g-2">
    <div class="col-auto">
      <input type="search" name="q" value="{{ old('q', $q ?? '') }}" class="form-control" placeholder="Cari nama pengguna...">
    </div>
    <div class="col-auto">
      <button class="btn btn-outline-primary">Cari</button>
      <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary ms-2">Reset</a>
    </div>
  </div>
</form>

<h5 class="mt-4">Jemaah</h5>
<div class="card mb-4">
  <div class="card-body p-0">
    @if($jemaah->count())
      <div class="table-responsive">
        <table class="table table-striped align-middle mb-0">
          <thead>
            <tr>
              <th class="text-center" style="width:72px">No.</th>
              <th style="width:30%">Nama</th>
              <th style="width:30%">Email</th>
              <th style="width:20%">Username</th>
              <th style="width:10%">No. HP</th>
              <th class="text-end" style="width:170px">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($jemaah as $i => $u)
            <tr>
              <td>{{ $jemaah->firstItem() + $i }}</td>
              <td>{{ $u->nama_lengkap }}</td>
              <td><div style="max-width:320px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $u->email }}</div></td>
              <td><div style="max-width:180px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $u->username }}</div></td>
              <td><div style="max-width:150px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $u->no_hp }}</div></td>
              <td class="text-end">
                <div class="d-inline-flex gap-2 align-items-center">
                  <a href="{{ route('admin.users.edit', $u->id_user) }}" class="btn btn-sm btn-warning">Edit</a>
                  <form action="{{ route('admin.users.destroy', $u->id_user) }}" method="POST" class="m-0" onsubmit="return confirm('Hapus user?');">@csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                  </form>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      <div class="p-3">Belum ada pengguna Jemaah.</div>
    @endif
  </div>
  @if($jemaah->hasPages())
    <div class="card-footer">{{ $jemaah->links() }}</div>
  @endif
</div>

<h5 class="mt-4">Admin</h5>
<div class="card mb-4">
  <div class="card-body p-0">
    @if($admin->count())
      <div class="table-responsive">
        <table class="table table-striped align-middle mb-0">
          <thead>
            <tr>
              <th class="text-center" style="width:72px">No.</th>
              <th style="width:30%">Nama</th>
              <th style="width:30%">Email</th>
              <th style="width:20%">Username</th>
              <th style="width:10%">No. HP</th>
              <th class="text-end" style="width:170px">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($admin as $i => $u)
            <tr>
              <td>{{ $admin->firstItem() + $i }}</td>
              <td>{{ $u->nama_lengkap }}</td>
              <td><div style="max-width:320px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $u->email }}</div></td>
              <td><div style="max-width:180px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $u->username }}</div></td>
              <td><div style="max-width:150px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $u->no_hp }}</div></td>
              <td class="text-end">
                <div class="d-inline-flex gap-2 align-items-center">
                  <a href="{{ route('admin.users.edit', $u->id_user) }}" class="btn btn-sm btn-warning">Edit</a>
                  <form action="{{ route('admin.users.destroy', $u->id_user) }}" method="POST" class="m-0" onsubmit="return confirm('Hapus user?');">@csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                  </form>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      <div class="p-3">Belum ada pengguna Admin.</div>
    @endif
  </div>
  @if($admin->hasPages())
    <div class="card-footer">{{ $admin->links() }}</div>
  @endif
</div>

<h5 class="mt-4">Pimpinan</h5>
<div class="card mb-4">
  <div class="card-body p-0">
    @if($pimpinan->count())
      <div class="table-responsive">
        <table class="table table-striped align-middle mb-0">
          <thead>
            <tr>
              <th class="text-center" style="width:72px">No.</th>
              <th style="width:30%">Nama</th>
              <th style="width:30%">Email</th>
              <th style="width:20%">Username</th>
              <th style="width:10%">No. HP</th>
              <th class="text-end" style="width:170px">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pimpinan as $i => $u)
            <tr>
              <td>{{ $pimpinan->firstItem() + $i }}</td>
              <td>{{ $u->nama_lengkap }}</td>
              <td><div style="max-width:320px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $u->email }}</div></td>
              <td><div style="max-width:180px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $u->username }}</div></td>
              <td><div style="max-width:150px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $u->no_hp }}</div></td>
              <td class="text-end">
                <div class="d-inline-flex gap-2 align-items-center">
                  <a href="{{ route('admin.users.edit', $u->id_user) }}" class="btn btn-sm btn-warning">Edit</a>
                  <form action="{{ route('admin.users.destroy', $u->id_user) }}" method="POST" class="m-0" onsubmit="return confirm('Hapus user?');">@csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                  </form>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      <div class="p-3">Belum ada pengguna Pimpinan.</div>
    @endif
  </div>
  @if($pimpinan->hasPages())
    <div class="card-footer">{{ $pimpinan->links() }}</div>
  @endif
</div>

@endsection
