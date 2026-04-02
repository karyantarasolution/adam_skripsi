<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriSampahController;
use App\Http\Controllers\UnitBankSampahController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\SetoranSampahController;
use App\Http\Controllers\PenarikanSaldoController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $role = Auth::user()->role;
    if ($role === 'super_admin') {
        return redirect()->route('super_admin.dashboard');
    } elseif ($role === 'admin_unit') {
        return redirect()->route('admin_unit.dashboard');
    } else {
        return redirect()->route('nasabah.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:nasabah'])->group(function () {
    Route::get('/nasabah/dashboard', [DashboardController::class, 'nasabah'])->name('nasabah.dashboard');
});

Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::get('/super-admin/dashboard', [DashboardController::class, 'superAdmin'])->name('super_admin.dashboard');
    Route::resource('kategori-sampah', KategoriSampahController::class);
    Route::resource('unit-bank-sampah', UnitBankSampahController::class);
    Route::get('/cetak-kategori', [LaporanController::class, 'cetakKategori'])->name('cetak.kategori');
    Route::get('/cetak-reduksi-global', [LaporanController::class, 'cetakReduksiGlobal'])->name('cetak.reduksi_global');
    Route::get('/cetak-peringkat-kinerja', [LaporanController::class, 'cetakPeringkatKinerja'])->name('cetak.peringkat');
});

Route::middleware(['auth', 'role:admin_unit'])->group(function () {
    Route::get('/admin-unit/dashboard', [DashboardController::class, 'adminUnit'])->name('admin_unit.dashboard');
    Route::resource('nasabah', NasabahController::class);
    Route::resource('setoran-sampah', SetoranSampahController::class)->except(['edit', 'update']);
    Route::resource('penarikan-saldo', PenarikanSaldoController::class)->except(['edit', 'update']);
    Route::get('/cetak-arus-kas', [LaporanController::class, 'cetakArusKas'])->name('cetak.arus_kas');
    Route::get('/cetak-nasabah-unit', [LaporanController::class, 'cetakNasabahUnit'])->name('cetak.nasabah_unit');
    Route::get('/cetak-buku-tabungan/{id}', [LaporanController::class, 'cetakBukuTabungan'])->name('cetak.buku_tabungan');
    Route::get('/cetak-penarikan', [LaporanController::class, 'cetakPenarikan'])->name('cetak.penarikan');
    Route::get('/cetak-rekap-setoran', [LaporanController::class, 'cetakRekapSetoran'])->name('cetak.rekap_setoran');
});

require __DIR__.'/auth.php';