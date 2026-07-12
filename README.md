# 🚀 WA Blast Pro

**Platform Broadcast & Manajemen Notifikasi WhatsApp Multi-User Terpusat.**

WA Blast Pro adalah aplikasi berbasis web yang dirancang untuk mengelola sesi WhatsApp dan melakukan pengiriman pesan massal (*blasting*) secara mandiri. Dibangun dengan memisahkan antara antarmuka manajemen (Frontend/Backend) dan mesin pemroses WhatsApp (Engine), aplikasi ini menawarkan stabilitas dan keamanan tinggi di dalam lingkungan *containerized*.

---

## 🎯 Tujuan Proyek

1. **Independensi Sistem Notifikasi:** Menyediakan infrastruktur pengiriman pesan WhatsApp secara mandiri tanpa harus bergantung pada layanan API pihak ketiga yang berbayar atau memiliki batasan *limit*.
2. **Sentralisasi Operasional:** Mempermudah pemantauan dan pengelolaan pesan keluar dari berbagai *user* dalam satu *dashboard* terpusat. Cocok untuk kebutuhan operasional harian, pelaporan data (seperti laporan rekapitulasi atau notifikasi sistem), hingga komunikasi massal.
3. **Keamanan & Isolasi Data:** Menggunakan arsitektur Docker untuk mengisolasi proses mesin WhatsApp dan aplikasi *web*, serta menerapkan protokol HTTPS yang ketat di belakang *Reverse Proxy* untuk melindungi privasi data.

---

## 💡 Informasi & Fitur Utama

- **Multi-Session Engine:** Mendukung pembuatan sesi WhatsApp baru melalui *scan* QR Code secara langsung dari *dashboard*.
- **Manajemen Pengguna (RBAC):** Dilengkapi dengan sistem autentikasi dan otorisasi *multi-user* (Super Admin & User Biasa) untuk membatasi akses ke fitur-fitur kritikal.
- **Tampilan UI/UX Profesional:** Mengusung antarmuka *Dark Mode* modern yang responsif dan nyaman digunakan untuk *monitoring* dalam waktu lama.
- **Arsitektur Microservices (Dockerized):**
  - `wa_blast_app`: Container utama untuk antarmuka Laravel.
  - `wa_blast_engine`: Container Node.js khusus menjalankan modul Baileys untuk koneksi ke server WhatsApp.
  - `wa_blast_nginx`: Container Web Server sebagai jembatan (*reverse proxy*) antara *user* dan sistem.
- **Troubleshooting Terpusat:** Penanganan status *disconnected* atau *session expired* dapat di-reset langsung tanpa mematikan *server* utama.

---

## 🛠️ Tech Stack

**Aplikasi & Engine:**
- **Web Framework:** [Laravel](https://laravel.com/) (PHP)
- **WhatsApp API Library:** [@whiskeysockets/baileys](https://github.com/WhiskeySockets/Baileys) (Node.js)
- **Database:** MySQL
- **Frontend Styling:** Vite, CSS (Dark Theme Customization)

**Infrastruktur & Deployment:**
- **Containerization:** Docker & Docker Compose
- **Web Server:** Nginx
- **Security & DNS:** Cloudflare (SSL/TLS Strict Mode)

---

## 🔒 Catatan Keamanan

- Semua *request* ke Node.js Engine dialihkan melalui Nginx Reverse Proxy (`/wa-engine/`) untuk menghindari isu *Mixed Content* dan pemblokiran Port.
- Direktori penyimpanan sesi (Credentials) harus dibersihkan secara berkala atau saat terjadi pergantian nomor untuk menghindari tabrakan sesi.

---
*© 2026 WA Blast Pro by Hakkuryuu7z. All rights reserved.*
