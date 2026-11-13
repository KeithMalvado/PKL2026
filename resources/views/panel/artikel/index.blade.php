@extends('panel.layout')

@section('judul', 'Artikel & Jurnal')

@section('konten')
    <div class="mb-5 flex flex-wrap items-center justify-between gap-3">
        <form method="GET" class="flex flex-wrap items-center gap-3">
            <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari artikel..." class="rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
            <select name="jenis" class="rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                <option value="">Semua Jenis</option>
                <option value="artikel" @selected(request('jenis') === 'artikel')>Artikel</option>
                <option value="jurnal" @selected(request('jenis') === 'jurnal')>Jurnal</option>
            </select>
            <button class="rounded-xl bg-hijau-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-hijau-700">Filter</button>
        </form>

        <a href="{{ route('panel.artikel.create') }}" class="rounded-xl bg-hijau-700 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-hijau-800">Tambah Artikel</a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-hijau-100 bg-white shadow-sm">
        @if ($dtArt->count())
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
                        @foreach ($dtArt as $art)
                            <tr class="transition hover:bg-hijau-50/40">
                                <td class="px-5 py-3">
                                    <p class="font-semibold text-ink-700">{{ $art->judul }}</p>
                                    <p class="text-xs text-ink-400">{{ $art->penulis ?: '-' }} &bull; {{ $art->tgl_terbit?->translatedFormat('d M Y') }}</p>
                                </td>
                                <td class="px-5 py-3">
                                    <span class="rounded-full bg-hijau-100 px-2 py-0.5 text-xs font-semibold text-hijau-700">{{ ucfirst($art->jenis) }}</span>
                                </td>
                                <td class="px-5 py-3 text-xs text-ink-500">{{ $art->bdg?->nama ?? '-' }}</td>
                                <td class="px-5 py-3">
                                    <span class="rounded-full px-2 py-0.5 text-xs font-semibold {{ $art->terbit ? 'bg-hijau-100 text-hijau-700' : 'bg-ink-100 text-ink-500' }}">{{ $art->terbit ? 'Ya' : 'Draft' }}</span>
                                </td>
                                <td class="px-5 py-3">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('panel.artikel.edit', $art) }}" class="text-xs font-semibold text-hijau-600 hover:text-hijau-700">Ubah</a>
                                        <form method="POST" action="{{ route('panel.artikel.hapus', $art) }}" onsubmit="return confirm('Hapus artikel ini?')">
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
            <div class="border-t border-hijau-50 px-5 py-3">{{ $dtArt->links() }}</div>
        @else
            <x-kosong judul="Belum Ada Artikel" ket="Tambahkan artikel atau jurnal untuk ditampilkan di situs publik." />
        @endif
    </div>
@endsection
