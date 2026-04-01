<?php

namespace App\Http\Controllers;

use App\Models\PenarikanSaldo;
use App\Models\Nasabah;
use App\Models\UnitBankSampah;
use App\Models\SaldoNasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PenarikanSaldoController extends Controller
{
    public function index()
    {
        $unit = UnitBankSampah::where('admin_id', Auth::id())->first();
        $penarikan = PenarikanSaldo::where('unit_id', $unit->id)
                    ->with('nasabah.user')
                    ->latest()
                    ->get();
                    
        return view('penarikan_saldo.index', compact('penarikan'));
    }

    public function create()
    {
        $unit = UnitBankSampah::where('admin_id', Auth::id())->first();
        // Hanya nasabah di unit ini yang saldonya > 0 yang bisa tarik uang
        $nasabah = Nasabah::where('unit_id', $unit->id)
                    ->whereHas('saldo', function($q){ $q->where('jumlah_saldo', '>', 0); })
                    ->with(['user', 'saldo'])
                    ->get();

        return view('penarikan_saldo.create', compact('nasabah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nasabah_id'    => 'required|exists:nasabahs,id',
            'jumlah_tarik'  => 'required|integer|min:1000',
            'tanggal_tarik' => 'required|date',
        ]);

        $unit = UnitBankSampah::where('admin_id', Auth::id())->first();
        $saldoNasabah = SaldoNasabah::where('nasabah_id', $request->nasabah_id)->first();

        // Validasi: Jangan sampai narik uang lebih banyak dari saldonya
        if ($request->jumlah_tarik > $saldoNasabah->jumlah_saldo) {
            return back()->withErrors(['jumlah_tarik' => 'Maaf, saldo nasabah tidak mencukupi untuk penarikan ini.']);
        }

        DB::transaction(function () use ($request, $unit, $saldoNasabah) {
            // 1. Catat Penarikan
            PenarikanSaldo::create([
                'nasabah_id'    => $request->nasabah_id,
                'unit_id'       => $unit->id,
                'jumlah_tarik'  => $request->jumlah_tarik,
                'tanggal_tarik' => $request->tanggal_tarik,
                'status'        => 'disetujui', // Langsung setujui karena dilakukan di kasir unit
            ]);

            // 2. Potong Saldo Otomatis
            $saldoNasabah->decrement('jumlah_saldo', $request->jumlah_tarik);
        });

        return redirect()->route('penarikan-saldo.index')->with('success', 'Penarikan tunai berhasil dicatat dan saldo telah dikurangi.');
    }

    public function destroy($id)
    {
        $penarikan = PenarikanSaldo::findOrFail($id);
        
        DB::transaction(function () use ($penarikan) {
            // Refund/Kembalikan saldo jika transaksi dihapus
            $saldo = SaldoNasabah::where('nasabah_id', $penarikan->nasabah_id)->first();
            $saldo->increment('jumlah_saldo', $penarikan->jumlah_tarik);
            $penarikan->delete();
        });

        return redirect()->route('penarikan-saldo.index')->with('success', 'Transaksi dibatalkan, uang nasabah dikembalikan ke saldo.');
    }
}