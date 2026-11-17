{{-- Agenda publik DKPPP: satu sorotan untuk semua kegiatan hari ini --}}

<section id="agenda-dkppp" class="agenda-section-transisi relative overflow-hidden py-20 md:py-24">
    <div class="pointer-events-none absolute -right-28 top-0 h-80 w-80 rounded-full bg-hijau-200/30 blur-3xl" aria-hidden="true"></div>
    <div class="relative mx-auto max-w-7xl px-4 md:px-6">
        <div class="mb-10 flex flex-col gap-4 md:flex-row md:items-end md:justify-between" data-reveal>
            <div>
                <span class="inline-flex items-center gap-2 rounded-full border border-hijau-200 bg-white px-3.5 py-1.5 text-[11px] font-bold uppercase tracking-[0.14em] text-hijau-700">
                    <span class="h-1.5 w-1.5 rounded-full bg-hijau-500"></span>
                    Jadwal Kegiatan
                </span>
                <h2 class="mt-4 text-3xl font-extrabold tracking-tight text-ink-900 md:text-[2.4rem]">Agenda DKPPP</h2>
                <p class="mt-2.5 max-w-2xl text-sm leading-relaxed text-ink-500 md:text-[15px]">
                    Informasi kegiatan dari seluruh bidang DKPPP Kabupaten Jember, diurutkan berdasarkan jadwal terdekat.
                </p>
            </div>
            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl border border-hijau-200 bg-white text-hijau-700 shadow-sm" aria-hidden="true">
                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25m10.5-2.25v2.25M3.75 8.25h16.5M5.25 5.25h13.5c.828 0 1.5.672 1.5 1.5v12c0 .828-.672 1.5-1.5 1.5H5.25c-.828 0-1.5-.672-1.5-1.5v-12c0-.828.672-1.5 1.5-1.5Z" />
                </svg>
            </div>
        </div>

        @if ($agendaHariIni->isNotEmpty())
            {{-- Semua agenda hari ini berada dalam SATU sorotan, tanpa agenda prioritas. --}}
            <div x-data="{ tampilSemua: false }" class="relative overflow-hidden rounded-[28px] p-5 shadow-xl shadow-hijau-900/10 sm:p-7 md:p-9" style="background: linear-gradient(135deg, #236b49 0%, #1b5841 50%, #12392f 100%);">
                <div class="pointer-events-none absolute -right-20 -top-24 h-72 w-72 rounded-full border border-white/10" aria-hidden="true"></div>
                <div class="relative mb-6 flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <span class="inline-flex items-center rounded-full border border-white/20 bg-white/10 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.14em] text-hijau-100">Sedang dijadwalkan hari ini</span>
                        <h3 class="mt-3 text-2xl font-extrabold tracking-tight text-white sm:text-3xl">Kegiatan Hari Ini</h3>
                        <p class="mt-1.5 text-sm text-hijau-100/80">{{ now('Asia/Jakarta')->locale('id')->translatedFormat('l, d F Y') }}</p>
                    </div>
                    <div class="rounded-2xl border border-white/20 bg-white/10 px-4 py-3 text-center backdrop-blur-sm">
                        <span class="block text-2xl font-extrabold text-white">{{ $agendaHariIni->count() }}</span>
                        <span class="text-[11px] font-medium text-hijau-100">Kegiatan</span>
                    </div>
                </div>

                <div class="relative space-y-3">
                    @foreach ($agendaHariIni as $i => $agenda)
                        <article
                            @if ($i >= 4) x-show="tampilSemua" style="display: none;" @endif
                            class="rounded-2xl border border-white/15 bg-white/10 p-4 backdrop-blur-sm transition hover:border-white/30 hover:bg-white/15 sm:p-5"
                        >
                            <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:gap-5">
                                <div class="flex w-fit shrink-0 items-baseline gap-1 rounded-xl border border-white/15 bg-white/15 px-3 py-2 text-white sm:min-w-[90px] sm:flex-col sm:items-center sm:gap-0.5">
                                    <span class="text-lg font-extrabold tabular-nums">{{ substr((string) $agenda->waktu_mulai, 0, 5) }}</span>
                                    <span class="text-[10px] font-semibold tracking-wider text-hijau-100">WIB</span>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-[10px] font-bold uppercase tracking-[0.13em] text-emerald-100">
                                        {{ $agenda->bdg?->nama ?? $agenda->bdg?->nm_bdg ?? $agenda->bdg?->nama_bdg ?? $agenda->bdg?->slug ?? 'Bidang DKPPP' }}
                                    </p>
                                    <h4 class="mt-1.5 text-base font-bold leading-snug text-white sm:text-lg">{{ $agenda->judul }}</h4>
                                    @if ($agenda->uraian)
                                        <p class="mt-1.5 line-clamp-2 text-[13px] leading-relaxed text-hijau-100/80">{{ $agenda->uraian }}</p>
                                    @endif
                                    <div class="mt-3 flex flex-wrap gap-x-5 gap-y-1.5 text-[12px] text-hijau-100/85">
                                        <span>📍 {{ $agenda->lokasi }}</span>
                                        <span>
                                            🕒 {{ substr((string) $agenda->waktu_mulai, 0, 5) }}
                                            {{ $agenda->waktu_selesai ? ' – ' . substr((string) $agenda->waktu_selesai, 0, 5) : '' }}
                                            WIB
                                            {{ $agenda->keterangan_waktu ? ' · ' . $agenda->keterangan_waktu : '' }}
                                        </span>

                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if ($agendaHariIni->count() > 4)
                    <button type="button" @click="tampilSemua = !tampilSemua" class="relative mt-5 inline-flex items-center gap-2 rounded-xl border border-white/25 bg-white/10 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-white/20">
                        <span x-text="tampilSemua ? 'Tampilkan lebih sedikit' : 'Lihat {{ $agendaHariIni->count() - 4 }} kegiatan lainnya'"></span>
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                @endif
            </div>
        @elseif ($agendaHighlight)
            {{-- Jika tidak ada agenda hari ini, sorot satu jadwal terdekat secara otomatis. --}}
            <div class="relative overflow-hidden rounded-[28px] p-6 shadow-xl shadow-hijau-900/10 md:p-9" style="background: linear-gradient(135deg, #236b49 0%, #1b5841 50%, #12392f 100%);">
                <div class="relative flex flex-col gap-5 sm:flex-row sm:items-start">
                    <div class="flex h-24 w-24 shrink-0 flex-col items-center justify-center rounded-2xl bg-white text-hijau-800 shadow-md">
                        <span class="text-4xl font-extrabold leading-none">{{ $agendaHighlight->tanggal->format('d') }}</span>
                        <span class="mt-1 text-xs font-bold uppercase">{{ $agendaHighlight->tanggal->locale('id')->translatedFormat('M Y') }}</span>
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="inline-flex rounded-full bg-white/15 px-3 py-1 text-[10px] font-bold uppercase tracking-widest text-hijau-100">Agenda Terdekat</span>
                        <p class="mt-3 text-xs font-bold uppercase tracking-wider text-emerald-100">{{ $agendaHighlight->bdg?->nama ?? $agendaHighlight->bdg?->nm_bdg ?? $agendaHighlight->bdg?->nama_bdg ?? $agendaHighlight->bdg?->slug ?? 'Bidang DKPPP' }}</p>
                        <h3 class="mt-1.5 text-xl font-extrabold leading-snug text-white sm:text-2xl">{{ $agendaHighlight->judul }}</h3>
                        @if ($agendaHighlight->uraian)
                            <p class="mt-2 line-clamp-3 text-sm leading-relaxed text-hijau-100/80">{{ $agendaHighlight->uraian }}</p>
                        @endif
                        <div class="mt-4 flex flex-wrap gap-x-5 gap-y-2 text-xs text-hijau-100">
                            <span>📍 {{ $agendaHighlight->lokasi }}</span>
                            <span>🕒 {{ substr((string) $agendaHighlight->waktu_mulai, 0, 5) }}@if ($agendaHighlight->waktu_selesai)–{{ substr((string) $agendaHighlight->waktu_selesai, 0, 5) }}@endif WIB</span>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="rounded-3xl border border-hijau-200 bg-white p-8 text-center shadow-sm">
                <h3 class="text-lg font-bold text-ink-900">Belum ada agenda terjadwal</h3>
                <p class="mt-2 text-sm text-ink-500">Informasi kegiatan terbaru akan ditampilkan di sini setelah dipublikasikan oleh masing-masing bidang.</p>
            </div>
        @endif

        @if ($agendaMendatang->isNotEmpty())
            <div class="mt-10">
                <div class="mb-5 flex flex-wrap items-end justify-between gap-3">
                    <div>
                        <h3 class="text-xl font-extrabold text-ink-900 md:text-2xl">Agenda Mendatang</h3>
                        <p class="mt-1 text-sm text-ink-500">Semakin dekat tanggal kegiatan, semakin atas urutannya.</p>
                    </div>
                </div>
                <div class="space-y-3">
                    @foreach ($agendaMendatang as $agenda)
                        <article class="flex flex-col gap-4 rounded-2xl border border-hijau-100 bg-white p-4 shadow-sm transition duration-300 hover:-translate-y-0.5 hover:border-hijau-200 hover:shadow-md sm:flex-row sm:items-start sm:p-5">
                            <div class="flex w-20 shrink-0 flex-col items-center justify-center rounded-xl bg-hijau-50 p-3 text-hijau-800">
                                <span class="text-3xl font-extrabold leading-none">{{ $agenda->tanggal->format('d') }}</span>
                                <span class="mt-1 text-[10px] font-bold uppercase tracking-wide">{{ $agenda->tanggal->locale('id')->translatedFormat('M Y') }}</span>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="text-[10px] font-extrabold uppercase tracking-wider text-hijau-700">{{ $agenda->bdg?->nama ?? $agenda->bdg?->nm_bdg ?? $agenda->bdg?->nama_bdg ?? $agenda->bdg?->slug ?? 'Bidang DKPPP' }}</span>
                                    @if ($agenda->tanggal->format('Y-m-d') === now('Asia/Jakarta')->addDay()->toDateString())
                                        <span class="rounded-full bg-hijau-50 px-2.5 py-0.5 text-[10px] font-semibold text-hijau-700">Besok</span>
                                    @endif
                                </div>
                                <h4 class="mt-1 text-base font-bold text-ink-900">{{ $agenda->judul }}</h4>
                                @if ($agenda->uraian)
                                    <p class="mt-1 line-clamp-2 text-[13px] leading-relaxed text-ink-500">{{ $agenda->uraian }}</p>
                                @endif
                                <p class="mt-2 text-[12px] text-ink-500">📍 {{ $agenda->lokasi }} &nbsp; · &nbsp; 🕒 {{ substr((string) $agenda->waktu_mulai, 0, 5) }}@if ($agenda->waktu_selesai)–{{ substr((string) $agenda->waktu_selesai, 0, 5) }}@endif WIB</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
