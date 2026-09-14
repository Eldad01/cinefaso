@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-cf-surface-2 border-cf-line text-cf-ink placeholder:text-cf-faint focus:border-cf-gold focus:ring-cf-gold rounded-md shadow-sm']) }}>
