<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel galeri foto (glr_foto).
 * Foto dpt dikelompokkn per album lewat kolom 'album'.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('glr_foto', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('album')->nullable();
            $table->string('path');              // lokasi file foto
            $table->text('ket')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('glr_foto');
    }
};
