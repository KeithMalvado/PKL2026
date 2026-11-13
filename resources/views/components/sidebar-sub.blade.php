@props([
    'kunciAktif' => null, // nama route halaman aktif
])

@php
    // cari kelompok menu yg memuat route aktif, utk tampilkn sub-menu terkait
    $rtAktif = request()->route()?->getName();
    $kelompok = null;
    foreach (config('navigasi.menu') as $item) {
        foreach ($item['sub'] ?? [] as $sub) {
            if (($sub['route'] ?? null) === $rtAktif) {
                $kelompok = $item;
                break 2;
            }
        }
    }
@endphp

@if ($kelompok)
    <aside class="w-full lg:w-72 lg:shrink-0">
        <div class="lg:sticky lg:top-28 overflow-hidden rounded-3xl border border-hijau-100 bg-white shadow-lembut">
            <div class="gradasi-tema relative overflow-hidden px-5 py-5">
                <div class="pola-titik absolute inset-0 opacity-30"></div>
                <div class="relative flex items-center gap-2.5">
                    <span class="grid h-9 w-9 place-items-center rounded-xl bg-white/15 text-white backdrop-blur">
                        <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12"/></svg>
                    </span>
                    <h2 class="text-sm font-bold uppercase tracking-wide text-white">{{ $kelompok['judul'] }}</h2>
                </div>
            </div>
            <nav class="space-y-1 p-3">
                @foreach ($kelompok['sub'] as $sub)
                    @php $aktif = $rtAktif === $sub['route']; @endphp
                    <a
                        href="{{ route($sub['route']) }}"
                        class="group flex items-center gap-2.5 rounded-xl px-3 py-2.5 text-sm transition-all duration-300 {{ $aktif ? 'bg-gradient-to-r from-hijau-600 to-sage-600 font-semibold text-white shadow-md shadow-hijau-600/20' : 'text-ink-600 hover:bg-hijau-50 hover:text-hijau-700' }}"
                    >
                        <span class="h-1.5 w-1.5 shrink-0 rounded-full transition {{ $aktif ? 'bg-white' : 'bg-hijau-300 group-hover:bg-hijau-500' }}"></span>
                        <span class="min-w-0 flex-1">{{ $sub['judul'] }}</span>
                        <svg class="h-3.5 w-3.5 shrink-0 transition {{ $aktif ? 'text-white/80' : 'text-ink-300 group-hover:translate-x-0.5 group-hover:text-hijau-500' }}" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                    </a>
                @endforeach
            </nav>
        </div>
    </aside>
@endif
