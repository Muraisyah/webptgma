<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json(Hotel::all());
        }
        return view('admin.hotel.index');
    }

    public function create()
    {
        return view('admin.hotel.create');
    }

    public function show($id)
    {
        return response()->json(Hotel::findOrFail($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_hotel' => 'required|string',
            'alamat_hotel' => 'nullable|string',
        ]);
        if ($request->hasFile('foto_hotel')) {
            $path = $request->file('foto_hotel')->store('uploads','public');
            $data['foto_hotel'] = '/storage/'.$path;
        }
        $hotel = Hotel::create($data);
        return redirect()->route('admin.hotel.index')->with('success','Hotel dibuat.');
    }

    public function edit($id)
    {
        $hotel = Hotel::findOrFail($id);
        return view('admin.hotel.edit', compact('hotel'));
    }

    public function update(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);
        $data = $request->validate([
            'nama_hotel' => 'required|string',
            'alamat_hotel' => 'nullable|string',
        ]);
        if ($request->hasFile('foto_hotel')) {
            $path = $request->file('foto_hotel')->store('uploads','public');
            $data['foto_hotel'] = '/storage/'.$path;
        }
        $hotel->update($data);
        return redirect()->route('admin.hotel.index')->with('success','Hotel diperbarui.');
    }

    public function destroy($id)
    {
        Hotel::findOrFail($id)->delete();
        return redirect()->route('admin.hotel.index')->with('success','Hotel dihapus.');
    }
}
