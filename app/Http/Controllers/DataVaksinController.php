<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataVaksin;

class DataVaksinController extends Controller
{
    public function index(Request $request)
    {
        $query = DataVaksin::query();
        if ($request->filled('q')) {
            $query->where('nama_vaksin', 'like', '%'.$request->q.'%');
        }
        if ($request->filled('from')) {
            $query->where('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->where('created_at', '<=', $request->to);
        }
        $vaksins = $query->paginate(15)->appends($request->only(['q','from','to']));
        return view('admin.data_vaksin.index', compact('vaksins'));
    }

    public function show($id)
    {
        $vaksin = DataVaksin::findOrFail($id);
        return view('admin.data_vaksin.show', compact('vaksin'));
    }

    public function create()
    {
        return view('admin.data_vaksin.create');
    }

    public function edit($id)
    {
        $vaksin = DataVaksin::findOrFail($id);
        return view('admin.data_vaksin.edit', compact('vaksin'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_vaksin' => 'required|string|max:35',
            'foto_vaksin' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('foto_vaksin')){
            $path = $request->file('foto_vaksin')->store('uploads','public');
            $data['foto_vaksin'] = '/storage/'.$path;
        }
        $item = DataVaksin::create($data);
        return redirect()->route('admin.data-vaksin.index')->with('success','Data vaksin dibuat');
    }

    public function update(Request $request, $id)
    {
        $item = DataVaksin::findOrFail($id);
        $data = $request->validate([
            'nama_vaksin' => 'required|string|max:35',
            'foto_vaksin' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('foto_vaksin')){
            $path = $request->file('foto_vaksin')->store('uploads','public');
            $data['foto_vaksin'] = '/storage/'.$path;
        }
        $item->update($data);
        return redirect()->route('admin.data-vaksin.index')->with('success','Data vaksin diperbarui');
    }

    public function destroy($id)
    {
        DataVaksin::findOrFail($id)->delete();
        return redirect()->route('admin.data-vaksin.index')->with('success','Data vaksin dihapus');
    }
}
