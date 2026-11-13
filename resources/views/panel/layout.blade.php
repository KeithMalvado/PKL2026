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
    <title>@yield('judul', 'Dashboard') - Panel DKPP</title>
    <link rel="icon" type="image/png" href="{{ logo_situs() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased" x-data="{ sidebarHp: false }">
    <div class="min-h-screen bg-ink-50">
        {{-- sidebar --}}
        <aside
            class="fixed inset-y-0 left-0 z-40 w-64 transform border-r border-white/10 bg-gradient-to-b from-hijau-800 via-hijau-900 to-ink-950 text-hijau-100 transition-transform duration-300 lg:translate-x-0"
            :class="sidebarHp ? 'translate-x-0' : '-translate-x-full'"
        >
            <div class="pola-titik pointer-events-none absolute inset-0 opacity-20"></div>

            <div class="relative flex h-16 items-center gap-3 border-b border-white/10 px-5">
                <span class="grid h-9 w-9 shrink-0 place-items-center rounded-xl bg-white/10 p-1 ring-1 ring-white/10">
                    <img src="{{ logo_situs() }}" alt="Logo DKPP" class="h-full w-full object-contain">
                </span>
                <div class="leading-tight">
                    <p class="text-sm font-extrabold tracking-tight text-white">DKPP JEMBER</p>
                    <p class="text-[11px] text-hijau-300">Panel Petugas</p>
                </div>
            </div>

            <nav class="relative space-y-1 overflow-y-auto p-3" style="max-height: calc(100vh - 4rem);">
                @foreach ($menu as $m)
                    @php $aktif = request()->routeIs($m['aktif']); @endphp
                    <a href="{{ route($m['route']) }}" class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-[13.5px] font-medium transition duration-300 {{ $aktif ? 'bg-gradient-to-r from-hijau-600/80 to-sage-600/60 text-white shadow-lg shadow-ink-950/30 ring-1 ring-white/10' : 'text-hijau-200/80 hover:bg-white/10 hover:text-white' }}">
                        <span class="grid h-7 w-7 shrink-0 place-items-center rounded-lg transition {{ $aktif ? 'bg-white/15 text-white' : 'bg-white/5 text-hijau-300 group-hover:bg-white/10 group-hover:text-white' }}">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $m['ikon'] }}"/></svg>
                        </span>
                        <span class="min-w-0 flex-1 truncate">{{ $m['judul'] }}</span>
                        @if ($aktif)
                            <span class="h-1.5 w-1.5 shrink-0 rounded-full bg-emas-400"></span>
                        @endif
                    </a>
                @endforeach
            </nav>
        </aside>

        {{-- overlay mobile --}}
        <div x-show="sidebarHp" @click="sidebarHp = false" x-transition.opacity style="display:none;" class="fixed inset-0 z-30 bg-ink-950/50 backdrop-blur-sm lg:hidden"></div>

        {{-- konten --}}
        <div class="lg:pl-64">
            {{-- topbar --}}
            <header class="sticky top-0 z-20 flex h-16 items-center justify-between border-b border-ink-200/70 bg-white/80 px-4 backdrop-blur-xl md:px-6">
                <div class="flex items-center gap-3">
                    <button @click="sidebarHp = !sidebarHp" class="grid h-10 w-10 place-items-center rounded-xl border border-ink-200 text-ink-600 transition hover:border-hijau-300 hover:bg-hijau-50 hover:text-hijau-700 lg:hidden">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                    </button>
                    <h1 class="min-w-0 truncate text-lg font-extrabold tracking-tight text-ink-900">@yield('judul', 'Dashboard')</h1>
                </div>

                <div class="flex items-center gap-1">
                    {{-- notifikasi --}}
                    <div class="relative" x-data="{ buka: false }" @click.outside="buka = false">
                        <button @click="buka = !buka" class="relative grid h-10 w-10 place-items-center rounded-xl text-ink-600 transition hover:bg-hijau-50 hover:text-hijau-700" aria-label="Notifikasi">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/></svg>
                            @if (count($notif ?? []))
                                <span class="absolute right-1.5 top-1.5 grid h-4 min-w-4 place-items-center rounded-full bg-red-500 px-1 text-[10px] font-bold text-white ring-2 ring-white">{{ count($notif) }}</span>
                            @endif
                        </button>
                        <div x-show="buka" x-transition.origin.top.right style="display:none;" class="absolute right-0 mt-2 w-80 overflow-hidden rounded-2xl border border-ink-200 bg-white shadow-xl shadow-ink-900/10">
                            <div class="border-b border-ink-100 px-4 py-3 text-sm font-bold text-ink-800">Notifikasi</div>
                            @forelse ($notif ?? [] as $n)
                                <a href="{{ $n['url'] }}" class="block border-b border-ink-50 px-4 py-3 transition last:border-0 hover:bg-hijau-50/60">
                                    <span class="flex items-start gap-2.5">
                                        <span class="mt-1.5 h-2 w-2 shrink-0 rounded-full {{ $n['warna'] === 'red' ? 'bg-red-500' : ($n['warna'] === 'sky' ? 'bg-moss-500' : 'bg-emas-500') }}"></span>
                                        <span>
                                            <span class="block text-sm font-semibold text-ink-700">{{ $n['judul'] }}</span>
                                            <span class="block text-xs text-ink-400">{{ $n['ket'] }}</span>
                                        </span>
                                    </span>
                                </a>
                            @empty
                                <p class="px-4 py-6 text-center text-sm text-ink-400">Tidak ada notifikasi baru.</p>
                            @endforelse
                        </div>
                    </div>

                    {{-- menu profil --}}
                    <div class="relative" x-data="{ buka: false }" @click.outside="buka = false">
                        <button @click="buka = !buka" class="flex items-center gap-2.5 rounded-xl px-2 py-1.5 transition hover:bg-hijau-50">
                            <span class="grid h-9 w-9 place-items-center rounded-xl bg-gradient-to-br from-hijau-600 to-sage-600 text-sm font-bold text-white shadow-md shadow-hijau-600/25">{{ strtoupper(substr($pgn->name, 0, 1)) }}</span>
                            <span class="hidden text-left sm:block">
                                <span class="block text-sm font-semibold leading-tight text-ink-700">{{ $pgn->name }}</span>
                                <span class="block text-[11px] text-ink-400">{{ $labelRole[$pgn->role] ?? $pgn->role }}</span>
                            </span>
                            <svg class="h-4 w-4 text-ink-400 transition" :class="buka && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                        </button>
                        <div x-show="buka" x-transition.origin.top.right style="display:none;" class="absolute right-0 mt-2 w-52 overflow-hidden rounded-2xl border border-ink-200 bg-white py-1 shadow-xl shadow-ink-900/10">
                            <a href="{{ route('panel.profil') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-ink-600 transition hover:bg-hijau-50 hover:text-hijau-700">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Profil Saya
                            </a>
                            <a href="{{ route('beranda') }}" target="_blank" class="flex items-center gap-2 px-4 py-2.5 text-sm text-ink-600 transition hover:bg-hijau-50 hover:text-hijau-700">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                                Lihat Situs
                            </a>
                            <form method="POST" action="{{ route('panel.keluar') }}" class="border-t border-ink-100">
                                @csrf
                                <button class="flex w-full items-center gap-2 px-4 py-2.5 text-sm text-red-600 transition hover:bg-red-50">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/></svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            {{-- flash sukses --}}
            @if (session('sukses'))
                <div x-data="{ tampil: true }" x-show="tampil" x-init="setTimeout(() => tampil = false, 4500)" x-transition.opacity class="mx-4 mt-4 flex items-center gap-3 rounded-2xl border border-hijau-200 bg-gradient-to-r from-hijau-50 to-sage-50 px-4 py-3 text-sm text-hijau-800 shadow-sm md:mx-6">
                    <svg class="h-5 w-5 shrink-0 text-hijau-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('sukses') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="mx-4 mt-4 flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 md:mx-6">
                    <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                    <span>{{ $errors->first() }}</span>
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
