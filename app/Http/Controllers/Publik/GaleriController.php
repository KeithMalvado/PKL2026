<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Models\GlrFoto;
use App\Models\GlrVid;
use App\Models\ProdHkm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

/**
 * Controller modul Galeri:
 * Galeri Foto, Video Kegiatan, Produk Hukum & Kebijakan.
 */
class GaleriController extends Controller
{
    // ===== Galeri Foto =====
    public function foto(Request $request): View
    {
        // kelompokkn per album
        $album = $request->album;

        $dtFoto = GlrFoto::when($album, fn ($q) => $q->where('album', $album))
            ->latest()
            ->paginate(16)->withQueryString();

        // daftar album utk filter
        $dtAlbum = GlrFoto::whereNotNull('album')
            ->distinct()->orderBy('album')->pluck('album');

        return view('publik.galeri.foto', compact('dtFoto', 'dtAlbum', 'album'));
    }

    // ===== Video Kegiatan =====
    public function video(): View
    {
        $dtVid = GlrVid::latest()->paginate(12);
        return view('publik.galeri.video', compact('dtVid'));
    }

    // ===== Produk Hukum & Kebijakan =====
    public function produkHukum(Request $request): View
    {
        $jenis = $request->jenis;

        $dtProdHkm = ProdHkm::when($jenis, fn ($q) => $q->where('jenis', $jenis))
            ->when($request->q, fn ($q) => $q->where('judul', 'like', "%{$request->q}%"))
            ->latest('thn')
            ->paginate(12)->withQueryString();

        $dtJenis = ProdHkm::whereNotNull('jenis')
            ->distinct()->orderBy('jenis')->pluck('jenis');

        return view('publik.galeri.produk-hukum', compact('dtProdHkm', 'dtJenis', 'jenis'));
    }

    /** Unduh file produk hukum + catat penghitung unduhan. */
    public function unduhProdHkm(ProdHkm $prodHkm): RedirectResponse
    {
        abort_unless($prodHkm->file && Storage::disk('public')->exists($prodHkm->file), 404);

        $prodHkm->increment('diunduh');

        return redirect(Storage::url($prodHkm->file));
    }
}
