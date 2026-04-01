@extends('layouts.app')
@section('title', 'Manajemen Nasabah')
@section('header', 'Database Nasabah Warga')
@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
        <div>
            <h3 class="text-lg font-bold text-gray-800">Daftar Nasabah</h3>
            <p class="text-xs text-gray-400">Total warga terdaftar di unit bank sampah anda.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('cetak.nasabah_unit') }}" target="_blank" class="px-4 py-2 bg-gray-100 text-gray-600 rounded-xl text-xs font-bold hover:bg-gray-200 transition">🖨️ Cetak PDF</a>
            <a href="{{ route('nasabah.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-xl text-xs font-bold shadow-lg shadow-green-100 hover:bg-green-700 transition">+ Tambah Nasabah</a>
        </div>
    </div>
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50 text-[10px] font-black uppercase tracking-widest text-gray-400 border-b">
                    <th class="p-6">Nasabah</th>
                    <th class="p-6">Informasi Kontak</th>
                    <th class="p-6 text-right">Saldo Tabungan</th>
                    <th class="p-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($nasabah as $item)
                <tr class="hover:bg-green-50/30 transition">
                    <td class="p-6">
                        <p class="font-bold text-gray-800">{{ $item->user->name }}</p>
                        <p class="text-[10px] font-mono text-gray-400 uppercase tracking-tighter">NIK: {{ $item->nik }}</p>
                    </td>
                    <td class="p-6">
                        <p class="text-sm font-medium text-gray-600">{{ $item->no_telp }}</p>
                        <p class="text-[10px] text-gray-400 truncate w-40">{{ $item->alamat }}</p>
                    </td>
                    <td class="p-6 text-right">
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-lg font-black text-xs">
                            Rp {{ number_format($item->saldo->jumlah_saldo ?? 0, 0, ',', '.') }}
                        </span>
                    </td>
                    <td class="p-6">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('cetak.buku_tabungan', $item->id) }}" target="_blank" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition">📖</a>
                            <a href="{{ route('nasabah.edit', $item->id) }}" class="p-2 bg-yellow-50 text-yellow-600 rounded-lg hover:bg-yellow-500 hover:text-white transition">✏️</a>
                            <form action="{{ route('nasabah.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data nasabah ini?')">
                                @csrf @method('DELETE')
                                <button class="p-2 bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition">🗑️</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="p-20 text-center text-gray-300 italic">Data nasabah masih kosong.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection