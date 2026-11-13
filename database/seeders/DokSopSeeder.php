<?php

namespace Database\Seeders;

use App\Models\DokSop;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/**
 * Seeder dokumen SOP / standar pelayanan / SK.
 * Berkas sumber ada di database/seeders/berkas/sop, lalu disalin ke storage publik.
 */
class DokSopSeeder extends Seeder
{
    public function run(): void
    {
        $sumber = database_path('seeders/berkas/sop');
        $tujuan = 'sop';

        Storage::disk('public')->makeDirectory($tujuan);

        $dtDok = [
            ['SOP PELAYANAN KESEHATAN TERPADU DAN PELAYANAN KESEHATAN HEWAN DI PUSKESWAN.pdf', 'SOP Pelayanan Kesehatan Terpadu dan Pelayanan Kesehatan Hewan di Puskeswan', 'sop'],
            ['SOP PELAYANAN RAPID TEST AI CAVIAN INFLUENZA.pdf', 'SOP Pelayanan Rapid Test AI (Avian Influenza)', 'sop'],
            ['SOP REGISTRASI PANGAN SEGAR ASAL TUMBUHAN PRODUKSI DALAM NEGERI USAHA KECIL (PSAT-PDUK).pdf', 'SOP Registrasi Pangan Segar Asal Tumbuhan Produksi Dalam Negeri Usaha Kecil (PSAT-PDUK)', 'sop'],
            ['SOP REKOMENDASI IZIN PRAKTIK DOKTER HEWAN.pdf', 'SOP Rekomendasi Izin Praktik Dokter Hewan', 'sop'],
            ['SOP REKOMENDASI IZIN TENAGA KESEHATAN HEWAN BUKAN DOKTER HEWAN.pdf', 'SOP Rekomendasi Izin Tenaga Kesehatan Hewan Bukan Dokter Hewan', 'sop'],
            ['SOP REKOMENDASI IZIN USAHA PETERNAKAN.pdf', 'SOP Rekomendasi Izin Usaha Peternakan', 'sop'],
            ['SOP.pdf', 'SOP Pelayanan Dinas (Dokumen Induk)', 'sop'],
            ['SOP_PELAYANAN PEMOTONGAN  HEWAN.pdf', 'SOP Pelayanan Pemotongan Hewan', 'sop'],
            ['PELAYANAN REGISTRASI PANGAN SEGAR ASAL TUMBUHAN PRODUKSI DALAM NEGERI USAHA KECIL (PSAT-PDUK).pdf', 'Standar Pelayanan Registrasi Pangan Segar Asal Tumbuhan Produksi Dalam Negeri Usaha Kecil (PSAT-PDUK)', 'standar'],
            ['STANDAR PELAYANAN KESEHATAN HEWAN TERPADU DAN PELAYANAN KESEHATAN HEWAN DI PUSKESWAN.pdf', 'Standar Pelayanan Kesehatan Hewan Terpadu dan Pelayanan Kesehatan Hewan di Puskeswan', 'standar'],
            ['STANDAR PELAYANAN RAPID TEST AI CAVIAN INFLUENZA.pdf', 'Standar Pelayanan Rapid Test AI (Avian Influenza)', 'standar'],
            ['STANDAR PELAYANAN REKOMENDASI IZIN PRAKTEK DOKTER HEWAN.pdf', 'Standar Pelayanan Rekomendasi Izin Praktik Dokter Hewan', 'standar'],
            ['STANDAR PELAYANAN REKOMENDASI IZIN TENAGA KESEHATAN HEWAN BUKAN DOKTER HEWAN.pdf', 'Standar Pelayanan Rekomendasi Izin Tenaga Kesehatan Hewan Bukan Dokter Hewan', 'standar'],
            ['STANDAR PELAYANAN REKOMENDASI IZIN USAHA PETERNAKAN.pdf', 'Standar Pelayanan Rekomendasi Izin Usaha Peternakan', 'standar'],
            ['STANDAR PELAYANAN RUMAH POTONG HEWAN.pdf', 'Standar Pelayanan Rumah Potong Hewan', 'standar'],
            ['SK SOP Rekom BBM.pdf', 'SK SOP Rekomendasi BBM', 'sk'],
        ];

        foreach ($dtDok as $i => [$berkas, $judul, $jenis]) {
            $asal = $sumber.DIRECTORY_SEPARATOR.$berkas;

            if (! File::exists($asal)) {
                continue;
            }

            $namaSimpan = $tujuan.'/'.$berkas;

            if (! Storage::disk('public')->exists($namaSimpan)) {
                Storage::disk('public')->put($namaSimpan, File::get($asal));
            }

            DokSop::updateOrCreate(
                ['file' => $namaSimpan],
                [
                    'judul' => $judul,
                    'jenis' => $jenis,
                    'thn' => 2025,
                    'urut' => $i + 1,
                ]
            );
        }
    }
}
