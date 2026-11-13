<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use Illuminate\Database\Seeder;

/**
 * Seeder pengaturan situs (identitas & kontak center).
 */
class PengaturanSeeder extends Seeder
{
    public function run(): void
    {
        $dtSetelan = [
            'kontak.telp' => '(0331) 5101342',
            'kontak.wa' => '623315101342',
            'kontak.email' => 'info@dkpp.jemberkab.go.id',
            'kontak.alamat' => 'Jl. Kalimantan No. 1, Kabupaten Jember, Jawa Timur',
            'kontak.jam' => 'Senin - Jumat, 07.30 - 16.00 WIB',
            'tautan.ppid' => 'https://ppid.jemberkab.go.id/',
            'tautan.bkd' => 'https://layanan-bkd.jemberkab.go.id/',
            'tautan.sikeren' => 'https://sikeren.jemberkab.go.id/',
            'ppid.induk' => 'https://ppid.jemberkab.go.id/',
            'sosmed.facebook' => 'https://www.facebook.com/dinaskepenakkan.dkppp',
            'sosmed.instagram' => 'https://www.instagram.com/dkpppjember',
            'sosmed.tiktok' => 'https://www.tiktok.com/@dkppp.kab..jember',
            'sosmed.youtube' => 'https://www.youtube.com/@DKPPP2017',
        ];

        foreach ($dtSetelan as $kunci => $nilai) {
            Pengaturan::updateOrCreate(['kunci' => $kunci], ['nilai' => $nilai]);
        }

        Pengaturan::lupakan();
    }
}
