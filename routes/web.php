<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AtletController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PerangkinganController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// route dashboard utama
Route::get('/dashboard', function () {
    if (!Auth::check()) {
        return redirect('/'); // kalau belum login, balik ke welcome
    }

    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('dashboard.admin');
    } elseif ($user->role === 'pelatih') {
        return redirect()->route('dashboard.pelatih');
    }

    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

// dashboard khusus admin
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard/admin', function () {
        return view('dashboard.admin');
    })->name('dashboard.admin');

    Route::get('/dashboard/pelatih', function () {
        return view('dashboard.pelatih');
    })->name('dashboard.pelatih');
});

// profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes untuk SPK ARAS - hanya untuk user yang sudah login
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Data Atlet
    Route::resource('atlet', AtletController::class);
    
    // Data Kriteria
    Route::resource('kriteria', KriteriaController::class);
    
    // Penilaian Atlet
    Route::resource('penilaian', PenilaianController::class);
    Route::get('penilaian/create/{atlet_id}', [PenilaianController::class, 'create'])->name('penilaian.create.atlet');
    
    // Perangkingan (Proses ARAS)
    Route::get('perangkingan', [PerangkinganController::class, 'index'])->name('perangkingan.index');
    Route::post('perangkingan/hitung', [PerangkinganController::class, 'hitung'])->name('perangkingan.hitung');
    Route::get('perangkingan/hasil', [PerangkinganController::class, 'hasil'])->name('perangkingan.hasil');
    Route::post('/perangkingan/hitung-selected', [PerangkinganController::class, 'hitungSelected'])->name('perangkingan.hitung.selected');
    
    // Laporan
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/print', [LaporanController::class, 'print'])->name('laporan.print');
    Route::get('laporan/export-pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
    Route::get('laporan/preview-pdf', [LaporanController::class, 'previewPdf'])->name('laporan.preview');
    Route::get('laporan/individu/{atlet}', [LaporanController::class, 'individu'])->name('laporan.individu');
});

// Manajemen User (khusus admin)
Route::middleware(['auth', 'verified'])->group(function () {
    // ... routes lainnya
    
    // Riwayat
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');

    // User Management (hanya untuk admin)
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';