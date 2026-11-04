<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel balasan forum (forum_balas).
 * Jawaban dr petugas atas pertanyaan forum.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('forum_balas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('forum_id')->constrained('forum')->cascadeOnDelete();
            $table->foreignId('pgn_id')->nullable()   // petugas penjawab
                ->constrained('users')->nullOnDelete();
            $table->text('isi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forum_balas');
    }
};
