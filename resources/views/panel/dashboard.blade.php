@extends('panel.layout')

@section('judul', 'Dashboard')

@section('konten')
    {{-- sapaan --}}
    <div class="gradasi-hero relative mb-6 overflow-hidden rounded-3xl p-6 text-white shadow-lg shadow-ink-900/10 md:p-8">
        <div class="pola-titik absolute inset-0 opacity-30"></div>
        <div class="animasi-mengambang absolute -right-8 -top-12 h-40 w-40 rounded-full bg-sage-400/25 blur-3xl"></div>
        <div class="relative">
            <p class="text-[11px] font-bold uppercase tracking-[0.14em] text-hijau-200">Panel Petugas</p>
            <h2 class="mt-1.5 text-xl font-extrabold md:text-2xl">Selamat datang, {{ auth()->user()->name }}</h2>
            <p class="mt-1.5 text-sm text-hijau-100/80">Ringkasan aktivitas sistem pengaduan dan layanan.</p>
        </div>
    </div>

    {{-- kartu statistik --}}
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ([
            ['label' => 'Total Pengaduan', 'nilai' => $statPgdn['total'], 'warna' => 'hijau', 'ikon' => 'M8 10.5h8m-8 3h5m-9 5.25V6.75A2.25 2.25 0 016.25 4.5h11.5A2.25 2.25 0 0120 6.75v7.5a2.25 2.25 0 01-2.25 2.25H8.5L4 20.25z'],
            ['label' => 'Baru Masuk', 'nilai' => $statPgdn['baru'], 'warna' => 'amber', 'ikon' => 'M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['label' => 'Diproses', 'nilai' => $statPgdn['proses'], 'warna' => 'sky', 'ikon' => 'M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99'],
            ['label' => 'Selesai', 'nilai' => $statPgdn['selesai'], 'warna' => 'hijau', 'ikon' => 'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
        ] as $i => $kartu)
            @php
                $kelasWarna = match($kartu['warna']) {
                    'amber' => 'bg-gradient-to-br from-emas-400 to-emas-600 text-white',
                    'sky' => 'bg-gradient-to-br from-moss-500 to-sage-500 text-white',
                    default => 'bg-gradient-to-br from-hijau-500 to-sage-600 text-white',
                };
            @endphp
            <div data-reveal data-delay="{{ $i + 1 }}" class="kartu kartu-angkat p-5">
                <div class="flex items-center justify-between">
                    <span class="grid h-11 w-11 place-items-center rounded-xl shadow-md {{ $kelasWarna }}">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $kartu['ikon'] }}"/></svg>
                    </span>
                </div>
                <p class="mt-4 text-3xl font-extrabold text-ink-900">{{ $kartu['nilai'] }}</p>
                <p class="text-sm text-ink-500">{{ $kartu['label'] }}</p>
            </div>
        @endforeach
    </div>

    {{-- pengaduan terbaru + info --}}
    <div class="mt-6 grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm">
            <h3 class="mb-4 font-bold text-ink-800">Pengaduan Terbaru</h3>
            @if ($pgdnTerbaru->count())
                <div class="space-y-3">
                    @foreach ($pgdnTerbaru as $pgdn)
                        <div class="flex items-center justify-between gap-3 rounded-xl border border-hijau-50 bg-hijau-50/30 p-3">
                            <div class="min-w-0">
                                <p class="truncate text-sm font-semibold text-ink-700">{{ $pgdn->judul }}</p>
                                <p class="text-xs text-ink-400">{{ $pgdn->kd_tkt }} &bull; {{ $pgdn->created_at->diffForHumans() }}</p>
                            </div>
                            <span class="shrink-0 rounded-full bg-hijau-100 px-2.5 py-0.5 text-xs font-semibold text-hijau-700">{{ $pgdn->labelSts() }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="py-8 text-center text-sm text-ink-400">Belum ada pengaduan masuk.</p>
            @endif
        </div>

        <div class="rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm">
            <h3 class="mb-4 font-bold text-ink-800">Perlu Perhatian</h3>
            <div class="space-y-3">
                <div class="flex items-center gap-3 rounded-xl bg-emas-50 p-4">
                    <span class="grid h-10 w-10 place-items-center rounded-lg bg-emas-100 text-emas-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z"/></svg>
                    </span>
                    <div>
                        <p class="text-lg font-bold text-emas-700">{{ $forumTunggu }}</p>
                        <p class="text-xs text-emas-600">Forum menunggu moderasi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
