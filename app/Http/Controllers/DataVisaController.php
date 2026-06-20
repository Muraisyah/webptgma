<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataVisa;

class DataVisaController extends Controller
{
    public function index()
    {
        return response()->json(DataVisa::all());
    }

    public function show($id)
    {
        return response()->json(DataVisa::findOrFail($id));
    }

    public function store(Request $request)
    {
        $item = DataVisa::create($request->only((new DataVisa)->getFillable()));
        return response()->json($item, 201);
    }

    public function update(Request $request, $id)
    {
        $item = DataVisa::findOrFail($id);
        $item->update($request->only((new DataVisa)->getFillable()));
        return response()->json($item);
    }

    public function destroy($id)
    {
        DataVisa::findOrFail($id)->delete();
        return response()->noContent();
    }
}
