@props([
    'bdg',
    'slide' => collect(),
    'aksen' => 'hijau',
])

@php
    $logo = logo_bdg($bdg);

    $rumbai = match ($aksen) {
        'sage' => 'from-sage-500 to-moss-600',
        'moss' => 'from-moss-600 to-hijau-700',
        'emas' => 'from-emas-500 to-moss-600',
        default => 'from-hijau-500 to-sage-600',
    };
@endphp

<div
    x-data="{
        i: 0,
        n: {{ $slide->count() }},
        timer: null,
        mulai() { if (this.n > 1) { this.timer = setInterval(() => { this.i = (this.i + 1) % this.n }, 5500) } },
        stop() { clearInterval(this.timer) }
    }"
    x-init="mulai()"
    @mouseenter="stop()"
    @mouseleave="mulai()"
    class="group relative overflow-hidden rounded-2xl border border-white/15 bg-white/5 shadow-lg backdrop-blur-sm transition duration-500 hover:border-white/30 hover:shadow-2xl hover:shadow-ink-950/40"
>
    <div class="relative aspect-[4/3] overflow-hidden">
        @forelse ($slide as $k => $art)
            <a
                href="{{ route('layanan.artikel.detail', $art) }}"
                x-show="i === {{ $k }}"
                x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0 scale-105"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @if ($k > 0) style="display: none;" @endif
                class="absolute inset-0 block"
            >
                @if ($art->gambar)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($art->gambar) }}" alt="{{ $art->judul }}" class="h-full w-full object-cover transition duration-[900ms] ease-out group-hover:scale-[1.08]">
                @else
                    <div class="grid h-full w-full place-items-center bg-gradient-to-br {{ $rumbai }}">
                        <span class="grid h-14 w-14 place-items-center rounded-2xl bg-white/20 text-white backdrop-blur">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                        </span>
                    </div>
                @endif

                <span class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-ink-950/90 via-ink-950/45 to-transparent p-3 pt-10">
                    <span class="line-clamp-2 block text-[12.5px] font-semibold leading-snug text-white">{{ $art->judul }}</span>
                    <span class="mt-1 flex items-center gap-1 text-[10px] font-medium text-hijau-200">
                        <span class="h-1 w-1 rounded-full bg-hijau-300"></span>
                        {{ $art->tgl_terbit?->translatedFormat('d M Y') ?? 'Artikel' }}
                    </span>
                </span>
            </a>
        @empty
            <a href="{{ route('bidang.detail', $bdg) }}" class="absolute inset-0 grid place-items-center bg-gradient-to-br {{ $rumbai }} p-4 text-center">
                @if ($logo)
                    <img src="{{ $logo }}" alt="Logo {{ $bdg->nama }}" class="h-14 w-14 object-contain transition duration-500 group-hover:scale-110">
                @else
                    <span class="grid h-14 w-14 place-items-center rounded-2xl bg-white/20 text-white backdrop-blur">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6z"/></svg>
                    </span>
                @endif
                <span class="mt-2 block text-xs font-semibold text-white/90">Belum ada artikel</span>
            </a>
        @endforelse

        @if ($slide->count() > 1)
            <div class="absolute right-2.5 top-2.5 flex items-center gap-1 rounded-full bg-ink-950/35 px-2 py-1 backdrop-blur">
                @foreach ($slide as $k => $art)
                    <button
                        type="button"
                        @click.prevent="i = {{ $k }}"
                        class="h-1.5 rounded-full transition-all duration-300"
                        :class="i === {{ $k }} ? 'w-4 bg-white' : 'w-1.5 bg-white/50 hover:bg-white/80'"
                        aria-label="Slide {{ $k + 1 }}"
                    ></button>
                @endforeach
            </div>
        @endif
    </div>

    <div class="flex items-center justify-between gap-2 bg-white/[0.07] px-2.5 py-2 sm:px-3 sm:py-2.5">
        <span class="flex min-w-0 items-center gap-2">
            @if ($logo)
                <img src="{{ $logo }}" alt="" class="h-5 w-5 shrink-0 object-contain">
            @else
                <span class="grid h-5 w-5 shrink-0 place-items-center rounded-md bg-gradient-to-br {{ $rumbai }} text-[9px] font-bold text-white">
                    {{ strtoupper(substr($bdg->nama, 7, 2)) }}
                </span>
            @endif
            <span class="truncate text-[11px] font-bold text-white sm:text-xs">{{ str_replace('Bidang ', '', $bdg->nama) }}</span>
        </span>
        <a href="{{ route('bidang.detail', $bdg) }}" class="inline-flex shrink-0 items-center gap-1 rounded-full bg-white/15 p-1.5 text-[10.5px] font-semibold text-white transition hover:bg-white/30 sm:px-2.5 sm:py-1" aria-label="Lihat semua {{ $bdg->nama }}">
            <span class="hidden sm:inline">Semua</span>
            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
        </a>
    </div>
</div>
