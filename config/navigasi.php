<?php

/**
 * Konfigurasi menu navigasi publik.
 * Dipakai oleh navbar & footer agar struktur menu terpusat di satu tempat.
 *
 * Struktur:
 * - 'judul' : teks yg tampil di menu
 * - 'route' : nama route (null bila hanya pembuka dropdown)
 * - 'sub'   : daftar sub-menu (opsional)
 */

return [
    'menu' => [
        [
            'judul' => 'Beranda',
            'route' => 'beranda',
            'sub' => [],
        ],
        [
            'judul' => 'Profil',
            'route' => null,
            'sub' => [
                ['judul' => 'Sambutan Kadis', 'route' => 'profil.sambutan'],
                ['judul' => 'Profil & Struktur Organisasi', 'route' => 'profil.struktur'],
                ['judul' => 'Sejarah', 'route' => 'profil.sejarah'],
                ['judul' => 'Sekretariat', 'route' => 'profil.sekretariat'],
                ['judul' => 'Bidang Kesehatan Hewan', 'route' => 'profil.bidang.keswan'],
                ['judul' => 'Bidang Peternakan', 'route' => 'profil.bidang.ternak'],
                ['judul' => 'Bidang Ketahanan Pangan', 'route' => 'profil.bidang.pangan'],
                ['judul' => 'Bidang Perikanan', 'route' => 'profil.bidang.ikan'],
            ],
        ],
        [
            'judul' => 'Alur & SOP',
            'route' => 'alur-sop',
            'sub' => [],
        ],
        [
            'judul' => 'UPTD',
            'route' => null,
            'sub' => [
                ['judul' => 'Lab. Keswan, Kesmavet & Klinik Hewan', 'route' => 'uptd.lab'],
                ['judul' => 'Rumah Potong Hewan', 'route' => 'uptd.rph'],
                ['judul' => 'Pembibitan Ternak & Hijauan Pakan', 'route' => 'uptd.pembibitan'],
                ['judul' => 'Tempat Pelelangan Ikan', 'route' => 'uptd.tpi'],
                ['judul' => 'Budidaya Perikanan Air Tawar', 'route' => 'uptd.budidaya'],
            ],
        ],
        [
            'judul' => 'Layanan Publik',
            'route' => null,
            'sub' => [
                ['judul' => 'Berita PPID', 'route' => 'layanan.berita'],
                ['judul' => 'Info Kegiatan', 'route' => 'layanan.kegiatan'],
                ['judul' => 'Forum Konsultasi', 'route' => 'layanan.forum'],
                ['judul' => 'Artikel & Jurnal', 'route' => 'layanan.artikel'],
                ['judul' => 'Inovasi Pelayanan', 'route' => 'layanan.inovasi'],
            ],
        ],
        [
            'judul' => 'Galeri',
            'route' => null,
            'sub' => [
                ['judul' => 'Galeri Foto', 'route' => 'galeri.foto'],
                ['judul' => 'Video Kegiatan', 'route' => 'galeri.video'],
                ['judul' => 'Produk Hukum & Kebijakan', 'route' => 'galeri.produk-hukum'],
            ],
        ],
    ],

    // tombol aksi khusus (menonjol) di navbar
    'tombolPgdn' => [
        'judul' => 'Pengaduan',
        'route' => 'pgdn.form',
    ],
];
