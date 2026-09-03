{{-- ── Custom solution CTA band ────────────────────────────────── --}}
<section class="bg-brand-dark text-white">
    <div class="container-site grid md:grid-cols-2 gap-8 items-center py-14">
        <div>
            <h2 class="text-3xl md:text-4xl font-extrabold leading-tight">
                Need a <span class="text-brand-orange">custom solution?</span>
            </h2>
            <p class="mt-4 text-gray-300 max-w-md">
                We offer embroidered and printed customization options tailored to your team,
                company, or event.
            </p>
            <a href="{{ route('contact') }}" class="btn-orange mt-6">Request a Quote</a>
        </div>
        <div class="relative h-48 md:h-56 rounded-lg overflow-hidden bg-gradient-to-br from-brand-darker to-black flex items-center justify-center">
            <svg class="h-24 w-24 text-brand-orange/70" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42"/>
            </svg>
            <span class="absolute bottom-3 right-4 text-xs uppercase tracking-widest text-white/50">Custom embroidery &amp; print</span>
        </div>
    </div>
</section>

{{-- ── Contact info strip ──────────────────────────────────────── --}}
<section class="bg-white border-t border-gray-100">
    <div class="container-site grid grid-cols-2 md:grid-cols-4 gap-6 py-10 text-sm">
        @foreach ([
            ['t' => 'Head Office', 'd' => 'Lahore, Pakistan', 'p' => 'M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21'],
            ['t' => 'Phone', 'd' => '+92 300 0000000', 'p' => 'M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z'],
            ['t' => 'Email', 'd' => 'sales@tonkit.pro', 'p' => 'M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75'],
            ['t' => 'Hours', 'd' => 'Mon–Sat: 10:00 – 19:00', 'p' => 'M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z'],
        ] as $c)
            <div class="flex items-start gap-3">
                <svg class="h-6 w-6 shrink-0 text-brand-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $c['p'] }}"/></svg>
                <div>
                    <div class="font-bold text-brand-dark">{{ $c['t'] }}</div>
                    <div class="text-gray-500 mt-0.5">{!! $c['d'] !!}</div>
                </div>
            </div>
        @endforeach
    </div>
</section>

{{-- ── Footer ──────────────────────────────────────────────────── --}}
<footer class="bg-brand-dark text-gray-400">
    <div class="container-site grid grid-cols-1 md:grid-cols-4 gap-10 py-14">
        <div>
            <div class="text-xl font-extrabold"><span class="text-brand-orange">TonKit</span><span class="text-white">.Pro</span></div>
            <p class="text-[10px] tracking-[0.2em] uppercase text-brand-orange mt-1 mb-4">Headwear Specialists</p>
            <p class="text-sm leading-relaxed">Your trusted source in Pakistan for quality caps — with custom embroidery and printing for teams and businesses.</p>
            <div class="flex gap-3 mt-5">
                @foreach ([
                    'M13.5 9H16l.5-3h-3V4.2c0-.9.3-1.5 1.6-1.5H16.6V.1C16.3.1 15.2 0 14 0c-2.5 0-4.2 1.5-4.2 4.3V6H7v3h2.8v9h3.7V9z',
                    'M12 2.2c3.2 0 3.6 0 4.9.1 1.2.1 1.8.3 2.2.4.6.2 1 .5 1.4.9.4.4.7.8.9 1.4.2.4.4 1 .4 2.2.1 1.3.1 1.7.1 4.9s0 3.6-.1 4.9c-.1 1.2-.3 1.8-.4 2.2-.2.6-.5 1-.9 1.4-.4.4-.8.7-1.4.9-.4.2-1 .4-2.2.4-1.3.1-1.7.1-4.9.1s-3.6 0-4.9-.1c-1.2-.1-1.8-.3-2.2-.4-.6-.2-1-.5-1.4-.9-.4-.4-.7-.8-.9-1.4-.2-.4-.4-1-.4-2.2-.1-1.3-.1-1.7-.1-4.9s0-3.6.1-4.9c.1-1.2.3-1.8.4-2.2.2-.6.5-1 .9-1.4.4-.4.8-.7 1.4-.9.4-.2 1-.4 2.2-.4 1.3-.1 1.7-.1 4.9-.1zm0 3.4A6.4 6.4 0 1018.4 12 6.4 6.4 0 0012 5.6zm0 10.5A4.1 4.1 0 1116.1 12 4.1 4.1 0 0112 16.1zm6.6-10.9a1.5 1.5 0 11-1.5-1.5 1.5 1.5 0 011.5 1.5z',
                    'M20.5 2h-17A1.5 1.5 0 002 3.5v17A1.5 1.5 0 003.5 22h17a1.5 1.5 0 001.5-1.5v-17A1.5 1.5 0 0020.5 2zM8 19H5V8h3zM6.5 6.7A1.8 1.8 0 118.3 5a1.8 1.8 0 01-1.8 1.7zM19 19h-3v-5.6c0-1.4-.5-2.3-1.7-2.3a1.9 1.9 0 00-1.7 1.3 2.4 2.4 0 00-.1.9V19h-3V8h3v1.5a3 3 0 012.7-1.5c2 0 3.5 1.3 3.5 4.1z',
                ] as $icon)
                    <a href="#" class="h-8 w-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-brand-orange">
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24"><path d="{{ $icon }}"/></svg>
                    </a>
                @endforeach
            </div>
        </div>

        <div>
            <h4 class="text-white font-semibold uppercase text-sm mb-4">Products</h4>
            <ul class="space-y-2.5 text-sm">
                <li><a href="{{ route('products.index') }}" class="hover:text-brand-orange">Online Inventory</a></li>
                <li><a href="{{ route('products.index') }}?q=trucker" class="hover:text-brand-orange">Trucker Caps</a></li>
                <li><a href="{{ route('products.index') }}?q=snapback" class="hover:text-brand-orange">Snapback Caps</a></li>
                <li><a href="{{ route('cart.index') }}" class="hover:text-brand-orange">Your Cart</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-white font-semibold uppercase text-sm mb-4">Information</h4>
            <ul class="space-y-2.5 text-sm">
                <li><a href="{{ route('about') }}" class="hover:text-brand-orange">About Us</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-brand-orange">Contact Us</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-brand-orange">Local Sales Rep</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-brand-orange">Request a Quote</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-white font-semibold uppercase text-sm mb-4">Legal</h4>
            <ul class="space-y-2.5 text-sm">
                <li><a href="#" class="hover:text-brand-orange">Privacy Policy</a></li>
                <li><a href="#" class="hover:text-brand-orange">Cookie Policy</a></li>
                <li><a href="#" class="hover:text-brand-orange">Terms and Conditions</a></li>
                <li><a href="#" class="hover:text-brand-orange">Return &amp; Refund Policy</a></li>
            </ul>
        </div>
    </div>

    <div class="bg-brand-orange text-white/90 text-xs">
        <div class="container-site flex flex-col sm:flex-row items-center justify-between gap-2 py-4">
            <span>&copy; {{ date('Y') }} TonKit.Pro. All rights reserved.</span>
            <span>Designed for teams, built for performance.</span>
        </div>
    </div>
</footer>

<div class="bg-white border-t border-gray-100">
    <div class="container-site py-4 text-center text-xs text-gray-400">
        Designed and Developed by
        <a href="https://supersofttechnology.com/" target="_blank" rel="noopener" class="underline hover:text-brand-orange">Supersoft Technologies</a>
    </div>
</div>
