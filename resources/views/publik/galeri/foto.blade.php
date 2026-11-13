@extends('publik.layout')

@section('judul', 'Galeri Foto')

@section('konten')
    <x-hero-halaman judul="Galeri Foto" induk="Galeri" ket="Dokumentasi visual kegiatan dan program Dinas Ketahanan Pangan, Peternakan, dan Perikanan." />

    <section class="mx-auto max-w-7xl px-4 py-16 md:px-6 md:py-20">
        {{-- filter album --}}
        @if ($dtAlbum->count())
            <div class="mb-10 flex flex-wrap gap-2" data-reveal>
                <a href="{{ route('galeri.foto') }}" class="rounded-full px-4 py-2 text-sm font-semibold transition {{ !$album ? 'bg-gradient-to-r from-hijau-600 to-sage-600 text-white shadow-md shadow-hijau-600/20' : 'border border-ink-200 bg-white text-ink-500 hover:border-hijau-300 hover:text-hijau-700' }}">Semua Album</a>
                @foreach ($dtAlbum as $a)
                    <a href="{{ route('galeri.foto', ['album' => $a]) }}" class="rounded-full px-4 py-2 text-sm font-semibold transition {{ $album === $a ? 'bg-gradient-to-r from-hijau-600 to-sage-600 text-white shadow-md shadow-hijau-600/20' : 'border border-ink-200 bg-white text-ink-500 hover:border-hijau-300 hover:text-hijau-700' }}">{{ $a }}</a>
                @endforeach
            </div>
        @endif

        @if ($dtFoto->count())
            <div
                x-data="{ buka: false, idx: 0, fotos: {{ Illuminate\Support\Js::from($dtFoto->map(fn($f) => ['src' => Illuminate\Support\Facades\Storage::url($f->path), 'judul' => $f->judul])->values()) }} }"
                class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4"
            >
                @foreach ($dtFoto as $i => $foto)
                    <button
                        @click="idx = {{ $i }}; buka = true"
                        data-reveal data-delay="{{ ($i % 4) + 1 }}"
                        class="group relative aspect-square overflow-hidden rounded-2xl bg-hijau-50 shadow-sm ring-1 ring-hijau-100/60 transition duration-500 hover:-translate-y-1 hover:shadow-xl hover:ring-hijau-300"
                    >
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($foto->path) }}" alt="{{ $foto->judul }}" loading="lazy" class="h-full w-full object-cover transition duration-700 group-hover:scale-110">
                        <span class="absolute inset-0 bg-gradient-to-t from-ink-950/80 via-ink-950/10 to-transparent opacity-0 transition duration-500 group-hover:opacity-100"></span>
                        <span class="absolute inset-x-0 bottom-0 translate-y-3 p-3 text-left opacity-0 transition duration-500 group-hover:translate-y-0 group-hover:opacity-100">
                            <span class="line-clamp-2 block text-xs font-semibold text-white">{{ $foto->judul }}</span>
                        </span>
                        <span class="absolute right-2.5 top-2.5 grid h-8 w-8 place-items-center rounded-full bg-white/90 text-hijau-700 opacity-0 shadow transition duration-500 group-hover:opacity-100">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM10.5 7.5v6m3-3h-6"/></svg>
                        </span>
                    </button>
                @endforeach

                {{-- lightbox --}}
                <div
                    x-show="buka" x-transition.opacity style="display:none;"
                    @keydown.escape.window="buka = false"
                    @keydown.arrow-right.window="idx = (idx + 1) % fotos.length"
                    @keydown.arrow-left.window="idx = (idx - 1 + fotos.length) % fotos.length"
                    class="fixed inset-0 z-[60] grid place-items-center bg-ink-950/90 p-4 backdrop-blur-sm"
                >
                    <button @click="buka = false" class="absolute right-5 top-5 grid h-11 w-11 place-items-center rounded-full bg-white/10 text-white backdrop-blur transition hover:bg-white/25" aria-label="Tutup">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                    <button @click="idx = (idx - 1 + fotos.length) % fotos.length" class="absolute left-4 top-1/2 grid h-11 w-11 -translate-y-1/2 place-items-center rounded-full bg-white/10 text-white backdrop-blur transition hover:bg-white/25" aria-label="Sebelumnya">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>
                    </button>
                    <button @click="idx = (idx + 1) % fotos.length" class="absolute right-4 top-1/2 grid h-11 w-11 -translate-y-1/2 place-items-center rounded-full bg-white/10 text-white backdrop-blur transition hover:bg-white/25" aria-label="Berikutnya">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                    </button>
                    <div class="max-h-[85vh] max-w-4xl text-center" @click.stop>
                        <img :src="fotos[idx]?.src" :alt="fotos[idx]?.judul" class="mx-auto max-h-[80vh] rounded-2xl shadow-2xl">
                        <p class="mt-3 text-sm text-white" x-text="fotos[idx]?.judul"></p>
                    </div>
                </div>
            </div>

            <div class="mt-12">{{ $dtFoto->links() }}</div>
        @else
            <x-kosong judul="Belum Ada Foto" ket="Dokumentasi foto kegiatan akan ditampilkan di sini." />
        @endif
    </section>
@endsection
