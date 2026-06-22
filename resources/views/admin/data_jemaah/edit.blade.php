@extends('layouts.app')
@section('title','Edit Jemaah')
@section('content')
<h3>Edit Jemaah</h3>
@include('partials.alerts')
<form action="{{ route('admin.data-jemaah.update',$jemaah->id_jemaah) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    {{-- id_user otomatis dari authenticated user --}}
    <div class="mb-3"><label class="form-label">Nama</label><input name="nama_jemaah" class="form-control" value="{{ old('nama_jemaah',$jemaah->nama_jemaah) }}" required maxlength="35"></div>
    <div class="mb-3"><label class="form-label">Tempat Lahir</label><input name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir',$jemaah->tempat_lahir) }}" maxlength="30"></div>
    <div class="mb-3"><label class="form-label">Tanggal Lahir</label><input id="tgl_lahir" type="text" name="tgl_lahir" class="form-control flatpickr" value="{{ old('tgl_lahir',$jemaah->tgl_lahir) }}"></div>
    <div class="mb-3"><label class="form-label">NIK</label><input name="nik" class="form-control" value="{{ old('nik',$jemaah->nik) }}" maxlength="16"></div>
    <div class="mb-3"><label class="form-label">Jenis Kelamin</label><select name="jenis_kelamin" class="form-select"><option value="">-</option><option value="Laki-laki" {{ $jemaah->jenis_kelamin=='Laki-laki'?'selected':'' }}>Laki-laki</option><option value="Perempuan" {{ $jemaah->jenis_kelamin=='Perempuan'?'selected':'' }}>Perempuan</option></select></div>
    <div class="mb-3"><label class="form-label">Alamat</label><textarea name="alamat" class="form-control">{{ old('alamat',$jemaah->alamat) }}</textarea></div>
    <div class="mb-3"><label class="form-label">Nama Ayah</label><input name="nama_ayah" class="form-control" value="{{ old('nama_ayah',$jemaah->nama_ayah) }}" maxlength="35"></div>
    <div class="mb-3"><label class="form-label">Status Pernikahan</label>
        <select id="status_pernikahan" name="status_pernikahan" class="form-select">
            <option value="">-</option>
            <option value="Menikah" {{ ($jemaah->status_pernikahan ?? old('status_pernikahan'))=='Menikah'?'selected':'' }}>Menikah</option>
            <option value="Belum Menikah" {{ ($jemaah->status_pernikahan ?? old('status_pernikahan'))=='Belum Menikah'?'selected':'' }}>Belum Menikah</option>
            <option value="Duda" {{ ($jemaah->status_pernikahan ?? old('status_pernikahan'))=='Duda'?'selected':'' }}>Duda</option>
            <option value="Janda" {{ ($jemaah->status_pernikahan ?? old('status_pernikahan'))=='Janda'?'selected':'' }}>Janda</option>
            <option value="Cerai Hidup" {{ ($jemaah->status_pernikahan ?? old('status_pernikahan'))=='Cerai Hidup'?'selected':'' }}>Cerai Hidup</option>
        </select>
    </div>
    <div class="mb-3"><label class="form-label">Kewarganegaraan</label><input name="kewarganegaraan" class="form-control" value="{{ old('kewarganegaraan',$jemaah->kewarganegaraan) }}" maxlength="30"></div>

    <div class="mb-3"><label class="form-label">Foto KTP</label><input type="file" name="foto_ktp" class="form-control"></div>
    <div class="mb-3"><label class="form-label">Foto KK</label><input type="file" name="foto_kk" class="form-control"></div>
    <div class="mb-3"><label class="form-label">Foto Akte</label><input type="file" name="foto_akte" class="form-control"></div>
    <div class="mb-3"><label class="form-label">Foto Buku Nikah</label><input type="file" name="foto_buku_nikah" class="form-control"></div>
    <div id="parent-ktp-section" style="display:{{ (isset($jemaah->tgl_lahir) && \Carbon\Carbon::parse($jemaah->tgl_lahir)->age < 18) ? 'block' : 'none' }}">
        <div class="mb-3"><label class="form-label">Foto KTP Ayah</label><input type="file" name="foto_ktp_ayah" class="form-control"></div>
        <div class="mb-3"><label class="form-label">Foto KTP Ibu</label><input type="file" name="foto_ktp_ibu" class="form-control"></div>
    </div>

    <div id="buku-nikah-section" style="display:{{ (($jemaah->status_pernikahan ?? old('status_pernikahan'))=='Menikah') ? 'block' : 'none' }}">
        <div class="mb-3"><label class="form-label">Foto Buku Nikah</label><input type="file" name="foto_buku_nikah" class="form-control"></div>
    </div>

    <div class="mb-3">
        <label class="form-label">Passport</label>
        <div id="select-passport-container" style="display:none">
        <select id="select_passport" name="id_passport" class="form-select mb-2 select-search">
            <option value=""></option>
            @foreach($passports as $p)
                <option value="{{ $p->id_passport }}"
                    data-nomor="{{ $p->nomor_passport }}"
                    data-nama="{{ $p->nama_passport }}"
                    data-nama-tambahan="{{ $p->nama_tambahan }}"
                    data-tempat-lahir="{{ $p->tempat_lahir_pass }}"
                    data-tgl-lahir="{{ $p->tgl_lahir_pass }}"
                    data-tempat-pembuatan="{{ $p->tempat_pembuatan }}"
                    data-tgl-pembuatan="{{ $p->tgl_pembuatan }}"
                    data-exp="{{ $p->exp_passport }}"
                    data-status="{{ $p->status_passport }}"
                    data-foto-identitas="{{ $p->foto_identitas_pass ?? '' }}"
                    data-foto-nama-tambahan="{{ $p->foto_nama_tambahan ?? '' }}"
                    {{ (old('id_passport',$jemaah->id_passport) == $p->id_passport) ? 'selected' : '' }}>
                    {{ ($p->nomor_passport ? $p->nomor_passport.' - ' : '').($p->nama_passport ?? $p->nama_tambahan) }}
                </option>
            @endforeach
        </select>
        <div class="mb-2"><img id="passport_preview_img" src="{{ $jemaah->passport->foto_identitas_pass ?? '' }}" alt="Preview Passport" style="max-width:180px;{{ isset($jemaah->passport->foto_identitas_pass) ? '' : 'display:none' }};border:1px solid #ddd;padding:4px;border-radius:4px"></div>
        </div>
        <select id="passport_have" class="form-select">
            <option value="0" {{ $jemaah->id_passport? '': 'selected' }}>Belum punya</option>
            <option value="1" {{ $jemaah->id_passport? 'selected' : '' }}>Sudah punya / pilih</option>
        </select>
    </div>
    <div id="passport-section" style="display:{{ $jemaah->id_passport? 'block':'none' }}">
        <h6>Data Passport (isi jika ada)</h6>
        <div class="mb-3"><label class="form-label">Nama Passport</label><input name="passport_nama_passport" class="form-control" value="{{ old('passport_nama_passport', $jemaah->passport->nama_passport ?? '') }}"></div>
        <div class="mb-3"><label class="form-label">Nama Tambahan</label><input name="passport_nama_tambahan" class="form-control" value="{{ old('passport_nama_tambahan', $jemaah->passport->nama_tambahan ?? '') }}"></div>
        <div class="mb-3"><label class="form-label">Nomor Passport</label><input name="passport_nomor_passport" class="form-control" value="{{ old('passport_nomor_passport', $jemaah->passport->nomor_passport ?? '') }}"></div>
        <div class="mb-3"><label class="form-label">Tempat Lahir (Passport)</label><input name="passport_tempat_lahir_pass" class="form-control" value="{{ old('passport_tempat_lahir_pass', $jemaah->passport->tempat_lahir_pass ?? '') }}"></div>
        <div class="mb-3"><label class="form-label">Tanggal Lahir (Passport)</label><input type="text" name="passport_tgl_lahir_pass" class="form-control flatpickr" value="{{ old('passport_tgl_lahir_pass', $jemaah->passport->tgl_lahir_pass ?? '') }}"></div>
        <div class="mb-3"><label class="form-label">Tempat Pembuatan</label><input name="passport_tempat_pembuatan" class="form-control" value="{{ old('passport_tempat_pembuatan', $jemaah->passport->tempat_pembuatan ?? '') }}"></div>
        <div class="mb-3"><label class="form-label">Tanggal Pembuatan</label><input type="text" name="passport_tgl_pembuatan" class="form-control flatpickr" value="{{ old('passport_tgl_pembuatan', $jemaah->passport->tgl_pembuatan ?? '') }}"></div>
        <div class="mb-3"><label class="form-label">Tanggal Exp Passport</label><input type="text" name="passport_exp_passport" class="form-control flatpickr" value="{{ old('passport_exp_passport', $jemaah->passport->exp_passport ?? '') }}"></div>
        <div class="mb-3"><label class="form-label">Foto Identitas Passport</label><input type="file" name="passport_foto_identitas_pass" class="form-control"></div>
        <div class="mb-3"><label class="form-label">Foto Nama Tambahan</label><input type="file" name="passport_foto_nama_tambahan" class="form-control"></div>
        <div class="mb-3"><label class="form-label">Status Passport</label><select name="passport_status_passport" class="form-select"><option value="Aktif" {{ (old('passport_status_passport', $jemaah->passport->status_passport ?? '')=='Aktif')?'selected':'' }}>Aktif</option><option value="Expired" {{ (old('passport_status_passport', $jemaah->passport->status_passport ?? '')=='Expired')?'selected':'' }}>Expired</option></select></div>
    </div>

    <div class="mb-3">
        <label class="form-label">Visa</label>
        <div id="select-visa-container" style="display:none">
        <select id="select_visa" name="id_visa" class="form-select mb-2 select-search">
            <option value=""></option>
            @foreach($visas as $v)
                <option value="{{ $v->id_visa }}"
                    data-nama="{{ $v->nama_visa }}"
                    data-nomor="{{ $v->nomor_visa }}"
                    data-tgl-berlaku="{{ $v->tgl_berlaku_visa }}"
                    data-tgl-exp="{{ $v->tgl_exp_visa }}"
                    data-foto="{{ $v->foto_visa ?? '' }}"
                    {{ (old('id_visa',$jemaah->id_visa) == $v->id_visa) ? 'selected' : '' }}>
                    {{ ($v->nomor_visa ? $v->nomor_visa.' - ' : '').($v->nama_visa ?? '') }}
                </option>
            @endforeach
        </select>
        <div class="mb-2"><img id="visa_preview_img" src="{{ $jemaah->visa->foto_visa ?? '' }}" alt="Preview Visa" style="max-width:180px;{{ isset($jemaah->visa->foto_visa) ? '' : 'display:none' }};border:1px solid #ddd;padding:4px;border-radius:4px"></div>
        </div>
        <select id="visa_have" class="form-select">
            <option value="0" {{ $jemaah->id_visa? '': 'selected' }}>Belum punya</option>
            <option value="1" {{ $jemaah->id_visa? 'selected' : '' }}>Sudah punya / pilih</option>
        </select>
    </div>
    <div id="visa-section" style="display:{{ $jemaah->id_visa? 'block':'none' }}">
        <h6>Data Visa (isi jika ada)</h6>
        <div class="mb-3"><label class="form-label">Nama Visa</label><input name="visa_nama_visa" class="form-control" value="{{ old('visa_nama_visa', $jemaah->visa->nama_visa ?? '') }}"></div>
        <div class="mb-3"><label class="form-label">Nomor Visa</label><input name="visa_nomor_visa" class="form-control" value="{{ old('visa_nomor_visa', $jemaah->visa->nomor_visa ?? '') }}"></div>
        <div class="mb-3"><label class="form-label">Tanggal Berlaku Visa</label><input type="text" name="visa_tgl_berlaku_visa" class="form-control flatpickr" value="{{ old('visa_tgl_berlaku_visa', $jemaah->visa->tgl_berlaku_visa ?? '') }}"></div>
        <div class="mb-3"><label class="form-label">Tanggal Exp Visa</label><input type="text" name="visa_tgl_exp_visa" class="form-control flatpickr" value="{{ old('visa_tgl_exp_visa', $jemaah->visa->tgl_exp_visa ?? '') }}"></div>
        <div class="mb-3"><label class="form-label">Foto Visa</label><input type="file" name="visa_foto_visa" class="form-control"></div>
    </div>

    <div class="mb-3">
        <label class="form-label">Vaksin</label>
        <div id="select-vaksin-container" style="display:none">
        <select id="select_vaksin" name="id_vaksin" class="form-select mb-2 select-search">
            <option value=""></option>
            @foreach($vaksins as $k)
                <option value="{{ $k->id_vaksin }}"
                    data-nama="{{ $k->nama_vaksin }}"
                    data-foto="{{ $k->foto_vaksin ?? '' }}"
                    {{ (old('id_vaksin',$jemaah->id_vaksin) == $k->id_vaksin) ? 'selected' : '' }}>
                    {{ $k->nama_vaksin }}
                </option>
            @endforeach
        </select>
        <div class="mb-2"><img id="vaksin_preview_img" src="{{ $jemaah->vaksin->foto_vaksin ?? '' }}" alt="Preview Vaksin" style="max-width:180px;{{ isset($jemaah->vaksin->foto_vaksin) ? '' : 'display:none' }};border:1px solid #ddd;padding:4px;border-radius:4px"></div>
        </div>
        <select id="vaksin_have" class="form-select">
            <option value="0" {{ $jemaah->id_vaksin? '': 'selected' }}>Belum punya</option>
            <option value="1" {{ $jemaah->id_vaksin? 'selected' : '' }}>Sudah punya / pilih</option>
        </select>
    </div>
    <div id="vaksin-section" style="display:{{ $jemaah->id_vaksin? 'block':'none' }}">
        <h6>Data Vaksin (isi jika ada)</h6>
        <div class="mb-3"><label class="form-label">Nama Vaksin</label><input name="vaksin_nama_vaksin" class="form-control" value="{{ old('vaksin_nama_vaksin', $jemaah->vaksin->nama_vaksin ?? '') }}"></div>
        <div class="mb-3"><label class="form-label">Foto Vaksin</label><input type="file" name="vaksin_foto_vaksin" class="form-control"></div>
    </div>

    <div><button class="btn btn-primary">Simpan</button> <a href="{{ route('admin.data-jemaah.index') }}" class="btn btn-secondary">Batal</a></div>
</form>
    <script>
    document.addEventListener('DOMContentLoaded', function(){
        function toggle(idToggle, idSection){
            const sel = document.getElementById(idToggle);
            const sec = document.getElementById(idSection);
            sel.addEventListener('change', function(){
                sec.style.display = this.value=='1' ? 'block' : 'none';
            });
        }
        toggle('passport_have','passport-section');
        toggle('visa_have','visa-section');
        toggle('vaksin_have','vaksin-section');
        // show parent KTP if age < 18
        function calcAge(val){
            if(!val) return null;
            const d = new Date(val);
            const t = new Date();
            let age = t.getFullYear() - d.getFullYear();
            const m = t.getMonth() - d.getMonth();
            if(m<0 || (m===0 && t.getDate()<d.getDate())) age--;
            return age;
        }
        const dob = document.getElementById('tgl_lahir');
        const parentSection = document.getElementById('parent-ktp-section');
        function checkParent(){
            const age = calcAge(dob.value);
            if(age!==null && age<18) parentSection.style.display='block'; else parentSection.style.display='none';
        }
        if(dob){ dob.addEventListener('change', checkParent); checkParent(); }
        // show buku nikah when status == Menikah
        const statusSel = document.getElementById('status_pernikahan');
        const bukuSection = document.getElementById('buku-nikah-section');
        function checkBuku(){ if(statusSel && bukuSection) bukuSection.style.display = statusSel.value=='Menikah' ? 'block' : 'none'; }
        if(statusSel){ statusSel.addEventListener('change', checkBuku); checkBuku(); }
        // Toggle select vs inline form for passport/visa/vaksin
        function toggleSelectHave(haveId, selectContainerId, inlineSectionId){
            const have = document.getElementById(haveId);
            const selc = document.getElementById(selectContainerId);
            const inline = document.getElementById(inlineSectionId);
            function apply(){
                if(have && have.value=='1'){
                    if(selc) selc.style.display='block';
                    if(inline) inline.style.display='block';
                } else {
                    if(selc) selc.style.display='none';
                    if(inline) inline.style.display='none';
                }
            }
            if(have){ have.addEventListener('change', apply); apply(); }
        }
        toggleSelectHave('passport_have','select-passport-container','passport-section');
        toggleSelectHave('visa_have','select-visa-container','visa-section');
        toggleSelectHave('vaksin_have','select-vaksin-container','vaksin-section');
        // initialize Select2 for searchable selects
        if(typeof $ !== 'undefined' && typeof $.fn.select2 !== 'undefined'){
            $('.select-search').select2({ width: '100%', placeholder: 'Cari & pilih...', allowClear: true });
        }
        // autofill inline fields when selecting existing records
        function fillPassportFieldsFromOption(opt){
            if(!opt) return;
            const dataset = opt.dataset || {};
            document.querySelector('input[name="passport_nomor_passport"]').value = dataset.nomor || '';
            document.querySelector('input[name="passport_nama_passport"]').value = dataset.nama || '';
            document.querySelector('input[name="passport_nama_tambahan"]').value = dataset['namaTambahan'] || dataset['nama-tambahan'] || dataset['nama_tambahan'] || '';
            document.querySelector('input[name="passport_tempat_lahir_pass"]').value = dataset['tempat_lahir'] || dataset['tempatLahir'] || dataset['tempat-lahir'] || '';
            document.querySelector('input[name="passport_tgl_lahir_pass"]').value = dataset['tglLahir'] || dataset['tgl-lahir'] || dataset['tgl_lahir'] || '';
            document.querySelector('input[name="passport_tempat_pembuatan"]').value = dataset['tempat_pembuatan'] || dataset['tempatPembuatan'] || '';
            document.querySelector('input[name="passport_tgl_pembuatan"]').value = dataset['tgl_pembuatan'] || dataset['tglPembuatan'] || '';
            document.querySelector('input[name="passport_exp_passport"]').value = dataset['exp'] || '';
            const statusSel = document.querySelector('select[name="passport_status_passport"]'); if(statusSel) statusSel.value = dataset['status'] || 'Aktif';
            const img = document.getElementById('passport_preview_img');
            const url = dataset.fotoIdentitas || dataset['foto-identitas'] || dataset['foto_identitas'] || '';
            if(img){ if(url){ img.src = url; img.style.display = 'inline-block'; } else { img.style.display='none'; img.src=''; } }
        }
        function fillVisaFieldsFromOption(opt){
            if(!opt) return;
            const d = opt.dataset || {};
            document.querySelector('input[name="visa_nama_visa"]').value = d.nama || '';
            document.querySelector('input[name="visa_nomor_visa"]').value = d.nomor || '';
            document.querySelector('input[name="visa_tgl_berlaku_visa"]').value = d['tglBerlaku'] || d['tgl-berlaku'] || d['tgl_berlaku'] || '';
            document.querySelector('input[name="visa_tgl_exp_visa"]').value = d['tglExp'] || d['tgl-exp'] || d['tgl_exp'] || '';
            const img = document.getElementById('visa_preview_img');
            const url = d.foto || d['foto'] || '';
            if(img){ if(url){ img.src = url; img.style.display = 'inline-block'; } else { img.style.display='none'; img.src=''; } }
        }
        function fillVaksinFieldsFromOption(opt){
            if(!opt) return;
            const d = opt.dataset || {};
            document.querySelector('input[name="vaksin_nama_vaksin"]').value = d.nama || '';
            const img = document.getElementById('vaksin_preview_img');
            const url = d.foto || d['foto'] || '';
            if(img){ if(url){ img.src = url; img.style.display = 'inline-block'; } else { img.style.display='none'; img.src=''; } }
        }
        const selPassport = document.getElementById('select_passport');
        if(selPassport){ selPassport.addEventListener('change', function(e){ const o = this.options[this.selectedIndex]; if(this.value) fillPassportFieldsFromOption(o); else { fillPassportFieldsFromOption({dataset:{}}); } }); if(selPassport.value){ fillPassportFieldsFromOption(selPassport.options[selPassport.selectedIndex]); } }
        const selVisa = document.getElementById('select_visa');
        if(selVisa){ selVisa.addEventListener('change', function(e){ const o = this.options[this.selectedIndex]; if(this.value) fillVisaFieldsFromOption(o); else { fillVisaFieldsFromOption({dataset:{}}); } }); if(selVisa.value){ fillVisaFieldsFromOption(selVisa.options[selVisa.selectedIndex]); } }
        const selVaksin = document.getElementById('select_vaksin');
        if(selVaksin){ selVaksin.addEventListener('change', function(e){ const o = this.options[this.selectedIndex]; if(this.value) fillVaksinFieldsFromOption(o); else { fillVaksinFieldsFromOption({dataset:{}}); } }); if(selVaksin.value){ fillVaksinFieldsFromOption(selVaksin.options[selVaksin.selectedIndex]); } }
    });
    </script>
@endsection
