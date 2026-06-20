@extends('layouts.app')

@section('title','Kelola Pengguna')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Daftar Pengguna</h3>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Buat Pengguna</a>
</div>
@include('partials.alerts')
<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr><th>#</th><th>Nama</th><th>Username</th><th>Email</th><th>Role</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr>
                    <td>{{ $u->id_user }}</td>
                    <td>{{ $u->nama_lengkap }}</td>
                    <td>{{ $u->username }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->role }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit',$u->id_user) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.users.destroy',$u->id_user) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus user?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Hapus</button></form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
</div>
@endsection
