<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogReservasi;

class LogReservasiController extends Controller
{
    public function index()
    {
        return response()->json(LogReservasi::with(['reservasi','admin'])->get());
    }

    public function show($id)
    {
        return response()->json(LogReservasi::with(['reservasi','admin'])->findOrFail($id));
    }

    public function store(Request $request)
    {
        $item = LogReservasi::create($request->only((new LogReservasi)->getFillable()));
        return response()->json($item, 201);
    }

    public function update(Request $request, $id)
    {
        $item = LogReservasi::findOrFail($id);
        $item->update($request->only((new LogReservasi)->getFillable()));
        return response()->json($item);
    }

    public function destroy($id)
    {
        LogReservasi::findOrFail($id)->delete();
        return response()->noContent();
    }
}
