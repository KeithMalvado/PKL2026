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
        $dtDok = DokSop::orderBy('urut')->get()->groupBy('jenis');

        return view('panel.sop.index', ['dtDok' => $dtDok]);
    }

    public function simpan(Request $request): RedirectResponse
    {
        $data = $this->validasi($request);

        $data['file'] = $request->file('file')->store('sop', 'public');
        $data['urut'] = $data['urut'] ?? (DokSop::max('urut') + 1);

        DokSop::create($data);

        return back()->with('sukses', 'Dokumen berhasil diunggah.');
    }

    public function perbarui(Request $request, DokSop $dok): RedirectResponse
    {
        $data = $this->validasi($request, false);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($dok->file);
            $data['file'] = $request->file('file')->store('sop', 'public');
        } else {
            unset($data['file']);
        }

        $dok->update($data);

        return back()->with('sukses', 'Dokumen berhasil diperbarui.');
    }

    public function hapus(DokSop $dok): RedirectResponse
    {
        Storage::disk('public')->delete($dok->file);
        $dok->delete();

        return back()->with('sukses', 'Dokumen berhasil dihapus.');
    }

    protected function validasi(Request $request, bool $wajibFile = true): array
    {
        return $request->validate([
            'judul' => ['required', 'string', 'max:200'],
            'jenis' => ['required', Rule::in(['sop', 'standar', 'sk'])],
            'file' => [$wajibFile ? 'required' : 'nullable', 'file', 'mimes:pdf', 'max:10240'],
            'thn' => ['nullable', 'digits:4'],
            'urut' => ['nullable', 'integer', 'min:0'],
        ], [], [
            'judul' => 'judul dokumen',
            'jenis' => 'jenis dokumen',
            'file' => 'berkas PDF',
        ]);
    }
}
