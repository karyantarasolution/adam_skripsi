@extends('layouts.app')

@section('title', 'Riwayat Penarikan Saldo')
@section('header', 'Manajemen Penarikan Tunai')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-5 rounded-2xl shadow-sm border border-red-50">
        <div>
            <h3 class="text-xl font-bold text-gray-800">Riwayat Penarikan</h3>
            <p class="text-sm text-gray-500">Daftar pencairan saldo tabungan nasabah warga.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('cetak.penarikan') }}" target="_blank" class="bg-red-50 hover:bg-red-100 text-red-600 px-4 py-2 rounded-xl text-sm font-bold border border-red-200 transition flex items-center gap-2">
                🖨️ Cetak PDF
            </a>
            <a href="{{ route('penarikan-saldo.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-xl text-sm font-bold shadow-lg shadow-red-200 transition">
                + Tarik Saldo
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
                        <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-wider">Waktu & Tanggal</th>
                        <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-wider">Nasabah</th>
                        <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Jumlah Tarik</th>
                        <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">Status</th>
                        <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($penarikan as $index => $item)
                    <tr class="hover:bg-red-50/20 transition-colors">
                        <td class="py-4 px-6 text-sm text-gray-400">{{ $index + 1 }}</td>
                        <td class="py-4 px-6">
                            <p class="text-sm font-bold text-gray-700">{{ \Carbon\Carbon::parse($item->tanggal_tarik)->format('d M Y') }}</p>
                            <p class="text-xs text-gray-400">{{ $item->created_at->format('H:i') }} WITA</p>
                        </td>
                        <td class="py-4 px-6 font-bold text-gray-800">{{ $item->nasabah->user->name }}</td>
                        <td class="py-4 px-6 text-right">
                            <span class="text-red-600 font-black text-base">
                                - Rp {{ number_format($item->jumlah_tarik, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-bold uppercase">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <form action="{{ route('penarikan-saldo.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Batalkan penarikan ini? Saldo warga akan dikembalikan!');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-gray-300 hover:text-red-500 transition">
                                    🗑️ <span class="text-xs underline">Hapus</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center opacity-40">
                            <p class="italic">Belum ada riwayat penarikan uang.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection