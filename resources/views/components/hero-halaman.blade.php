@props([
    'judul',
    'induk' => null,     // nama kelompok menu (mis. "Profil"); null = auto-deteksi
    'ket' => null,       // deskripsi singkat di bawah judul
])

@php
    // auto-deteksi induk dr config navigasi bila tdk diberikn
    if ($induk === null) {
        $rtAktif = request()->route()?->getName();
        foreach (config('navigasi.menu') as $item) {
            foreach ($item['sub'] ?? [] as $sub) {
                if (($sub['route'] ?? null) === $rtAktif) {
                    $induk = $item['judul'];
                    break 2;
                }
            }
        }
    }
@endphp

{{-- hero judul halaman --}}
<section class="gradasi-hero relative isolate overflow-hidden">
    <div class="pola-titik absolute inset-0 opacity-40"></div>
    <div class="animasi-mengambang-lambat absolute -right-20 -top-24 h-72 w-72 rounded-full bg-sage-400/25 blur-3xl" aria-hidden="true"></div>
    <div class="animasi-mengambang absolute -bottom-28 -left-16 h-80 w-80 rounded-full bg-hijau-400/20 blur-3xl" aria-hidden="true"></div>
    <div class="absolute inset-x-0 bottom-0 h-px bg-gradient-to-r from-transparent via-white/25 to-transparent"></div>

    <div class="relative mx-auto max-w-7xl px-4 py-16 md:px-6 md:py-20">
        <nav class="mb-5 flex flex-wrap items-center gap-1.5 text-[13px] text-hijau-200/90 animasi-naik">
            <a href="{{ route('beranda') }}" class="inline-flex items-center gap-1.5 rounded-full px-2 py-1 transition hover:bg-white/10 hover:text-white">
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955a1.125 1.125 0 011.591 0L21.75 12M4.5 9.75v10.5a.75.75 0 00.75.75h4.5a.75.75 0 00.75-.75V15a.75.75 0 01.75-.75h3a.75.75 0 01.75.75v5.25c0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75V9.75"/></svg>
                Beranda
            </a>
            @if ($induk)
                <svg class="h-3 w-3 text-white/30" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                <span>{{ $induk }}</span>
            @endif
            <svg class="h-3 w-3 text-white/30" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
            <span class="font-semibold text-white">{{ $judul }}</span>
        </nav>

        <h1 class="max-w-3xl text-3xl font-extrabold leading-tight tracking-tight text-white animasi-naik md:text-[2.75rem]" style="animation-delay: .08s">
            {{ $judul }}
        </h1>

        @if ($ket)
            <p class="mt-3 max-w-2xl text-[15px] leading-relaxed text-hijau-100/90 animasi-naik" style="animation-delay: .16s">{{ $ket }}</p>
        @endif

        <div class="mt-6 h-1 w-16 rounded-full bg-gradient-to-r from-emas-400 via-hijau-300 to-sage-300 animasi-naik" style="animation-delay: .2s"></div>
    </div>
</section>
