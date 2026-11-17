<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use App\Support\Bantu;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PengaturanController extends Controller
{
    /** Nama input form => kunci pengaturan. */
    protected array $petaField = [
        'telp' => 'kontak.telp',
        'wa' => 'kontak.wa',
        'email' => 'kontak.email',
        'alamat' => 'kontak.alamat',
        'jam' => 'kontak.jam',
        'tautan_ppid' => 'tautan.ppid',
        'tautan_bkd' => 'tautan.bkd',
        'tautan_sikeren' => 'tautan.sikeren',
        'ppid_induk' => 'ppid.induk',
        'sosmed_facebook' => 'sosmed.facebook',
        'sosmed_instagram' => 'sosmed.instagram',
        'sosmed_tiktok' => 'sosmed.tiktok',
        'sosmed_youtube' => 'sosmed.youtube',
    ];

    /**
     * Menampilkan halaman pengaturan situs.
     */
    public function index(): View
    {
        return view('panel.pengaturan.index', [
            'setelan' => Pengaturan::pluck('nilai', 'kunci')->all(),

            // Logo utama (Pemkab Jember).
            'logo' => Bantu::logo(),

            // Logo khusus DKPPP untuk hero beranda.
            'logoDkppp' => Bantu::logoDkppp(),
        ]);
    }

    /**
     * Menyimpan pengaturan situs.
     */
    public function simpan(Request $request): RedirectResponse
    {
        $data = $request->validate([
            // Logo utama.
            'logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:1024',
            ],

            // Logo DKPPP.
            'logo_dkppp' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:1024',
            ],

            'telp' => ['nullable', 'string', 'max:40'],
            'wa' => ['nullable', 'string', 'max:40'],
            'email' => ['nullable', 'email', 'max:150'],
            'alamat' => ['nullable', 'string', 'max:255'],
            'jam' => ['nullable', 'string', 'max:120'],

            'tautan_ppid' => ['nullable', 'url', 'max:255'],
            'tautan_bkd' => ['nullable', 'url', 'max:255'],
            'tautan_sikeren' => ['nullable', 'url', 'max:255'],
            'ppid_induk' => ['nullable', 'url', 'max:255'],

            'sosmed_facebook' => ['nullable', 'url', 'max:255'],
            'sosmed_instagram' => ['nullable', 'url', 'max:255'],
            'sosmed_tiktok' => ['nullable', 'url', 'max:255'],
            'sosmed_youtube' => ['nullable', 'url', 'max:255'],
        ], [], [
            'logo' => 'logo situs',
            'logo_dkppp' => 'logo DKPPP',
            'telp' => 'nomor telepon',
            'wa' => 'nomor WhatsApp',
            'email' => 'email',
            'tautan_ppid' => 'tautan PPID',
            'tautan_bkd' => 'tautan BKD',
            'tautan_sikeren' => 'tautan SIKEREN',
            'ppid_induk' => 'tautan PPID induk',
            'sosmed_facebook' => 'tautan Facebook',
            'sosmed_instagram' => 'tautan Instagram',
            'sosmed_tiktok' => 'tautan TikTok',
            'sosmed_youtube' => 'tautan YouTube',
        ]);

        // Simpan kontak, tautan layanan, dan media sosial.
        foreach ($this->petaField as $field => $kunci) {
            $nilai = $data[$field] ?? null;

            Pengaturan::simpan(
                $kunci,
                $nilai !== null && $nilai !== '' ? $nilai : null
            );
        }

        // Upload logo utama (Pemkab Jember).
        // Mekanisme lama tetap dipertahankan.
        if ($request->hasFile('logo')) {
            $lama = Pengaturan::ambil('logo');

            if ($lama) {
                Storage::disk('public')->delete($lama);
            }

            Pengaturan::simpan(
                'logo',
                $request->file('logo')->store('logo', 'public')
            );
        }

        // Upload logo khusus DKPPP.
        if ($request->hasFile('logo_dkppp')) {
            $lamaDkppp = Pengaturan::ambil('logo_dkppp');

            $baruDkppp = $request->file('logo_dkppp')
                ->store('logo-dkppp', 'public');

            Pengaturan::simpan('logo_dkppp', $baruDkppp);

            // Hapus file sebelumnya setelah data baru tersimpan.
            if ($lamaDkppp && $lamaDkppp !== $baruDkppp) {
                Storage::disk('public')->delete($lamaDkppp);
            }
        }

        return back()->with(
            'sukses',
            'Pengaturan situs berhasil disimpan.'
        );
    }

    /**
     * Menghapus logo utama dan mengembalikan
     * tampilannya ke logo bawaan sistem.
     */
    public function hapusLogo(): RedirectResponse
    {
        $lama = Pengaturan::ambil('logo');

        if ($lama) {
            Storage::disk('public')->delete($lama);
            Pengaturan::simpan('logo', null);
        }

        return back()->with(
            'sukses',
            'Logo dikembalikan ke bawaan sistem.'
        );
    }

    /**
     * Menghapus logo khusus DKPPP dari pengaturan.
     */
    public function hapusLogoDkppp(): RedirectResponse
    {
        $lama = Pengaturan::ambil('logo_dkppp');

        if ($lama) {
            Pengaturan::simpan('logo_dkppp', null);
            Storage::disk('public')->delete($lama);
        }

        return back()->with(
            'sukses',
            'Logo DKPPP berhasil dihapus.'
        );
    }
}
