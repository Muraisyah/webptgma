<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataVaksin;

class DataVaksinController extends Controller
{
    public function index()
    {
        return response()->json(DataVaksin::all());
    }

    public function show($id)
    {
        return response()->json(DataVaksin::findOrFail($id));
    }

    public function store(Request $request)
    {
        $item = DataVaksin::create($request->only((new DataVaksin)->getFillable()));
        return response()->json($item, 201);
    }

    public function update(Request $request, $id)
    {
        $item = DataVaksin::findOrFail($id);
        $item->update($request->only((new DataVaksin)->getFillable()));
        return response()->json($item);
    }

    public function destroy($id)
    {
        DataVaksin::findOrFail($id)->delete();
        return response()->noContent();
    }
}
