<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Models\Art;
use App\Models\Bdg;
use App\Models\Brt;
use App\Models\DokSop;
use App\Models\GlrVid;
use App\Models\HalStatis;
use Illuminate\View\View;

/**
 * Controller halaman publik.
 * Menarik konten dr tabel hal_statis (dpt diedit admin pd Target 9).
 */
class HalamanController extends Controller
{
    public function beranda(): View
    {
        $dtBdg = Bdg::orderBy('id')->get()->map(function (Bdg $bdg) {
            return [
                'bdg' => $bdg,
                'slide' => $bdg->artikelSlide(5),
            ];
        });

        $dtVid = GlrVid::latest()->take(3)->get();

        $dtBerita = Brt::where('terbit', true)
            ->where('jenis', 'kegiatan')
            ->latest('tgl_terbit')
            ->take(3)
            ->get();

        $dtArtikel = Art::where('terbit', true)
            ->latest('tgl_terbit')
            ->take(3)
            ->get();

        $stat = [
            'bidang' => Bdg::count(),
            'berita' => Brt::where('terbit', true)->count(),
            'artikel' => Art::where('terbit', true)->count(),
            'sop' => DokSop::count(),
        ];

        return view('publik.beranda', compact('dtBdg', 'dtVid', 'dtBerita', 'dtArtikel', 'stat'));
    }

    /** Halaman daftar artikel per bidang. */
    public function bidang(Bdg $bdg): View
    {
        $dtArt = $bdg->artikel()
            ->where('terbit', true)
            ->latest('tgl_terbit')
            ->paginate(9);

        return view('publik.bidang', compact('bdg', 'dtArt'));
    }

    /**
     * Render halaman statis generik berdasarkn kunci.
     * $kunci = kunci baris di tabel hal_statis.
     * $view  = view khusus (opsional), default 'publik.hal-statis'.
     */
    protected function tampilStatis(string $kunci, string $view = 'publik.hal-statis'): View
    {
        $hal = HalStatis::byKunci($kunci);

        // fallback aman bila data belum ada di DB
        $data = [
            'kunci' => $kunci,
            'judul' => $hal?->judul ?? ucwords(str_replace(['.', '-'], ' ', $kunci)),
            'isi' => $hal?->isi ?? '<p>Konten belum tersedia.</p>',
            'gambar' => $hal?->gambar,
        ];

        return view($view, $data);
    }

    // ===== Profil =====
    public function profilSambutan(): View
    {
        return $this->tampilStatis('profil.sambutan', 'publik.profil.sambutan');
    }

    public function profilStruktur(): View
    {
        return $this->tampilStatis('profil.struktur', 'publik.profil.struktur');
    }

    public function profilSejarah(): View
    {
        return $this->tampilStatis('profil.sejarah');
    }

    public function profilSekretariat(): View
    {
        return $this->tampilStatis('profil.sekretariat');
    }

    public function bidangKeswan(): View
    {
        return $this->tampilStatis('profil.bidang.keswan');
    }

    public function bidangTernak(): View
    {
        return $this->tampilStatis('profil.bidang.ternak');
    }

    public function bidangPangan(): View
    {
        return $this->tampilStatis('profil.bidang.pangan');
    }

    public function bidangIkan(): View
    {
        return $this->tampilStatis('profil.bidang.ikan');
    }

    // ===== Alur & SOP =====
    public function alurSop(): View
    {
        $hal = HalStatis::byKunci('alur-sop');

        $dtDok = DokSop::orderBy('urut')->get()->groupBy('jenis');

        return view('publik.alur-sop', [
            'judul' => $hal?->judul ?? 'Alur & SOP',
            'isi' => $hal?->isi ?? '<p>Standar Operasional Prosedur pelayanan Dinas Ketahanan Pangan, Peternakan, dan Perikanan Kabupaten Jember.</p>',
            'dtDok' => $dtDok,
        ]);
    }

    // ===== UPTD =====
    public function uptdLab(): View
    {
        return $this->tampilStatis('uptd.lab');
    }

    public function uptdRph(): View
    {
        return $this->tampilStatis('uptd.rph');
    }

    public function uptdPembibitan(): View
    {
        return $this->tampilStatis('uptd.pembibitan');
    }

    public function uptdTpi(): View
    {
        return $this->tampilStatis('uptd.tpi');
    }

    public function uptdBudidaya(): View
    {
        return $this->tampilStatis('uptd.budidaya');
    }
}
