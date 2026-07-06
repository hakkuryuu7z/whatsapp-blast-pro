<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WA Blast - Admin Panel</title>
    @vite('resources/css/app.css')
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-admin-bg text-admin-text font-sans antialiased">
    
    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-64 bg-admin-sidebar text-white flex flex-col shadow-lg">
            <div class="h-16 flex items-center justify-center border-b border-gray-700">
                <h1 class="text-xl font-bold tracking-wider">
                    <i class="fa-brands fa-whatsapp text-green-400 mr-2"></i>WA Blast
                </h1>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="#" class="flex items-center px-4 py-3 bg-gray-700 rounded-lg text-white transition-colors">
                    <i class="fa-solid fa-gauge-high w-6"></i>
                    <span class="ml-2 font-medium">Dashboard</span>
                </a>
                <a href="/devices" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors">
                    <i class="fa-solid fa-mobile-screen-button w-6"></i>
                    <span class="ml-2 font-medium">Devices</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors">
                    <i class="fa-solid fa-users w-6"></i>
                    <span class="ml-2 font-medium">Contacts</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors">
                    <i class="fa-solid fa-bullhorn w-6"></i>
                    <span class="ml-2 font-medium">Campaigns</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors">
                    <i class="fa-solid fa-chart-pie w-6"></i>
                    <span class="ml-2 font-medium">Reports</span>
                </a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            
            <header class="h-16 bg-white shadow-sm flex items-center justify-between px-6 z-10">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">@yield('page_title', 'Dashboard')</h2>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center cursor-pointer text-gray-600 hover:text-admin-primary transition-colors">
                        <i class="fa-solid fa-circle-user text-2xl mr-2"></i>
                        <span class="font-medium text-sm">Administrator</span>
                        <i class="fa-solid fa-chevron-down text-xs ml-2"></i>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-admin-bg p-6">
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    @yield('content')
                </div>
            </main>
            
        </div>
    </div>

</body>
</html>