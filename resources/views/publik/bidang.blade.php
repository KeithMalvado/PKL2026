@extends('publik.layout')

@section('judul', $bdg->nama)

@section('konten')
    @php $logo = logo_bdg($bdg); @endphp

    <x-hero-halaman :judul="$bdg->nama" induk="Bidang" :ket="$bdg->deskripsi" />

    <section class="mx-auto max-w-7xl px-4 py-16 md:px-6 md:py-20">
        <div class="mb-10 flex flex-wrap items-center gap-4 rounded-2xl border border-hijau-100 bg-white px-5 py-4 shadow-lembut" data-reveal>
            <span class="grid h-12 w-12 shrink-0 place-items-center rounded-xl bg-hijau-50 p-1.5 ring-1 ring-hijau-100">
                @if ($logo)
                    <img src="{{ $logo }}" alt="Logo {{ $bdg->nama }}" class="h-full w-full object-contain">
                @else
                    <svg class="h-6 w-6 text-hijau-500" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6z"/></svg>
                @endif
            </span>
            <div class="min-w-0 flex-1">
                <p class="text-[11px] font-bold uppercase tracking-[0.14em] text-hijau-600">{{ $bdg->kode }}</p>
                <p class="text-sm text-ink-500">Artikel &amp; kegiatan bidang ini</p>
            </div>
            <span class="shrink-0 rounded-xl bg-hijau-50 px-4 py-2 text-center">
                <span class="block text-lg font-extrabold leading-none text-hijau-700">{{ $dtArt->total() }}</span>
                <span class="text-[11px] font-medium text-ink-400">Artikel</span>
            </span>
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
                        :label="$art->jenis === 'jurnal' ? 'Jurnal' : 'Artikel'"
                        :warna="['hijau', 'sage', 'moss', 'emas'][$i % 4]"
                        data-reveal
                        data-delay="{{ ($i % 3) + 1 }}"
                    />
                @endforeach
            </div>

            <div class="mt-12">{{ $dtArt->links() }}</div>
        @else
            <x-kosong judul="Belum Ada Artikel" ket="Artikel dan kegiatan bidang ini akan ditampilkan di sini." />
        @endif
    </section>
@endsection
