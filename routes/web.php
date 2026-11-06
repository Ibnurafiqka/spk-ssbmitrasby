<?php

use App\Http\Controllers\AtletController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PerangkinganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (!Auth::check()) {
        return redirect('/');
    }

    return match (Auth::user()->role) {
        'admin' => redirect()->route('dashboard.admin'),
        'orang_tua' => redirect()->route('dashboard.orang-tua'),
        default => redirect()->route('dashboard.pelatih'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])
        ->middleware('role:admin')
        ->name('dashboard.admin');

    Route::get('/dashboard/pelatih', [DashboardController::class, 'pelatih'])
        ->middleware('role:admin,pelatih')
        ->name('dashboard.pelatih');

    Route::get('/dashboard/orang-tua', [DashboardController::class, 'orangTua'])
        ->middleware('role:orang_tua')
        ->name('dashboard.orang-tua');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'role:admin,pelatih'])->group(function () {
    Route::resource('atlet', AtletController::class);
    Route::resource('kriteria', KriteriaController::class);
    Route::resource('penilaian', PenilaianController::class);
    Route::resource('orang-tua', OrangTuaController::class)->except('show');

    Route::get('perangkingan', [PerangkinganController::class, 'index'])->name('perangkingan.index');
    Route::post('perangkingan/hitung', [PerangkinganController::class, 'hitung'])->name('perangkingan.hitung');
    Route::get('perangkingan/hasil', [PerangkinganController::class, 'hasil'])->name('perangkingan.hasil');
    Route::post('/perangkingan/hitung-selected', [PerangkinganController::class, 'hitungSelected'])->name('perangkingan.hitung.selected');

    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/print', [LaporanController::class, 'print'])->name('laporan.print');
    Route::get('laporan/export-pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
    Route::get('laporan/preview-pdf', [LaporanController::class, 'previewPdf'])->name('laporan.preview');

    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
});

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('laporan/individu/{atlet}', [LaporanController::class, 'individu'])->name('laporan.individu');
});

Route::middleware(['auth', 'verified', 'role:orang_tua'])->group(function () {
    Route::get('/laporan-anak', [LaporanController::class, 'orangTua'])->name('laporan.orang-tua');
});

require __DIR__.'/auth.php';

