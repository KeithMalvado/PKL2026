
@extends('panel.layout')

@section('judul', 'Monitoring SLA')

@section('konten')

<div class="min-w-0 space-y-6">

    {{-- HEADER HALAMAN --}}
    <div class="flex flex-col gap-4 pt-2 sm:flex-row sm:items-center sm:justify-between">
        <div class="min-w-0">
            <h2 class="text-2xl font-bold tracking-tight text-slate-800">
                Monitoring SLA Pengaduan
            </h2>

            <p class="mt-2 text-sm leading-relaxed text-slate-500">
                Pantau tenggat waktu, progres, dan keterlambatan penanganan pengaduan masyarakat.
            </p>
        </div>

        <a href="{{ route('panel.pengaduan.index') }}"
           class="inline-flex shrink-0 items-center justify-center rounded-xl border border-hijau-200 bg-white px-5 py-3 text-sm font-semibold text-hijau-700 transition hover:bg-hijau-50">
            &larr; Daftar Pengaduan
        </a>
    </div>

    {{-- KARTU STATISTIK --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

        {{-- TOTAL AKTIF --}}
        <div class="min-w-0 rounded-2xl border border-hijau-100 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-slate-500">
                    Pengaduan Aktif
                </p>

                <span class="rounded-lg bg-hijau-50 px-3 py-2 text-hijau-700">
                    &#128203;
                </span>
            </div>

            <h3 class="mt-4 text-3xl font-extrabold text-hijau-700">
                {{ $aktif->count() }}
            </h3>

            <p class="mt-2 text-xs leading-relaxed text-slate-400">
                Tiket aktif yang memiliki batas SLA
            </p>
        </div>

        {{-- MENDEKATI SLA --}}
        <div class="min-w-0 rounded-2xl border border-amber-100 bg-amber-50 p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-amber-700">
                    Mendekati SLA
                </p>

                <span class="rounded-lg bg-amber-100 px-3 py-2 text-amber-700">
                    &#9200;
                </span>
            </div>

            <h3 class="mt-4 text-3xl font-extrabold text-amber-700">
                {{ $mendekati->count() }}
            </h3>

            <p class="mt-2 text-xs leading-relaxed text-amber-600">
                Mendekati batas waktu penanganan
            </p>
        </div>

        {{-- TERLAMBAT --}}
        <div class="min-w-0 rounded-2xl border border-red-100 bg-red-50 p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-red-700">
                    Melewati SLA
                </p>

                <span class="rounded-lg bg-red-100 px-3 py-2 text-red-700">
                    &#9888;
                </span>
            </div>

            <h3 class="mt-4 text-3xl font-extrabold text-red-700">
                {{ $lewat->count() }}
            </h3>

            <p class="mt-2 text-xs leading-relaxed text-red-600">
                Tiket yang sudah melewati deadline
            </p>
        </div>

    </div>

    {{-- DAFTAR PENGADUAN --}}
    <section class="min-w-0 max-w-full rounded-2xl border border-hijau-100 bg-white shadow-sm">

        {{-- HEADER TABEL --}}
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-hijau-100 p-5">
            <div>
                <h3 class="text-lg font-bold text-slate-800">
                    Daftar Pengaduan Aktif
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    Detail pengaduan berdasarkan batas waktu SLA.
                </p>
            </div>

            <span class="rounded-full bg-hijau-50 px-3 py-1.5 text-xs font-semibold text-hijau-700">
                {{ $aktif->count() }} Tiket
            </span>
        </div>

        {{-- TAMPILAN DESKTOP --}}
        <div class="hidden w-full min-w-0 max-w-full overflow-x-auto overscroll-x-contain md:block">

            <table class="w-full min-w-[950px] text-left text-sm">

                <thead class="bg-hijau-50 text-xs uppercase tracking-wide text-hijau-700">
                    <tr>
                        <th class="whitespace-nowrap px-5 py-4">
                            Kode Tiket
                        </th>

                        <th class="px-5 py-4">
                            Pengaduan
                        </th>

                        <th class="whitespace-nowrap px-5 py-4">
                            Bidang
                        </th>

                        <th class="whitespace-nowrap px-5 py-4">
                            Batas SLA
                        </th>

                        <th class="whitespace-nowrap px-5 py-4">
                            Kondisi
                        </th>

                        <th class="whitespace-nowrap px-5 py-4 text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-hijau-50">

                    @forelse($aktif as $pgdn)

                        @php
                            $terlambat = $pgdn->slaLewat();
                            $sisaHari = $pgdn->sisaSlaHari();
                        @endphp

                        <tr class="transition-colors hover:bg-hijau-50/50">

                            {{-- KODE TIKET --}}
                            <td class="whitespace-nowrap px-5 py-5 align-top">
                                <span class="font-bold text-hijau-700">
                                    {{ $pgdn->kd_tkt }}
                                </span>
                            </td>

                            {{-- INFORMASI PENGADUAN --}}
                            <td class="px-5 py-5 align-top">
                                <div class="max-w-[260px]">
                                    <p class="truncate font-semibold text-slate-800"
                                       title="{{ $pgdn->judul }}">
                                        {{ $pgdn->judul }}
                                    </p>

                                    <p class="mt-1 truncate text-xs text-slate-500">
                                        {{ $pgdn->teknis?->name ?? 'Belum ada petugas' }}
                                    </p>
                                </div>
                            </td>

                            {{-- BIDANG --}}
                            <td class="px-5 py-5 align-top">
                                <span class="text-slate-600">
                                    {{ $pgdn->bdg?->nama ?? '-' }}
                                </span>
                            </td>

                            {{-- BATAS SLA DALAM WIB --}}
                            <td class="whitespace-nowrap px-5 py-5 align-top text-slate-600">
                                {{ $pgdn->batas_sla
                                    ? $pgdn->batas_sla->copy()->setTimezone('Asia/Jakarta')->format('d M Y H:i')
                                    : '-' }}

                                <p class="mt-1 text-xs text-slate-400">
                                    WIB
                                </p>
                            </td>

                            {{-- STATUS SLA --}}
                            <td class="whitespace-nowrap px-5 py-5 align-top">

                                @if($terlambat)
                                    <span class="inline-flex rounded-full bg-red-100 px-3 py-1.5 text-xs font-bold text-red-700">
                                        Terlambat
                                    </span>

                                @elseif($sisaHari !== null && $sisaHari <= 2)
                                    <span class="inline-flex rounded-full bg-amber-100 px-3 py-1.5 text-xs font-bold text-amber-700">
                                        Mendekati
                                    </span>

                                @else
                                    <span class="inline-flex rounded-full bg-hijau-100 px-3 py-1.5 text-xs font-bold text-hijau-700">
                                        Dalam SLA
                                    </span>
                                @endif

                                <p class="mt-2 text-xs text-slate-500">
                                    @if($sisaHari !== null)
                                        @if($terlambat)
                                            {{ abs($sisaHari) }} hari terlambat
                                        @else
                                            {{ $sisaHari }} hari tersisa
                                        @endif
                                    @endif
                                </p>
                            </td>

                            {{-- TOMBOL DETAIL --}}
                            <td class="whitespace-nowrap px-5 py-5 text-center align-top">
                                <a href="{{ route('panel.pengaduan.show', $pgdn) }}"
                                   class="inline-flex items-center justify-center rounded-lg bg-hijau-700 px-4 py-2 text-xs font-semibold text-white transition hover:bg-hijau-800">
                                    Detail
                                </a>
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="6"
                                class="px-6 py-14 text-center text-sm text-slate-500">
                                Tidak ada pengaduan aktif dengan batas SLA.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        {{-- TAMPILAN MOBILE --}}
        <div class="space-y-4 p-4 md:hidden">

            @forelse($aktif as $pgdn)

                @php
                    $terlambat = $pgdn->slaLewat();
                    $sisaHari = $pgdn->sisaSlaHari();
                @endphp

                <div class="min-w-0 rounded-xl border border-hijau-100 bg-white p-4">

                    {{-- KODE DAN STATUS --}}
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="break-all text-xs font-bold text-hijau-700">
                            {{ $pgdn->kd_tkt }}
                        </span>

                        @if($terlambat)
                            <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                Terlambat
                            </span>

                        @elseif($sisaHari !== null && $sisaHari <= 2)
                            <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                                Mendekati
                            </span>

                        @else
                            <span class="rounded-full bg-hijau-100 px-3 py-1 text-xs font-semibold text-hijau-700">
                                Dalam SLA
                            </span>
                        @endif
                    </div>

                    {{-- JUDUL --}}
                    <h4 class="mt-4 break-words font-semibold text-slate-800">
                        {{ $pgdn->judul }}
                    </h4>

                    {{-- DETAIL --}}
                    <div class="mt-4 space-y-3 text-sm">

                        <div class="flex justify-between gap-3">
                            <span class="shrink-0 text-slate-500">
                                Bidang
                            </span>

                            <span class="min-w-0 text-right font-medium text-slate-700">
                                {{ $pgdn->bdg?->nama ?? '-' }}
                            </span>
                        </div>

                        <div class="flex justify-between gap-3">
                            <span class="shrink-0 text-slate-500">
                                Petugas
                            </span>

                            <span class="min-w-0 text-right font-medium text-slate-700">
                                {{ $pgdn->teknis?->name ?? 'Belum ditugaskan' }}
                            </span>
                        </div>

                        <div class="flex justify-between gap-3">
                            <span class="shrink-0 text-slate-500">
                                Batas SLA
                            </span>

                            <span class="text-right font-semibold text-slate-700">
                                {{ $pgdn->batas_sla
                                    ? $pgdn->batas_sla->copy()->setTimezone('Asia/Jakarta')->format('d M Y H:i')
                                    : '-' }} WIB
                            </span>
                        </div>

                        <div class="flex justify-between gap-3">
                            <span class="text-slate-500">
                                Sisa Waktu
                            </span>

                            <span class="text-right font-semibold
                                {{ $terlambat ? 'text-red-600' : 'text-hijau-700' }}">
                                @if($sisaHari !== null)
                                    {{ abs($sisaHari) }} hari
                                    {{ $terlambat ? 'terlambat' : 'tersisa' }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>

                    </div>

                    {{-- AKSI MOBILE --}}
                    <a href="{{ route('panel.pengaduan.show', $pgdn) }}"
                       class="mt-5 flex w-full items-center justify-center rounded-xl bg-hijau-700 px-4 py-3 text-sm font-semibold text-white transition hover:bg-hijau-800">
                        Lihat Detail Pengaduan
                    </a>
                </div>

            @empty
                <div class="py-12 text-center">
                    <p class="text-sm font-medium text-slate-600">
                        Belum ada pengaduan aktif
                    </p>

                    <p class="mt-2 text-xs text-slate-400">
                        Pengaduan yang memiliki batas SLA akan muncul di sini.
                    </p>
                </div>
            @endforelse

        </div>

    </section>

    {{-- INFORMASI TAMBAHAN --}}
    <div class="rounded-xl border border-hijau-100 bg-hijau-50 p-4">

        <div class="flex items-start gap-3">
            <span class="text-xl text-hijau-700">
                &#9432;
            </span>

            <div>
                <h4 class="text-sm font-bold text-hijau-800">
                    Informasi Monitoring SLA
                </h4>

                <p class="mt-1 text-sm leading-relaxed text-hijau-700">
                    Dashboard menampilkan pengaduan aktif yang memiliki
                    batas waktu penanganan. Pengaduan yang sudah selesai
                    atau ditolak tidak dihitung sebagai tiket aktif.
                    Seluruh waktu ditampilkan dalam WIB.
                </p>
            </div>
        </div>

    </div>

</div>

@endsection
