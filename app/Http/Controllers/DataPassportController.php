<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPassport;

class DataPassportController extends Controller
{
    public function index(Request $request)
    {
        $query = DataPassport::query();
        if ($request->filled('q')) {
            $query->where('nama_passport', 'like', '%'.$request->q.'%');
        }
        if ($request->filled('from')) {
            $query->where('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->where('created_at', '<=', $request->to);
        }
        $passports = $query->paginate(15)->appends($request->only(['q','from','to']));
        return view('admin.data_passport.index', compact('passports'));
    }

    public function show($id)
    {
        $passport = DataPassport::findOrFail($id);
        return view('admin.data_passport.show', compact('passport'));
    }

    public function create()
    {
        return view('admin.data_passport.create');
    }

    public function edit($id)
    {
        $passport = DataPassport::findOrFail($id);
        return view('admin.data_passport.edit', compact('passport'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_passport' => 'required|string|max:35',
            'nama_tambahan' => 'nullable|string|max:35',
            'nomor_passport' => 'required|string|size:9',
            'tempat_lahir_pass' => 'nullable|string|max:30',
            'tgl_lahir_pass' => 'nullable|date',
            'tempat_pembuatan' => 'nullable|string|max:30',
            'tgl_pembuatan' => 'nullable|date',
            'exp_passport' => 'nullable|date',
            'foto_identitas_pass' => 'nullable|image|max:2048',
            'foto_nama_tambahan' => 'nullable|image|max:2048',
            'status_passport' => 'required|in:Aktif,Expired',
        ]);
        if ($request->hasFile('foto_identitas_pass')){
            $path = $request->file('foto_identitas_pass')->store('uploads','public');
            $data['foto_identitas_pass'] = '/storage/'.$path;
        }
        if ($request->hasFile('foto_nama_tambahan')){
            $path = $request->file('foto_nama_tambahan')->store('uploads','public');
            $data['foto_nama_tambahan'] = '/storage/'.$path;
        }
        $item = DataPassport::create($data);
        return redirect()->route('admin.data-passport.index')->with('success','Data passport dibuat');
    }

    public function update(Request $request, $id)
    {
        $item = DataPassport::findOrFail($id);
        $data = $request->validate([
            'nama_passport' => 'required|string|max:35',
            'nama_tambahan' => 'nullable|string|max:35',
            'nomor_passport' => 'required|string|size:9',
            'tempat_lahir_pass' => 'nullable|string|max:30',
            'tgl_lahir_pass' => 'nullable|date',
            'tempat_pembuatan' => 'nullable|string|max:30',
            'tgl_pembuatan' => 'nullable|date',
            'exp_passport' => 'nullable|date',
            'foto_identitas_pass' => 'nullable|image|max:2048',
            'foto_nama_tambahan' => 'nullable|image|max:2048',
            'status_passport' => 'required|in:Aktif,Expired',
        ]);
        if ($request->hasFile('foto_identitas_pass')){
            $path = $request->file('foto_identitas_pass')->store('uploads','public');
            $data['foto_identitas_pass'] = '/storage/'.$path;
        }
        if ($request->hasFile('foto_nama_tambahan')){
            $path = $request->file('foto_nama_tambahan')->store('uploads','public');
            $data['foto_nama_tambahan'] = '/storage/'.$path;
        }
        $item->update($data);
        return redirect()->route('admin.data-passport.index')->with('success','Data passport diperbarui');
    }

    public function destroy($id)
    {
        DataPassport::findOrFail($id)->delete();
        return redirect()->route('admin.data-passport.index')->with('success','Data passport dihapus');
    }
}
