@php
    $cartCount = collect(session('cart', []))->sum();
@endphp

<header class="bg-white border-b">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between gap-6">
        <a href="{{ route('home') }}" class="shrink-0">
            <div class="text-2xl font-extrabold tracking-tight">
                <span class="text-gray-900">TONKIT</span><span class="text-orange-600">.PRO</span>
            </div>
            <div class="text-[10px] tracking-widest text-orange-600 uppercase">Specialiste en Uniformes</div>
        </a>

        <nav class="hidden md:flex items-center gap-8 text-sm font-semibold uppercase text-gray-700">
            <a href="{{ route('home') }}" class="hover:text-orange-600">Home</a>
            <a href="{{ route('products.index') }}" class="hover:text-orange-600">Products</a>
            <a href="{{ route('about') }}" class="hover:text-orange-600">About Us</a>
            <a href="{{ route('contact') }}" class="hover:text-orange-600">Contact</a>
        </nav>

        <div class="flex items-center gap-5">
            @auth
                <a href="{{ route('orders.index') }}" class="flex items-center gap-1 text-sm font-semibold text-gray-700 hover:text-orange-600">
                    <span>{{ Auth::user()->name }}</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm font-semibold text-gray-700 hover:text-orange-600">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-700 hover:text-orange-600">Login / Register</a>
            @endauth

            <a href="{{ route('cart.index') }}" class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.836l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 1.87-4.706 2.25-7.187a1.125 1.125 0 00-1.087-1.313H5.106M7.5 14.25L5.106 5.25M7.5 14.25L5.106 5.25" />
                </svg>
                @if ($cartCount > 0)
                    <span class="absolute -top-2 -right-2 bg-orange-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>
        </div>
    </div>
</header>
