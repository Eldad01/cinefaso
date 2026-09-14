<nav class="md:hidden fixed inset-x-0 bottom-0 z-40 bg-cf-bg/95 backdrop-blur-md border-t border-cf-line pb-[env(safe-area-inset-bottom)]">
    <div class="grid grid-cols-5">
        @foreach ($navLinks as $link)
            @php
                $href = Route::has($link['route']) ? route($link['route']) : ($link['fallback'] ?? '#');
                $active = Route::has($link['route']) && request()->routeIs($link['match']);
                $color = $active ? 'text-cf-gold' : 'text-cf-faint';
                $weight = $active ? '2' : '1.8';
            @endphp
            <a href="{{ $href }}" class="flex flex-col items-center justify-center gap-1 pt-2.5 pb-2 {{ $color }}">
                @switch($link['match'])
                    @case('home')
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ $weight }}" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11l9-7 9 7"/><path d="M5 10v10h14V10"/></svg>
                        @break
                    @case('ce-soir')
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ $weight }}" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                        @break
                    @case('lieux.*')
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ $weight }}" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-6.1-7-11a7 7 0 0 1 14 0c0 4.9-7 11-7 11z"/><circle cx="12" cy="10" r="2.6"/></svg>
                        @break
                    @case('decouvrir')
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ $weight }}" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M15.5 8.5l-2.2 5.2-5.3 2.1 2.2-5.2z"/></svg>
                        @break
                    @case('agenda')
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ $weight }}" stroke-linecap="round" stroke-linejoin="round"><rect x="3.5" y="5" width="17" height="16" rx="3"/><path d="M3.5 10h17M8 3v4M16 3v4"/></svg>
                        @break
                @endswitch
                <span class="text-[10.5px] font-medium {{ $active ? 'font-semibold' : '' }}">{{ $link['label'] }}</span>
            </a>
        @endforeach
    </div>
</nav>
