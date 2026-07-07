<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Sandi - WA Blast Pro</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-slate-50 flex h-screen overflow-hidden items-center justify-center relative">

    <div class="absolute top-0 left-0 w-full h-64 bg-slate-900 z-0 shadow-lg">
        <div class="absolute inset-0 opacity-10" style="background-image: repeating-linear-gradient(45deg, #22c55e 25%, transparent 25%, transparent 75%, #22c55e 75%, #22c55e); background-size: 60px 60px;"></div>
    </div>

    <div class="max-w-md w-full bg-white p-8 sm:p-10 rounded-2xl shadow-xl relative z-10 border border-gray-100 mx-4">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 border border-blue-100 shadow-inner">
                <i class="fa-solid fa-shield-halved text-3xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Lupa Kata Sandi?</h2>
            <p class="text-gray-500 text-sm mt-2 leading-relaxed">Masukkan email Anda yang terdaftar. Kami akan mengirimkan tautan untuk membuat kata sandi baru.</p>
        </div>

        <x-auth-session-status class="mb-4 text-center bg-green-50 text-green-600 p-3 rounded-lg text-sm font-bold" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            
            <div class="mb-8">
                <label for="email" class="block text-sm font-bold text-gray-700 mb-1">Email Terdaftar</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <i class="fa-solid fa-envelope text-gray-400"></i>
                    </div>
                    <input id="email" class="block w-full pl-10 py-2.5 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-xl shadow-sm text-sm transition-all" type="email" name="email" :value="old('email')" required autofocus placeholder="admin@domain.com">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500" />
            </div>

            <div class="flex items-center justify-between">
                <a class="text-sm text-gray-500 hover:text-blue-600 font-bold transition-colors flex items-center" href="{{ route('login') }}">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
                </a>
                
                <button type="submit" class="py-2.5 px-5 rounded-xl shadow-md text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5">
                    Kirim Link <i class="fa-solid fa-paper-plane ml-2"></i>
                </button>
            </div>
        </form>
    </div>
    
</body>
</html>