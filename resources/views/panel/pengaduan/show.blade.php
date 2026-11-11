
@extends('panel.layout')

@section('judul', 'Detail Pengaduan')

@section('konten')
@php
    $pgn = auth()->user();

    $warnaStatus = [
        'baru' => 'bg-slate-100 text-slate-700',
        'verif' => 'bg-blue-100 text-blue-700',
        'dsps' => 'bg-purple-100 text-purple-700',
        'proses' => 'bg-amber-100 text-amber-700',
        'selesai' => 'bg-hijau-100 text-hijau-700',
        'tolak' => 'bg-red-100 text-red-700',
    ];

    $inputClass = 'mt-2 w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none focus:border-hijau-500 focus:ring-2 focus:ring-hijau-100';

    $buttonClass = 'mt-3 w-full rounded-xl bg-hijau-700 px-4 py-3 text-sm font-semibold text-white transition hover:bg-hijau-800';
@endphp

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-wrap items-start justify-between gap-4">
        <div>
            <a href="{{ route('panel.pengaduan.index') }}"
               class="text-sm font-medium text-hijau-700 hover:underline">
                &larr; Kembali ke Daftar Pengaduan
            </a>

            <h2 class="mt-3 text-2xl font-bold text-slate-800">
                Detail Pengaduan
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Kode Tiket:
                <span class="font-bold text-hijau-700">
                    {{ $pgdn->kd_tkt }}
                </span>
            </p>
        </div>

        <div class="flex flex-wrap gap-2">
            <span class="rounded-full px-4 py-2 text-xs font-bold
                {{ $warnaStatus[$pgdn->sts] ?? 'bg-slate-100 text-slate-700' }}">
                {{ $pgdn->labelSts() }}
            </span>

            @if($pgdn->darurat)
                <span class="rounded-full bg-red-100 px-4 py-2 text-xs font-bold text-red-700">
                    DARURAT
                </span>
            @endif
        </div>
    </div>

    {{-- VALIDASI ERROR --}}
    @if($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 p-4">
            <p class="font-semibold text-red-700">
                Periksa kembali data yang dimasukkan:
            </p>

            <ul class="mt-2 list-disc pl-5 text-sm text-red-600">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

        {{-- KOLOM INFORMASI --}}
        <div class="space-y-6 xl:col-span-2">

            {{-- INFORMASI PENGADUAN --}}
            <section class="rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm">
                <h3 class="mb-5 text-lg font-bold text-slate-800">
                    Informasi Pengaduan
                </h3>

                <div class="grid grid-cols-1 gap-5 text-sm sm:grid-cols-2">

                    <div>
                        <p class="text-slate-500">Nama Pelapor</p>
                        <p class="mt-1 font-semibold text-slate-800">
                            {{ $pgdn->nama_pelapor }}
                        </p>
                    </div>

                    <div>
                        <p class="text-slate-500">Tanggal Pengaduan</p>
                        <p class="mt-1 font-semibold text-slate-800">
                            {{ $pgdn->created_at?->format('d M Y, H:i') ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-slate-500">Kategori</p>
                        <p class="mt-1 font-semibold text-slate-800">
                            {{ $pgdn->kat }}
                        </p>
                    </div>

                    <div>
                        <p class="text-slate-500">Nomor Telepon</p>
                        <p class="mt-1 font-semibold text-slate-800">
                            {{ $pgdn->no_telp ?: '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-slate-500">Email</p>
                        <p class="mt-1 break-all font-semibold text-slate-800">
                            {{ $pgdn->email ?: '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-slate-500">Lokasi</p>
                        <p class="mt-1 font-semibold text-slate-800">
                            {{ $pgdn->lokasi ?: '-' }}
                        </p>
                    </div>

                    <div class="sm:col-span-2">
                        <p class="text-slate-500">Judul Pengaduan</p>
                        <p class="mt-1 font-semibold text-slate-800">
                            {{ $pgdn->judul }}
                        </p>
                    </div>

                    <div class="sm:col-span-2">
                        <p class="text-slate-500">Isi Pengaduan</p>
                        <p class="mt-2 whitespace-pre-line break-words leading-relaxed text-slate-700">{{ $pgdn->isi }}</p>
                    </div>

                    @if($pgdn->alasan_tolak)
                        <div class="sm:col-span-2">
                            <p class="font-semibold text-red-700">
                                Alasan Penolakan
                            </p>
                            <p class="mt-2 text-red-600">
                                {{ $pgdn->alasan_tolak }}
                            </p>
                        </div>
                    @endif

                </div>
            </section>

            {{-- PENANGANAN DAN SLA --}}
            <section class="rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm">
                <h3 class="mb-5 text-lg font-bold text-slate-800">
                    Penanganan dan SLA
                </h3>

                <div class="grid grid-cols-1 gap-5 text-sm sm:grid-cols-2">

                    <div>
                        <p class="text-slate-500">Bidang Penanganan</p>
                        <p class="mt-1 font-semibold text-slate-800">
                            {{ $pgdn->bdg?->nama ?? 'Belum ditentukan' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-slate-500">Petugas Teknis</p>
                        <p class="mt-1 font-semibold text-slate-800">
                            {{ $pgdn->teknis?->name ?? 'Belum ditugaskan' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-slate-500">Batas Waktu SLA</p>
                        <p class="mt-1 font-semibold text-slate-800">
                            {{ $pgdn->batas_sla
                                ? $pgdn->batas_sla->copy()->setTimezone('Asia/Jakarta')->format('d M Y H:i')
                                : 'Belum ditentukan' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-slate-500">Status SLA</p>

                        @if(!$pgdn->batas_sla)
                            <p class="mt-1 text-slate-500">Belum ditentukan</p>
                        @elseif($pgdn->sts === 'selesai')
                            <p class="mt-1 font-semibold text-hijau-700">
                                Pengaduan selesai
                            </p>
                        @elseif($pgdn->sts === 'tolak')
                            <p class="mt-1 text-slate-500">Ditolak</p>
                        @elseif($pgdn->slaLewat())
                            <p class="mt-1 font-semibold text-red-600">
                                Melewati batas waktu
                            </p>
                        @else
                            <p class="mt-1 font-semibold text-hijau-700">
                                Dalam batas SLA
                                ({{ $pgdn->sisaSlaHari() }} hari)
                            </p>
                        @endif
                    </div>

                </div>
            </section>

            {{-- BUKTI PENGADUAN --}}
            <section class="rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm">
                <h3 class="mb-4 text-lg font-bold text-slate-800">
                    Bukti Pengaduan
                </h3>

                @forelse($pgdn->bukti as $bukti)
                    <a href="{{ asset('storage/' . $bukti->path) }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="mb-2 block rounded-xl bg-hijau-50 p-3 text-sm text-hijau-700 hover:bg-hijau-100">
                        Lihat Lampiran:
                        {{ $bukti->nama_asli ?: 'Bukti Pengaduan' }}
                    </a>
                @empty
                    <p class="text-sm text-slate-500">
                        Belum ada bukti pengaduan.
                    </p>
                @endforelse
            </section>

            {{-- HASIL TINDAK LANJUT --}}
            <section class="rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm">
                <h3 class="mb-4 text-lg font-bold text-slate-800">
                    Laporan Hasil Tindak Lanjut (LHTL)
                </h3>

                @if($pgdn->lhtl)
                    <p class="whitespace-pre-line break-words text-sm leading-relaxed text-slate-700">{{ $pgdn->lhtl->uraian }}</p>

                    <p class="mt-4 text-xs text-slate-500">
                        Dikerjakan oleh:
                        {{ $pgdn->lhtl->petugas?->name ?? '-' }}
                    </p>

                    @if($pgdn->lhtl->foto)
                        <a href="{{ asset('storage/' . $pgdn->lhtl->foto) }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="mt-3 inline-block text-sm font-semibold text-hijau-700 hover:underline">
                            Lihat Foto Hasil Penanganan
                        </a>
                    @endif
                @else
                    <p class="text-sm text-slate-500">
                        Tim teknis belum mengirimkan LHTL.
                    </p>
                @endif
            </section>

            {{-- RIWAYAT PENGADUAN --}}
            <section class="rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm">
                <h3 class="mb-5 text-lg font-bold text-slate-800">
                    Riwayat Penanganan
                </h3>

                @forelse($pgdn->log as $log)
                    <div class="mb-5 border-l-2 border-hijau-300 pl-4">
                        <div class="flex flex-wrap justify-between gap-2">
                            <h4 class="font-semibold text-slate-800">
                                {{ $log->aksi }}
                            </h4>

                            <span class="text-xs text-slate-400">
                                {{ $log->created_at?->format('d M Y H:i') }}
                            </span>
                        </div>

                        <p class="mt-2 text-sm text-slate-600">
                            {{ $log->ket }}
                        </p>

                        <p class="mt-2 text-xs text-slate-400">
                            Petugas:
                            {{ $log->petugas?->name ?? 'Sistem' }}
                        </p>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">
                        Belum ada riwayat tindakan.
                    </p>
                @endforelse
            </section>
        </div>

        {{-- KOLOM AKSI --}}
        <aside class="space-y-5">
            <section class="rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm">

                <h3 class="text-lg font-bold text-slate-800">
                    Aksi Pengaduan
                </h3>

                <p class="mt-2 text-xs text-slate-500">
                    Aksi tersedia berdasarkan status laporan dan peran petugas.
                </p>

                <div class="mt-5 space-y-6">

                    {{-- ADMIN: VERIFIKASI --}}
                    @if($pgn->isAdmin() && $pgdn->sts === 'baru')
                        <form method="POST"
                              action="{{ route('panel.pengaduan.verifikasi', $pgdn) }}">
                            @csrf

                            <h4 class="font-semibold text-slate-800">
                                Verifikasi Pengaduan
                            </h4>

                            <p class="mt-2 text-sm text-slate-500">
                                Periksa kelengkapan laporan sebelum diverifikasi.
                            </p>

                            <button type="submit" class="{{ $buttonClass }}">
                                Verifikasi Sekarang
                            </button>
                        </form>
                    @endif

                    {{-- ADMIN: TOLAK --}}
                    @if($pgn->isAdmin() && !in_array($pgdn->sts, ['tolak', 'selesai'], true))
                        <form method="POST"
                              action="{{ route('panel.pengaduan.tolak', $pgdn) }}"
                              onsubmit="return confirm('Yakin ingin menolak laporan ini?')">
                            @csrf

                            <h4 class="font-semibold text-slate-800">
                                Tolak Pengaduan
                            </h4>

                            <textarea name="alasan_tolak"
                                      rows="3"
                                      minlength="5"
                                      maxlength="500"
                                      required
                                      placeholder="Masukkan alasan penolakan..."
                                      class="{{ $inputClass }}">{{ old('alasan_tolak') }}</textarea>

                            <button type="submit"
                                    class="mt-3 w-full rounded-xl bg-red-600 px-4 py-3 text-sm font-semibold text-white hover:bg-red-700">
                                Tolak Pengaduan
                            </button>
                        </form>
                    @endif

                    {{-- ADMIN: DISPOSISI --}}
                    @if($pgn->isAdmin() && $pgdn->sts === 'verif')
                        <form method="POST"
                              action="{{ route('panel.pengaduan.disposisi', $pgdn) }}">
                            @csrf

                            <h4 class="font-semibold text-slate-800">
                                Disposisi Pengaduan
                            </h4>

                            <label class="mt-3 block text-sm text-slate-600">
                                Pilih Bidang
                            </label>

                            <select name="bdg_id"
                                    required
                                    class="{{ $inputClass }}">
                                <option value="">Pilih Bidang</option>

                                @foreach($dtBdg as $bdg)
                                    <option value="{{ $bdg->id }}"
                                        @selected(old('bdg_id') == $bdg->id)>
                                        {{ $bdg->nama }}
                                    </option>
                                @endforeach
                            </select>

                            <button type="submit" class="{{ $buttonClass }}">
                                Kirim Disposisi
                            </button>
                        </form>

                        {{-- ADMIN: PENANGANAN DARURAT --}}
                        <form method="POST"
                              action="{{ route('panel.pengaduan.darurat', $pgdn) }}">
                            @csrf

                            <h4 class="font-semibold text-red-700">
                                Penanganan Darurat
                            </h4>

                            <label class="mt-3 block text-sm text-slate-600">
                                Bidang Tujuan
                            </label>

                            <select name="bdg_id"
                                    id="bidangDarurat"
                                    required
                                    class="{{ $inputClass }}">
                                <option value="">Pilih Bidang</option>

                                @foreach($dtBdg as $bdg)
                                    <option value="{{ $bdg->id }}">
                                        {{ $bdg->nama }}
                                    </option>
                                @endforeach
                            </select>

                            <label class="mt-3 block text-sm text-slate-600">
                                Tim Teknis
                            </label>

                            <select name="teknis_id"
                                    id="teknisDarurat"
                                    required
                                    class="{{ $inputClass }}">
                                <option value="">Pilih Tim Teknis</option>

                                @foreach($dtTeknis as $teknis)
                                    <option value="{{ $teknis->id }}"
                                            data-bidang="{{ $teknis->bdg_id }}">
                                        {{ $teknis->name }}
                                        — {{ $teknis->bdg?->nama ?? '-' }}
                                    </option>
                                @endforeach
                            </select>

                            <label class="mt-3 block text-sm text-slate-600">
                                Batas SLA
                            </label>

                            <input type="date"
                                   name="batas_sla"
                                   min="{{ now()->addDay()->toDateString() }}"
                                   required
                                   class="{{ $inputClass }}">

                            <button type="submit"
                                    class="mt-3 w-full rounded-xl bg-red-600 px-4 py-3 text-sm font-semibold text-white hover:bg-red-700">
                                Tetapkan Darurat
                            </button>
                        </form>
                    @endif

                    {{-- KABID: TUNJUK TEKNIS --}}
                    @if($pgn->isKabid() && $pgdn->sts === 'dsps')
                        <form method="POST"
                              action="{{ route('panel.pengaduan.tunjuk-teknis', $pgdn) }}">
                            @csrf

                            <h4 class="font-semibold text-slate-800">
                                Penugasan Tim Teknis
                            </h4>

                            <label class="mt-3 block text-sm text-slate-600">
                                Pilih Petugas
                            </label>

                            <select name="teknis_id"
                                    required
                                    class="{{ $inputClass }}">
                                <option value="">Pilih Petugas</option>

                                @foreach($dtTeknis as $teknis)
                                    <option value="{{ $teknis->id }}"
                                        @selected(old('teknis_id') == $teknis->id)>
                                        {{ $teknis->name }}
                                    </option>
                                @endforeach
                            </select>

                            <label class="mt-3 block text-sm text-slate-600">
                                Batas Waktu SLA
                            </label>

                            <input type="date"
                                   name="batas_sla"
                                   min="{{ now()->addDay()->toDateString() }}"
                                   value="{{ old('batas_sla') }}"
                                   required
                                   class="{{ $inputClass }}">

                            <button type="submit" class="{{ $buttonClass }}">
                                Tetapkan Tim Teknis
                            </button>
                        </form>
                    @endif

                    {{-- TEKNIS: LAPORAN TINDAK LANJUT --}}
                    @if($pgn->isTeknis() && $pgdn->sts === 'proses' && (int)$pgdn->teknis_id === (int)$pgn->id)
                        <form method="POST"
                              action="{{ route('panel.pengaduan.lhtl', $pgdn) }}"
                              enctype="multipart/form-data">
                            @csrf

                            <h4 class="font-semibold text-slate-800">
                                Input LHTL
                            </h4>

                            <label class="mt-3 block text-sm text-slate-600">
                                Uraian Hasil Tindak Lanjut
                            </label>

                            <textarea name="uraian"
                                      rows="5"
                                      minlength="10"
                                      maxlength="3000"
                                      required
                                      class="{{ $inputClass }}"
                                      placeholder="Jelaskan hasil penanganan pengaduan...">{{ old('uraian', $pgdn->lhtl?->uraian ?? '') }}</textarea>

                            <label class="mt-3 block text-sm text-slate-600">
                                Foto Hasil Penanganan
                            </label>

                            <input type="file"
                                   name="foto"
                                   accept=".jpg,.jpeg,.png"
                                   class="{{ $inputClass }}">

                            <p class="mt-2 text-xs text-slate-500">
                                JPG atau PNG, maksimal 2 MB.
                            </p>

                            <button type="submit" class="{{ $buttonClass }}">
                                Simpan LHTL
                            </button>
                        </form>
                    @endif

                    {{-- ADMIN: SELESAIKAN PENGADUAN --}}
                    @if($pgn->isAdmin() && $pgdn->sts === 'proses')
                        @if($pgdn->lhtl)
                            <form method="POST"
                                  action="{{ route('panel.pengaduan.selesai', $pgdn) }}"
                                  onsubmit="return confirm('Pastikan LHTL sudah diperiksa. Selesaikan laporan?')">
                                @csrf

                                <h4 class="font-semibold text-slate-800">
                                    Penutupan Pengaduan
                                </h4>

                                <p class="mt-2 text-sm text-slate-500">
                                    Pastikan hasil tindak lanjut telah sesuai.
                                </p>

                                <button type="submit" class="{{ $buttonClass }}">
                                    Tandai Selesai
                                </button>
                            </form>
                        @else
                            <p class="rounded-xl bg-amber-50 p-3 text-sm text-amber-700">
                                Menunggu LHTL dari tim teknis sebelum pengaduan bisa ditutup.
                            </p>
                        @endif
                    @endif

                    @if(in_array($pgdn->sts, ['selesai', 'tolak'], true))
                        <p class="rounded-xl bg-slate-50 p-3 text-sm text-slate-500">
                            Pengaduan sudah ditutup.
                        </p>
                    @elseif($pgn->isKadis())
                        <p class="rounded-xl bg-hijau-50 p-3 text-sm text-hijau-700">
                            Kepala Dinas memiliki akses pemantauan.
                        </p>
                    @endif

                </div>
            </section>
        </aside>

    </div>
</div>
@endsection

@push('skrip')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const bidang = document.getElementById('bidangDarurat');
    const teknis = document.getElementById('teknisDarurat');

    if (!bidang || !teknis) return;

    function filterTeknis() {
        const bidangId = bidang.value;

        Array.from(teknis.options).forEach(function (option) {
            if (!option.value) return;

            const sesuai = option.dataset.bidang === bidangId;
            option.hidden = !sesuai;
            option.disabled = !sesuai;
        });

        teknis.value = '';
    }

    bidang.addEventListener('change', filterTeknis);
    filterTeknis();
});
</script>
@endpush
