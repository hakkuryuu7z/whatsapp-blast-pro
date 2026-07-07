<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlastLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'receiver_name',
        'receiver_number',
        'message_sent',
        'status'
    ];

    // Relasi balik ke tabel User (Siapa yang ngirim pesan ini)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}