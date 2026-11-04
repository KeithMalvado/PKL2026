@extends('publik.layout')

@section('judul', $judul)

@section('konten')
    <x-hero-halaman :judul="$judul" />

    <section class="mx-auto max-w-7xl px-4 py-14">
        <div class="flex flex-col gap-10 lg:flex-row">
            {{-- sidebar sub-menu (muncul bila halaman bagian dr kelompok) --}}
            <x-sidebar-sub />

            {{-- konten utama --}}
            <div class="min-w-0 flex-1" data-reveal>
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
    </section>
@endsection
