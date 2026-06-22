<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;

class FrontendPaketController extends Controller
{
    public function index(Request $request)
    {
        $query = Paket::query();
        if ($request->filled('q')) {
            $query->where('nama_paket', 'like', '%'.$request->q.'%');
        }
        $pakets = $query->latest()->paginate(9)->appends($request->only('q'));
        return view('paket.index', compact('pakets'));
    }

    public function show($id)
    {
        $paket = Paket::findOrFail($id);
        return view('paket.show', compact('paket'));
    }
}
