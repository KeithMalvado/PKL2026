<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Portal Petugas - {{ config('app.name') }}</title>
    <link rel="icon" type="image/png" href="{{ logo_situs() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="grid min-h-screen lg:grid-cols-2">
        {{-- panel kiri: brand --}}
        <div class="gradasi-hero relative hidden overflow-hidden lg:block">
            <div class="absolute -right-24 -top-24 h-96 w-96 rounded-full bg-white/10 blur-3xl"></div>
            <div class="absolute -bottom-32 -left-16 h-96 w-96 rounded-full bg-hijau-400/20 blur-3xl animasi-mengambang"></div>
            <div class="pola-titik absolute inset-0 opacity-30"></div>
            <div class="relative flex h-full flex-col justify-between p-12 text-white">
                <div class="flex items-center gap-3">
                    <span class="grid h-12 w-12 shrink-0 place-items-center rounded-xl bg-white/15 p-1.5 backdrop-blur">
                        <img src="{{ logo_situs() }}" alt="Logo DKPP" class="h-full w-full object-contain">
                    </span>
                    <div>
                        <p class="font-extrabold">DKPP JEMBER</p>
                        <p class="text-xs text-hijau-200">Portal Internal Petugas</p>
                    </div>
                </div>
                <div>
                    <h1 class="text-3xl font-extrabold leading-tight">Sistem Pengelolaan<br>Pengaduan &amp; Konten</h1>
                    <p class="mt-4 max-w-md text-hijau-100">Area khusus petugas Dinas Ketahanan Pangan, Peternakan, dan Perikanan Kabupaten Jember.</p>
                </div>
                <p class="text-xs text-hijau-300">&copy; {{ date('Y') }} DKPP Kabupaten Jember</p>
            </div>
        </div>

        {{-- panel kanan: form --}}
        <div class="gradasi-lembut flex items-center justify-center p-6">
            <div class="w-full max-w-md" data-reveal>
                <div class="mb-8 text-center lg:hidden">
                    <span class="mx-auto grid h-14 w-14 place-items-center rounded-xl bg-hijau-600 p-2 text-white">
                        <img src="{{ logo_situs() }}" alt="Logo DKPP" class="h-full w-full object-contain">
                    </span>
                </div>

                <div class="rounded-3xl border border-hijau-100 bg-white p-8 shadow-angkat">
                    <h2 class="text-2xl font-extrabold text-ink-800">Masuk</h2>
                    <p class="mt-1 text-sm text-ink-500">Silakan masuk menggunakan akun petugas Anda.</p>

                    @if ($errors->any())
                        <div class="mt-5 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                            <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                            <span>{{ $errors->first() }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('panel.masuk') }}" class="mt-6 space-y-5">
                        @csrf
                        <div>
                            <label class="mb-1 block text-sm font-medium text-ink-700">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                        </div>
                        <div x-data="{ lihat: false }">
                            <label class="mb-1 block text-sm font-medium text-ink-700">Kata Sandi</label>
                            <div class="relative">
                                <input :type="lihat ? 'text' : 'password'" name="password" required class="w-full rounded-xl border border-hijau-200 bg-white px-4 py-2.5 pr-11 text-sm outline-none transition focus:border-hijau-500 focus:ring-2 focus:ring-hijau-200">
                                <button type="button" @click="lihat = !lihat" class="absolute right-3 top-1/2 -translate-y-1/2 text-ink-400 transition hover:text-hijau-600" tabindex="-1">
                                    <svg x-show="!lihat" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <svg x-show="lihat" style="display:none;" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/></svg>
                                </button>
                            </div>
                        </div>
                        <button class="w-full rounded-xl bg-hijau-600 px-5 py-3 text-sm font-semibold text-white shadow-md shadow-hijau-600/30 transition hover:-translate-y-0.5 hover:bg-hijau-700">Masuk</button>
                    </form>
                </div>

                <a href="{{ route('beranda') }}" class="mt-6 flex items-center justify-center gap-2 text-sm text-ink-400 transition hover:text-hijau-600">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                    Kembali ke situs utama
                </a>
            </div>
        </div>
    </div>
</body>
</html>
