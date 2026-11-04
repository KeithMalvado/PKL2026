@extends('publik.layout')

@section('judul', $art->judul)
@section('deskripsi', $art->ringkasan)

@section('konten')
    <x-hero-halaman judul="Artikel & Jurnal" induk="Layanan Publik" />

    <section class="mx-auto max-w-3xl px-4 py-14">
        <article data-reveal>
            <a href="{{ route('layanan.artikel') }}" class="mb-6 inline-flex items-center gap-2 text-sm font-semibold text-hijau-600 transition hover:text-hijau-700">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                Kembali ke daftar
            </a>

            <span class="rounded-full bg-hijau-100 px-3 py-1 text-xs font-semibold text-hijau-700">{{ ucfirst($art->jenis) }}</span>
            <h1 class="mt-4 text-2xl font-extrabold leading-tight text-slate-800 md:text-3xl">{{ $art->judul }}</h1>

            <div class="mt-4 flex flex-wrap items-center gap-4 text-sm text-slate-400">
                @if ($art->penulis)
                    <span class="inline-flex items-center gap-1.5">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                        {{ $art->penulis }}
                    </span>
                @endif
                @if ($art->tgl_terbit)
                    <span>{{ $art->tgl_terbit->translatedFormat('d F Y') }}</span>
                @endif
            </div>

            @if ($art->gambar)
                <img src="{{ \Illuminate\Support\Facades\Storage::url($art->gambar) }}" alt="{{ $art->judul }}" class="mt-6 w-full rounded-2xl border border-hijau-100 shadow-sm">
            @endif

            <div class="prose-dkpp mt-8">
                {!! $art->isi !!}
            </div>

            @if ($art->file)
                <a href="{{ \Illuminate\Support\Facades\Storage::url($art->file) }}" target="_blank" class="mt-8 inline-flex items-center gap-2 rounded-xl bg-hijau-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-hijau-700">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                    Unduh Berkas Jurnal
                </a>
            @endif
        </article>
    </section>
@endsection
