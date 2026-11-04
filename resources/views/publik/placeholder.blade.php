@extends('publik.layout')

@section('judul', $judul)

@section('konten')
    {{-- hero judul halaman --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-hijau-700 via-hijau-600 to-hijau-800 py-20 text-white">
        <div class="absolute -right-16 -top-16 h-64 w-64 rounded-full bg-white/10 blur-3xl"></div>
        <div class="absolute -bottom-20 -left-10 h-72 w-72 rounded-full bg-hijau-400/20 blur-3xl"></div>
        <div class="relative mx-auto max-w-7xl px-4">
            <nav class="mb-3 text-sm text-hijau-200">
                <a href="{{ route('beranda') }}" class="transition hover:text-white">Beranda</a>
                <span class="mx-2">/</span>
                <span class="text-white">{{ $judul }}</span>
            </nav>
            <h1 class="text-3xl font-extrabold md:text-4xl">{{ $judul }}</h1>
        </div>
    </section>

    {{-- isi sementara --}}
    <section class="mx-auto max-w-7xl px-4 py-20">
        <div data-reveal class="mx-auto max-w-2xl rounded-2xl border border-dashed border-hijau-300 bg-hijau-50/50 p-10 text-center">
            <span class="mx-auto grid h-16 w-16 place-items-center rounded-2xl bg-hijau-100 text-hijau-600 animasi-mengambang">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085"/></svg>
            </span>
            <h2 class="mt-6 text-xl font-bold text-hijau-800">Halaman Sedang Disiapkan</h2>
            <p class="mt-2 text-sm leading-relaxed text-slate-600">
                Konten untuk <span class="font-semibold text-hijau-700">{{ $judul }}</span> akan segera tersedia. Bagian ini sedang dalam tahap pengembangan.
            </p>
            <a href="{{ route('beranda') }}" class="mt-6 inline-flex items-center gap-2 rounded-lg bg-hijau-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-hijau-700">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                Kembali ke Beranda
            </a>
        </div>
    </section>
@endsection
