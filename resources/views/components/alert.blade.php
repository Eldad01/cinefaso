@props(['type' => 'info'])

@php
    $styles = [
        'success' => ['bg-green-50 text-green-800 ring-green-600/20', 'ti-circle-check', 'text-green-500'],
        'error' => ['bg-red-50 text-red-800 ring-red-600/20', 'ti-alert-circle', 'text-red-500'],
        'warning' => ['bg-amber-50 text-amber-800 ring-amber-600/20', 'ti-alert-triangle', 'text-amber-500'],
        'info' => ['bg-blue-50 text-blue-800 ring-blue-600/20', 'ti-info-circle', 'text-blue-500'],
    ];
    [$classes, $icon, $iconColor] = $styles[$type] ?? $styles['info'];
@endphp

<div {{ $attributes->merge(['class' => "flex items-start gap-3 rounded-lg p-4 text-sm ring-1 ring-inset $classes"]) }}>
    <i class="ti {{ $icon }} text-lg shrink-0 {{ $iconColor }}"></i>
    <div class="flex-1">{{ $slot }}</div>
</div>
