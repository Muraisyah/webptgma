@extends('layouts.app')
@section('title','Edit Pengguna')
@section('content')
<h3>Edit Pengguna</h3>
@include('partials.alerts')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.users.update',$user->id_user) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3"><label class="form-label">Nama Lengkap</label><input name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap',$user->nama_lengkap) }}"></div>
            <div class="mb-3"><label class="form-label">Email</label><input name="email" class="form-control" value="{{ old('email',$user->email) }}"></div>
            <div class="mb-3"><label class="form-label">Username</label><input name="username" class="form-control" value="{{ old('username',$user->username) }}"></div>
            <div class="mb-3"><label class="form-label">Password (kosongkan jika tidak diubah)</label><input type="password" name="password" class="form-control"></div>
            <div class="mb-3"><label class="form-label">Role</label><select name="role" class="form-select"><option {{ $user->role=='Jemaah'?'selected':'' }}>Jemaah</option><option {{ $user->role=='Admin'?'selected':'' }}>Admin</option><option {{ $user->role=='Pimpinan'?'selected':'' }}>Pimpinan</option></select></div>
            <div><button class="btn btn-primary">Simpan</button> <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a></div>
        </form>
    </div>
</div>
@endsection
