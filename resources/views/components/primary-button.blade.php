<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-5 py-2.5 bg-brand-orange border border-transparent rounded font-semibold text-xs text-white uppercase tracking-widest hover:bg-brand-orange-dark focus:outline-none focus:ring-2 focus:ring-brand-orange focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
