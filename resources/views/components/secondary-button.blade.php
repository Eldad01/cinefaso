<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-cf-surface-2 border border-cf-line rounded-md font-semibold text-xs text-cf-ink uppercase tracking-widest shadow-sm hover:bg-cf-line focus:outline-none focus:ring-2 focus:ring-cf-gold focus:ring-offset-2 focus:ring-offset-cf-surface disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
