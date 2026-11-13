@extends('publik.layout')

@section('judul', $judul)

@section('konten')
    <x-hero-halaman :judul="$judul" />

    <section class="mx-auto max-w-7xl px-4 py-16 md:px-6 md:py-20">
        <div class="flex flex-col gap-10 lg:flex-row">
            {{-- sidebar sub-menu (muncul bila halaman bagian dr kelompok) --}}
            <x-sidebar-sub />

            {{-- konten utama --}}
            <div class="min-w-0 flex-1" data-reveal>
                <div class="rounded-3xl border border-hijau-100 bg-white p-6 shadow-lembut md:p-10">
                    @if (!empty($gambar))
                        <img
                            src="{{ \Illuminate\Support\Facades\Storage::url($gambar) }}"
                            alt="{{ $judul }}"
                            class="mb-8 w-full rounded-2xl border border-hijau-100 object-cover shadow-sm"
                        >
                    @endif

                    <article class="prose-dkpp">
                        {!! $isi !!}
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection
