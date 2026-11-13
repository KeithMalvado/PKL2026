@extends('publik.layout')

@section('judul', 'Produk Hukum & Kebijakan')

@section('konten')
    <x-hero-halaman judul="Produk Hukum & Kebijakan" induk="Galeri" ket="Dokumen regulasi, kebijakan, dan peraturan yang dapat diunduh." />

    <section class="mx-auto max-w-6xl px-4 py-16 md:px-6 md:py-20">
        {{-- filter jenis + pencarian --}}
        <div class="mb-10 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between" data-reveal>
            @if ($dtJenis->count())
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('galeri.produk-hukum') }}" class="rounded-full px-4 py-2 text-sm font-semibold transition {{ !$jenis ? 'bg-gradient-to-r from-hijau-600 to-sage-600 text-white shadow-md shadow-hijau-600/20' : 'border border-ink-200 bg-white text-ink-500 hover:border-hijau-300 hover:text-hijau-700' }}">Semua</a>
                    @foreach ($dtJenis as $j)
                        <a href="{{ route('galeri.produk-hukum', ['jenis' => $j]) }}" class="rounded-full px-4 py-2 text-sm font-semibold uppercase transition {{ $jenis === $j ? 'bg-gradient-to-r from-hijau-600 to-sage-600 text-white shadow-md shadow-hijau-600/20' : 'border border-ink-200 bg-white text-ink-500 hover:border-hijau-300 hover:text-hijau-700' }}">{{ $j }}</a>
                    @endforeach
                </div>
            @else
                <span></span>
            @endif

            <form method="GET" class="flex w-full gap-2.5 lg:w-auto">@if ($jenis)<input type="hidden" name="jenis" value="{{ $jenis }}">@endif
                <div class="relative min-w-0 flex-1 lg:w-72 lg:flex-none">
                    <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-ink-300" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                    <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari dokumen..." class="w-full rounded-2xl border border-ink-200 bg-white py-3 pl-12 pr-4 text-sm text-ink-700 shadow-sm outline-none transition placeholder:text-ink-300 focus:border-hijau-400 focus:ring-4 focus:ring-hijau-100">
                </div>
                <button class="rounded-2xl bg-gradient-to-r from-hijau-600 to-sage-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-hijau-600/20 transition hover:-translate-y-0.5 hover:shadow-xl">Cari</button>
            </form>
        </div>

        @if ($dtProdHkm->count())
            <div class="space-y-3.5">
                @foreach ($dtProdHkm as $i => $dok)
                    <div data-reveal data-delay="{{ ($i % 3) + 1 }}" class="group flex flex-col gap-4 rounded-2xl border border-hijau-100 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-0.5 hover:border-hijau-300 hover:shadow-lg sm:flex-row sm:items-center">
                        {{-- ikon dokumen --}}
                        <span class="grid h-14 w-14 shrink-0 place-items-center rounded-2xl bg-gradient-to-br from-hijau-50 to-sage-50 text-hijau-600 ring-1 ring-hijau-100 transition duration-300 group-hover:from-hijau-500 group-hover:to-sage-500 group-hover:text-white">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                        </span>

                        {{-- info --}}
                        <div class="min-w-0 flex-1">
                            <div class="flex flex-wrap items-center gap-2">
                                @if ($dok->jenis)
                                    <span class="rounded-full bg-gradient-to-r from-hijau-100 to-sage-100 px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wide text-hijau-700">{{ $dok->jenis }}</span>
                                @endif
                                @if ($dok->thn)
                                    <span class="text-xs text-ink-400">Tahun {{ $dok->thn }}</span>
                                @endif
                                <span class="text-xs text-ink-400">{{ $dok->diunduh }}x diunduh</span>
                            </div>
                            <h3 class="mt-1.5 font-bold text-ink-800">{{ $dok->judul }}</h3>
                            @if ($dok->no_dok)
                                <p class="text-sm text-ink-500">Nomor: {{ $dok->no_dok }}</p>
                            @endif
                            @if ($dok->ket)
                                <p class="mt-1 line-clamp-2 text-sm text-ink-500">{{ $dok->ket }}</p>
                            @endif
                        </div>

                        {{-- tombol unduh --}}
                        <a href="{{ route('galeri.produk-hukum.unduh', $dok) }}" class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-hijau-600 to-sage-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md shadow-hijau-600/20 transition hover:-translate-y-0.5 hover:shadow-lg">
                            <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                            Unduh
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-12">{{ $dtProdHkm->links() }}</div>
        @else
            <x-kosong judul="Belum Ada Dokumen" ket="Dokumen produk hukum dan kebijakan akan ditampilkan di sini setelah diunggah." />
        @endif
    </section>
@endsection
