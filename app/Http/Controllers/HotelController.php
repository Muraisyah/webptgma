<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $query = Hotel::query();
        if ($request->filled('q')) {
            $query->where('nama_hotel', 'like', '%'.$request->q.'%');
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
        $hotels = $query->paginate(15)->appends($request->only(['q','from','to']));
        return view('admin.hotel.index', compact('hotels'));
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
            'nama_hotel' => 'required|string|max:50',
            'kota' => 'required|string|max:30',
            'kategori_hotel' => 'nullable|string|max:15',
        ]);
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
            'nama_hotel' => 'required|string|max:50',
            'kota' => 'required|string|max:30',
            'kategori_hotel' => 'nullable|string|max:15',
        ]);
        $hotel->update($data);
        return redirect()->route('admin.hotel.index')->with('success','Hotel diperbarui.');
    }

    public function destroy($id)
    {
        Hotel::findOrFail($id)->delete();
        return redirect()->route('admin.hotel.index')->with('success','Hotel dihapus.');
    }
}
