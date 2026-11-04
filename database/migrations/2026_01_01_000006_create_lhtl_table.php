<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel Laporan Hasil Tindak Lanjut (lhtl).
 * Diisi tim teknis setelah menindaklanjuti pengaduan di lapangan.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lhtl', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pgdn_id')->constrained('pgdn')->cascadeOnDelete();
            $table->foreignId('pgn_id')              // tim teknis penyusun
                ->constrained('users')->cascadeOnDelete();
            $table->text('uraian');                  // uraian hasil tindak lanjut
            $table->string('foto')->nullable();      // foto bukti lapangan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lhtl');
    }
};
