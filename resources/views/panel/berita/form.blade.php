@extends('panel.layout')

@section('judul', $brt->exists ? 'Ubah Berita' : 'Tambah Berita')

@section('konten')
    <form method="POST" action="{{ $brt->exists ? route('panel.berita.perbarui', $brt) : route('panel.berita.simpan') }}" enctype="multipart/form-data" class="grid gap-6 lg:grid-cols-3">
        @csrf
        @if ($brt->exists)
            @method('PUT')
        @endif

        <div class="space-y-5 lg:col-span-2">
            <div class="rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm">
                <div>
                    <label class="mb-1 block text-sm font-medium text-ink-700">Judul</label>
                    <input type="text" name="judul" value="{{ old('judul', $brt->judul) }}" class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                    @error('judul')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                <div class="mt-4">
                    <label class="mb-1 block text-sm font-medium text-ink-700">Ringkasan</label>
                    <textarea name="ringkasan" rows="2" maxlength="500" class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">{{ old('ringkasan', $brt->ringkasan) }}</textarea>
                </div>

                <div class="mt-4">
                    <label class="mb-1 block text-sm font-medium text-ink-700">Isi Berita</label>
                    <textarea name="isi" rows="14" class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 font-mono text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">{{ old('isi', $brt->isi) }}</textarea>
                    <p class="mt-1 text-xs text-ink-400">Mendukung HTML sederhana.</p>
                    @error('isi')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <div class="space-y-5">
            <div class="rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm">
                <div>
                    <label class="mb-1 block text-sm font-medium text-ink-700">Jenis</label>
                    <select name="jenis" class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                        <option value="ppid" @selected(old('jenis', $brt->jenis) === 'ppid')>Berita PPID</option>
                        <option value="kegiatan" @selected(old('jenis', $brt->jenis) === 'kegiatan')>Info Kegiatan</option>
                    </select>
                </div>

                <div class="mt-4">
                    <label class="mb-1 block text-sm font-medium text-ink-700">Bidang</label>
                    <select name="bdg_id" class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                        <option value="">Umum</option>
                        @foreach ($dtBdg as $bdg)
                            <option value="{{ $bdg->id }}" @selected((string) old('bdg_id', $brt->bdg_id) === (string) $bdg->id)>{{ $bdg->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-4">
                    <label class="mb-1 block text-sm font-medium text-ink-700">Tanggal Terbit</label>
                    <input type="date" name="tgl_terbit" value="{{ old('tgl_terbit', $brt->tgl_terbit?->format('Y-m-d') ?? date('Y-m-d')) }}" class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                </div>

                <div class="mt-4">
                    <label class="mb-1 block text-sm font-medium text-ink-700">Gambar</label>
                    @if ($brt->gambar)
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($brt->gambar) }}" alt="" class="mb-2 h-28 w-full rounded-lg object-cover">
                    @endif
                    <input type="file" name="gambar" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-xl border border-hijau-200 bg-white px-3 py-2 text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-hijau-600 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-white">
                </div>

                <label class="mt-4 flex items-center gap-2 text-sm text-ink-700">
                    <input type="checkbox" name="terbit" value="1" @checked(old('terbit', $brt->terbit)) class="h-4 w-4 rounded border-hijau-300 text-hijau-600">
                    Terbitkan
                </label>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('panel.berita.index') }}" class="flex-1 rounded-xl border border-hijau-200 px-4 py-3 text-center text-sm font-semibold text-ink-600 transition hover:bg-hijau-50">Batal</a>
                <button class="flex-1 rounded-xl bg-hijau-700 px-4 py-3 text-sm font-semibold text-white transition hover:bg-hijau-800">Simpan</button>
            </div>
        </div>
    </form>
@endsection
