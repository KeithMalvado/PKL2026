<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel jejak/audit pengaduan (pgdn_log).
 * Mencatat tiap perubahan status/disposisi: siapa, kapan, aksi apa.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pgdn_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pgdn_id')->constrained('pgdn')->cascadeOnDelete();
            $table->foreignId('pgn_id')->nullable()   // petugas pelaku aksi (null = sistem)
                ->constrained('users')->nullOnDelete();
            $table->string('aksi');                    // mis. "verifikasi", "disposisi", "tolak"
            $table->string('sts_lama', 20)->nullable();
            $table->string('sts_baru', 20)->nullable();
            $table->text('ket')->nullable();           // keterangan tambahan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pgdn_log');
    }
};
