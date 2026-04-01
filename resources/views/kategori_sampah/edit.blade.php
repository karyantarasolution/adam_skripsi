@extends('layouts.app')

@section('title', 'Edit Kategori Sampah')
@section('header', 'Edit Kategori Sampah')

@section('content')
<div class="bg-white p-6 rounded-lg shadow border border-green-100 max-w-2xl">
    <form action="{{ route('kategori-sampah.update', $kategoriSampah->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Nama Kategori</label>
            <input type="text" name="nama_kategori" value="{{ old('nama_kategori', $kategoriSampah->nama_kategori) }}" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-green-500">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Harga Beli per Satuan (Rp)</label>
            <input type="number" name="harga_per_kg" value="{{ old('harga_per_kg', $kategoriSampah->harga_per_kg) }}" required min="0" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-green-500">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Satuan</label>
            <input type="text" name="satuan" value="{{ old('satuan', $kategoriSampah->satuan) }}" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-green-500">
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-bold shadow">Update Data</button>
            <a href="{{ route('kategori-sampah.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg font-bold shadow">Batal</a>
        </div>
    </form>
</div>
@endsection