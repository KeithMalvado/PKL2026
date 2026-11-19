
@extends('publik.layout')

@section('judul', $judul)

@section('konten')
    @php
        /*
         * Tema otomatis berdasarkan halaman profil yang dibuka.
         * Halaman lainnya tetap menggunakan desain asli Ipan.
         */
        // Gunakan tema Profil Bidang yang sama untuk halaman UPTD.
        $judulUptd = mb_strtolower((string) $judul);

        $temaUptd = request()->is('uptd/*') ? match (true) {
            str_contains($judulUptd, 'keswan'),
            str_contains($judulUptd, 'kesmavet'),
            str_contains($judulUptd, 'klinik hewan'),
            str_contains($judulUptd, 'rumah potong hewan')
                => 'kesehatan-hewan',

            str_contains($judulUptd, 'pembibitan'),
            str_contains($judulUptd, 'hijauan pakan')
                => 'peternakan',

            str_contains($judulUptd, 'pelelangan ikan'),
            str_contains($judulUptd, 'perikanan air tawar')
                => 'perikanan',

            default => null,
        } : null;

        $temaBidang = match (request()->route()?->getName()) {
            'profil.bidang.keswan' => 'kesehatan-hewan',
            'profil.bidang.ternak' => 'peternakan',
            'profil.bidang.ikan' => 'perikanan',
            'profil.bidang.pangan' => 'ketahanan-pangan',
            'profil.sekretariat' => 'sekretariat',
            default => $temaUptd,
        };
    @endphp

    <div class="{{ $temaBidang ? 'tema-bidang tema-bidang--' . $temaBidang : '' }}">

        {{-- Hero halaman asli --}}
        <x-hero-halaman :judul="$judul" :tema="$temaBidang" />

        {{-- Konten halaman --}}
        <section class="mx-auto max-w-7xl px-4 py-16 md:px-6 md:py-20">
            <div class="flex flex-col gap-10 lg:flex-row">

                {{-- Sidebar sub-menu asli Ipan --}}
                <x-sidebar-sub />

                {{-- Konten utama --}}
                <div class="min-w-0 flex-1" data-reveal>

                    <div class="konten-tema-bidang rounded-3xl border border-hijau-100 bg-white p-6 shadow-lembut md:p-10">

                        @if (!empty($gambar))
                            <img
                                src="{{ \Illuminate\Support\Facades\Storage::url($gambar) }}"
                                alt="{{ $judul }}"
                                class="mb-8 w-full rounded-2xl border border-hijau-100 object-cover shadow-sm"
                            >
                        @endif

                        <article class="prose-dkpp">
                            {!! $isi !!}
                        </article>

                    </div>

                </div>

            </div>
        </section>

    </div>
@endsection
