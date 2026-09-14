@props(['title', 'subtitle' => null])

<div {{ $attributes->merge(['class' => 'mb-6 flex items-end justify-between gap-4']) }}>
    <div>
        <h2 class="font-display text-2xl font-bold text-cf-ink">{{ $title }}</h2>
        @if ($subtitle)
            <p class="mt-1 text-sm text-cf-muted">{{ $subtitle }}</p>
        @endif
    </div>
    @isset($actions)
        <div class="shrink-0">{{ $actions }}</div>
    @endisset
</div>
