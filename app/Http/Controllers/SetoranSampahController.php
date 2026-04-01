<?php

namespace App\Http\Controllers;

use App\Models\SetoranSampah;
use App\Models\Nasabah;
use App\Models\KategoriSampah;
use App\Models\UnitBankSampah;
use App\Models\SaldoNasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SetoranSampahController extends Controller
{
    public function index()
    {
        // Cari unit admin yang sedang login
        $unit = UnitBankSampah::where('admin_id', Auth::id())->first();

        // Tampilkan transaksi hanya untuk unit ini
        $setoran = SetoranSampah::where('unit_id', $unit->id)
                    ->with(['nasabah.user', 'kategori'])
                    ->latest()
                    ->get();
                    
        return view('setoran_sampah.index', compact('setoran'));
    }

    public function create()
    {
        $unit = UnitBankSampah::where('admin_id', Auth::id())->first();
        
        // Ambil data warga yang terdaftar di unit ini saja
        $nasabah = Nasabah::where('unit_id', $unit->id)->with('user')->get();
        
        // Ambil data harga sampah dari pusat (DLH)
        $kategori = KategoriSampah::all();

        return view('setoran_sampah.create', compact('nasabah', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nasabah_id'    => 'required|exists:nasabahs,id',
            'kategori_id'   => 'required|exists:kategori_sampahs,id',
            'berat'         => 'required|numeric|min:0.1', // Boleh desimal, misal 1.5 Kg
            'tanggal_setor' => 'required|date',
        ]);

        $unit = UnitBankSampah::where('admin_id', Auth::id())->first();
        
        // Ambil harga per Kg dari database master
        $kategori = KategoriSampah::findOrFail($request->kategori_id);
        
        // Hitung otomatis (Berat x Harga)
        $total_harga = $request->berat * $kategori->harga_per_kg;

        DB::transaction(function () use ($request, $unit, $total_harga) {
            // 1. Catat Transaksi Setoran
            SetoranSampah::create([
                'nasabah_id'    => $request->nasabah_id,
                'unit_id'       => $unit->id,
                'kategori_id'   => $request->kategori_id,
                'berat'         => $request->berat,
                'total_harga'   => $total_harga,
                'tanggal_setor' => $request->tanggal_setor,
            ]);

            // 2. Tambahkan Saldo Warga Secara Otomatis!
            $saldo = SaldoNasabah::where('nasabah_id', $request->nasabah_id)->first();
            $saldo->increment('jumlah_saldo', $total_harga);
        });

        return redirect()->route('setoran-sampah.index')->with('success', 'Setoran berhasil dicatat dan Saldo warga otomatis bertambah!');
    }

    public function destroy($id)
    {
        $setoran = SetoranSampah::findOrFail($id);
        
        DB::transaction(function () use ($setoran) {
            // 1. Kurangi saldo warga karena transaksinya dibatalkan/dihapus
            $saldo = SaldoNasabah::where('nasabah_id', $setoran->nasabah_id)->first();
            $saldo->decrement('jumlah_saldo', $setoran->total_harga);
            
            // 2. Hapus catatan transaksi
            $setoran->delete();
        });

        return redirect()->route('setoran-sampah.index')->with('success', 'Transaksi dibatalkan. Saldo warga otomatis dikurangi kembali.');
    }
}