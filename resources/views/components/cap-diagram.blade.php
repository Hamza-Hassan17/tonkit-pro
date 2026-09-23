@props(['view' => 'front', 'mirror' => false])

{{--
    Flat, generic cap illustrations for the decoration-location picker.
    Same 3 SVGs cover all 6 locations: front is reused for
    center/left-panel/right-panel, side is reused (mirrored via CSS) for
    left-side/right-side. Not real product photography by design -- see
    config/decoration_locations.php for why.
--}}
<svg viewBox="0 0 200 140" class="w-full h-full" style="{{ $mirror ? 'transform: scaleX(-1)' : '' }}">
    @if ($view === 'front')
        {{-- Crown (dome) --}}
        <path d="M30 70 Q30 18 100 18 Q170 18 170 70 L170 78 Q100 92 30 78 Z"
              fill="#e5e5e0" stroke="#9a9a9c" stroke-width="2"/>
        {{-- Center seam --}}
        <line x1="100" y1="20" x2="100" y2="88" stroke="#c9c9c2" stroke-width="1.5"/>
        {{-- Panel seams --}}
        <path d="M62 22 Q55 50 60 80" fill="none" stroke="#c9c9c2" stroke-width="1.5"/>
        <path d="M138 22 Q145 50 140 80" fill="none" stroke="#c9c9c2" stroke-width="1.5"/>
        {{-- Brim --}}
        <path d="M40 82 Q100 100 160 82 L160 88 Q100 108 40 88 Z"
              fill="#d8d8d2" stroke="#9a9a9c" stroke-width="2"/>
    @elseif ($view === 'back')
        {{-- Crown (dome) from behind --}}
        <path d="M30 70 Q30 18 100 18 Q170 18 170 70 L170 80 Q100 96 30 80 Z"
              fill="#e5e5e0" stroke="#9a9a9c" stroke-width="2"/>
        {{-- Panel seams --}}
        <path d="M62 22 Q56 50 60 82" fill="none" stroke="#c9c9c2" stroke-width="1.5"/>
        <path d="M138 22 Q144 50 140 82" fill="none" stroke="#c9c9c2" stroke-width="1.5"/>
        {{-- Closure strap --}}
        <rect x="78" y="58" width="44" height="16" rx="3" fill="#cfcfc8" stroke="#9a9a9c" stroke-width="1.5"/>
        <circle cx="90" cy="66" r="2" fill="#9a9a9c"/>
        <circle cx="110" cy="66" r="2" fill="#9a9a9c"/>
    @else
        {{-- Side profile --}}
        <path d="M46 82 Q40 20 108 18 Q168 18 172 62 Q172 76 150 80 L46 82 Z"
              fill="#e5e5e0" stroke="#9a9a9c" stroke-width="2"/>
        {{-- Mesh side panel (trucker-style hatch) --}}
        <g stroke="#b8b8b0" stroke-width="1">
            <line x1="118" y1="34" x2="118" y2="74"/>
            <line x1="130" y1="30" x2="130" y2="76"/>
            <line x1="142" y1="30" x2="142" y2="76"/>
            <line x1="154" y1="34" x2="154" y2="76"/>
        </g>
        <path d="M118 30 Q150 26 166 42" fill="none" stroke="#9a9a9c" stroke-width="1.5"/>
        {{-- Brim --}}
        <path d="M46 82 Q10 86 4 100 L4 106 Q10 96 46 90 Z"
              fill="#d8d8d2" stroke="#9a9a9c" stroke-width="2"/>
    @endif
</svg>
