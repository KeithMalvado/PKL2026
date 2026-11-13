<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tambah logo & deskripsi singkat pada master bidang.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bdg', function (Blueprint $table) {
            $table->string('logo')->nullable()->after('kode');
            $table->text('deskripsi')->nullable()->after('logo');
        });
    }

    public function down(): void
    {
        Schema::table('bdg', function (Blueprint $table) {
            $table->dropColumn(['logo', 'deskripsi']);
        });
    }
};
