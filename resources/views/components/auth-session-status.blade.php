@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-cf-ok']) }}>
        {{ $status }}
    </div>
@endif
