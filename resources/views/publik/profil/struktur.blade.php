@extends('publik.layout')

@section('judul', $judul)

@section('konten')
    <x-hero-halaman :judul="$judul" induk="Profil" />

    <section class="mx-auto max-w-7xl px-4 py-14">
        <div class="flex flex-col gap-10 lg:flex-row">
            <x-sidebar-sub />

            <div class="min-w-0 flex-1">
                {{-- deskripsi singkat --}}
                <div class="prose-dkpp mb-8" data-reveal>
                    {!! $isi !!}
                </div>

                {{-- bagan struktur organisasi (gambar) --}}
                <div data-reveal data-delay="1">
                    <h2 class="mb-4 text-lg font-bold text-hijau-800">Bagan Struktur Organisasi</h2>

                    @if (!empty($gambar))
                        <div
                            x-data="{ zoom: false }"
                            class="overflow-hidden rounded-2xl border border-hijau-100 bg-white p-3 shadow-sm"
                        >
                            <img
                                src="{{ \Illuminate\Support\Facades\Storage::url($gambar) }}"
                                alt="Bagan Struktur Organisasi DKPP Jember"
                                @click="zoom = true"
                                class="w-full cursor-zoom-in rounded-xl transition hover:opacity-95"
                            >

                            {{-- lightbox sederhana --}}
                            <div
                                x-show="zoom"
                                x-transition.opacity
                                @click="zoom = false"
                                @keydown.escape.window="zoom = false"
                                style="display:none;"
                                class="fixed inset-0 z-[60] grid place-items-center bg-black/80 p-4"
                            >
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($gambar) }}" alt="Bagan Struktur Organisasi" class="max-h-[90vh] max-w-full rounded-lg">
                                <button @click="zoom = false" class="absolute right-5 top-5 grid h-11 w-11 place-items-center rounded-full bg-white/10 text-white backdrop-blur transition hover:bg-white/20" aria-label="Tutup">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-slate-400">Klik gambar untuk memperbesar.</p>
                    @else
                        {{-- fallback bila bagan belum diunggah --}}
                        <div class="grid place-items-center rounded-2xl border-2 border-dashed border-hijau-200 bg-hijau-50/50 px-6 py-16 text-center">
                            <span class="grid h-16 w-16 place-items-center rounded-2xl bg-hijau-100 text-hijau-500">
                                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                            </span>
                            <h3 class="mt-4 font-bold text-hijau-800">Bagan Belum Diunggah</h3>
                            <p class="mt-1 text-sm text-slate-500">Gambar bagan struktur organisasi akan ditampilkan di sini setelah diunggah melalui panel admin.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
