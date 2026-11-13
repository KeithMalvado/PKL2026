<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Bdg;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BidangController extends Controller
{
    public function index(): View
    {
        return view('panel.bidang.index', ['dtBdg' => Bdg::orderBy('id')->get()]);
    }

    public function perbarui(Request $request, Bdg $bdg): RedirectResponse
    {
        $data = $request->validate([
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],
            'deskripsi' => ['nullable', 'string', 'max:500'],
        ], [], ['logo' => 'logo bidang', 'deskripsi' => 'deskripsi']);

        if ($request->hasFile('logo')) {
            if ($bdg->logo) {
                Storage::disk('public')->delete($bdg->logo);
            }
            $data['logo'] = $request->file('logo')->store('bidang', 'public');
        }

        $bdg->update($data);

        return back()->with('sukses', "Data {$bdg->nama} berhasil diperbarui.");
    }

    public function hapusLogo(Bdg $bdg): RedirectResponse
    {
        if ($bdg->logo) {
            Storage::disk('public')->delete($bdg->logo);
            $bdg->update(['logo' => null]);
        }

        return back()->with('sukses', "Logo {$bdg->nama} dihapus.");
    }
}
