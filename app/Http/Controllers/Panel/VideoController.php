<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\GlrVid;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class VideoController extends Controller
{
    public function index(): View
    {
        return view('panel.video.index', ['dtVid' => GlrVid::latest()->paginate(12)]);
    }

    public function simpan(Request $request): RedirectResponse
    {
        $data = $this->validasi($request);

        GlrVid::create($data);

        return back()->with('sukses', 'Video berhasil ditambahkan.');
    }

    public function perbarui(Request $request, GlrVid $vid): RedirectResponse
    {
        $vid->update($this->validasi($request));

        return back()->with('sukses', 'Video berhasil diperbarui.');
    }

    public function hapus(GlrVid $vid): RedirectResponse
    {
        $vid->delete();

        return back()->with('sukses', 'Video berhasil dihapus.');
    }

    protected function validasi(Request $request): array
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:150'],
            'url' => ['required', 'string', 'max:255'],
            'ket' => ['nullable', 'string', 'max:255'],
        ], [], [
            'judul' => 'judul video',
            'url' => 'tautan YouTube',
        ]);

        $uji = new GlrVid(['url' => $data['url']]);

        if (! $uji->ytId()) {
            throw ValidationException::withMessages([
                'url' => 'Tautan bukan video YouTube yang valid.',
            ]);
        }

        return $data;
    }
}
