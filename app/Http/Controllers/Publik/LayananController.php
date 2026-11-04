<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Models\Art;
use App\Models\Brt;
use App\Models\Forum;
use App\Models\Inov;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controller modul Layanan Publik:
 * Berita PPID, Info Kegiatan, Forum Konsultasi, Artikel & Jurnal, Inovasi.
 */
class LayananController extends Controller
{
    // ===== Berita PPID =====
    public function berita(Request $request): View
    {
        $dtBrt = Brt::where('jenis', 'ppid')->where('terbit', true)
            ->when($request->q, fn ($q) => $q->where('judul', 'like', "%{$request->q}%"))
            ->latest('tgl_terbit')
            ->paginate(9)->withQueryString();

        return view('publik.layanan.berita-index', [
            'dtBrt' => $dtBrt,
            'judul' => 'Berita PPID',
            'jenis' => 'ppid',
        ]);
    }

    // ===== Info Kegiatan =====
    public function kegiatan(Request $request): View
    {
        $dtBrt = Brt::where('jenis', 'kegiatan')->where('terbit', true)
            ->when($request->q, fn ($q) => $q->where('judul', 'like', "%{$request->q}%"))
            ->latest('tgl_terbit')
            ->paginate(9)->withQueryString();

        return view('publik.layanan.berita-index', [
            'dtBrt' => $dtBrt,
            'judul' => 'Info Kegiatan',
            'jenis' => 'kegiatan',
        ]);
    }

    /** Detail berita/kegiatan (dipakai keduanya). */
    public function beritaDetail(Brt $brt): View
    {
        abort_unless($brt->terbit, 404);
        $brt->increment('dilihat');

        $terkait = Brt::where('jenis', $brt->jenis)->where('terbit', true)
            ->where('id', '!=', $brt->id)
            ->latest('tgl_terbit')->take(4)->get();

        return view('publik.layanan.berita-detail', compact('brt', 'terkait'));
    }

    // ===== Artikel & Jurnal =====
    public function artikel(Request $request): View
    {
        $jenis = in_array($request->jenis, ['artikel', 'jurnal']) ? $request->jenis : null;

        $dtArt = Art::where('terbit', true)
            ->when($jenis, fn ($q) => $q->where('jenis', $jenis))
            ->when($request->q, fn ($q) => $q->where('judul', 'like', "%{$request->q}%"))
            ->latest('tgl_terbit')
            ->paginate(9)->withQueryString();

        return view('publik.layanan.artikel-index', compact('dtArt', 'jenis'));
    }

    public function artikelDetail(Art $art): View
    {
        abort_unless($art->terbit, 404);
        return view('publik.layanan.artikel-detail', compact('art'));
    }

    // ===== Inovasi Pelayanan =====
    public function inovasi(): View
    {
        $dtInov = Inov::where('terbit', true)->latest()->paginate(9);
        return view('publik.layanan.inovasi-index', compact('dtInov'));
    }

    public function inovasiDetail(Inov $inov): View
    {
        abort_unless($inov->terbit, 404);
        return view('publik.layanan.inovasi-detail', compact('inov'));
    }

    // ===== Forum Konsultasi =====
    public function forum(Request $request): View
    {
        // hanya tampilkn pertanyaan yg sudah dimoderasi (tampil)
        $dtForum = Forum::where('sts', 'tampil')
            ->when($request->q, fn ($q) => $q->where('judul', 'like', "%{$request->q}%"))
            ->with('balasan.petugas')
            ->latest()
            ->paginate(8)->withQueryString();

        return view('publik.layanan.forum-index', compact('dtForum'));
    }

    /** Simpan pertanyaan forum dr publik (status tunggu moderasi). */
    public function forumSimpan(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['nullable', 'email', 'max:150'],
            'judul' => ['required', 'string', 'max:150'],
            'pertanyaan' => ['required', 'string', 'min:10', 'max:2000'],
            'kat' => ['nullable', 'string', 'max:50'],
        ], [], [
            'nama' => 'nama',
            'judul' => 'judul pertanyaan',
            'pertanyaan' => 'isi pertanyaan',
        ]);

        $data['sts'] = 'tunggu';
        Forum::create($data);

        return back()->with('sukses', 'Pertanyaan Anda berhasil dikirim dan sedang menunggu moderasi petugas. Terima kasih.');
    }
}
