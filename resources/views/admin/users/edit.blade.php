@extends('layouts.app')
@section('title','Edit Pengguna')
@section('content')
<h3>Edit Pengguna</h3>
@include('partials.alerts')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.users.update',$user->id_user) }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <label class="form-label">Nama Lengkap</label>
                    <input name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap',$user->nama_lengkap) }}" required>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" value="{{ old('email',$user->email) }}" required>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label">No. HP</label>
                    <input name="no_hp" class="form-control" value="{{ old('no_hp',$user->no_hp) }}">
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label">Username</label>
                    <input name="username" class="form-control" value="{{ old('username',$user->username) }}" required>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label">Password (kosongkan jika tidak diubah)</label>
                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah">
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select">
                        <option {{ $user->role=='Jemaah'?'selected':'' }}>Jemaah</option>
                        <option {{ $user->role=='Admin'?'selected':'' }}>Admin</option>
                        <option {{ $user->role=='Pimpinan'?'selected':'' }}>Pimpinan</option>
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
