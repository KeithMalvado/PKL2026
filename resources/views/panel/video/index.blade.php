@extends('panel.layout')

@section('judul', 'Video Kegiatan')

@section('konten')
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2">
            @if ($dtVid->count())
                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach ($dtVid as $vid)
                        <div class="overflow-hidden rounded-2xl border border-hijau-100 bg-white shadow-sm">
                            <div class="relative aspect-video bg-hijau-900">
                                @if ($vid->thumbUrl())
                                    <img src="{{ $vid->thumbUrl() }}" alt="{{ $vid->judul }}" class="h-full w-full object-cover">
                                @endif
                            </div>
                            <div class="p-4">
                                <p class="line-clamp-2 text-sm font-bold text-ink-800">{{ $vid->judul }}</p>
                                <p class="mt-1 truncate text-xs text-ink-400">{{ $vid->url }}</p>
                                <div class="mt-3 flex items-center gap-3">
                                    @if ($vid->ytId())
                                        <a href="https://www.youtube.com/watch?v={{ $vid->ytId() }}" target="_blank" rel="noopener" class="text-xs font-semibold text-hijau-600 hover:text-hijau-700">Buka</a>
                                    @endif
                                    <form method="POST" action="{{ route('panel.video.hapus', $vid) }}" onsubmit="return confirm('Hapus video ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-xs font-semibold text-red-500 hover:text-red-600">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-8">{{ $dtVid->links() }}</div>
            @else
                <x-kosong judul="Belum Ada Video" ket="Tambahkan tautan YouTube untuk menampilkan video kegiatan." />
            @endif
        </div>

        <div class="rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm">
            <h2 class="mb-1 font-bold text-ink-800">Tambah Video</h2>
            <p class="mb-4 text-xs text-ink-400">Tempel tautan YouTube. Thumbnail diambil otomatis.</p>
            <form method="POST" action="{{ route('panel.video.simpan') }}" class="space-y-3">
                @csrf
                <div>
                    <label class="mb-1 block text-sm font-medium text-ink-700">Judul</label>
                    <input type="text" name="judul" value="{{ old('judul') }}" class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                    @error('judul')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-ink-700">Tautan YouTube</label>
                    <input type="text" name="url" value="{{ old('url') }}" placeholder="https://www.youtube.com/watch?v=..." class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                    @error('url')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-ink-700">Keterangan</label>
                    <input type="text" name="ket" value="{{ old('ket') }}" class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                </div>
                <button class="w-full rounded-xl bg-hijau-700 px-4 py-3 text-sm font-semibold text-white transition hover:bg-hijau-800">Simpan</button>
            </form>
        </div>
    </div>
@endsection
