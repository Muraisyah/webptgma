@extends('layouts.app')
@section('title','Edit Paket')
@section('content')
<h3>Edit Paket</h3>
@include('partials.alerts')
<form action="{{ route('admin.paket.update',$paket->id_paket) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="mb-3"><label class="form-label">Nama Paket</label><input name="nama_paket" class="form-control" value="{{ old('nama_paket',$paket->nama_paket) }}" required></div>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3"><label class="form-label">Durasi Perjalanan (hari)</label><input name="durasi_perjalanan" class="form-control" type="number" value="{{ old('durasi_perjalanan',$paket->durasi_perjalanan) }}"></div>
        </div>
        <div class="col-md-3">
            <div class="mb-3"><label class="form-label">Tanggal Keberangkatan</label><input name="tgl_keberangkatan" class="form-control" type="date" value="{{ old('tgl_keberangkatan',$paket->tgl_keberangkatan) }}"></div>
        </div>
        <div class="col-md-3">
            <div class="mb-3"><label class="form-label">Tanggal Kepulangan</label><input name="tgl_kepulangan" class="form-control" type="date" value="{{ old('tgl_kepulangan',$paket->tgl_kepulangan) }}"></div>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Hotel (tambahkan satu-persatu)</label>
        <div class="input-group">
            <select id="hotelSelect" class="form-select">
                <option value="">-- Pilih hotel --</option>
                @foreach(App\Models\Hotel::all() as $h)
                    <option value="{{ $h->id_hotel }}">{{ $h->nama_hotel }}</option>
                @endforeach
            </select>
            <button id="addHotelBtn" type="button" class="btn btn-outline-secondary">+</button>
        </div>
        <div id="selectedHotels" class="mt-2">
            @foreach(old('id_hotel', $paket->hotels->pluck('id_hotel')->toArray()) as $hid)
                @php($h = App\Models\Hotel::find($hid))
                @if($h)
                    <span class="badge bg-secondary me-1 mb-1 selected-hotel" data-id="{{ $h->id_hotel }}">{{ $h->nama_hotel }} <button type="button" class="btn-close btn-close-white btn-sm remove-hotel" aria-label="Remove"></button><input type="hidden" name="id_hotel[]" value="{{ $h->id_hotel }}"></span>
                @endif
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-md-4"><div class="mb-3"><label class="form-label">Kuota Paket</label><input name="kuota_paket" class="form-control" type="number" value="{{ old('kuota_paket',$paket->kuota_paket) }}"></div></div>
        <div class="col-md-4"><div class="mb-3"><label class="form-label">Seat Tersedia</label><input name="seat_tersedia" class="form-control" type="number" value="{{ old('seat_tersedia',$paket->seat_tersedia) }}"></div></div>
        <div class="col-md-4"><div class="mb-3"><label class="form-label">Harga Paket</label><input name="harga_paket" class="form-control" type="number" value="{{ old('harga_paket',$paket->harga_paket) }}" required></div></div>
    </div>
    <div class="mb-3"><label class="form-label">Maskapai</label><input name="maskapai" class="form-control" value="{{ old('maskapai',$paket->maskapai) }}"></div>
    <div class="mb-3"><label class="form-label">Deskripsi</label><textarea name="deskripsi" class="form-control">{{ old('deskripsi',$paket->deskripsi) }}</textarea></div>
    <div class="mb-3"><label class="form-label">Foto Paket (kosongkan jika tidak ingin mengganti)</label><input type="file" name="foto_paket" class="form-control"></div>
    <div class="mb-3"><label class="form-label">Status</label><select name="status_paket" class="form-select"><option value="Aktif" {{ old('status_paket',$paket->status_paket)=='Aktif'?'selected':'' }}>Aktif</option><option value="Nonaktif" {{ old('status_paket',$paket->status_paket)=='Nonaktif'?'selected':'' }}>Nonaktif</option></select></div>
    <button class="btn btn-primary">Perbarui</button>
    <a href="{{ route('admin.paket.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    var addBtn = document.getElementById('addHotelBtn');
    var hotelSelect = document.getElementById('hotelSelect');
    var container = document.getElementById('selectedHotels');

    function createBadge(id, name){
        if(container.querySelector('[data-id="'+id+'"]')) return;
        var span = document.createElement('span');
        span.className = 'badge bg-secondary me-1 mb-1 selected-hotel';
        span.setAttribute('data-id', id);
        span.innerHTML = name + ' <button type="button" class="btn-close btn-close-white btn-sm remove-hotel" aria-label="Remove"></button>';
        var input = document.createElement('input'); input.type='hidden'; input.name='id_hotel[]'; input.value=id;
        span.appendChild(input);
        container.appendChild(span);
    }

    addBtn.addEventListener('click', function(){
        var id = hotelSelect.value; if(!id) return;
        var name = hotelSelect.options[hotelSelect.selectedIndex].text;
        createBadge(id,name);
    });

    container.addEventListener('click', function(e){
        if(e.target && e.target.classList.contains('remove-hotel')){
            var badge = e.target.closest('.selected-hotel'); if(badge) badge.remove();
        }
    });
});
</script>
@endpush
