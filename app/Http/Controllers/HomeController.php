<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Galeri;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 6 paket terbaru
        $pakets = Paket::latest()->limit(6)->get();
        
        // Ambil 6 galeri terbaru dengan relasi user
        $galeris = Galeri::with('user')->latest()->limit(6)->get();
        
        return view('home', compact('pakets', 'galeris'));
    }
}
