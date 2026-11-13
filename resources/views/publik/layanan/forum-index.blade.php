@extends('publik.layout')

@section('judul', 'Forum Konsultasi')

@section('konten')
    <x-hero-halaman judul="Forum Konsultasi" induk="Layanan Publik" ket="Tanyakan seputar pangan, peternakan, dan perikanan. Pertanyaan akan dijawab petugas setelah dimoderasi." />

    <section class="mx-auto max-w-5xl px-4 py-16 md:px-6 md:py-20">
        @if (session('sukses'))
            <div class="mb-8 flex items-start gap-3 rounded-2xl border border-hijau-200 bg-gradient-to-r from-hijau-50 to-sage-50 p-4 text-sm text-hijau-800" data-reveal>
                <svg class="h-5 w-5 shrink-0 text-hijau-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ session('sukses') }}</span>
            </div>
        @endif

        {{-- form tanya --}}
        <div class="relative overflow-hidden rounded-3xl border border-hijau-100 bg-gradient-to-br from-hijau-50 via-white to-sage-50 p-6 shadow-lembut md:p-8" data-reveal>
            <div class="pola-titik-gelap absolute inset-0 opacity-40"></div>
            <div class="relative">
                <div class="flex items-center gap-3">
                    <span class="grid h-11 w-11 place-items-center rounded-2xl bg-gradient-to-br from-hijau-600 to-sage-600 text-white shadow-md">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    </span>
                    <div>
                        <h2 class="text-lg font-bold text-hijau-900">Ajukan Pertanyaan</h2>
                        <p class="text-sm text-ink-500">Pertanyaan ditampilkan setelah dimoderasi dan dijawab petugas.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('layanan.forum.simpan') }}" class="mt-6 grid gap-4 sm:grid-cols-2">
                    @csrf
                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-ink-700">Nama</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" required maxlength="100" class="w-full rounded-xl border border-ink-200 bg-white px-4 py-2.5 text-sm outline-none transition placeholder:text-ink-300 focus:border-hijau-400 focus:ring-4 focus:ring-hijau-100">
                        @error('nama')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-ink-700">Email <span class="font-normal text-ink-400">(opsional)</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" maxlength="150" class="w-full rounded-xl border border-ink-200 bg-white px-4 py-2.5 text-sm outline-none transition placeholder:text-ink-300 focus:border-hijau-400 focus:ring-4 focus:ring-hijau-100">
                        @error('email')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label class="mb-1.5 block text-sm font-semibold text-ink-700">Judul</label>
                        <input type="text" name="judul" value="{{ old('judul') }}" required maxlength="150" class="w-full rounded-xl border border-ink-200 bg-white px-4 py-2.5 text-sm outline-none transition placeholder:text-ink-300 focus:border-hijau-400 focus:ring-4 focus:ring-hijau-100">
                        @error('judul')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label class="mb-1.5 block text-sm font-semibold text-ink-700">Kategori</label>
                        <select name="kat" class="w-full rounded-xl border border-ink-200 bg-white px-4 py-2.5 text-sm outline-none focus:border-hijau-400 focus:ring-4 focus:ring-hijau-100">
                            <option value="">Umum</option>
                            @foreach (['Ketahanan Pangan', 'Peternakan', 'Perikanan', 'Kesehatan Hewan'] as $kat)
                                <option value="{{ $kat }}" @selected(old('kat') === $kat)>{{ $kat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="mb-1.5 block text-sm font-semibold text-ink-700">Pertanyaan</label>
                        <textarea name="pertanyaan" rows="4" required minlength="10" maxlength="2000" class="w-full rounded-xl border border-ink-200 bg-white px-4 py-2.5 text-sm outline-none transition placeholder:text-ink-300 focus:border-hijau-400 focus:ring-4 focus:ring-hijau-100">{{ old('pertanyaan') }}</textarea>
                        @error('pertanyaan')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="sm:col-span-2">
                        <button class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-hijau-600 to-sage-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-hijau-600/20 transition hover:-translate-y-0.5 hover:shadow-xl">
                            Kirim Pertanyaan
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- daftar tanya --}}
        <div class="mt-14">
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-xl font-extrabold text-ink-900 md:text-2xl">Pertanyaan Terjawab</h2>
                <form method="GET" class="flex w-full gap-2 sm:w-auto"><div class="relative min-w-0 flex-1 sm:w-64 sm:flex-none">
                        <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-ink-300" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                        <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari pertanyaan..." class="w-full rounded-xl border border-ink-200 bg-white py-2 pl-10 pr-3 text-sm outline-none transition placeholder:text-ink-300 focus:border-hijau-400 focus:ring-4 focus:ring-hijau-100">
                    </div>
                    <button class="rounded-xl border border-ink-200 bg-white px-4 py-2 text-sm font-semibold text-ink-600 transition hover:border-hijau-300 hover:text-hijau-700">Cari</button>
                </form>
            </div>

            @forelse ($dtForum as $i => $forum)
                <div class="mb-4 overflow-hidden rounded-2xl border border-hijau-100 bg-white shadow-lembut transition hover:border-hijau-300" data-reveal data-delay="{{ ($i % 3) + 1 }}">
                    <div class="p-5 md:p-6">
                        <div class="flex flex-wrap items-center gap-2">
                            @if ($forum->kat)
                                <span class="rounded-full bg-gradient-to-r from-hijau-100 to-sage-100 px-2.5 py-1 text-[11px] font-bold uppercase tracking-wide text-hijau-700">{{ $forum->kat }}</span>
                            @endif
                            <span class="text-xs text-ink-400">{{ $forum->created_at->translatedFormat('d M Y') }}</span>
                        </div>
                        <h3 class="mt-2.5 text-[17px] font-bold text-ink-800">{{ $forum->judul }}</h3>
                        <p class="mt-2 whitespace-pre-line text-sm leading-relaxed text-ink-500">{{ $forum->pertanyaan }}</p>
                        <p class="mt-3 text-xs font-medium text-ink-400">&mdash; {{ $forum->nama }}</p>

                        @foreach ($forum->balasan as $balas)
                            <div class="mt-4 rounded-r-2xl border-l-4 border-hijau-400 bg-gradient-to-r from-hijau-50 to-sage-50/40 p-4">
                                <p class="flex items-center gap-2 text-xs font-bold text-hijau-700">
                                    <span class="grid h-6 w-6 place-items-center rounded-full bg-hijau-600 text-[10px] text-white">DK</span>
                                    {{ $balas->petugas?->name ?? 'Petugas DKPP' }}
                                </p>
                                <p class="mt-2 whitespace-pre-line text-sm leading-relaxed text-ink-600">{{ $balas->isi }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <x-kosong judul="Belum Ada Pertanyaan" ket="Pertanyaan yang telah dimoderasi akan tampil di sini." />
            @endforelse

            <div class="mt-10">{{ $dtForum->links() }}</div>
        </div>
    </section>
@endsection
