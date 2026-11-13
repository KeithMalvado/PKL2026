@extends('panel.layout')

@section('judul', 'Ubah Halaman')

@section('konten')
    <form method="POST" action="{{ route('panel.halaman.perbarui', $hal) }}" enctype="multipart/form-data" class="grid gap-6 lg:grid-cols-3">
        @csrf
        @method('PUT')

        <div class="space-y-5 lg:col-span-2">
            <div class="rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm">
                <div>
                    <label class="mb-1 block text-sm font-medium text-ink-700">Judul</label>
                    <input type="text" name="judul" value="{{ old('judul', $hal->judul) }}" class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                    @error('judul')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                <div class="mt-4">
                    <label class="mb-1 block text-sm font-medium text-ink-700">Isi</label>
                    <textarea name="isi" rows="16" class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 font-mono text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">{{ old('isi', $hal->isi) }}</textarea>
                    <p class="mt-1 text-xs text-ink-400">Mendukung HTML sederhana.</p>
                </div>
            </div>
        </div>

        <div class="space-y-5">
            <div class="rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm">
                <p class="mb-1 text-xs text-ink-400">Kunci: <span class="font-semibold text-ink-600">{{ $hal->kunci }}</span></p>

                <label class="mb-1 mt-4 block text-sm font-medium text-ink-700">Gambar / Bagan</label>
                @if ($hal->gambar)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($hal->gambar) }}" alt="" class="mb-2 w-full rounded-lg border border-hijau-100 object-contain">
                @endif
                <input type="file" name="gambar" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-xl border border-hijau-200 bg-white px-3 py-2 text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-hijau-600 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-white">
                <p class="mt-2 text-xs text-ink-400">Untuk struktur organisasi, unggah gambar bagan di sini.</p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('panel.halaman.index') }}" class="flex-1 rounded-xl border border-hijau-200 px-4 py-3 text-center text-sm font-semibold text-ink-600 transition hover:bg-hijau-50">Batal</a>
                <button class="flex-1 rounded-xl bg-hijau-700 px-4 py-3 text-sm font-semibold text-white transition hover:bg-hijau-800">Simpan</button>
            </div>

            @if ($hal->gambar)
                <button type="submit" form="hapus-gambar" class="w-full rounded-xl border border-red-200 bg-red-50 px-4 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-100">Hapus Gambar</button>
            @endif
        </div>
    </form>

    @if ($hal->gambar)
        <form id="hapus-gambar" method="POST" action="{{ route('panel.halaman.gambar-hapus', $hal) }}" onsubmit="return confirm('Hapus gambar halaman ini?')">
            @csrf
            @method('DELETE')
        </form>
    @endif
@endsection
