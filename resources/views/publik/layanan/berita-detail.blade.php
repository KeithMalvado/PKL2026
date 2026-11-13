@extends('publik.layout')

@section('judul', $brt->judul)
@section('deskripsi', $brt->ringkasan)

@section('konten')
    <x-hero-halaman :judul="$brt->jenis === 'ppid' ? 'Berita PPID' : 'Info Kegiatan'" induk="Layanan Publik" />

    <section class="mx-auto max-w-7xl px-4 py-16 md:px-6 md:py-20">
        <div class="flex flex-col gap-10 lg:flex-row">
            {{-- artikel utama --}}
            <article class="min-w-0 flex-1" data-reveal>
                <a href="{{ $brt->jenis === 'ppid' ? route('layanan.berita') : route('layanan.kegiatan') }}" class="group mb-7 inline-flex items-center gap-2 rounded-full border border-ink-200 bg-white px-4 py-2 text-sm font-semibold text-ink-600 shadow-sm transition hover:border-hijau-300 hover:text-hijau-700">
                    <svg class="h-4 w-4 transition group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                    Kembali ke daftar
                </a>

                <div class="rounded-3xl border border-hijau-100 bg-white p-6 shadow-lembut md:p-9">
                    <span class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-hijau-100 to-sage-100 px-3 py-1 text-[11px] font-bold uppercase tracking-wide text-hijau-700">{{ $brt->jenis === 'ppid' ? 'PPID' : 'Kegiatan' }}</span>
                    <h1 class="mt-4 text-2xl font-extrabold leading-tight tracking-tight text-ink-900 md:text-[2rem]">{{ $brt->judul }}</h1>

                    <div class="mt-4 flex flex-wrap items-center gap-x-5 gap-y-2 border-b border-hijau-100 pb-6 text-sm text-ink-400">
                        @if ($brt->tgl_terbit)
                            <span class="inline-flex items-center gap-1.5">
                                <svg class="h-4 w-4 text-hijau-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                                {{ $brt->tgl_terbit->translatedFormat('d F Y') }}
                            </span>
                        @endif
                        @if ($brt->penulis)
                            <span class="inline-flex items-center gap-1.5">
                                <svg class="h-4 w-4 text-hijau-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                                {{ $brt->penulis->name }}
                            </span>
                        @endif
                        <span class="inline-flex items-center gap-1.5">
                            <svg class="h-4 w-4 text-hijau-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $brt->dilihat }}x dilihat
                        </span>
                    </div>

                    @if ($brt->gambar)
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($brt->gambar) }}" alt="{{ $brt->judul }}" class="mt-6 w-full rounded-2xl border border-hijau-100 shadow-sm">
                    @endif

                    <div class="prose-dkpp mt-8">
                        {!! $brt->isi !!}
                    </div>
                </div>
            </article>

            {{-- sidebar terkait --}}
            @if ($terkait->count())
                <aside class="lg:w-80 lg:shrink-0" data-reveal="kanan">
                    <div class="sticky top-28 rounded-3xl border border-hijau-100 bg-white p-5 shadow-lembut">
                        <h2 class="mb-4 flex items-center gap-2 text-[12px] font-bold uppercase tracking-[0.14em] text-hijau-700">
                            <span class="h-1.5 w-1.5 rounded-full bg-hijau-500"></span>
                            Lainnya
                        </h2>
                        <div class="space-y-4">
                            @foreach ($terkait as $t)
                                <a href="{{ route('layanan.berita.detail', $t) }}" class="group flex gap-3">
                                    <span class="grid h-16 w-16 shrink-0 place-items-center overflow-hidden rounded-xl bg-gradient-to-br from-hijau-50 to-sage-50 text-hijau-300 ring-1 ring-hijau-100">
                                        @if ($t->gambar)
                                            <img src="{{ \Illuminate\Support\Facades\Storage::url($t->gambar) }}" alt="" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                                        @else
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159M3.75 19.5h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/></svg>
                                        @endif
                                    </span>
                                    <span class="min-w-0">
                                        <span class="line-clamp-2 text-[13.5px] font-semibold leading-snug text-ink-700 transition group-hover:text-hijau-700">{{ $t->judul }}</span>
                                        @if ($t->tgl_terbit)
                                            <span class="mt-1 block text-xs text-ink-400">{{ $t->tgl_terbit->translatedFormat('d M Y') }}</span>
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
