@extends('layouts.app')
@section('title', 'Daftar Nasabah Baru')
@section('header', 'Registrasi Warga')
@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
        <form action="{{ route('nasabah.store') }}" method="POST" class="space-y-5">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="space-y-2">
                    <label class="text-xs font-black uppercase text-gray-400">Nama Lengkap</label>
                    <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl border-gray-100 bg-gray-50 focus:ring-green-500 focus:border-green-500 text-sm font-bold">
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-black uppercase text-gray-400">NIK (Sesuai KTP)</label>
                    <input type="number" name="nik" required class="w-full px-4 py-3 rounded-xl border-gray-100 bg-gray-50 focus:ring-green-500 focus:border-green-500 text-sm font-bold">
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-xs font-black uppercase text-gray-400">Email Login</label>
                <input type="email" name="email" required class="w-full px-4 py-3 rounded-xl border-gray-100 bg-gray-50 focus:ring-green-500 focus:border-green-500 text-sm font-bold">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="space-y-2">
                    <label class="text-xs font-black uppercase text-gray-400">Nomor WhatsApp</label>
                    <input type="text" name="no_telp" required class="w-full px-4 py-3 rounded-xl border-gray-100 bg-gray-50 focus:ring-green-500 focus:border-green-500 text-sm font-bold">
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-black uppercase text-gray-400">Password Akun</label>
                    <input type="password" name="password" required class="w-full px-4 py-3 rounded-xl border-gray-100 bg-gray-50 focus:ring-green-500 focus:border-green-500 text-sm font-bold">
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-xs font-black uppercase text-gray-400">Alamat Rumah</label>
                <textarea name="alamat" rows="3" required class="w-full px-4 py-3 rounded-xl border-gray-100 bg-gray-50 focus:ring-green-500 focus:border-green-500 text-sm font-bold"></textarea>
            </div>
            <div class="pt-4 flex gap-3">
                <button type="submit" class="flex-1 py-4 bg-green-600 text-white rounded-2xl font-black shadow-lg shadow-green-100 hover:bg-green-700 transition uppercase tracking-widest text-xs">Simpan Data Nasabah</button>
                <a href="{{ route('nasabah.index') }}" class="px-8 py-4 bg-gray-100 text-gray-500 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-gray-200 transition text-center flex items-center">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection