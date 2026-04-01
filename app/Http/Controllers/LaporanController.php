<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriSampah;
use App\Models\SetoranSetoran; // Jika ada
use App\Models\SetoranSampah;
use App\Models\PenarikanSaldo;
use App\Models\UnitBankSampah;
use App\Models\Nasabah;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
class LaporanController extends Controller
{
    public function cetakKategori()
    {
        $kategori = KategoriSampah::all();
        $tanggal = date('d F Y');

        // Memanggil view khusus untuk desain PDF
        $pdf = Pdf::loadView('laporan.kategori_pdf', compact('kategori', 'tanggal'));
        
        // Download atau tampilkan di browser
        return $pdf->stream('Laporan_Kategori_Sampah.pdf');
    }
    public function cetakArusKas()
{
    $unit = UnitBankSampah::where('admin_id', Auth::id())->first();
    
    $setoran = SetoranSampah::where('unit_id', $unit->id)->with(['nasabah.user', 'kategori'])->get();
    $penarikan = PenarikanSaldo::where('unit_id', $unit->id)->with('nasabah.user')->get();
    
    $total_masuk = $setoran->sum('total_harga');
    $total_keluar = $penarikan->sum('jumlah_tarik');
    $tanggal = date('d F Y');

    $pdf = Pdf::loadView('laporan.arus_kas_pdf', compact('unit', 'setoran', 'penarikan', 'total_masuk', 'total_keluar', 'tanggal'));
    return $pdf->stream('Laporan_Arus_Kas_'.$unit->nama_unit.'.pdf');
}

public function cetakReduksiGlobal()
{
    // Mengelompokkan total berat berdasarkan nama kategori sampah
    $reduksi = \App\Models\SetoranSampah::join('kategori_sampahs', 'setoran_sampahs.kategori_id', '=', 'kategori_sampahs.id')
                ->select('kategori_sampahs.nama_kategori', 'kategori_sampahs.satuan', \DB::raw('SUM(setoran_sampahs.berat) as total_berat'))
                ->groupBy('kategori_sampahs.nama_kategori', 'kategori_sampahs.satuan')
                ->get();

    $total_seluruhnya = $reduksi->sum('total_berat');
    $tanggal = date('d F Y');

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('laporan.reduksi_global_pdf', compact('reduksi', 'total_seluruhnya', 'tanggal'));
    return $pdf->stream('Laporan_Reduksi_Sampah_Banjarmasin.pdf');
}
public function cetakNasabahUnit()
{
    $unit = \App\Models\UnitBankSampah::where('admin_id', Auth::id())->first();
    $nasabah = Nasabah::where('unit_id', $unit->id)->with('user')->get();
    $tanggal = date('d F Y');

    $pdf = Pdf::loadView('laporan.nasabah_unit_pdf', compact('nasabah', 'unit', 'tanggal'));
    return $pdf->stream('Laporan_Nasabah_'.$unit->nama_unit.'.pdf');
}

// LAPORAN 3: Buku Tabungan Digital (Untuk Nasabah/Admin)
public function cetakBukuTabungan($id)
{
    $nasabah = Nasabah::with(['user', 'saldo', 'unit'])->findOrFail($id);
    $setoran = \App\Models\SetoranSampah::where('nasabah_id', $id)->with('kategori')->latest()->get();
    $tanggal = date('d F Y');

    $pdf = Pdf::loadView('laporan.buku_tabungan_pdf', compact('nasabah', 'setoran', 'tanggal'));
    return $pdf->stream('Buku_Tabungan_'.$nasabah->user->name.'.pdf');
}

// LAPORAN 6: Riwayat Penarikan Saldo (Untuk Admin Unit)
public function cetakPenarikan()
{
    $unit = \App\Models\UnitBankSampah::where('admin_id', Auth::id())->first();
    $penarikan = \App\Models\PenarikanSaldo::where('unit_id', $unit->id)->with('nasabah.user')->latest()->get();
    $tanggal = date('d F Y');

    $pdf = Pdf::loadView('laporan.penarikan_pdf', compact('penarikan', 'unit', 'tanggal'));
    return $pdf->stream('Riwayat_Penarikan_'.$unit->nama_unit.'.pdf');
}

public function cetakRekapSetoran()
{
    $unit = \App\Models\UnitBankSampah::where('admin_id', Auth::id())->first();
    $setoran = \App\Models\SetoranSampah::where('unit_id', $unit->id)
                ->with(['nasabah.user', 'kategori'])
                ->latest()
                ->get();
    
    $total_berat = $setoran->sum('berat');
    $total_rupiah = $setoran->sum('total_harga');
    $tanggal = date('d F Y');

    $pdf = Pdf::loadView('laporan.rekap_setoran_pdf', compact('unit', 'setoran', 'total_berat', 'total_rupiah', 'tanggal'));
    return $pdf->stream('Rekap_Setoran_'.$unit->nama_unit.'.pdf');
}

// LAPORAN 8: Peringkat Kinerja Bank Sampah (Untuk Super Admin DLH)
public function cetakPeringkatKinerja()
{
    // Mengambil semua unit dan menjumlahkan total berat sampah yang dikumpulkan tiap unit
    $peringkat = \App\Models\UnitBankSampah::withCount(['setoranSampah as total_kg' => function($query) {
        $query->select(\DB::raw('SUM(berat)'));
    }])->orderBy('total_kg', 'desc')->get();

    $tanggal = date('d F Y');

    $pdf = Pdf::loadView('laporan.peringkat_kinerja_pdf', compact('peringkat', 'tanggal'));
    return $pdf->stream('Laporan_Peringkat_Kinerja_Unit.pdf');
}
}