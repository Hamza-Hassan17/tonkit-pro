<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Dashboard' }} — CapBeast Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-brand-dark" x-data="{ sidebarOpen: false }">

    @php
        $navItems = [
            ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'active' => request()->routeIs('admin.dashboard'), 'icon' => 'M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z'],
            ['label' => 'Products', 'route' => 'admin.products.index', 'active' => request()->routeIs('admin.products.*'), 'icon' => 'M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z'],
            ['label' => 'Tags', 'route' => 'admin.tags.index', 'active' => request()->routeIs('admin.tags.*'), 'icon' => 'M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3zM6 6h.008v.008H6V6z'],
            ['label' => 'Discount Codes', 'route' => 'admin.discount-codes.index', 'active' => request()->routeIs('admin.discount-codes.*'), 'icon' => 'M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z'],
            ['label' => 'Orders', 'route' => 'admin.orders.index', 'active' => request()->routeIs('admin.orders.*'), 'icon' => 'M2.25 3h1.386c.51 0 .955.343 1.087.836l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 1.87-4.706 2.25-7.187a1.125 1.125 0 00-1.087-1.313H5.106M7.5 14.25 5.106 5.25'],
        ];
    @endphp

    {{-- Mobile sidebar backdrop --}}
    <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" class="fixed inset-0 bg-black/40 z-30 md:hidden"></div>

    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="fixed md:static inset-y-0 left-0 z-40 w-64 bg-brand-dark text-gray-300 flex flex-col transition-transform md:translate-x-0"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            <div class="h-16 flex items-center px-6 border-b border-white/10">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/logo/capbeast-logo-light.png') }}" alt="CapBeast" class="h-9 w-auto">
                    <span class="text-[10px] uppercase tracking-[0.2em] text-brand-orange font-bold">Admin</span>
                </a>
            </div>
            <nav class="flex-1 px-3 py-5 space-y-1">
                @foreach ($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-md text-sm font-semibold transition-colors {{ $item['active'] ? 'bg-brand-orange text-brand-dark' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/></svg>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>
            <div class="px-3 py-5 border-t border-white/10 space-y-1">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-sm font-semibold text-gray-300 hover:bg-white/5 hover:text-white transition-colors">
                    <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                    View Store
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-md text-sm font-semibold text-gray-300 hover:bg-white/5 hover:text-white transition-colors">
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/></svg>
                        Log out
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main --}}
        <div class="flex-1 flex flex-col min-w-0">
            {{-- Top bar --}}
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 md:px-8 sticky top-0 z-20">
                <div class="flex items-center gap-3 min-w-0">
                    <button @click="sidebarOpen = true" class="md:hidden text-brand-dark" aria-label="Open menu">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/></svg>
                    </button>
                    <div class="min-w-0">
                        <nav class="text-[11px] uppercase tracking-wide text-gray-400 truncate">
                            <a href="{{ route('admin.dashboard') }}" class="hover:text-brand-orange">Admin</a>
                            @isset($breadcrumb)
                                <span class="mx-1">/</span><span class="text-brand-orange">{{ $breadcrumb }}</span>
                            @endisset
                        </nav>
                        <h1 class="text-lg font-extrabold leading-tight truncate">{{ $title ?? 'Dashboard' }}</h1>
                    </div>
                </div>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2">
                            <span class="h-9 w-9 rounded-full bg-brand-orange/10 text-brand-orange font-extrabold flex items-center justify-center text-sm">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="px-4 py-2 text-xs text-gray-400 border-b border-gray-100">{{ auth()->user()->name }}</div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-brand-dark hover:bg-gray-50">Log out</button>
                        </form>
                    </x-slot>
                </x-dropdown>
            </header>

            <main class="flex-1 p-4 md:p-8">
                @if (session('success'))
                    <div class="bg-green-50 border border-green-300 text-green-800 px-4 py-3 rounded mb-6">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="bg-red-50 border border-red-300 text-red-800 px-4 py-3 rounded mb-6">{{ session('error') }}</div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>

</body>
</html>
