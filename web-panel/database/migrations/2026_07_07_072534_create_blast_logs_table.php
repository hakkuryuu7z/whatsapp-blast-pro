<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
    {
        Schema::create('blast_logs', function (Blueprint $table) {
            $table->id();
            // Menyambungkan log dengan siapa user yang nge-blast
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('receiver_name')->nullable();
            $table->string('receiver_number');
            $table->text('message_sent');
            $table->enum('status', ['success', 'failed']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blast_logs');
    }
};
