@extends('publik.layout')

@section('judul', 'Forum Konsultasi')

@section('konten')
    <x-hero-halaman judul="Forum Konsultasi" induk="Layanan Publik" />

    <section class="mx-auto max-w-7xl px-4 py-14">
        <div class="flex flex-col gap-10 lg:flex-row">
            {{-- form ajukan pertanyaan --}}
            <div class="lg:w-96 lg:shrink-0" data-reveal="kiri">
                <div class="sticky top-24 rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-hijau-800">Ajukan Pertanyaan</h2>
                    <p class="mt-1 text-sm text-slate-500">Pertanyaan akan ditampilkan setelah dimoderasi dan dijawab petugas.</p>

                    @if (session('sukses'))
                        <div class="mt-4 flex items-start gap-3 rounded-xl border border-hijau-200 bg-hijau-50 p-4 text-sm text-hijau-800">
                            <svg class="h-5 w-5 shrink-0 text-hijau-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>{{ session('sukses') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('layanan.forum.simpan') }}" class="mt-5 space-y-4">
                        @csrf
                        <div>
                            <label class="mb-1 block text-sm font-medium text-slate-700">Nama <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" value="{{ old('nama') }}" required class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                            @error('nama')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium text-slate-700">Email <span class="text-slate-400">(opsional)</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                            @error('email')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium text-slate-700">Kategori</label>
                            <select name="kat" class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                                <option value="">— Pilih —</option>
                                <option value="Ketahanan Pangan" @selected(old('kat')==='Ketahanan Pangan')>Ketahanan Pangan</option>
                                <option value="Peternakan" @selected(old('kat')==='Peternakan')>Peternakan</option>
                                <option value="Perikanan" @selected(old('kat')==='Perikanan')>Perikanan</option>
                                <option value="Kesehatan Hewan" @selected(old('kat')==='Kesehatan Hewan')>Kesehatan Hewan</option>
                                <option value="Umum" @selected(old('kat')==='Umum')>Umum</option>
                            </select>
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium text-slate-700">Judul <span class="text-red-500">*</span></label>
                            <input type="text" name="judul" value="{{ old('judul') }}" required class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                            @error('judul')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium text-slate-700">Pertanyaan <span class="text-red-500">*</span></label>
                            <textarea name="pertanyaan" rows="4" required class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">{{ old('pertanyaan') }}</textarea>
                            @error('pertanyaan')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <button class="w-full rounded-xl bg-hijau-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-hijau-700">Kirim Pertanyaan</button>
                    </form>
                </div>
            </div>

            {{-- daftar tanya-jawab --}}
            <div class="min-w-0 flex-1">
                <form method="GET" class="mb-6 flex max-w-md gap-2" data-reveal>
                    <div class="relative flex-1">
                        <svg class="pointer-events-none absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                        <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari pertanyaan..." class="w-full rounded-xl border border-hijau-200 bg-white py-2.5 pl-10 pr-4 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                    </div>
                    <button class="rounded-xl bg-hijau-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-hijau-700">Cari</button>
                </form>

                @if ($dtForum->count())
                    <div class="space-y-5" x-data>
                        @foreach ($dtForum as $forum)
                            <div class="overflow-hidden rounded-2xl border border-hijau-100 bg-white shadow-sm" data-reveal>
                                {{-- pertanyaan --}}
                                <div class="p-5">
                                    <div class="flex items-start gap-3">
                                        <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-hijau-100 text-sm font-bold text-hijau-700">T</span>
                                        <div class="min-w-0">
                                            <h3 class="font-bold text-slate-800">{{ $forum->judul }}</h3>
                                            <div class="mt-1 flex flex-wrap items-center gap-2 text-xs text-slate-400">
                                                <span>{{ $forum->nama }}</span>
                                                <span>&bull;</span>
                                                <span>{{ $forum->created_at->translatedFormat('d M Y') }}</span>
                                                @if ($forum->kat)
                                                    <span class="rounded-full bg-hijau-50 px-2 py-0.5 font-medium text-hijau-600">{{ $forum->kat }}</span>
                                                @endif
                                            </div>
                                            <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $forum->pertanyaan }}</p>
                                        </div>
                                    </div>
                                </div>

                                {{-- jawaban petugas --}}
                                @forelse ($forum->balasan as $balas)
                                    <div class="border-t border-hijau-100 bg-hijau-50/50 p-5">
                                        <div class="flex items-start gap-3">
                                            <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-hijau-600 text-sm font-bold text-white">J</span>
                                            <div class="min-w-0">
                                                <div class="flex items-center gap-2 text-xs">
                                                    <span class="font-semibold text-hijau-700">{{ $balas->petugas?->name ?? 'Petugas DKPP' }}</span>
                                                    <span class="rounded-full bg-hijau-100 px-2 py-0.5 font-medium text-hijau-700">Petugas</span>
                                                </div>
                                                <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $balas->isi }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-8">{{ $dtForum->links() }}</div>
                @else
                    <x-kosong judul="Belum Ada Pertanyaan" ket="Jadilah yang pertama mengajukan pertanyaan melalui formulir di samping." />
                @endif
            </div>
        </div>
    </section>
@endsection
