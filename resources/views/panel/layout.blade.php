@php
    $pgn = auth()->user();
    $menu = collect(config('menu-panel'))
        ->filter(fn ($m) => empty($m['role']) || in_array($pgn->role, $m['role'], true));

    $labelRole = [
        'admin' => 'Admin / PPID',
        'kadis' => 'Kepala Dinas',
        'kabid' => 'Kepala Bidang',
        'teknis' => 'Tim Teknis',
    ];
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('judul', 'Dashboard') — Panel DKPP</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased" x-data="{ sidebarHp: false }">
    <div class="min-h-screen bg-hijau-50/30">
        {{-- sidebar --}}
        <aside
            class="fixed inset-y-0 left-0 z-40 w-64 transform bg-hijau-800 text-hijau-100 transition-transform lg:translate-x-0"
            :class="sidebarHp ? 'translate-x-0' : '-translate-x-full'"
        >
            <div class="flex h-16 items-center gap-3 border-b border-hijau-700 px-5">
                <span class="grid h-9 w-9 place-items-center rounded-lg bg-white/10 text-white">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 100-18 9 9 0 000 18zm0 0c-2 0-3-4-3-9s1-9 3-9m0 18c2 0 3-4 3-9s-1-9-3-9M3 12h18"/></svg>
                </span>
                <div class="leading-tight">
                    <p class="text-sm font-extrabold text-white">DKPP JEMBER</p>
                    <p class="text-[11px] text-hijau-300">Panel Petugas</p>
                </div>
            </div>

            <nav class="space-y-1 p-3">
                @foreach ($menu as $m)
                    @php $aktif = request()->routeIs($m['aktif']); @endphp
                    <a href="{{ route($m['route']) }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition {{ $aktif ? 'bg-white/15 text-white' : 'text-hijau-200 hover:bg-white/10 hover:text-white' }}">
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $m['ikon'] }}"/></svg>
                        {{ $m['judul'] }}
                    </a>
                @endforeach
            </nav>
        </aside>

        {{-- overlay mobile --}}
        <div x-show="sidebarHp" @click="sidebarHp = false" x-transition.opacity style="display:none;" class="fixed inset-0 z-30 bg-black/40 lg:hidden"></div>

        {{-- konten --}}
        <div class="lg:pl-64">
            {{-- topbar --}}
            <header class="sticky top-0 z-20 flex h-16 items-center justify-between border-b border-hijau-100 bg-white/90 px-4 backdrop-blur md:px-6">
                <div class="flex items-center gap-3">
                    <button @click="sidebarHp = !sidebarHp" class="grid h-10 w-10 place-items-center rounded-lg text-slate-600 transition hover:bg-hijau-50 lg:hidden">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                    </button>
                    <h1 class="text-lg font-bold text-slate-800">@yield('judul', 'Dashboard')</h1>
                </div>

                {{-- menu profil --}}
                <div class="relative" x-data="{ buka: false }" @click.outside="buka = false">
                    <button @click="buka = !buka" class="flex items-center gap-3 rounded-xl px-2 py-1.5 transition hover:bg-hijau-50">
                        <span class="grid h-9 w-9 place-items-center rounded-full bg-hijau-100 text-sm font-bold text-hijau-700">{{ strtoupper(substr($pgn->name, 0, 1)) }}</span>
                        <span class="hidden text-left sm:block">
                            <span class="block text-sm font-semibold leading-tight text-slate-700">{{ $pgn->name }}</span>
                            <span class="block text-xs text-slate-400">{{ $labelRole[$pgn->role] ?? $pgn->role }}</span>
                        </span>
                        <svg class="h-4 w-4 text-slate-400 transition" :class="buka && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                    </button>
                    <div x-show="buka" x-transition.origin.top.right style="display:none;" class="absolute right-0 mt-2 w-52 overflow-hidden rounded-xl border border-hijau-100 bg-white py-1 shadow-xl">
                        <a href="{{ route('panel.profil') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-600 transition hover:bg-hijau-50 hover:text-hijau-700">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Profil Saya
                        </a>
                        <a href="{{ route('beranda') }}" target="_blank" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-600 transition hover:bg-hijau-50 hover:text-hijau-700">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                            Lihat Situs
                        </a>
                        <form method="POST" action="{{ route('panel.keluar') }}" class="border-t border-hijau-100">
                            @csrf
                            <button class="flex w-full items-center gap-2 px-4 py-2.5 text-sm text-red-600 transition hover:bg-red-50">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/></svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            {{-- flash sukses --}}
            @if (session('sukses'))
                <div x-data="{ tampil: true }" x-show="tampil" x-init="setTimeout(() => tampil = false, 4000)" class="mx-4 mt-4 flex items-center gap-3 rounded-xl border border-hijau-200 bg-hijau-50 px-4 py-3 text-sm text-hijau-800 md:mx-6">
                    <svg class="h-5 w-5 shrink-0 text-hijau-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('sukses') }}</span>
                </div>
            @endif

            <main class="p-4 md:p-6">
                @yield('konten')
            </main>
        </div>
    </div>

    @stack('skrip')
</body>
</html>
