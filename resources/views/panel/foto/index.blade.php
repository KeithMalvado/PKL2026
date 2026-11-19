
@extends('panel.layout')

@section('judul', 'Galeri Foto Kegiatan')

@section('konten')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-ink-800">
                Galeri Foto Kegiatan
            </h1>
            <p class="mt-1 text-sm text-ink-500">
                Kelola dokumentasi foto kegiatan DKPPP Jember.
            </p>
        </div>

        <a href="{{ route('galeri.foto') }}"
           target="_blank"
           rel="noopener noreferrer"
           class="inline-flex items-center gap-2 rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm font-semibold text-hijau-700 shadow-sm transition hover:bg-hijau-50">
            <span>Lihat Galeri Publik</span>
            <span aria-hidden="true">↗</span>
        </a>
    </div>

    <div class="grid items-start gap-6 xl:grid-cols-[minmax(0,3fr)_minmax(0,2fr)]">

        {{-- KOLOM KIRI: DAFTAR FOTO --}}
        <div class="min-w-0 space-y-5">

            <div class="rounded-2xl border border-hijau-100 bg-white p-5 shadow-sm">

                <div class="mb-5 flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <h2 class="text-lg font-bold text-ink-800">
                            Koleksi Foto
                        </h2>
                        <p class="mt-1 text-xs text-ink-500">
                            Total {{ $dtFoto->total() }} foto
                        </p>
                    </div>
                </div>

                {{-- FILTER ALBUM --}}
                @if ($dtAlbum->count())
                    <div class="mb-6 flex flex-wrap gap-2">

                        <a href="{{ route('panel.foto.index') }}"
                           class="rounded-full px-3 py-2 text-xs font-semibold transition
                           {{ !$album
                               ? 'bg-hijau-700 text-white'
                               : 'border border-hijau-200 bg-hijau-50 text-hijau-700 hover:bg-hijau-100' }}">
                            Semua Album
                        </a>

                        @foreach ($dtAlbum as $namaAlbum)
                            <a href="{{ route('panel.foto.index', ['album' => $namaAlbum]) }}"
                               class="rounded-full px-3 py-2 text-xs font-semibold transition
                               {{ $album === $namaAlbum
                                   ? 'bg-hijau-700 text-white'
                                   : 'border border-hijau-200 bg-hijau-50 text-hijau-700 hover:bg-hijau-100' }}">
                                {{ $namaAlbum }}
                            </a>
                        @endforeach

                    </div>
                @endif

                {{-- GRID FOTO --}}
                @if ($dtFoto->count())

                    <div class="grid gap-4 sm:grid-cols-2">

                        @foreach ($dtFoto as $foto)

                            <div class="overflow-hidden rounded-2xl border border-hijau-100 bg-white shadow-sm transition hover:shadow-md">

                                {{-- GAMBAR --}}
                                <div class="aspect-[4/3] overflow-hidden bg-hijau-50">

                                    <img
                                        src="{{ \Illuminate\Support\Facades\Storage::url($foto->path) }}"
                                        alt="{{ $foto->judul }}"
                                        loading="lazy"
                                        class="h-full w-full object-cover transition duration-500 hover:scale-105"
                                    >

                                </div>

                                {{-- INFORMASI --}}
                                <div class="space-y-3 p-4">

                                    <div>
                                        <span class="inline-block rounded-full bg-hijau-50 px-2.5 py-1 text-[11px] font-semibold text-hijau-700">
                                            {{ $foto->album ?: 'Tanpa Album' }}
                                        </span>

                                        <h3 class="mt-2 text-sm font-bold leading-relaxed text-ink-800">
                                            {{ $foto->judul }}
                                        </h3>

                                        @if ($foto->ket)
                                            <p class="mt-1 line-clamp-2 text-xs leading-relaxed text-ink-500">
                                                {{ $foto->ket }}
                                            </p>
                                        @endif

                                        <p class="mt-2 text-[11px] text-ink-400">
                                            Ditambahkan:
                                            {{ $foto->created_at?->format('d/m/Y') ?? '-' }}
                                        </p>
                                    </div>

                                    {{-- FORM EDIT --}}
                                    <details class="overflow-hidden rounded-xl border border-hijau-200">

                                        <summary class="cursor-pointer bg-hijau-50 px-3 py-2.5 text-center text-xs font-semibold text-hijau-700 transition hover:bg-hijau-100">
                                            Edit Foto
                                        </summary>

                                        <form
                                            method="POST"
                                            action="{{ route('panel.foto.perbarui', $foto) }}"
                                            enctype="multipart/form-data"
                                            class="space-y-3 border-t border-hijau-100 p-3"
                                            x-data="{ pesanEdit: '' }"
                                            x-on:submit="if (pesanEdit) $event.preventDefault()"
                                        >
                                            @csrf
                                            @method('PUT')

                                            <div>
                                                <label class="mb-1 block text-xs font-semibold text-ink-600">
                                                    Judul Foto
                                                </label>

                                                <input
                                                    type="text"
                                                    name="judul"
                                                    value="{{ $foto->judul }}"
                                                    required
                                                    maxlength="200"
                                                    class="w-full rounded-lg border border-hijau-200 px-3 py-2 text-xs outline-none focus:border-hijau-500"
                                                >
                                            </div>

                                            <div>
                                                <label class="mb-1 block text-xs font-semibold text-ink-600">
                                                    Nama Album
                                                </label>

                                                <input
                                                    type="text"
                                                    name="album"
                                                    value="{{ $foto->album }}"
                                                    maxlength="100"
                                                    class="w-full rounded-lg border border-hijau-200 px-3 py-2 text-xs outline-none focus:border-hijau-500"
                                                >
                                            </div>

                                            <div>
                                                <label class="mb-1 block text-xs font-semibold text-ink-600">
                                                    Keterangan
                                                </label>

                                                <textarea
                                                    name="ket"
                                                    rows="3"
                                                    maxlength="1000"
                                                    class="w-full rounded-lg border border-hijau-200 px-3 py-2 text-xs outline-none focus:border-hijau-500"
                                                >{{ $foto->ket }}</textarea>
                                            </div>

                                            <div>
                                                <label class="mb-1 block text-xs font-semibold text-ink-600">
                                                    Ganti Foto (Opsional)
                                                </label>

                                                <input
                                                    type="file"
                                                    name="foto_baru"
                                                    accept=".jpg,.jpeg,.png,.webp"
                                                    x-on:change="
                                                        pesanEdit = '';
                                                        const f = $event.target.files[0];
                                                        if (f && f.size > 10 * 1024 * 1024) {
                                                            pesanEdit = 'Ukuran foto maksimal 10 MB.';
                                                            $event.target.value = '';
                                                        }
                                                    "
                                                    class="w-full text-xs text-ink-600 file:mr-2 file:rounded-lg file:border-0 file:bg-hijau-100 file:px-2 file:py-1.5 file:text-xs file:font-semibold file:text-hijau-700"
                                                >

                                                <template x-if="pesanEdit">
                                                    <p class="mt-2 text-xs text-red-600" x-text="pesanEdit"></p>
                                                </template>
                                            </div>

                                            <button
                                                type="submit"
                                                class="w-full rounded-lg bg-hijau-700 px-3 py-2.5 text-xs font-semibold text-white transition hover:bg-hijau-800"
                                            >
                                                Simpan Perubahan
                                            </button>

                                        </form>
                                    </details>

                                    {{-- HAPUS FOTO --}}
                                    <form
                                        method="POST"
                                        action="{{ route('panel.foto.hapus', $foto) }}"
                                        onsubmit="return confirm('Yakin ingin menghapus foto ini? Foto yang dihapus juga akan hilang dari galeri publik.')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="w-full rounded-xl border border-red-200 bg-white px-3 py-2.5 text-xs font-semibold text-red-600 transition hover:bg-red-50"
                                        >
                                            Hapus Foto
                                        </button>
                                    </form>

                                </div>
                            </div>

                        @endforeach

                    </div>

                    {{-- PAGINATION --}}
                    <div class="mt-6">
                        {{ $dtFoto->links() }}
                    </div>

                @else

                    {{-- EMPTY STATE --}}
                    <div class="flex flex-col items-center justify-center rounded-2xl border border-dashed border-hijau-200 bg-hijau-50/40 px-6 py-16 text-center">

                        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-hijau-100 text-hijau-700">

                            <svg
                                class="h-8 w-8"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.5"
                            >
                                <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <path d="m21 15-5-5L5 21"></path>
                            </svg>

                        </div>

                        <h3 class="text-base font-bold text-ink-800">
                            Belum Ada Foto
                        </h3>

                        <p class="mt-2 max-w-xs text-sm leading-relaxed text-ink-500">
                            Dokumentasi foto kegiatan yang diunggah akan ditampilkan di sini.
                        </p>

                    </div>

                @endif

            </div>
        </div>

        {{-- KOLOM KANAN: FORM UPLOAD --}}
        <div class="min-w-0">

            <div class="rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm lg:sticky lg:top-6">

                <div class="mb-6">
                    <div class="mb-3 inline-flex rounded-xl bg-hijau-50 px-3 py-2 text-hijau-700">

                        <svg
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16V4m0 0-4 4m4-4 4 4M4 16v3a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-3"></path>
                        </svg>

                    </div>

                    <h2 class="text-lg font-bold text-ink-800">
                        Unggah Foto Kegiatan
                    </h2>

                    <p class="mt-1 text-xs leading-relaxed text-ink-500">
                        Tambahkan dokumentasi kegiatan agar dapat dilihat masyarakat melalui galeri publik.
                    </p>
                </div>

                <form
                    method="POST"
                    action="{{ route('panel.foto.simpan') }}"
                    enctype="multipart/form-data"
                    class="space-y-5"
                    x-data="{ pesanFoto: '', jumlahFoto: 0, mengirim: false }"
                    x-on:submit="
                        if (pesanFoto) {
                            $event.preventDefault();
                        } else {
                            mengirim = true;
                        }
                    "
                >
                    @csrf

                    {{-- JUDUL --}}
                    <div>
                        <label for="judul-foto" class="mb-1.5 block text-sm font-semibold text-ink-700">
                            Judul Kegiatan <span class="text-red-500">*</span>
                        </label>

                        <input
                            id="judul-foto"
                            type="text"
                            name="judul"
                            value="{{ old('judul') }}"
                            required
                            maxlength="200"
                            placeholder="Contoh: Sosialisasi Budidaya Ikan"
                            class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-3 text-sm text-ink-800 outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-100"
                        >
                    </div>

                    {{-- ALBUM --}}
                    <div>
                        <label for="album-foto" class="mb-1.5 block text-sm font-semibold text-ink-700">
                            Nama Album
                        </label>

                        <input
                            id="album-foto"
                            type="text"
                            name="album"
                            value="{{ old('album') }}"
                            maxlength="100"
                            placeholder="Contoh: Kegiatan Perikanan 2026"
                            class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-3 text-sm text-ink-800 outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-100"
                        >

                        <p class="mt-1.5 text-xs text-ink-400">
                            Foto dengan album yang sama akan dikelompokkan dalam filter galeri publik.
                        </p>
                    </div>

                    {{-- KETERANGAN --}}
                    <div>
                        <label for="ket-foto" class="mb-1.5 block text-sm font-semibold text-ink-700">
                            Keterangan Kegiatan
                        </label>

                        <textarea
                            id="ket-foto"
                            name="ket"
                            rows="4"
                            maxlength="1000"
                            placeholder="Tuliskan keterangan singkat mengenai kegiatan..."
                            class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-3 text-sm text-ink-800 outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-100"
                        >{{ old('ket') }}</textarea>
                    </div>

                    {{-- UPLOAD FOTO --}}
                    <div>
                        <label for="upload-foto" class="mb-1.5 block text-sm font-semibold text-ink-700">
                            Pilih Foto <span class="text-red-500">*</span>
                        </label>

                        <div class="rounded-xl border border-dashed border-hijau-300 bg-hijau-50/50 p-4">

                            <input
                                id="upload-foto"
                                type="file"
                                name="foto[]"
                                accept=".jpg,.jpeg,.png,.webp"
                                multiple
                                required
                                x-on:change="
                                    const berkas = Array.from($event.target.files);
                                    jumlahFoto = berkas.length;
                                    pesanFoto = '';

                                    if (berkas.length > 8) {
                                        pesanFoto = 'Maksimal 8 foto dalam satu unggahan.';
                                    } else if (berkas.some(f => f.size > 10 * 1024 * 1024)) {
                                        pesanFoto = 'Ukuran setiap foto maksimal 10 MB.';
                                    } else if (berkas.some(f => !['image/jpeg', 'image/png', 'image/webp'].includes(f.type))) {
                                        pesanFoto = 'Foto harus berformat JPG, PNG, atau WEBP.';
                                    }

                                    if (pesanFoto) {
                                        $event.target.value = '';
                                        jumlahFoto = 0;
                                    }
                                "
                                class="w-full text-xs text-ink-600 file:mr-3 file:rounded-lg file:border-0 file:bg-hijau-700 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-white file:transition file:hover:bg-hijau-800"
                            >

                            <p class="mt-3 text-xs leading-relaxed text-ink-500">
                                JPG, PNG, atau WEBP. Maksimal 10 MB per foto.
                                Bisa memilih hingga 8 foto sekaligus.
                            </p>

                        </div>

                        {{-- PESAN VALIDASI --}}
                        <template x-if="pesanFoto">
                            <div
                                class="mt-2 rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-xs font-medium text-red-700"
                                role="alert"
                                x-text="pesanFoto"
                            ></div>
                        </template>

                        {{-- INFORMASI JUMLAH FOTO --}}
                        <template x-if="jumlahFoto > 0">
                            <p class="mt-2 text-xs font-semibold text-hijau-700">
                                <span x-text="jumlahFoto"></span>
                                foto siap diunggah.
                            </p>
                        </template>

                    </div>

                    {{-- SUBMIT --}}

                    {{-- TOMBOL UNGGAH FOTO --}}
                    <button
                        type="submit"
                        class="btn-upload-foto"
                        x-bind:disabled="mengirim"
                    >
                        <span
                            x-text="mengirim ? 'Sedang Mengunggah...' : 'Unggah Foto Kegiatan'"
                        >
                            Unggah Foto Kegiatan
                        </span>
                    </button>


                    <p class="text-center text-xs leading-relaxed text-ink-400">
                        Foto yang berhasil disimpan akan langsung tersedia di halaman Galeri Foto publik.
                    </p>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection
