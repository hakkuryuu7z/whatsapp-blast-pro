<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlastLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Mengambil data log khusus milik user yang sedang login
        $logQuery = BlastLog::where('user_id', $user->id);

        $totalPesan = (clone $logQuery)->count();
        $sukses = (clone $logQuery)->where('status', 'success')->count();
        $gagal = (clone $logQuery)->where('status', 'failed')->count();

        // Ambil 10 riwayat pengiriman terakhir
        $riwayat = $logQuery->latest()->limit(10)->get();

        // Khusus Admin: Tampilkan total pengguna yang terdaftar di sistem
        $totalUser = $user->role === 'admin' ? User::count() : 0;

        return view('dashboard', compact('totalPesan', 'sukses', 'gagal', 'riwayat', 'totalUser'));
    }
}