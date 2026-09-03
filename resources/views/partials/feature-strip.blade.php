<section class="bg-brand-dark text-white">
    <div class="container-site grid grid-cols-2 md:grid-cols-4 gap-6 py-7">
        @foreach ([
            ['t' => 'Fast Shipping', 'd' => 'Across Pakistan', 'p' => 'M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12'],
            ['t' => 'Quality Guaranteed', 'd' => '100% Authentic Products', 'p' => 'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['t' => 'Bulk Orders', 'd' => 'Corporate & Team Orders', 'p' => 'M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9'],
            ['t' => 'Customer Support', 'd' => 'We\'re Here to Help', 'p' => 'M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 011.037-.443 48.282 48.282 0 005.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z'],
        ] as $f)
            <div class="flex items-center gap-3">
                <svg class="h-8 w-8 shrink-0 text-brand-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.4"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $f['p'] }}"/></svg>
                <div>
                    <div class="font-bold text-sm">{{ $f['t'] }}</div>
                    <div class="text-gray-400 text-xs">{{ $f['d'] }}</div>
                </div>
            </div>
        @endforeach
    </div>
</section>
