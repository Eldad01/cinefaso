@props(['image' => null, 'label' => '', 'aspect' => 'aspect-[2/3]', 'iconClass' => 'ti-movie'])

@php
    $shapes = [
        ['#6B3A2E', 'circle'],
        ['#164E4A', 'arc'],
        ['#4B4423', 'checker'],
        ['#3B2145', 'ring'],
        ['#2C3E1F', 'triangle'],
    ];
    $index = abs(crc32((string) $label)) % count($shapes);
    [$color, $shape] = $shapes[$index];
@endphp

<div {{ $attributes->merge(['class' => trim("$aspect relative overflow-hidden bg-cf-surface")]) }}>
    @if ($image)
        <img src="{{ Storage::url($image) }}" alt="{{ $label }}" class="h-full w-full object-cover">
    @else
        <div class="absolute inset-0" style="background:linear-gradient(150deg,{{ $color }} 0 55%,#1D1815 55% 100%)"></div>

        @switch($shape)
            @case('circle')
                <svg class="absolute -right-6 -top-6 w-2/3 text-cf-gold opacity-90" viewBox="0 0 140 140" fill="currentColor"><circle cx="70" cy="70" r="58"/></svg>
                @break
            @case('arc')
                <svg class="absolute -left-4 -bottom-4 w-3/5 text-cf-gold opacity-80" viewBox="0 0 130 130" fill="currentColor"><path d="M0 110 A110 110 0 0 1 110 0 L110 110 Z"/></svg>
                @break
            @case('checker')
                <svg class="absolute right-3 top-3 w-1/2 text-cf-gold opacity-90" viewBox="0 0 70 70" fill="currentColor">
                    <rect x="0" y="0" width="16" height="16"/><rect x="18" y="18" width="16" height="16"/>
                    <rect x="36" y="0" width="16" height="16" opacity=".55"/><rect x="0" y="36" width="16" height="16" opacity=".55"/>
                </svg>
                @break
            @case('ring')
                <svg class="absolute left-4 top-4 w-1/2 text-cf-gold opacity-85" viewBox="0 0 90 90" fill="currentColor"><path d="M45 4 A41 41 0 1 1 44.9 4 M45 4 A28 28 0 1 0 45 60"/></svg>
                @break
            @case('triangle')
                <svg class="absolute right-2 bottom-2 w-1/2 text-cf-gold opacity-85" viewBox="0 0 100 100" fill="currentColor"><path d="M50 6 L94 90 L6 90 Z"/></svg>
                @break
        @endswitch

        <div class="absolute inset-0 flex items-end justify-start p-2">
            <i class="ti {{ $iconClass }} text-white/40 text-lg"></i>
        </div>
    @endif
</div>
