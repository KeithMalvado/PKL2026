@extends('publik.layout')

@section('judul', 'Beranda')

@section('konten')
    {{-- ===== HERO ===== --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-hijau-700 via-hijau-600 to-hijau-800">
        {{-- ornamen latar --}}
        <div class="absolute -right-24 -top-24 h-96 w-96 rounded-full bg-white/10 blur-3xl"></div>
        <div class="absolute -bottom-32 -left-16 h-96 w-96 rounded-full bg-hijau-400/20 blur-3xl animasi-mengambang"></div>
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 32px 32px;"></div>

        <div class="relative mx-auto grid max-w-7xl items-center gap-12 px-4 py-24 lg:grid-cols-2 lg:py-32">
            <div class="text-white" data-reveal="kiri">
                <span class="inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-1.5 text-xs font-semibold backdrop-blur">
                    <span class="h-2 w-2 rounded-full bg-emas-400 animasi-denyut"></span>
                    Layanan Digital Terpadu
                </span>
                <h1 class="mt-6 text-4xl font-extrabold leading-tight md:text-5xl lg:text-6xl">
                    Dinas Ketahanan Pangan, Peternakan &amp; Perikanan
                </h1>
                <p class="mt-5 max-w-xl text-base leading-relaxed text-hijau-100 md:text-lg">
                    Mewujudkan kemandirian pangan, kesejahteraan peternak dan nelayan, serta pelayanan publik Kabupaten Jember yang transparan dan akuntabel.
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('pgdn.form') }}" class="inline-flex items-center gap-2 rounded-xl bg-white px-6 py-3 text-sm font-semibold text-hijau-700 shadow-lg transition hover:-translate-y-0.5 hover:bg-hijau-50">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10.5h8m-8 3h5m-9 5.25V6.75A2.25 2.25 0 016.25 4.5h11.5A2.25 2.25 0 0120 6.75v7.5a2.25 2.25 0 01-2.25 2.25H8.5L4 20.25z"/></svg>
                        Buat Pengaduan
                    </a>
                    <a href="{{ route('profil.sambutan') }}" class="inline-flex items-center gap-2 rounded-xl border border-white/30 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10">
                        Tentang Kami
                    </a>
                </div>
            </div>

            {{-- kartu ringkas --}}
            <div class="relative" data-reveal="kanan" data-delay="2">
                <div class="rounded-3xl border border-white/20 bg-white/10 p-6 backdrop-blur-md">
                    <div class="grid grid-cols-2 gap-4">
                        @foreach ([
                            ['judul' => 'Ketahanan Pangan', 'ikon' => 'M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25z'],
                            ['judul' => 'Peternakan', 'ikon' => 'M15.75 10.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z'],
                            ['judul' => 'Perikanan', 'ikon' => 'M3.75 12h16.5'],
                            ['judul' => 'Kesehatan Hewan', 'ikon' => 'M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733'],
                        ] as $kartu)
                            <div class="rounded-2xl bg-white/90 p-4 text-center transition hover:-translate-y-1">
                                <span class="mx-auto grid h-12 w-12 place-items-center rounded-xl bg-hijau-100 text-hijau-600">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $kartu['ikon'] }}"/></svg>
                                </span>
                                <p class="mt-3 text-sm font-bold text-hijau-800">{{ $kartu['judul'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- lengkung pemisah --}}
        <div class="relative">
            <svg class="w-full" viewBox="0 0 1440 80" preserveAspectRatio="none" fill="none"><path d="M0 80V40C240 0 480 0 720 20C960 40 1200 80 1440 60V80H0Z" fill="white"/></svg>
        </div>
    </section>

    {{-- ===== STATISTIK ===== --}}
    <section class="mx-auto max-w-7xl px-4 py-4">
        <div class="grid gap-6 rounded-3xl border border-hijau-100 bg-white p-8 shadow-xl shadow-hijau-900/5 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ([
                ['angka' => '5', 'label' => 'UPTD Pelayanan'],
                ['angka' => '4', 'label' => 'Bidang Teknis'],
                ['angka' => '24/7', 'label' => 'Pengaduan Online'],
                ['angka' => '100%', 'label' => 'Transparan'],
            ] as $i => $stat)
                <div data-reveal data-delay="{{ $i + 1 }}" class="text-center">
                    <p class="text-3xl font-extrabold text-hijau-600 md:text-4xl">{{ $stat['angka'] }}</p>
                    <p class="mt-1 text-sm font-medium text-slate-500">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ===== LAYANAN UNGGULAN ===== --}}
    <section class="mx-auto max-w-7xl px-4 py-20">
        <div class="mx-auto max-w-2xl text-center" data-reveal>
            <span class="text-sm font-bold uppercase tracking-wider text-hijau-600">Layanan Kami</span>
            <h2 class="mt-2 text-3xl font-extrabold text-slate-800 md:text-4xl">Akses Cepat Pelayanan</h2>
            <p class="mt-3 text-slate-500">Berbagai layanan informasi dan pengaduan yang dapat Anda akses secara daring.</p>
        </div>

        <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ([
                ['judul' => 'Pengaduan Online', 'ket' => 'Sampaikan keluhan & dapatkan nomor tiket yang bisa dilacak.', 'route' => 'pgdn.form'],
                ['judul' => 'Berita PPID', 'ket' => 'Informasi publik terbaru seputar kegiatan dinas.', 'route' => 'layanan.berita'],
                ['judul' => 'Forum Konsultasi', 'ket' => 'Diskusi & konsultasi seputar pangan, ternak, dan ikan.', 'route' => 'layanan.forum'],
                ['judul' => 'Inovasi Pelayanan', 'ket' => 'Program dan terobosan pelayanan unggulan dinas.', 'route' => 'layanan.inovasi'],
                ['judul' => 'Produk Hukum', 'ket' => 'Dokumen regulasi, kebijakan, dan peraturan.', 'route' => 'galeri.produk-hukum'],
                ['judul' => 'Alur & SOP', 'ket' => 'Panduan prosedur layanan yang jelas dan terstandar.', 'route' => 'alur-sop'],
            ] as $i => $layanan)
                <a
                    href="{{ route($layanan['route']) }}"
                    data-reveal data-delay="{{ ($i % 3) + 1 }}"
                    class="group relative overflow-hidden rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-hijau-300 hover:shadow-xl hover:shadow-hijau-900/10"
                >
                    <span class="grid h-12 w-12 place-items-center rounded-xl bg-hijau-50 text-hijau-600 transition group-hover:bg-hijau-600 group-hover:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </span>
                    <h3 class="mt-5 text-lg font-bold text-slate-800 transition group-hover:text-hijau-700">{{ $layanan['judul'] }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-slate-500">{{ $layanan['ket'] }}</p>
                </a>
            @endforeach
        </div>
    </section>
@endsection
