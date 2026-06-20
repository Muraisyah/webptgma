<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPassport;

class DataPassportController extends Controller
{
    public function index()
    {
        return response()->json(DataPassport::all());
    }

    public function show($id)
    {
        return response()->json(DataPassport::findOrFail($id));
    }

    public function store(Request $request)
    {
        $item = DataPassport::create($request->only((new DataPassport)->getFillable()));
        return response()->json($item, 201);
    }

    public function update(Request $request, $id)
    {
        $item = DataPassport::findOrFail($id);
        $item->update($request->only((new DataPassport)->getFillable()));
        return response()->json($item);
    }

    public function destroy($id)
    {
        DataPassport::findOrFail($id)->delete();
        return response()->noContent();
    }
}
