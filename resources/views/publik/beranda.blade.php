@extends('publik.layout')

@section('judul', 'Beranda')

@section('konten')
    {{-- ================= HERO ================= --}}
    <section class="gradasi-hero relative isolate overflow-hidden">
        <div class="pola-titik absolute inset-0 opacity-30"></div>
        <div class="animasi-mengambang-lambat absolute -left-32 top-10 h-96 w-96 rounded-full bg-hijau-400/20 blur-3xl" aria-hidden="true"></div>
        <div class="animasi-mengambang absolute -right-24 bottom-0 h-[26rem] w-[26rem] rounded-full bg-sage-500/20 blur-3xl" aria-hidden="true"></div>
        <div class="absolute left-1/2 top-0 h-40 w-[42rem] -translate-x-1/2 rounded-full bg-moss-500/10 blur-3xl" aria-hidden="true"></div>

        <div class="relative mx-auto grid max-w-7xl items-center gap-10 px-4 pb-20 pt-14 md:px-6 md:pt-16 lg:grid-cols-[1.05fr_0.95fr] lg:gap-14 lg:pb-28 lg:pt-20">
            <div class="text-white">
                <span class="animasi-naik inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-1.5 text-[11.5px] font-bold uppercase tracking-[0.12em] text-hijau-100 backdrop-blur">
                    <span class="h-1.5 w-1.5 rounded-full bg-emas-400 animasi-denyut"></span>
                    Layanan Digital Terpadu
                </span>

                <h1 class="animasi-naik mt-6 text-[2.15rem] font-extrabold leading-[1.12] tracking-tight md:text-5xl lg:text-[3.05rem] xl:text-[3.35rem]" style="animation-delay: .08s">
                    Dinas Ketahanan Pangan,
                    <span class="teks-gradasi-terang">Peternakan &amp; Perikanan</span>
                    Kabupaten Jember
                </h1>

                <p class="animasi-naik mt-5 max-w-xl text-[15.5px] leading-relaxed text-hijau-100/80" style="animation-delay: .16s">
                    Mewujudkan kemandirian pangan, kesejahteraan peternak dan nelayan, serta pelayanan publik Kabupaten Jember yang transparan dan akuntabel.
                </p>

                <div class="animasi-naik mt-9 flex flex-wrap gap-3" style="animation-delay: .24s">
                    <a href="{{ route('pgdn.form') }}" class="kilau group inline-flex items-center gap-2.5 rounded-2xl bg-white px-6 py-3.5 text-sm font-bold text-hijau-800 shadow-xl shadow-ink-950/25 transition duration-300 hover:-translate-y-1 hover:bg-hijau-50">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10.5h8m-8 3h5m-9 5.25V6.75A2.25 2.25 0 016.25 4.5h11.5A2.25 2.25 0 0120 6.75v7.5a2.25 2.25 0 01-2.25 2.25H8.5L4 20.25z"/></svg>
                        Buat Pengaduan
                    </a>
                    <a href="{{ route('profil.sambutan') }}" class="group inline-flex items-center gap-2 rounded-2xl border border-white/25 px-6 py-3.5 text-sm font-semibold text-white backdrop-blur transition duration-300 hover:-translate-y-1 hover:border-white/40 hover:bg-white/10">
                        Tentang Kami
                        <svg class="h-4 w-4 transition group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </a>
                </div>

                <dl class="animasi-naik mt-10 grid max-w-lg grid-cols-3 gap-4 border-t border-white/10 pt-7" style="animation-delay: .32s">
                    @foreach ([
                        ['nilai' => $stat['berita'], 'label' => 'Berita & Kegiatan'],
                        ['nilai' => $stat['artikel'], 'label' => 'Artikel & Jurnal'],
                        ['nilai' => $stat['sop'], 'label' => 'Dokumen SOP'],
                    ] as $s)
                        <div>
                            <dt class="text-2xl font-extrabold text-white md:text-3xl">{{ $s['nilai'] }}</dt>
                            <dd class="mt-0.5 text-[11.5px] font-medium leading-snug text-hijau-200/80">{{ $s['label'] }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>

            {{-- kartu slide bidang --}}
            <div class="relative" data-reveal="kanan" data-delay="2">
                <div class="absolute -inset-4 rounded-[2rem] bg-gradient-to-br from-white/10 to-transparent blur-xl" aria-hidden="true"></div>
                <div class="relative rounded-[1.75rem] border border-white/15 bg-white/[0.07] p-3 backdrop-blur-md md:p-4">
                    <div class="mb-3 flex items-center justify-between px-1">
                        <span class="text-[11px] font-bold uppercase tracking-[0.14em] text-hijau-200">Sorotan Bidang</span>
                        <span class="flex gap-1">
                            <span class="h-1.5 w-1.5 rounded-full bg-hijau-400"></span>
                            <span class="h-1.5 w-1.5 rounded-full bg-sage-400"></span>
                            <span class="h-1.5 w-1.5 rounded-full bg-moss-400"></span>
                        </span>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        @foreach ($dtBdg as $i => $b)
                            <x-bidang-slide :bdg="$b['bdg']" :slide="$b['slide']" :aksen="['hijau', 'sage', 'moss', 'emas'][$i % 4]" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= STATISTIK ================= --}}
    <section class="relative z-10 mx-auto -mt-10 max-w-7xl px-4 md:px-6 lg:-mt-14">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4" data-reveal>
            @foreach ([
                ['angka' => '5', 'label' => 'UPTD Pelayanan', 'ikon' => 'M13.5 21v-7.5A.75.75 0 0114.25 12h.75V4.5H3v16.5h10.5z', 'warna' => 'from-hijau-500 to-hijau-600'],
                ['angka' => (string) $stat['bidang'], 'label' => 'Bidang Teknis', 'ikon' => 'M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6z', 'warna' => 'from-sage-500 to-moss-600'],
                ['angka' => '24/7', 'label' => 'Pengaduan Online', 'ikon' => 'M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z', 'warna' => 'from-moss-500 to-sage-600'],
                ['angka' => '100%', 'label' => 'Transparan', 'ikon' => 'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'warna' => 'from-emas-400 to-emas-600'],
            ] as $i => $s)
                <div class="kartu kartu-angkat group flex items-center gap-4 p-5" data-reveal data-delay="{{ $i + 1 }}">
                    <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-gradient-to-br {{ $s['warna'] }} text-white shadow-md transition duration-500 group-hover:rotate-6 group-hover:scale-110">
                        <svg class="h-5.5 w-5.5" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $s['ikon'] }}"/></svg>
                    </span>
                    <span>
                        <span class="block text-2xl font-extrabold leading-none text-ink-800">{{ $s['angka'] }}</span>
                        <span class="mt-1 block text-[12.5px] font-medium text-ink-400">{{ $s['label'] }}</span>
                    </span>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ================= LAYANAN ================= --}}
    <section class="gradasi-lembut relative overflow-hidden py-20">
        <div class="mx-auto max-w-7xl px-4 md:px-6">
            <div class="mx-auto max-w-2xl text-center" data-reveal>
                <span class="inline-flex items-center gap-2 rounded-full border border-hijau-200 bg-white px-3.5 py-1.5 text-[11px] font-bold uppercase tracking-[0.14em] text-hijau-700 shadow-sm">
                    <span class="h-1.5 w-1.5 rounded-full bg-hijau-500"></span>
                    Layanan Kami
                </span>
                <h2 class="mt-4 text-3xl font-extrabold tracking-tight text-ink-900 md:text-[2.5rem]">
                    Akses Cepat <span class="teks-gradasi">Pelayanan</span>
                </h2>
                <p class="mt-3 text-[15px] leading-relaxed text-ink-500">Berbagai layanan informasi dan pengaduan yang dapat Anda akses secara daring, kapan saja.</p>
            </div>

            <div class="mt-14 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                @foreach ([
                    ['judul' => 'Pengaduan Online', 'ket' => 'Sampaikan keluhan & dapatkan nomor tiket yang bisa dilacak.', 'route' => 'pgdn.form', 'warna' => 'hijau', 'ikon' => 'M8 10.5h8m-8 3h5m-9 5.25V6.75A2.25 2.25 0 016.25 4.5h11.5A2.25 2.25 0 0120 6.75v7.5a2.25 2.25 0 01-2.25 2.25H8.5L4 20.25z'],
                    ['judul' => 'Berita PPID', 'ket' => 'Informasi publik terbaru seputar kegiatan dinas.', 'route' => 'layanan.berita', 'warna' => 'sage', 'ikon' => 'M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z'],
                    ['judul' => 'Forum Konsultasi', 'ket' => 'Diskusi & konsultasi seputar pangan, ternak, dan ikan.', 'route' => 'layanan.forum', 'warna' => 'moss', 'ikon' => 'M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155'],
                    ['judul' => 'Inovasi Pelayanan', 'ket' => 'Program dan terobosan pelayanan unggulan dinas.', 'route' => 'layanan.inovasi', 'warna' => 'emas', 'ikon' => 'M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.493 1.509 1.333 1.509 2.316V18'],
                    ['judul' => 'Produk Hukum', 'ket' => 'Dokumen regulasi, kebijakan, dan peraturan.', 'route' => 'galeri.produk-hukum', 'warna' => 'moss', 'ikon' => 'M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25'],
                    ['judul' => 'Alur & SOP', 'ket' => 'Panduan prosedur layanan yang jelas dan terstandar.', 'route' => 'alur-sop', 'warna' => 'emas', 'ikon' => 'M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z'],
                ] as $i => $l)
                    @php
                        $gaya = match ($l['warna']) {
                            'sage' => ['bg' => 'from-sage-100 to-sage-50', 'teks' => 'text-sage-600', 'hover' => 'group-hover:from-sage-500 group-hover:to-moss-500', 'garis' => 'from-sage-400 to-moss-400'],
                            'moss' => ['bg' => 'from-moss-100 to-moss-50', 'teks' => 'text-moss-600', 'hover' => 'group-hover:from-moss-500 group-hover:to-sage-500', 'garis' => 'from-moss-400 to-sage-400'],
                            'emas' => ['bg' => 'from-emas-100 to-emas-50', 'teks' => 'text-emas-600', 'hover' => 'group-hover:from-emas-400 group-hover:to-moss-400', 'garis' => 'from-emas-400 to-moss-400'],
                            default => ['bg' => 'from-hijau-100 to-hijau-50', 'teks' => 'text-hijau-600', 'hover' => 'group-hover:from-hijau-500 group-hover:to-sage-500', 'garis' => 'from-hijau-400 to-sage-400'],
                        };
                    @endphp
                    <a
                        href="{{ route($l['route']) }}"
                        data-reveal data-delay="{{ ($i % 3) + 1 }}"
                        class="kartu kartu-angkat group relative flex flex-col overflow-hidden p-6"
                    >
                        <span class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r {{ $gaya['garis'] }} opacity-0 transition duration-500 group-hover:opacity-100"></span>
                        <span class="grid h-12 w-12 place-items-center rounded-2xl bg-gradient-to-br {{ $gaya['bg'] }} {{ $gaya['teks'] }} transition duration-500 {{ $gaya['hover'] }} group-hover:scale-110 group-hover:text-white group-hover:shadow-lg">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $l['ikon'] }}"/></svg>
                        </span>
                        <h3 class="mt-5 text-lg font-bold text-ink-800 transition group-hover:text-hijau-700">{{ $l['judul'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-ink-500">{{ $l['ket'] }}</p>
                        <span class="mt-auto inline-flex items-center gap-1.5 pt-5 text-[13px] font-semibold text-ink-400 transition group-hover:text-hijau-600">
                            Buka
                            <svg class="h-3.5 w-3.5 transition group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= KEGIATAN ================= --}}
    @if ($dtBerita->count())
        <section class="mx-auto max-w-7xl px-4 py-24 md:px-6">
            <div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between" data-reveal>
                <div>
                    <span class="inline-flex items-center gap-2 rounded-full border border-sage-200 bg-sage-50 px-3.5 py-1.5 text-[11px] font-bold uppercase tracking-[0.14em] text-sage-700">
                        <span class="h-1.5 w-1.5 rounded-full bg-sage-500"></span>
                        Kabar Terbaru
                    </span>
                    <h2 class="mt-4 text-3xl font-extrabold tracking-tight text-ink-900 md:text-[2.4rem]">Kegiatan &amp; Informasi</h2>
                    <p class="mt-2 max-w-xl text-[15px] text-ink-500">Dokumentasi kegiatan dan pengumuman resmi dinas.</p>
                </div>
                <a href="{{ route('layanan.kegiatan') }}" class="inline-flex shrink-0 items-center gap-2 rounded-xl border border-ink-200 px-4 py-2.5 text-sm font-semibold text-ink-600 transition hover:border-hijau-300 hover:bg-hijau-50 hover:text-hijau-700">
                    Lihat Semua
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                </a>
            </div>

            <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($dtBerita as $i => $brt)
                    <x-kartu-konten
                        :url="route('layanan.berita.detail', $brt)"
                        :judul="$brt->judul"
                        :ringkasan="$brt->ringkasan"
                        :gambar="$brt->gambar"
                        :tgl="$brt->tgl_terbit"
                        label="Kegiatan"
                        :warna="['hijau', 'sage', 'moss'][$i % 3]"
                        data-reveal
                        data-delay="{{ $i + 1 }}"
                    />
                @endforeach
            </div>
        </section>
    @endif

    {{-- ================= ARTIKEL ================= --}}
    @if ($dtArtikel->count())
        <section class="relative overflow-hidden bg-ink-950 py-24">
            <div class="pola-titik absolute inset-0 opacity-15"></div>
            <div class="absolute -left-24 top-10 h-72 w-72 rounded-full bg-hijau-600/20 blur-3xl"></div>
            <div class="absolute -right-20 bottom-0 h-80 w-80 rounded-full bg-moss-600/15 blur-3xl"></div>

            <div class="relative mx-auto max-w-7xl px-4 md:px-6">
                <div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between" data-reveal>
                    <div>
                        <span class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/5 px-3.5 py-1.5 text-[11px] font-bold uppercase tracking-[0.14em] text-hijau-200 backdrop-blur">
                            <span class="h-1.5 w-1.5 rounded-full bg-emas-400"></span>
                            Wawasan
                        </span>
                        <h2 class="mt-4 text-3xl font-extrabold tracking-tight text-white md:text-[2.4rem]">Artikel &amp; Jurnal</h2>
                        <p class="mt-2 max-w-xl text-[15px] text-hijau-100/60">Kajian dan tulisan seputar pangan, peternakan, dan perikanan.</p>
                    </div>
                    <a href="{{ route('layanan.artikel') }}" class="inline-flex shrink-0 items-center gap-2 rounded-xl border border-white/15 px-4 py-2.5 text-sm font-semibold text-white transition hover:border-white/30 hover:bg-white/10">
                        Lihat Semua
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </a>
                </div>

                <div class="mt-10 grid gap-5 md:grid-cols-3">
                    @foreach ($dtArtikel as $i => $art)
                        <a
                            href="{{ route('layanan.artikel.detail', $art) }}"
                            data-reveal data-delay="{{ $i + 1 }}"
                            class="group relative flex flex-col overflow-hidden rounded-2xl border border-white/10 bg-white/[0.04] p-6 backdrop-blur transition duration-500 hover:-translate-y-1.5 hover:border-white/25 hover:bg-white/[0.08]"
                        >
                            <span class="mb-4 inline-flex w-fit items-center gap-1.5 rounded-full bg-white/10 px-2.5 py-1 text-[10.5px] font-bold uppercase tracking-wide text-hijau-200">
                                {{ $art->jenis === 'jurnal' ? 'Jurnal' : 'Artikel' }}
                            </span>
                            <h3 class="line-clamp-2 text-[17px] font-bold leading-snug text-white transition group-hover:text-hijau-200">{{ $art->judul }}</h3>
                            @if ($art->ringkasan)
                                <p class="mt-2.5 line-clamp-3 text-[13.5px] leading-relaxed text-hijau-100/55">{{ $art->ringkasan }}</p>
                            @endif
                            <span class="mt-auto flex items-center justify-between gap-3 pt-6 text-[11.5px] text-hijau-100/40">
                                <span>{{ $art->tgl_terbit?->translatedFormat('d M Y') }}</span>
                                <span class="grid h-7 w-7 place-items-center rounded-full bg-white/10 text-white transition group-hover:bg-hijau-500">
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                                </span>
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ================= VIDEO ================= --}}
    @if ($dtVid->count())
        <section class="mx-auto max-w-7xl px-4 py-24 md:px-6">
            <div class="mx-auto max-w-2xl text-center" data-reveal>
                <span class="inline-flex items-center gap-2 rounded-full border border-moss-200 bg-moss-50 px-3.5 py-1.5 text-[11px] font-bold uppercase tracking-[0.14em] text-moss-600">
                    <span class="h-1.5 w-1.5 rounded-full bg-moss-500"></span>
                    Galeri
                </span>
                <h2 class="mt-4 text-3xl font-extrabold tracking-tight text-ink-900 md:text-[2.4rem]">Video Kegiatan</h2>
                <p class="mt-3 text-[15px] text-ink-500">Dokumentasi kegiatan dinas dalam kanal YouTube resmi.</p>
            </div>

            <div
                x-data="{ buka: false, embed: '', judul: '' }"
                class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3"
            >
                @foreach ($dtVid as $i => $vid)
                    <button
                        @click="embed = @js($vid->embedUrl()); judul = @js($vid->judul); buka = true"
                        data-reveal data-delay="{{ $i + 1 }}"
                        class="kartu kartu-angkat group overflow-hidden text-left"
                    >
                        <div class="relative aspect-video overflow-hidden bg-ink-900">
                            @if ($vid->thumbUrl())
                                <img src="{{ $vid->thumbUrl() }}" alt="{{ $vid->judul }}" loading="lazy" class="h-full w-full object-cover opacity-90 transition duration-700 group-hover:scale-105 group-hover:opacity-100">
                            @endif
                            <span class="absolute inset-0 bg-gradient-to-t from-ink-950/50 to-transparent"></span>
                            <span class="absolute inset-0 grid place-items-center">
                                <span class="grid h-16 w-16 place-items-center rounded-full bg-white/95 text-hijau-600 shadow-xl transition duration-500 group-hover:scale-110 group-hover:bg-gradient-to-br group-hover:from-hijau-500 group-hover:to-sage-500 group-hover:text-white">
                                    <svg class="ml-1 h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </span>
                            </span>
                        </div>
                        <div class="p-5">
                            <h3 class="line-clamp-2 font-bold text-ink-800 transition group-hover:text-hijau-700">{{ $vid->judul }}</h3>
                        </div>
                    </button>
                @endforeach

                <div x-show="buka" x-transition.opacity style="display:none;" class="fixed inset-0 z-[60] grid place-items-center bg-ink-950/90 p-4 backdrop-blur-sm" @click="buka = false">
                    <button @click="buka = false" class="absolute right-5 top-5 grid h-11 w-11 place-items-center rounded-full bg-white/10 text-white backdrop-blur transition hover:bg-white/25" aria-label="Tutup">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                    <div class="w-full max-w-3xl" @click.stop>
                        <div class="aspect-video overflow-hidden rounded-2xl bg-black shadow-2xl">
                            <template x-if="buka && embed">
                                <iframe :src="embed" class="h-full w-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </template>
                        </div>
                        <p class="mt-3 text-center text-sm font-medium text-white" x-text="judul"></p>
                    </div>
                </div>
            </div>

            <div class="mt-10 text-center">
                <a href="{{ route('galeri.video') }}" class="inline-flex items-center gap-2 rounded-xl border border-ink-200 bg-white px-6 py-3 text-sm font-semibold text-ink-600 shadow-sm transition hover:-translate-y-0.5 hover:border-hijau-300 hover:text-hijau-700">
                    Lihat Semua Video
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                </a>
            </div>
        </section>
    @endif

    {{-- ================= LAYANAN TERKAIT ================= --}}
    @php $dtTautan = array_filter(tautan_layanan(), fn ($t) => ! empty($t['url'])); @endphp
    @if (! empty($dtTautan))
        <section class="gradasi-lembut border-y border-hijau-100/70 py-20">
            <div class="mx-auto max-w-7xl px-4 md:px-6">
                <div class="mx-auto max-w-2xl text-center" data-reveal>
                    <span class="inline-flex items-center gap-2 rounded-full border border-hijau-200 bg-white px-3.5 py-1.5 text-[11px] font-bold uppercase tracking-[0.14em] text-hijau-700 shadow-sm">
                        <span class="h-1.5 w-1.5 rounded-full bg-hijau-500"></span>
                        Terintegrasi
                    </span>
                    <h2 class="mt-4 text-3xl font-extrabold tracking-tight text-ink-900 md:text-[2.4rem]">Layanan Terkait</h2>
                    <p class="mt-3 text-[15px] text-ink-500">Akses cepat ke portal layanan Pemerintah Kabupaten Jember.</p>
                </div>

                <div class="mt-12 grid gap-5 md:grid-cols-3">
                    @foreach ($dtTautan as $i => $tautan)
                        @php
                            $gaya = match ($i % 3) {
                                1 => ['bg' => 'from-sage-500 to-moss-500', 'teks' => 'group-hover:text-sage-700', 'cincin' => 'hover:ring-sage-100'],
                                2 => ['bg' => 'from-moss-600 to-hijau-600', 'teks' => 'group-hover:text-moss-700', 'cincin' => 'hover:ring-moss-100'],
                                default => ['bg' => 'from-hijau-500 to-sage-500', 'teks' => 'group-hover:text-hijau-700', 'cincin' => 'hover:ring-hijau-100'],
                            };
                        @endphp
                        <a
                            href="{{ $tautan['url'] }}"
                            target="_blank"
                            rel="noopener"
                            data-reveal data-delay="{{ $i + 1 }}"
                            class="kartu kartu-angkat group flex items-start gap-4 p-6 ring-2 ring-transparent transition {{ $gaya['cincin'] }}"
                        >
                            <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-gradient-to-br {{ $gaya['bg'] }} text-white shadow-md transition duration-500 group-hover:scale-110 group-hover:rotate-6">
                                <svg class="h-5.5 w-5.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                            </span>
                            <span class="min-w-0">
                                <span class="block font-bold text-ink-800 transition {{ $gaya['teks'] }}">{{ $tautan['judul'] }}</span>
                                <span class="mt-1 block text-sm text-ink-500">{{ $tautan['ket'] }}</span>
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
