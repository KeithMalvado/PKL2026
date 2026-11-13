@extends('publik.layout')

@section('judul', $art->judul)
@section('deskripsi', $art->ringkasan)

@section('konten')
    <x-hero-halaman judul="Artikel & Jurnal" induk="Layanan Publik" />

    <section class="mx-auto max-w-3xl px-4 py-16 md:px-6 md:py-20">
        <article data-reveal>
            <a href="{{ route('layanan.artikel') }}" class="group mb-7 inline-flex items-center gap-2 rounded-full border border-ink-200 bg-white px-4 py-2 text-sm font-semibold text-ink-600 shadow-sm transition hover:border-hijau-300 hover:text-hijau-700">
                <svg class="h-4 w-4 transition group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                Kembali ke daftar
            </a>

            <div class="rounded-3xl border border-hijau-100 bg-white p-6 shadow-lembut md:p-9">
                <span class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-hijau-100 to-sage-100 px-3 py-1 text-[11px] font-bold uppercase tracking-wide text-hijau-700">{{ ucfirst($art->jenis) }}</span>
                <h1 class="mt-4 text-2xl font-extrabold leading-tight tracking-tight text-ink-900 md:text-[2rem]">{{ $art->judul }}</h1>

                <div class="mt-4 flex flex-wrap items-center gap-x-5 gap-y-2 border-b border-hijau-100 pb-6 text-sm text-ink-400">
                    @if ($art->penulis)
                        <span class="inline-flex items-center gap-1.5">
                            <svg class="h-4 w-4 text-hijau-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
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
                    <a href="{{ \Illuminate\Support\Facades\Storage::url($art->file) }}" target="_blank" class="mt-8 inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-hijau-600 to-sage-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-hijau-600/20 transition hover:-translate-y-0.5 hover:shadow-xl">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                        Unduh Berkas Jurnal
                    </a>
                @endif
            </div>
        </article>
    </section>
@endsection
