@props(['color' => 'gray'])

@php
    $colors = [
        'primary' => 'bg-cf-gold/15 text-cf-gold ring-cf-gold/30',
        'secondary' => 'bg-cf-gold/15 text-cf-gold ring-cf-gold/30',
        'success' => 'bg-cf-ok/15 text-cf-ok ring-cf-ok/30',
        'info' => 'bg-blue-500/15 text-blue-300 ring-blue-500/30',
        'gray' => 'bg-cf-surface-2 text-cf-muted ring-cf-line',
    ];
    $classes = $colors[$color] ?? $colors['gray'];
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-medium ring-1 ring-inset whitespace-nowrap $classes"]) }}>
    {{ $slot }}
</span>
