
@extends('panel.layout')

@section('judul', 'Dokumen SOP')

@section('konten')
    <div class="grid gap-6 lg:grid-cols-3">

        {{-- ================= DAFTAR DOKUMEN ================= --}}
        <div class="space-y-6 lg:col-span-2">
            @forelse ($dtDok as $jenis => $daftar)
                <div class="overflow-hidden rounded-2xl border border-hijau-100 bg-white shadow-sm">

                    <div class="border-b border-hijau-100 px-5 py-3">
                        <h2 class="text-sm font-bold text-ink-800">
                            {{ $daftar->first()->labelJenis() }}
                        </h2>
                    </div>

                    @foreach ($daftar as $dok)
                        <div class="flex items-center gap-3 border-b border-hijau-50 px-5 py-3 last:border-0">

                            <span class="grid h-9 w-9 shrink-0 place-items-center rounded-lg bg-red-50 text-red-500">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                </svg>
                            </span>

                            <div class="min-w-0 flex-1">
                                <p class="truncate text-sm font-semibold text-ink-700">
                                    {{ $dok->judul }}
                                </p>

                                <p class="text-xs text-ink-400">
                                    Urut {{ $dok->urut }}
                                    {{ $dok->thn ? ' · ' . $dok->thn : '' }}
                                </p>
                            </div>

                            <a
                                href="{{ \Illuminate\Support\Facades\Storage::url($dok->file) }}"
                                target="_blank"
                                rel="noopener"
                                class="shrink-0 text-xs font-semibold text-hijau-600 transition hover:text-hijau-700"
                            >
                                Lihat
                            </a>

                            <form
                                method="POST"
                                action="{{ route('panel.sop.hapus', $dok) }}"
                                onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="shrink-0 text-xs font-semibold text-red-500 transition hover:text-red-600"
                                >
                                    Hapus
                                </button>
                            </form>

                        </div>
                    @endforeach

                </div>
            @empty
                <x-kosong
                    judul="Belum Ada Dokumen"
                    ket="Unggah SOP atau standar pelayanan dalam format PDF."
                />
            @endforelse
        </div>

        {{-- ================= FORM UPLOAD ================= --}}
        <div class="h-fit rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm">

            <div class="mb-5">
                <h2 class="text-lg font-bold text-ink-800">
                    Unggah Dokumen
                </h2>

                <p class="mt-1 text-xs leading-relaxed text-ink-400">
                    Tambahkan dokumen SOP, standar pelayanan, atau surat keputusan.
                </p>
            </div>

            <form
                method="POST"
                action="{{ route('panel.sop.simpan') }}"
                enctype="multipart/form-data"
                class="space-y-4"
            >
                @csrf

                {{-- Judul --}}
                <div>
                    <label
                        for="judul-sop"
                        class="mb-1.5 block text-sm font-medium text-ink-700"
                    >
                        Judul Dokumen
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        id="judul-sop"
                        type="text"
                        name="judul"
                        value="{{ old('judul') }}"
                        placeholder="Masukkan judul dokumen"
                        maxlength="200"
                        required
                        class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200"
                    >
                </div>

                {{-- Jenis --}}
                <div>
                    <label
                        for="jenis-sop"
                        class="mb-1.5 block text-sm font-medium text-ink-700"
                    >
                        Jenis Dokumen
                        <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="jenis-sop"
                        name="jenis"
                        required
                        class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200"
                    >
                        <option value="sop" @selected(old('jenis', 'sop') === 'sop')>
                            SOP
                        </option>

                        <option value="standar" @selected(old('jenis') === 'standar')>
                            Standar Pelayanan
                        </option>

                        <option value="sk" @selected(old('jenis') === 'sk')>
                            Surat Keputusan
                        </option>
                    </select>
                </div>


                {{-- Berkas PDF --}}
                <div>
                    <label
                        for="file-sop"
                        class="mb-1.5 block text-sm font-medium text-ink-700"
                    >
                        Berkas PDF
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        id="file-sop"
                        type="file"
                        name="file"
                        accept=".pdf,application/pdf"
                        required
                        class="w-full rounded-xl border border-hijau-200 bg-white px-3 py-2 text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-hijau-600 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-white"
                        onchange="
                            const file = this.files[0];
                            const pesan = document.getElementById('pesan-file-sop');

                            pesan.classList.add('hidden');

                            if (file && file.size > 50 * 1024 * 1024) {
                                pesan.classList.remove('hidden');
                                this.value = '';
                            }
                        "
                    >

                    <p
                        id="pesan-file-sop"
                        role="alert"
                        class="mt-2 hidden rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-xs font-medium text-red-700"
                    >
                        Ukuran dokumen melebihi batas 50 MB.
                        Silakan pilih PDF dengan ukuran lebih kecil.
                    </p>

                    <p class="mt-1.5 text-xs leading-relaxed text-ink-400">
                        Format yang didukung: PDF. Ukuran maksimal 50 MB.
                    </p>
                </div>


                {{-- Tahun dan Urutan --}}
                <div class="grid grid-cols-2 gap-3">

                    <div>
                        <label
                            for="tahun-sop"
                            class="mb-1.5 block text-sm font-medium text-ink-700"
                        >
                            Tahun
                        </label>

                        <input
                            id="tahun-sop"
                            type="text"
                            name="thn"
                            value="{{ old('thn', date('Y')) }}"
                            placeholder="2026"
                            inputmode="numeric"
                            maxlength="4"
                            class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200"
                        >
                    </div>

                    <div>
                        <label
                            for="urutan-sop"
                            class="mb-1.5 block text-sm font-medium text-ink-700"
                        >
                            Urutan
                        </label>

                        <input
                            id="urutan-sop"
                            type="number"
                            name="urut"
                            min="0"
                            value="{{ old('urut') }}"
                            placeholder="Otomatis"
                            class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200"
                        >
                    </div>

                </div>

                <p class="text-xs leading-relaxed text-ink-400">
                    Kosongkan urutan agar sistem menentukan urutan dokumen secara otomatis.
                </p>

                {{-- Tombol Upload --}}
                <button
                    type="submit"
                    class="flex w-full items-center justify-center gap-2 rounded-xl bg-hijau-700 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-hijau-800 hover:shadow-md"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 16.5V3.75m0 0L7.5 8.25M12 3.75l4.5 4.5M4.5 15.75v3A2.25 2.25 0 006.75 21h10.5a2.25 2.25 0 002.25-2.25v-3"/>
                    </svg>

                    Unggah Dokumen
                </button>

            </form>
        </div>

    </div>
@endsection
