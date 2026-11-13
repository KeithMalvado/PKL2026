@extends('panel.layout')

@section('judul', 'Halaman Statis')

@section('konten')
    <div class="mb-5 rounded-xl border border-hijau-200 bg-hijau-50 px-4 py-3 text-sm text-hijau-800">
        Kelola konten halaman profil, UPTD, dan struktur organisasi. Bagan struktur organisasi diunggah pada halaman <strong>Profil &amp; Struktur Organisasi</strong>.
    </div>

    <div class="overflow-hidden rounded-2xl border border-hijau-100 bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-hijau-100 bg-hijau-50/50 text-xs uppercase tracking-wide text-hijau-700">
                <tr>
                    <th class="px-5 py-3">Judul</th>
                    <th class="px-5 py-3">Kunci</th>
                    <th class="px-5 py-3">Gambar</th>
                    <th class="px-5 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-hijau-50">
                @foreach ($dtHal as $hal)
                    <tr class="transition hover:bg-hijau-50/40">
                        <td class="px-5 py-3 font-semibold text-ink-700">{{ $hal->judul }}</td>
                        <td class="px-5 py-3 text-xs text-ink-400">{{ $hal->kunci }}</td>
                        <td class="px-5 py-3">
                            <span class="rounded-full px-2 py-0.5 text-xs font-semibold {{ $hal->gambar ? 'bg-hijau-100 text-hijau-700' : 'bg-ink-100 text-ink-500' }}">{{ $hal->gambar ? 'Ada' : '-' }}</span>
                        </td>
                        <td class="px-5 py-3">
                            <a href="{{ route('panel.halaman.edit', $hal) }}" class="text-xs font-semibold text-hijau-600 hover:text-hijau-700">Ubah</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
