<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rekening;

class RekeningController extends Controller
{
    public function index(Request $request)
    {
        $query = Rekening::query();
        if ($request->filled('q')) {
            $query->where('nama_bank', 'like', '%'.$request->q.'%')->orWhere('nomor_rekening','like','%'.$request->q.'%');
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
        $rekenings = $query->paginate(15)->appends($request->only(['q','from','to']));
        return view('admin.rekening.index', compact('rekenings'));
    }

    public function create()
    {
        return view('admin.rekening.create');
    }

    public function show($id)
    {
        return response()->json(Rekening::findOrFail($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_bank' => 'required|string',
            'nomor_rekening' => 'required|string',
            'atas_nama' => 'required|string',
            'status' => 'nullable|string'
        ]);
        $rekening = Rekening::create($data);
        return redirect()->route('admin.rekening.index')->with('success','Rekening berhasil dibuat.');
    }

    public function edit($id)
    {
        $rekening = Rekening::findOrFail($id);
        return view('admin.rekening.edit', compact('rekening'));
    }

    public function update(Request $request, $id)
    {
        $rekening = Rekening::findOrFail($id);
        $data = $request->validate([
            'nama_bank' => 'required|string',
            'nomor_rekening' => 'required|string',
            'atas_nama' => 'required|string',
            'status' => 'nullable|string'
        ]);
        $rekening->update($data);
        return redirect()->route('admin.rekening.index')->with('success','Rekening diperbarui.');
    }

    public function destroy($id)
    {
        Rekening::findOrFail($id)->delete();
        return redirect()->route('admin.rekening.index')->with('success','Rekening dihapus.');
    }
}
