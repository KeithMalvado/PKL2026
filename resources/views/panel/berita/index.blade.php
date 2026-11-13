@extends('panel.layout')

@section('judul', 'Berita')

@section('konten')
    <div class="mb-5 flex flex-wrap items-center justify-between gap-3">
        <form method="GET" class="flex flex-wrap items-center gap-3">
            <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari berita..." class="rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
            <select name="jenis" class="rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                <option value="">Semua Jenis</option>
                <option value="ppid" @selected(request('jenis') === 'ppid')>PPID</option>
                <option value="kegiatan" @selected(request('jenis') === 'kegiatan')>Kegiatan</option>
            </select>
            <button class="rounded-xl bg-hijau-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-hijau-700">Filter</button>
        </form>

        <a href="{{ route('panel.berita.create') }}" class="rounded-xl bg-hijau-700 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-hijau-800">Tambah Berita</a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-hijau-100 bg-white shadow-sm">
        @if ($dtBrt->count())
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="border-b border-hijau-100 bg-hijau-50/50 text-xs uppercase tracking-wide text-hijau-700">
                        <tr>
                            <th class="px-5 py-3">Judul</th>
                            <th class="px-5 py-3">Jenis</th>
                            <th class="px-5 py-3">Bidang</th>
                            <th class="px-5 py-3">Terbit</th>
                            <th class="px-5 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-hijau-50">
                        @foreach ($dtBrt as $brt)
                            <tr class="transition hover:bg-hijau-50/40">
                                <td class="px-5 py-3">
                                    <p class="font-semibold text-ink-700">{{ $brt->judul }}</p>
                                    <p class="text-xs text-ink-400">{{ $brt->tgl_terbit?->translatedFormat('d M Y') }}</p>
                                </td>
                                <td class="px-5 py-3">
                                    <span class="rounded-full bg-hijau-100 px-2 py-0.5 text-xs font-semibold text-hijau-700">{{ $brt->jenis === 'ppid' ? 'PPID' : 'Kegiatan' }}</span>
                                </td>
                                <td class="px-5 py-3 text-xs text-ink-500">{{ $brt->bdg?->nama ?? '-' }}</td>
                                <td class="px-5 py-3">
                                    <span class="rounded-full px-2 py-0.5 text-xs font-semibold {{ $brt->terbit ? 'bg-hijau-100 text-hijau-700' : 'bg-ink-100 text-ink-500' }}">{{ $brt->terbit ? 'Ya' : 'Draft' }}</span>
                                </td>
                                <td class="px-5 py-3">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('panel.berita.edit', $brt) }}" class="text-xs font-semibold text-hijau-600 hover:text-hijau-700">Ubah</a>
                                        <form method="POST" action="{{ route('panel.berita.hapus', $brt) }}" onsubmit="return confirm('Hapus berita ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-xs font-semibold text-red-500 hover:text-red-600">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="border-t border-hijau-50 px-5 py-3">{{ $dtBrt->links() }}</div>
        @else
            <x-kosong judul="Belum Ada Berita" ket="Tambahkan berita PPID atau info kegiatan." />
        @endif
    </div>
@endsection
