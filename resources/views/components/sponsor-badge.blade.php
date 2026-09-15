@props(['sponsor'])

@php
    $tag = $sponsor->site_web ? 'a' : 'div';
@endphp

<{{ $tag }}
    @if ($sponsor->site_web) href="{{ $sponsor->site_web }}" target="_blank" rel="noopener sponsored" @endif
    {{ $attributes->merge(['class' => 'h-14 w-14 shrink-0 rounded-full bg-white/95 p-2 flex items-center justify-center shadow-sm ' . ($sponsor->site_web ? 'hover:scale-105 transition' : '')]) }}
    title="{{ $sponsor->nom }}"
>
    @if ($sponsor->logo)
        <img src="{{ Storage::url($sponsor->logo) }}" alt="{{ $sponsor->nom }}" class="max-h-full max-w-full object-contain">
    @else
        <span class="text-xs font-bold text-cf-bg">{{ Str::substr($sponsor->nom, 0, 2) }}</span>
    @endif
</{{ $tag }}>
