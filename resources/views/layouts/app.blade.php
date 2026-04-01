<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - Bank Sampah DLH</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased flex h-screen overflow-hidden">
    <aside class="w-64 bg-green-900 text-white flex flex-col shadow-xl">
        <div class="p-6 border-b border-green-800 text-center">
            <h1 class="text-2xl font-black tracking-tighter text-green-400">SI-BASAM</h1>
            <p class="text-[10px] uppercase tracking-widest text-green-300 opacity-70">Banjarmasin Smart City</p>
        </div>
        <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-green-800 rounded-xl text-sm font-bold hover:bg-green-700 transition">
                <span>🏠</span> Dashboard
            </a>
            @if(Auth::user()->role === 'super_admin')
                <div class="pt-4 pb-2 px-4 text-[10px] font-bold text-green-500 uppercase tracking-widest">Menu Utama</div>
                <a href="{{ route('kategori-sampah.index') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-green-800 rounded-xl text-sm font-medium transition">
                    <span>📦</span> Kategori Sampah
                </a>
                <a href="{{ route('unit-bank-sampah.index') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-green-800 rounded-xl text-sm font-medium transition">
                    <span>🏢</span> Unit Bank Sampah
                </a>
            @endif
            @if(Auth::user()->role === 'admin_unit')
                <div class="pt-4 pb-2 px-4 text-[10px] font-bold text-green-500 uppercase tracking-widest">Operasional</div>
                <a href="{{ route('nasabah.index') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-green-800 rounded-xl text-sm font-medium transition">
                    <span>👥</span> Data Nasabah
                </a>
                <a href="{{ route('setoran-sampah.index') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-green-800 rounded-xl text-sm font-medium transition">
                    <span>⚖️</span> Timbang Sampah
                </a>
                <a href="{{ route('penarikan-saldo.index') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-green-800 rounded-xl text-sm font-medium transition">
                    <span>💸</span> Tarik Saldo
                </a>
            @endif
        </nav>
        <div class="p-4 border-t border-green-800 bg-green-950/50">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white border border-red-500/20 rounded-xl text-xs font-black transition uppercase">
                    <span>🚪</span> Keluar Sesi
                </button>
            </form>
        </div>
    </aside>
    <div class="flex-1 flex flex-col overflow-hidden">
        <header class="bg-white shadow-sm px-8 py-4 flex justify-between items-center z-10 border-b border-gray-100">
            <h2 class="text-xl font-black text-gray-800 tracking-tight">
                @yield('header', 'Halaman Utama')
            </h2>
            <div class="flex items-center gap-4">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-gray-900 leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-green-600 font-black uppercase mt-1 tracking-tighter">{{ str_replace('_', ' ', Auth::user()->role) }}</p>
                </div>
                <div class="w-10 h-10 bg-green-100 text-green-700 rounded-2xl flex items-center justify-center font-black text-lg shadow-sm border border-green-200">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </header>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-8">
            @yield('content')
        </main>
    </div>
</body>
</html>