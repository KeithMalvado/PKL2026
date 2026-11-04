<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel video kegiatan (glr_vid).
 * Menyimpn tautan video (mis. YouTube) + thumbnail.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('glr_vid', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('url');               // tautan video (embed/youtube)
            $table->string('thumbnail')->nullable();
            $table->text('ket')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('glr_vid');
    }
};
