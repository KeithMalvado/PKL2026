<?php

use App\Http\Controllers\Panel\AuthController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\PengaduanController;
use App\Http\Controllers\Panel\ProfilController;
use App\Http\Controllers\Publik\GaleriController;
use App\Http\Controllers\Publik\HalamanController;
use App\Http\Controllers\Publik\LayananController;
use App\Http\Controllers\Publik\PgdnController;
use App\Http\Controllers\Publik\SkmController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Route Publik (dpt diakses semua pengunjung)
|--------------------------------------------------------------------------
*/

Route::get('/', [HalamanController::class, 'beranda'])->name('beranda');

// ===== Profil =====
Route::prefix('profil')->name('profil.')->group(function () {
    Route::get('/sambutan', [HalamanController::class, 'profilSambutan'])->name('sambutan');
    Route::get('/struktur-organisasi', [HalamanController::class, 'profilStruktur'])->name('struktur');
    Route::get('/sejarah', [HalamanController::class, 'profilSejarah'])->name('sejarah');
    Route::get('/sekretariat', [HalamanController::class, 'profilSekretariat'])->name('sekretariat');

    Route::prefix('bidang')->name('bidang.')->group(function () {
        Route::get('/kesehatan-hewan', [HalamanController::class, 'bidangKeswan'])->name('keswan');
        Route::get('/peternakan', [HalamanController::class, 'bidangTernak'])->name('ternak');
        Route::get('/ketahanan-pangan', [HalamanController::class, 'bidangPangan'])->name('pangan');
        Route::get('/perikanan', [HalamanController::class, 'bidangIkan'])->name('ikan');
    });
});

// ===== Alur & SOP =====
Route::get('/alur-dan-sop', [HalamanController::class, 'alurSop'])->name('alur-sop');

// ===== UPTD =====
Route::prefix('uptd')->name('uptd.')->group(function () {
    Route::get('/laboratorium-keswan', [HalamanController::class, 'uptdLab'])->name('lab');
    Route::get('/rumah-potong-hewan', [HalamanController::class, 'uptdRph'])->name('rph');
    Route::get('/pembibitan-ternak', [HalamanController::class, 'uptdPembibitan'])->name('pembibitan');
    Route::get('/tempat-pelelangan-ikan', [HalamanController::class, 'uptdTpi'])->name('tpi');
    Route::get('/budidaya-perikanan', [HalamanController::class, 'uptdBudidaya'])->name('budidaya');
});

// ===== Layanan Publik =====
Route::prefix('layanan')->name('layanan.')->group(function () {
    // Berita PPID
    Route::get('/berita-ppid', [LayananController::class, 'berita'])->name('berita');
    // Info Kegiatan
    Route::get('/info-kegiatan', [LayananController::class, 'kegiatan'])->name('kegiatan');
    // detail berita/kegiatan (slug)
    Route::get('/berita/{brt}', [LayananController::class, 'beritaDetail'])->name('berita.detail');

    // Forum Konsultasi
    Route::get('/forum-konsultasi', [LayananController::class, 'forum'])->name('forum');
    Route::post('/forum-konsultasi', [LayananController::class, 'forumSimpan'])->name('forum.simpan');

    // Artikel & Jurnal
    Route::get('/artikel-dan-jurnal', [LayananController::class, 'artikel'])->name('artikel');
    Route::get('/artikel/{art}', [LayananController::class, 'artikelDetail'])->name('artikel.detail');

    // Inovasi Pelayanan
    Route::get('/inovasi-pelayanan', [LayananController::class, 'inovasi'])->name('inovasi');
    Route::get('/inovasi/{inov}', [LayananController::class, 'inovasiDetail'])->name('inovasi.detail');
});

// ===== Galeri =====
Route::prefix('galeri')->name('galeri.')->group(function () {
    Route::get('/foto', [GaleriController::class, 'foto'])->name('foto');
    Route::get('/video', [GaleriController::class, 'video'])->name('video');
    Route::get('/produk-hukum', [GaleriController::class, 'produkHukum'])->name('produk-hukum');
    Route::get('/produk-hukum/{prodHkm}/unduh', [GaleriController::class, 'unduhProdHkm'])->name('produk-hukum.unduh');
});

// ===== Pengaduan Publik =====
Route::prefix('pengaduan')->name('pgdn.')->group(function () {
    Route::get('/', [PgdnController::class, 'form'])->name('form');
    Route::post('/', [PgdnController::class, 'simpan'])->name('simpan');
    Route::get('/lacak', [PgdnController::class, 'lacak'])->name('lacak');
    Route::post('/lacak', [PgdnController::class, 'cekStatus'])->name('cek-status');
});

// ===== Survei SKM (link publik unik via token) =====
Route::get('/survei/{token}', [SkmController::class, 'form'])->name('skm.form');
Route::post('/survei/{token}', [SkmController::class, 'simpan'])->name('skm.simpan');

/*
|--------------------------------------------------------------------------
| Route Panel Petugas (hidden login + area terproteksi)
|--------------------------------------------------------------------------
*/

// hidden login (hanya utk tamu / belum login)
Route::middleware('guest')->group(function () {
    Route::get('/portal-petugas', [AuthController::class, 'form'])->name('panel.login');
    Route::post('/portal-petugas', [AuthController::class, 'masuk'])->name('panel.masuk');
});

// area panel (wajib login + akun aktif)
Route::middleware(['auth', 'role'])->prefix('panel')->name('panel.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // ===== Pengaduan (workflow) =====
    Route::prefix('pengaduan')->name('pengaduan.')->group(function () {
        Route::get('/', [PengaduanController::class, 'index'])->name('index');
        Route::get('/monitor-sla', [PengaduanController::class, 'monitorSla'])->name('monitor-sla');
        Route::get('/{pgdn}', [PengaduanController::class, 'show'])->name('show');

        // aksi workflow
        Route::post('/{pgdn}/verifikasi', [PengaduanController::class, 'verifikasi'])->name('verifikasi');
        Route::post('/{pgdn}/tolak', [PengaduanController::class, 'tolak'])->name('tolak');
        Route::post('/{pgdn}/disposisi', [PengaduanController::class, 'disposisi'])->name('disposisi');
        Route::post('/{pgdn}/darurat', [PengaduanController::class, 'darurat'])->name('darurat');
        Route::post('/{pgdn}/tunjuk-teknis', [PengaduanController::class, 'tunjukTeknis'])->name('tunjuk-teknis');
        Route::post('/{pgdn}/lhtl', [PengaduanController::class, 'simpanLhtl'])->name('lhtl');
        Route::post('/{pgdn}/selesai', [PengaduanController::class, 'selesai'])->name('selesai');
    });

    // profil sendiri
    Route::get('/profil', [ProfilController::class, 'edit'])->name('profil');
    Route::put('/profil', [ProfilController::class, 'perbarui'])->name('profil.perbarui');
    Route::put('/profil/sandi', [ProfilController::class, 'ubahSandi'])->name('profil.sandi');

    Route::post('/keluar', [AuthController::class, 'keluar'])->name('keluar');
});
