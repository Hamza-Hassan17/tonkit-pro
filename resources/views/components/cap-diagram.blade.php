@props(['view' => 'front', 'mirror' => false])

{{--
    Flat, generic cap illustrations for the decoration-location picker.
    Same 3 SVGs cover all 6 locations: front is reused for
    center/left-panel/right-panel, side is reused (mirrored via CSS) for
    left-side/right-side. Not real product photography by design -- see
    config/decoration_locations.php for why.

    viewBox is square (200x200) on purpose -- it sits inside a square
    container, and a non-square viewBox gets letterboxed (padded) to
    preserve aspect ratio, which silently shifts where marker percentages
    in config/decoration_locations.php actually land vs. where they were
    authored against. Square-in-square means no letterboxing, so a
    marker's x/y percentage maps 1:1 to its position in this drawing.
--}}
<svg viewBox="0 0 200 200" class="w-full h-full" style="{{ $mirror ? 'transform: scaleX(-1)' : '' }}">
    @if ($view === 'front')
        {{-- Crown (dome) --}}
        <path d="M32 100 Q32 40 100 40 Q168 40 168 100 L168 110 Q100 126 32 110 Z"
              fill="#e5e5e0" stroke="#9a9a9c" stroke-width="2"/>
        {{-- Center seam --}}
        <line x1="100" y1="42" x2="100" y2="120" stroke="#c9c9c2" stroke-width="1.5"/>
        {{-- Panel seams --}}
        <path d="M64 44 Q57 78 62 112" fill="none" stroke="#c9c9c2" stroke-width="1.5"/>
        <path d="M136 44 Q143 78 138 112" fill="none" stroke="#c9c9c2" stroke-width="1.5"/>
        {{-- Brim --}}
        <path d="M42 112 Q100 132 158 112 L158 120 Q100 140 42 120 Z"
              fill="#d8d8d2" stroke="#9a9a9c" stroke-width="2"/>
    @elseif ($view === 'back')
        {{-- Crown (dome) from behind -- drawn a bit larger than the front
             view's crown alone since it has no brim to add visual weight,
             so it read as noticeably smaller/lighter next to the other
             5 cards otherwise. --}}
        <path d="M20 106 Q20 34 100 34 Q180 34 180 106 L180 120 Q100 138 20 120 Z"
              fill="#e5e5e0" stroke="#9a9a9c" stroke-width="2"/>
        {{-- Panel seams --}}
        <path d="M58 37 Q50 78 55 122" fill="none" stroke="#c9c9c2" stroke-width="1.5"/>
        <path d="M142 37 Q150 78 145 122" fill="none" stroke="#c9c9c2" stroke-width="1.5"/>
        {{-- Closure strap --}}
        <rect x="74" y="86" width="52" height="18" rx="3" fill="#cfcfc8" stroke="#9a9a9c" stroke-width="1.5"/>
        <circle cx="88" cy="95" r="2.5" fill="#9a9a9c"/>
        <circle cx="112" cy="95" r="2.5" fill="#9a9a9c"/>
    @else
        {{-- Side profile --}}
        <path d="M48 112 Q42 42 110 40 Q166 40 170 82 Q170 96 150 100 L48 112 Z"
              fill="#e5e5e0" stroke="#9a9a9c" stroke-width="2"/>
        {{-- Mesh side panel (trucker-style hatch) --}}
        <g stroke="#b8b8b0" stroke-width="1">
            <line x1="120" y1="58" x2="120" y2="96"/>
            <line x1="132" y1="54" x2="132" y2="98"/>
            <line x1="144" y1="54" x2="144" y2="98"/>
            <line x1="156" y1="58" x2="156" y2="98"/>
        </g>
        <path d="M120 54 Q152 50 168 66" fill="none" stroke="#9a9a9c" stroke-width="1.5"/>
        {{-- Brim --}}
        <path d="M48 112 Q10 116 4 130 L4 136 Q10 126 48 120 Z"
              fill="#d8d8d2" stroke="#9a9a9c" stroke-width="2"/>
    @endif
</svg>
