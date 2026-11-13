@extends('publik.layout')

@section('judul', $judul)

@section('konten')
    <x-hero-halaman :judul="$judul" induk="Profil" ket="Sambutan Kepala Dinas Ketahanan Pangan, Peternakan, dan Perikanan Kabupaten Jember." />

    <section class="mx-auto max-w-7xl px-4 py-16 md:px-6 md:py-20">
        <div class="flex flex-col gap-10 lg:flex-row">
            <x-sidebar-sub />

            <div class="min-w-0 flex-1">
                <div class="grid gap-8 md:grid-cols-[220px_1fr] md:items-start lg:grid-cols-[240px_1fr]">
                    {{-- foto kadis --}}
                    <div data-reveal="kiri" class="mx-auto w-full max-w-[220px] lg:max-w-[240px]">
                        <div class="group relative overflow-hidden rounded-3xl border border-hijau-100 bg-gradient-to-br from-hijau-50 to-sage-50 p-1.5 shadow-angkat">
                            <div class="overflow-hidden rounded-[1.35rem]">
                                @if (!empty($gambar))
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($gambar) }}" alt="Kepala Dinas" class="aspect-[3/4] w-full object-cover transition duration-700 group-hover:scale-105">
                                @else
                                    <div class="grid aspect-[3/4] w-full place-items-center bg-white/60 text-hijau-300">
                                        <svg class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="mt-4 rounded-2xl bg-gradient-to-r from-hijau-600 to-sage-600 px-4 py-3 text-center text-white shadow-lg shadow-hijau-600/20">
                            <p class="text-sm font-bold">Kepala Dinas</p>
                            <p class="text-xs text-hijau-100">DKPP Kabupaten Jember</p>
                        </div>
                    </div>

                    {{-- isi sambutan --}}
                    <div data-reveal="kanan" data-delay="1">
                        <span class="inline-flex items-center gap-2 rounded-full border border-hijau-200 bg-white px-4 py-1.5 text-xs font-bold uppercase tracking-[0.12em] text-hijau-700 shadow-sm">
                            <svg class="h-4 w-4 text-hijau-500" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                            Sambutan
                        </span>
                        <div class="prose-dkpp mt-6 rounded-3xl border border-hijau-100 bg-white p-6 shadow-lembut md:p-8">
                            {!! $isi !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
