<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataJemaah;
use App\Models\DataPassport;
use App\Models\DataVisa;
use App\Models\DataVaksin;
use App\Models\User;

class DataJemaahController extends Controller
{
    public function index(Request $request)
    {
        $query = DataJemaah::with(['passport','visa','vaksin']);
        if ($request->filled('q')) {
            $query->where('nama_jemaah', 'like', '%'.$request->q.'%');
        }
        if ($request->filled('from')) {
            $query->where('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->where('created_at', '<=', $request->to);
        }
        $jemaahs = $query->paginate(15)->appends($request->only(['q','from','to']));
        return view('admin.data_jemaah.index', compact('jemaahs'));
    }

    public function show($id)
    {
        $jemaah = DataJemaah::with(['passport','visa','vaksin'])->findOrFail($id);
        return view('admin.data_jemaah.show', compact('jemaah'));
    }
    public function create()
    {
        $users = User::all();
        $passports = DataPassport::all();
        $visas = DataVisa::all();
        $vaksins = DataVaksin::all();
        return view('admin.data_jemaah.create', compact('users','passports','visas','vaksins'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_jemaah' => 'required|string|max:35',
            'tempat_lahir' => 'nullable|string|max:30',
            'tgl_lahir' => 'nullable|date',
            'nik' => 'nullable|digits:16',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
            'nama_ayah' => 'nullable|string|max:35',
            'status_pernikahan' => 'nullable|in:Menikah,Belum Menikah,Duda,Janda,Cerai Hidup',
            'kewarganegaraan' => 'nullable|string|max:30',
            'foto_ktp' => 'nullable|image|max:4096',
            'foto_kk' => 'nullable|image|max:4096',
            'foto_akte' => 'nullable|image|max:4096',
            'foto_buku_nikah' => 'nullable|image|max:4096',
            'foto_ktp_ayah' => 'nullable|image|max:4096',
            'foto_ktp_ibu' => 'nullable|image|max:4096',
            'id_passport' => 'nullable|integer|exists:data_passport,id_passport',
            'id_visa' => 'nullable|integer|exists:data_visa,id_visa',
            'id_vaksin' => 'nullable|integer|exists:data_vaksin,id_vaksin',
        ]);
        // set id_user automatically from authenticated user if available
        if (auth()->check()) {
            $data['id_user'] = auth()->user()->id_user;
        }
        // If user selected existing related records, use them; otherwise handle inline create
        if ($request->filled('id_passport')) {
            $data['id_passport'] = $request->input('id_passport');
        }
        if ($request->filled('id_visa')) {
            $data['id_visa'] = $request->input('id_visa');
        }
        if ($request->filled('id_vaksin')) {
            $data['id_vaksin'] = $request->input('id_vaksin');
        }

        // Inline create passport/visa/vaksin only when no existing id provided
        if (!$request->filled('id_passport') && ($request->filled('passport_nomor_passport') || $request->filled('passport_nama_passport'))) {
            $pd = $request->validate([
                'passport_nama_passport' => 'required_without:passport_nomor_passport|string|max:35',
                'passport_nama_tambahan' => 'nullable|string|max:35',
                'passport_nomor_passport' => 'required_without:passport_nama_passport|string|size:9',
                'passport_tempat_lahir_pass' => 'nullable|string|max:30',
                'passport_tgl_lahir_pass' => 'nullable|date',
                'passport_tempat_pembuatan' => 'nullable|string|max:30',
                'passport_tgl_pembuatan' => 'nullable|date',
                'passport_exp_passport' => 'nullable|date',
                'passport_foto_identitas_pass' => 'nullable|image|max:4096',
                'passport_foto_nama_tambahan' => 'nullable|image|max:4096',
                'passport_status_passport' => 'nullable|in:Aktif,Expired',
            ]);
            if ($request->hasFile('passport_foto_identitas_pass')){
                $p = $request->file('passport_foto_identitas_pass')->store('uploads','public');
                $pd['foto_identitas_pass'] = '/storage/'.$p;
            }
            if ($request->hasFile('passport_foto_nama_tambahan')){
                $p = $request->file('passport_foto_nama_tambahan')->store('uploads','public');
                $pd['foto_nama_tambahan'] = '/storage/'.$p;
            }
            $passport = DataPassport::create([
                'nama_passport' => $pd['passport_nama_passport'] ?? ($pd['passport_nama_tambahan'] ?? null),
                'nama_tambahan' => $pd['passport_nama_tambahan'] ?? null,
                'nomor_passport' => $pd['passport_nomor_passport'] ?? null,
                'tempat_lahir_pass' => $pd['passport_tempat_lahir_pass'] ?? null,
                'tgl_lahir_pass' => $pd['passport_tgl_lahir_pass'] ?? null,
                'tempat_pembuatan' => $pd['passport_tempat_pembuatan'] ?? null,
                'tgl_pembuatan' => $pd['passport_tgl_pembuatan'] ?? null,
                'exp_passport' => $pd['passport_exp_passport'] ?? null,
                'foto_identitas_pass' => $pd['foto_identitas_pass'] ?? null,
                'foto_nama_tambahan' => $pd['foto_nama_tambahan'] ?? null,
                'status_passport' => $pd['passport_status_passport'] ?? 'Aktif',
            ]);
            $data['id_passport'] = $passport->id_passport;
        }
        if (!$request->filled('id_visa') && ($request->filled('visa_nama_visa') || $request->filled('visa_nomor_visa'))){
            $vd = $request->validate([
                'visa_nama_visa' => 'required_without:visa_nomor_visa|string|max:35',
                'visa_nomor_visa' => 'nullable|string|max:15',
                'visa_tgl_berlaku_visa' => 'nullable|date',
                'visa_tgl_exp_visa' => 'nullable|date',
                'visa_foto_visa' => 'nullable|image|max:4096',
            ]);
            if ($request->hasFile('visa_foto_visa')){
                $p = $request->file('visa_foto_visa')->store('uploads','public');
                $vd['foto_visa'] = '/storage/'.$p;
            }
            $visa = DataVisa::create([
                'nama_visa' => $vd['visa_nama_visa'] ?? null,
                'nomor_visa' => $vd['visa_nomor_visa'] ?? null,
                'tgl_berlaku_visa' => $vd['visa_tgl_berlaku_visa'] ?? null,
                'tgl_exp_visa' => $vd['visa_tgl_exp_visa'] ?? null,
                'foto_visa' => $vd['foto_visa'] ?? null,
            ]);
            $data['id_visa'] = $visa->id_visa;
        }
        if (!$request->filled('id_vaksin') && $request->filled('vaksin_nama_vaksin')){
            $kd = $request->validate([
                'vaksin_nama_vaksin' => 'required|string|max:35',
                'vaksin_foto_vaksin' => 'nullable|image|max:4096',
            ]);
            if ($request->hasFile('vaksin_foto_vaksin')){
                $p = $request->file('vaksin_foto_vaksin')->store('uploads','public');
                $kd['foto_vaksin'] = '/storage/'.$p;
            }
            $vaksin = DataVaksin::create([
                'nama_vaksin' => $kd['vaksin_nama_vaksin'],
                'foto_vaksin' => $kd['foto_vaksin'] ?? null,
            ]);
            $data['id_vaksin'] = $vaksin->id_vaksin;
        }
        
        foreach(['foto_ktp','foto_kk','foto_akte','foto_buku_nikah','foto_ktp_ayah','foto_ktp_ibu'] as $f){
            if ($request->hasFile($f)){
                $p = $request->file($f)->store('uploads','public');
                $data[$f] = '/storage/'.$p;
            }
        }
        // If user selected existing related records, prefer those ids
        if ($request->filled('id_passport')) {
            $data['id_passport'] = $request->input('id_passport');
        }
        if ($request->filled('id_visa')) {
            $data['id_visa'] = $request->input('id_visa');
        }
        if ($request->filled('id_vaksin')) {
            $data['id_vaksin'] = $request->input('id_vaksin');
        }
        $item = DataJemaah::create($data);
        return redirect()->route('admin.data-jemaah.index')->with('success','Data jemaah dibuat');
    }

    public function edit($id)
    {
        $jemaah = DataJemaah::findOrFail($id);
        $users = User::all();
        $passports = DataPassport::all();
        $visas = DataVisa::all();
        $vaksins = DataVaksin::all();
        return view('admin.data_jemaah.edit', compact('jemaah','users','passports','visas','vaksins'));
    }

    public function update(Request $request, $id)
    {
        $item = DataJemaah::findOrFail($id);
        $data = $request->validate([
            'nama_jemaah' => 'required|string|max:35',
            'tempat_lahir' => 'nullable|string|max:30',
            'tgl_lahir' => 'nullable|date',
            'nik' => 'nullable|digits:16',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
            'nama_ayah' => 'nullable|string|max:35',
            'status_pernikahan' => 'nullable|in:Menikah,Belum Menikah,Duda,Janda,Cerai Hidup',
            'kewarganegaraan' => 'nullable|string|max:30',
            'foto_ktp' => 'nullable|image|max:4096',
            'foto_kk' => 'nullable|image|max:4096',
            'foto_akte' => 'nullable|image|max:4096',
            'foto_buku_nikah' => 'nullable|image|max:4096',
            'foto_ktp_ayah' => 'nullable|image|max:4096',
            'foto_ktp_ibu' => 'nullable|image|max:4096',
            'id_passport' => 'nullable|integer|exists:data_passport,id_passport',
            'id_visa' => 'nullable|integer|exists:data_visa,id_visa',
            'id_vaksin' => 'nullable|integer|exists:data_vaksin,id_vaksin',
        ]);
        foreach(['foto_ktp','foto_kk','foto_akte','foto_buku_nikah','foto_ktp_ayah','foto_ktp_ibu'] as $f){
            if ($request->hasFile($f)){
                $p = $request->file($f)->store('uploads','public');
                $data[$f] = '/storage/'.$p;
            }
        }
        // handle inline passport update/create only when no existing id selected
        if (!$request->filled('id_passport') && ($request->filled('passport_nomor_passport') || $request->filled('passport_nama_passport'))) {
            $pd = $request->validate([
                'passport_nama_passport' => 'required_without:passport_nomor_passport|string|max:35',
                'passport_nama_tambahan' => 'nullable|string|max:35',
                'passport_nomor_passport' => 'required_without:passport_nama_passport|string|size:9',
                'passport_tempat_lahir_pass' => 'nullable|string|max:30',
                'passport_tgl_lahir_pass' => 'nullable|date',
                'passport_tempat_pembuatan' => 'nullable|string|max:30',
                'passport_tgl_pembuatan' => 'nullable|date',
                'passport_exp_passport' => 'nullable|date',
                'passport_foto_identitas_pass' => 'nullable|image|max:4096',
                'passport_foto_nama_tambahan' => 'nullable|image|max:4096',
                'passport_status_passport' => 'nullable|in:Aktif,Expired',
            ]);
            if ($request->hasFile('passport_foto_identitas_pass')){
                $p = $request->file('passport_foto_identitas_pass')->store('uploads','public');
                $pd['foto_identitas_pass'] = '/storage/'.$p;
            }
            if ($request->hasFile('passport_foto_nama_tambahan')){
                $p = $request->file('passport_foto_nama_tambahan')->store('uploads','public');
                $pd['foto_nama_tambahan'] = '/storage/'.$p;
            }
            if ($item->id_passport) {
                $passport = DataPassport::find($item->id_passport);
                if ($passport) {
                    $passport->update([
                        'nama_passport' => $pd['passport_nama_passport'] ?? ($pd['passport_nama_tambahan'] ?? null),
                        'nama_tambahan' => $pd['passport_nama_tambahan'] ?? null,
                        'nomor_passport' => $pd['passport_nomor_passport'] ?? null,
                        'tempat_lahir_pass' => $pd['passport_tempat_lahir_pass'] ?? null,
                        'tgl_lahir_pass' => $pd['passport_tgl_lahir_pass'] ?? null,
                        'tempat_pembuatan' => $pd['passport_tempat_pembuatan'] ?? null,
                        'tgl_pembuatan' => $pd['passport_tgl_pembuatan'] ?? null,
                        'exp_passport' => $pd['passport_exp_passport'] ?? null,
                        'foto_identitas_pass' => $pd['foto_identitas_pass'] ?? $passport->foto_identitas_pass,
                        'foto_nama_tambahan' => $pd['foto_nama_tambahan'] ?? $passport->foto_nama_tambahan,
                        'status_passport' => $pd['passport_status_passport'] ?? $passport->status_passport,
                    ]);
                } else {
                    $new = DataPassport::create([
                        'nama_passport' => $pd['passport_nama_passport'] ?? ($pd['passport_nama_tambahan'] ?? null),
                        'nama_tambahan' => $pd['passport_nama_tambahan'] ?? null,
                        'nomor_passport' => $pd['passport_nomor_passport'] ?? null,
                        'tempat_lahir_pass' => $pd['passport_tempat_lahir_pass'] ?? null,
                        'tgl_lahir_pass' => $pd['passport_tgl_lahir_pass'] ?? null,
                        'tempat_pembuatan' => $pd['passport_tempat_pembuatan'] ?? null,
                        'tgl_pembuatan' => $pd['passport_tgl_pembuatan'] ?? null,
                        'exp_passport' => $pd['passport_exp_passport'] ?? null,
                        'foto_identitas_pass' => $pd['foto_identitas_pass'] ?? null,
                        'foto_nama_tambahan' => $pd['foto_nama_tambahan'] ?? null,
                        'status_passport' => $pd['passport_status_passport'] ?? 'Aktif',
                    ]);
                    $data['id_passport'] = $new->id_passport;
                }
            } else {
                $new = DataPassport::create([
                    'nama_passport' => $pd['passport_nama_passport'] ?? ($pd['passport_nama_tambahan'] ?? null),
                    'nama_tambahan' => $pd['passport_nama_tambahan'] ?? null,
                    'nomor_passport' => $pd['passport_nomor_passport'] ?? null,
                    'tempat_lahir_pass' => $pd['passport_tempat_lahir_pass'] ?? null,
                    'tgl_lahir_pass' => $pd['passport_tgl_lahir_pass'] ?? null,
                    'tempat_pembuatan' => $pd['passport_tempat_pembuatan'] ?? null,
                    'tgl_pembuatan' => $pd['passport_tgl_pembuatan'] ?? null,
                    'exp_passport' => $pd['passport_exp_passport'] ?? null,
                    'foto_identitas_pass' => $pd['foto_identitas_pass'] ?? null,
                    'foto_nama_tambahan' => $pd['foto_nama_tambahan'] ?? null,
                    'status_passport' => $pd['passport_status_passport'] ?? 'Aktif',
                ]);
                $data['id_passport'] = $new->id_passport;
            }
        }
        // handle inline visa update/create only when no existing id selected
        if (!$request->filled('id_visa') && ($request->filled('visa_nama_visa') || $request->filled('visa_nomor_visa'))){
            $vd = $request->validate([
                'visa_nama_visa' => 'required_without:visa_nomor_visa|string|max:35',
                'visa_nomor_visa' => 'nullable|string|max:15',
                'visa_tgl_berlaku_visa' => 'nullable|date',
                'visa_tgl_exp_visa' => 'nullable|date',
                'visa_foto_visa' => 'nullable|image|max:4096',
            ]);
            if ($request->hasFile('visa_foto_visa')){
                $p = $request->file('visa_foto_visa')->store('uploads','public');
                $vd['foto_visa'] = '/storage/'.$p;
            }
            if ($item->id_visa) {
                $visa = DataVisa::find($item->id_visa);
                if ($visa) {
                    $visa->update([
                        'nama_visa' => $vd['visa_nama_visa'] ?? $visa->nama_visa,
                        'nomor_visa' => $vd['visa_nomor_visa'] ?? $visa->nomor_visa,
                        'tgl_berlaku_visa' => $vd['visa_tgl_berlaku_visa'] ?? $visa->tgl_berlaku_visa,
                        'tgl_exp_visa' => $vd['visa_tgl_exp_visa'] ?? $visa->tgl_exp_visa,
                        'foto_visa' => $vd['foto_visa'] ?? $visa->foto_visa,
                    ]);
                } else {
                    $new = DataVisa::create([
                        'nama_visa' => $vd['visa_nama_visa'] ?? null,
                        'nomor_visa' => $vd['visa_nomor_visa'] ?? null,
                        'tgl_berlaku_visa' => $vd['visa_tgl_berlaku_visa'] ?? null,
                        'tgl_exp_visa' => $vd['visa_tgl_exp_visa'] ?? null,
                        'foto_visa' => $vd['foto_visa'] ?? null,
                    ]);
                    $data['id_visa'] = $new->id_visa;
                }
            } else {
                $new = DataVisa::create([
                    'nama_visa' => $vd['visa_nama_visa'] ?? null,
                    'nomor_visa' => $vd['visa_nomor_visa'] ?? null,
                    'tgl_berlaku_visa' => $vd['visa_tgl_berlaku_visa'] ?? null,
                    'tgl_exp_visa' => $vd['visa_tgl_exp_visa'] ?? null,
                    'foto_visa' => $vd['foto_visa'] ?? null,
                ]);
                $data['id_visa'] = $new->id_visa;
            }
        }
        // handle inline vaksin update/create only when no existing id selected
        if (!$request->filled('id_vaksin') && $request->filled('vaksin_nama_vaksin')){
            $kd = $request->validate([
                'vaksin_nama_vaksin' => 'required|string|max:35',
                'vaksin_foto_vaksin' => 'nullable|image|max:4096',
            ]);
            if ($request->hasFile('vaksin_foto_vaksin')){
                $p = $request->file('vaksin_foto_vaksin')->store('uploads','public');
                $kd['foto_vaksin'] = '/storage/'.$p;
            }
            if ($item->id_vaksin) {
                $vak = DataVaksin::find($item->id_vaksin);
                if ($vak) {
                    $vak->update([
                        'nama_vaksin' => $kd['vaksin_nama_vaksin'] ?? $vak->nama_vaksin,
                        'foto_vaksin' => $kd['foto_vaksin'] ?? $vak->foto_vaksin,
                    ]);
                } else {
                    $new = DataVaksin::create([
                        'nama_vaksin' => $kd['vaksin_nama_vaksin'],
                        'foto_vaksin' => $kd['foto_vaksin'] ?? null,
                    ]);
                    $data['id_vaksin'] = $new->id_vaksin;
                }
            } else {
                $new = DataVaksin::create([
                    'nama_vaksin' => $kd['vaksin_nama_vaksin'],
                    'foto_vaksin' => $kd['foto_vaksin'] ?? null,
                ]);
                $data['id_vaksin'] = $new->id_vaksin;
            }
        }

        $item->update($data);
        return redirect()->route('admin.data-jemaah.index')->with('success','Data jemaah diperbarui');
    }

    public function destroy($id)
    {
        DataJemaah::findOrFail($id)->delete();
        return redirect()->route('admin.data-jemaah.index')->with('success','Data jemaah dihapus');
    }
}
