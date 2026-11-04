@extends('publik.layout')

@section('judul', $brt->judul)
@section('deskripsi', $brt->ringkasan)

@section('konten')
    <x-hero-halaman :judul="$brt->jenis === 'ppid' ? 'Berita PPID' : 'Info Kegiatan'" induk="Layanan Publik" />

    <section class="mx-auto max-w-7xl px-4 py-14">
        <div class="flex flex-col gap-10 lg:flex-row">
            {{-- artikel utama --}}
            <article class="min-w-0 flex-1" data-reveal>
                <a href="{{ $brt->jenis === 'ppid' ? route('layanan.berita') : route('layanan.kegiatan') }}" class="mb-6 inline-flex items-center gap-2 text-sm font-semibold text-hijau-600 transition hover:text-hijau-700">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                    Kembali ke daftar
                </a>

                <span class="rounded-full bg-hijau-100 px-3 py-1 text-xs font-semibold text-hijau-700">{{ $brt->jenis === 'ppid' ? 'PPID' : 'Kegiatan' }}</span>
                <h1 class="mt-4 text-2xl font-extrabold leading-tight text-slate-800 md:text-3xl">{{ $brt->judul }}</h1>

                <div class="mt-4 flex flex-wrap items-center gap-4 text-sm text-slate-400">
                    @if ($brt->tgl_terbit)
                        <span class="inline-flex items-center gap-1.5">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                            {{ $brt->tgl_terbit->translatedFormat('d F Y') }}
                        </span>
                    @endif
                    @if ($brt->penulis)
                        <span class="inline-flex items-center gap-1.5">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                            {{ $brt->penulis->name }}
                        </span>
                    @endif
                    <span>{{ $brt->dilihat }}x dilihat</span>
                </div>

                @if ($brt->gambar)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($brt->gambar) }}" alt="{{ $brt->judul }}" class="mt-6 w-full rounded-2xl border border-hijau-100 shadow-sm">
                @endif

                <div class="prose-dkpp mt-8">
                    {!! $brt->isi !!}
                </div>
            </article>

            {{-- sidebar terkait --}}
            @if ($terkait->count())
                <aside class="lg:w-80 lg:shrink-0" data-reveal="kanan">
                    <div class="sticky top-24 rounded-2xl border border-hijau-100 bg-white p-5 shadow-sm">
                        <h2 class="mb-4 text-sm font-bold uppercase tracking-wide text-hijau-700">Lainnya</h2>
                        <div class="space-y-4">
                            @foreach ($terkait as $t)
                                <a href="{{ route('layanan.berita.detail', $t) }}" class="group flex gap-3">
                                    <span class="grid h-14 w-14 shrink-0 place-items-center overflow-hidden rounded-lg bg-hijau-50 text-hijau-300">
                                        @if ($t->gambar)
                                            <img src="{{ \Illuminate\Support\Facades\Storage::url($t->gambar) }}" alt="" class="h-full w-full object-cover">
                                        @else
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159M3.75 19.5h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/></svg>
                                        @endif
                                    </span>
                                    <span class="min-w-0">
                                        <span class="line-clamp-2 text-sm font-semibold text-slate-700 transition group-hover:text-hijau-700">{{ $t->judul }}</span>
                                        @if ($t->tgl_terbit)
                                            <span class="mt-1 block text-xs text-slate-400">{{ $t->tgl_terbit->translatedFormat('d M Y') }}</span>
                                        @endif
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </aside>
            @endif
        </div>
    </section>
@endsection
