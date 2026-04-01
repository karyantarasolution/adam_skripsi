@extends('layouts.app')

@section('title', 'Tambah Unit Bank Sampah')
@section('header', 'Tambah Unit & Akun Admin')

@section('content')
<div class="bg-white p-6 rounded-lg shadow border border-green-100 w-full max-w-4xl">
    <form action="{{ route('unit-bank-sampah.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="border p-4 rounded-lg bg-gray-50">
                <h4 class="font-bold text-green-700 mb-4 border-b pb-2">🏢 Profil Unit Bank Sampah</h4>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Nama Unit (Contoh: Unit Kenanga RT 05)</label>
                    <input type="text" name="nama_unit" value="{{ old('nama_unit') }}" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-green-500">
                    @error('nama_unit') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Alamat Lengkap Unit</label>
                    <textarea name="alamat" rows="3" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-green-500">{{ old('alamat') }}</textarea>
                    @error('alamat') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="border p-4 rounded-lg bg-gray-50">
                <h4 class="font-bold text-green-700 mb-4 border-b pb-2">👤 Data Akun Admin Unit</h4>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Nama Lengkap Admin</label>
                    <input type="text" name="nama_admin" value="{{ old('nama_admin') }}" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-green-500">
                    @error('nama_admin') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Email (Untuk Login)</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-green-500">
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Password Login</label>
                    <input type="password" name="password" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-green-500">
                    <p class="text-xs text-gray-500 mt-1">Minimal 8 karakter.</p>
                    @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="mt-6 flex space-x-2">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-bold shadow">Simpan Data & Buat Akun</button>
            <a href="{{ route('unit-bank-sampah.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-lg font-bold shadow">Batal</a>
        </div>
    </form>
</div>
@endsection