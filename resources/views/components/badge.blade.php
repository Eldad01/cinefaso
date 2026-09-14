@props(['color' => 'gray'])

@php
    $colors = [
        'primary' => 'bg-primary-50 text-primary-700 ring-primary-600/20',
        'secondary' => 'bg-secondary-50 text-secondary-800 ring-secondary-600/30',
        'success' => 'bg-green-50 text-green-700 ring-green-600/20',
        'info' => 'bg-blue-50 text-blue-700 ring-blue-600/20',
        'gray' => 'bg-gray-100 text-gray-600 ring-gray-500/10',
    ];
    $classes = $colors[$color] ?? $colors['gray'];
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-medium ring-1 ring-inset whitespace-nowrap $classes"]) }}>
    {{ $slot }}
</span>
