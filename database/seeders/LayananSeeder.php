<?php

namespace Database\Seeders;

use App\Models\Art;
use App\Models\Bdg;
use App\Models\Brt;
use App\Models\Forum;
use App\Models\ForumBalas;
use App\Models\Inov;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Seeder data contoh (dummy) utk modul Layanan Publik.
 * Mengisi berita, kegiatan, artikel, jurnal, inovasi, & forum
 * agar halaman publik langsung terlihat hidup.
 */
class LayananSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        // ===== Berita PPID & Info Kegiatan (brt) =====
        $dtBrt = [
            ['jenis' => 'ppid', 'judul' => 'Keterbukaan Informasi Publik: Laporan Realisasi Program 2025', 'bdg' => null],
            ['jenis' => 'ppid', 'judul' => 'Pengumuman Daftar Informasi Publik Terbaru', 'bdg' => null],
            ['jenis' => 'ppid', 'judul' => 'Standar Layanan Informasi Publik DKPP Jember', 'bdg' => null],
            ['jenis' => 'ppid', 'judul' => 'Laporan Pelayanan Informasi Semester I', 'bdg' => null],
            ['jenis' => 'kegiatan', 'judul' => 'Vaksinasi Massal Ternak di Kecamatan Ambulu', 'bdg' => 'kesehatan-hewan'],
            ['jenis' => 'kegiatan', 'judul' => 'Panen Raya Padi Bersama Kelompok Tani Sumbersari', 'bdg' => 'ketahanan-pangan'],
            ['jenis' => 'kegiatan', 'judul' => 'Pelatihan Budidaya Lele untuk Pembudidaya Pemula', 'bdg' => 'perikanan'],
            ['jenis' => 'kegiatan', 'judul' => 'Gerakan Pangan Murah Menjelang Hari Raya', 'bdg' => 'ketahanan-pangan'],
        ];

        foreach ($dtBrt as $i => $brt) {
            Brt::updateOrCreate(
                ['slug' => Str::slug($brt['judul'])],
                [
                    'jenis' => $brt['jenis'],
                    'bdg_id' => $brt['bdg'] ? Bdg::where('slug', $brt['bdg'])->value('id') : null,
                    'judul' => $brt['judul'],
                    'ringkasan' => 'Ringkasan singkat mengenai '.$brt['judul'].' yang diselenggarakan oleh DKPP Kabupaten Jember.',
                    'isi' => '<p>'.$brt['judul'].'.</p><p>Dinas Ketahanan Pangan, Peternakan, dan Perikanan Kabupaten Jember berkomitmen menyelenggarakan program dan kegiatan yang bermanfaat bagi masyarakat. Kegiatan ini merupakan bagian dari upaya mewujudkan kemandirian pangan dan kesejahteraan peternak serta nelayan.</p><p>Informasi lebih lanjut dapat diperoleh melalui kontak resmi dinas.</p>',
                    'pgn_id' => $admin?->id,
                    'terbit' => true,
                    'tgl_terbit' => now()->subDays(($i + 1) * 2),
                    'dilihat' => rand(10, 500),
                ]
            );
        }

        // ===== Artikel & Jurnal (art) =====
        $dtArt = [
            ['jenis' => 'artikel', 'judul' => 'Tips Menjaga Kesehatan Ternak di Musim Hujan', 'bdg' => 'kesehatan-hewan'],
            ['jenis' => 'artikel', 'judul' => 'Mengenal Komoditas Pangan Unggulan Kabupaten Jember', 'bdg' => 'ketahanan-pangan'],
            ['jenis' => 'artikel', 'judul' => 'Strategi Stabilisasi Harga Pangan di Tingkat Daerah', 'bdg' => 'ketahanan-pangan'],
            ['jenis' => 'jurnal', 'judul' => 'Analisis Produktivitas Perikanan Air Tawar di Jember', 'bdg' => 'perikanan'],
            ['jenis' => 'jurnal', 'judul' => 'Kajian Ketahanan Pangan Berkelanjutan Wilayah Tapal Kuda', 'bdg' => 'ketahanan-pangan'],
        ];

        foreach ($dtArt as $i => $art) {
            Art::updateOrCreate(
                ['slug' => Str::slug($art['judul'])],
                [
                    'jenis' => $art['jenis'],
                    'bdg_id' => $art['bdg'] ? Bdg::where('slug', $art['bdg'])->value('id') : null,
                    'judul' => $art['judul'],
                    'penulis' => 'Tim '.($art['jenis'] === 'jurnal' ? 'Peneliti' : 'Redaksi').' DKPP',
                    'ringkasan' => 'Pembahasan mengenai '.$art['judul'].'.',
                    'isi' => '<p>'.$art['judul'].'.</p><p>Artikel ini membahas berbagai aspek penting terkait tema yang diangkat, disertai data dan rekomendasi yang relevan bagi masyarakat dan pemangku kepentingan.</p>',
                    'terbit' => true,
                    'tgl_terbit' => now()->subDays(($i + 1) * 3),
                ]
            );
        }

        // ===== Inovasi Pelayanan (inov) =====
        $dtInov = [
            'SI-PANGAN: Sistem Informasi Harga Pangan Real-time',
            'LAPOR TERNAK: Pelaporan Penyakit Hewan via WhatsApp',
            'KLINIK IKAN KELILING: Layanan Konsultasi Budidaya Gratis',
        ];

        foreach ($dtInov as $i => $judul) {
            Inov::updateOrCreate(
                ['slug' => Str::slug($judul)],
                [
                    'judul' => $judul,
                    'ringkasan' => 'Inovasi pelayanan publik: '.$judul.'.',
                    'isi' => '<p>'.$judul.'.</p><p>Inovasi ini dirancang untuk meningkatkan kualitas pelayanan publik dan mempermudah akses masyarakat terhadap layanan dinas.</p>',
                    'terbit' => true,
                ]
            );
        }

        // ===== Forum Konsultasi (forum) =====
        $dtForum = [
            ['nama' => 'Budi Santoso', 'judul' => 'Cara mendapatkan bantuan bibit ikan lele', 'pertanyaan' => 'Bagaimana prosedur mengajukan bantuan bibit ikan lele untuk kelompok pembudidaya?', 'kat' => 'Perikanan', 'sts' => 'tampil', 'jawab' => 'Silakan ajukan proposal kelompok melalui UPTD Budidaya Perikanan Air Tawar dengan melampirkan data kelompok dan rencana budidaya. Tim kami akan melakukan verifikasi lapangan.'],
            ['nama' => 'Siti Aminah', 'judul' => 'Jadwal vaksinasi ternak sapi', 'pertanyaan' => 'Kapan jadwal vaksinasi PMK untuk ternak sapi di wilayah Kecamatan Kalisat?', 'kat' => 'Peternakan', 'sts' => 'tampil', 'jawab' => 'Jadwal vaksinasi PMK untuk wilayah Kalisat akan dilaksanakan pada minggu kedua setiap bulan. Silakan menghubungi petugas Pos Keswan terdekat untuk pendaftaran.'],
            ['nama' => 'Ahmad Fauzi', 'judul' => 'Informasi harga gabah terkini', 'pertanyaan' => 'Di mana saya bisa memantau harga gabah harian tingkat kabupaten?', 'kat' => 'Ketahanan Pangan', 'sts' => 'tampil', 'jawab' => 'Harga gabah harian dapat dipantau melalui inovasi SI-PANGAN yang tersedia di website ini pada menu Inovasi Pelayanan.'],
            ['nama' => 'Rina Wati', 'judul' => 'Konsultasi penyakit pada ayam', 'pertanyaan' => 'Ayam ternak saya banyak yang mati mendadak, kemana saya harus konsultasi?', 'kat' => 'Kesehatan Hewan', 'sts' => 'tunggu', 'jawab' => null],
        ];

        foreach ($dtForum as $f) {
            $forum = Forum::updateOrCreate(
                ['nama' => $f['nama'], 'judul' => $f['judul']],
                [
                    'email' => Str::slug($f['nama'], '.').'@contoh.test',
                    'pertanyaan' => $f['pertanyaan'],
                    'kat' => $f['kat'],
                    'sts' => $f['sts'],
                ]
            );

            if ($f['jawab'] && $forum->balasan()->count() === 0) {
                ForumBalas::create([
                    'forum_id' => $forum->id,
                    'pgn_id' => $admin?->id,
                    'isi' => $f['jawab'],
                ]);
            }
        }
    }
}
