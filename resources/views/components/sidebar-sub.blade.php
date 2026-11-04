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
    <aside class="lg:w-72 lg:shrink-0">
        <div class="sticky top-24 overflow-hidden rounded-2xl border border-hijau-100 bg-white shadow-sm">
            <div class="bg-hijau-600 px-5 py-4">
                <h2 class="text-sm font-bold uppercase tracking-wide text-white">{{ $kelompok['judul'] }}</h2>
            </div>
            <nav class="p-2">
                @foreach ($kelompok['sub'] as $sub)
                    @php $aktif = $rtAktif === $sub['route']; @endphp
                    <a
                        href="{{ route($sub['route']) }}"
                        class="flex items-center gap-2 rounded-xl px-3 py-2.5 text-sm transition {{ $aktif ? 'bg-hijau-50 font-semibold text-hijau-700' : 'text-slate-600 hover:bg-hijau-50/60 hover:text-hijau-700' }}"
                    >
                        <span class="h-1.5 w-1.5 shrink-0 rounded-full {{ $aktif ? 'bg-hijau-600' : 'bg-hijau-200' }}"></span>
                        {{ $sub['judul'] }}
                    </a>
                @endforeach
            </nav>
        </div>
    </aside>
@endif
