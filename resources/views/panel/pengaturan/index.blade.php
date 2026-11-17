
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

            {{-- 3. MEDIA SOSIAL (FITUR BARU) --}}
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

                <h2 class="mb-4 font-bold text-ink-800">
                    Logo Situs
                </h2>

                <div class="grid place-items-center rounded-xl border border-hijau-100 bg-hijau-50/40 p-4">
                    <img
                        src="{{ $logo }}"
                        alt="Logo saat ini"
                        class="h-24 w-24 object-contain"
                    >
                </div>

                <input
                    type="file"
                    name="logo"
                    accept=".jpg,.jpeg,.png,.webp"
                    class="mt-4 w-full rounded-xl border border-hijau-200 bg-white px-3 py-2 text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-hijau-600 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-white"
                >

                <p class="mt-2 text-xs text-ink-400">
                    PNG/JPG, maksimal 1 MB. Disarankan gambar persegi.
                </p>

                @error('logo')
                    <p class="mt-1 text-xs text-red-500">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- 5. SIMPAN PENGATURAN --}}
            <button
                type="submit"
                class="w-full rounded-xl bg-hijau-700 px-4 py-3 text-sm font-semibold text-white transition hover:bg-hijau-800"
            >
                Simpan Pengaturan
            </button>

        </div>

    </form>

    {{-- 6. HAPUS LOGO UNGGAHAN --}}
    @if ($setelan['logo'] ?? null)
        <form
            method="POST"
            action="{{ route('panel.pengaturan.logo-hapus') }}"
            class="mt-4 lg:w-1/3"
            onsubmit="return confirm('Kembalikan logo ke bawaan sistem?')"
        >
            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="w-full rounded-xl border border-red-200 bg-red-50 px-4 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-100"
            >
                Hapus Logo Unggahan
            </button>
        </form>
    @endif

@endsection
