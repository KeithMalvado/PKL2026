@extends('publik.layout')

@section('judul', $inov->judul)

@section('konten')
    <x-hero-halaman judul="Inovasi Pelayanan" induk="Layanan Publik" />

    <section class="mx-auto max-w-3xl px-4 py-16 md:px-6 md:py-20">
        <article data-reveal>
            <a href="{{ route('layanan.inovasi') }}" class="group mb-7 inline-flex items-center gap-2 rounded-full border border-ink-200 bg-white px-4 py-2 text-sm font-semibold text-ink-600 shadow-sm transition hover:border-hijau-300 hover:text-hijau-700">
                <svg class="h-4 w-4 transition group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                Kembali ke daftar
            </a>

            <div class="rounded-3xl border border-hijau-100 bg-white p-6 shadow-lembut md:p-9">
                <span class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-emas-100 to-moss-100 px-3 py-1 text-[11px] font-bold uppercase tracking-wide text-emas-600">Inovasi Pelayanan</span>
                <h1 class="mt-4 text-2xl font-extrabold leading-tight tracking-tight text-ink-900 md:text-[2rem]">{{ $inov->judul }}</h1>

                @if ($inov->gambar)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($inov->gambar) }}" alt="{{ $inov->judul }}" class="mt-6 w-full rounded-2xl border border-hijau-100 shadow-sm">
                @endif

                <div class="prose-dkpp mt-8">
                    {!! $inov->isi !!}
                </div>
            </div>
        </article>
    </section>
@endsection
