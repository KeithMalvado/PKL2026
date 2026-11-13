@extends('publik.layout')

@section('judul', 'Inovasi Pelayanan')

@section('konten')
    <x-hero-halaman judul="Inovasi Pelayanan" induk="Layanan Publik" ket="Program dan terobosan pelayanan unggulan Dinas Ketahanan Pangan, Peternakan, dan Perikanan." />

    <section class="mx-auto max-w-7xl px-4 py-16 md:px-6 md:py-20">
        @if ($dtInov->count())
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($dtInov as $i => $inov)
                    <x-kartu-konten
                        :url="route('layanan.inovasi.detail', $inov)"
                        :judul="$inov->judul"
                        :ringkasan="$inov->ringkasan"
                        :gambar="$inov->gambar"
                        label="Inovasi"
                        :warna="['emas', 'hijau', 'sage', 'moss'][$i % 4]"
                        data-reveal
                        data-delay="{{ ($i % 3) + 1 }}"
                    />
                @endforeach
            </div>
            <div class="mt-12">{{ $dtInov->links() }}</div>
        @else
            <x-kosong judul="Belum Ada Inovasi" ket="Program inovasi pelayanan akan ditampilkan di sini." />
        @endif
    </section>
@endsection
