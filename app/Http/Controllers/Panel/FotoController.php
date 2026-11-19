<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\GlrFoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FotoController extends Controller
{
    public function index(Request $request): View
    {
        $album = $request->query('album');

        $dtFoto = GlrFoto::query()
            ->when($album, fn ($q) => $q->where('album', $album))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $dtAlbum = GlrFoto::whereNotNull('album')
            ->distinct()
            ->orderBy('album')
            ->pluck('album');

        return view('panel.foto.index', compact(
            'dtFoto',
            'dtAlbum',
            'album'
        ));
    }

    public function simpan(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:200'],
            'album' => ['nullable', 'string', 'max:100'],
            'ket' => ['nullable', 'string', 'max:1000'],
            'foto' => ['required', 'array', 'min:1', 'max:8'],
            'foto.*' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:10240',
            ],
        ], [
            'judul.required' => 'Judul kegiatan wajib diisi.',
            'judul.max' => 'Judul maksimal 200 karakter.',
            'album.max' => 'Nama album maksimal 100 karakter.',
            'ket.max' => 'Keterangan maksimal 1000 karakter.',
            'foto.required' => 'Silakan pilih foto terlebih dahulu.',
            'foto.array' => 'Berkas foto tidak valid.',
            'foto.max' => 'Maksimal 8 foto dalam satu unggahan.',
            'foto.*.image' => 'Berkas harus berupa gambar.',
            'foto.*.mimes' => 'Foto harus berformat JPG, PNG, atau WEBP.',
            'foto.*.max' => 'Ukuran setiap foto maksimal 10 MB.',
            'foto.*.uploaded' => 'Foto gagal diunggah. Silakan coba lagi.',
        ]);

        $pathTersimpan = [];

        try {
            DB::transaction(function () use ($request, $data, &$pathTersimpan) {
                foreach ($request->file('foto') as $berkas) {
                    $path = $berkas->store('galeri/foto', 'public');

                    if (! $path) {
                        throw new \RuntimeException('Gagal menyimpan foto.');
                    }

                    $pathTersimpan[] = $path;

                    GlrFoto::create([
                        'judul' => $data['judul'],
                        'album' => trim($data['album'] ?? '')
                            ?: 'Kegiatan DKPPP',
                        'ket' => $data['ket'] ?? null,
                        'path' => $path,
                    ]);
                }
            });
        } catch (\Throwable $e) {
            Storage::disk('public')->delete($pathTersimpan);
            report($e);

            return back()
                ->withInput($request->except('foto'))
                ->withErrors([
                    'foto' => 'Foto belum berhasil disimpan. Silakan coba kembali.',
                ]);
        }

        return back()->with(
            'sukses',
            count($pathTersimpan) . ' foto berhasil diunggah.'
        );
    }

    public function perbarui(
        Request $request,
        GlrFoto $foto
    ): RedirectResponse {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:200'],
            'album' => ['nullable', 'string', 'max:100'],
            'ket' => ['nullable', 'string', 'max:1000'],
            'foto_baru' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:10240',
            ],
        ], [
            'judul.required' => 'Judul kegiatan wajib diisi.',
            'foto_baru.image' => 'Berkas pengganti harus berupa gambar.',
            'foto_baru.mimes' => 'Foto harus berformat JPG, PNG, atau WEBP.',
            'foto_baru.max' => 'Ukuran foto maksimal 10 MB.',
            'foto_baru.uploaded' => 'Foto pengganti gagal diunggah.',
        ]);

        $pathLama = $foto->path;
        $pathBaru = null;

        try {
            if ($request->hasFile('foto_baru')) {
                $pathBaru = $request->file('foto_baru')
                    ->store('galeri/foto', 'public');

                if (! $pathBaru) {
                    throw new \RuntimeException('Gagal menyimpan foto pengganti.');
                }
            }

            $foto->update([
                'judul' => $data['judul'],
                'album' => trim($data['album'] ?? '')
                    ?: 'Kegiatan DKPPP',
                'ket' => $data['ket'] ?? null,
                'path' => $pathBaru ?: $pathLama,
            ]);
        } catch (\Throwable $e) {
            if ($pathBaru) {
                Storage::disk('public')->delete($pathBaru);
            }

            report($e);

            return back()->withErrors([
                'foto_baru' => 'Perubahan foto gagal disimpan.',
            ]);
        }

        if ($pathBaru && $pathLama) {
            Storage::disk('public')->delete($pathLama);
        }

        return back()->with('sukses', 'Foto berhasil diperbarui.');
    }

    public function hapus(GlrFoto $foto): RedirectResponse
    {
        $path = $foto->path;

        $foto->delete();

        if ($path) {
            Storage::disk('public')->delete($path);
        }

        return back()->with('sukses', 'Foto berhasil dihapus.');
    }
}
