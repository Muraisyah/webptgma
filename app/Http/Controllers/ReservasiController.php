<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;

class ReservasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservasi::with(['user','paket']);
        if ($request->filled('q')) {
            $query->where('kode_reservasi', 'like', '%'.$request->q.'%')
                  ->orWhereHas('user', function($u) use ($request) {
                      $u->where('username', 'like', '%'.$request->q.'%');
                  });
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
        $reservasis = $query->paginate(15)->appends($request->only(['q','from','to']));
        return view('admin.reservasi.index', compact('reservasis'));
    }

    public function create()
    {
        return view('admin.reservasi.create');
    }

    public function show($id)
    {
        return response()->json(Reservasi::with(['user','paket'])->findOrFail($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user' => 'required|integer',
            'id_paket' => 'required|integer',
            'jumlah_jemaah' => 'nullable|integer',
            'total_biaya' => 'nullable|numeric',
        ]);
        $item = Reservasi::create($data);
        return redirect()->route('admin.reservasi.index')->with('success','Reservasi dibuat.');
    }

    public function edit($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        return view('admin.reservasi.edit', compact('reservasi'));
    }

    public function update(Request $request, $id)
    {
        $item = Reservasi::findOrFail($id);
        $data = $request->validate([
            'jumlah_jemaah' => 'nullable|integer',
            'status_reservasi' => 'nullable|string',
        ]);
        $item->update($data);
        return redirect()->route('admin.reservasi.index')->with('success','Reservasi diperbarui.');
    }

    public function destroy($id)
    {
        Reservasi::findOrFail($id)->delete();
        return redirect()->route('admin.reservasi.index')->with('success','Reservasi dihapus.');
    }
}
