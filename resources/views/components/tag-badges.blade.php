@props(['tags' => [], 'position' => 'top-3 right-3'])

@php($defs = config('product_tags'))
@php($visible = collect($tags)->filter(fn ($t) => isset($defs[$t]))->values())

@if ($visible->isNotEmpty())
    <div class="absolute {{ $position }} flex flex-col items-end gap-1 z-10">
        @foreach ($visible as $t)
            <span class="{{ $defs[$t]['badge_class'] }} text-[10px] font-bold uppercase tracking-wide px-2 py-0.5 rounded-full whitespace-nowrap">
                {{ $defs[$t]['label'] }}
            </span>
        @endforeach
    </div>
@endif
