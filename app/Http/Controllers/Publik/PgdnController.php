<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Models\Pgdn;
use App\Models\PgdnBkt;
use App\Models\PgdnLog;
use App\Services\CaptchaService;
use App\Services\WaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

/**
 * Controller pengaduan publik.
 * Alur: form -> simpan (generate kd_tkt + simulasi WA) -> lacak status.
 */
class PgdnController extends Controller
{
    public function __construct(
        protected CaptchaService $captcha,
        protected WaService $wa,
    ) {}

    // ===== Form Pengaduan =====
    public function form(): View
    {
        $soalCaptcha = $this->captcha->buat();

        $dtKat = ['Ketahanan Pangan', 'Peternakan', 'Perikanan', 'Kesehatan Hewan', 'Umum'];

        return view('publik.pgdn.form', compact('soalCaptcha', 'dtKat'));
    }

    // ===== Simpan Pengaduan =====
    public function simpan(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama_pelapor' => ['required', 'string', 'max:100'],
            'nik' => ['required', 'digits:16'],
            'no_telp' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s]+$/'],
            'email' => ['nullable', 'email', 'max:150'],
            'judul' => ['required', 'string', 'max:150'],
            'isi' => ['required', 'string', 'min:15', 'max:3000'],
            'kat' => ['required', 'string', 'max:50'],
            'lokasi' => ['nullable', 'string', 'max:200'],
            'bukti' => ['nullable', 'array', 'max:3'],
            'bukti.*' => ['file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            'captcha' => ['required'],
        ], [
            'nik.digits' => 'NIK harus terdiri dari 16 digit angka.',
            'bukti.max' => 'Maksimal 3 berkas bukti.',
            'bukti.*.mimes' => 'Berkas bukti harus berformat jpg, png, atau pdf.',
            'bukti.*.max' => 'Ukuran tiap berkas maksimal 2MB.',
            'isi.min' => 'Isi pengaduan terlalu singkat (minimal 15 karakter).',
        ], [
            'nama_pelapor' => 'nama pelapor',
            'no_telp' => 'nomor telepon',
            'isi' => 'isi pengaduan',
            'kat' => 'kategori',
        ]);

        // verifikasi captcha
        if (! $this->captcha->cek($request->captcha)) {
            return back()
                ->withInput()
                ->withErrors(['captcha' => 'Jawaban captcha salah. Silakan coba lagi.']);
        }
        $this->captcha->hapus();

        // simpan dlm transaksi agar konsisten
        $pgdn = DB::transaction(function () use ($data, $request) {
            $pgdn = Pgdn::create([
                'kd_tkt' => $this->buatKodeTiket(),
                'nama_pelapor' => $data['nama_pelapor'],
                'nik' => $data['nik'],
                'no_telp' => $data['no_telp'],
                'email' => $data['email'] ?? null,
                'judul' => $data['judul'],
                'isi' => $data['isi'],
                'kat' => $data['kat'],
                'lokasi' => $data['lokasi'] ?? null,
                'sts' => 'baru',
            ]);

            // simpan bukti bila ada
            if ($request->hasFile('bukti')) {
                foreach ($request->file('bukti') as $file) {
                    $path = $file->store('bukti-pgdn', 'public');
                    PgdnBkt::create([
                        'pgdn_id' => $pgdn->id,
                        'path' => $path,
                        'nama_asli' => $file->getClientOriginalName(),
                        'tipe' => $file->getClientMimeType(),
                    ]);
                }
            }

            // catat jejak awal
            PgdnLog::create([
                'pgdn_id' => $pgdn->id,
                'pgn_id' => null,
                'aksi' => 'Pengaduan dibuat',
                'sts_lama' => null,
                'sts_baru' => 'baru',
                'ket' => 'Pengaduan diterima sistem.',
            ]);

            return $pgdn;
        });

        // simulasi kirim WA kode tiket
        $pesan = $this->wa->pesanTiketBaru($pgdn->kd_tkt, $pgdn->nama_pelapor, $pgdn->judul);
        $this->wa->kirim($pgdn->no_telp, $pesan);

        // bawa kode tiket ke halaman sukses
        return redirect()
            ->route('pgdn.form')
            ->with('tiketBaru', [
                'kd_tkt' => $pgdn->kd_tkt,
                'nama' => $pgdn->nama_pelapor,
                'no_telp' => $this->wa->rapikanNomor($pgdn->no_telp),
            ]);
    }

    // ===== Lacak Pengaduan =====
    public function lacak(): View
    {
        return view('publik.pgdn.lacak', ['pgdn' => null, 'dicari' => false]);
    }

    public function cekStatus(Request $request): View
    {
        $data = $request->validate([
            'kd_tkt' => ['required', 'string'],
            'no_telp' => ['required', 'string'],
        ], [], [
            'kd_tkt' => 'kode tiket',
            'no_telp' => 'nomor telepon',
        ]);

        // cocokkn kode tiket + no telp (verifikasi ringan kepemilikan)
        $pgdn = Pgdn::with(['bdg', 'log' => fn ($q) => $q->latest(), 'lhtl'])
            ->where('kd_tkt', trim($data['kd_tkt']))
            ->where('no_telp', trim($data['no_telp']))
            ->first();

        return view('publik.pgdn.lacak', [
            'pgdn' => $pgdn,
            'dicari' => true,
        ]);
    }

    /**
     * Generate kode tiket unik: PGDN-YYYYMMDD-XXXX
     */
    protected function buatKodeTiket(): string
    {
        do {
            $kode = 'PGDN-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));
        } while (Pgdn::where('kd_tkt', $kode)->exists());

        return $kode;
    }
}
