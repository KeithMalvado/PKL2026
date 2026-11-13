<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Art;
use App\Models\Bdg;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ArtikelController extends Controller
{
    public function index(Request $request): View
    {
        $dtArt = Art::with('bdg')
            ->when($request->q, fn ($q) => $q->where('judul', 'like', "%{$request->q}%"))
            ->when($request->jenis, fn ($q) => $q->where('jenis', $request->jenis))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('panel.artikel.index', [
            'dtArt' => $dtArt,
            'dtBdg' => Bdg::orderBy('id')->get(),
        ]);
    }

    public function create(): View
    {
        return view('panel.artikel.form', [
            'art' => new Art(['jenis' => 'artikel', 'terbit' => true]),
            'dtBdg' => Bdg::orderBy('id')->get(),
        ]);
    }

    public function edit(Art $art): View
    {
        return view('panel.artikel.form', [
            'art' => $art,
            'dtBdg' => Bdg::orderBy('id')->get(),
        ]);
    }

    public function simpan(Request $request): RedirectResponse
    {
        $data = $this->validasi($request);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('art', 'public');
        }
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('art', 'public');
        }

        Art::create($data);

        return redirect()->route('panel.artikel.index')->with('sukses', 'Artikel berhasil ditambahkan.');
    }

    public function perbarui(Request $request, Art $art): RedirectResponse
    {
        $data = $this->validasi($request, $art);

        if ($request->hasFile('gambar')) {
            if ($art->gambar) {
                Storage::disk('public')->delete($art->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('art', 'public');
        }
        if ($request->hasFile('file')) {
            if ($art->file) {
                Storage::disk('public')->delete($art->file);
            }
            $data['file'] = $request->file('file')->store('art', 'public');
        }

        $art->update($data);

        return redirect()->route('panel.artikel.index')->with('sukses', 'Artikel berhasil diperbarui.');
    }

    public function hapus(Art $art): RedirectResponse
    {
        if ($art->gambar) {
            Storage::disk('public')->delete($art->gambar);
        }
        if ($art->file) {
            Storage::disk('public')->delete($art->file);
        }

        $art->delete();

        return back()->with('sukses', 'Artikel berhasil dihapus.');
    }

    protected function validasi(Request $request, ?Art $art = null): array
    {
        $data = $request->validate([
            'jenis' => ['required', Rule::in(['artikel', 'jurnal'])],
            'bdg_id' => ['nullable', 'exists:bdg,id'],
            'judul' => ['required', 'string', 'max:150'],
            'penulis' => ['nullable', 'string', 'max:100'],
            'ringkasan' => ['nullable', 'string', 'max:500'],
            'isi' => ['nullable', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'file' => ['nullable', 'file', 'mimes:pdf', 'max:5120'],
            'tgl_terbit' => ['nullable', 'date'],
        ], [], [
            'jenis' => 'jenis',
            'bdg_id' => 'bidang',
            'judul' => 'judul',
        ]);

        $data['slug'] = $this->slugUnik($data['judul'], $art?->id);
        $data['terbit'] = $request->boolean('terbit');
        $data['tgl_terbit'] = $data['tgl_terbit'] ?? now();

        unset($data['gambar'], $data['file']);

        return $data;
    }

    protected function slugUnik(string $judul, ?int $abaikan = null): string
    {
        $dasar = Str::slug($judul);
        $slug = $dasar;
        $i = 1;

        while (Art::where('slug', $slug)->when($abaikan, fn ($q) => $q->where('id', '!=', $abaikan))->exists()) {
            $slug = $dasar.'-'.$i++;
        }

        return $slug;
    }
}
