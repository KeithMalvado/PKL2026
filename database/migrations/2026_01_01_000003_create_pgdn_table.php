<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel pengaduan (pgdn) - inti sistem.
 * Menyimpn laporan dr pelapor beserta status alur tindak lanjut.
 *
 * Status (sts): baru | verif | tolak | dsps | proses | selesai
 * (lihat docs/kamus-singkatan.md)
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pgdn', function (Blueprint $table) {
            $table->id();
            $table->string('kd_tkt', 30)->unique();   // kode tiket, mis. PGDN-20260101-ABCD

            // data pelapor
            $table->string('nama_pelapor');
            $table->string('nik', 20)->nullable();
            $table->string('no_telp', 20);             // wajib utk notif WA
            $table->string('email')->nullable();

            // isi pengaduan
            $table->string('judul');
            $table->text('isi');
            $table->string('kat')->nullable();         // kategori: pangan/ternak/ikan/keswan/umum
            $table->string('lokasi')->nullable();      // lokasi kejadian
            $table->decimal('lat', 10, 7)->nullable(); // koordinat opsional
            $table->decimal('lng', 10, 7)->nullable();

            // alur & status
            $table->string('sts', 20)->default('baru');
            $table->boolean('darurat')->default(false);
            $table->foreignId('bdg_id')->nullable()    // bidang tujuan disposisi
                ->constrained('bdg')->nullOnDelete();
            $table->foreignId('verif_oleh')->nullable() // admin yg verifikasi
                ->constrained('users')->nullOnDelete();
            $table->foreignId('teknis_id')->nullable()  // tim teknis yg ditunjuk
                ->constrained('users')->nullOnDelete();
            $table->text('alasan_tolak')->nullable();

            // jejak waktu SLA
            $table->timestamp('tgl_verif')->nullable();
            $table->timestamp('tgl_dsps')->nullable();
            $table->timestamp('batas_sla')->nullable(); // batas waktu tindak lanjut
            $table->timestamp('tgl_selesai')->nullable();

            $table->timestamps();

            $table->index('sts');
            $table->index('kat');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pgdn');
    }
};
