@props(['x' => 50, 'y' => 50, 'size' => 'sm'])

{{--
    "CB" monogram marker -- stands in for the plain orange square in the
    client's early mockup, per his instruction to use the CapBeast
    initials styled like an embroidered patch instead.

    Same x/y position on mobile and web (per his instruction), but the
    badge itself grows on larger screens -- sm: breakpoint (640px+) bumps
    it up a size, independent of the `size` prop (which is for different
    usage contexts, e.g. a future larger standalone marker elsewhere).
--}}
<span class="absolute -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full font-extrabold text-white shadow-md ring-1 ring-white {{ $size === 'lg' ? 'h-7 w-7 text-[9px] sm:h-9 sm:w-9 sm:text-[11px]' : 'h-[18px] w-[18px] text-[6px] sm:h-6 sm:w-6 sm:text-[9px]' }}"
      style="left: {{ $x }}%; top: {{ $y }}%; background: linear-gradient(145deg, #C6963B, #a5772a);">
    CB
</span>
