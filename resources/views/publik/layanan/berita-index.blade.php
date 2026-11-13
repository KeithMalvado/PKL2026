@extends('publik.layout')

@section('judul', $judul)

@section('konten')
    <x-hero-halaman :judul="$judul" induk="Layanan Publik" :ket="$jenis === 'ppid' ? 'Informasi publik dan keterbukaan informasi Dinas Ketahanan Pangan, Peternakan, dan Perikanan.' : 'Dokumentasi kegiatan dan program kerja dinas.'" />

    <section class="mx-auto max-w-7xl px-4 py-16 md:px-6 md:py-20">
        @if ($jenis === 'ppid' && setelan('ppid.induk'))
            <div class="relative mb-12 overflow-hidden rounded-3xl border border-hijau-100 bg-gradient-to-r from-hijau-50 via-white to-sage-50 p-6 shadow-lembut md:p-8" data-reveal>
                <div class="pola-titik-gelap absolute inset-0 opacity-40"></div>
                <div class="animasi-mengambang absolute -right-8 -top-10 h-40 w-40 rounded-full bg-sage-200/40 blur-2xl"></div>
                <div class="relative flex flex-col items-start gap-5 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-start gap-4">
                        <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-gradient-to-br from-hijau-600 to-sage-600 text-white shadow-md">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/></svg>
                        </span>
                        <div>
                            <h2 class="text-base font-bold text-hijau-900">PPID Induk</h2>
                            <p class="mt-1 max-w-xl text-sm leading-relaxed text-ink-500">Pengelolaan PPID dilaksanakan oleh Dinas Kominfo Kabupaten Jember. Daftar informasi publik resmi dapat diakses pada portal PPID induk.</p>
                        </div>
                    </div>
                    <a
                        href="{{ setelan('ppid.induk') }}"
                        target="_blank"
                        rel="noopener"
                        class="group inline-flex shrink-0 items-center gap-2 rounded-xl bg-gradient-to-r from-hijau-600 to-sage-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-hijau-600/20 transition hover:-translate-y-0.5 hover:shadow-xl"
                    >
                        Buka Portal PPID
                        <svg class="h-4 w-4 transition group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                    </a>
                </div>
            </div>
        @endif

        {{-- pencarian --}}
        <form method="GET" class="mb-10 flex max-w-xl gap-2.5" data-reveal>
            <div class="relative flex-1">
                <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-ink-300" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                <input
                    type="search" name="q" value="{{ request('q') }}"
                    placeholder="Cari {{ strtolower($judul) }}..."
                    class="w-full rounded-2xl border border-ink-200 bg-white py-3 pl-12 pr-4 text-sm text-ink-700 shadow-sm outline-none transition placeholder:text-ink-300 focus:border-hijau-400 focus:ring-4 focus:ring-hijau-100"
                >
            </div>
            <button class="rounded-2xl bg-gradient-to-r from-hijau-600 to-sage-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-hijau-600/20 transition hover:-translate-y-0.5 hover:shadow-xl">Cari</button>
        </form>

        @if ($dtBrt->count())
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($dtBrt as $i => $brt)
                    <x-kartu-konten
                        :url="route('layanan.berita.detail', $brt)"
                        :judul="$brt->judul"
                        :ringkasan="$brt->ringkasan"
                        :gambar="$brt->gambar"
                        :tgl="$brt->tgl_terbit"
                        :label="$jenis === 'ppid' ? 'PPID' : 'Kegiatan'"
                        :meta="$brt->dilihat . 'x dilihat'"
                        :warna="['hijau', 'sage', 'moss', 'emas'][$i % 4]"
                        data-reveal
                        data-delay="{{ ($i % 3) + 1 }}"
                    />
                @endforeach
            </div>

            <div class="mt-12">{{ $dtBrt->links() }}</div>
        @else
            <x-kosong
                judul="Belum Ada {{ $judul }}"
                ket="Informasi akan ditampilkan di sini setelah dipublikasikan."
            />
        @endif
    </section>
@endsection
