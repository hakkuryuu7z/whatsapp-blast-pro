<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'WA Blast Pro') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 bg-gray-100 overflow-hidden">
        
        <div class="flex h-screen w-full">
            
            <aside class="w-64 bg-slate-900 text-white flex flex-col shadow-xl z-20">
                <div class="h-16 flex items-center justify-center border-b border-slate-800 px-4">
                    <i class="fa-brands fa-whatsapp text-green-500 text-3xl mr-3"></i>
                    <span class="text-xl font-bold tracking-wide">WA BLAST <span class="text-green-500">PRO</span></span>
                </div>

                <nav class="flex-1 overflow-y-auto py-6 px-3 space-y-2">
                    
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <i class="fa-solid fa-chart-pie w-6 text-center mr-2"></i> 
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <a href="{{ route('devices') }}" class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('devices') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <i class="fa-solid fa-mobile-screen w-6 text-center mr-2"></i> 
                        <span class="font-medium">Koneksi WA</span>
                    </a>

                    <a href="{{ route('blast') }}" class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('blast') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <i class="fa-solid fa-paper-plane w-6 text-center mr-2"></i> 
                        <span class="font-medium">Blast Pesan</span>
                    </a>

                    @if(Auth::user()->role === 'admin')
                    <div class="pt-6 pb-2">
                        <p class="px-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Administrator</p>
                    </div>
                    
                    <a href="{{ route('admin.users') }}" class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.users') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <i class="fa-solid fa-users-gear w-6 text-center mr-2"></i> 
                        <span class="font-medium">Manajemen User</span>
                    </a>
                    @endif

                </nav>

                <div class="p-4 border-t border-slate-800 bg-slate-950">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-500 to-blue-700 flex items-center justify-center text-white font-bold text-lg border-2 border-slate-700">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="ml-3 overflow-hidden">
                            <p class="text-sm font-bold truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-slate-400 capitalize">{{ Auth::user()->role }}</p>
                        </div>
                    </div>
                </div>
            </aside>

            <div class="flex-1 flex flex-col h-screen overflow-hidden bg-slate-50">
                
                <header class="h-16 bg-white shadow-sm flex items-center justify-between px-8 border-b border-gray-200 z-10">
                    <div class="flex items-center">
                        @isset($header)
                            {{ $header }}
                        @endisset
                    </div>

                    <div class="flex items-center space-x-3">
                        
                        <a href="{{ route('profile.edit') }}" class="text-sm font-bold text-slate-600 hover:text-blue-600 bg-slate-50 hover:bg-blue-50 px-4 py-2 rounded-lg transition-colors flex items-center border border-slate-200 shadow-sm">
                            <i class="fa-solid fa-user-pen mr-2"></i> Edit Profil
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm font-bold text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 px-4 py-2 rounded-lg transition-colors flex items-center border border-red-100 shadow-sm">
                                <i class="fa-solid fa-right-from-bracket mr-2"></i> Keluar
                            </button>
                        </form>
                    </div>
                </header>

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 p-6 md:p-8">
                    {{ $slot }}
                </main>

            </div>
        </div>
    </body>
</html>