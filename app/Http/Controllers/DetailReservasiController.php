<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailReservasi;

class DetailReservasiController extends Controller
{
    public function index()
    {
        return response()->json(DetailReservasi::with(['reservasi','jemaah'])->get());
    }

    public function show($id)
    {
        return response()->json(DetailReservasi::with(['reservasi','jemaah'])->findOrFail($id));
    }

    public function store(Request $request)
    {
        $item = DetailReservasi::create($request->only((new DetailReservasi)->getFillable()));
        return response()->json($item, 201);
    }

    public function update(Request $request, $id)
    {
        $item = DetailReservasi::findOrFail($id);
        $item->update($request->only((new DetailReservasi)->getFillable()));
        return response()->json($item);
    }

    public function destroy($id)
    {
        DetailReservasi::findOrFail($id)->delete();
        return response()->noContent();
    }
}
