
@extends('panel.layout')

@section('judul', 'Manajemen Produk Hukum')

@section('konten')

<div class="space-y-6">

    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-ink-800">
                Produk Hukum & Kebijakan
            </h1>
            <p class="mt-1 text-sm text-ink-500">
                Kelola dokumen peraturan dan kebijakan DKPPP Jember.
            </p>
        </div>

        <a href="{{ route('galeri.produk-hukum') }}"
           target="_blank"
           rel="noopener noreferrer"
           class="rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm font-semibold text-hijau-700 hover:bg-hijau-50">
            Lihat Halaman Publik
        </a>
    </div>

    <div class="grid items-start gap-6 xl:grid-cols-[minmax(0,3fr)_minmax(0,2fr)]">

        {{-- DAFTAR DOKUMEN --}}
        <div class="min-w-0 space-y-5">

            <div class="rounded-2xl border border-hijau-100 bg-white p-5 shadow-sm">

                <div class="mb-5">
                    <h2 class="text-lg font-bold text-ink-800">Daftar Produk Hukum</h2>
                    <p class="mt-1 text-xs text-ink-500">
                        Total {{ $dtProdHkm->total() }} dokumen
                    </p>
                </div>

                <form method="GET" class="mb-6 flex flex-col gap-2 sm:flex-row">
                    <input
                        type="search"
                        name="q"
                        value="{{ $q }}"
                        placeholder="Cari judul dokumen..."
                        class="min-w-0 flex-1 rounded-xl border border-hijau-200 px-3 py-2.5 text-sm outline-none focus:border-hijau-500"
                    >

                    <select name="jenis"
                            class="rounded-xl border border-hijau-200 px-3 py-2.5 text-sm text-ink-700">
                        <option value="">Semua Jenis</option>
                        @foreach ($dtJenis as $itemJenis)
                            <option value="{{ $itemJenis }}" @selected($jenis === $itemJenis)>
                                {{ $itemJenis }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit"
                            class="rounded-xl bg-hijau-700 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-hijau-800">
                        Cari
                    </button>
                </form>

                @if ($dtProdHkm->count())

                    <div class="space-y-4">
                        @foreach ($dtProdHkm as $dok)

                            <article class="rounded-2xl border border-hijau-100 bg-hijau-50/30 p-4">

                                <div class="flex items-start gap-3">
                                    <div class="grid h-12 w-12 shrink-0 place-items-center rounded-xl bg-hijau-100 text-hijau-700">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 3h7l5 5v12a1 1 0 0 1-1 1H8a3 3 0 0 1-3-3V6a3 3 0 0 1 3-3zM15 3v6h5M9 14h7M9 17h5"/>
                                        </svg>
                                    </div>

                                    <div class="min-w-0 flex-1">
                                        <p class="text-[11px] font-bold uppercase text-hijau-700">
                                            {{ $dok->jenis }} • {{ $dok->thn }}
                                        </p>

                                        <h3 class="mt-1 text-sm font-bold leading-relaxed text-ink-800">
                                            {{ $dok->judul }}
                                        </h3>

                                        @if ($dok->no_dok)
                                            <p class="mt-1 text-xs text-ink-500">
                                                Nomor: {{ $dok->no_dok }}
                                            </p>
                                        @endif

                                        @if ($dok->ket)
                                            <p class="mt-2 text-xs leading-relaxed text-ink-500">
                                                {{ $dok->ket }}
                                            </p>
                                        @endif

                                        <p class="mt-2 text-xs text-ink-400">
                                            {{ $dok->diunduh ?? 0 }} kali diunduh
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-4 flex flex-wrap gap-2">
                                    @if ($dok->file)
                                        <a href="{{ \Illuminate\Support\Facades\Storage::url($dok->file) }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="rounded-lg border border-hijau-200 bg-white px-3 py-2 text-xs font-semibold text-hijau-700 hover:bg-hijau-50">
                                            Lihat PDF
                                        </a>
                                    @endif
                                </div>

                                <details class="mt-3 overflow-hidden rounded-xl border border-hijau-200 bg-white">
                                    <summary class="cursor-pointer bg-hijau-50 px-3 py-2.5 text-xs font-semibold text-hijau-700">
                                        Edit Dokumen
                                    </summary>

                                    <form
                                        method="POST"
                                        action="{{ route('panel.produk-hukum.perbarui', $dok) }}"
                                        enctype="multipart/form-data"
                                        class="space-y-3 p-4"
                                        x-data="{ pesanFile: '' }"
                                        x-on:submit="if (pesanFile) $event.preventDefault()"
                                    >
                                        @csrf
                                        @method('PUT')

                                        <label class="block text-xs font-semibold text-ink-600">
                                            Judul
                                        </label>
                                        <input type="text" name="judul" value="{{ $dok->judul }}"
                                               required maxlength="255"
                                               class="w-full rounded-lg border border-hijau-200 px-3 py-2 text-sm">

                                        <label class="block text-xs font-semibold text-ink-600">
                                            Jenis
                                        </label>
                                        <input type="text" name="jenis" value="{{ $dok->jenis }}"
                                               required maxlength="100"
                                               class="w-full rounded-lg border border-hijau-200 px-3 py-2 text-sm">

                                        <label class="block text-xs font-semibold text-ink-600">
                                            Nomor Dokumen
                                        </label>
                                        <input type="text" name="no_dok" value="{{ $dok->no_dok }}"
                                               maxlength="100"
                                               class="w-full rounded-lg border border-hijau-200 px-3 py-2 text-sm">

                                        <label class="block text-xs font-semibold text-ink-600">
                                            Tahun
                                        </label>
                                        <input type="number" name="thn" value="{{ $dok->thn }}"
                                               min="1900" max="2100" required
                                               class="w-full rounded-lg border border-hijau-200 px-3 py-2 text-sm">

                                        <label class="block text-xs font-semibold text-ink-600">
                                            Keterangan
                                        </label>
                                        <textarea name="ket" rows="3" maxlength="1500"
                                                  class="w-full rounded-lg border border-hijau-200 px-3 py-2 text-sm">{{ $dok->ket }}</textarea>

                                        <label class="block text-xs font-semibold text-ink-600">
                                            Ganti PDF (Opsional)

                                        <input
                                            type="file"
                                            name="file"
                                            accept=".pdf,application/pdf"
                                            class="input-ganti-pdf"
                                            x-on:change="
                                                pesanFile = '';
                                                const f = $event.target.files[0];

                                                if (f && f.size > 50 * 1024 * 1024) {
                                                    pesanFile = 'Ukuran dokumen maksimal 50 MB.';
                                                } else if (f && !/\.pdf$/i.test(f.name)) {
                                                    pesanFile = 'Dokumen harus berformat PDF.';
                                                }

                                                if (pesanFile) $event.target.value = '';
                                            "
                                        >


                                        <template x-if="pesanFile">
                                            <p class="text-xs text-red-600" role="alert" x-text="pesanFile"></p>
                                        </template>

                                        <button type="submit"
                                                class="w-full rounded-lg bg-hijau-700 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-hijau-800">
                                            Simpan Perubahan
                                        </button>
                                    </form>
                                </details>

                                <form
                                    method="POST"
                                    action="{{ route('panel.produk-hukum.hapus', $dok) }}"
                                    onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')"
                                    class="mt-3"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="w-full rounded-xl border border-red-200 bg-white px-3 py-2.5 text-xs font-semibold text-red-600 hover:bg-red-50">
                                        Hapus Dokumen
                                    </button>
                                </form>

                            </article>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $dtProdHkm->links() }}
                    </div>

                @else

                    <div class="rounded-xl border border-dashed border-hijau-200 bg-hijau-50/40 p-10 text-center">
                        <h3 class="font-bold text-ink-700">Belum Ada Dokumen</h3>
                        <p class="mt-2 text-sm text-ink-500">
                            Produk hukum yang diunggah akan muncul di sini.
                        </p>
                    </div>

                @endif
            </div>
        </div>

        {{-- FORM UPLOAD --}}
        <div class="min-w-0">
            <div class="rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm xl:sticky xl:top-6">

                <h2 class="text-lg font-bold text-ink-800">
                    Unggah Produk Hukum
                </h2>

                <p class="mt-1 text-xs leading-relaxed text-ink-500">
                    Tambahkan dokumen PDF untuk dipublikasikan di website DKPPP.
                </p>

                <form
                    method="POST"
                    action="{{ route('panel.produk-hukum.simpan') }}"
                    enctype="multipart/form-data"
                    class="mt-6 space-y-4"
                    x-data="{ pesanFile: '', mengirim: false }"
                    x-on:submit="
                        if (pesanFile) {
                            $event.preventDefault();
                        } else {
                            mengirim = true;
                        }
                    "
                >
                    @csrf

                    <div>
                        <label for="hukum-judul" class="mb-1.5 block text-sm font-semibold text-ink-700">
                            Judul Dokumen *
                        </label>
                        <input
                            id="hukum-judul"
                            type="text"
                            name="judul"
                            value="{{ old('judul') }}"
                            maxlength="255"
                            required
                            placeholder="Contoh: Peraturan Bupati tentang ..."
                            class="w-full rounded-xl border border-hijau-200 px-4 py-3 text-sm outline-none focus:border-hijau-500"
                        >
                    </div>


                    {{-- JENIS PRODUK HUKUM --}}
                    <div>
                        <label for="hukum-jenis" class="mb-1.5 block text-sm font-semibold text-ink-700">
                            Jenis Produk Hukum *
                        </label>

                        <input
                            id="hukum-jenis"
                            type="text"
                            name="jenis"
                            value="{{ old('jenis') }}"
                            list="daftar-jenis-hukum"
                            maxlength="100"
                            required
                            placeholder="Pilih atau ketik jenis produk hukum lainnya"
                            class="w-full rounded-xl border border-hijau-200 px-4 py-3 text-sm outline-none focus:border-hijau-500"
                        >

                        <datalist id="daftar-jenis-hukum">
                            <option value="Peraturan Daerah">
                            <option value="Peraturan Bupati">
                            <option value="Keputusan Bupati">
                            <option value="Keputusan Kepala Dinas">
                            <option value="Surat Edaran">
                            <option value="Kebijakan">
                        </datalist>

                        <p class="mt-1.5 text-xs text-ink-500">
                            Jika jenis tidak tersedia, ketik nama jenis produk hukum secara manual.
                        </p>
                    </div>


                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label for="hukum-nomor" class="mb-1.5 block text-sm font-semibold text-ink-700">
                                Nomor Dokumen
                            </label>
                            <input
                                id="hukum-nomor"
                                type="text"
                                name="no_dok"
                                value="{{ old('no_dok') }}"
                                maxlength="100"
                                placeholder="Contoh: 12"
                                class="w-full rounded-xl border border-hijau-200 px-3 py-3 text-sm outline-none focus:border-hijau-500"
                            >
                        </div>

                        <div>
                            <label for="hukum-tahun" class="mb-1.5 block text-sm font-semibold text-ink-700">
                                Tahun *
                            </label>
                            <input
                                id="hukum-tahun"
                                type="number"
                                name="thn"
                                value="{{ old('thn', date('Y')) }}"
                                min="1900"
                                max="2100"
                                required
                                class="w-full rounded-xl border border-hijau-200 px-3 py-3 text-sm outline-none focus:border-hijau-500"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="hukum-ket" class="mb-1.5 block text-sm font-semibold text-ink-700">
                            Keterangan
                        </label>
                        <textarea
                            id="hukum-ket"
                            name="ket"
                            rows="3"
                            maxlength="1500"
                            placeholder="Deskripsi singkat dokumen..."
                            class="w-full rounded-xl border border-hijau-200 px-4 py-3 text-sm outline-none focus:border-hijau-500"
                        >{{ old('ket') }}</textarea>
                    </div>

                    <div>
                        <label for="hukum-file" class="mb-1.5 block text-sm font-semibold text-ink-700">
                            File PDF *
                        </label>

                        <input
                            id="hukum-file"
                            type="file"
                            name="file"
                            accept=".pdf,application/pdf"
                            required
                            x-on:change="
                                pesanFile = '';
                                const f = $event.target.files[0];

                                if (f && f.size > 50 * 1024 * 1024) {
                                    pesanFile = 'Ukuran dokumen maksimal 50 MB.';
                                } else if (f && !/\.pdf$/i.test(f.name)) {
                                    pesanFile = 'Dokumen harus berformat PDF.';
                                }

                                if (pesanFile) $event.target.value = '';
                            "
                            class="w-full rounded-xl border border-dashed border-hijau-300 bg-hijau-50/50 p-3 text-xs text-ink-600"
                        >

                        <p class="mt-2 text-xs text-ink-400">
                            Hanya PDF. Maksimal 50 MB.
                        </p>

                        <template x-if="pesanFile">
                            <p class="mt-2 rounded-lg border border-red-200 bg-red-50 p-3 text-xs font-medium text-red-700"
                               role="alert" x-text="pesanFile"></p>
                        </template>
                    </div>

                    <button
                        type="submit"
                        class="btn-produk-hukum"
                        x-bind:disabled="mengirim"
                    >
                        <span x-text="mengirim ? 'Sedang Mengunggah...' : 'Unggah Produk Hukum'">
                            Unggah Produk Hukum
                        </span>
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection
