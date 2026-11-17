
@extends('publik.layout')

@section('judul', $judul)

@section('konten')
    @php
        /*
         * Tema otomatis berdasarkan halaman profil yang dibuka.
         * Halaman lainnya tetap menggunakan desain asli Ipan.
         */
        $temaBidang = match (request()->route()?->getName()) {
            'profil.bidang.keswan' => 'kesehatan-hewan',
            'profil.bidang.ternak' => 'peternakan',
            'profil.bidang.ikan' => 'perikanan',
            'profil.bidang.pangan' => 'ketahanan-pangan',
            'profil.sekretariat' => 'sekretariat',
            default => null,
        };
    @endphp

    <div class="{{ $temaBidang ? 'tema-bidang tema-bidang--' . $temaBidang : '' }}">

        {{-- Hero halaman asli --}}
        <x-hero-halaman :judul="$judul" />

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
