@extends('panel.layout')

@section('judul', 'Dokumen SOP')

@section('konten')
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="space-y-6 lg:col-span-2">
            @forelse ($dtDok as $jenis => $daftar)
                <div class="overflow-hidden rounded-2xl border border-hijau-100 bg-white shadow-sm">
                    <div class="border-b border-hijau-100 px-5 py-3">
                        <h2 class="text-sm font-bold text-ink-800">{{ $daftar->first()->labelJenis() }}</h2>
                    </div>

                    @foreach ($daftar as $dok)
                        <div class="flex items-center gap-3 border-b border-hijau-50 px-5 py-3 last:border-0">
                            <span class="grid h-9 w-9 shrink-0 place-items-center rounded-lg bg-red-50 text-red-500">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                            </span>
                            <div class="min-w-0 flex-1">
                                <p class="truncate text-sm font-semibold text-ink-700">{{ $dok->judul }}</p>
                                <p class="text-xs text-ink-400">Urut {{ $dok->urut }}{{ $dok->thn ? ' • ' . $dok->thn : '' }}</p>
                            </div>
                            <a href="{{ \Illuminate\Support\Facades\Storage::url($dok->file) }}" target="_blank" rel="noopener" class="shrink-0 text-xs font-semibold text-hijau-600 hover:text-hijau-700">Lihat</a>
                            <form method="POST" action="{{ route('panel.sop.hapus', $dok) }}" onsubmit="return confirm('Hapus dokumen ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="shrink-0 text-xs font-semibold text-red-500 hover:text-red-600">Hapus</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @empty
                <x-kosong judul="Belum Ada Dokumen" ket="Unggah SOP atau standar pelayanan dalam format PDF." />
            @endforelse
        </div>

        <div class="rounded-2xl border border-hijau-100 bg-white p-6 shadow-sm">
            <h2 class="mb-4 font-bold text-ink-800">Unggah Dokumen</h2>
            <form method="POST" action="{{ route('panel.sop.simpan') }}" enctype="multipart/form-data" class="space-y-3">
                @csrf
                <div>
                    <label class="mb-1 block text-sm font-medium text-ink-700">Judul</label>
                    <input type="text" name="judul" value="{{ old('judul') }}" class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                    @error('judul')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-ink-700">Jenis</label>
                    <select name="jenis" class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                        <option value="sop">SOP</option>
                        <option value="standar">Standar Pelayanan</option>
                        <option value="sk">Surat Keputusan</option>
                    </select>
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-ink-700">Berkas PDF</label>
                    <input type="file" name="file" accept=".pdf" class="w-full rounded-xl border border-hijau-200 bg-white px-3 py-2 text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-hijau-600 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-white">
                    @error('file')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-ink-700">Tahun</label>
                        <input type="text" name="thn" value="{{ old('thn', date('Y')) }}" class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-ink-700">Urutan</label>
                        <input type="number" name="urut" value="{{ old('urut') }}" class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                    </div>
                </div>
                <button class="w-full rounded-xl bg-hijau-700 px-4 py-3 text-sm font-semibold text-white transition hover:bg-hijau-800">Unggah</button>
            </form>
        </div>
    </div>
@endsection
