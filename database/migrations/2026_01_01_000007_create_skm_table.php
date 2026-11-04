<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel Survei Kepuasan Masyarakat (skm).
 * Diisi pelapor setelah pengaduan selesai, via link survei.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pgdn_id')->constrained('pgdn')->cascadeOnDelete();
            $table->unsignedTinyInteger('skor');     // nilai 1-5
            $table->text('saran')->nullable();       // masukan pelapor
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skm');
    }
};
