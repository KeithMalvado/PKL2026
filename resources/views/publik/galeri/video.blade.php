@extends('publik.layout')

@section('judul', 'Video Kegiatan')

@section('konten')
    <x-hero-halaman judul="Video Kegiatan" induk="Galeri" ket="Dokumentasi kegiatan dinas dalam kanal YouTube resmi." />

    <section class="mx-auto max-w-7xl px-4 py-16 md:px-6 md:py-20">
        @if ($dtVid->count())
            <div
                x-data="{ buka: false, embed: '', judul: '' }"
                class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3"
            >
                @foreach ($dtVid as $i => $vid)
                    <button
                        @click="embed = @js($vid->embedUrl()); judul = @js($vid->judul); buka = true"
                        data-reveal data-delay="{{ ($i % 3) + 1 }}"
                        class="kartu kartu-angkat group overflow-hidden text-left"
                    >
                        <div class="relative aspect-video overflow-hidden bg-ink-900">
                            @if ($vid->thumbUrl())
                                <img src="{{ $vid->thumbUrl() }}" alt="{{ $vid->judul }}" loading="lazy" class="h-full w-full object-cover opacity-90 transition duration-700 group-hover:scale-105 group-hover:opacity-100">
                            @endif
                            <span class="absolute inset-0 bg-gradient-to-t from-ink-950/50 to-transparent"></span>
                            <span class="absolute inset-0 grid place-items-center">
                                <span class="grid h-16 w-16 place-items-center rounded-full bg-white/95 text-hijau-600 shadow-xl transition duration-500 group-hover:scale-110 group-hover:bg-gradient-to-br group-hover:from-hijau-500 group-hover:to-sage-500 group-hover:text-white">
                                    <svg class="ml-1 h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </span>
                            </span>
                        </div>
                        <div class="p-5">
                            <h3 class="line-clamp-2 font-bold text-ink-800 transition group-hover:text-hijau-700">{{ $vid->judul }}</h3>
                            @if ($vid->ket)
                                <p class="mt-2 line-clamp-2 text-sm text-ink-500">{{ $vid->ket }}</p>
                            @endif
                        </div>
                    </button>
                @endforeach

                {{-- modal player --}}
                <div
                    x-show="buka" x-transition.opacity style="display:none;"
                    @keydown.escape.window="buka = false; embed = ''"
                    class="fixed inset-0 z-[60] grid place-items-center bg-ink-950/90 p-4 backdrop-blur-sm"
                >
                    <button @click="buka = false; embed = ''" class="absolute right-5 top-5 grid h-11 w-11 place-items-center rounded-full bg-white/10 text-white backdrop-blur transition hover:bg-white/25" aria-label="Tutup">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                    <div class="w-full max-w-3xl" @click.stop>
                        <div class="aspect-video overflow-hidden rounded-2xl bg-black shadow-2xl">
                            <template x-if="buka && embed">
                                <iframe :src="embed" class="h-full w-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </template>
                        </div>
                        <p class="mt-3 text-center text-sm font-medium text-white" x-text="judul"></p>
                    </div>
                </div>
            </div>

            <div class="mt-12">{{ $dtVid->links() }}</div>
        @else
            <x-kosong judul="Belum Ada Video" ket="Video dokumentasi kegiatan akan ditampilkan di sini." />
        @endif
    </section>
@endsection
