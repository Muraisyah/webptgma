<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json(Galeri::all());
        }
        return view('admin.galeri.index');
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function show($id)
    {
        return response()->json(Galeri::findOrFail($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul_foto' => 'required|string',
            'deskripsi_foto' => 'nullable|string',
        ]);
        if ($request->hasFile('foto_jemaah_file')) {
            $path = $request->file('foto_jemaah_file')->store('uploads','public');
            $data['foto_jemaah'] = '/storage/'.$path;
        }
        $item = Galeri::create($data);
        return redirect()->route('admin.galeri.index')->with('success','Foto ditambahkan.');
    }

    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, $id)
    {
        $item = Galeri::findOrFail($id);
        $data = $request->validate([
            'judul_foto' => 'required|string',
            'deskripsi_foto' => 'nullable|string',
        ]);
        if ($request->hasFile('foto_jemaah_file')) {
            $path = $request->file('foto_jemaah_file')->store('uploads','public');
            $data['foto_jemaah'] = '/storage/'.$path;
        }
        $item->update($data);
        return redirect()->route('admin.galeri.index')->with('success','Galeri diperbarui.');
    }

    public function destroy($id)
    {
        Galeri::findOrFail($id)->delete();
        return redirect()->route('admin.galeri.index')->with('success','Galeri dihapus.');
    }
}
