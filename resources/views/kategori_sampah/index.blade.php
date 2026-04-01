@extends('layouts.app')

@section('title', 'Master Kategori Sampah')
@section('header', 'Data Kategori Sampah')

@section('content')
<div class="bg-white p-6 rounded-lg shadow border border-green-100">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-bold text-gray-800">Daftar Harga Kategori Sampah</h3>
        <a href="{{ route('cetak.kategori') }}" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-bold shadow transition mr-2">
    🖨️ Cetak PDF
</a>
        <a href="{{ route('kategori-sampah.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-bold shadow transition">
            + Tambah Data
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-green-800 text-white">
                    <th class="py-3 px-4 border-b">No</th>
                    <th class="py-3 px-4 border-b">Nama Kategori</th>
                    <th class="py-3 px-4 border-b">Harga per Satuan</th>
                    <th class="py-3 px-4 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategori as $index => $item)
                <tr class="hover:bg-gray-50 border-b">
                    <td class="py-3 px-4">{{ $index + 1 }}</td>
                    <td class="py-3 px-4 font-semibold text-gray-700">{{ $item->nama_kategori }}</td>
                    <td class="py-3 px-4">Rp {{ number_format($item->harga_per_kg, 0, ',', '.') }} / {{ $item->satuan }}</td>
                    <td class="py-3 px-4 text-center">
                        <a href="{{ route('kategori-sampah.edit', $item->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs font-bold mr-1">Edit</a>
                        <form action="{{ route('kategori-sampah.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs font-bold">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-4 text-center text-gray-500">Belum ada data kategori sampah.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection