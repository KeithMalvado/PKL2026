

@extends('panel.layout')

@section('judul', 'Pengaturan Situs')

@section('konten')
    <form method="POST"
          action="{{ route('panel.pengaturan.simpan') }}"
          enctype="multipart/form-data"
          class="grid gap-6 lg:grid-cols-3">

        @csrf
        @method('PUT')

        {{-- KOLOM KIRI: PENGATURAN UTAMA --}}
        <div class="space-y-6 lg:col-span-2">

            {{-- 1. KONTAK CENTER --}}
            <div class="rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm">
                <h2 class="mb-4 font-bold text-ink-800">
                    Kontak Center
                </h2>

                <div class="grid gap-4 sm:grid-cols-2">

                    <div>
                        <label for="telp" class="mb-1 block text-sm font-medium text-ink-700">
                            Telepon Kantor
                        </label>
                        <input
                            type="text"
                            id="telp"
                            name="telp"
                            value="{{ old('telp', $setelan['kontak.telp'] ?? '') }}"
                            class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200"
                        >
                        @error('telp')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="wa" class="mb-1 block text-sm font-medium text-ink-700">
                            Nomor WhatsApp
                        </label>
                        <input
                            type="text"
                            id="wa"
                            name="wa"
                            value="{{ old('wa', $setelan['kontak.wa'] ?? '') }}"
                            class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200"
                        >
                        @error('wa')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="mb-1 block text-sm font-medium text-ink-700">
                            Email
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', $setelan['kontak.email'] ?? '') }}"
                            class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200"
                        >
                        @error('email')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="jam" class="mb-1 block text-sm font-medium text-ink-700">
                            Jam Layanan
                        </label>
                        <input
                            type="text"
                            id="jam"
                            name="jam"
                            value="{{ old('jam', $setelan['kontak.jam'] ?? '') }}"
                            class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200"
                        >
                        @error('jam')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="alamat" class="mb-1 block text-sm font-medium text-ink-700">
                            Alamat
                        </label>
                        <input
                            type="text"
                            id="alamat"
                            name="alamat"
                            value="{{ old('alamat', $setelan['kontak.alamat'] ?? '') }}"
                            class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200"
                        >
                        @error('alamat')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- 2. LAYANAN TERKAIT --}}
            <div class="rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm">

                <h2 class="mb-1 font-bold text-ink-800">
                    Layanan Terkait
                </h2>

                <p class="mb-4 text-sm text-ink-500">
                    Tautan eksternal yang tampil di navbar, footer, dan beranda.
                </p>

                <div class="space-y-4">

                    <div>
                        <label for="tautan_ppid" class="mb-1 block text-sm font-medium text-ink-700">
                            Portal PPID
                        </label>
                        <input
                            type="url"
                            id="tautan_ppid"
                            name="tautan_ppid"
                            value="{{ old('tautan_ppid', $setelan['tautan.ppid'] ?? '') }}"
                            class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200"
                        >
                        @error('tautan_ppid')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tautan_bkd" class="mb-1 block text-sm font-medium text-ink-700">
                            Layanan BKD
                        </label>
                        <input
                            type="url"
                            id="tautan_bkd"
                            name="tautan_bkd"
                            value="{{ old('tautan_bkd', $setelan['tautan.bkd'] ?? '') }}"
                            class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200"
                        >
                        @error('tautan_bkd')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tautan_sikeren" class="mb-1 block text-sm font-medium text-ink-700">
                            SIKEREN
                        </label>
                        <input
                            type="url"
                            id="tautan_sikeren"
                            name="tautan_sikeren"
                            value="{{ old('tautan_sikeren', $setelan['tautan.sikeren'] ?? '') }}"
                            class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200"
                        >
                        @error('tautan_sikeren')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="ppid_induk" class="mb-1 block text-sm font-medium text-ink-700">
                            PPID Induk (halaman Berita PPID)
                        </label>
                        <input
                            type="url"
                            id="ppid_induk"
                            name="ppid_induk"
                            value="{{ old('ppid_induk', $setelan['ppid.induk'] ?? '') }}"
                            class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200"
                        >
                        @error('ppid_induk')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- 3. MEDIA SOSIAL --}}
            <div class="rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm">

                <div class="mb-5">
                    <h2 class="mb-1 font-bold text-ink-800">
                        Media Sosial
                    </h2>

                    <p class="text-sm text-ink-500">
                        Kelola hyperlink akun resmi media sosial DKPPP Jember.
                        Tautan yang diisi akan ditampilkan melalui komponen media sosial pada website.
                    </p>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">

                    @foreach ([
                        'facebook' => 'Facebook',
                        'instagram' => 'Instagram',
                        'tiktok' => 'TikTok',
                        'youtube' => 'YouTube',
                    ] as $platform => $label)

                        @php
                            $field = 'sosmed_' . $platform;
                            $kunci = 'sosmed.' . $platform;
                        @endphp

                        <div>
                            <label
                                for="{{ $field }}"
                                class="mb-1 block text-sm font-medium text-ink-700"
                            >
                                {{ $label }}
                            </label>

                            <input
                                type="url"
                                id="{{ $field }}"
                                name="{{ $field }}"
                                value="{{ old($field, $setelan[$kunci] ?? '') }}"
                                placeholder="https://..."
                                maxlength="255"
                                class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200"
                            >

                            @error($field)
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    @endforeach

                </div>
            </div>

        </div>

        {{-- KOLOM KANAN: LOGO DAN TOMBOL SIMPAN --}}
        <div class="space-y-6">

            {{-- 4. LOGO SITUS --}}
            <div class="rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm">

                <h2 class="mb-2 font-bold text-ink-800">
                    Logo Situs
                </h2>

                <p class="mb-4 text-xs leading-relaxed text-ink-500">
                    Logo utama yang digunakan pada navbar, footer, dan halaman login.
                </p>

                <div class="grid place-items-center rounded-xl border border-hijau-100 bg-hijau-50/40 p-4">
                    <img
                        src="{{ $logo }}"
                        alt="Logo situs saat ini"
                        class="h-24 w-24 object-contain"
                    >
                </div>

                <input
                    type="file"
                    id="logo"
                    name="logo"
                    accept=".jpg,.jpeg,.png,.webp"
                    class="mt-4 w-full rounded-xl border border-hijau-200 bg-white px-3 py-2 text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-hijau-600 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-white"
                >

                <p class="mt-2 text-xs text-ink-400">
                    PNG/JPG/WebP, maksimal 1 MB. Disarankan gambar persegi.
                </p>

                @error('logo')
                    <p class="mt-1 text-xs text-red-500">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- 5. LOGO KHUSUS DKPPP --}}
            <div class="rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm">

                <h2 class="mb-2 font-bold text-ink-800">
                    Logo DKPPP
                </h2>

                <p class="mb-4 text-xs leading-relaxed text-ink-500">
                    Logo khusus yang ditampilkan di sebelah tulisan
                    "Layanan Digital Terpadu" pada halaman beranda.
                </p>

                <div class="grid min-h-36 place-items-center rounded-xl border border-hijau-100 bg-hijau-50/40 p-4">

                    @if ($logoDkppp)
                        <img
                            id="preview-logo-dkppp"
                            src="{{ $logoDkppp }}"
                            alt="Logo DKPPP saat ini"
                            class="h-28 w-28 rounded-lg bg-white object-contain"
                        >

                        <p
                            id="placeholder-logo-dkppp"
                            class="hidden text-center text-xs text-ink-500"
                        >
                            Belum ada logo DKPPP.
                        </p>
                    @else
                        <img
                            id="preview-logo-dkppp"
                            src=""
                            alt="Pratinjau logo DKPPP"
                            class="hidden h-28 w-28 rounded-lg bg-white object-contain"
                        >

                        <p
                            id="placeholder-logo-dkppp"
                            class="text-center text-xs text-ink-500"
                        >
                            Belum ada logo DKPPP yang diunggah.
                        </p>
                    @endif

                </div>

                <label
                    for="logo_dkppp"
                    class="mt-4 block text-sm font-medium text-ink-700"
                >
                    Unggah Logo DKPPP
                </label>

                <input
                    type="file"
                    id="logo_dkppp"
                    name="logo_dkppp"
                    accept=".jpg,.jpeg,.png,.webp"
                    class="mt-2 w-full rounded-xl border border-hijau-200 bg-white px-3 py-2 text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-hijau-600 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-white"
                >

                <p class="mt-2 text-xs leading-relaxed text-ink-400">
                    PNG/JPG/WebP, maksimal 1 MB.
                    Disarankan logo berbentuk persegi agar tampil proporsional.
                </p>

                @error('logo_dkppp')
                    <p class="mt-1 text-xs text-red-500">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- 6. SIMPAN PENGATURAN --}}
            <button
                type="submit"
                class="w-full rounded-xl bg-hijau-700 px-4 py-3 text-sm font-semibold text-white transition hover:bg-hijau-800"
            >
                Simpan Pengaturan
            </button>

        </div>

    </form>

    {{-- 7. HAPUS LOGO SITUS --}}
    @if ($setelan['logo'] ?? null)
        <form
            method="POST"
            action="{{ route('panel.pengaturan.logo-hapus') }}"
            class="mt-4 lg:w-1/3"
            onsubmit="return confirm('Kembalikan logo situs ke bawaan sistem?')"
        >
            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="w-full rounded-xl border border-red-200 bg-red-50 px-4 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-100"
            >
                Hapus Logo Situs Unggahan
            </button>
        </form>
    @endif

    {{-- 8. HAPUS LOGO DKPPP --}}
    {{-- Tombol aktif setelah route hapus logo DKPPP tersedia. --}}
    @if (($setelan['logo_dkppp'] ?? null) && \Illuminate\Support\Facades\Route::has('panel.pengaturan.logo-dkppp-hapus'))
        <form
            method="POST"
            action="{{ route('panel.pengaturan.logo-dkppp-hapus') }}"
            class="mt-4 lg:w-1/3"
            onsubmit="return confirm('Hapus logo DKPPP yang diunggah?')"
        >
            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="w-full rounded-xl border border-red-200 bg-red-50 px-4 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-100"
            >
                Hapus Logo DKPPP
            </button>
        </form>
    @endif

    {{-- Pratinjau logo DKPPP sebelum disimpan --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('logo_dkppp');
            const preview = document.getElementById('preview-logo-dkppp');
            const placeholder = document.getElementById('placeholder-logo-dkppp');

            if (!input || !preview || !placeholder) {
                return;
            }

            const gambarAwal = preview.getAttribute('src');
            let previewSementara = null;

            input.addEventListener('change', function () {
                if (previewSementara) {
                    URL.revokeObjectURL(previewSementara);
                    previewSementara = null;
                }

                const file = input.files && input.files[0];

                if (!file) {
                    preview.setAttribute('src', gambarAwal || '');
                    preview.classList.toggle('hidden', !gambarAwal);
                    placeholder.classList.toggle('hidden', !!gambarAwal);
                    return;
                }

                if (!file.type.startsWith('image/')) {
                    input.value = '';
                    return;
                }

                previewSementara = URL.createObjectURL(file);
                preview.src = previewSementara;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            });

            window.addEventListener('pagehide', function () {
                if (previewSementara) {
                    URL.revokeObjectURL(previewSementara);
                }
            });
        });
    </script>
@endsection
