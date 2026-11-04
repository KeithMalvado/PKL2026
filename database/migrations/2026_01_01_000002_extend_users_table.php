<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Perluasan tabel users menjadi data petugas (pgn).
 * Tambah kolom role, jabatan (jbt), bidang (bdg_id), no telp, & status aktif.
 * Role: admin | kadis | kabid | teknis (lihat docs/kamus-singkatan.md).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 20)->default('admin')->after('email'); // peran petugas
            $table->string('jbt')->nullable()->after('role');             // jabatan
            $table->foreignId('bdg_id')->nullable()->after('jbt')         // bidang (utk kabid/teknis)
                ->constrained('bdg')->nullOnDelete();
            $table->string('no_telp', 20)->nullable()->after('bdg_id');   // utk notif WA
            $table->boolean('aktif')->default(true)->after('no_telp');    // status akun aktif
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['bdg_id']);
            $table->dropColumn(['role', 'jbt', 'bdg_id', 'no_telp', 'aktif']);
        });
    }
};
