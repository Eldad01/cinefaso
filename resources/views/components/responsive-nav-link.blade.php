@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-cf-gold text-start text-base font-medium text-cf-gold bg-cf-gold/10 focus:outline-none transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-cf-muted hover:text-cf-ink hover:bg-cf-surface-2 hover:border-cf-line focus:outline-none focus:text-cf-ink focus:bg-cf-surface-2 focus:border-cf-line transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
