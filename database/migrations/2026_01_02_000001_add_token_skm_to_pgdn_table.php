<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tambah token survei SKM ke tabel pgdn.
 * Dipakai utk link survei publik unik per tiket setelah pengaduan selesai.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pgdn', function (Blueprint $table) {
            $table->string('token_skm', 40)->nullable()->unique()->after('tgl_selesai');
        });
    }

    public function down(): void
    {
        Schema::table('pgdn', function (Blueprint $table) {
            $table->dropColumn('token_skm');
        });
    }
};
