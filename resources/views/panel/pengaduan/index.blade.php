@extends('panel.layout')

@section('judul', 'Daftar Pengaduan')

@section('konten')
    @php
        $warnaSts = [
            'baru' => 'bg-ink-100 text-ink-600',
            'verif' => 'bg-sage-100 text-sage-700',
            'tolak' => 'bg-red-100 text-red-600',
            'dsps' => 'bg-moss-100 text-moss-700',
            'proses' => 'bg-emas-100 text-emas-700',
            'selesai' => 'bg-hijau-100 text-hijau-700',
        ];
        $dtKat = ['Ketahanan Pangan', 'Peternakan', 'Perikanan', 'Kesehatan Hewan', 'Umum'];
    @endphp

    {{-- filter --}}
    <form method="GET" class="mb-5 flex flex-wrap items-center gap-3 rounded-2xl border border-hijau-100 bg-white p-4 shadow-sm">
        <div class="relative flex-1 min-w-[200px]">
            <svg class="pointer-events-none absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-ink-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
            <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari kode tiket / judul / pelapor..." class="w-full rounded-xl border border-hijau-200 bg-white py-2.5 pl-10 pr-4 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
        </div>
        <select name="sts" class="rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
            <option value="">Semua Status</option>
            @foreach (['baru'=>'Baru','verif'=>'Terverifikasi','dsps'=>'Didisposisi','proses'=>'Diproses','selesai'=>'Selesai','tolak'=>'Ditolak'] as $k=>$v)
                <option value="{{ $k }}" @selected($filterSts===$k)>{{ $v }}</option>
            @endforeach
        </select>
        <select name="kat" class="rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
            <option value="">Semua Kategori</option>
            @foreach ($dtKat as $kat)
                <option value="{{ $kat }}" @selected($filterKat===$kat)>{{ $kat }}</option>
            @endforeach
        </select>
        <button class="rounded-xl bg-hijau-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-hijau-700">Filter</button>
    </form>

    {{-- tabel --}}
    <div class="overflow-hidden rounded-2xl border border-hijau-100 bg-white shadow-sm">
        @if ($dtPgdn->count())
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="border-b border-hijau-100 bg-hijau-50/50 text-xs uppercase tracking-wide text-hijau-700">
                        <tr>
                            <th class="px-5 py-3">Kode Tiket</th>
                            <th class="px-5 py-3">Pengaduan</th>
                            <th class="px-5 py-3">Kategori</th>
                            <th class="px-5 py-3">Status</th>
                            <th class="px-5 py-3">Tanggal</th>
                            <th class="px-5 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-hijau-50">
                        @foreach ($dtPgdn as $pgdn)
                            <tr class="transition hover:bg-hijau-50/40">
                                <td class="px-5 py-3">
                                    <span class="font-semibold text-hijau-700">{{ $pgdn->kd_tkt }}</span>
                                    @if ($pgdn->darurat)
                                        <span class="ml-1 rounded bg-red-100 px-1.5 py-0.5 text-[10px] font-bold text-red-600">DARURAT</span>
                                    @endif
                                </td>
                                <td class="px-5 py-3">
                                    <p class="line-clamp-1 font-medium text-ink-700">{{ $pgdn->judul }}</p>
                                    <p class="text-xs text-ink-400">{{ $pgdn->nama_pelapor }}</p>
                                </td>
                                <td class="px-5 py-3 text-ink-600">{{ $pgdn->kat }}</td>
                                <td class="px-5 py-3">
                                    <span class="rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $warnaSts[$pgdn->sts] ?? 'bg-ink-100' }}">{{ $pgdn->labelSts() }}</span>
                                    @if ($pgdn->slaLewat())
                                        <span class="ml-1 rounded-full bg-red-100 px-2 py-0.5 text-[10px] font-bold text-red-600">SLA lewat</span>
                                    @endif
                                </td>
                                <td class="px-5 py-3 text-xs text-ink-400">{{ $pgdn->created_at->translatedFormat('d M Y') }}</td>
                                <td class="px-5 py-3 text-right">
                                    <a href="{{ route('panel.pengaduan.show', $pgdn) }}" class="inline-flex items-center gap-1 rounded-lg bg-hijau-50 px-3 py-1.5 text-xs font-semibold text-hijau-700 transition hover:bg-hijau-100">
                                        Detail
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="border-t border-hijau-50 px-5 py-4">{{ $dtPgdn->links() }}</div>
        @else
            <div class="px-5 py-16 text-center text-sm text-ink-400">Tidak ada pengaduan yang cocok dengan filter.</div>
        @endif
    </div>
@endsection
