@extends('layouts.app')

@section('page_title', 'Manajemen Perangkat')

@section('content')
    <div class="max-w-2xl mx-auto bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <div class="bg-gray-50 border-b border-gray-200 px-6 py-4">
            <h3 class="text-lg font-bold text-gray-800">Status Koneksi WhatsApp</h3>
        </div>
        
        <div class="p-6 flex flex-col items-center justify-center min-h-[300px]">
            <div id="loading-state" class="text-gray-500 flex flex-col items-center">
                <i class="fa-solid fa-spinner fa-spin text-4xl mb-4 text-admin-primary"></i>
                <p>Menghubungkan ke WA Engine...</p>
            </div>

            <div id="qr-state" class="hidden flex-col items-center">
                <div class="p-2 bg-white border-2 border-gray-200 rounded-lg shadow-sm mb-4">
                    <canvas id="qr-canvas"></canvas>
                </div>
                <p class="text-gray-600 font-medium">Scan QR Code ini menggunakan WhatsApp di HP kamu.</p>
                <p class="text-sm text-gray-400 mt-2">Menunggu scan...</p>
            </div>

            <div id="connected-state" class="hidden flex-col items-center">
                <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mb-4 border-4 border-green-200">
                    <i class="fa-brands fa-whatsapp text-5xl text-green-500"></i>
                </div>
                <h4 class="text-xl font-bold text-gray-800 mb-1">WhatsApp Terhubung!</h4>
                <p class="text-gray-500">Engine siap digunakan untuk mengirim pesan masal.</p>
            </div>
            
            <div id="error-state" class="hidden flex-col items-center text-center">
                <i class="fa-solid fa-triangle-exclamation text-4xl text-red-500 mb-4"></i>
                <h4 class="text-lg font-bold text-gray-800">Engine Tidak Merespons</h4>
                <p class="text-gray-500">Pastikan Node.js (wa-engine) sudah berjalan di background.</p>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcode/1.5.3/qrcode.min.js"></script>
    
    <script>
    async function checkStatus() {
        try {
            const response = await fetch('http://127.0.0.1:3000/api/status');
            const data = await response.json();
            
            document.getElementById('loading-state').classList.add('hidden');
            
            if (data.connected) {
                document.getElementById('connected-state').classList.remove('hidden');
                document.getElementById('qr-state').classList.add('hidden');
            } else if (data.qr) {
                document.getElementById('qr-state').classList.remove('hidden');
                
                // Gunakan Google Chart API untuk render QR (Anti-blokir, anti-error)
                const qrUrl = "https://chart.googleapis.com/chart?cht=qr&chl=" + encodeURIComponent(data.qr) + "&chs=300x300";
                
                const img = document.createElement('img');
                img.src = qrUrl;
                img.className = 'w-64 h-64';
                
                const container = document.getElementById('qr-canvas');
                container.innerHTML = ''; 
                container.appendChild(img);
            }
        } catch (err) {
            document.getElementById('error-state').classList.remove('hidden');
        }
    }

    setInterval(checkStatus, 3000);
    checkStatus();
</script>
@endsection