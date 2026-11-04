@extends('publik.layout')

@section('judul', 'Lacak Status Pengaduan')

@php
    // definisi urutan tahap utk timeline
    $tahapan = [
        'baru' => 'Pengaduan Diterima',
        'verif' => 'Terverifikasi',
        'dsps' => 'Didisposisi ke Bidang',
        'proses' => 'Sedang Ditindaklanjuti',
        'selesai' => 'Selesai',
    ];
    $urutan = array_keys($tahapan);
@endphp

@section('konten')
    <x-hero-halaman judul="Lacak Status Pengaduan" />

    <section class="mx-auto max-w-3xl px-4 py-14">
        {{-- form pencarian --}}
        <form method="POST" action="{{ route('pgdn.cek-status') }}" class="rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm" data-reveal>
            @csrf
            <h2 class="text-lg font-bold text-hijau-800">Masukkan Data Pengaduan</h2>
            <p class="mt-1 text-sm text-slate-500">Lacak perkembangan laporan Anda dengan kode tiket dan nomor WhatsApp yang didaftarkan.</p>
            <div class="mt-5 grid gap-4 sm:grid-cols-2">
                <div>
                    <label class="mb-1 block text-sm font-medium text-slate-700">Kode Tiket <span class="text-red-500">*</span></label>
                    <input type="text" name="kd_tkt" value="{{ old('kd_tkt') }}" placeholder="PGDN-xxxxxxxx-xxxx" required class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                    @error('kd_tkt')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-slate-700">No. WhatsApp <span class="text-red-500">*</span></label>
                    <input type="text" name="no_telp" value="{{ old('no_telp') }}" placeholder="08xxxxxxxxxx" required class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                    @error('no_telp')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
            </div>
            <button class="mt-5 rounded-xl bg-hijau-600 px-8 py-3 text-sm font-semibold text-white transition hover:bg-hijau-700">Lacak Sekarang</button>
        </form>

        {{-- hasil --}}
        @if ($dicari)
            @if ($pgdn)
                <div class="mt-8 overflow-hidden rounded-2xl border border-hijau-100 bg-white shadow-sm" data-reveal>
                    {{-- header tiket --}}
                    <div class="flex flex-wrap items-center justify-between gap-3 border-b border-hijau-100 bg-hijau-50/50 px-6 py-4">
                        <div>
                            <p class="text-xs text-slate-400">Kode Tiket</p>
                            <p class="font-bold text-hijau-700">{{ $pgdn->kd_tkt }}</p>
                        </div>
                        @php
                            $warna = match($pgdn->sts) {
                                'selesai' => 'bg-hijau-100 text-hijau-700',
                                'tolak' => 'bg-red-100 text-red-600',
                                'proses', 'dsps' => 'bg-amber-100 text-amber-700',
                                default => 'bg-slate-100 text-slate-600',
                            };
                        @endphp
                        <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $warna }}">{{ $pgdn->labelSts() }}</span>
                    </div>

                    <div class="p-6">
                        {{-- ringkasan --}}
                        <h3 class="font-bold text-slate-800">{{ $pgdn->judul }}</h3>
                        <div class="mt-1 flex flex-wrap gap-x-4 gap-y-1 text-xs text-slate-400">
                            <span>{{ $pgdn->kat }}</span>
                            <span>Dilaporkan {{ $pgdn->created_at->translatedFormat('d F Y, H:i') }}</span>
                            @if ($pgdn->bdg)<span>Bidang: {{ $pgdn->bdg->nama }}</span>@endif
                        </div>
                        <p class="mt-3 text-sm leading-relaxed text-slate-600">{{ $pgdn->isi }}</p>

                        @if ($pgdn->sts === 'tolak' && $pgdn->alasan_tolak)
                            <div class="mt-4 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                                <p class="font-semibold">Pengaduan Ditolak</p>
                                <p class="mt-1">{{ $pgdn->alasan_tolak }}</p>
                            </div>
                        @endif

                        {{-- timeline status --}}
                        @if ($pgdn->sts !== 'tolak')
                            <div class="mt-8">
                                <h4 class="mb-5 text-sm font-bold uppercase tracking-wide text-hijau-700">Perkembangan Status</h4>
                                @php $idxAktif = array_search($pgdn->sts, $urutan); @endphp
                                <ol class="relative ml-3 border-l-2 border-hijau-100">
                                    @foreach ($tahapan as $kode => $label)
                                        @php
                                            $idx = array_search($kode, $urutan);
                                            $lewat = $idxAktif !== false && $idx <= $idxAktif;
                                            $aktif = $kode === $pgdn->sts;
                                        @endphp
                                        <li class="relative mb-6 pl-6 last:mb-0">
                                            <span class="absolute -left-[9px] grid h-4 w-4 place-items-center rounded-full border-2 {{ $lewat ? 'border-hijau-600 bg-hijau-600' : 'border-slate-300 bg-white' }}">
                                                @if ($lewat)<svg class="h-2.5 w-2.5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="4" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>@endif
                                            </span>
                                            <p class="text-sm font-semibold {{ $lewat ? 'text-hijau-700' : 'text-slate-400' }}">{{ $label }}</p>
                                            @if ($aktif)
                                                <p class="text-xs text-slate-400">Status saat ini</p>
                                            @endif
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        @endif

                        {{-- riwayat log --}}
                        @if ($pgdn->log->count())
                            <div class="mt-8">
                                <h4 class="mb-3 text-sm font-bold uppercase tracking-wide text-hijau-700">Riwayat</h4>
                                <div class="space-y-3">
                                    @foreach ($pgdn->log as $log)
                                        <div class="flex gap-3 rounded-xl bg-slate-50 p-3 text-sm">
                                            <svg class="h-4 w-4 shrink-0 text-hijau-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            <div>
                                                <p class="font-medium text-slate-700">{{ $log->aksi }}</p>
                                                @if ($log->ket)<p class="text-xs text-slate-500">{{ $log->ket }}</p>@endif
                                                <p class="text-xs text-slate-400">{{ $log->created_at->translatedFormat('d M Y, H:i') }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="mt-8" data-reveal>
                    <x-kosong judul="Pengaduan Tidak Ditemukan" ket="Pastikan kode tiket dan nomor WhatsApp yang Anda masukkan sudah benar." />
                </div>
            @endif
        @endif
    </section>
@endsection
