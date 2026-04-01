@extends('layouts.app')

@section('title', 'Panel Petugas - ' . $nama_unit)
@section('header', 'Dashboard Operasional: ' . $nama_unit)

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-gradient-to-br from-green-500 to-green-700 p-6 rounded-2xl shadow-lg text-white">
        <p class="text-sm opacity-80 uppercase font-bold tracking-wider">Nasabah Terdaftar</p>
        <h3 class="text-4xl font-black mt-2">{{ $nasabah_unit }} <span class="text-lg font-normal">Warga</span></h3>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <p class="text-xs font-bold text-gray-400 uppercase">Total Sampah Terkumpul</p>
        <h3 class="text-3xl font-black text-green-600 mt-1">{{ number_format($berat_unit, 1) }} Kg</h3>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <p class="text-xs font-bold text-gray-400 uppercase">Total Uang Keluar (Pencairan)</p>
        <h3 class="text-3xl font-black text-red-500 mt-1">Rp {{ number_format($saldo_keluar, 0, ',', '.') }}</h3>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
        <h4 class="font-bold text-gray-800">Riwayat Setoran Terakhir</h4>
        <a href="{{ route('setoran-sampah.index') }}" class="text-green-600 text-sm font-bold hover:underline">Lihat Semua →</a>
    </div>
    <table class="w-full text-left">
        <thead>
            <tr class="text-xs text-gray-400 uppercase tracking-widest bg-gray-50">
                <th class="px-6 py-3">Nasabah</th>
                <th class="px-6 py-3">Kategori</th>
                <th class="px-6 py-3">Berat</th>
                <th class="px-6 py-3">Nominal</th>
                <th class="px-6 py-3">Waktu</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm">
            @foreach($setoran_last as $s)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 font-bold text-gray-700">{{ $s->nasabah->user->name }}</td>
                <td class="px-6 py-4">{{ $s->kategori->nama_kategori }}</td>
                <td class="px-6 py-4">{{ $s->berat }} Kg</td>
                <td class="px-6 py-4 font-bold text-green-600">Rp {{ number_format($s->total_harga, 0, ',', '.') }}</td>
                <td class="px-6 py-4 text-gray-400">{{ $s->created_at->diffForHumans() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-8 flex gap-4">
    <a href="{{ route('setoran-sampah.create') }}" class="px-6 py-3 bg-green-600 text-white rounded-xl font-bold shadow-lg shadow-green-200 hover:bg-green-700 transition">⚖️ Mulai Timbang</a>
    <a href="{{ route('cetak.arus_kas') }}" target="_blank" class="px-6 py-3 bg-white border border-gray-200 text-gray-700 rounded-xl font-bold hover:bg-gray-50 transition">🖨️ Cetak Laporan Unit</a>
</div>
@endsection