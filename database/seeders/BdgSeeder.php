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
            ['nama' => 'Bidang Kesehatan Hewan', 'slug' => 'kesehatan-hewan', 'kode' => 'KESWAN', 'deskripsi' => 'Menangani pencegahan dan pengendalian penyakit hewan serta pelayanan kesehatan hewan di Kabupaten Jember.'],
            ['nama' => 'Bidang Peternakan', 'slug' => 'peternakan', 'kode' => 'TERNAK', 'deskripsi' => 'Menangani pengembangan budidaya, produksi, dan pemasaran hasil peternakan.'],
            ['nama' => 'Bidang Ketahanan Pangan', 'slug' => 'ketahanan-pangan', 'kode' => 'PANGAN', 'deskripsi' => 'Menangani ketersediaan, distribusi, dan konsumsi pangan daerah.'],
            ['nama' => 'Bidang Perikanan', 'slug' => 'perikanan', 'kode' => 'IKAN', 'deskripsi' => 'Menangani pengembangan budidaya dan usaha penangkapan hasil perikanan.'],
        ];

        foreach ($dtBdg as $bdg) {
            Bdg::updateOrCreate(['slug' => $bdg['slug']], $bdg);
        }
    }
}
