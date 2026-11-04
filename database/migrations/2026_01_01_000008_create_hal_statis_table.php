<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel konten halaman statis (hal_statis).
 * Menyimpn konten halaman yg dpt diedit admin: sambutan, sejarah,
 * profil tiap bidang & UPTD, alur/SOP, dll.
 * Dibedakan dgn kolom 'kunci' (slug unik tiap halaman).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hal_statis', function (Blueprint $table) {
            $table->id();
            $table->string('kunci')->unique();   // mis. profil.sambutan, profil.sejarah
            $table->string('judul');
            $table->longText('isi')->nullable(); // konten html (rich text)
            $table->string('gambar')->nullable(); // gambar pendukung (mis. foto kadis)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hal_statis');
    }
};
