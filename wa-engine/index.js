const express = require('express');
const { default: makeWASocket, useMultiFileAuthState, DisconnectReason } = require('@whiskeysockets/baileys');
const qrcode = require('qrcode');
const cors = require('cors');
const fs = require('fs');

const app = express();
app.use(cors());
app.use(express.json({ limit: '50mb' })); // Limit besar untuk support kirim gambar

// Map untuk menyimpan banyak sesi sekaligus di RAM
const sessions = new Map();

// Fungsi untuk Inisialisasi Sesi per User
async function initSession(sessionId) {
    const sessionFolder = `./sessions/user_${sessionId}`;
    const { state, saveCreds } = await useMultiFileAuthState(sessionFolder);

    const sock = makeWASocket({
        auth: state,
        printQRInTerminal: true // Bisa lu false kalau menuhi terminal
    });

    sock.ev.on('creds.update', saveCreds);

    sock.ev.on('connection.update', async (update) => {
        const { connection, lastDisconnect, qr } = update;
        const sessionData = sessions.get(sessionId) || {};

        if (qr) {
            sessionData.qr = await qrcode.toDataURL(qr);
            sessionData.connected = false;
            sessionData.user = null;
        }

        if (connection === 'close') {
            const shouldReconnect = lastDisconnect.error?.output?.statusCode !== DisconnectReason.loggedOut;
            if (shouldReconnect) {
                console.log(`[!] Sesi ${sessionId} terputus, mencoba reconnect...`);
                initSession(sessionId);
            } else {
                console.log(`[-] Sesi ${sessionId} log out.`);
                sessions.delete(sessionId);
                fs.rmSync(sessionFolder, { recursive: true, force: true });
            }
        } else if (connection === 'open') {
            console.log(`[+] Sesi ${sessionId} berhasil terhubung!`);
            sessionData.qr = null;
            sessionData.connected = true;
            sessionData.user = sock.user.id.split(':')[0];
        }

        sessions.set(sessionId, { ...sessionData, sock });
    });

    sessions.set(sessionId, { sock, qr: null, connected: false });
    return sock;
}

// ---------------- ENDPOINT API ---------------- //

// 1. Cek Status (Diminta oleh halaman Koneksi WA)
app.get('/api/status', async (req, res) => {
    // Menangkap ID User dari URL (contoh: /api/status?session=1)
    const sessionId = req.query.session;
    
    if (!sessionId) {
        return res.status(400).json({ error: 'Parameter session (User ID) wajib diisi' });
    }

    let session = sessions.get(sessionId);

    // Kalau belum ada sesi aktif di RAM, inisialisasi baru
    if (!session) {
        await initSession(sessionId);
        session = sessions.get(sessionId);
    }

    res.json({
        connected: session.connected || false,
        qr: session.qr || null,
        user: session.user || null
    });
});

// 2. Kirim Pesan (Diminta oleh halaman Blast)
app.post('/api/send-message', async (req, res) => {
    const { session, number, message, imageBase64 } = req.body;
    
    if (!session) return res.status(400).json({ status: 'error', message: 'User ID wajib diisi.' });

    const sessionData = sessions.get(session);

    if (!sessionData || !sessionData.connected) {
        return res.status(500).json({ status: 'error', message: 'WhatsApp belum terhubung, silakan scan QR lagi.' });
    }

    try {
        const jid = number.includes('@s.whatsapp.net') ? number : `${number}@s.whatsapp.net`;
        
        if (imageBase64) {
            const base64Data = imageBase64.split(',')[1];
            const buffer = Buffer.from(base64Data, 'base64');
            await sessionData.sock.sendMessage(jid, { image: buffer, caption: message });
        } else {
            await sessionData.sock.sendMessage(jid, { text: message });
        }
        res.json({ status: 'success', message: 'Terkirim' });
    } catch (error) {
        res.status(500).json({ status: 'error', message: error.message });
    }
});

// 3. Logout (Diminta saat user klik Putuskan Koneksi)
app.post('/logout', async (req, res) => {
    const { session } = req.body;
    const sessionData = sessions.get(session);

    if (sessionData && sessionData.sock) {
        sessionData.sock.logout(); // Mengirim perintah logout ke WhatsApp
        sessions.delete(session);
        res.json({ status: 'success', message: 'Koneksi berhasil diputus' });
    } else {
        res.json({ status: 'error', message: 'Sesi tidak ditemukan' });
    }
});

app.listen(3000, () => {
    console.log('🚀 WA Engine Multi-Session running on port 3000');
});