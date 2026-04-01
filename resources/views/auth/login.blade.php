<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Bank Sampah DLH Banjarmasin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-green-50 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl border border-green-100">
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-green-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-3xl font-extrabold shadow-lg">
                BS
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Bank Sampah Digital</h2>
            <p class="text-green-600 font-medium text-sm mt-1">Dinas Lingkungan Hidup Kota Banjarmasin</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-5">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Alamat Email</label>
                <input class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 outline-none transition duration-200 @error('email') border-red-500 @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Masukkan email anda">
                @error('email')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                <input class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 outline-none transition duration-200 @error('password') border-red-500 @enderror" id="password" type="password" name="password" required placeholder="••••••••">
                @error('password')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <button class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg shadow-md transition duration-300" type="submit">
                Masuk ke Sistem
            </button>
        </form>
    </div>
</body>
</html>