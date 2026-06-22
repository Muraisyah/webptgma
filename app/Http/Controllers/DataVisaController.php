<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataVisa;

class DataVisaController extends Controller
{
    public function index(Request $request)
    {
        $query = DataVisa::query();
        if ($request->filled('q')) {
            $query->where('nama_visa', 'like', '%'.$request->q.'%');
        }
        if ($request->filled('from')) {
            $query->where('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->where('created_at', '<=', $request->to);
        }
        $visas = $query->paginate(15)->appends($request->only(['q','from','to']));
        return view('admin.data_visa.index', compact('visas'));
    }

    public function show($id)
    {
        $visa = DataVisa::findOrFail($id);
        return view('admin.data_visa.show', compact('visa'));
    }

    public function create()
    {
        return view('admin.data_visa.create');
    }

    public function edit($id)
    {
        $visa = DataVisa::findOrFail($id);
        return view('admin.data_visa.edit', compact('visa'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_visa' => 'required|string|max:35',
            'nomor_visa' => 'nullable|string|max:15',
            'tgl_berlaku_visa' => 'nullable|date',
            'tgl_exp_visa' => 'nullable|date',
            'foto_visa' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('foto_visa')){
            $path = $request->file('foto_visa')->store('uploads','public');
            $data['foto_visa'] = '/storage/'.$path;
        }
        $item = DataVisa::create($data);
        return redirect()->route('admin.data-visa.index')->with('success','Data visa dibuat');
    }

    public function update(Request $request, $id)
    {
        $item = DataVisa::findOrFail($id);
        $data = $request->validate([
            'nama_visa' => 'required|string|max:35',
            'nomor_visa' => 'nullable|string|max:15',
            'tgl_berlaku_visa' => 'nullable|date',
            'tgl_exp_visa' => 'nullable|date',
            'foto_visa' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('foto_visa')){
            $path = $request->file('foto_visa')->store('uploads','public');
            $data['foto_visa'] = '/storage/'.$path;
        }
        $item->update($data);
        return redirect()->route('admin.data-visa.index')->with('success','Data visa diperbarui');
    }

    public function destroy($id)
    {
        DataVisa::findOrFail($id)->delete();
        return redirect()->route('admin.data-visa.index')->with('success','Data visa dihapus');
    }
}
