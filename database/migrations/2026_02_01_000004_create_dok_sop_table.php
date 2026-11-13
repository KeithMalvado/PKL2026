<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel dokumen SOP / standar pelayanan / SK (berkas pdf).
 * jenis: sop | standar | sk
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dok_sop', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('jenis', 20)->default('sop');
            $table->string('file');
            $table->unsignedSmallInteger('thn')->nullable();
            $table->unsignedSmallInteger('urut')->default(0);
            $table->timestamps();

            $table->index(['jenis', 'urut']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dok_sop');
    }
};
