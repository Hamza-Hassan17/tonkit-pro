<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TonKit.Pro') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-brand-dark antialiased">
        <div class="min-h-screen grid lg:grid-cols-2">
            {{-- Brand panel --}}
            <div class="hidden lg:flex flex-col justify-between bg-brand-dark text-white p-12 relative overflow-hidden">
                <div class="absolute -bottom-24 -right-24 h-80 w-80 rounded-full bg-brand-orange/90"></div>
                <a href="{{ route('home') }}" class="relative z-10">
                    <div class="text-3xl font-extrabold"><span class="text-brand-orange">TonKit</span>.Pro</div>
                    <div class="text-[10px] tracking-[0.25em] uppercase text-brand-orange mt-1">Headwear Specialists</div>
                </a>
                <div class="relative z-10">
                    <h2 class="text-3xl font-extrabold leading-tight">Quality caps,<br>built for teams.</h2>
                    <p class="mt-3 text-gray-300 max-w-sm">Create an account to see pricing, place orders, and track your order history.</p>
                </div>
                <div class="relative z-10 text-xs text-gray-400">&copy; {{ date('Y') }} TonKit.Pro</div>
            </div>

            {{-- Form panel --}}
            <div class="flex flex-col justify-center items-center px-6 py-12 bg-gray-50">
                <a href="{{ route('home') }}" class="lg:hidden mb-8 text-2xl font-extrabold">
                    <span class="text-brand-orange">TonKit</span><span class="text-brand-dark">.Pro</span>
                </a>
                <div class="w-full sm:max-w-md bg-white shadow-sm border border-gray-100 rounded-lg px-8 py-8">
                    {{ $slot }}
                </div>
                <p class="mt-6 text-xs text-gray-400">
                    Designed and Developed by
                    <a href="https://supersofttech.pk" target="_blank" rel="noopener" class="underline hover:text-brand-orange">Supersoft Technologies</a>
                </p>
            </div>
        </div>
    </body>
</html>
