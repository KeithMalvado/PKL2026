@extends('publik.layout')

@section('judul', 'Artikel & Jurnal')

@section('konten')
    <x-hero-halaman judul="Artikel & Jurnal" induk="Layanan Publik" ket="Kajian, tulisan, dan publikasi ilmiah seputar pangan, peternakan, dan perikanan." />

    <section class="mx-auto max-w-7xl px-4 py-16 md:px-6 md:py-20">
        {{-- filter jenis + pencarian --}}
        <div class="mb-10 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between" data-reveal>
            <div class="inline-flex w-fit gap-1 rounded-2xl border border-ink-200 bg-white p-1.5 shadow-sm">
                @foreach ([
                    ['label' => 'Semua', 'url' => route('layanan.artikel'), 'aktif' => !$jenis],
                    ['label' => 'Artikel', 'url' => route('layanan.artikel', ['jenis' => 'artikel']), 'aktif' => $jenis === 'artikel'],
                    ['label' => 'Jurnal', 'url' => route('layanan.artikel', ['jenis' => 'jurnal']), 'aktif' => $jenis === 'jurnal'],
                ] as $tab)
                    <a href="{{ $tab['url'] }}" class="rounded-xl px-4 py-2 text-sm font-semibold transition {{ $tab['aktif'] ? 'bg-gradient-to-r from-hijau-600 to-sage-600 text-white shadow-md shadow-hijau-600/20' : 'text-ink-500 hover:bg-hijau-50 hover:text-hijau-700' }}">{{ $tab['label'] }}</a>
                @endforeach
            </div>

            <form method="GET" class="flex w-full gap-2.5 lg:w-auto">@if ($jenis)<input type="hidden" name="jenis" value="{{ $jenis }}">@endif
                <div class="relative min-w-0 flex-1 lg:w-72 lg:flex-none">
                    <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-ink-300" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                    <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari artikel..." class="w-full rounded-2xl border border-ink-200 bg-white py-3 pl-12 pr-4 text-sm text-ink-700 shadow-sm outline-none transition placeholder:text-ink-300 focus:border-hijau-400 focus:ring-4 focus:ring-hijau-100">
                </div>
                <button class="rounded-2xl bg-gradient-to-r from-hijau-600 to-sage-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-hijau-600/20 transition hover:-translate-y-0.5 hover:shadow-xl">Cari</button>
            </form>
        </div>

        @if ($dtArt->count())
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($dtArt as $i => $art)
                    <x-kartu-konten
                        :url="route('layanan.artikel.detail', $art)"
                        :judul="$art->judul"
                        :ringkasan="$art->ringkasan"
                        :gambar="$art->gambar"
                        :tgl="$art->tgl_terbit"
                        :label="ucfirst($art->jenis)"
                        :meta="$art->penulis"
                        :warna="$art->jenis === 'jurnal' ? 'moss' : 'hijau'"
                        data-reveal
                        data-delay="{{ ($i % 3) + 1 }}"
                    />
                @endforeach
            </div>
            <div class="mt-12">{{ $dtArt->links() }}</div>
        @else
            <x-kosong judul="Belum Ada Konten" ket="Artikel dan jurnal akan ditampilkan di sini." />
        @endif
    </section>
@endsection
