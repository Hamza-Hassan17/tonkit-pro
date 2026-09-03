@extends('layouts.site')

@section('title', 'About Us — TonKit.Pro')

@section('content')

    <div class="bg-gray-900 text-white py-10">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-3xl font-extrabold">ABOUT <span class="text-orange-600">US</span></h1>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 py-14">
        <p class="text-gray-700 leading-relaxed mb-6">
            TonKit.Pro is a specialist headwear supplier, offering a curated selection of caps
            built for comfort, durability, and everyday performance. Whether you're outfitting
            a team, a company, or just want a quality cap for yourself, we've got you covered.
        </p>
        <p class="text-gray-700 leading-relaxed mb-6">
            We work with trusted manufacturing partners to guarantee authentic, high-quality
            products on every order, with custom embroidery and printing options available
            for corporate and team orders.
        </p>

        <div class="grid md:grid-cols-3 gap-6 mt-10">
            <div class="border rounded-lg p-6 text-center">
                <div class="text-3xl font-extrabold text-orange-600">9+</div>
                <div class="text-sm text-gray-500 mt-1">Cap Styles</div>
            </div>
            <div class="border rounded-lg p-6 text-center">
                <div class="text-3xl font-extrabold text-orange-600">100%</div>
                <div class="text-sm text-gray-500 mt-1">Quality Guaranteed</div>
            </div>
            <div class="border rounded-lg p-6 text-center">
                <div class="text-3xl font-extrabold text-orange-600">CA/US</div>
                <div class="text-sm text-gray-500 mt-1">Fast Shipping</div>
            </div>
        </div>
    </div>

@endsection
