@extends('layouts.app')
@section('title', 'Edit Profil Nasabah')
@section('header', 'Perbarui Data Warga')
@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
        <form action="{{ route('nasabah.update', $nasabah->id) }}" method="POST" class="space-y-5">
            @csrf @method('PUT')
            <div class="space-y-2">
                <label class="text-xs font-black uppercase text-gray-400">Nama Lengkap</label>
                <input type="text" name="name" value="{{ $nasabah->user->name }}" required class="w-full px-4 py-3 rounded-xl border-gray-100 bg-gray-50 text-sm font-bold">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="space-y-2">
                    <label class="text-xs font-black uppercase text-gray-400">NIK</label>
                    <input type="number" name="nik" value="{{ $nasabah->nik }}" required class="w-full px-4 py-3 rounded-xl border-gray-100 bg-gray-50 text-sm font-bold">
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-black uppercase text-gray-400">Nomor WhatsApp</label>
                    <input type="text" name="no_telp" value="{{ $nasabah->no_telp }}" required class="w-full px-4 py-3 rounded-xl border-gray-100 bg-gray-50 text-sm font-bold">
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-xs font-black uppercase text-gray-400">Alamat</label>
                <textarea name="alamat" rows="3" required class="w-full px-4 py-3 rounded-xl border-gray-100 bg-gray-50 text-sm font-bold">{{ $nasabah->alamat }}</textarea>
            </div>
            <div class="p-4 bg-yellow-50 rounded-2xl border border-yellow-100">
                <p class="text-[10px] text-yellow-700 font-bold leading-relaxed italic">* Password dan Email hanya dapat diubah melalui menu Profile atau oleh Super Admin demi alasan keamanan data warga.</p>
            </div>
            <div class="pt-4 flex gap-3">
                <button type="submit" class="flex-1 py-4 bg-blue-600 text-white rounded-2xl font-black shadow-lg shadow-blue-100 hover:bg-blue-700 transition uppercase tracking-widest text-xs">Update Perubahan</button>
                <a href="{{ route('nasabah.index') }}" class="px-8 py-4 bg-gray-100 text-gray-500 rounded-2xl font-black text-xs uppercase tracking-widest text-center flex items-center">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection