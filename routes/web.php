<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AbsensiController;
use App\Models\Siswa;
use App\Models\Absensi;
use Carbon\Carbon;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    $tanggalHariIni = Carbon::today()->toDateString();

    $totalSiswa = Siswa::count();
    $hadir = Absensi::where('tanggal', $tanggalHariIni)->where('status', 'Hadir')->count();
    $izin = Absensi::where('tanggal', $tanggalHariIni)->where('status', 'Izin')->count();
    $sakit = Absensi::where('tanggal', $tanggalHariIni)->where('status', 'Sakit')->count();
    $alpa = Absensi::where('tanggal', $tanggalHariIni)->where('status', 'Alpa')->count();

    return view('dashboard', compact(
        'totalSiswa',
        'hadir',
        'izin',
        'sakit',
        'alpa'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('siswa', SiswaController::class);

    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi.store');
    Route::get('/absensi/{absensi}/edit', [AbsensiController::class, 'edit'])->name('absensi.edit');
    Route::put('/absensi/{absensi}', [AbsensiController::class, 'update'])->name('absensi.update');
    Route::delete('/absensi/{absensi}', [AbsensiController::class, 'destroy'])->name('absensi.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/rekap', [AbsensiController::class, 'rekap'])->name('absensi.rekap');
    Route::get('/rekap/pdf', [AbsensiController::class, 'exportPdf'])->name('absensi.pdf');
});

require __DIR__.'/auth.php';