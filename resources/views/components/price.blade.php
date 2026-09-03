@props(['amount'])

<span {{ $attributes }}>{{ config('products.currency_symbol', 'Rs') }} {{ number_format((float) $amount) }}</span>
