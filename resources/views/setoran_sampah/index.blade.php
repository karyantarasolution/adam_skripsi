@extends('layouts.app')

@section('title', 'Transaksi Setoran')
@section('header', 'Riwayat Setoran Sampah')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-5 rounded-2xl shadow-sm border border-green-50">
        <div>
            <h3 class="text-xl font-bold text-gray-800">Setoran Masuk</h3>
            <p class="text-sm text-gray-500">Daftar penimbangan sampah harian warga.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('cetak.rekap_setoran') }}" target="_blank" class="bg-indigo-50 hover:bg-indigo-100 text-indigo-600 px-4 py-2 rounded-xl text-sm font-bold border border-indigo-200 transition flex items-center gap-2">
                🖨️ Rekap Setoran
            </a>
            <a href="{{ route('setoran-sampah.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-xl text-sm font-bold shadow-lg shadow-green-200 transition">
                ⚖️ Timbang Sampah
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-xl shadow-sm">
            <p class="text-sm font-bold">✅ {{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-wider">No</th>
                        <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-wider">Tanggal</th>
                        <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-wider">Nasabah</th>
                        <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-wider">Kategori & Berat</th>
                        <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Total Tabungan</th>
                        <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($setoran as $index => $item)
                    <tr class="hover:bg-green-50/20 transition-colors">
                        <td class="py-4 px-6 text-sm text-gray-400">{{ $index + 1 }}</td>
                        <td class="py-4 px-6 text-sm font-medium text-gray-600">
                            {{ \Carbon\Carbon::parse($item->tanggal_setor)->format('d/m/Y') }}
                        </td>
                        <td class="py-4 px-6">
                            <p class="font-bold text-gray-800 leading-tight">{{ $item->nasabah->user->name }}</p>
                            <p class="text-xs text-gray-400">ID Nasabah: {{ $item->nasabah_id }}</p>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded text-xs font-bold">
                                {{ $item->kategori->nama_kategori }}
                            </span>
                            <span class="ml-1 text-sm font-bold text-gray-700">{{ $item->berat }} {{ $item->kategori->satuan }}</span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <span class="text-green-700 font-black text-base">
                                + Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <form action="{{ route('setoran-sampah.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Batalkan transaksi ini? Saldo warga akan dikurangi kembali!');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-400 hover:text-red-600 transition">
                                    ❌ <span class="text-xs underline font-bold">Batalkan</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center opacity-40">
                            <p class="italic">Belum ada transaksi timbang hari ini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection