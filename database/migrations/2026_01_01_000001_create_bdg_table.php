<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel master bidang (bdg).
 * Berisi 4 bidang teknis dinas. Dipakai utk relasi petugas & disposisi pengaduan.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bdg', function (Blueprint $table) {
            $table->id();
            $table->string('nama');           // nama bidang
            $table->string('slug')->unique(); // utk url
            $table->string('kode', 20)->nullable(); // kode singkat bidang
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bdg');
    }
};
