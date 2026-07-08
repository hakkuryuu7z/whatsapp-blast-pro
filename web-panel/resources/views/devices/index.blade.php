<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Koneksi Perangkat
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-8 border border-gray-200 text-center relative min-h-[400px]">

                <div class="flex justify-between items-center mb-6 pb-4 border-b">
                    <h3 class="text-2xl font-bold text-gray-800">Status Koneksi WhatsApp</h3>
                    <span class="text-xs font-semibold bg-blue-100 text-blue-700 px-3 py-1 rounded-full">Engine: Baileys</span>
                </div>

                <div id="loading-state" class="flex flex-col items-center justify-center py-10">
                    <i class="fa-solid fa-spinner fa-spin text-4xl text-blue-500 mb-4"></i>
                    <p id="loading-text" class="text-gray-600 font-medium">Menghubungkan ke WA Engine...</p>
                </div>

                <div id="qr-state" class="hidden flex-col items-center justify-center py-5">
                    <div class="bg-white p-4 rounded-xl shadow-md border border-gray-200 mb-4 inline-block">
                        <img id="qr-image" src="" alt="QR Code" class="w-64 h-64 object-contain">
                    </div>
                    <h4 class="text-lg font-bold text-gray-800 mb-1">Scan QR Code</h4>
                    <p class="text-sm text-gray-500">
                        Buka WhatsApp di HP > Perangkat Taut > Scan QR di atas.
                    </p>
                </div>

                <div id="connected-state" class="hidden flex-col items-center justify-center py-10">
                    <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mb-4 border-4 border-green-200 shadow-inner">
                        <i class="fa-brands fa-whatsapp text-5xl text-green-500"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-800">Terhubung!</h4>
                    <p class="text-gray-500 mt-2 font-medium">WhatsApp Engine siap digunakan untuk Blast.</p>
                </div>

                <div id="error-state" class="hidden flex-col items-center justify-center py-10 text-center">
                    <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fa-solid fa-triangle-exclamation text-4xl text-red-500"></i>
                    </div>
                    <h4 class="text-lg font-bold text-gray-800">Engine Tidak Merespons</h4>
                    <p class="text-gray-500 text-sm mt-1">Pastikan Node.js (wa-engine) sudah berjalan di terminal.</p>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loadingState = document.getElementById('loading-state');
            const qrState = document.getElementById('qr-state');
            const connectedState = document.getElementById('connected-state');
            const errorState = document.getElementById('error-state');
            const qrImage = document.getElementById('qr-image');
            const loadingText = document.getElementById('loading-text');

            let lastQrData = '';
            // Mengambil ID User Laravel yang sedang login
            const userId = '{{ Auth::user()->id }}';

            async function checkStatus() {
                try {
                    // API sekarang WAJIB bawa parameter session
                    const response = await fetch(`https://wablast.hakkuryuu7z.my.id:3000/api/status?session=${userId}`);
                    const data = await response.json();
                    
                    errorState.classList.add('hidden');
                    errorState.classList.remove('flex');

                    if (data.connected) {
                        loadingState.classList.replace('flex', 'hidden');
                        qrState.classList.replace('flex', 'hidden');
                        connectedState.classList.replace('hidden', 'flex');
                    } 
                    else if (data.qr && data.qr !== '') {
                        loadingState.classList.replace('flex', 'hidden');
                        connectedState.classList.replace('flex', 'hidden');
                        qrState.classList.replace('hidden', 'flex');

                        if (lastQrData !== data.qr) {
                            lastQrData = data.qr;
                            qrImage.src = data.qr; 
                        }
                    }
                    else {
                        qrState.classList.replace('flex', 'hidden');
                        connectedState.classList.replace('flex', 'hidden');
                        loadingState.classList.replace('hidden', 'flex');
                        loadingText.innerText = "Menyiapkan QR Code dari Server...";
                    }
                } catch (err) {
                    loadingState.classList.replace('flex', 'hidden');
                    qrState.classList.replace('flex', 'hidden');
                    connectedState.classList.replace('flex', 'hidden');
                    errorState.classList.replace('hidden', 'flex');
                }
            }

            // Fungsi baru untuk logout (membawa session id)
            window.logoutDevice = async function() {
                if (confirm('Yakin ingin mengeluarkan WhatsApp ini?')) {
                    try {
                        await fetch('https://wablast.hakkuryuu7z.my.id:3000/logout', { 
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ session: userId })
                        });
                        alert('Koneksi diputus. Silakan tunggu QR baru.');
                        connectedState.classList.replace('flex', 'hidden');
                        loadingState.classList.replace('hidden', 'flex');
                    } catch (e) {
                        alert('Gagal memutuskan koneksi');
                    }
                }
            }

            checkStatus();
            setInterval(checkStatus, 3000);
        });
    </script>
</x-app-layout>