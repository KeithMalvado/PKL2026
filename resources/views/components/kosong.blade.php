@props([
    'judul',
    'ket' => null,     // teks ringkas di bawah ikon
])

<div {{ $attributes->merge(['class' => 'grid place-items-center rounded-2xl border-2 border-dashed border-hijau-200 bg-hijau-50/50 px-6 py-16 text-center']) }}>
    <span class="grid h-16 w-16 place-items-center rounded-2xl bg-hijau-100 text-hijau-500 animasi-mengambang">
        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
    </span>
    <h3 class="mt-4 font-bold text-hijau-800">{{ $judul }}</h3>
    @if ($ket)
        <p class="mt-1 max-w-sm text-sm text-slate-500">{{ $ket }}</p>
    @endif
</div>
