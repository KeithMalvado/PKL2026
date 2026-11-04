@php
    $daftarMenu = config('navigasi.menu');
@endphp

<footer class="mt-24 bg-hijau-900 text-hijau-100">
    {{-- cta pengaduan --}}
    <div class="border-b border-hijau-800">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-6 px-4 py-10 text-center md:flex-row md:text-left">
            <div>
                <h3 class="text-xl font-bold text-white">Punya keluhan atau aspirasi?</h3>
                <p class="mt-1 text-sm text-hijau-200">Sampaikan pengaduan Anda secara online. Mudah, cepat, dan dapat dilacak.</p>
            </div>
            <a
                href="{{ route('pgdn.form') }}"
                class="inline-flex items-center gap-2 rounded-lg bg-white px-6 py-3 text-sm font-semibold text-hijau-700 shadow-lg transition hover:-translate-y-0.5 hover:bg-hijau-50"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10.5h8m-8 3h5m-9 5.25V6.75A2.25 2.25 0 016.25 4.5h11.5A2.25 2.25 0 0120 6.75v7.5a2.25 2.25 0 01-2.25 2.25H8.5L4 20.25z"/></svg>
                Buat Pengaduan
            </a>
        </div>
    </div>

    {{-- konten utama footer --}}
    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-14 md:grid-cols-2 lg:grid-cols-4">
        {{-- identitas --}}
        <div class="lg:col-span-1">
            <div class="flex items-center gap-3">
                <span class="grid h-11 w-11 place-items-center rounded-xl bg-white/10 text-white">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 100-18 9 9 0 000 18zm0 0c-2 0-3-4-3-9s1-9 3-9m0 18c2 0 3-4 3-9s-1-9-3-9M3 12h18"/></svg>
                </span>
                <span class="leading-tight">
                    <span class="block text-sm font-extrabold text-white">DKPP JEMBER</span>
                    <span class="block text-[11px] text-hijau-300">Kabupaten Jember</span>
                </span>
            </div>
            <p class="mt-4 text-sm leading-relaxed text-hijau-200">
                Dinas Ketahanan Pangan, Peternakan, dan Perikanan Kabupaten Jember. Mewujudkan kemandirian pangan dan kesejahteraan peternak serta nelayan.
            </p>
        </div>

        {{-- tautan cepat 1 --}}
        <div>
            <h4 class="mb-4 text-sm font-bold uppercase tracking-wider text-white">Tautan Cepat</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('beranda') }}" class="text-hijau-200 transition hover:text-white">Beranda</a></li>
                <li><a href="{{ route('profil.sambutan') }}" class="text-hijau-200 transition hover:text-white">Sambutan Kadis</a></li>
                <li><a href="{{ route('profil.struktur') }}" class="text-hijau-200 transition hover:text-white">Struktur Organisasi</a></li>
                <li><a href="{{ route('alur-sop') }}" class="text-hijau-200 transition hover:text-white">Alur &amp; SOP</a></li>
                <li><a href="{{ route('pgdn.lacak') }}" class="text-hijau-200 transition hover:text-white">Lacak Pengaduan</a></li>
            </ul>
        </div>

        {{-- tautan cepat 2 --}}
        <div>
            <h4 class="mb-4 text-sm font-bold uppercase tracking-wider text-white">Layanan</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('layanan.berita') }}" class="text-hijau-200 transition hover:text-white">Berita PPID</a></li>
                <li><a href="{{ route('layanan.kegiatan') }}" class="text-hijau-200 transition hover:text-white">Info Kegiatan</a></li>
                <li><a href="{{ route('layanan.forum') }}" class="text-hijau-200 transition hover:text-white">Forum Konsultasi</a></li>
                <li><a href="{{ route('layanan.inovasi') }}" class="text-hijau-200 transition hover:text-white">Inovasi Pelayanan</a></li>
                <li><a href="{{ route('galeri.produk-hukum') }}" class="text-hijau-200 transition hover:text-white">Produk Hukum</a></li>
            </ul>
        </div>

        {{-- kontak --}}
        <div>
            <h4 class="mb-4 text-sm font-bold uppercase tracking-wider text-white">Kontak</h4>
            <ul class="space-y-3 text-sm text-hijau-200">
                <li class="flex gap-3">
                    <svg class="h-5 w-5 shrink-0 text-hijau-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                    <span>Jl. Contoh Alamat No. 1, Jember, Jawa Timur</span>
                </li>
                <li class="flex gap-3">
                    <svg class="h-5 w-5 shrink-0 text-hijau-400" fill="currentColor" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                    <span>(0331) 000-000</span>
                </li>
                <li class="flex gap-3">
                    <svg class="h-5 w-5 shrink-0 text-hijau-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                    <span>info@dkpp.jemberkab.go.id</span>
                </li>
            </ul>
        </div>
    </div>

    {{-- bar bawah --}}
    <div class="border-t border-hijau-800">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-2 px-4 py-5 text-xs text-hijau-300 sm:flex-row">
            <p>&copy; {{ date('Y') }} DKPP Kabupaten Jember. Hak cipta dilindungi.</p>
            <p>Mewujudkan Pelayanan Publik yang Transparan &amp; Akuntabel</p>
        </div>
    </div>
</footer>
