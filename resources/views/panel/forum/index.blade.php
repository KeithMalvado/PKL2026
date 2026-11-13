@extends('panel.layout')

@section('judul', 'Forum Konsultasi')

@section('konten')
    @if ($jumlahTunggu)
        <div class="mb-5 flex items-center gap-3 rounded-xl border border-emas-200 bg-emas-50 px-4 py-3 text-sm text-emas-800">
            <svg class="h-5 w-5 shrink-0 text-emas-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
            <span><strong>{{ $jumlahTunggu }}</strong> pertanyaan baru menunggu moderasi.</span>
        </div>
    @endif

    <form method="GET" class="mb-5 flex flex-wrap items-center gap-3 rounded-2xl border border-hijau-100 bg-white p-4 shadow-sm">
        <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari pertanyaan..." class="min-w-[200px] flex-1 rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
        <select name="sts" class="rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
            <option value="">Semua Status</option>
            @foreach (['tunggu' => 'Menunggu', 'tampil' => 'Tampil', 'tolak' => 'Ditolak'] as $k => $v)
                <option value="{{ $k }}" @selected(request('sts') === $k)>{{ $v }}</option>
            @endforeach
        </select>
        <button class="rounded-xl bg-hijau-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-hijau-700">Filter</button>
    </form>

    <div class="space-y-4">
        @forelse ($dtForum as $forum)
            <div class="rounded-2xl border border-hijau-100 bg-white p-5 shadow-sm">
                <div class="flex flex-wrap items-start justify-between gap-3">
                    <div class="min-w-0">
                        <h3 class="font-bold text-ink-800">{{ $forum->judul }}</h3>
                        <p class="text-xs text-ink-400">{{ $forum->nama }} &bull; {{ $forum->kat ?: 'Umum' }} &bull; {{ $forum->created_at->translatedFormat('d M Y H:i') }}</p>
                    </div>
                    <span class="shrink-0 rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $forum->sts === 'tampil' ? 'bg-hijau-100 text-hijau-700' : ($forum->sts === 'tolak' ? 'bg-red-100 text-red-600' : 'bg-emas-100 text-emas-700') }}">
                        {{ ucfirst($forum->sts) }}
                    </span>
                </div>

                <p class="mt-3 whitespace-pre-line text-sm text-ink-600">{{ $forum->pertanyaan }}</p>

                @foreach ($forum->balasan as $balas)
                    <div class="mt-3 rounded-xl border-l-4 border-hijau-400 bg-hijau-50/60 p-3">
                        <p class="text-xs font-semibold text-hijau-700">{{ $balas->petugas?->name ?? 'Petugas' }}</p>
                        <p class="mt-1 whitespace-pre-line text-sm text-ink-600">{{ $balas->isi }}</p>
                    </div>
                @endforeach

                <form method="POST" action="{{ route('panel.forum.jawab', $forum) }}" class="mt-4">
                    @csrf
                    <textarea name="isi" rows="3" maxlength="2000" required placeholder="Tulis jawaban..." class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200"></textarea>
                    <div class="mt-2 flex flex-wrap items-center gap-3">
                        <button class="rounded-xl bg-hijau-700 px-4 py-2 text-sm font-semibold text-white transition hover:bg-hijau-800">Jawab &amp; Tampilkan</button>

                        @if ($forum->sts !== 'tampil')
                            <button type="submit" form="tampil-{{ $forum->id }}" class="text-sm font-semibold text-hijau-600 hover:text-hijau-700">Tampilkan tanpa jawaban</button>
                        @endif
                    </div>
                </form>

                <form id="tampil-{{ $forum->id }}" method="POST" action="{{ route('panel.forum.tampil', $forum) }}" class="hidden">
                    @csrf
                    @method('PUT')
                </form>

                <form method="POST" action="{{ route('panel.forum.hapus', $forum) }}" class="mt-2" onsubmit="return confirm('Hapus pertanyaan ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="text-xs font-semibold text-red-500 hover:text-red-600">Hapus Pertanyaan</button>
                </form>
            </div>
        @empty
            <x-kosong judul="Belum Ada Pertanyaan" ket="Pertanyaan dari masyarakat akan muncul di sini." />
        @endforelse
    </div>

    <div class="mt-8">{{ $dtForum->links() }}</div>
@endsection
