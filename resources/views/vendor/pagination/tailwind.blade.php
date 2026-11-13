@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Navigasi halaman" class="flex flex-col items-center gap-4 sm:flex-row sm:justify-between">
        <p class="text-sm text-ink-400">
            Menampilkan
            <span class="font-semibold text-ink-700">{{ $paginator->firstItem() }}</span>
            &ndash;
            <span class="font-semibold text-ink-700">{{ $paginator->lastItem() }}</span>
            dari
            <span class="font-semibold text-ink-700">{{ $paginator->total() }}</span>
        </p>

        <div class="flex items-center gap-1.5">
            {{-- sebelumnya --}}
            @if ($paginator->onFirstPage())
                <span class="grid h-9 w-9 place-items-center rounded-xl border border-ink-100 bg-white text-ink-300">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="grid h-9 w-9 place-items-center rounded-xl border border-ink-200 bg-white text-ink-600 transition hover:border-hijau-300 hover:text-hijau-700" aria-label="Sebelumnya">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>
                </a>
            @endif

            {{-- nomor halaman --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="grid h-9 w-9 place-items-center rounded-xl text-sm font-semibold text-ink-300">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="grid h-9 min-w-9 place-items-center rounded-xl bg-gradient-to-r from-hijau-600 to-sage-600 px-3 text-sm font-bold text-white shadow-md shadow-hijau-600/25" aria-current="page">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="grid h-9 min-w-9 place-items-center rounded-xl border border-ink-200 bg-white px-3 text-sm font-semibold text-ink-600 transition hover:border-hijau-300 hover:text-hijau-700">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- berikutnya --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="grid h-9 w-9 place-items-center rounded-xl border border-ink-200 bg-white text-ink-600 transition hover:border-hijau-300 hover:text-hijau-700" aria-label="Berikutnya">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                </a>
            @else
                <span class="grid h-9 w-9 place-items-center rounded-xl border border-ink-100 bg-white text-ink-300">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                </span>
            @endif
        </div>
    </nav>
@endif
