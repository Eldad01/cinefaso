<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-cf-gold border border-transparent rounded-md font-semibold text-xs text-cf-gold-ink uppercase tracking-widest hover:bg-cf-gold-strong focus:bg-cf-gold-strong active:bg-cf-gold-strong focus:outline-none focus:ring-2 focus:ring-cf-gold focus:ring-offset-2 focus:ring-offset-cf-surface transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
