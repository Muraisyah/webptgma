@extends('layouts.app')
@section('title','Buat Pengguna')
@section('content')
<h3>Buat Pengguna</h3>
@include('partials.alerts')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <label class="form-label">Nama Lengkap</label>
                    <input name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') }}" placeholder="Nama lengkap" required>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" value="{{ old('email') }}" placeholder="contoh@domain.com" required>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label">No. HP</label>
                    <input name="no_hp" class="form-control" value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx">
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label">Username</label>
                    <input name="username" class="form-control" value="{{ old('username') }}" placeholder="username" required>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select">
                        <option>Jemaah</option>
                        <option>Admin</option>
                        <option>Pimpinan</option>
                    </select>
                </div>
            </div>
            <div class="mt-3 d-flex gap-2">
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
