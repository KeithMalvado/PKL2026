@extends('publik.layout')

@section('judul', $judul)

@section('konten')
    <x-hero-halaman :judul="$judul" induk="Profil" ket="Bagan struktur organisasi Dinas Ketahanan Pangan, Peternakan, dan Perikanan Kabupaten Jember." />

    <section class="mx-auto max-w-7xl px-4 py-16 md:px-6 md:py-20">
        <div class="flex flex-col gap-10 lg:flex-row">
            <x-sidebar-sub />

            <div class="min-w-0 flex-1">
                {{-- deskripsi singkat --}}
                <div class="prose-dkpp mb-10 max-w-3xl" data-reveal>
                    {!! $isi !!}
                </div>

                {{-- bagan struktur organisasi (gambar) --}}
                <div data-reveal data-delay="1">
                    <div class="mb-5 flex items-center gap-3">
                        <span class="grid h-10 w-10 place-items-center rounded-xl bg-gradient-to-br from-hijau-600 to-sage-600 text-white shadow-md">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6z"/></svg>
                        </span>
                        <div>
                            <h2 class="text-lg font-extrabold text-ink-900">Bagan Struktur Organisasi</h2>
                            <p class="text-xs text-ink-400">Klik bagan untuk memperbesar.</p>
                        </div>
                    </div>

                    @if (!empty($gambar))
                        <div
                            x-data="{ zoom: false }"
                            class="group overflow-hidden rounded-3xl border border-hijau-100 bg-gradient-to-br from-hijau-50/60 via-white to-sage-50/50 p-2 shadow-lembut md:p-3"
                        >
                            <img
                                src="{{ \Illuminate\Support\Facades\Storage::url($gambar) }}"
                                alt="Bagan Struktur Organisasi DKPP Jember"
                                @click="zoom = true"
                                class="w-full cursor-zoom-in rounded-2xl transition duration-500 group-hover:scale-[1.01]"
                            >

                            {{-- lightbox sederhana --}}
                            <div
                                x-show="zoom"
                                x-transition.opacity
                                @click="zoom = false"
                                @keydown.escape.window="zoom = false"
                                style="display:none;"
                                class="fixed inset-0 z-[60] grid place-items-center bg-ink-950/90 p-4 backdrop-blur-sm"
                            >
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($gambar) }}" alt="Bagan Struktur Organisasi" class="max-h-[90vh] max-w-full rounded-2xl shadow-2xl">
                                <button @click="zoom = false" class="absolute right-5 top-5 grid h-11 w-11 place-items-center rounded-full bg-white/10 text-white backdrop-blur transition hover:bg-white/25" aria-label="Tutup">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </div>
                    @else
                        {{-- fallback bila bagan belum diunggah --}}
                        <div class="grid place-items-center rounded-3xl border border-dashed border-hijau-200 bg-gradient-to-br from-hijau-50/70 via-white to-sage-50/60 px-6 py-20 text-center">
                            <span class="animasi-mengambang grid h-16 w-16 place-items-center rounded-2xl bg-white text-hijau-500 shadow-md">
                                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/></svg>
                            </span>
                            <h3 class="mt-5 text-lg font-bold text-hijau-900">Bagan Belum Diunggah</h3>
                            <p class="mt-1.5 max-w-sm text-sm text-ink-500">Gambar bagan struktur organisasi akan ditampilkan di sini setelah diunggah melalui panel admin.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
