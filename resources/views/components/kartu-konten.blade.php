@props([
    'url',
    'judul',
    'ringkasan' => null,
    'gambar' => null,
    'tgl' => null,       // tanggal (Carbon) opsional
    'label' => null,     // badge kategori/jenis
    'meta' => null,      // teks meta tambahan (mis. jumlah dilihat)
])

<a
    href="{{ $url }}"
    {{ $attributes->merge(['class' => 'group flex flex-col overflow-hidden rounded-2xl border border-hijau-100 bg-white shadow-sm transition hover:-translate-y-1 hover:border-hijau-300 hover:shadow-xl hover:shadow-hijau-900/10']) }}
>
    {{-- gambar / placeholder --}}
    <div class="relative aspect-[16/10] overflow-hidden bg-hijau-50">
        @if ($gambar)
            <img src="{{ \Illuminate\Support\Facades\Storage::url($gambar) }}" alt="{{ $judul }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
        @else
            <div class="grid h-full w-full place-items-center text-hijau-200">
                <svg class="h-14 w-14" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 19.5h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/></svg>
            </div>
        @endif
        @if ($label)
            <span class="absolute left-3 top-3 rounded-full bg-hijau-600 px-3 py-1 text-xs font-semibold text-white shadow">{{ $label }}</span>
        @endif
    </div>

    {{-- isi --}}
    <div class="flex flex-1 flex-col p-5">
        @if ($tgl || $meta)
            <div class="mb-2 flex items-center gap-3 text-xs text-slate-400">
                @if ($tgl)
                    <span class="inline-flex items-center gap-1">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                        {{ $tgl->translatedFormat('d M Y') }}
                    </span>
                @endif
                @if ($meta)
                    <span>{{ $meta }}</span>
                @endif
            </div>
        @endif

        <h3 class="line-clamp-2 font-bold text-slate-800 transition group-hover:text-hijau-700">{{ $judul }}</h3>

        @if ($ringkasan)
            <p class="mt-2 line-clamp-3 text-sm leading-relaxed text-slate-500">{{ $ringkasan }}</p>
        @endif

        <span class="mt-4 inline-flex items-center gap-1 text-sm font-semibold text-hijau-600">
            Selengkapnya
            <svg class="h-4 w-4 transition group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
        </span>
    </div>
</a>
