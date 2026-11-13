@extends('panel.layout')

@section('judul', 'Bidang')

@section('konten')
    <div class="grid gap-6 md:grid-cols-2">
        @foreach ($dtBdg as $bdg)
            @php $logo = logo_bdg($bdg); @endphp
            <div class="rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm">
                <div class="flex items-center gap-4">
                    <span class="grid h-16 w-16 shrink-0 place-items-center rounded-xl border border-hijau-100 bg-hijau-50/50 p-2">
                        @if ($logo)
                            <img src="{{ $logo }}" alt="Logo {{ $bdg->nama }}" class="h-full w-full object-contain">
                        @else
                            <svg class="h-8 w-8 text-hijau-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/></svg>
                        @endif
                    </span>
                    <div class="min-w-0">
                        <h3 class="font-bold text-ink-800">{{ $bdg->nama }}</h3>
                        <p class="text-xs text-ink-400">{{ $bdg->kode }} &bull; {{ $bdg->slug }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('panel.bidang.perbarui', $bdg) }}" enctype="multipart/form-data" class="mt-5 space-y-3">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="mb-1 block text-sm font-medium text-ink-700">Logo Bidang</label>
                        <input type="file" name="logo" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-xl border border-hijau-200 bg-white px-3 py-2 text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-hijau-600 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-white">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-ink-700">Deskripsi Singkat</label>
                        <textarea name="deskripsi" rows="3" maxlength="500" class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">{{ old('deskripsi', $bdg->deskripsi) }}</textarea>
                    </div>
                    <button class="w-full rounded-xl bg-hijau-700 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-hijau-800">Simpan</button>
                </form>

                @if ($bdg->logo)
                    <form method="POST" action="{{ route('panel.bidang.logo-hapus', $bdg) }}" class="mt-2" onsubmit="return confirm('Hapus logo bidang ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="w-full rounded-xl border border-red-200 bg-red-50 px-4 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-100">Hapus Logo</button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
@endsection
