@props([
    'url',
    'judul',
    'ringkasan' => null,
    'gambar' => null,
    'tgl' => null,       // tanggal (Carbon) opsional
    'label' => null,     // badge kategori/jenis
    'meta' => null,      // teks meta tambahan (mis. jumlah dilihat)
    'warna' => 'hijau',  // aksen: hijau | sage | moss | emas
])

@php
    $badge = match ($warna) {
        'sage' => 'bg-sage-500/95',
        'moss' => 'bg-moss-500/95',
        'emas' => 'bg-emas-500/95',
        default => 'bg-hijau-600/95',
    };

    $teks = match ($warna) {
        'sage' => 'text-sage-600 group-hover:text-sage-700',
        'moss' => 'text-moss-600 group-hover:text-moss-700',
        'emas' => 'text-emas-600 group-hover:text-emas-700',
        default => 'text-hijau-600 group-hover:text-hijau-700',
    };
@endphp

<a
    href="{{ $url }}"
    {{ $attributes->merge(['class' => 'kartu kartu-angkat group flex flex-col overflow-hidden']) }}
>
    {{-- gambar / placeholder --}}
    <div class="relative aspect-[16/10] overflow-hidden bg-gradient-to-br from-hijau-50 via-sage-50 to-moss-50">
        @if ($gambar)
            <img src="{{ \Illuminate\Support\Facades\Storage::url($gambar) }}" alt="{{ $judul }}" loading="lazy" class="h-full w-full object-cover transition duration-700 ease-out group-hover:scale-[1.07]">
            <div class="absolute inset-0 bg-gradient-to-t from-ink-950/45 via-ink-950/5 to-transparent opacity-70 transition group-hover:opacity-90"></div>
        @else
            <div class="pola-titik-gelap grid h-full w-full place-items-center">
                <span class="grid h-16 w-16 place-items-center rounded-2xl bg-white/70 text-hijau-400 shadow-sm backdrop-blur">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.4" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 19.5h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/></svg>
                </span>
            </div>
        @endif

        @if ($label)
            <span class="absolute left-4 top-4 rounded-full {{ $badge }} px-3 py-1 text-[11px] font-bold uppercase tracking-wide text-white shadow-lg backdrop-blur">
                {{ $label }}
            </span>
        @endif
    </div>

    {{-- isi --}}
    <div class="flex flex-1 flex-col p-6">
        @if ($tgl || $meta)
            <div class="mb-3 flex flex-wrap items-center gap-x-3 gap-y-1 text-xs font-medium text-ink-400">
                @if ($tgl)
                    <span class="inline-flex items-center gap-1.5">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                        {{ $tgl->translatedFormat('d M Y') }}
                    </span>
                @endif
                @if ($meta)
                    <span class="inline-flex items-center gap-1.5">
                        <span class="h-1 w-1 rounded-full bg-ink-300"></span>
                        {{ $meta }}
                    </span>
                @endif
            </div>
        @endif

        <h3 class="line-clamp-2 text-[17px] font-bold leading-snug text-ink-800 transition group-hover:text-hijau-700">{{ $judul }}</h3>

        @if ($ringkasan)
            <p class="mt-2 line-clamp-3 text-sm leading-relaxed text-ink-500">{{ $ringkasan }}</p>
        @endif

        <span class="mt-auto inline-flex items-center gap-1.5 pt-5 text-sm font-semibold {{ $teks }}">
            Selengkapnya
            <span class="grid h-7 w-7 place-items-center rounded-full bg-ink-50 transition duration-300 group-hover:bg-hijau-600 group-hover:text-white">
                <svg class="h-3.5 w-3.5 transition group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
            </span>
        </span>
    </div>
</a>
