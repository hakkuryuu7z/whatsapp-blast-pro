<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Statistik
        </h2>
    </x-slot>

    <div class="space-y-6">
        
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl p-6 text-white shadow-md">
            <h3 class="text-2xl font-bold mb-1">Selamat datang, {{ Auth::user()->name }}!</h3>
            <p class="text-blue-100 opacity-90">Pantau aktivitas broadcast WhatsApp Anda hari ini.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            
            @if(Auth::user()->role === 'admin')
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
                <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center text-xl mr-4">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-500">Total Pengguna SaaS</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalUser }} Akun</p>
                </div>
            </div>
            @endif

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center text-xl mr-4">
                    <i class="fa-solid fa-paper-plane"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-500">Total Terkirim</p>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($totalPesan) }} Pesan</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
                <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center text-xl mr-4">
                    <i class="fa-solid fa-check-double"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-500">Berhasil</p>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($sukses) }}</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
                <div class="w-12 h-12 bg-red-100 text-red-600 rounded-xl flex items-center justify-center text-xl mr-4">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-500">Gagal (Nomor Mati)</p>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($gagal) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h3 class="font-bold text-gray-800"><i class="fa-solid fa-clock-rotate-left mr-2 text-gray-400"></i> Riwayat Blast Terakhir</h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b bg-white text-xs text-gray-500 uppercase tracking-wider">
                            <th class="px-6 py-4 font-bold">Waktu</th>
                            <th class="px-6 py-4 font-bold">Penerima</th>
                            <th class="px-6 py-4 font-bold">Pesan</th>
                            <th class="px-6 py-4 font-bold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($riwayat as $log)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{ $log->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-800 text-sm">{{ $log->receiver_name ?? 'Tanpa Nama' }}</div>
                                <div class="text-xs text-blue-600 font-medium">+{{ $log->receiver_number }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">
                                {{ $log->message_sent }}
                            </td>
                            <td class="px-6 py-4">
                                @if($log->status === 'success')
                                    <span class="px-3 py-1 text-[11px] font-bold rounded-full bg-green-100 text-green-700 uppercase tracking-wide">Sukses</span>
                                @else
                                    <span class="px-3 py-1 text-[11px] font-bold rounded-full bg-red-100 text-red-700 uppercase tracking-wide">Gagal</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                <i class="fa-solid fa-inbox text-4xl mb-3 text-gray-300 block"></i>
                                Belum ada riwayat pengiriman pesan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>