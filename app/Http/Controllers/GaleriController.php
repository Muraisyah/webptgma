<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $query = Galeri::query();
        if ($request->filled('q')) {
            $query->where('judul_foto', 'like', '%'.$request->q.'%');
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
        $galeris = $query->paginate(12)->appends($request->only(['q','from','to']));
        return view('admin.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function show($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('admin.galeri.show', compact('galeri'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul_foto' => 'required|string',
            'deskripsi_foto' => 'nullable|string',
        ]);
        // accept direct URL or uploaded file
        if ($request->filled('foto_jemaah_url')) {
            $data['foto_jemaah'] = $request->input('foto_jemaah_url');
        } elseif ($request->hasFile('foto_jemaah_file')) {
            $path = $request->file('foto_jemaah_file')->store('uploads','public');
            $data['foto_jemaah'] = '/storage/'.$path;
        }
        // set uploader user id (required by DB)
        $data['id_user'] = auth()->user()->id_user ?? auth()->id();
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
        if ($request->filled('foto_jemaah_url')) {
            $data['foto_jemaah'] = $request->input('foto_jemaah_url');
        } elseif ($request->hasFile('foto_jemaah_file')) {
            $path = $request->file('foto_jemaah_file')->store('uploads','public');
            $data['foto_jemaah'] = '/storage/'.$path;
        }
        // ensure id_user remains set (keep existing uploader if not set)
        if (!isset($data['id_user'])) {
            $data['id_user'] = $item->id_user ?? (auth()->user()->id_user ?? auth()->id());
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
