
@extends('panel.layout')

@section('judul', 'Agenda Bulanan')

@section('konten')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-ink-900">
                Agenda Bulanan
            </h2>
            <p class="mt-1 text-sm text-ink-500">
                Kelola jadwal kegiatan yang dipublikasikan kepada masyarakat.
            </p>
        </div>

        <a href="{{ route('panel.agenda.create') }}"
           class="inline-flex items-center rounded-xl bg-hijau-700 px-5 py-3 text-sm font-semibold text-white transition hover:bg-hijau-800">
            + Tambah Agenda
        </a>
    </div>

    {{-- Notifikasi --}}
    @if (session('sukses'))
        <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
            {{ session('sukses') }}
        </div>
    @endif

    {{-- Filter --}}
    <div class="rounded-2xl border border-hijau-100 bg-white p-5 shadow-sm">
        <form method="GET"
              action="{{ route('panel.agenda.index') }}"
              class="grid gap-3 sm:grid-cols-2 lg:grid-cols-5">

            <input type="search"
                   name="q"
                   value="{{ request('q') }}"
                   placeholder="Cari judul atau lokasi..."
                   class="rounded-xl border border-hijau-200 px-3 py-2.5 text-sm lg:col-span-2">

            <select name="bulan"
                    class="rounded-xl border border-hijau-200 px-3 py-2.5 text-sm">
                <option value="">Semua Bulan</option>
                @foreach ([
                    1 => 'Januari',
                    2 => 'Februari',
                    3 => 'Maret',
                    4 => 'April',
                    5 => 'Mei',
                    6 => 'Juni',
                    7 => 'Juli',
                    8 => 'Agustus',
                    9 => 'September',
                    10 => 'Oktober',
                    11 => 'November',
                    12 => 'Desember',
                ] as $nomor => $nama)
                    <option value="{{ $nomor }}"
                        @selected((string) request('bulan') === (string) $nomor)>
                        {{ $nama }}
                    </option>
                @endforeach
            </select>

            <input type="number"
                   name="tahun"
                   min="2020"
                   max="2100"
                   value="{{ request('tahun') }}"
                   placeholder="Tahun"
                   class="rounded-xl border border-hijau-200 px-3 py-2.5 text-sm">

            <select name="status"
                    class="rounded-xl border border-hijau-200 px-3 py-2.5 text-sm">
                <option value="">Semua Status</option>
                <option value="mendatang" @selected(request('status') === 'mendatang')>
                    Mendatang
                </option>
                <option value="selesai" @selected(request('status') === 'selesai')>
                    Selesai
                </option>
                <option value="dibatalkan" @selected(request('status') === 'dibatalkan')>
                    Dibatalkan
                </option>
            </select>

            <div class="flex flex-wrap gap-2 lg:col-span-5">
                <button type="submit"
                        class="rounded-xl bg-hijau-700 px-5 py-2.5 text-sm font-semibold text-white hover:bg-hijau-800">
                    Terapkan Filter
                </button>

                <a href="{{ route('panel.agenda.index') }}"
                   class="rounded-xl border border-hijau-200 px-5 py-2.5 text-sm font-semibold text-ink-600 hover:bg-hijau-50">
                    Reset
                </a>
            </div>
        </form>
    </div>

    {{-- Tabel agenda --}}
    <div class="overflow-hidden rounded-2xl border border-hijau-100 bg-white shadow-sm">
        <div class="border-b border-hijau-100 px-5 py-4">
            <h3 class="font-bold text-ink-800">
                Daftar Kegiatan
            </h3>
            <p class="mt-1 text-xs text-ink-500">
                {{ $agendas->total() }} agenda ditemukan
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-hijau-100 text-left text-sm">
                <thead class="bg-hijau-50">
                    <tr class="text-ink-700">
                        <th class="px-4 py-3">No.</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Judul & Uraian</th>
                        <th class="px-4 py-3">Lokasi & Waktu</th>
                        <th class="px-4 py-3">Bidang</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-hijau-100">
                    @forelse ($agendas as $agenda)
                        <tr class="align-top hover:bg-hijau-50/40">
                            <td class="px-4 py-4 text-ink-500">
                                {{ $agendas->firstItem() + $loop->index }}
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 font-semibold text-ink-700">
                                {{ $agenda->tanggal->format('d/m/Y') }}
                            </td>

                            <td class="min-w-60 px-4 py-4">
                                <p class="font-bold text-ink-800">
                                    {{ $agenda->judul }}
                                </p>
                                <p class="mt-1 line-clamp-3 text-xs leading-relaxed text-ink-500">
                                    {{ $agenda->uraian }}
                                </p>
                            </td>

                            <td class="min-w-44 px-4 py-4">
                                <p class="font-medium text-ink-700">
                                    {{ $agenda->lokasi }}
                                </p>
                                <p class="mt-1 text-xs text-ink-500">
                                    {{ substr($agenda->waktu_mulai, 0, 5) }}
                                    @if ($agenda->waktu_selesai)
                                        - {{ substr($agenda->waktu_selesai, 0, 5) }}
                                    @elseif ($agenda->keterangan_waktu)
                                        {{ $agenda->keterangan_waktu }}
                                    @endif
                                    WIB
                                </p>
                            </td>

                            <td class="min-w-32 px-4 py-4 text-ink-600">
                                {{ $agenda->bdg?->nama ?? $agenda->bdg?->nm_bdg ?? $agenda->bdg?->slug ?? '-' }}
                            </td>

                            <td class="px-4 py-4">
                                @if ($agenda->dibatalkan_at)
                                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        Dibatalkan
                                    </span>
                                @elseif ($agenda->tanggal->lt(\Carbon\Carbon::today('Asia/Jakarta')))
                                    <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">
                                        Selesai
                                    </span>
                                @else
                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        Mendatang
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-4">
                                <div class="flex flex-col gap-2">
                                    <a href="{{ route('panel.agenda.edit', $agenda) }}"
                                       class="rounded-lg border border-hijau-200 px-3 py-2 text-center text-xs font-semibold text-hijau-700 hover:bg-hijau-50">
                                        Edit
                                    </a>

                                    <form method="POST"
                                          action="{{ route('panel.agenda.hapus', $agenda) }}"
                                          onsubmit="return confirm('Yakin ingin menghapus agenda ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="w-full rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-red-600 hover:bg-red-50">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-14 text-center">
                                <p class="font-semibold text-ink-700">
                                    Belum ada agenda kegiatan
                                </p>
                                <p class="mt-2 text-sm text-ink-500">
                                    Tambahkan agenda pertama atau ubah filter pencarian.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($agendas->hasPages())
            <div class="border-t border-hijau-100 px-5 py-4">
                {{ $agendas->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
