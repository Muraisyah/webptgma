@extends('layouts.app')
@section('title','Edit Visa')
@section('content')
<h3>Edit Visa</h3>
@include('partials.alerts')
<form action="{{ route('admin.data-visa.update',$visa->id_visa) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="mb-3"><label class="form-label">Nama Visa</label><input name="nama_visa" class="form-control" value="{{ old('nama_visa',$visa->nama_visa) }}" required maxlength="35"></div>
    <div class="mb-3"><label class="form-label">Nomor Visa</label><input name="nomor_visa" class="form-control" value="{{ old('nomor_visa',$visa->nomor_visa) }}" maxlength="15"></div>
    <div class="mb-3"><label class="form-label">Tanggal Berlaku</label><input type="text" name="tgl_berlaku_visa" class="form-control flatpickr" value="{{ old('tgl_berlaku_visa',$visa->tgl_berlaku_visa) }}"></div>
    <div class="mb-3"><label class="form-label">Tanggal Exp</label><input type="text" name="tgl_exp_visa" class="form-control flatpickr" value="{{ old('tgl_exp_visa',$visa->tgl_exp_visa) }}"></div>
    <div class="mb-3"><label class="form-label">Foto (opsional)</label><input type="file" name="foto_visa" class="form-control"></div>
    <div><button class="btn btn-primary">Perbarui</button> <a href="{{ route('admin.data-visa.index') }}" class="btn btn-secondary">Batal</a></div>
        @if(!empty($visa->foto_visa))
            <div class="mb-3"><img src="{{ $visa->foto_visa }}" style="max-width:260px;border:1px solid #ddd;padding:6px;border-radius:4px"></div>
        @endif
</form>
@endsection
