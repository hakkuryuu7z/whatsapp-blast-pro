<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - WA Blast Pro</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-slate-50 flex h-screen overflow-hidden">
    
    <div class="hidden lg:flex lg:w-1/2 bg-slate-900 flex-col justify-center items-center relative overflow-hidden shadow-2xl z-10">
        <div class="absolute inset-0 opacity-5" style="background-image: repeating-linear-gradient(45deg, #22c55e 25%, transparent 25%, transparent 75%, #22c55e 75%, #22c55e), repeating-linear-gradient(45deg, #22c55e 25%, transparent 25%, transparent 75%, #22c55e 75%, #22c55e); background-size: 60px 60px; background-position: 0 0, 30px 30px;"></div>

        <div class="z-10 text-center px-12">
            <i class="fa-brands fa-whatsapp text-green-500 text-[100px] mb-6 drop-shadow-[0_0_15px_rgba(34,197,94,0.3)]"></i>
            <h1 class="text-5xl font-bold text-white mb-4 tracking-tight">WA BLAST <span class="text-green-500">PRO</span></h1>
            <p class="text-slate-400 text-lg leading-relaxed">Platform Broadcast & Manajemen Notifikasi WhatsApp Multi-User Terpusat.</p>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center bg-white relative z-20 shadow-[-10px_0_30px_rgba(0,0,0,0.05)]">
        <div class="max-w-md w-full p-8 sm:p-12">
            
            <div class="lg:hidden text-center mb-10">
                <i class="fa-brands fa-whatsapp text-green-500 text-6xl mb-3 drop-shadow-md"></i>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">WA BLAST <span class="text-green-500">PRO</span></h1>
            </div>

            <div class="mb-10">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang!</h2>
                <p class="text-gray-500 text-sm">Silakan masuk menggunakan akun terdaftar Anda.</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700 mb-1">Email Akses</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fa-solid fa-envelope text-gray-400"></i>
                        </div>
                        <input id="email" class="block w-full pl-10 py-2.5 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-xl shadow-sm text-sm transition-all" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="admin@domain.com">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-bold text-gray-700 mb-1">Kata Sandi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fa-solid fa-lock text-gray-400"></i>
                        </div>
                        <input id="password" class="block w-full pl-10 py-2.5 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-xl shadow-sm text-sm transition-all" type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
                </div>

                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 cursor-pointer" name="remember">
                        <span class="ms-2 text-sm font-medium text-gray-600">Ingat Saya</span>
                    </label>
                    
                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-600 hover:text-blue-800 font-bold transition-colors" href="{{ route('password.request') }}">
                            Lupa sandi?
                        </a>
                    @endif
                </div>

                <button type="submit" class="w-full flex justify-center items-center py-3 px-4 rounded-xl shadow-md text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5">
                    MASUK KE SISTEM <i class="fa-solid fa-arrow-right ml-2 mt-0.5"></i>
                </button>
            </form>

            <div class="mt-12 text-center text-xs text-gray-400 font-medium">
                &copy; {{ date('Y') }} WA Blast Pro by Wildan. <br>All rights reserved.
            </div>
        </div>
    </div>
    
</body>
</html>