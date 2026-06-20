@extends('layouts.app')
@section('title','Buat Pengguna')
@section('content')
<h3>Buat Pengguna</h3>
@include('partials.alerts')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="mb-3"><label class="form-label">Nama Lengkap</label><input name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') }}"></div>
            <div class="mb-3"><label class="form-label">Email</label><input name="email" class="form-control" value="{{ old('email') }}"></div>
            <div class="mb-3"><label class="form-label">Username</label><input name="username" class="form-control" value="{{ old('username') }}"></div>
            <div class="mb-3"><label class="form-label">Password</label><input type="password" name="password" class="form-control"></div>
            <div class="mb-3"><label class="form-label">Role</label><select name="role" class="form-select"><option>Jemaah</option><option>Admin</option><option>Pimpinan</option></select></div>
            <div><button class="btn btn-primary">Simpan</button> <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a></div>
        </form>
    </div>
</div>
@endsection
