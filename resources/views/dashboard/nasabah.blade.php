@extends('layouts.app')

@section('title', 'Tabungan Saya')
@section('header', 'Buku Tabungan Digital')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-green-600 p-6 rounded-2xl shadow-lg text-white">
        <p class="text-sm opacity-80">Total Saldo Tabungan</p>
        <h3 class="text-3xl font-extrabold mt-1">Rp {{ number_format($nasabah->saldo->jumlah_saldo ?? 0, 0, ',', '.') }}</h3>
        <p class="text-xs mt-4 italic">* Silakan hubungi petugas unit untuk pencairan.</p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow border border-green-100">
        <p class="text-sm text-gray-500">Unit Bank Sampah Terdaftar</p>
        <h3 class="text-xl font-bold text-green-700 mt-1">{{ $nasabah->unit->nama_unit }}</h3>
        <p class="text-xs text-gray-400 mt-2">{{ $nasabah->unit->alamat }}</p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow border border-green-100">
        <p class="text-sm text-gray-500">Nomor Induk Kependudukan (NIK)</p>
        <h3 class="text-xl font-bold text-gray-800 mt-1">{{ $nasabah->nik }}</h3>
        <p class="text-xs text-gray-400 mt-2">No. Telp: {{ $nasabah->no_telp }}</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow border border-green-100 overflow-hidden">
    <div class="p-5 border-b border-gray-100 flex justify-between items-center">
        <h4 class="font-bold text-gray-700">5 Transaksi Setoran Terakhir</h4>
    </div>

    <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Buku Tabungan Digital</h2>
    <a href="{{ route('cetak.buku_tabungan', $nasabah->id) }}" target="_blank" class="bg-white border-2 border-green-600 text-green-600 hover:bg-green-50 px-4 py-2 rounded-xl text-sm font-bold shadow-sm transition">
        📥 Unduh Buku Tabungan (PDF)
    </a>
</div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-xs uppercase">
                    <th class="px-6 py-3">Tanggal</th>
                    <th class="px-6 py-3">Kategori</th>
                    <th class="px-6 py-3">Berat</th>
                    <th class="px-6 py-3">Nominal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($riwayat_setoran as $rs)
                <tr class="text-sm">
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($rs->tanggal_setor)->format('d M Y') }}</td>
                    <td class="px-6 py-4 font-medium">{{ $rs->kategori->nama_kategori }}</td>
                    <td class="px-6 py-4">{{ $rs->berat }} {{ $rs->kategori->satuan }}</td>
                    <td class="px-6 py-4 text-green-600 font-bold">Rp {{ number_format($rs->total_harga, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-10 text-center text-gray-400 italic">Belum ada riwayat setoran sampah.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection