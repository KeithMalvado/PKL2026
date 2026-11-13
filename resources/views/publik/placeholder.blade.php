@extends('publik.layout')

@section('judul', $judul)

@section('konten')
    <x-hero-halaman :judul="$judul" />

    <section class="mx-auto max-w-7xl px-4 py-16 md:px-6 md:py-20">
        <div data-reveal class="mx-auto max-w-2xl rounded-3xl border border-dashed border-hijau-200 bg-gradient-to-br from-hijau-50/70 via-white to-sage-50/60 p-10 text-center shadow-lembut">
            <span class="animasi-mengambang mx-auto grid h-16 w-16 place-items-center rounded-2xl bg-white text-hijau-500 shadow-md">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085"/></svg>
            </span>
            <h2 class="mt-6 text-xl font-extrabold text-hijau-900">Halaman Sedang Disiapkan</h2>
            <p class="mt-2 text-sm leading-relaxed text-ink-500">
                Konten untuk <span class="font-semibold text-hijau-700">{{ $judul }}</span> akan segera tersedia. Bagian ini sedang dalam tahap pengembangan.
            </p>
            <a href="{{ route('beranda') }}" class="mt-6 inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-hijau-600 to-sage-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-hijau-600/20 transition hover:-translate-y-0.5 hover:shadow-xl">
                Kembali ke Beranda
            </a>
        </div>
    </section>
@endsection
