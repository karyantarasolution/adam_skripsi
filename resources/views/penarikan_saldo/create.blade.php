@extends('layouts.app')

@section('title', 'Form Penarikan')
@section('header', 'Tarik Saldo Nasabah')

@section('content')
<div class="bg-white p-6 rounded-lg shadow border border-green-100 max-w-2xl">
    <form action="{{ route('penarikan-saldo.store') }}" method="POST">
        @csrf
        
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Pilih Nasabah (Yang Punya Saldo)</label>
            <select name="nasabah_id" required class="w-full px-4 py-2 border rounded-lg focus:border-green-500 outline-none">
                <option value="">-- Pilih Warga --</option>
                @foreach($nasabah as $n)
                    <option value="{{ $n->id }}">
                        {{ $n->user->name }} (Saldo Saat Ini: Rp {{ number_format($n->saldo->jumlah_saldo, 0, ',', '.') }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Jumlah Uang Yang Ditarik (Rp)</label>
            <input type="number" name="jumlah_tarik" required placeholder="Contoh: 50000" class="w-full px-4 py-2 border rounded-lg focus:border-green-500 outline-none">
            @error('jumlah_tarik') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Tanggal Penarikan</label>
            <input type="date" name="tanggal_tarik" value="{{ date('Y-m-d') }}" required class="w-full px-4 py-2 border rounded-lg focus:border-green-500 outline-none">
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-bold shadow transition">
                💸 Cairkan Uang Sekarang
            </button>
            <a href="{{ route('penarikan-saldo.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-lg font-bold shadow transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection