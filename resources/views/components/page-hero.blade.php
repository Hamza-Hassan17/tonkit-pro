@props(['title', 'accent' => '', 'subtitle' => null])

<section class="hero-banner">
    <div class="container-site py-12 relative z-10">
        <h1 class="text-3xl md:text-4xl font-extrabold">{{ $title }} @if($accent)<span class="text-brand-orange">{{ $accent }}</span>@endif</h1>
        @if ($subtitle)
            <p class="text-gray-300 mt-2 max-w-xl">{{ $subtitle }}</p>
        @endif
    </div>
</section>
