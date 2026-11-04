<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

/**
 * Controller profil petugas sendiri.
 * Petugas bisa ubah nama, no telp, & kata sandi.
 */
class ProfilController extends Controller
{
    public function edit(): View
    {
        return view('panel.profil', ['pgn' => auth()->user()]);
    }

    // ubah data diri
    public function perbarui(Request $request): RedirectResponse
    {
        $pgn = $request->user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($pgn->id)],
            'no_telp' => ['nullable', 'string', 'max:20'],
        ], [], [
            'name' => 'nama',
            'email' => 'email',
            'no_telp' => 'nomor telepon',
        ]);

        $pgn->update($data);

        return back()->with('sukses', 'Profil berhasil diperbarui.');
    }

    // ubah kata sandi
    public function ubahSandi(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'sandi_lama' => ['required', 'current_password'],
            'sandi_baru' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'sandi_lama.current_password' => 'Kata sandi lama salah.',
            'sandi_baru.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
            'sandi_baru.min' => 'Kata sandi baru minimal 8 karakter.',
        ], [
            'sandi_lama' => 'kata sandi lama',
            'sandi_baru' => 'kata sandi baru',
        ]);

        $request->user()->update([
            'password' => Hash::make($data['sandi_baru']),
        ]);

        return back()->with('sukses', 'Kata sandi berhasil diubah.');
    }
}
