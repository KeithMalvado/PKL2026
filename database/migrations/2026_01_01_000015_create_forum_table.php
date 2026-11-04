<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel forum konsultasi (forum).
 * Publik dpt bertanya tanpa login. Tampil setelah dimoderasi petugas.
 * sts: tunggu | tampil | tolak
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('forum', function (Blueprint $table) {
            $table->id();
            $table->string('nama');              // nama penanya
            $table->string('email')->nullable();
            $table->string('judul');
            $table->text('pertanyaan');
            $table->string('kat')->nullable();   // kategori topik
            $table->string('sts', 20)->default('tunggu'); // moderasi
            $table->timestamps();

            $table->index('sts');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forum');
    }
};
