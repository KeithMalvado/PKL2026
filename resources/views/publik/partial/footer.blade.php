@php
    $daftarTautan = array_filter(tautan_layanan(), fn ($t) => ! empty($t['url']));
@endphp

<footer class="relative overflow-hidden bg-ink-950 text-hijau-100">
    <div class="pola-titik absolute inset-0 opacity-20"></div>
    <div class="absolute -left-24 top-0 h-72 w-72 rounded-full bg-hijau-600/20 blur-3xl"></div>
    <div class="absolute -right-20 bottom-10 h-80 w-80 rounded-full bg-sage-600/15 blur-3xl"></div>

    {{-- cta pengaduan --}}
    <div class="relative border-b border-white/10">
        <div class="mx-auto max-w-7xl px-4 py-12 md:px-6">
            <div class="relative overflow-hidden rounded-3xl border border-white/10 bg-gradient-to-r from-hijau-700/70 via-hijau-800/50 to-sage-700/50 px-6 py-8 backdrop-blur-md md:px-10">
                <div class="pola-titik absolute inset-0 opacity-20"></div>
                <div class="animasi-mengambang-lambat absolute -right-10 -top-16 h-52 w-52 rounded-full bg-sage-400/20 blur-3xl"></div>
                <div class="relative flex flex-col items-center justify-between gap-6 text-center md:flex-row md:text-left">
                    <div>
                        <h3 class="text-xl font-extrabold text-white md:text-2xl">Punya keluhan atau aspirasi?</h3>
                        <p class="mt-1.5 max-w-lg text-sm leading-relaxed text-hijau-100/80">Sampaikan pengaduan Anda secara online. Mudah, cepat, dan dapat dilacak kapan saja.</p>
                    </div>
                    <div class="flex flex-wrap items-center justify-center gap-3">
                        <a
                            href="{{ route('pgdn.form') }}"
                            class="kilau inline-flex items-center gap-2 rounded-xl bg-white px-6 py-3 text-sm font-semibold text-hijau-800 shadow-lg transition hover:-translate-y-0.5 hover:bg-hijau-50"
                        >
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10.5h8m-8 3h5m-9 5.25V6.75A2.25 2.25 0 016.25 4.5h11.5A2.25 2.25 0 0120 6.75v7.5a2.25 2.25 0 01-2.25 2.25H8.5L4 20.25z"/></svg>
                            Buat Pengaduan
                        </a>
                        <a href="{{ route('pgdn.lacak') }}" class="inline-flex items-center gap-2 rounded-xl border border-white/25 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10">
                            Lacak Tiket
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- konten utama footer --}}
    <div class="relative mx-auto grid max-w-7xl gap-10 px-4 py-14 md:grid-cols-2 md:px-6 lg:grid-cols-4 lg:gap-12">
        {{-- identitas --}}
        <div class="lg:col-span-1">
            <div class="flex items-center gap-3">
                <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl border border-white/15 bg-white/10 p-1.5 backdrop-blur">
                    <img src="{{ logo_situs() }}" alt="Logo DKPP Kabupaten Jember" class="h-full w-full object-contain">
                </span>
                <span class="leading-tight">
                    <span class="block text-sm font-extrabold tracking-tight text-white">DKPP JEMBER</span>
                    <span class="block text-[11px] text-hijau-300">Kabupaten Jember</span>
                </span>
            </div>
            <p class="mt-4 text-sm leading-relaxed text-hijau-100/70">
                Dinas Ketahanan Pangan, Peternakan, dan Perikanan Kabupaten Jember. Mewujudkan kemandirian pangan dan kesejahteraan peternak serta nelayan.
            </p>
            <div class="mt-5 flex flex-wrap gap-2">
                @if (wa_kantor())
                    <a href="https://wa.me/{{ wa_kantor() }}" target="_blank" rel="noopener" class="grid h-9 w-9 place-items-center rounded-xl border border-white/10 bg-white/5 text-hijau-200 transition hover:-translate-y-0.5 hover:border-hijau-400/40 hover:bg-hijau-600/20 hover:text-white" aria-label="WhatsApp">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                    </a>
                @endif
                @if (setelan('kontak.email'))
                    <a href="mailto:{{ setelan('kontak.email') }}" class="grid h-9 w-9 place-items-center rounded-xl border border-white/10 bg-white/5 text-hijau-200 transition hover:-translate-y-0.5 hover:border-sage-400/40 hover:bg-sage-600/20 hover:text-white" aria-label="Email">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                    </a>
                @endif
                @if (telp_kantor())
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', telp_kantor()) }}" class="grid h-9 w-9 place-items-center rounded-xl border border-white/10 bg-white/5 text-hijau-200 transition hover:-translate-y-0.5 hover:border-emas-400/40 hover:bg-emas-500/20 hover:text-white" aria-label="Telepon">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                    </a>
                @endif
            </div>
        </div>

        {{-- tautan cepat --}}
        <div>
            <h4 class="mb-4 flex items-center gap-2 text-[12px] font-bold uppercase tracking-[0.14em] text-white">
                <span class="h-1.5 w-1.5 rounded-full bg-hijau-400"></span>
                Tautan Cepat
            </h4>
            <ul class="space-y-2.5 text-sm">
                @foreach ([
                    ['Beranda', route('beranda')],
                    ['Sambutan Kadis', route('profil.sambutan')],
                    ['Struktur Organisasi', route('profil.struktur')],
                    ['Alur & SOP', route('alur-sop')],
                    ['Lacak Pengaduan', route('pgdn.lacak')],
                ] as [$label, $url])
                    <li>
                        <a href="{{ $url }}" class="group inline-flex items-center gap-2 text-hijau-100/70 transition hover:text-white">
                            <span class="h-px w-0 bg-hijau-400 transition-all duration-300 group-hover:w-3"></span>
                            {{ $label }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- layanan --}}
        <div>
            <h4 class="mb-4 flex items-center gap-2 text-[12px] font-bold uppercase tracking-[0.14em] text-white">
                <span class="h-1.5 w-1.5 rounded-full bg-sage-400"></span>
                Layanan
            </h4>
            <ul class="space-y-2.5 text-sm">
                @foreach ([
                    ['Berita PPID', route('layanan.berita')],
                    ['Info Kegiatan', route('layanan.kegiatan')],
                    ['Forum Konsultasi', route('layanan.forum')],
                    ['Inovasi Pelayanan', route('layanan.inovasi')],
                    ['Produk Hukum', route('galeri.produk-hukum')],
                ] as [$label, $url])
                    <li>
                        <a href="{{ $url }}" class="group inline-flex items-center gap-2 text-hijau-100/70 transition hover:text-white">
                            <span class="h-px w-0 bg-sage-400 transition-all duration-300 group-hover:w-3"></span>
                            {{ $label }}
                        </a>
                    </li>
                @endforeach
                @foreach ($daftarTautan as $tautan)
                    <li>
                        <a href="{{ $tautan['url'] }}" target="_blank" rel="noopener" class="group inline-flex items-center gap-2 text-hijau-100/70 transition hover:text-white">
                            <span class="h-px w-0 bg-sage-400 transition-all duration-300 group-hover:w-3"></span>
                            {{ $tautan['judul'] }}
                            <svg class="h-3 w-3 opacity-50" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- kontak --}}
        <div>
            <h4 class="mb-4 flex items-center gap-2 text-[12px] font-bold uppercase tracking-[0.14em] text-white">
                <span class="h-1.5 w-1.5 rounded-full bg-emas-400"></span>
                Kontak Center
            </h4>
            <ul class="space-y-3.5 text-sm text-hijau-100/70">
                @if (setelan('kontak.alamat'))
                    <li class="flex gap-3">
                        <span class="grid h-8 w-8 shrink-0 place-items-center rounded-lg bg-white/5 text-hijau-300">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                        </span>
                        <span class="leading-relaxed">{{ setelan('kontak.alamat') }}</span>
                    </li>
                @endif
                @if (telp_kantor())
                    <li class="flex gap-3">
                        <span class="grid h-8 w-8 shrink-0 place-items-center rounded-lg bg-white/5 text-hijau-300">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                        </span>
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', telp_kantor()) }}" class="self-center transition hover:text-white">{{ telp_kantor() }}</a>
                    </li>
                @endif
                @if (wa_kantor())
                    <li class="flex gap-3">
                        <span class="grid h-8 w-8 shrink-0 place-items-center rounded-lg bg-white/5 text-hijau-300">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                        </span>
                        <a href="https://wa.me/{{ wa_kantor() }}" target="_blank" rel="noopener" class="self-center transition hover:text-white">WhatsApp {{ wa_tampil() }}</a>
                    </li>
                @endif
                @if (setelan('kontak.email'))
                    <li class="flex gap-3">
                        <span class="grid h-8 w-8 shrink-0 place-items-center rounded-lg bg-white/5 text-hijau-300">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                        </span>
                        <a href="mailto:{{ setelan('kontak.email') }}" class="self-center break-all transition hover:text-white">{{ setelan('kontak.email') }}</a>
                    </li>
                @endif
                @if (setelan('kontak.jam'))
                    <li class="flex gap-3">
                        <span class="grid h-8 w-8 shrink-0 place-items-center rounded-lg bg-white/5 text-hijau-300">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                        <span class="self-center">{{ setelan('kontak.jam') }}</span>
                    </li>
                @endif
            </ul>
        </div>
    </div>

    {{-- bar bawah --}}
    <div class="relative border-t border-white/10">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-2 px-4 py-5 text-xs text-hijau-100/50 md:px-6 sm:flex-row">
            <p>&copy; {{ date('Y') }} DKPP Kabupaten Jember. Hak cipta dilindungi.</p>
            <p class="flex items-center gap-2">
                <span class="h-1 w-1 rounded-full bg-hijau-400"></span>
                Mewujudkan Pelayanan Publik yang Transparan &amp; Akuntabel
            </p>
        </div>
    </div>
</footer>
