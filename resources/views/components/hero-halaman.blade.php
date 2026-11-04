@props([
    'judul',
    'induk' => null,     // nama kelompok menu (mis. "Profil"); null = auto-deteksi
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
<section class="relative overflow-hidden bg-gradient-to-br from-hijau-700 via-hijau-600 to-hijau-800 py-16 text-white md:py-20">
    <div class="absolute -right-16 -top-16 h-64 w-64 rounded-full bg-white/10 blur-3xl"></div>
    <div class="absolute -bottom-20 -left-10 h-72 w-72 rounded-full bg-hijau-400/20 blur-3xl animasi-mengambang"></div>
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 32px 32px;"></div>

    <div class="relative mx-auto max-w-7xl px-4">
        <nav class="mb-3 text-sm text-hijau-200">
            <a href="{{ route('beranda') }}" class="transition hover:text-white">Beranda</a>
            @if ($induk)
                <span class="mx-2">/</span>
                <span>{{ $induk }}</span>
            @endif
            <span class="mx-2">/</span>
            <span class="text-white">{{ $judul }}</span>
        </nav>
        <h1 class="text-3xl font-extrabold md:text-4xl" data-reveal>{{ $judul }}</h1>
    </div>
</section>
