<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed database aplikasi.
     * Urutan penting: bdg dulu (dipakai relasi petugas), lalu petugas & konten.
     */
    public function run(): void
    {
        $this->call([
            BdgSeeder::class,
            PgnSeeder::class,
            HalStatisSeeder::class,
            LayananSeeder::class,
        ]);
    }
}
