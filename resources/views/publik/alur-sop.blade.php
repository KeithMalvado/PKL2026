@extends('publik.layout')

@section('judul', $judul)

@section('konten')
    <x-hero-halaman :judul="$judul" ket="Dokumen Standar Operasional Prosedur dan standar pelayanan dalam format PDF." />

    <section class="mx-auto max-w-7xl px-4 py-16 md:px-6 md:py-20">
        <div class="flex flex-col gap-10 lg:flex-row">
            <x-sidebar-sub />

            <div class="min-w-0 flex-1">
                <div class="prose-dkpp mb-12 max-w-3xl" data-reveal>
                    {!! $isi !!}
                </div>

                @forelse ($dtDok as $jenis => $daftar)
                    @php
                        $gaya = match ($jenis) {
                            'standar' => ['bg' => 'from-sage-500 to-moss-500', 'chip' => 'from-sage-50 to-moss-50', 'teks' => 'text-sage-700'],
                            'sk' => ['bg' => 'from-emas-500 to-emas-700', 'chip' => 'from-emas-50 to-emas-100', 'teks' => 'text-emas-600'],
                            default => ['bg' => 'from-hijau-500 to-sage-500', 'chip' => 'from-hijau-50 to-sage-50', 'teks' => 'text-hijau-700'],
                        };
                    @endphp
                    <div class="mb-12" data-reveal>
                        <div class="mb-5 flex items-center gap-3">
                            <span class="grid h-10 w-10 place-items-center rounded-xl bg-gradient-to-br {{ $gaya['bg'] }} text-white shadow-md">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                            </span>
                            <div>
                                <h2 class="text-lg font-extrabold text-ink-900">{{ $daftar->first()->labelJenis() }}</h2>
                                <p class="text-xs text-ink-400">{{ $daftar->count() }} dokumen tersedia</p>
                            </div>
                        </div>

                        <div class="grid gap-3 sm:grid-cols-2">
                            @foreach ($daftar as $dok)
                                <a
                                    href="{{ \Illuminate\Support\Facades\Storage::url($dok->file) }}"
                                    target="_blank"
                                    rel="noopener"
                                    class="group flex items-start gap-3.5 rounded-2xl border border-hijau-100 bg-white p-4 shadow-sm transition duration-300 hover:-translate-y-0.5 hover:border-hijau-300 hover:shadow-lg"
                                >
                                    <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-gradient-to-br {{ $gaya['chip'] }} {{ $gaya['teks'] }} transition duration-300 group-hover:from-hijau-500 group-hover:to-sage-500 group-hover:text-white">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                    </span>
                                    <span class="min-w-0 flex-1">
                                        <span class="line-clamp-2 block text-[13.5px] font-semibold leading-snug text-ink-700 transition group-hover:text-hijau-700">{{ $dok->judul }}</span>
                                        <span class="mt-1.5 flex items-center gap-1.5 text-[11px] font-medium text-ink-400">
                                            <span class="rounded bg-ink-50 px-1.5 py-0.5">PDF</span>
                                            @if ($dok->thn) {{ $dok->thn }} @endif
                                        </span>
                                    </span>
                                    <span class="shrink-0 self-center text-hijau-600 transition group-hover:translate-x-0.5">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <x-kosong judul="Belum Ada Dokumen" ket="Dokumen SOP dan standar pelayanan akan ditampilkan di sini." />
                @endforelse
            </div>
        </div>
    </section>
@endsection
