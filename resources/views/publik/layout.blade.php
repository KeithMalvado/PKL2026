<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('judul', 'Beranda') - {{ config('app.name') }}</title>
    <meta name="description" content="@yield('deskripsi', 'Website Resmi Dinas Ketahanan Pangan, Peternakan, dan Perikanan Kabupaten Jember. Layanan informasi publik, data pangan, dan pengaduan online.')">
    <meta name="theme-color" content="#0d665b">

    <link rel="icon" type="image/png" href="{{ logo_situs() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white font-sans text-ink-700 antialiased">

    <a href="#konten-utama" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[100] focus:rounded-xl focus:bg-hijau-700 focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-white">
        Lompat ke konten
    </a>

    @include('publik.partial.navbar')

    <main id="konten-utama">
        @yield('konten')
    </main>

    @include('publik.partial.footer')

    {{-- tombol kembali ke atas --}}
    <button
        x-data="{ tampil: false }"
        x-init="window.addEventListener('scroll', () => tampil = window.scrollY > 500)"
        x-show="tampil"
        x-transition.opacity
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="fixed bottom-6 right-6 z-40 grid h-12 w-12 place-items-center rounded-2xl bg-ink-900/90 text-white shadow-xl shadow-ink-900/25 backdrop-blur transition hover:-translate-y-1 hover:bg-hijau-700"
        aria-label="Kembali ke atas"
        style="display: none;"
    >
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
        </svg>
    </button>

    @stack('skrip')
</body>
</html>
