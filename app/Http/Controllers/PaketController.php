<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Paket;

class PaketController extends Controller
{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json(Paket::with('hotels')->get());
        }
        return view('admin.paket.index');
    }

    public function create()
    {
        return view('admin.paket.create');
    }

    public function show($id)
    {
        $paket = Paket::with('hotels')->findOrFail($id);
        if(request()->wantsJson()){
            return response()->json($paket);
        }
        return view('admin.paket.show', compact('paket'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_paket' => 'required|string',
            'durasi_perjalanan' => 'nullable|integer',
            'tgl_keberangkatan' => 'nullable|date',
            'tgl_kepulangan' => 'nullable|date',
            'kuota_paket' => 'nullable|integer',
            'seat_tersedia' => 'nullable|integer',
            'harga_paket' => 'nullable|numeric',
            'maskapai' => 'nullable|string',
            'id_hotel' => 'nullable|array',
            'id_hotel.*' => 'integer|exists:hotel,id_hotel',
            'deskripsi' => 'nullable|string',
            'status_paket' => 'nullable|in:Aktif,Nonaktif',
        ]);
        if ($request->hasFile('foto_paket')) {
            $path = $request->file('foto_paket')->store('uploads','public');
            $data['foto_paket'] = '/storage/'.$path;
        }
        $paket = Paket::create(Arr::except($data,['id_hotel']));
        if(isset($data['id_hotel'])){
            $paket->hotels()->sync($data['id_hotel']);
        }
        return redirect()->route('admin.paket.index')->with('success','Paket dibuat.');
    }

    public function edit($id)
    {
        $paket = Paket::findOrFail($id);
        return view('admin.paket.edit', compact('paket'));
    }

    public function update(Request $request, $id)
    {
        $paket = Paket::findOrFail($id);
        $data = $request->validate([
            'nama_paket' => 'required|string',
            'durasi_perjalanan' => 'nullable|integer',
            'tgl_keberangkatan' => 'nullable|date',
            'tgl_kepulangan' => 'nullable|date',
            'kuota_paket' => 'nullable|integer',
            'seat_tersedia' => 'nullable|integer',
            'harga_paket' => 'nullable|numeric',
            'maskapai' => 'nullable|string',
            'id_hotel' => 'nullable|array',
            'id_hotel.*' => 'integer|exists:hotel,id_hotel',
            'deskripsi' => 'nullable|string',
            'status_paket' => 'nullable|in:Aktif,Nonaktif',
        ]);
        if ($request->hasFile('foto_paket')) {
            $path = $request->file('foto_paket')->store('uploads','public');
            $data['foto_paket'] = '/storage/'.$path;
        }
        $paket->update(Arr::except($data,['id_hotel']));
        if(isset($data['id_hotel'])){
            $paket->hotels()->sync($data['id_hotel']);
        }
        return redirect()->route('admin.paket.index')->with('success','Paket diperbarui.');
    }

    public function destroy($id)
    {
        Paket::findOrFail($id)->delete();
        return redirect()->route('admin.paket.index')->with('success','Paket dihapus.');
    }
}
