<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json(Transaksi::with(['reservasi','rekening','admin'])->get());
        }
        return view('admin.transaksi.index');
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
