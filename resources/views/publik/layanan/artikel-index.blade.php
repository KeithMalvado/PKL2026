@extends('publik.layout')

@section('judul', 'Artikel & Jurnal')

@section('konten')
    <x-hero-halaman judul="Artikel & Jurnal" induk="Layanan Publik" />

    <section class="mx-auto max-w-7xl px-4 py-14">
        {{-- filter jenis + pencarian --}}
        <div class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between" data-reveal>
            <div class="flex gap-2">
                <a href="{{ route('layanan.artikel') }}" class="rounded-xl px-4 py-2 text-sm font-semibold transition {{ !$jenis ? 'bg-hijau-600 text-white' : 'bg-hijau-50 text-hijau-700 hover:bg-hijau-100' }}">Semua</a>
                <a href="{{ route('layanan.artikel', ['jenis' => 'artikel']) }}" class="rounded-xl px-4 py-2 text-sm font-semibold transition {{ $jenis === 'artikel' ? 'bg-hijau-600 text-white' : 'bg-hijau-50 text-hijau-700 hover:bg-hijau-100' }}">Artikel</a>
                <a href="{{ route('layanan.artikel', ['jenis' => 'jurnal']) }}" class="rounded-xl px-4 py-2 text-sm font-semibold transition {{ $jenis === 'jurnal' ? 'bg-hijau-600 text-white' : 'bg-hijau-50 text-hijau-700 hover:bg-hijau-100' }}">Jurnal</a>
            </div>

            <form method="GET" class="flex gap-2">
                @if ($jenis)<input type="hidden" name="jenis" value="{{ $jenis }}">@endif
                <div class="relative">
                    <svg class="pointer-events-none absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                    <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari..." class="w-full rounded-xl border border-hijau-200 bg-white py-2.5 pl-10 pr-4 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                </div>
                <button class="rounded-xl bg-hijau-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-hijau-700">Cari</button>
            </form>
        </div>

        @if ($dtArt->count())
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($dtArt as $art)
                    <x-kartu-konten
                        :url="route('layanan.artikel.detail', $art)"
                        :judul="$art->judul"
                        :ringkasan="$art->ringkasan"
                        :gambar="$art->gambar"
                        :tgl="$art->tgl_terbit"
                        :label="ucfirst($art->jenis)"
                        :meta="$art->penulis"
                        data-reveal
                    />
                @endforeach
            </div>
            <div class="mt-10">{{ $dtArt->links() }}</div>
        @else
            <x-kosong judul="Belum Ada Konten" ket="Artikel dan jurnal akan ditampilkan di sini." />
        @endif
    </section>
@endsection
