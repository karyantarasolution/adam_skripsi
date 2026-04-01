@extends('layouts.app')

@section('title', 'Edit Unit Bank Sampah')
@section('header', 'Edit Unit & Akun Admin')

@section('content')
<div class="bg-white p-6 rounded-lg shadow border border-green-100 w-full max-w-4xl">
    <form action="{{ route('unit-bank-sampah.update', $unitBankSampah->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="border p-4 rounded-lg bg-gray-50">
                <h4 class="font-bold text-yellow-600 mb-4 border-b pb-2">🏢 Profil Unit Bank Sampah</h4>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Nama Unit</label>
                    <input type="text" name="nama_unit" value="{{ old('nama_unit', $unitBankSampah->nama_unit) }}" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-green-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Alamat Lengkap Unit</label>
                    <textarea name="alamat" rows="3" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-green-500">{{ old('alamat', $unitBankSampah->alamat) }}</textarea>
                </div>
            </div>

            <div class="border p-4 rounded-lg bg-gray-50">
                <h4 class="font-bold text-yellow-600 mb-4 border-b pb-2">👤 Data Akun Admin Unit</h4>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Nama Lengkap Admin</label>
                    <input type="text" name="nama_admin" value="{{ old('nama_admin', $unitBankSampah->admin->name ?? '') }}" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-green-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Email (Untuk Login)</label>
                    <input type="email" name="email" value="{{ old('email', $unitBankSampah->admin->email ?? '') }}" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-green-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Password Login Baru</label>
                    <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-green-500 placeholder-gray-400" placeholder="Kosongkan jika tidak ingin diubah">
                    <p class="text-xs text-gray-500 mt-1">Isi hanya jika ingin mengganti password admin ini.</p>
                </div>
            </div>
        </div>

        <div class="mt-6 flex space-x-2">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-lg font-bold shadow">Update Data</button>
            <a href="{{ route('unit-bank-sampah.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-lg font-bold shadow">Batal</a>
        </div>
    </form>
</div>
@endsection