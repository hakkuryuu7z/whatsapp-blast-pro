<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlastLog;
use Illuminate\Support\Facades\Auth;

class BlastController extends Controller
{
    // Menampilkan halaman web blast
    public function index()
    {
        return view('blast.index');
    }

    // Menerima data log dari JavaScript dan menyimpannya ke MySQL
    public function storeLog(Request $request)
    {
        $request->validate([
            'receiver_name' => 'nullable|string',
            'receiver_number' => 'required|string',
            'message_sent' => 'required|string',
            'status' => 'required|in:success,failed'
        ]);

        BlastLog::create([
            'user_id' => Auth::id(), // Otomatis ngambil ID user yang lagi login
            'receiver_name' => $request->receiver_name,
            'receiver_number' => $request->receiver_number,
            'message_sent' => $request->message_sent,
            'status' => $request->status,
        ]);

        return response()->json(['success' => true]);
    }
}