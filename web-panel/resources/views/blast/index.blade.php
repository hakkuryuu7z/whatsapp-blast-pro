<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kirim Pesan Masal
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <div class="lg:col-span-5 bg-white border border-gray-200 rounded-2xl shadow-sm p-6">
            <h4 class="text-lg font-bold text-gray-800 mb-5 border-b border-gray-100 pb-3">
                <i class="fa-solid fa-paper-plane text-blue-500 mr-2"></i> Pengaturan Blast
            </h4>
            
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">1. Target Kontak (CSV)</label>
                <input type="file" id="csv-file" accept=".csv" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-200 rounded-lg focus:outline-none">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">2. Gambar / Media (Opsional)</label>
                <input type="file" id="media-file" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 border border-gray-200 rounded-lg focus:outline-none">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">3. Isi Pesan / Caption</label>
                
                <div class="flex flex-wrap gap-2 mb-2">
                    <button type="button" onclick="insertTemplate('{nama}')" class="text-xs bg-blue-50 text-blue-600 hover:bg-blue-100 font-medium px-2.5 py-1.5 rounded-md border border-blue-200 transition-colors">
                        <i class="fa-solid fa-user mr-1"></i> + Sisipkan Nama
                    </button>
                    <button type="button" onclick="insertTemplate('{Halo|Hai|Selamat pagi}')" class="text-xs bg-purple-50 text-purple-600 hover:bg-purple-100 font-medium px-2.5 py-1.5 rounded-md border border-purple-200 transition-colors">
                        <i class="fa-solid fa-shuffle mr-1"></i> + Sapaan Acak
                    </button>
                    <button type="button" onclick="insertTemplate('{Promo|Diskon|Penawaran spesial}')" class="text-xs bg-green-50 text-green-600 hover:bg-green-100 font-medium px-2.5 py-1.5 rounded-md border border-green-200 transition-colors">
                        <i class="fa-solid fa-tags mr-1"></i> + Kata Promo
                    </button>
                </div>

                <textarea id="message-text" rows="5" class="w-full bg-gray-50 border border-gray-300 rounded-xl p-3 text-sm text-gray-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" placeholder="Ketik pesan Anda di sini..."></textarea>
                <p class="text-xs text-gray-500 mt-1">Gunakan tombol bantuan di atas agar pesan lebih bervariasi dan meminimalisir blokir WA.</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">4. Teks Footer (Opsional)</label>
                <input type="text" id="footer-text" class="w-full bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-sm text-gray-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" placeholder="Misal: CS: 0812345678">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-1">5. Jeda Pengiriman</label>
                <div class="flex items-center space-x-2">
                    <input type="number" id="delay-time" value="3" min="1" class="w-20 bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm text-center text-gray-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <span class="text-sm text-gray-500 font-medium">Detik / Pesan</span>
                </div>
            </div>

            <button id="btn-start" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl transition-colors shadow-md hover:shadow-lg flex justify-center items-center">
                <i class="fa-solid fa-rocket mr-2"></i> Mulai Kirim Pesan
            </button>
        </div>

        <div class="lg:col-span-7 bg-white border border-gray-200 rounded-2xl shadow-sm p-6 flex flex-col h-full">
            
            <div class="flex justify-between items-center mb-5">
                <h4 class="text-lg font-bold text-gray-800">
                    <i class="fa-solid fa-chart-line text-green-500 mr-2"></i> Live Monitor
                </h4>
                <div class="flex space-x-4 bg-gray-50 px-4 py-2 rounded-lg border border-gray-200">
                    <span class="text-sm font-semibold text-gray-600">Total: <span id="count-total" class="text-blue-600">0</span></span>
                    <span class="text-sm font-semibold text-gray-600">Sukses: <span id="count-success" class="text-green-600">0</span></span>
                    <span class="text-sm font-semibold text-gray-600">Gagal: <span id="count-failed" class="text-red-600">0</span></span>
                </div>
            </div>

            <div class="w-full bg-gray-100 rounded-full h-3 mb-5 overflow-hidden border border-gray-200">
                <div id="progress-bar" class="bg-blue-500 h-3 rounded-full transition-all duration-300 relative" style="width: 0%">
                    <div class="absolute inset-0 bg-white/20 w-full h-full" style="background-image: linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent); background-size: 1rem 1rem;"></div>
                </div>
            </div>

            <div class="flex-grow bg-gray-50 rounded-xl p-4 overflow-y-auto min-h-[350px] max-h-[500px] border border-gray-200 shadow-inner">
                <ul id="log-list" class="space-y-2 text-sm font-medium">
                    <li class="text-gray-500 flex items-center">
                        <i class="fa-solid fa-circle-info mr-2 text-blue-400"></i> Sistem siap. Menunggu file target...
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>
    
    <script>
        // FUNGSI UNTUK INSERT TEKS KE DALAM TEXTAREA (Sesuai Posisi Kursor)
        function insertTemplate(text) {
            const textarea = document.getElementById('message-text');
            const startPos = textarea.selectionStart;
            const endPos = textarea.selectionEnd;

            // Menyisipkan teks pada posisi kursor atau menambahkannya di akhir
            textarea.value = textarea.value.substring(0, startPos) + text + textarea.value.substring(endPos, textarea.value.length);
            
            // Kembalikan fokus kursor ke setelah teks yang dimasukkan
            textarea.selectionStart = startPos + text.length;
            textarea.selectionEnd = startPos + text.length;
            textarea.focus();
        }

        // Fungsi Spintax {Halo|Hai}
        function spinText(text) {
            let matches = text.match(/{[^{}]+}/g);
            if (matches) {
                matches.forEach(match => {
                    let options = match.replace(/[{}]/g, '').split('|');
                    let randomOption = options[Math.floor(Math.random() * options.length)];
                    text = text.replace(match, randomOption);
                });
            }
            return text;
        }

        // Fungsi convert File ke Base64 (Untuk Gambar)
        const toBase64 = file => new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = () => resolve(reader.result);
            reader.onerror = error => reject(error);
        });

        document.getElementById('btn-start').addEventListener('click', async function() {
            const fileInput = document.getElementById('csv-file').files[0];
            const mediaInput = document.getElementById('media-file').files[0];
            const messageTemplate = document.getElementById('message-text').value;
            const footerText = document.getElementById('footer-text').value;
            const delayTime = parseInt(document.getElementById('delay-time').value) * 1000;

            if (!fileInput) return alert("Silakan upload file CSV target terlebih dahulu!");
            if (!messageTemplate) return alert("Isi pesan tidak boleh kosong!");

            const btnStart = document.getElementById('btn-start');
            btnStart.disabled = true;
            btnStart.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i> Sedang Memproses...';
            btnStart.classList.replace('bg-blue-600', 'bg-gray-400');
            btnStart.classList.replace('hover:bg-blue-700', 'hover:bg-gray-500');
            
            let imageBase64 = null;
            if (mediaInput) {
                addLog("Mempersiapkan gambar...", "text-blue-600", "fa-image");
                imageBase64 = await toBase64(mediaInput);
            }

            addLog("Membaca data kontak dari CSV...", "text-blue-600", "fa-file-csv");

            Papa.parse(fileInput, {
                header: true,
                skipEmptyLines: true,
                complete: async function(results) {
                    const contacts = results.data;
                    document.getElementById('count-total').innerText = contacts.length;
                    addLog(`Menemukan ${contacts.length} kontak. Memulai proses pengiriman...`, "text-blue-600", "fa-play");
                    
                    await startBlast(contacts, messageTemplate, footerText, imageBase64, delayTime);
                }
            });
        });

        async function startBlast(contacts, template, footer, imageBase64, delay) {
            let success = 0;
            let failed = 0;
            const total = contacts.length;

            for (let i = 0; i < total; i++) {
                const contact = contacts[i];
                
                // Spintax & Nama
                let rawMessage = template.replace(/{nama}/g, contact.nama || 'Kak');
                let finalMessage = spinText(rawMessage);
                
                // Tambah Footer jika ada
                if (footer) {
                    finalMessage += '\n\n' + footer;
                }
                
                // Auto-formatter nomor (Ubah 0 jadi 62)
                let finalNumber = contact.nomor ? contact.nomor.toString().trim().replace(/\D/g, '') : '';
                if (finalNumber.startsWith('0')) {
                    finalNumber = '62' + finalNumber.substring(1);
                }

                if (!finalNumber) {
                    failed++;
                    document.getElementById('count-failed').innerText = failed;
                    addLog(`Dilewati: Baris ke-${i+1} tidak memiliki nomor valid.`, "text-red-500", "fa-triangle-exclamation");
                    continue;
                }
                
                try {
                    const response = await fetch('https://wablast.hakkuryuu7z.my.id/wa-engine/api/send-message', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            session: '{{ Auth::user()->id }}',
                            number: finalNumber,
                            message: finalMessage,
                            imageBase64: imageBase64
                        })
                    });

                    if (response.ok) {
                        success++;
                        document.getElementById('count-success').innerText = success;
                        addLog(`Terkirim ke ${contact.nama} (${finalNumber})`, "text-green-600", "fa-check-circle");
                        
                        // CATAT KE MYSQL JIKA SUKSES
                        await saveLogToDatabase(contact.nama, finalNumber, finalMessage, 'success');
                    } else {
                        throw new Error("Ditolak oleh server");
                    }
                } catch (error) {
                    failed++;
                    document.getElementById('count-failed').innerText = failed;
                    addLog(`Gagal mengirim ke ${contact.nama} (${finalNumber})`, "text-red-500", "fa-xmark-circle");
                    
                    // CATAT KE MYSQL JIKA GAGAL
                    await saveLogToDatabase(contact.nama, finalNumber, finalMessage, 'failed');
                }

                let percent = Math.round(((i + 1) / total) * 100);
                document.getElementById('progress-bar').style.width = percent + '%';

                if (i < total - 1) {
                    await new Promise(r => setTimeout(r, delay));
                }
            }

            const btnStart = document.getElementById('btn-start');
            btnStart.disabled = false;
            btnStart.innerHTML = '<i class="fa-solid fa-rocket mr-2"></i> Mulai Kirim Pesan';
            btnStart.classList.replace('bg-gray-400', 'bg-blue-600');
            btnStart.classList.replace('hover:bg-gray-500', 'hover:bg-blue-700');
            
            addLog("PROSES BROADCAST SELESAI!", "text-blue-700 font-bold bg-blue-50 p-2 rounded-lg mt-2", "fa-flag-checkered");
        }

        // FUNGSI BARU: Mengirim laporan ke database Laravel
        async function saveLogToDatabase(nama, nomor, pesan, status) {
            try {
                await fetch('{{ route("blast.log") }}', {
                    method: 'POST',
                    headers: { 
                        'Content-Type': 'application/json',
                        // Wajib bawa CSRF Token biar nggak diblokir Laravel
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        receiver_name: nama || 'Tanpa Nama',
                        receiver_number: nomor,
                        message_sent: pesan,
                        status: status
                    })
                });
            } catch (e) {
                console.error("Gagal mencatat log ke MySQL:", e);
            }
        }

        function addLog(text, colorClass = "text-gray-700", icon = "fa-arrow-right") {
            const ul = document.getElementById('log-list');
            const li = document.createElement('li');
            li.className = `flex items-start ${colorClass}`;
            li.innerHTML = `<i class="fa-solid ${icon} mt-1 mr-2"></i> <span>${text}</span>`;
            ul.appendChild(li);
            ul.parentElement.scrollTop = ul.parentElement.scrollHeight;
        }
    </script>
</x-app-layout>