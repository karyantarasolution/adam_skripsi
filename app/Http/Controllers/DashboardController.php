<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\KategoriSampah;
use App\Models\UnitBankSampah;
use App\Models\Nasabah;
use App\Models\SetoranSampah;
use App\Models\PenarikanSaldo;
class DashboardController extends Controller
{
   public function superAdmin()
    {
        $data = [
            'total_unit'    => UnitBankSampah::count(),
            'total_nasabah' => Nasabah::count(),
            'total_sampah'  => SetoranSampah::sum('berat'), // Dalam Kg
            'total_rupiah'  => SetoranSampah::sum('total_harga'),
            'unit_terbaru'  => UnitBankSampah::with('admin')->latest()->take(5)->get(),
        ];
        return view('dashboard.super_admin', $data);
    }

public function adminUnit()
{
    $unit = UnitBankSampah::where('admin_id', Auth::id())->first();
    
    // JAGA-JAGA: Kalau admin ini belum ditugaskan di unit mana pun
    if (!$unit) {
        return "Akses Ditolak: Akun Anda belum ditugaskan di unit bank sampah mana pun. Silakan hubungi Super Admin DLH.";
    }

    $data = [
        'nama_unit'     => $unit->nama_unit,
        'nasabah_unit'  => Nasabah::where('unit_id', $unit->id)->count(),
        'berat_unit'    => SetoranSampah::where('unit_id', $unit->id)->sum('berat'),
        'saldo_keluar'  => PenarikanSaldo::where('unit_id', $unit->id)->sum('jumlah_tarik'),
        'setoran_last'  => SetoranSampah::where('unit_id', $unit->id)->with('nasabah.user')->latest()->take(5)->get(),
    ];
    
    return view('dashboard.admin_unit', $data);
}

public function nasabah()
{
    $user = Auth::user();
    
    // Cari data nasabah
    $nasabah = \App\Models\Nasabah::where('user_id', $user->id)
                ->with(['saldo', 'unit'])
                ->first();
    
    // Jika profil nasabah belum lengkap di tabel nasabahs
    if (!$nasabah) {
        return "Profil Anda sedang disiapkan oleh Admin Unit. Silakan hubungi petugas.";
    }

    $riwayat_setoran = \App\Models\SetoranSampah::where('nasabah_id', $nasabah->id)
                        ->with('kategori')
                        ->latest()
                        ->take(5)
                        ->get();

    return view('dashboard.nasabah', compact('nasabah', 'riwayat_setoran'));
}
}