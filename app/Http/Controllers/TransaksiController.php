<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::with(['reservasi','rekening','admin']);
        if ($request->filled('q')) {
            $query->where('kode_transaksi', 'like', '%'.$request->q.'%');
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
        $transaksis = $query->paginate(15)->appends($request->only(['q','from','to']));
        return view('admin.transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        return view('admin.transaksi.create');
    }

    public function show($id)
    {
        return response()->json(Transaksi::with(['reservasi','rekening','admin'])->findOrFail($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_reservasi' => 'required|integer',
            'id_rekening' => 'nullable|integer',
            'nominal_bayar' => 'nullable|numeric',
            'status_verifikasi' => 'nullable|string',
        ]);
        $item = Transaksi::create($data);
        return redirect()->route('admin.transaksi.index')->with('success','Transaksi disimpan.');
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('admin.transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {
        $item = Transaksi::findOrFail($id);
        $data = $request->validate([
            'nominal_bayar' => 'nullable|numeric',
            'status_verifikasi' => 'nullable|string',
        ]);
        $item->update($data);
        return redirect()->route('admin.transaksi.index')->with('success','Transaksi diperbarui.');
    }

    public function destroy($id)
    {
        Transaksi::findOrFail($id)->delete();
        return redirect()->route('admin.transaksi.index')->with('success','Transaksi dihapus.');
    }
}
