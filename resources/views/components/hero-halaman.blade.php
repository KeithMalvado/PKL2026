
@props([
    'judul',
    'induk' => null,
    'ket' => null,
    'tema' => null,
])

@php
    /*
    |--------------------------------------------------------------------------
    | DETEKSI TEMA WARNA BIDANG
    |--------------------------------------------------------------------------
    | Warna otomatis mengikuti halaman yang sedang dibuka.
    | Halaman lain tetap menggunakan gradasi hijau asli Ipan.
    */

    $namaRute = request()->route()?->getName();

    if (!$tema) {
        $tema = match ($namaRute) {
            'profil.bidang.keswan' => 'kesehatan-hewan',
            'profil.bidang.ternak' => 'peternakan',
            'profil.bidang.ikan' => 'perikanan',
            'profil.bidang.pangan' => 'ketahanan-pangan',
            'profil.sekretariat' => 'sekretariat',
            default => null,
        };
    }

    // Mendukung halaman /bidang/{slug} juga.
    if (!$tema && $namaRute === 'bidang.detail') {
        $parameterBidang = request()->route('bdg');

        $tema = $parameterBidang instanceof \App\Models\Bdg
            ? $parameterBidang->slug
            : (is_string($parameterBidang) ? $parameterBidang : null);
    }

    /*
    |--------------------------------------------------------------------------
    | PALET WARNA PER BIDANG
    |--------------------------------------------------------------------------
    | Mengikuti gradasi asli Ipan:
    | 3 radial-gradient + 1 linear-gradient (135 derajat).
    */

    $paletTema = [
        'kesehatan-hewan' => [
            'base'   => '#20152d',
            'kiri'   => '#63447f',
            'kanan'  => '#9364ae',
            'bawah'  => '#4c3269',
            'tengah' => '#3d2953',
            'akhir'  => '#231a37',
        ],

        'peternakan' => [
            'base'   => '#241912',
            'kiri'   => '#68452e',
            'kanan'  => '#a67955',
            'bawah'  => '#594132',
            'tengah' => '#483326',
            'akhir'  => '#281b16',
        ],

        'perikanan' => [
            'base'   => '#103b4f',
            'kiri'   => '#3489af',
            'kanan'  => '#8acde8',
            'bawah'  => '#24657c',
            'tengah' => '#1a5d7a',
            'akhir'  => '#103d55',
        ],

        'ketahanan-pangan' => [
            'base'   => '#0f1f18',
            'kiri'   => '#2c533e',
            'kanan'  => '#47805f',
            'bawah'  => '#3a4423',
            'tengah' => '#1a3227',
            'akhir'  => '#12241c',
        ],

        'sekretariat' => [
            'base'   => '#171c1e',
            'kiri'   => '#414b50',
            'kanan'  => '#656f73',
            'bawah'  => '#353d42',
            'tengah' => '#30383c',
            'akhir'  => '#202629',
        ],
    ];

    /*
    |--------------------------------------------------------------------------
    | SUSUN GRADASI
    |--------------------------------------------------------------------------
    | Jika halaman tidak memiliki tema khusus,
    | biarkan CSS .gradasi-hero asli yang bekerja.
    */

    $gayaGradasi = '';
    $kelasTema = '';

    if ($tema && isset($paletTema[$tema])) {
        $warna = $paletTema[$tema];

        $kelasTema = 'hero-bidang--' . $tema;

        $gayaGradasi =
            "background-color: {$warna['base']}; " .
            "background-image: " .
            "radial-gradient(115% 105% at 6% 0%, {$warna['kiri']} 0%, transparent 56%), " .
            "radial-gradient(85% 85% at 94% 2%, {$warna['kanan']} 0%, transparent 52%), " .
            "radial-gradient(80% 90% at 76% 100%, {$warna['bawah']} 0%, transparent 58%), " .
            "linear-gradient(135deg, {$warna['base']} 0%, {$warna['tengah']} 48%, {$warna['akhir']} 100%);";
    }

    /*
    |--------------------------------------------------------------------------
    | BREADCRUMB ASLI IPAN
    |--------------------------------------------------------------------------
    */

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

{{-- Hero judul halaman --}}
<section
    class="gradasi-hero {{ $kelasTema }} relative isolate overflow-hidden"
    @if ($gayaGradasi)
        style="{{ $gayaGradasi }}"
    @endif
>
    {{-- Pola titik asli --}}
    <div class="pola-titik absolute inset-0 opacity-40"></div>

    {{-- Efek cahaya mengambang asli --}}
    <div
        class="animasi-mengambang-lambat absolute -right-20 -top-24 h-72 w-72 rounded-full bg-sage-400/25 blur-3xl"
        aria-hidden="true"
    ></div>

    <div
        class="animasi-mengambang absolute -bottom-28 -left-16 h-80 w-80 rounded-full bg-hijau-400/20 blur-3xl"
        aria-hidden="true"
    ></div>

    {{-- Garis gradasi bawah --}}
    <div
        class="absolute inset-x-0 bottom-0 h-px bg-gradient-to-r from-transparent via-white/25 to-transparent"
    ></div>

    <div class="relative mx-auto max-w-7xl px-4 py-16 md:px-6 md:py-20">

        {{-- Breadcrumb --}}
        <nav
            class="mb-5 flex flex-wrap items-center gap-1.5 text-[13px] text-hijau-200/90 animasi-naik"
        >
            <a
                href="{{ route('beranda') }}"
                class="inline-flex items-center gap-1.5 rounded-full px-2 py-1 transition hover:bg-white/10 hover:text-white"
            >
                <svg
                    class="h-3.5 w-3.5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M2.25 12l8.954-8.955a1.125 1.125 0 011.591 0L21.75 12M4.5 9.75v10.5a.75.75 0 00.75.75h4.5a.75.75 0 00.75-.75V15a.75.75 0 01.75-.75h3a.75.75 0 01.75.75v5.25c0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75V9.75"
                    />
                </svg>

                Beranda
            </a>

            @if ($induk)
                <svg
                    class="h-3 w-3 text-white/30"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2.5"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M8.25 4.5l7.5 7.5-7.5 7.5"
                    />
                </svg>

                <span>{{ $induk }}</span>
            @endif

            <svg
                class="h-3 w-3 text-white/30"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="2.5"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M8.25 4.5l7.5 7.5-7.5 7.5"
                />
            </svg>

            <span class="font-semibold text-white">
                {{ $judul }}
            </span>
        </nav>

        {{-- Judul halaman --}}
        <h1
            class="max-w-3xl text-3xl font-extrabold leading-tight tracking-tight text-white animasi-naik md:text-[2.75rem]"
            style="animation-delay: .08s"
        >
            {{ $judul }}
        </h1>

        {{-- Deskripsi halaman --}}
        @if ($ket)
            <p
                class="mt-3 max-w-2xl text-[15px] leading-relaxed text-hijau-100/90 animasi-naik"
                style="animation-delay: .16s"
            >
                {{ $ket }}
            </p>
        @endif

        {{-- Garis aksen asli Ipan --}}
        <div
            class="mt-6 h-1 w-16 rounded-full bg-gradient-to-r from-emas-400 via-hijau-300 to-sage-300 animasi-naik"
            style="animation-delay: .2s"
        ></div>

    </div>
</section>
