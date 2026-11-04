<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel berita (brt).
 * Dipakai utk Berita PPID & Info Kegiatan, dibedakan kolom 'jenis'.
 * jenis: ppid | kegiatan
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brt', function (Blueprint $table) {
            $table->id();
            $table->string('jenis', 20)->default('ppid'); // ppid | kegiatan
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('ringkasan')->nullable();
            $table->longText('isi');
            $table->string('gambar')->nullable();
            $table->foreignId('pgn_id')->nullable()        // penulis/petugas
                ->constrained('users')->nullOnDelete();
            $table->boolean('terbit')->default(true);
            $table->timestamp('tgl_terbit')->nullable();
            $table->unsignedInteger('dilihat')->default(0);
            $table->timestamps();

            $table->index(['jenis', 'terbit']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('brt');
    }
};
