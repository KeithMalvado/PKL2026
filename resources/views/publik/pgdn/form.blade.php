@extends('publik.layout')

@section('judul', 'Form Pengaduan Online')

@section('konten')
    <x-hero-halaman judul="Pengaduan Online" />

    <section class="mx-auto max-w-4xl px-4 py-16 md:px-6 md:py-20">
        {{-- notifikasi sukses: tampilkn kode tiket --}}
        @if (session('tiketBaru'))
            @php $tb = session('tiketBaru'); @endphp
            <div
                x-data="{ salin() { navigator.clipboard.writeText('{{ $tb['kd_tkt'] }}'); this.tersalin = true; setTimeout(() => this.tersalin = false, 2000) }, tersalin: false }"
                data-reveal
                class="mb-10 overflow-hidden rounded-2xl border border-hijau-200 bg-white shadow-lg"
            >
                <div class="gradasi-tema relative overflow-hidden px-6 py-8 text-center text-white">
                    <div class="pola-titik absolute inset-0 opacity-25"></div>
                    <div class="relative">
                        <span class="mx-auto grid h-16 w-16 place-items-center rounded-full bg-white/20">
                            <svg class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                        <h2 class="mt-4 text-xl font-bold">Pengaduan Berhasil Dikirim!</h2>
                        <p class="mt-1 text-sm text-hijau-100">Terima kasih {{ $tb['nama'] }}, pengaduan Anda telah kami terima.</p>
                    </div>
                </div>
                <div class="p-6 text-center">
                    <p class="text-sm text-ink-500">Kode Tiket Anda</p>
                    <div class="mt-2 flex items-center justify-center gap-3">
                        <span class="text-2xl font-extrabold tracking-wider text-hijau-700">{{ $tb['kd_tkt'] }}</span>
                        <button @click="salin()" class="grid h-9 w-9 place-items-center rounded-lg bg-hijau-50 text-hijau-600 transition hover:bg-hijau-100" title="Salin kode">
                            <svg x-show="!tersalin" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m11.25 5.5V11.25c0-4.46-3.243-8.161-7.5-8.876"/></svg>
                            <svg x-show="tersalin" style="display:none;" class="h-5 w-5 text-hijau-600" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        </button>
                    </div>
                    <div class="mt-4 rounded-xl bg-hijau-50 p-4 text-sm text-hijau-800">
                        <p><svg class="mr-1 inline h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>Kode tiket juga telah dikirim ke WhatsApp <span class="font-semibold">{{ $tb['no_telp'] }}</span> <span class="text-xs">(simulasi)</span></p>
                    </div>
                    <div class="mt-5 flex flex-wrap justify-center gap-3">
                        <a href="{{ route('pgdn.lacak') }}" class="rounded-xl bg-hijau-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-hijau-700">Lacak Status</a>
                        <a href="{{ route('pgdn.form') }}" class="rounded-xl border border-hijau-200 px-5 py-2.5 text-sm font-semibold text-hijau-700 transition hover:bg-hijau-50">Buat Pengaduan Lain</a>
                    </div>
                </div>
            </div>
        @endif

        {{-- info + tombol lacak --}}
        <div class="mb-8 flex flex-col items-start justify-between gap-4 rounded-2xl border border-hijau-100 bg-gradient-to-r from-hijau-50 via-white to-sage-50 p-5 shadow-sm sm:flex-row sm:items-center" data-reveal>
            <div class="flex items-start gap-3">
                <svg class="h-6 w-6 shrink-0 text-hijau-600" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>
                <p class="text-sm text-ink-600">Sudah pernah mengadu? Pantau perkembangan laporan Anda dengan kode tiket.</p>
            </div>
            <a href="{{ route('pgdn.lacak') }}" class="shrink-0 rounded-xl bg-white px-5 py-2.5 text-sm font-semibold text-hijau-700 shadow-sm transition hover:bg-hijau-50">Lacak Pengaduan</a>
        </div>

        {{-- form --}}
        <form method="POST" action="{{ route('pgdn.simpan') }}" enctype="multipart/form-data" class="rounded-3xl border border-hijau-100 bg-white p-6 shadow-lembut md:p-9" data-reveal data-delay="1">
            @csrf

            <h2 class="text-lg font-bold text-hijau-800">Data Pelapor</h2>
            <div class="mt-4 grid gap-5 md:grid-cols-2">
                <div>
                    <label class="mb-1 block text-sm font-medium text-ink-700">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_pelapor" value="{{ old('nama_pelapor') }}" required class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                    @error('nama_pelapor')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-ink-700">NIK (16 digit) <span class="text-red-500">*</span></label>
                    <input type="text" name="nik" value="{{ old('nik') }}" inputmode="numeric" maxlength="16" required class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                    @error('nik')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-ink-700">No. WhatsApp <span class="text-red-500">*</span></label>
                    <input type="text" name="no_telp" value="{{ old('no_telp') }}" placeholder="08xxxxxxxxxx" required class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                    @error('no_telp')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-ink-700">Email <span class="text-ink-400">(opsional)</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                    @error('email')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
            </div>

            <h2 class="mt-8 text-lg font-bold text-hijau-800">Isi Pengaduan</h2>
            <div class="mt-4 space-y-5">
                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-ink-700">Kategori <span class="text-red-500">*</span></label>
                        <select name="kat" required class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                            <option value="">&mdash; Pilih Kategori &mdash;</option>
                            @foreach ($dtKat as $kat)
                                <option value="{{ $kat }}" @selected(old('kat')===$kat)>{{ $kat }}</option>
                            @endforeach
                        </select>
                        @error('kat')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-ink-700">Lokasi Kejadian <span class="text-ink-400">(opsional)</span></label>
                        <input type="text" name="lokasi" value="{{ old('lokasi') }}" placeholder="Kecamatan / Desa" class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                        @error('lokasi')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-ink-700">Judul Pengaduan <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" value="{{ old('judul') }}" required class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                    @error('judul')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-ink-700">Uraian Pengaduan <span class="text-red-500">*</span></label>
                    <textarea name="isi" rows="5" required class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">{{ old('isi') }}</textarea>
                    @error('isi')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                {{-- unggah bukti --}}
                <div x-data="{ namaFile: [] }">
                    <label class="mb-1 block text-sm font-medium text-ink-700">Bukti Pendukung <span class="text-ink-400">(opsional, maks 3 file - jpg/png/pdf, 2MB/file)</span></label>
                    <label class="flex cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-hijau-200 bg-hijau-50/50 px-6 py-8 text-center transition hover:border-hijau-400 hover:bg-hijau-50">
                        <svg class="h-10 w-10 text-hijau-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                        <span class="mt-2 text-sm font-medium text-hijau-700">Klik untuk memilih berkas</span>
                        <span class="text-xs text-ink-400">atau seret ke sini</span>
                        <input type="file" name="bukti[]" multiple accept=".jpg,.jpeg,.png,.pdf" class="hidden" @change="namaFile = Array.from($event.target.files).map(f => f.name)">
                    </label>
                    <template x-if="namaFile.length">
                        <ul class="mt-2 space-y-1">
                            <template x-for="(nm, i) in namaFile" :key="i">
                                <li class="flex items-center gap-2 text-xs text-ink-600"><svg class="h-4 w-4 text-hijau-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75"/></svg><span x-text="nm"></span></li>
                            </template>
                        </ul>
                    </template>
                    @error('bukti.*')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    @error('bukti')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- captcha --}}
            <div class="mt-8 rounded-xl bg-hijau-50 p-5">
                <label class="mb-2 block text-sm font-medium text-ink-700">Verifikasi: Berapa hasil dari <span class="font-bold text-hijau-700">{{ $soalCaptcha }}</span>? <span class="text-red-500">*</span></label>
                <input type="number" name="captcha" required class="w-40 rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                @error('captcha')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="mt-8 flex items-center gap-3">
                <button type="submit" class="rounded-xl bg-hijau-600 px-8 py-3 text-sm font-semibold text-white shadow-md shadow-hijau-600/30 transition hover:-translate-y-0.5 hover:bg-hijau-700">Kirim Pengaduan</button>
                <button type="reset" class="rounded-xl border border-ink-200 px-6 py-3 text-sm font-semibold text-ink-500 transition hover:bg-ink-50">Reset</button>
            </div>
        </form>
    </section>
@endsection
