<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Kaitkan berita & artikel ke bidang (utk kartu bidang di beranda).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('brt', function (Blueprint $table) {
            $table->foreignId('bdg_id')->nullable()->after('jenis')
                ->constrained('bdg')->nullOnDelete();
            $table->index('bdg_id');
        });

        Schema::table('art', function (Blueprint $table) {
            $table->foreignId('bdg_id')->nullable()->after('jenis')
                ->constrained('bdg')->nullOnDelete();
            $table->index('bdg_id');
        });
    }

    public function down(): void
    {
        Schema::table('brt', function (Blueprint $table) {
            $table->dropForeign(['bdg_id']);
            $table->dropIndex(['bdg_id']);
            $table->dropColumn('bdg_id');
        });

        Schema::table('art', function (Blueprint $table) {
            $table->dropForeign(['bdg_id']);
            $table->dropIndex(['bdg_id']);
            $table->dropColumn('bdg_id');
        });
    }
};
