<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PanelBalanceTest extends TestCase
{
    use RefreshDatabase;

    public function test_tag_seimbang_di_panel(): void
    {
        $this->seed();
        $admin = User::where('role', 'admin')->firstOrFail();

        $urls = [
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
            '/panel/pengaduan/monitor-sla',
            '/panel/profil',
        ];

        foreach ($urls as $url) {
            $html = $this->actingAs($admin)->get($url)->assertOk()->getContent();

            foreach (['div', 'span', 'section', 'form', 'table', 'a', 'button'] as $tag) {
                $buka = preg_match_all("/<{$tag}\b/", $html);
                $tutup = preg_match_all("#</{$tag}>#", $html);
                $this->assertSame($buka, $tutup, "Tag <{$tag}> tidak seimbang di {$url} ({$buka}/{$tutup})");
            }

            $this->assertStringNotContainsString("\u{FEFF}", $html, "Ada BOM di {$url}");
        }
    }
}
