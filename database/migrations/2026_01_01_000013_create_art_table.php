<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel artikel & jurnal (art).
 * jenis: artikel | jurnal
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('art', function (Blueprint $table) {
            $table->id();
            $table->string('jenis', 20)->default('artikel'); // artikel | jurnal
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('penulis')->nullable();
            $table->text('ringkasan')->nullable();
            $table->longText('isi')->nullable();
            $table->string('gambar')->nullable();
            $table->string('file')->nullable();   // berkas jurnal (pdf) bila ada
            $table->boolean('terbit')->default(true);
            $table->timestamp('tgl_terbit')->nullable();
            $table->timestamps();

            $table->index(['jenis', 'terbit']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('art');
    }
};
