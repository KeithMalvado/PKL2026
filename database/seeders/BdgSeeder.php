<?php

namespace Database\Seeders;

use App\Models\Bdg;
use Illuminate\Database\Seeder;

/**
 * Seeder master bidang (bdg) - 4 bidang teknis dinas.
 */
class BdgSeeder extends Seeder
{
    public function run(): void
    {
        $dtBdg = [
            ['nama' => 'Bidang Kesehatan Hewan', 'slug' => 'kesehatan-hewan', 'kode' => 'KESWAN'],
            ['nama' => 'Bidang Peternakan', 'slug' => 'peternakan', 'kode' => 'TERNAK'],
            ['nama' => 'Bidang Ketahanan Pangan', 'slug' => 'ketahanan-pangan', 'kode' => 'PANGAN'],
            ['nama' => 'Bidang Perikanan', 'slug' => 'perikanan', 'kode' => 'IKAN'],
        ];

        foreach ($dtBdg as $bdg) {
            Bdg::updateOrCreate(['slug' => $bdg['slug']], $bdg);
        }
    }
}
