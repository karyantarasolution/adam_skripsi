@extends('layouts.app')

@section('title', 'Timbang Sampah')
@section('header', 'Catat Setoran Baru')

@section('content')
<div class="bg-white p-6 rounded-lg shadow border border-green-100 max-w-2xl">
    <form action="{{ route('setoran-sampah.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Pilih Nasabah (Warga)</label>
            <select name="nasabah_id" required class="w-full px-4 py-2 border rounded-lg focus:border-green-500 outline-none">
                <option value="">-- Pilih Nama Warga --</option>
                @foreach($nasabah as $n)
                    <option value="{{ $n->id }}">{{ $n->user->name }} (NIK: {{ $n->nik }})</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Jenis Sampah (Harga Pusat)</label>
                <select name="kategori_id" required class="w-full px-4 py-2 border rounded-lg focus:border-green-500 outline-none">
                    <option value="">-- Pilih Jenis --</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kategori }} - Rp {{ number_format($k->harga_per_kg, 0, ',', '.') }}/{{ $k->satuan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Berat Sampah (Angka)</label>
                <input type="number" step="0.01" name="berat" required placeholder="Misal: 1.5" class="w-full px-4 py-2 border rounded-lg focus:border-green-500 outline-none">
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Tanggal Penimbangan</label>
            <input type="date" name="tanggal_setor" value="{{ date('Y-m-d') }}" required class="w-full px-4 py-2 border rounded-lg focus:border-green-500 outline-none">
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-bold shadow transition">
                💾 Simpan & Tambah Saldo
            </button>
            <a href="{{ route('setoran-sampah.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-lg font-bold shadow transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection