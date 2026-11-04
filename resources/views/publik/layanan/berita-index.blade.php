@extends('publik.layout')

@section('judul', $judul)

@section('konten')
    <x-hero-halaman :judul="$judul" induk="Layanan Publik" />

    <section class="mx-auto max-w-7xl px-4 py-14">
        {{-- pencarian --}}
        <form method="GET" class="mb-10 flex max-w-md gap-2" data-reveal>
            <div class="relative flex-1">
                <svg class="pointer-events-none absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                <input
                    type="search" name="q" value="{{ request('q') }}"
                    placeholder="Cari {{ strtolower($judul) }}..."
                    class="w-full rounded-xl border border-hijau-200 bg-white py-2.5 pl-10 pr-4 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200"
                >
            </div>
            <button class="rounded-xl bg-hijau-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-hijau-700">Cari</button>
        </form>

        @if ($dtBrt->count())
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($dtBrt as $brt)
                    <x-kartu-konten
                        :url="route('layanan.berita.detail', $brt)"
                        :judul="$brt->judul"
                        :ringkasan="$brt->ringkasan"
                        :gambar="$brt->gambar"
                        :tgl="$brt->tgl_terbit"
                        :label="$jenis === 'ppid' ? 'PPID' : 'Kegiatan'"
                        :meta="$brt->dilihat . 'x dilihat'"
                        data-reveal
                    />
                @endforeach
            </div>

            <div class="mt-10">
                {{ $dtBrt->links() }}
            </div>
        @else
            <x-kosong
                judul="Belum Ada {{ $judul }}"
                ket="Informasi akan ditampilkan di sini setelah dipublikasikan."
            />
        @endif
    </section>
@endsection
