<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel produk hukum & kebijakan (prod_hkm).
 * Menyimpn dokumen regulasi yg dpt diunduh publik.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prod_hkm', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('jenis')->nullable();   // perda/perbup/sk/dll
            $table->string('no_dok')->nullable();  // nomor dokumen
            $table->year('thn')->nullable();
            $table->string('file');                // path file pdf
            $table->text('ket')->nullable();
            $table->unsignedInteger('diunduh')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prod_hkm');
    }
};
