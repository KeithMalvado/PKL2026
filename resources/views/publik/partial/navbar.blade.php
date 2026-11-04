@php
    $daftarMenu = config('navigasi.menu');
    $tombolPgdn = config('navigasi.tombolPgdn');

    // helper cek route aktif (termasuk sub-menu)
    $cekAktif = function ($item) {
        if (!empty($item['route']) && request()->routeIs($item['route'])) {
            return true;
        }
        foreach ($item['sub'] ?? [] as $sub) {
            if (!empty($sub['route']) && request()->routeIs($sub['route'])) {
                return true;
            }
        }
        return false;
    };
@endphp

<header
    x-data="{ menuHp: false, dropdownHp: null }"
    class="sticky top-0 z-50 w-full border-b border-hijau-100 bg-white/90 backdrop-blur-md"
>
    {{-- bar atas tipis --}}
    <div class="bg-hijau-700 text-hijau-50">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-1.5 text-xs">
            <span class="hidden sm:block">Pemerintah Kabupaten Jember</span>
            <div class="flex items-center gap-4">
                <a href="#" class="inline-flex items-center gap-1 transition hover:text-white">
                    <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                    (0331) 000-000
                </a>
                <a href="#" class="hidden items-center gap-1 transition hover:text-white sm:inline-flex">
                    <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                    info@dkpp.jemberkab.go.id
                </a>
            </div>
        </div>
    </div>

    {{-- bar utama --}}
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3">
        {{-- logo --}}
        <a href="{{ route('beranda') }}" class="flex items-center gap-3">
            <span class="grid h-11 w-11 place-items-center rounded-xl bg-gradient-to-br from-hijau-500 to-hijau-700 text-white shadow-md shadow-hijau-600/30">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 100-18 9 9 0 000 18zm0 0c-2 0-3-4-3-9s1-9 3-9m0 18c2 0 3-4 3-9s-1-9-3-9M3 12h18"/></svg>
            </span>
            <span class="leading-tight">
                <span class="block text-sm font-extrabold text-hijau-800">DKPP JEMBER</span>
                <span class="block text-[11px] text-slate-500">Ketahanan Pangan, Peternakan &amp; Perikanan</span>
            </span>
        </a>

        {{-- menu desktop --}}
        <nav class="hidden items-center gap-1 lg:flex">
            @foreach ($daftarMenu as $item)
                @if (empty($item['sub']))
                    <a
                        href="{{ route($item['route']) }}"
                        class="nav-link-anim rounded-lg px-3 py-2 text-sm font-semibold transition {{ $cekAktif($item) ? 'text-hijau-700' : 'text-slate-600 hover:text-hijau-700' }}"
                    >{{ $item['judul'] }}</a>
                @else
                    <div class="relative" x-data="{ buka: false }" @mouseenter="buka = true" @mouseleave="buka = false">
                        <button
                            class="flex items-center gap-1 rounded-lg px-3 py-2 text-sm font-semibold transition {{ $cekAktif($item) ? 'text-hijau-700' : 'text-slate-600 hover:text-hijau-700' }}"
                        >
                            {{ $item['judul'] }}
                            <svg class="h-3.5 w-3.5 transition" :class="buka && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                        </button>
                        <div
                            x-show="buka"
                            x-transition.origin.top
                            class="absolute left-0 top-full z-50 w-72 pt-2"
                            style="display: none;"
                        >
                            <div class="overflow-hidden rounded-xl border border-hijau-100 bg-white py-2 shadow-xl shadow-hijau-900/5">
                                @foreach ($item['sub'] as $sub)
                                    <a
                                        href="{{ route($sub['route']) }}"
                                        class="block border-l-2 px-4 py-2 text-sm transition {{ request()->routeIs($sub['route']) ? 'border-hijau-600 bg-hijau-50 text-hijau-700' : 'border-transparent text-slate-600 hover:border-hijau-400 hover:bg-hijau-50/60 hover:text-hijau-700' }}"
                                    >{{ $sub['judul'] }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </nav>

        {{-- tombol pengaduan + toggle hp --}}
        <div class="flex items-center gap-2">
            <a
                href="{{ route($tombolPgdn['route']) }}"
                class="hidden rounded-lg bg-hijau-600 px-4 py-2 text-sm font-semibold text-white shadow-md shadow-hijau-600/30 transition hover:-translate-y-0.5 hover:bg-hijau-700 sm:inline-block"
            >{{ $tombolPgdn['judul'] }}</a>

            <button
                @click="menuHp = !menuHp"
                class="grid h-10 w-10 place-items-center rounded-lg text-slate-600 transition hover:bg-hijau-50 hover:text-hijau-700 lg:hidden"
                aria-label="Buka menu"
            >
                <svg x-show="!menuHp" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                <svg x-show="menuHp" style="display:none;" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>

    {{-- menu mobile --}}
    <div x-show="menuHp" x-collapse style="display:none;" class="border-t border-hijau-100 lg:hidden">
        <nav class="mx-auto max-w-7xl space-y-1 px-4 py-4">
            @foreach ($daftarMenu as $i => $item)
                @if (empty($item['sub']))
                    <a href="{{ route($item['route']) }}" class="block rounded-lg px-3 py-2 text-sm font-semibold {{ $cekAktif($item) ? 'bg-hijau-50 text-hijau-700' : 'text-slate-600' }}">{{ $item['judul'] }}</a>
                @else
                    <div>
                        <button
                            @click="dropdownHp === {{ $i }} ? dropdownHp = null : dropdownHp = {{ $i }}"
                            class="flex w-full items-center justify-between rounded-lg px-3 py-2 text-sm font-semibold {{ $cekAktif($item) ? 'bg-hijau-50 text-hijau-700' : 'text-slate-600' }}"
                        >
                            {{ $item['judul'] }}
                            <svg class="h-4 w-4 transition" :class="dropdownHp === {{ $i }} && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                        </button>
                        <div x-show="dropdownHp === {{ $i }}" x-collapse style="display:none;" class="ml-3 border-l border-hijau-100 pl-2">
                            @foreach ($item['sub'] as $sub)
                                <a href="{{ route($sub['route']) }}" class="block rounded-lg px-3 py-2 text-sm {{ request()->routeIs($sub['route']) ? 'text-hijau-700' : 'text-slate-500' }}">{{ $sub['judul'] }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
            <a href="{{ route($tombolPgdn['route']) }}" class="mt-2 block rounded-lg bg-hijau-600 px-3 py-2 text-center text-sm font-semibold text-white">{{ $tombolPgdn['judul'] }}</a>
        </nav>
    </div>
</header>
