@extends('publik.layout')

@section('judul', 'Survei Kepuasan Masyarakat')

@section('konten')
    <x-hero-halaman judul="Survei Kepuasan Masyarakat" ket="Penilaian Anda membantu kami meningkatkan kualitas pelayanan." />

    <section class="mx-auto max-w-2xl px-4 py-16 md:px-6 md:py-20">
        <div class="rounded-3xl border border-hijau-100 bg-white p-6 shadow-lembut md:p-9" data-reveal>
            <div class="rounded-2xl bg-gradient-to-r from-hijau-50 to-sage-50 p-4 ring-1 ring-hijau-100">
                <p class="text-[11px] font-bold uppercase tracking-[0.14em] text-hijau-600">Pengaduan</p>
                <p class="mt-1 font-bold text-ink-800">{{ $pgdn->judul }}</p>
                <p class="text-xs text-ink-400">{{ $pgdn->kd_tkt }} &bull; {{ $pgdn->tgl_selesai?->translatedFormat('d M Y') }}</p>
            </div>

            @if (session('sukses') || $sudahIsi)
                <div class="mt-6 flex items-start gap-3 rounded-2xl border border-hijau-200 bg-gradient-to-r from-hijau-50 to-sage-50 p-5 text-sm text-hijau-800">
                    <svg class="h-6 w-6 shrink-0 text-hijau-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <div>
                        <p class="font-bold">Terima kasih!</p>
                        <p class="mt-1 leading-relaxed">{{ session('sukses') ?? (session('info') ?? 'Anda sudah mengisi survei untuk pengaduan ini. Masukan Anda sangat berarti bagi kami.') }}</p>
                    </div>
                </div>
            @else
                <form method="POST" action="{{ route('skm.simpan', $token) }}" class="mt-6">
                    @csrf

                    <fieldset>
                        <legend class="text-sm font-semibold text-ink-700">Seberapa puas Anda dengan pelayanan kami?</legend>
                        <div class="mt-4 grid grid-cols-5 gap-1.5 sm:gap-2" x-data="{ pilih: {{ old('skor', 0) }} }">
                            @foreach ([1 => 'Sangat kurang', 2 => 'Kurang', 3 => 'Cukup', 4 => 'Baik', 5 => 'Sangat baik'] as $nilai => $label)
                                <label class="cursor-pointer">
                                    <input type="radio" name="skor" value="{{ $nilai }}" class="peer sr-only" x-model="pilih" @checked(old('skor') == $nilai)>
                                    <span class="flex flex-col items-center gap-1.5 rounded-2xl border border-ink-200 bg-white px-2 py-3 text-center transition hover:border-hijau-300 hover:bg-hijau-50 peer-checked:border-hijau-500 peer-checked:bg-gradient-to-br peer-checked:from-hijau-50 peer-checked:to-sage-50 peer-checked:ring-2 peer-checked:ring-hijau-200">
                                        <svg class="h-6 w-6 text-ink-200 transition" :class="pilih >= {{ $nilai }} ? 'text-emas-400' : 'text-ink-200'" fill="currentColor" viewBox="0 0 24 24"><path d="M11.48 3.5a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.563.563 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                                        <span class="text-[11px] font-semibold leading-tight text-ink-500" :class="pilih >= {{ $nilai }} ? 'text-hijau-700' : 'text-ink-500'">{{ $nilai }}</span>
                                        <span class="hidden text-[10px] leading-tight text-ink-400 sm:block">{{ $label }}</span>
                                    </span>
                                </label>
                            @endforeach
                        </div>
                        @error('skor')<p class="mt-2 text-xs text-red-500">{{ $message }}</p>@enderror
                    </fieldset>

                    <div class="mt-6">
                        <label class="mb-1.5 block text-sm font-semibold text-ink-700">Saran / Masukan <span class="font-normal text-ink-400">(opsional)</span></label>
                        <textarea name="saran" rows="4" maxlength="1000" class="w-full rounded-xl border border-ink-200 bg-white px-4 py-3 text-sm outline-none transition placeholder:text-ink-300 focus:border-hijau-400 focus:ring-4 focus:ring-hijau-100" placeholder="Tulis masukan Anda...">{{ old('saran') }}</textarea>
                        @error('saran')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>

                    <button class="mt-6 w-full rounded-xl bg-gradient-to-r from-hijau-600 to-sage-600 px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-hijau-600/20 transition hover:-translate-y-0.5 hover:shadow-xl">Kirim Penilaian</button>
                </form>
            @endif
        </div>
    </section>
@endsection
