<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\DokSop;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SopController extends Controller
{
    public function index(): View
    {
        $dtDok = DokSop::orderBy('urut')
            ->get()
            ->groupBy('jenis');

        return view('panel.sop.index', [
            'dtDok' => $dtDok,
        ]);
    }

    public function simpan(Request $request): RedirectResponse
    {
        $data = $this->validasi($request);

        $data['file'] = $request->file('file')
            ->store('sop', 'public');

        $data['urut'] = $data['urut']
            ?? ((int) DokSop::max('urut') + 1);

        DokSop::create($data);

        return back()->with(
            'sukses',
            'Dokumen SOP berhasil diunggah.'
        );
    }

    public function perbarui(
        Request $request,
        DokSop $dok
    ): RedirectResponse {
        $data = $this->validasi($request, false);

        $fileLama = $dok->file;

        if ($request->hasFile('file')) {
            // Simpan file baru terlebih dahulu.
            $data['file'] = $request->file('file')
                ->store('sop', 'public');
        } else {
            unset($data['file']);
        }

        $dok->update($data);

        // Hapus file lama setelah pembaruan berhasil.
        if (
            isset($data['file']) &&
            $fileLama &&
            $fileLama !== $data['file']
        ) {
            Storage::disk('public')->delete($fileLama);
        }

        return back()->with(
            'sukses',
            'Dokumen SOP berhasil diperbarui.'
        );
    }

    public function hapus(DokSop $dok): RedirectResponse
    {
        if ($dok->file) {
            Storage::disk('public')->delete($dok->file);
        }

        $dok->delete();

        return back()->with(
            'sukses',
            'Dokumen SOP berhasil dihapus.'
        );
    }

    protected function validasi(
        Request $request,
        bool $wajibFile = true
    ): array {
        return $request->validate(
            [
                'judul' => [
                    'required',
                    'string',
                    'max:200',
                ],
                'jenis' => [
                    'required',
                    Rule::in(['sop', 'standar', 'sk']),
                ],
                'file' => [
                    $wajibFile ? 'required' : 'nullable',
                    'file',
                    'mimes:pdf',
                    'max:51200',
                ],
                'thn' => [
                    'nullable',
                    'digits:4',
                ],
                'urut' => [
                    'nullable',
                    'integer',
                    'min:0',
                ],
            ],
            [
                'judul.required' =>
                    'Judul dokumen wajib diisi.',

                'judul.max' =>
                    'Judul dokumen maksimal 200 karakter.',

                'jenis.required' =>
                    'Silakan pilih jenis dokumen.',

                'jenis.in' =>
                    'Jenis dokumen tidak valid.',

                'file.required' =>
                    'Silakan pilih berkas PDF terlebih dahulu.',

                'file.file' =>
                    'Berkas yang dipilih tidak valid.',

                'file.mimes' =>
                    'Dokumen harus menggunakan format PDF.',

                'file.max' =>
                    'Ukuran dokumen maksimal 50 MB.',

                'file.uploaded' =>
                    'Dokumen gagal diunggah. Periksa ukuran berkas dan coba kembali.',

                'thn.digits' =>
                    'Tahun harus terdiri dari 4 angka.',

                'urut.integer' =>
                    'Urutan harus berupa angka.',

                'urut.min' =>
                    'Urutan tidak boleh kurang dari 0.',
            ],
            [
                'judul' => 'judul dokumen',
                'jenis' => 'jenis dokumen',
                'file' => 'berkas PDF',
                'thn' => 'tahun',
                'urut' => 'urutan',
            ]
        );
    }
}
