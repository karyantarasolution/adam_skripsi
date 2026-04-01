@extends('layouts.app')

@section('title', 'Dinas Lingkungan Hidup - Monitoring')
@section('header', 'Dashboard Monitoring DLH Kota Banjarmasin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-green-500">
        <p class="text-xs font-bold text-gray-500 uppercase">Total Unit Terdaftar</p>
        <h3 class="text-2xl font-black text-gray-800">{{ $total_unit }} Unit</h3>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-500">
        <p class="text-xs font-bold text-gray-500 uppercase">Total Nasabah (Warga)</p>
        <h3 class="text-2xl font-black text-gray-800">{{ $total_nasabah }} Orang</h3>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-yellow-500">
        <p class="text-xs font-bold text-gray-500 uppercase">Volume Reduksi Sampah</p>
        <h3 class="text-2xl font-black text-gray-800">{{ number_format($total_sampah, 1) }} Kg</h3>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-purple-500">
        <p class="text-xs font-bold text-gray-500 uppercase">Total Perputaran Ekonomi</p>
        <h3 class="text-2xl font-black text-gray-800">Rp {{ number_format($total_rupiah, 0, ',', '.') }}</h3>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h4 class="font-bold text-gray-700 mb-4 flex items-center">🏢 Unit Bank Sampah Terbaru</h4>
        <div class="space-y-4">
            @foreach($unit_terbaru as $u)
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <div>
                    <p class="font-bold text-sm text-gray-800">{{ $u->nama_unit }}</p>
                    <p class="text-xs text-gray-500">{{ $u->admin->name ?? 'N/A' }}</p>
                </div>
                <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full font-bold">Aktif</span>
            </div>
            @endforeach
        </div>
    </div>

    <div class="bg-green-800 p-8 rounded-xl shadow-lg text-white relative overflow-hidden">
        <div class="relative z-10">
            <h4 class="text-xl font-bold mb-2">Laporan Rekapitulasi</h4>
            <p class="text-green-200 text-sm mb-6">Unduh laporan resmi volume sampah se-Kota Banjarmasin dalam format PDF.</p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('cetak.kategori') }}" target="_blank" class="bg-white text-green-800 px-4 py-2 rounded-lg font-bold text-sm hover:bg-green-100 transition">Cetak Master Harga</a>
                <a href="{{ route('cetak.reduksi_global') }}" target="_blank" class="bg-green-600 text-white px-4 py-2 rounded-lg font-bold text-sm hover:bg-green-500 transition text-center">
    Cetak Reduksi Global
</a>
            </div>
        </div>
        <div class="absolute -right-10 -bottom-10 opacity-10 text-9oxl">♻️</div>
    </div>
</div>
@endsection