@php
    $daftarMenu = config('navigasi.menu');
    $tombolPgdn = config('navigasi.tombolPgdn');
    $daftarTautan = array_filter(tautan_layanan(), fn ($t) => ! empty($t['url']));

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
    x-data="{ menuHp: false, dropdownHp: null, tergulir: false }"
    @scroll.window="tergulir = window.scrollY > 12"
    class="sticky top-0 z-50 w-full transition-shadow duration-300"
    :class="tergulir ? 'shadow-lg shadow-ink-900/5' : ''"
>
    {{-- bar atas tipis --}}
    <div class="gradasi-tema relative overflow-hidden text-white/90">
        <div class="pola-titik absolute inset-0 opacity-25"></div>
        <div class="relative mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-2 text-xs md:px-6">
            <span class="hidden items-center gap-1.5 font-medium sm:inline-flex">
                <svg class="h-3.5 w-3.5 text-hijau-200" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/></svg>
                Pemerintah Kabupaten Jember
            </span>
            <div class="ml-auto flex flex-wrap items-center justify-end gap-x-3 gap-y-1 sm:gap-x-4">
                @if (telp_kantor())
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', telp_kantor()) }}" class="inline-flex items-center gap-1.5 transition hover:text-white">
                        <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                        <span class="hidden sm:inline">{{ telp_kantor() }}</span>
                    </a>
                @endif
                @if (wa_kantor())
                    <a href="https://wa.me/{{ wa_kantor() }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 transition hover:text-white">
                        <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                        <span class="hidden sm:inline">{{ wa_tampil() }}</span>
                    </a>
                @endif
                @if (setelan('kontak.email'))
                    <a href="mailto:{{ setelan('kontak.email') }}" class="hidden items-center gap-1.5 transition hover:text-white md:inline-flex">
                        <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                        {{ setelan('kontak.email') }}
                    </a>
                @endif
                <a href="{{ route('panel.login') }}" class="inline-flex items-center gap-1.5 rounded-full border border-white/25 px-2.5 py-1 font-medium transition hover:bg-white/15 hover:text-white sm:px-3">
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                    <span class="hidden sm:inline">Portal Petugas</span>
                </a>
            </div>
        </div>
    </div>

    {{-- bar utama --}}
    <div class="border-b border-hijau-100/80 bg-white/85 backdrop-blur-xl">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3 md:px-6">
            {{-- logo --}}
            <a href="{{ route('beranda') }}" class="group flex shrink-0 items-center gap-3">
                <span class="relative grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-gradient-to-br from-hijau-50 to-sage-50 p-1.5 ring-1 ring-hijau-100 transition duration-500 group-hover:ring-hijau-300">
                    <img src="{{ logo_situs() }}" alt="Logo DKPP Kabupaten Jember" class="h-full w-full object-contain transition duration-500 group-hover:scale-105">
                </span>
                <span class="leading-tight">
                    <span class="block text-[15px] font-extrabold tracking-tight text-hijau-900">DKPP JEMBER</span>
                    <span class="block text-[11px] font-medium text-ink-400">Pangan, Peternakan &amp; Perikanan</span>
                </span>
            </a>

            {{-- menu desktop --}}
            <nav class="hidden items-center gap-0.5 xl:flex">
                @foreach ($daftarMenu as $item)
                    @if (empty($item['sub']))
                        <a
                            href="{{ route($item['route']) }}"
                            data-aktif="{{ $cekAktif($item) ? '1' : '0' }}"
                            class="nav-link-anim rounded-xl px-3.5 py-2 text-[13.5px] font-semibold transition {{ $cekAktif($item) ? 'text-hijau-700' : 'text-ink-600 hover:text-hijau-700' }}"
                        >{{ $item['judul'] }}</a>
                    @else
                        <div class="relative" x-data="{ buka: false }" @mouseenter="buka = true" @mouseleave="buka = false">
                            <button
                                class="flex items-center gap-1 rounded-xl px-3.5 py-2 text-[13.5px] font-semibold transition {{ $cekAktif($item) ? 'text-hijau-700' : 'text-ink-600 hover:text-hijau-700' }}"
                            >
                                {{ $item['judul'] }}
                                <svg class="h-3.5 w-3.5 transition duration-300" :class="buka && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                            </button>
                            <div
                                x-show="buka"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 -translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="absolute left-0 top-full z-50 w-72 pt-2"
                                style="display: none;"
                            >
                                <div class="overflow-hidden rounded-2xl border border-hijau-100 bg-white/95 p-1.5 shadow-xl shadow-ink-900/10 backdrop-blur-xl">
                                    @foreach ($item['sub'] as $sub)
                                        <a
                                            href="{{ route($sub['route']) }}"
                                            class="group flex items-center gap-2.5 rounded-xl px-3 py-2 text-[13px] transition {{ request()->routeIs($sub['route']) ? 'bg-gradient-to-r from-hijau-50 to-sage-50 font-semibold text-hijau-700' : 'text-ink-600 hover:bg-hijau-50/70 hover:text-hijau-700' }}"
                                        >
                                            <span class="h-1.5 w-1.5 shrink-0 rounded-full {{ request()->routeIs($sub['route']) ? 'bg-hijau-500' : 'bg-hijau-200 group-hover:bg-hijau-400' }}"></span>
                                            {{ $sub['judul'] }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                @if (!empty($daftarTautan))
                    <div class="relative" x-data="{ buka: false }" @mouseenter="buka = true" @mouseleave="buka = false">
                        <button class="flex items-center gap-1 rounded-xl px-3.5 py-2 text-[13.5px] font-semibold text-ink-600 transition hover:text-hijau-700">
                            Layanan Terkait
                            <svg class="h-3.5 w-3.5 transition duration-300" :class="buka && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                        </button>
                        <div x-show="buka" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="absolute left-0 top-full z-50 w-80 pt-2" style="display: none;">
                            <div class="overflow-hidden rounded-2xl border border-hijau-100 bg-white/95 p-1.5 shadow-xl shadow-ink-900/10 backdrop-blur-xl">
                                @foreach ($daftarTautan as $tautan)
                                    <a
                                        href="{{ $tautan['url'] }}"
                                        target="_blank"
                                        rel="noopener"
                                        class="group flex items-start gap-3 rounded-xl px-3 py-2.5 transition hover:bg-hijau-50/70"
                                    >
                                        <span class="mt-0.5 grid h-8 w-8 shrink-0 place-items-center rounded-lg bg-gradient-to-br from-hijau-100 to-sage-100 text-hijau-600 transition group-hover:from-hijau-600 group-hover:to-sage-600 group-hover:text-white">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                                        </span>
                                        <span class="min-w-0">
                                            <span class="block text-[13px] font-semibold text-ink-700 group-hover:text-hijau-700">{{ $tautan['judul'] }}</span>
                                            <span class="block text-[11px] text-ink-400">{{ $tautan['ket'] }}</span>
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </nav>

            {{-- tombol pengaduan + toggle hp --}}
            <div class="flex items-center gap-2">
                <a
                    href="{{ route($tombolPgdn['route']) }}"
                    class="kilau group hidden items-center gap-2 rounded-xl bg-gradient-to-r from-hijau-600 via-hijau-600 to-sage-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-hijau-600/25 transition duration-300 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-sage-600/30 sm:inline-flex"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10.5h8m-8 3h5m-9 5.25V6.75A2.25 2.25 0 016.25 4.5h11.5A2.25 2.25 0 0120 6.75v7.5a2.25 2.25 0 01-2.25 2.25H8.5L4 20.25z"/></svg>
                    {{ $tombolPgdn['judul'] }}
                </a>

                <button
                    @click="menuHp = !menuHp"
                    class="grid h-10 w-10 place-items-center rounded-xl border border-hijau-100 text-ink-600 transition hover:border-hijau-300 hover:bg-hijau-50 hover:text-hijau-700 xl:hidden"
                    aria-label="Buka menu"
                >
                    <svg x-show="!menuHp" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                    <svg x-show="menuHp" style="display:none;" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>

        {{-- menu mobile --}}
        <div x-show="menuHp" x-collapse style="display:none;" class="border-t border-hijau-100 bg-white xl:hidden">
            <nav class="mx-auto max-w-7xl space-y-1 px-4 py-4">
                @foreach ($daftarMenu as $i => $item)
                    @if (empty($item['sub']))
                        <a href="{{ route($item['route']) }}" class="block rounded-xl px-3 py-2.5 text-sm font-semibold {{ $cekAktif($item) ? 'bg-gradient-to-r from-hijau-50 to-sage-50 text-hijau-700' : 'text-ink-600' }}">{{ $item['judul'] }}</a>
                    @else
                        <div>
                            <button
                                @click="dropdownHp === {{ $i }} ? dropdownHp = null : dropdownHp = {{ $i }}"
                                class="flex w-full items-center justify-between rounded-xl px-3 py-2.5 text-sm font-semibold {{ $cekAktif($item) ? 'bg-gradient-to-r from-hijau-50 to-sage-50 text-hijau-700' : 'text-ink-600' }}"
                            >
                                {{ $item['judul'] }}
                                <svg class="h-4 w-4 transition duration-300" :class="dropdownHp === {{ $i }} && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                            </button>
                            <div x-show="dropdownHp === {{ $i }}" x-collapse style="display:none;" class="ml-3 border-l-2 border-hijau-100 pl-2">
                                @foreach ($item['sub'] as $sub)
                                    <a href="{{ route($sub['route']) }}" class="block rounded-lg px-3 py-2 text-[13px] {{ request()->routeIs($sub['route']) ? 'font-semibold text-hijau-700' : 'text-ink-500' }}">{{ $sub['judul'] }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach

                @if (!empty($daftarTautan))
                    <div>
                        <p class="px-3 pb-1 pt-3 text-[11px] font-bold uppercase tracking-wider text-ink-400">Layanan Terkait</p>
                        @foreach ($daftarTautan as $tautan)
                            <a href="{{ $tautan['url'] }}" target="_blank" rel="noopener" class="block rounded-lg px-3 py-2 text-[13px] text-ink-600">{{ $tautan['judul'] }}</a>
                        @endforeach
                    </div>
                @endif

                <a href="{{ route($tombolPgdn['route']) }}" class="mt-2 block rounded-xl bg-gradient-to-r from-hijau-600 to-sage-600 px-3 py-2.5 text-center text-sm font-semibold text-white">{{ $tombolPgdn['judul'] }}</a>
            </nav>
        </div>
    </div>
</header>
