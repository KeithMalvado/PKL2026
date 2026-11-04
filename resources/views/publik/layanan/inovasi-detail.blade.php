@extends('publik.layout')

@section('judul', $inov->judul)
@section('deskripsi', $inov->ringkasan)

@section('konten')
    <x-hero-halaman judul="Inovasi Pelayanan" induk="Layanan Publik" />

    <section class="mx-auto max-w-3xl px-4 py-14">
        <article data-reveal>
            <a href="{{ route('layanan.inovasi') }}" class="mb-6 inline-flex items-center gap-2 text-sm font-semibold text-hijau-600 transition hover:text-hijau-700">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                Kembali ke daftar
            </a>

            <span class="rounded-full bg-hijau-100 px-3 py-1 text-xs font-semibold text-hijau-700">Inovasi Pelayanan</span>
            <h1 class="mt-4 text-2xl font-extrabold leading-tight text-slate-800 md:text-3xl">{{ $inov->judul }}</h1>

            @if ($inov->gambar)
                <img src="{{ \Illuminate\Support\Facades\Storage::url($inov->gambar) }}" alt="{{ $inov->judul }}" class="mt-6 w-full rounded-2xl border border-hijau-100 shadow-sm">
            @endif

            <div class="prose-dkpp mt-8">
                {!! $inov->isi !!}
            </div>
        </article>
    </section>
@endsection
