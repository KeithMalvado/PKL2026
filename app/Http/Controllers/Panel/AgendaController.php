<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Bdg;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AgendaController extends Controller
{
    /**
     * Daftar agenda.
     * Admin melihat semuanya, Kabid hanya bidang sendiri.
     */
    public function index(Request $request): View
    {
        $pgn = $request->user();
        $this->cekBidang($pgn);

        $filter = $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'tahun' => ['nullable', 'integer', 'between:2020,2100'],
            'bulan' => ['nullable', 'integer', 'between:1,12'],
            'status' => [
                'nullable',
                Rule::in(['mendatang', 'selesai', 'dibatalkan']),
            ],
        ]);

        $query = Agenda::query()->with('bdg');

        if ($pgn->isKabid()) {
            $query->where('bdg_id', $pgn->bdg_id);
        }

        if (!empty($filter['q'])) {
            $kata = $filter['q'];

            $query->where(function ($q) use ($kata) {
                $q->where('judul', 'like', "%{$kata}%")
                    ->orWhere('uraian', 'like', "%{$kata}%")
                    ->orWhere('lokasi', 'like', "%{$kata}%");
            });
        }

        if (!empty($filter['tahun'])) {
            $query->whereYear('tanggal', $filter['tahun']);
        }

        if (!empty($filter['bulan'])) {
            $query->whereMonth('tanggal', $filter['bulan']);
        }

        $hariIni = now('Asia/Jakarta')->toDateString();

        if (($filter['status'] ?? null) === 'mendatang') {
            $query->whereNull('dibatalkan_at')
                ->whereDate('tanggal', '>=', $hariIni);
        }

        if (($filter['status'] ?? null) === 'selesai') {
            $query->whereNull('dibatalkan_at')
                ->whereDate('tanggal', '<', $hariIni);
        }

        if (($filter['status'] ?? null) === 'dibatalkan') {
            $query->whereNotNull('dibatalkan_at');
        }

        $agendas = $query
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('panel.agenda.index', compact(
            'agendas',
            'filter'
        ));
    }

    /**
     * Form tambah agenda.
     */
    public function create(Request $request): View
    {
        $pgn = $request->user();
        $this->cekBidang($pgn);

        $agenda = new Agenda();

        $bidangs = $pgn->isAdmin()
            ? Bdg::orderBy('id')->get()
            : collect();

        return view('panel.agenda.form', [
            'agenda' => $agenda,
            'bidangs' => $bidangs,
            'isEdit' => false,
        ]);
    }

    /**
     * Simpan dan langsung publikasikan agenda.
     */
    public function simpan(Request $request): RedirectResponse
    {
        $pgn = $request->user();
        $this->cekBidang($pgn);

        $data = $request->validate(
            $this->aturanValidasi($pgn)
        );

        $agenda = new Agenda();

        $agenda->fill($data);

        $agenda->bdg_id = $pgn->isAdmin()
            ? $data['bdg_id']
            : $pgn->bdg_id;

        $agenda->dibuat_oleh = $pgn->id;
        $agenda->diperbarui_oleh = $pgn->id;
        $agenda->status_publikasi = 'terbit';

        $agenda->save();

        return redirect()
            ->route('panel.agenda.index')
            ->with('sukses', 'Agenda berhasil dipublikasikan.');
    }

    /**
     * Form edit agenda.
     */
    public function edit(Request $request, Agenda $agenda): View
    {
        $pgn = $request->user();
        $this->cekPemilik($agenda, $pgn);

        $bidangs = $pgn->isAdmin()
            ? Bdg::orderBy('id')->get()
            : collect();

        return view('panel.agenda.form', [
            'agenda' => $agenda,
            'bidangs' => $bidangs,
            'isEdit' => true,
        ]);
    }

    /**
     * Memperbarui agenda.
     */
    public function perbarui(
        Request $request,
        Agenda $agenda
    ): RedirectResponse {
        $pgn = $request->user();
        $this->cekPemilik($agenda, $pgn);

        $data = $request->validate(
            $this->aturanValidasi($pgn)
        );

        $agenda->fill($data);

        if ($pgn->isAdmin()) {
            $agenda->bdg_id = $data['bdg_id'];
        }

        $agenda->diperbarui_oleh = $pgn->id;

        $agenda->save();

        return redirect()
            ->route('panel.agenda.index')
            ->with('sukses', 'Agenda berhasil diperbarui.');
    }

    /**
     * Hapus agenda dengan soft delete.
     */
    public function hapus(
        Request $request,
        Agenda $agenda
    ): RedirectResponse {
        $this->cekPemilik($agenda, $request->user());

        $agenda->delete();

        return redirect()
            ->route('panel.agenda.index')
            ->with('sukses', 'Agenda berhasil dihapus.');
    }

    /**
     * Aturan input agenda sesuai format PPID.
     */
    private function aturanValidasi($pgn): array
    {
        $aturan = [
            'judul' => ['required', 'string', 'max:200'],
            'uraian' => ['required', 'string', 'max:5000'],
            'tanggal' => ['required', 'date'],
            'lokasi' => ['required', 'string', 'max:255'],
            'waktu_mulai' => ['required', 'date_format:H:i'],
            'waktu_selesai' => [
                'nullable',
                'date_format:H:i',
                'after:waktu_mulai',
            ],
            'keterangan_waktu' => [
                'nullable',
                'string',
                'max:100',
            ],
        ];

        // Admin memilih bidang melalui form.
        if ($pgn->isAdmin()) {
            $aturan['bdg_id'] = [
                'required',
                'integer',
                Rule::exists('bdg', 'id'),
            ];
        }

        return $aturan;
    }

    /**
     * Kabid wajib terhubung ke sebuah bidang.
     */
    private function cekBidang($pgn): void
    {
        if ($pgn->isKabid() && !$pgn->bdg_id) {
            abort(403, 'Akun Kabid belum memiliki bidang.');
        }
    }

    /**
     * Cegah Kabid mengelola agenda bidang lain.
     */
    private function cekPemilik(Agenda $agenda, $pgn): void
    {
        if ($pgn->isAdmin()) {
            return;
        }

        abort_unless(
            $pgn->isKabid()
            && $pgn->bdg_id
            && (int) $agenda->bdg_id === (int) $pgn->bdg_id,
            403,
            'Anda tidak memiliki akses ke agenda ini.'
        );
    }
}
