<?php

namespace Database\Seeders;

use App\Models\HalStatis;
use Illuminate\Database\Seeder;

/**
 * Seeder konten halaman statis (hal_statis).
 * Mengisi konten awal yg bisa diedit admin kelak.
 * Kunci harus sama dgn yg dipakai controller/view publik.
 */
class HalStatisSeeder extends Seeder
{
    public function run(): void
    {
        $dtHal = [
            [
                'kunci' => 'profil.sambutan',
                'judul' => 'Sambutan Kepala Dinas',
                'isi' => '<p>Assalamualaikum warahmatullahi wabarakatuh. Selamat datang di website resmi Dinas Ketahanan Pangan, Peternakan, dan Perikanan Kabupaten Jember. Website ini kami hadirkan sebagai wujud komitmen pelayanan publik yang transparan, akuntabel, dan mudah diakses oleh seluruh masyarakat.</p>',
            ],
            [
                'kunci' => 'profil.struktur',
                'judul' => 'Profil & Struktur Organisasi',
                'isi' => '<p>Dinas Ketahanan Pangan, Peternakan, dan Perikanan Kabupaten Jember dipimpin oleh seorang Kepala Dinas yang membawahi Sekretariat dan empat bidang teknis.</p>',
            ],
            [
                'kunci' => 'profil.sejarah',
                'judul' => 'Sejarah',
                'isi' => '<p>Sejarah terbentuknya Dinas Ketahanan Pangan, Peternakan, dan Perikanan Kabupaten Jember.</p>',
            ],
            [
                'kunci' => 'profil.sekretariat',
                'judul' => 'Sekretariat',
                'isi' => '<p>Sekretariat menyelenggarakan fungsi administrasi, perencanaan, keuangan, dan kepegawaian dinas.</p>',
            ],
            [
                'kunci' => 'profil.bidang.keswan',
                'judul' => 'Bidang Kesehatan Hewan',
                'isi' => '<p>Bidang Kesehatan Hewan menangani pencegahan dan pengendalian penyakit hewan serta pelayanan kesehatan hewan.</p>',
            ],
            [
                'kunci' => 'profil.bidang.ternak',
                'judul' => 'Bidang Peternakan',
                'isi' => '<p>Bidang Peternakan menangani pengembangan budidaya dan produksi ternak.</p>',
            ],
            [
                'kunci' => 'profil.bidang.pangan',
                'judul' => 'Bidang Ketahanan Pangan',
                'isi' => '<p>Bidang Ketahanan Pangan menangani ketersediaan, distribusi, dan konsumsi pangan daerah.</p>',
            ],
            [
                'kunci' => 'profil.bidang.ikan',
                'judul' => 'Bidang Perikanan',
                'isi' => '<p>Bidang Perikanan menangani pengembangan budidaya dan tangkap perikanan.</p>',
            ],
            [
                'kunci' => 'alur-sop',
                'judul' => 'Alur & SOP',
                'isi' => '<p>Standar Operasional Prosedur pelayanan Dinas Ketahanan Pangan, Peternakan, dan Perikanan Kabupaten Jember.</p>',
            ],
            [
                'kunci' => 'uptd.lab',
                'judul' => 'UPTD Laboratorium Keswan, Kesmavet & Klinik Hewan',
                'isi' => '<p>UPTD Laboratorium Kesehatan Hewan, Kesehatan Masyarakat Veteriner dan Klinik Hewan.</p>',
            ],
            [
                'kunci' => 'uptd.rph',
                'judul' => 'UPTD Rumah Potong Hewan',
                'isi' => '<p>UPTD Rumah Potong Hewan menyediakan layanan pemotongan hewan yang higienis dan sesuai syariat.</p>',
            ],
            [
                'kunci' => 'uptd.pembibitan',
                'judul' => 'UPTD Pembibitan Ternak & Hijauan Pakan Ternak',
                'isi' => '<p>UPTD Pembibitan Ternak dan Hijauan Pakan Ternak.</p>',
            ],
            [
                'kunci' => 'uptd.tpi',
                'judul' => 'UPTD Tempat Pelelangan Ikan',
                'isi' => '<p>UPTD Tempat Pelelangan Ikan memfasilitasi transaksi hasil tangkapan nelayan.</p>',
            ],
            [
                'kunci' => 'uptd.budidaya',
                'judul' => 'UPTD Budidaya Perikanan Air Tawar',
                'isi' => '<p>UPTD Budidaya Perikanan Air Tawar.</p>',
            ],
        ];

        foreach ($dtHal as $hal) {
            HalStatis::updateOrCreate(['kunci' => $hal['kunci']], $hal);
        }
    }
}
