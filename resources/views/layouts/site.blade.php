<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'TonKit.Pro — Quality Caps & Headwear')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Requires Laravel Breeze's Tailwind + Vite setup — see README-SETUP.md --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 flex flex-col min-h-screen">

    @include('partials.navbar')

    <main class="flex-1">
        @if (session('success'))
            <div class="max-w-7xl mx-auto mt-4 px-4">
                <div class="bg-green-50 border border-green-300 text-green-800 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="max-w-7xl mx-auto mt-4 px-4">
                <div class="bg-red-50 border border-red-300 text-red-800 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    @include('partials.footer')

</body>
</html>
