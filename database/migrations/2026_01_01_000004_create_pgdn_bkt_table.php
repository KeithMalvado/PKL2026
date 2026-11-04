<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel bukti/lampiran pengaduan (pgdn_bkt).
 * Satu pengaduan bisa punya banyak bukti (foto/dokumen).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pgdn_bkt', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pgdn_id')->constrained('pgdn')->cascadeOnDelete();
            $table->string('path');            // lokasi file di storage
            $table->string('nama_asli');       // nama file asli
            $table->string('tipe', 50)->nullable(); // mime/jenis
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pgdn_bkt');
    }
};
