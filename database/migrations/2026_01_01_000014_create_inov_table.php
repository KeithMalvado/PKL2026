<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel inovasi pelayanan (inov).
 * Program/terobosan unggulan dinas.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inov', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('ringkasan')->nullable();
            $table->longText('isi')->nullable();
            $table->string('gambar')->nullable();
            $table->boolean('terbit')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inov');
    }
};
