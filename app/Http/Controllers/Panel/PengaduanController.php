<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Lhtl;
use App\Models\Pgdn;
use App\Models\PgdnLog;
use App\Models\User;
use App\Services\WaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

/**
 * Controller workflow pengaduan di panel petugas.
 * Alur (sesuai BPMN): verifikasi -> (tolak | darurat->teknis | dsps->kabid)
 * -> tunjuk teknis + SLA -> tindak lanjut + LHTL -> selesai + survei SKM.
 */
class PengaduanController extends Controller
{
    public function __construct(protected WaService $wa) {}

    // ===== Daftar pengaduan (sesuai role) =====
    public function index(Request $request): View
    {
        $pgn = $request->user();

        $query = Pgdn::with(['bdg', 'teknis'])->latest();

        // kabid: hanya pengaduan bidangnya; teknis: hanya yg ditugaskn ke dia
        if ($pgn->isKabid()) {
            $query->where('bdg_id', $pgn->bdg_id);
        } elseif ($pgn->isTeknis()) {
            $query->where('teknis_id', $pgn->id);
        }

        // filter
        if ($request->sts) {
            $query->where('sts', $request->sts);
        }
        if ($request->kat) {
            $query->where('kat', $request->kat);
        }
        if ($request->q) {
            $query->where(fn ($w) => $w
                ->where('kd_tkt', 'like', "%{$request->q}%")
                ->orWhere('judul', 'like', "%{$request->q}%")
                ->orWhere('nama_pelapor', 'like', "%{$request->q}%"));
        }

        $dtPgdn = $query->paginate(12)->withQueryString();

        return view('panel.pengaduan.index', [
            'dtPgdn' => $dtPgdn,
            'filterSts' => $request->sts,
            'filterKat' => $request->kat,
        ]);
    }

    // ===== Detail pengaduan =====
    public function show(Pgdn $pgdn, Request $request): View
    {
        $this->pastikanBolehAkses($pgdn, $request->user());

        $pgdn->load(['bdg', 'bukti', 'verifikator', 'teknis', 'lhtl.petugas', 'skm', 'log' => fn ($q) => $q->with('petugas')->latest()]);

        // daftar tim teknis utk disposisi (sesuai bidang bila ada)
        $dtTeknis = User::where('role', 'teknis')->where('aktif', true)
            ->when($pgdn->bdg_id, fn ($q) => $q->where('bdg_id', $pgdn->bdg_id))
            ->get();

        return view('panel.pengaduan.show', compact('pgdn', 'dtTeknis'));
    }

    // ===== Aksi: Verifikasi (Admin) =====
    public function verifikasi(Pgdn $pgdn, Request $request): RedirectResponse
    {
        $this->pastikanAdmin($request->user());
        abort_unless($pgdn->sts === 'baru', 403, 'Pengaduan sudah diproses.');

        $this->ubahStatus($pgdn, 'verif', 'Verifikasi', 'Data pelapor terverifikasi.', [
            'verif_oleh' => $request->user()->id,
            'tgl_verif' => now(),
        ]);

        return back()->with('sukses', 'Pengaduan berhasil diverifikasi. Silakan tentukan tindak lanjut.');
    }

    // ===== Aksi: Tolak (Admin) =====
    public function tolak(Pgdn $pgdn, Request $request): RedirectResponse
    {
        $this->pastikanAdmin($request->user());
        abort_if(in_array($pgdn->sts, ['selesai', 'tolak']), 403);

        $data = $request->validate([
            'alasan_tolak' => ['required', 'string', 'min:5', 'max:500'],
        ], [], ['alasan_tolak' => 'alasan penolakan']);

        $this->ubahStatus($pgdn, 'tolak', 'Penolakan', $data['alasan_tolak'], [
            'alasan_tolak' => $data['alasan_tolak'],
        ]);

        // notif pelapor
        $this->wa->kirim($pgdn->no_telp,
            "Mohon maaf, pengaduan Anda ({$pgdn->kd_tkt}) tidak dapat kami proses.\nAlasan: {$data['alasan_tolak']}");

        return back()->with('sukses', 'Pengaduan ditolak dan pelapor telah diberi tahu.');
    }

    // ===== Aksi: Disposisi ke Kabid (Admin, non-darurat) =====
    public function disposisi(Pgdn $pgdn, Request $request): RedirectResponse
    {
        $this->pastikanAdmin($request->user());
        abort_unless($pgdn->sts === 'verif', 403, 'Pengaduan harus diverifikasi dahulu.');

        $data = $request->validate([
            'bdg_id' => ['required', 'exists:bdg,id'],
        ], [], ['bdg_id' => 'bidang']);

        $this->ubahStatus($pgdn, 'dsps', 'Disposisi ke Bidang', 'Diteruskan ke bidang terkait untuk penanganan.', [
            'bdg_id' => $data['bdg_id'],
            'darurat' => false,
            'tgl_dsps' => now(),
        ]);

        return back()->with('sukses', 'Pengaduan didisposisikan ke bidang. Menunggu penunjukan tim teknis oleh Kepala Bidang.');
    }

    // ===== Aksi: Tandai Darurat + tunjuk teknis langsung (Admin) =====
    public function darurat(Pgdn $pgdn, Request $request): RedirectResponse
    {
        $this->pastikanAdmin($request->user());
        abort_unless($pgdn->sts === 'verif', 403, 'Pengaduan harus diverifikasi dahulu.');

        $data = $request->validate([
            'bdg_id' => ['required', 'exists:bdg,id'],
            'teknis_id' => ['required', 'exists:users,id'],
            'batas_sla' => ['required', 'date', 'after:today'],
        ], [], [
            'bdg_id' => 'bidang',
            'teknis_id' => 'tim teknis',
            'batas_sla' => 'batas waktu',
        ]);

        $this->ubahStatus($pgdn, 'proses', 'Penanganan Darurat', 'Ditetapkan sebagai kasus darurat dan langsung ditindaklanjuti tim teknis.', [
            'darurat' => true,
            'bdg_id' => $data['bdg_id'],
            'teknis_id' => $data['teknis_id'],
            'batas_sla' => $data['batas_sla'],
            'tgl_dsps' => now(),
        ]);

        $teknis = User::find($data['teknis_id']);
        if ($teknis?->no_telp) {
            $this->wa->kirim($teknis->no_telp,
                "[DARURAT] Anda ditugaskan menangani pengaduan {$pgdn->kd_tkt}: {$pgdn->judul}. Segera tindak lanjuti.");
        }

        return back()->with('sukses', 'Pengaduan darurat ditetapkan dan tim teknis telah ditugaskan.');
    }

    // ===== Aksi: Tunjuk tim teknis + SLA (Kabid) =====
    public function tunjukTeknis(Pgdn $pgdn, Request $request): RedirectResponse
    {
        $pgn = $request->user();
        abort_unless($pgn->isKabid() && $pgdn->bdg_id === $pgn->bdg_id, 403, 'Bukan wewenang Anda.');
        abort_unless($pgdn->sts === 'dsps', 403, 'Pengaduan belum didisposisikan.');

        $data = $request->validate([
            'teknis_id' => ['required', 'exists:users,id'],
            'batas_sla' => ['required', 'date', 'after:today'],
        ], [], [
            'teknis_id' => 'tim teknis',
            'batas_sla' => 'batas waktu',
        ]);

        $this->ubahStatus($pgdn, 'proses', 'Penunjukan Tim Teknis', 'Tim teknis ditunjuk dan batas waktu ditetapkan.', [
            'teknis_id' => $data['teknis_id'],
            'batas_sla' => $data['batas_sla'],
        ]);

        $teknis = User::find($data['teknis_id']);
        if ($teknis?->no_telp) {
            $this->wa->kirim($teknis->no_telp,
                "Anda ditugaskan menangani pengaduan {$pgdn->kd_tkt}: {$pgdn->judul}.");
        }

        return back()->with('sukses', 'Tim teknis berhasil ditunjuk.');
    }

    // ===== Aksi: Simpan LHTL (Teknis) =====
    public function simpanLhtl(Pgdn $pgdn, Request $request): RedirectResponse
    {
        $pgn = $request->user();
        abort_unless($pgn->isTeknis() && $pgdn->teknis_id === $pgn->id, 403, 'Bukan tugas Anda.');
        abort_unless($pgdn->sts === 'proses', 403, 'Pengaduan belum dalam proses tindak lanjut.');

        $data = $request->validate([
            'uraian' => ['required', 'string', 'min:10', 'max:3000'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ], [], ['uraian' => 'uraian hasil tindak lanjut']);

        $pathFoto = null;
        if ($request->hasFile('foto')) {
            $pathFoto = $request->file('foto')->store('lhtl', 'public');
        }

        Lhtl::updateOrCreate(
            ['pgdn_id' => $pgdn->id],
            ['pgn_id' => $pgn->id, 'uraian' => $data['uraian'], 'foto' => $pathFoto]
        );

        PgdnLog::create([
            'pgdn_id' => $pgdn->id,
            'pgn_id' => $pgn->id,
            'aksi' => 'LHTL Diunggah',
            'sts_lama' => $pgdn->sts,
            'sts_baru' => $pgdn->sts,
            'ket' => 'Laporan Hasil Tindak Lanjut telah disusun tim teknis.',
        ]);

        return back()->with('sukses', 'LHTL berhasil disimpan. Menunggu verifikasi admin untuk penyelesaian.');
    }

    // ===== Aksi: Selesaikan + kirim survei SKM (Admin) =====
    public function selesai(Pgdn $pgdn, Request $request): RedirectResponse
    {
        $this->pastikanAdmin($request->user());
        abort_unless($pgdn->sts === 'proses', 403, 'Pengaduan belum dapat diselesaikan.');
        abort_unless($pgdn->lhtl, 403, 'LHTL belum diunggah tim teknis.');

        $token = Str::random(32);

        $this->ubahStatus($pgdn, 'selesai', 'Penyelesaian', 'Pengaduan dinyatakan selesai setelah LHTL diverifikasi.', [
            'tgl_selesai' => now(),
            'token_skm' => $token,
        ]);

        // kirim WA selesai + link survei
        $linkSurvei = route('skm.form', $token);
        $this->wa->kirim($pgdn->no_telp,
            "Pengaduan Anda ({$pgdn->kd_tkt}) telah SELESAI ditangani.\n\nMohon bantu nilai layanan kami melalui survei berikut:\n{$linkSurvei}\n\nTerima kasih.");

        return back()->with('sukses', 'Pengaduan diselesaikan. Link survei SKM telah dikirim ke pelapor.');
    }

    // ===== Dashboard SLA (Kadis - monitoring) =====
    public function monitorSla(Request $request): View
    {
        abort_unless($request->user()->isKadis() || $request->user()->isAdmin(), 403);

        $aktif = Pgdn::with(['bdg', 'teknis'])
            ->whereNotIn('sts', ['selesai', 'tolak'])
            ->whereNotNull('batas_sla')
            ->orderBy('batas_sla')
            ->get();

        $lewat = $aktif->filter(fn ($p) => $p->slaLewat());
        $mendekati = $aktif->filter(fn ($p) => ! $p->slaLewat() && $p->sisaSlaHari() !== null && $p->sisaSlaHari() <= 2);

        return view('panel.pengaduan.monitor-sla', compact('aktif', 'lewat', 'mendekati'));
    }

    // ===================================================================
    // Helper internal
    // ===================================================================

    /** Ubah status + catat log dlm transaksi. */
    protected function ubahStatus(Pgdn $pgdn, string $stsBaru, string $aksi, string $ket, array $tambahan = []): void
    {
        DB::transaction(function () use ($pgdn, $stsBaru, $aksi, $ket, $tambahan) {
            $stsLama = $pgdn->sts;
            $pgdn->update(array_merge(['sts' => $stsBaru], $tambahan));

            PgdnLog::create([
                'pgdn_id' => $pgdn->id,
                'pgn_id' => auth()->id(),
                'aksi' => $aksi,
                'sts_lama' => $stsLama,
                'sts_baru' => $stsBaru,
                'ket' => $ket,
            ]);
        });
    }

    protected function pastikanAdmin(User $pgn): void
    {
        abort_unless($pgn->isAdmin(), 403, 'Hanya Admin/PPID yang dapat melakukan aksi ini.');
    }

    /** Pastikan petugas boleh mengakses pengaduan ini sesuai role. */
    protected function pastikanBolehAkses(Pgdn $pgdn, User $pgn): void
    {
        if ($pgn->isKabid() && $pgdn->bdg_id !== $pgn->bdg_id) {
            abort(403, 'Pengaduan ini bukan untuk bidang Anda.');
        }
        if ($pgn->isTeknis() && $pgdn->teknis_id !== $pgn->id) {
            abort(403, 'Pengaduan ini tidak ditugaskan kepada Anda.');
        }
    }
}
