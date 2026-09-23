@props(['x' => 50, 'y' => 50, 'size' => 'sm'])

{{--
    "CB" monogram marker -- stands in for the plain orange square in the
    client's early mockup, per his instruction to use the CapBeast
    initials styled like an embroidered patch instead.
--}}
<span class="absolute -translate-x-1/2 -translate-y-1/2 flex items-center justify-center rounded-full font-extrabold text-white shadow-md ring-2 ring-white {{ $size === 'lg' ? 'h-9 w-9 text-[11px]' : 'h-6 w-6 text-[8px]' }}"
      style="left: {{ $x }}%; top: {{ $y }}%; background: linear-gradient(145deg, #C6963B, #a5772a);">
    CB
</span>
