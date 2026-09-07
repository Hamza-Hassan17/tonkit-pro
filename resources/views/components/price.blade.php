@props(['amount'])

@php
    $sym = config('products.currency_symbol', '$');
    $sep = ctype_alpha($sym) ? ' ' : '';
@endphp<span {{ $attributes }}>{{ $sym }}{{ $sep }}{{ number_format((float) $amount, 2) }}</span>
