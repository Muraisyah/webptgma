<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// (Public gallery route removed) Galeri CRUD is managed under /admin/galeri only

use App\Http\Controllers\AuthController;
use App\Models\Transaksi;
use App\Models\Paket;
use App\Models\Reservasi;
use App\Models\User;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public registration for Jemaah
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

Route::get('/register-jemaah', function(){
    return view('auth.register_jemaah');
})->name('register.jemaah');

Route::post('/register-jemaah', function(Request $request){
    $data = $request->validate([
        'nama_lengkap' => 'required|string|max:35',
        'email' => 'required|email|unique:user,email',
        'username' => 'required|string|unique:user,username',
        'no_hp' => 'nullable|string|max:20',
        'password' => 'required|string|min:6|confirmed',
    ]);
    $data['password'] = Hash::make($data['password']);
    $data['role'] = 'Jemaah';
    $user = User::create($data);
    return redirect()->route('login')->with('success','Akun Jemaah berhasil dibuat. Silakan login.');
})->name('register.jemaah.store');

// Public paket routes (list and detail)
Route::get('/paket', [App\Http\Controllers\FrontendPaketController::class, 'index'])->name('paket.index');
Route::get('/paket/{id}', [App\Http\Controllers\FrontendPaketController::class, 'show'])->name('paket.show');

// Frontend galeri (public)
Route::get('/galeri', [App\Http\Controllers\FrontendGaleriController::class, 'index'])->name('galeri.index');

Route::middleware(['auth','role:Admin'])->prefix('admin')->group(function(){
    Route::get('/dashboard', function(){
        $transaksiCount = Transaksi::count();
        $pendapatanHari = Transaksi::whereDate('created_at', now()->toDateString())->sum('nominal_bayar');
        $pendapatanBulan = Transaksi::whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->sum('nominal_bayar');
        $pendapatanTahun = Transaksi::whereYear('created_at', now()->year)->sum('nominal_bayar');
        $paketCount = Paket::count();
        $reservasiCount = Reservasi::count();
        $userCount = User::count();
        $pendingTransaksi = Transaksi::where('status_verifikasi','pending')->count();
        return view('admin.dashboard', compact('transaksiCount','pendapatanHari','pendapatanBulan','pendapatanTahun','paketCount','reservasiCount','userCount','pendingTransaksi'));
    })->name('admin.dashboard');
    // Resource routes for admin management
    Route::resource('users', App\Http\Controllers\UserController::class, ['as'=>'admin']);
    Route::resource('paket', App\Http\Controllers\PaketController::class, ['as'=>'admin']);
    Route::resource('hotel', App\Http\Controllers\HotelController::class, ['as'=>'admin']);
    Route::resource('rekening', App\Http\Controllers\RekeningController::class, ['as'=>'admin']);
    Route::resource('reservasi', App\Http\Controllers\ReservasiController::class, ['as'=>'admin']);
    Route::resource('transaksi', App\Http\Controllers\TransaksiController::class, ['as'=>'admin']);
    Route::resource('galeri', App\Http\Controllers\GaleriController::class, ['as'=>'admin']);
    // CRUD for data registrasi
    Route::resource('data-jemaah', App\Http\Controllers\DataJemaahController::class, ['as'=>'admin']);
    Route::resource('data-passport', App\Http\Controllers\DataPassportController::class, ['as'=>'admin']);
    Route::resource('data-visa', App\Http\Controllers\DataVisaController::class, ['as'=>'admin']);
    Route::resource('data-vaksin', App\Http\Controllers\DataVaksinController::class, ['as'=>'admin']);
    Route::resource('dokumen', App\Http\Controllers\DokumenKeberangkatanController::class, ['as'=>'admin']);
});

use App\Models\DataJemaah;
use App\Models\DataPassport;
use App\Models\DataVaksin;
use App\Models\DataVisa;

Route::middleware(['auth','role:Pimpinan'])->prefix('pimpinan')->group(function(){
    Route::get('/dashboard', function(){
        $jemaahCount = DataJemaah::count();
        $passportCount = DataPassport::count();
        $vaksinCount = DataVaksin::count();
        $visaCount = DataVisa::count();
        $recentJemaah = DataJemaah::latest()->limit(10)->get();

        // transaksi / pendapatan metrics
        $transaksiCount = Transaksi::count();
        $pendapatanHari = Transaksi::whereDate('created_at', now()->toDateString())->sum('nominal_bayar');
        $pendapatanBulan = Transaksi::whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->sum('nominal_bayar');
        $pendapatanTahun = Transaksi::whereYear('created_at', now()->year)->sum('nominal_bayar');

        return view('pimpinan.dashboard', compact('jemaahCount','passportCount','vaksinCount','visaCount','recentJemaah','transaksiCount','pendapatanHari','pendapatanBulan','pendapatanTahun'));
    })->name('pimpinan.dashboard');

    // Read-only detail routes for Pimpinan to inspect records
    Route::get('data-jemaah/{id}', [App\Http\Controllers\DataJemaahController::class, 'show'])->name('pimpinan.data-jemaah.show');
    Route::get('data-passport/{id}', [App\Http\Controllers\DataPassportController::class, 'show'])->name('pimpinan.data-passport.show');
    Route::get('data-visa/{id}', [App\Http\Controllers\DataVisaController::class, 'show'])->name('pimpinan.data-visa.show');
    Route::get('data-vaksin/{id}', [App\Http\Controllers\DataVaksinController::class, 'show'])->name('pimpinan.data-vaksin.show');
    // daftar akun jemaah (read-only) for pimpinan
    Route::get('daftar-jemaah', function(){
        $users = App\Models\User::where('role','Jemaah')->paginate(15);
        return view('pimpinan.users.index', compact('users'));
    })->name('pimpinan.daftar_jemaah');
});
