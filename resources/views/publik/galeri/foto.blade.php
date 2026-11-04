@extends('publik.layout')

@section('judul', 'Galeri Foto')

@section('konten')
    <x-hero-halaman judul="Galeri Foto" induk="Galeri" />

    <section class="mx-auto max-w-7xl px-4 py-14">
        {{-- filter album --}}
        @if ($dtAlbum->count())
            <div class="mb-8 flex flex-wrap gap-2" data-reveal>
                <a href="{{ route('galeri.foto') }}" class="rounded-xl px-4 py-2 text-sm font-semibold transition {{ !$album ? 'bg-hijau-600 text-white' : 'bg-hijau-50 text-hijau-700 hover:bg-hijau-100' }}">Semua Album</a>
                @foreach ($dtAlbum as $a)
                    <a href="{{ route('galeri.foto', ['album' => $a]) }}" class="rounded-xl px-4 py-2 text-sm font-semibold transition {{ $album === $a ? 'bg-hijau-600 text-white' : 'bg-hijau-50 text-hijau-700 hover:bg-hijau-100' }}">{{ $a }}</a>
                @endforeach
            </div>
        @endif

        @if ($dtFoto->count())
            <div
                x-data="{ buka: false, idx: 0, fotos: {{ Illuminate\Support\Js::from($dtFoto->map(fn($f) => ['src' => Illuminate\Support\Facades\Storage::url($f->path), 'judul' => $f->judul])->values()) }} }"
                class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4"
            >
                @foreach ($dtFoto as $i => $foto)
                    <button
                        @click="idx = {{ $i }}; buka = true"
                        data-reveal
                        class="group relative aspect-square overflow-hidden rounded-xl bg-hijau-50"
                    >
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($foto->path) }}" alt="{{ $foto->judul }}" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                        <span class="absolute inset-0 flex items-end bg-gradient-to-t from-black/60 to-transparent p-3 opacity-0 transition group-hover:opacity-100">
                            <span class="text-left text-xs font-semibold text-white">{{ $foto->judul }}</span>
                        </span>
                    </button>
                @endforeach

                {{-- lightbox --}}
                <div
                    x-show="buka" x-transition.opacity style="display:none;"
                    @keydown.escape.window="buka = false"
                    @keydown.arrow-right.window="idx = (idx + 1) % fotos.length"
                    @keydown.arrow-left.window="idx = (idx - 1 + fotos.length) % fotos.length"
                    class="fixed inset-0 z-[60] grid place-items-center bg-black/85 p-4"
                >
                    <button @click="buka = false" class="absolute right-5 top-5 grid h-11 w-11 place-items-center rounded-full bg-white/10 text-white backdrop-blur transition hover:bg-white/20" aria-label="Tutup">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                    <button @click="idx = (idx - 1 + fotos.length) % fotos.length" class="absolute left-4 top-1/2 grid h-11 w-11 -translate-y-1/2 place-items-center rounded-full bg-white/10 text-white backdrop-blur transition hover:bg-white/20" aria-label="Sebelumnya">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>
                    </button>
                    <button @click="idx = (idx + 1) % fotos.length" class="absolute right-4 top-1/2 grid h-11 w-11 -translate-y-1/2 place-items-center rounded-full bg-white/10 text-white backdrop-blur transition hover:bg-white/20" aria-label="Berikutnya">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                    </button>
                    <div class="max-h-[85vh] max-w-4xl text-center" @click.stop>
                        <img :src="fotos[idx]?.src" :alt="fotos[idx]?.judul" class="mx-auto max-h-[80vh] rounded-lg">
                        <p class="mt-3 text-sm text-white" x-text="fotos[idx]?.judul"></p>
                    </div>
                </div>
            </div>

            <div class="mt-10">{{ $dtFoto->links() }}</div>
        @else
            <x-kosong judul="Belum Ada Foto" ket="Dokumentasi foto kegiatan akan ditampilkan di sini." />
        @endif
    </section>
@endsection
