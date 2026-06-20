<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataJemaah;

class DataJemaahController extends Controller
{
    public function index()
    {
        return response()->json(DataJemaah::all());
    }

    public function show($id)
    {
        return response()->json(DataJemaah::findOrFail($id));
    }

    public function store(Request $request)
    {
        $item = DataJemaah::create($request->only((new DataJemaah)->getFillable()));
        return response()->json($item, 201);
    }

    public function update(Request $request, $id)
    {
        $item = DataJemaah::findOrFail($id);
        $item->update($request->only((new DataJemaah)->getFillable()));
        return response()->json($item);
    }

    public function destroy($id)
    {
        DataJemaah::findOrFail($id)->delete();
        return response()->noContent();
    }
}
