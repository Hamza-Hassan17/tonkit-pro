<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Account' }} — TonKit.Pro</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-brand-dark flex flex-col min-h-screen">

    @include('partials.navbar')

    <main class="flex-1">
        @if (session('success'))
            <div class="container-site mt-4">
                <div class="bg-green-50 border border-green-300 text-green-800 px-4 py-3 rounded">{{ session('success') }}</div>
            </div>
        @endif
        @if (session('error'))
            <div class="container-site mt-4">
                <div class="bg-red-50 border border-red-300 text-red-800 px-4 py-3 rounded">{{ session('error') }}</div>
            </div>
        @endif

        {{ $slot }}
    </main>

    @include('partials.footer')

</body>
</html>
