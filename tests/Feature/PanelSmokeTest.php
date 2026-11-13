<?php

namespace Tests\Feature;

use App\Models\Bdg;
use App\Models\Pgdn;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class PanelSmokeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_halaman_admin_dapat_dibuka(): void
    {
        $admin = User::where('role', 'admin')->firstOrFail();

        foreach ([
            '/panel',
            '/panel/pengaturan',
            '/panel/bidang',
            '/panel/berita',
            '/panel/berita/tambah',
            '/panel/artikel',
            '/panel/artikel/tambah',
            '/panel/video',
            '/panel/sop',
            '/panel/halaman',
            '/panel/forum',
            '/panel/pengaduan',
        ] as $url) {
            $this->actingAs($admin)->get($url)->assertOk();
        }
    }

    public function test_halaman_publik_dapat_dibuka(): void
    {
        foreach ([
            '/',
            '/bidang/ketahanan-pangan',
            '/alur-dan-sop',
            '/layanan/berita-ppid',
            '/layanan/info-kegiatan',
            '/galeri/video',
            '/layanan/forum-konsultasi',
        ] as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_admin_dapat_menyimpan_pengaturan_dan_video(): void
    {
        $admin = User::where('role', 'admin')->firstOrFail();

        $this->actingAs($admin)->put('/panel/pengaturan', [
            'telp' => '(0331) 5101342',
            'wa' => '623315101342',
            'email' => 'info@dkpp.jemberkab.go.id',
            'alamat' => 'Jl. Kalimantan No. 1',
            'jam' => 'Senin - Jumat',
            'tautan_ppid' => 'https://ppid.jemberkab.go.id/',
            'tautan_bkd' => 'https://layanan-bkd.jemberkab.go.id/',
            'tautan_sikeren' => 'https://sikeren.jemberkab.go.id/',
            'ppid_induk' => 'https://ppid.jemberkab.go.id/',
        ])->assertRedirect();

        $this->assertDatabaseHas('pengaturan', ['kunci' => 'kontak.telp', 'nilai' => '(0331) 5101342']);

        $this->actingAs($admin)->post('/panel/video', [
            'judul' => 'Profil Dinas',
            'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        ])->assertRedirect();

        $this->assertDatabaseHas('glr_vid', ['judul' => 'Profil Dinas']);
    }

    public function test_aksi_tolak_pengaduan_sudah_dihapus(): void
    {
        $this->assertFalse(Route::has('panel.pengaduan.tolak'));
    }

    public function test_detail_pengaduan_tetap_dapat_dibuka(): void
    {
        $admin = User::where('role', 'admin')->firstOrFail();

        $pgdn = Pgdn::create([
            'kd_tkt' => 'PGDN-20260101-TEST',
            'nama_pelapor' => 'Penguji',
            'no_telp' => '081200000000',
            'judul' => 'Uji tampilan',
            'isi' => 'Isi pengaduan untuk pengujian tampilan detail.',
            'kat' => 'Umum',
            'sts' => 'baru',
        ]);

        $this->actingAs($admin)->get("/panel/pengaduan/{$pgdn->id}")->assertOk();
    }

    public function test_admin_dapat_menambah_artikel_bidang(): void
    {
        $admin = User::where('role', 'admin')->firstOrFail();
        $bdg = Bdg::where('slug', 'perikanan')->firstOrFail();

        $this->actingAs($admin)->post('/panel/artikel', [
            'jenis' => 'artikel',
            'bdg_id' => $bdg->id,
            'judul' => 'Budidaya Lele Modern',
            'penulis' => 'Redaksi',
            'ringkasan' => 'Ringkasan artikel uji.',
            'isi' => '<p>Isi artikel uji.</p>',
            'tgl_terbit' => now()->toDateString(),
            'terbit' => '1',
        ])->assertRedirect(route('panel.artikel.index'));

        $this->assertDatabaseHas('art', ['judul' => 'Budidaya Lele Modern', 'bdg_id' => $bdg->id]);

        $this->get('/bidang/perikanan')->assertOk()->assertSee('Budidaya Lele Modern');
    }
}
