const express = require('express');
const { Client, LocalAuth } = require('whatsapp-web.js');
const cors = require('cors');

const app = express();
app.use(cors());
app.use(express.json());

// Inisialisasi Client
const client = new Client({
    authStrategy: new LocalAuth(),
    puppeteer: {
        headless: true, // tetep true, tapi argumennya kita benerin
        args: [
            '--no-sandbox',
            '--disable-setuid-sandbox',
            '--disable-dev-shm-usage',
            '--disable-accelerated-2d-canvas',
            '--no-first-run',
            '--no-zygote',
            '--single-process', // Penting buat Windows biar gak rebutan proses
            '--disable-gpu'
        ]
    }
});

let isConnected = false;
let qrCodeData = '';

// Event lifecycle
client.on('qr', (qr) => {
    qrCodeData = qr;
    console.log('QR Code received. Scan in terminal or web!');
});

client.on('ready', () => {
    isConnected = true;
    qrCodeData = '';
    console.log('WhatsApp Client is Ready!');
});

client.on('disconnected', (reason) => {
    isConnected = false;
    console.log('Disconnected:', reason);
    client.initialize(); // Auto re-init jika putus
});

// Jalankan Client
client.initialize();

// API Endpoints
app.get('/api/status', (req, res) => {
    res.json({
        connected: isConnected,
        qr: isConnected ? null : qrCodeData
    });
});

app.post('/api/send-message', async (req, res) => {
    const { number, message } = req.body;

    if (!isConnected) {
        return res.status(500).json({ status: 'error', message: 'Client not ready' });
    }

    try {
        const chatId = number.includes('@c.us') ? number : `${number}@c.us`;
        // Gunakan metode yang benar untuk versi stabil
        await client.sendMessage(chatId, message);
        res.json({ status: 'success', message: 'Message sent' });
    } catch (error) {
        res.status(500).json({ status: 'error', message: error.message });
    }
});

const PORT = 3000;
app.listen(PORT, () => {
    console.log(`WA Engine running on port ${PORT}`);
});