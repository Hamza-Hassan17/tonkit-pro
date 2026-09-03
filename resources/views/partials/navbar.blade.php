@php
    $cartCount = collect(session('cart', []))->sum('qty');
    $navItems = [
        ['label' => 'Home', 'route' => 'home', 'active' => request()->routeIs('home')],
        ['label' => 'Inventory', 'route' => 'products.index', 'active' => request()->routeIs('products.*')],
        ['label' => 'About Us', 'route' => 'about', 'active' => request()->routeIs('about')],
        ['label' => 'Contact', 'route' => 'contact', 'active' => request()->routeIs('contact')],
    ];
@endphp

{{-- ── Top utility bar ─────────────────────────────────────────── --}}
<div class="bg-brand-darker text-gray-300 text-xs">
    <div class="container-site flex items-center justify-between h-9">
        <span class="hidden sm:inline uppercase tracking-widest text-[11px]">Headwear &amp; Uniform Specialists</span>
        <span class="hidden md:inline text-brand-orange font-medium">Fast shipping nationwide across Pakistan</span>
        <a href="tel:18004198491" class="inline-flex items-center gap-1.5 hover:text-white">
            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
            Customer service: 1-800-419-8491
        </a>
    </div>
</div>

{{-- ── Main header ─────────────────────────────────────────────── --}}
<header x-data="{ mobile: false }" class="bg-white sticky top-0 z-40 shadow-sm">
    <div class="container-site flex items-center gap-6 py-4">
        <a href="{{ route('home') }}" class="shrink-0 group">
            <div class="text-2xl font-extrabold tracking-tight leading-none">
                <span class="text-brand-orange">TonKit</span><span class="text-brand-dark">.Pro</span>
            </div>
            <div class="text-[9px] tracking-[0.22em] text-gray-400 group-hover:text-brand-orange uppercase mt-0.5 transition-colors">Headwear Specialists</div>
        </a>

        {{-- Search --}}
        <form action="{{ route('products.index') }}" method="GET" class="hidden md:flex flex-1 max-w-xl">
            <div class="relative w-full">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search products..."
                       class="w-full rounded-full border-gray-200 bg-gray-50 pl-5 pr-14 py-2.5 text-sm focus:bg-white focus:border-brand-orange focus:ring-brand-orange">
                <button type="submit" aria-label="Search"
                        class="absolute right-1.5 top-1.5 bottom-1.5 aspect-square rounded-full bg-brand-orange text-white flex items-center justify-center hover:bg-brand-orange-dark transition-colors">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                </button>
            </div>
        </form>

        <div class="flex items-center gap-3 ml-auto">
            @auth
                <div class="hidden sm:flex items-center gap-3" x-data="{ open: false }">
                    <a href="{{ route('orders.index') }}" class="text-[11px] font-semibold uppercase tracking-wide {{ request()->routeIs('orders.*') ? 'text-brand-orange' : 'text-gray-400 hover:text-brand-orange' }}">Orders</a>
                    <div class="relative">
                        <button @click="open = !open" class="flex items-center gap-2 group">
                            <span class="h-9 w-9 rounded-full bg-gray-100 group-hover:bg-brand-orange/10 flex items-center justify-center transition-colors">
                                <svg class="h-4 w-4 text-brand-dark group-hover:text-brand-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                            </span>
                            <span class="text-left leading-tight">
                                <span class="block text-[10px] uppercase tracking-wide text-gray-400">Account</span>
                                <span class="block text-xs font-semibold text-brand-dark truncate max-w-[90px]">{{ Auth::user()->name }}</span>
                            </span>
                        </button>
                        <div x-show="open" x-cloak @click.outside="open = false"
                             class="absolute right-0 mt-2 w-44 bg-white rounded-lg shadow-lg border border-gray-100 py-1 z-50">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-brand-dark hover:bg-gray-50">My Account</a>
                            <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-brand-dark hover:bg-gray-50">My Orders</a>
                            <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-100 mt-1">
                                @csrf
                                <button class="w-full text-left px-4 py-2 text-sm text-brand-dark hover:bg-gray-50">Log out</button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="hidden sm:flex items-center gap-2 group">
                    <span class="h-9 w-9 rounded-full bg-gray-100 group-hover:bg-brand-orange/10 flex items-center justify-center transition-colors">
                        <svg class="h-4 w-4 text-brand-dark group-hover:text-brand-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                    </span>
                    <span class="text-left leading-tight">
                        <span class="block text-[10px] uppercase tracking-wide text-gray-400">Account</span>
                        <span class="block text-xs font-semibold text-brand-dark">Login / Register</span>
                    </span>
                </a>
            @endauth

            <a href="{{ route('cart.index') }}" class="relative flex items-center gap-2 group">
                <span class="relative h-9 w-9 rounded-full bg-gray-100 group-hover:bg-brand-orange/10 flex items-center justify-center transition-colors">
                    <svg class="h-4 w-4 text-brand-dark group-hover:text-brand-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.836l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 1.87-4.706 2.25-7.187a1.125 1.125 0 00-1.087-1.313H5.106M7.5 14.25 5.106 5.25M7.5 14.25 5.106 5.25"/></svg>
                    @if ($cartCount > 0)
                        <span class="absolute -top-1 -right-1 bg-brand-orange text-white text-[10px] font-bold rounded-full h-4 min-w-4 px-1 flex items-center justify-center">{{ $cartCount }}</span>
                    @endif
                </span>
                <span class="hidden lg:block text-left leading-tight">
                    <span class="block text-[10px] uppercase tracking-wide text-gray-400">Cart</span>
                    <span class="block text-xs font-semibold text-brand-dark">{{ $cartCount }} item{{ $cartCount === 1 ? '' : 's' }}</span>
                </span>
            </a>

            <button @click="mobile = !mobile" class="lg:hidden text-brand-dark ml-1" aria-label="Menu">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
            </button>
        </div>
    </div>

    {{-- ── Primary nav ────────────────────────────────────────── --}}
    <nav class="border-t border-gray-100 bg-white hidden lg:block">
        <div class="container-site flex items-center gap-8">
            @foreach ($navItems as $item)
                <a href="{{ route($item['route']) }}" class="nav-link {{ $item['active'] ? 'nav-link-active' : '' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
            <div class="ml-auto flex items-center gap-6">
                <a href="{{ route('contact') }}" class="text-xs font-semibold uppercase tracking-wide text-brand-orange hover:text-brand-orange-dark inline-flex items-center gap-1.5">
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 011.037-.443 48.282 48.282 0 005.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/></svg>
                    Request a Quote
                </a>
                <span class="text-xs font-semibold uppercase tracking-wide text-gray-400 inline-flex items-center gap-1 cursor-default">
                    English
                    <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path d="M5.25 7.5 10 12.25 14.75 7.5z"/></svg>
                </span>
            </div>
        </div>
    </nav>

    {{-- ── Mobile nav ─────────────────────────────────────────── --}}
    <nav x-show="mobile" x-cloak class="lg:hidden border-t border-gray-100 bg-white">
        <div class="container-site py-3 flex flex-col divide-y divide-gray-100">
            @foreach ($navItems as $item)
                <a href="{{ route($item['route']) }}" class="py-3 text-sm font-semibold uppercase tracking-wide {{ $item['active'] ? 'text-brand-orange' : 'text-brand-dark/80' }}">{{ $item['label'] }}</a>
            @endforeach
            @auth
                <a href="{{ route('orders.index') }}" class="py-3 text-sm font-semibold uppercase tracking-wide text-brand-dark/80">My Orders</a>
                <a href="{{ route('profile.edit') }}" class="py-3 text-sm font-semibold uppercase tracking-wide text-brand-dark/80">My Account</a>
                <form method="POST" action="{{ route('logout') }}" class="py-3">
                    @csrf
                    <button class="text-sm font-semibold uppercase tracking-wide text-brand-orange">Log out</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="py-3 text-sm font-semibold uppercase tracking-wide text-brand-dark/80">Login / Register</a>
            @endauth
        </div>
    </nav>
</header>
