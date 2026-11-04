<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Models\Pgdn;
use App\Models\Skm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controller survei kepuasan masyarakat (SKM).
 * Diakses pelapor via link unik (token) setelah pengaduan selesai.
 */
class SkmController extends Controller
{
    public function form(string $token): View
    {
        $pgdn = Pgdn::where('token_skm', $token)->where('sts', 'selesai')->firstOrFail();

        // cek apakah sudah pernah isi
        $sudahIsi = $pgdn->skm()->exists();

        return view('publik.skm.form', compact('pgdn', 'token', 'sudahIsi'));
    }

    public function simpan(string $token, Request $request): RedirectResponse
    {
        $pgdn = Pgdn::where('token_skm', $token)->where('sts', 'selesai')->firstOrFail();

        // cegah isi ganda
        if ($pgdn->skm()->exists()) {
            return redirect()->route('skm.form', $token)
                ->with('info', 'Anda sudah pernah mengisi survei untuk pengaduan ini. Terima kasih.');
        }

        $data = $request->validate([
            'skor' => ['required', 'integer', 'between:1,5'],
            'saran' => ['nullable', 'string', 'max:1000'],
        ], [], ['skor' => 'nilai kepuasan']);

        Skm::create([
            'pgdn_id' => $pgdn->id,
            'skor' => $data['skor'],
            'saran' => $data['saran'] ?? null,
        ]);

        return redirect()->route('skm.form', $token)
            ->with('sukses', 'Terima kasih atas penilaian Anda. Masukan ini sangat berarti bagi kami.');
    }
}
