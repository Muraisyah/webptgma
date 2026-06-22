<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;

class FrontendGaleriController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');
        $dateFrom = $request->query('date_from');
        $dateTo = $request->query('date_to');

        $query = Galeri::with('user')->latest();

        if ($q) {
            $query->where(function($r) use ($q) {
                $r->where('judul_foto', 'like', "%{$q}%")
                  ->orWhere('deskripsi_foto', 'like', "%{$q}%");
            });
        }

        if ($dateFrom) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }
        if ($dateTo) {
            $query->whereDate('created_at', '<=', $dateTo);
        }

        $galeris = $query->paginate(12)->appends($request->query());

        return view('galeri.index', compact('galeris','q','dateFrom','dateTo'));
    }
}
