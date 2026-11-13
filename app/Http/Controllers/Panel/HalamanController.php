<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\HalStatis;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class HalamanController extends Controller
{
    public function index(): View
    {
        return view('panel.halaman.index', ['dtHal' => HalStatis::orderBy('kunci')->get()]);
    }

    public function edit(HalStatis $hal): View
    {
        return view('panel.halaman.form', ['hal' => $hal]);
    }

    public function perbarui(Request $request, HalStatis $hal): RedirectResponse
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:150'],
            'isi' => ['nullable', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [], [
            'judul' => 'judul halaman',
            'gambar' => 'gambar',
        ]);

        if ($request->hasFile('gambar')) {
            if ($hal->gambar) {
                Storage::disk('public')->delete($hal->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('halaman', 'public');
        } else {
            unset($data['gambar']);
        }

        $hal->update($data);

        return redirect()->route('panel.halaman.index')->with('sukses', "Halaman {$hal->judul} berhasil diperbarui.");
    }

    public function hapusGambar(HalStatis $hal): RedirectResponse
    {
        if ($hal->gambar) {
            Storage::disk('public')->delete($hal->gambar);
            $hal->update(['gambar' => null]);
        }

        return back()->with('sukses', 'Gambar halaman dihapus.');
    }
}
