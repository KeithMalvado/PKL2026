@extends('publik.layout')

@section('judul', 'Inovasi Pelayanan')

@section('konten')
    <x-hero-halaman judul="Inovasi Pelayanan" induk="Layanan Publik" />

    <section class="mx-auto max-w-7xl px-4 py-14">
        @if ($dtInov->count())
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($dtInov as $inov)
                    <x-kartu-konten
                        :url="route('layanan.inovasi.detail', $inov)"
                        :judul="$inov->judul"
                        :ringkasan="$inov->ringkasan"
                        :gambar="$inov->gambar"
                        label="Inovasi"
                        data-reveal
                    />
                @endforeach
            </div>
            <div class="mt-10">{{ $dtInov->links() }}</div>
        @else
            <x-kosong judul="Belum Ada Inovasi" ket="Program inovasi pelayanan akan ditampilkan di sini." />
        @endif
    </section>
@endsection
