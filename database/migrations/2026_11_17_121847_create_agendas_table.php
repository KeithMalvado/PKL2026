
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('bdg_id')
                ->constrained('bdg')
                ->restrictOnDelete();

            $table->string('judul', 200);
            $table->text('uraian');
            $table->date('tanggal');

            $table->time('waktu_mulai');
            $table->time('waktu_selesai')->nullable();
            $table->string('keterangan_waktu', 100)->nullable();

            $table->string('lokasi', 255);

            $table->string('status_publikasi', 20)
                ->default('terbit');

            $table->timestamp('dibatalkan_at')->nullable();

            $table->foreignId('dibuat_oleh')
                ->constrained('users')
                ->restrictOnDelete();

            $table->foreignId('diperbarui_oleh')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['bdg_id', 'tanggal']);
            $table->index(['status_publikasi', 'tanggal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
