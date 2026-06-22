<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenKeberangkatan;

class DokumenKeberangkatanController extends Controller
{
    public function index(Request $request)
    {
        $query = DokumenKeberangkatan::with('jemaah');
        if ($request->filled('q')) {
            $query->where('jenis_dokumen', 'like', '%'.$request->q.'%');
        }
        if ($request->filled('from')) {
            $query->where('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->where('created_at', '<=', $request->to);
        }
        if ($request->wantsJson()) {
            return response()->json($query->get());
        }
        $dokumens = $query->paginate(15)->appends($request->only(['q','from','to']));
        return view('admin.dokumen.index', compact('dokumens'));
    }

    public function create()
    {
        return view('admin.dokumen.create');
    }

    public function show($id)
    {
        return response()->json(DokumenKeberangkatan::findOrFail($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_jemaah' => 'required|integer',
            'jenis_dokumen' => 'nullable|string',
        ]);
        if ($request->hasFile('file_dokumen')) {
            $path = $request->file('file_dokumen')->store('uploads','public');
            $data['file_dokumen'] = '/storage/'.$path;
        }
        $item = DokumenKeberangkatan::create($data);
        return redirect()->route('admin.dokumen.index')->with('success','Dokumen disimpan.');
    }

    public function edit($id)
    {
        $dokumen = DokumenKeberangkatan::findOrFail($id);
        return view('admin.dokumen.edit', compact('dokumen'));
    }

    public function update(Request $request, $id)
    {
        $item = DokumenKeberangkatan::findOrFail($id);
        $data = $request->validate([
            'id_jemaah' => 'required|integer',
            'jenis_dokumen' => 'nullable|string',
        ]);
        if ($request->hasFile('file_dokumen')) {
            $path = $request->file('file_dokumen')->store('uploads','public');
            $data['file_dokumen'] = '/storage/'.$path;
        }
        $item->update($data);
        return redirect()->route('admin.dokumen.index')->with('success','Dokumen diperbarui.');
    }

    public function destroy($id)
    {
        DokumenKeberangkatan::findOrFail($id)->delete();
        return redirect()->route('admin.dokumen.index')->with('success','Dokumen dihapus.');
    }
}
