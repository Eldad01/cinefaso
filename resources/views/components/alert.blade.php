@props(['type' => 'info'])

@php
    $styles = [
        'success' => ['bg-cf-ok/10 text-cf-ok ring-cf-ok/30', 'ti-circle-check', 'text-cf-ok'],
        'error' => ['bg-red-500/10 text-red-300 ring-red-500/30', 'ti-alert-circle', 'text-red-400'],
        'warning' => ['bg-amber-500/10 text-amber-300 ring-amber-500/30', 'ti-alert-triangle', 'text-amber-400'],
        'info' => ['bg-blue-500/10 text-blue-300 ring-blue-500/30', 'ti-info-circle', 'text-blue-400'],
    ];
    [$classes, $icon, $iconColor] = $styles[$type] ?? $styles['info'];
@endphp

<div {{ $attributes->merge(['class' => "flex items-start gap-3 rounded-lg p-4 text-sm ring-1 ring-inset $classes"]) }}>
    <i class="ti {{ $icon }} text-lg shrink-0 {{ $iconColor }}"></i>
    <div class="flex-1">{{ $slot }}</div>
</div>
