<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Bdg;
use App\Models\Brt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BeritaController extends Controller
{
    public function index(Request $request): View
    {
        $dtBrt = Brt::with('bdg')
            ->when($request->q, fn ($q) => $q->where('judul', 'like', "%{$request->q}%"))
            ->when($request->jenis, fn ($q) => $q->where('jenis', $request->jenis))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('panel.berita.index', ['dtBrt' => $dtBrt]);
    }

    public function create(): View
    {
        return view('panel.berita.form', [
            'brt' => new Brt(['jenis' => 'kegiatan', 'terbit' => true]),
            'dtBdg' => Bdg::orderBy('id')->get(),
        ]);
    }

    public function edit(Brt $brt): View
    {
        return view('panel.berita.form', [
            'brt' => $brt,
            'dtBdg' => Bdg::orderBy('id')->get(),
        ]);
    }

    public function simpan(Request $request): RedirectResponse
    {
        $data = $this->validasi($request);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('brt', 'public');
        }

        $data['pgn_id'] = $request->user()->id;

        Brt::create($data);

        return redirect()->route('panel.berita.index')->with('sukses', 'Berita berhasil ditambahkan.');
    }

    public function perbarui(Request $request, Brt $brt): RedirectResponse
    {
        $data = $this->validasi($request, $brt);

        if ($request->hasFile('gambar')) {
            if ($brt->gambar) {
                Storage::disk('public')->delete($brt->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('brt', 'public');
        }

        $brt->update($data);

        return redirect()->route('panel.berita.index')->with('sukses', 'Berita berhasil diperbarui.');
    }

    public function hapus(Brt $brt): RedirectResponse
    {
        if ($brt->gambar) {
            Storage::disk('public')->delete($brt->gambar);
        }

        $brt->delete();

        return back()->with('sukses', 'Berita berhasil dihapus.');
    }

    protected function validasi(Request $request, ?Brt $brt = null): array
    {
        $data = $request->validate([
            'jenis' => ['required', Rule::in(['ppid', 'kegiatan'])],
            'bdg_id' => ['nullable', 'exists:bdg,id'],
            'judul' => ['required', 'string', 'max:150'],
            'ringkasan' => ['nullable', 'string', 'max:500'],
            'isi' => ['required', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'tgl_terbit' => ['nullable', 'date'],
        ], [], [
            'jenis' => 'jenis',
            'bdg_id' => 'bidang',
            'judul' => 'judul',
            'isi' => 'isi berita',
        ]);

        $data['slug'] = $this->slugUnik($data['judul'], $brt?->id);
        $data['terbit'] = $request->boolean('terbit');
        $data['tgl_terbit'] = $data['tgl_terbit'] ?? now();

        unset($data['gambar']);

        return $data;
    }

    protected function slugUnik(string $judul, ?int $abaikan = null): string
    {
        $dasar = Str::slug($judul);
        $slug = $dasar;
        $i = 1;

        while (Brt::where('slug', $slug)->when($abaikan, fn ($q) => $q->where('id', '!=', $abaikan))->exists()) {
            $slug = $dasar.'-'.$i++;
        }

        return $slug;
    }
}
