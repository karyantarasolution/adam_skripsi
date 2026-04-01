@extends('layouts.app')

@section('title', 'Akun Belum Aktif')
@section('header', 'Menunggu Aktivasi Petugas')

@section('content')
<div class="bg-white p-10 rounded-2xl shadow border border-yellow-100 text-center max-w-2xl mx-auto">
    <div class="text-6xl mb-4">⏳</div>
    <h3 class="text-2xl font-bold text-gray-800">Halo, {{ Auth::user()->name }}!</h3>
    <p class="text-gray-600 mt-2">
        Akun login kamu sudah aktif, tapi **Profil Nasabah** kamu belum didaftarkan oleh Admin Unit Bank Sampah.
    </p>
    <div class="mt-6 p-4 bg-yellow-50 rounded-lg border border-yellow-200 text-yellow-800 text-sm">
        Silakan hubungi petugas Bank Sampah di wilayahmu untuk mendaftarkan <b>NIK dan Alamat</b> agar buku tabungan digitalmu muncul di sini.
    </div>
</div>
@endsection