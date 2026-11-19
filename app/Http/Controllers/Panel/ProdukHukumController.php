<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ProdHkm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProdukHukumController extends Controller
{
    public function index(Request $request): View
    {
        $jenis = $request->query('jenis');
        $q = trim((string) $request->query('q', ''));

        $dtProdHkm = ProdHkm::query()
            ->when($jenis, fn ($query) => $query->where('jenis', $jenis))
            ->when($q !== '', fn ($query) => $query->where('judul', 'like', '%' . $q . '%'))
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        $dtJenis = ProdHkm::whereNotNull('jenis')
            ->distinct()
            ->orderBy('jenis')
            ->pluck('jenis');

        return view('panel.produk-hukum.index', compact(
            'dtProdHkm', 'dtJenis', 'jenis', 'q'
        ));
    }

    private function validasi(Request $request, bool $wajib): array
    {
        return $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'jenis' => ['required', 'string', 'max:100'],
            'no_dok' => ['nullable', 'string', 'max:100'],
            'thn' => ['required', 'integer', 'between:1900,2100'],
            'ket' => ['nullable', 'string', 'max:1500'],
            'file' => [
                $wajib ? 'required' : 'nullable',
                'file',
                'mimes:pdf',
                'max:51200',
            ],
        ], [
            'judul.required' => 'Judul dokumen wajib diisi.',
            'jenis.required' => 'Jenis produk hukum wajib diisi.',
            'thn.required' => 'Tahun dokumen wajib diisi.',
            'thn.integer' => 'Tahun harus berupa angka.',
            'thn.between' => 'Tahun dokumen tidak valid.',
            'file.required' => 'Silakan pilih dokumen PDF.',
            'file.file' => 'Berkas yang dipilih tidak valid.',
            'file.mimes' => 'Dokumen harus berformat PDF.',
            'file.max' => 'Ukuran dokumen maksimal 50 MB.',
            'file.uploaded' => 'Dokumen gagal diunggah. Periksa ukuran file dan coba lagi.',
        ]);
    }

    public function simpan(Request $request): RedirectResponse
    {
        $data = $this->validasi($request, true);
        $path = null;

        try {
            $path = $request->file('file')->store('produk-hukum', 'public');

            if (! $path) {
                throw new \RuntimeException('Gagal menyimpan dokumen.');
            }

            ProdHkm::create([
                'judul' => $data['judul'],
                'jenis' => $data['jenis'],
                'no_dok' => $data['no_dok'] ?? null,
                'thn' => $data['thn'],
                'ket' => $data['ket'] ?? null,
                'file' => $path,
                'diunduh' => 0,
            ]);
        } catch (\Throwable $e) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }

            report($e);

            return back()->withInput($request->except('file'))
                ->withErrors(['file' => 'Dokumen gagal disimpan. Silakan coba lagi.']);
        }

        return redirect()->route('panel.produk-hukum.index')
            ->with('sukses', 'Produk hukum berhasil ditambahkan.');
    }

    public function perbarui(Request $request, ProdHkm $prodHkm): RedirectResponse
    {
        $data = $this->validasi($request, false);

        $pathLama = $prodHkm->file;
        $pathBaru = null;

        try {
            if ($request->hasFile('file')) {
                $pathBaru = $request->file('file')->store('produk-hukum', 'public');

                if (! $pathBaru) {
                    throw new \RuntimeException('Gagal menyimpan dokumen pengganti.');
                }
            }

            $prodHkm->update([
                'judul' => $data['judul'],
                'jenis' => $data['jenis'],
                'no_dok' => $data['no_dok'] ?? null,
                'thn' => $data['thn'],
                'ket' => $data['ket'] ?? null,
                'file' => $pathBaru ?: $pathLama,
            ]);
        } catch (\Throwable $e) {
            if ($pathBaru) {
                Storage::disk('public')->delete($pathBaru);
            }

            report($e);

            return back()->withErrors([
                'file' => 'Perubahan dokumen gagal disimpan.',
            ]);
        }

        if ($pathBaru && $pathLama) {
            Storage::disk('public')->delete($pathLama);
        }

        return back()->with('sukses', 'Produk hukum berhasil diperbarui.');
    }

    public function hapus(ProdHkm $prodHkm): RedirectResponse
    {
        $path = $prodHkm->file;

        $prodHkm->delete();

        if ($path) {
            Storage::disk('public')->delete($path);
        }

        return back()->with('sukses', 'Produk hukum berhasil dihapus.');
    }
}
