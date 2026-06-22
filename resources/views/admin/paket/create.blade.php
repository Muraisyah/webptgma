@extends('layouts.app')
@section('title','Buat Paket')
@section('content')
<h3>Buat Paket Baru</h3>
@include('partials.alerts')
<form action="{{ route('admin.paket.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3"><label class="form-label">Nama Paket</label><input name="nama_paket" class="form-control" value="{{ old('nama_paket') }}" required></div>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3"><label class="form-label">Durasi Perjalanan (hari)</label><input name="durasi_perjalanan" class="form-control" type="number" value="{{ old('durasi_perjalanan') }}"></div>
        </div>
        <div class="col-md-3">
            <div class="mb-3"><label class="form-label">Tanggal Keberangkatan</label><input name="tgl_keberangkatan" class="form-control" type="date" value="{{ old('tgl_keberangkatan') }}"></div>
        </div>
        <div class="col-md-3">
            <div class="mb-3"><label class="form-label">Tanggal Kepulangan</label><input name="tgl_kepulangan" class="form-control" type="date" value="{{ old('tgl_kepulangan') }}"></div>
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
            {{-- appended selected hotels will appear here as badges with hidden inputs --}}
            @if(old('id_hotel'))
                @foreach(old('id_hotel') as $hid)
                    @php($h = App\Models\Hotel::find($hid))
                    @if($h)
                        <span class="badge bg-secondary me-1 mb-1 selected-hotel" data-id="{{ $h->id_hotel }}">{{ $h->nama_hotel }} <button type="button" class="btn-close btn-close-white btn-sm remove-hotel" aria-label="Remove"></button><input type="hidden" name="id_hotel[]" value="{{ $h->id_hotel }}"></span>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-4"><div class="mb-3"><label class="form-label">Kuota Paket</label><input name="kuota_paket" class="form-control" type="number" value="{{ old('kuota_paket') }}"></div></div>
        <div class="col-md-4"><div class="mb-3"><label class="form-label">Seat Tersedia</label><input name="seat_tersedia" class="form-control" type="number" value="{{ old('seat_tersedia') }}"></div></div>
        <div class="col-md-4"><div class="mb-3"><label class="form-label">Harga Paket</label><input name="harga_paket" class="form-control" type="number" value="{{ old('harga_paket') }}" required></div></div>
    </div>
    <div class="mb-3"><label class="form-label">Maskapai</label><input name="maskapai" class="form-control" value="{{ old('maskapai') }}"></div>
    <div class="mb-3"><label class="form-label">Deskripsi</label><textarea name="deskripsi" class="form-control">{{ old('deskripsi') }}</textarea></div>
    <div class="mb-3"><label class="form-label">Foto Paket</label><input type="file" name="foto_paket" class="form-control"></div>
    <div class="mb-3"><label class="form-label">Status</label><select name="status_paket" class="form-select"><option value="Aktif" {{ old('status_paket')=='Aktif'?'selected':'' }}>Aktif</option><option value="Nonaktif" {{ old('status_paket')=='Nonaktif'?'selected':'' }}>Nonaktif</option></select></div>
    <button class="btn btn-primary">Simpan</button>
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
        // prevent duplicate
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
