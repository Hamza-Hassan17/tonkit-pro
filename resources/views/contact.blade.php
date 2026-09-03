@extends('layouts.site')

@section('title', 'Contact Us — TonKit.Pro')

@section('content')

    <section class="hero-banner">
        <div class="container-site py-12 relative z-10">
            <h1 class="text-3xl md:text-4xl font-extrabold">CONTACT <span class="text-brand-orange">US</span></h1>
            <p class="text-gray-300 mt-2">Questions, bulk orders, or a custom quote — we're here to help.</p>
        </div>
    </section>

    <div class="container-site max-w-5xl py-14 grid md:grid-cols-2 gap-12">
        <div>
            <h2 class="text-xl font-bold mb-4">Send Us a Message</h2>

            @if ($errors->any())
                <div class="mb-4 rounded border border-red-300 bg-red-50 text-red-700 text-sm px-4 py-3">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('contact.submit') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="text-sm font-semibold block mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full rounded border-gray-300 focus:border-brand-orange focus:ring-brand-orange">
                </div>
                <div>
                    <label class="text-sm font-semibold block mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full rounded border-gray-300 focus:border-brand-orange focus:ring-brand-orange">
                </div>
                <div>
                    <label class="text-sm font-semibold block mb-1">Phone <span class="text-gray-400 font-normal">(optional)</span></label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                           class="w-full rounded border-gray-300 focus:border-brand-orange focus:ring-brand-orange">
                </div>
                <div>
                    <label class="text-sm font-semibold block mb-1">Message</label>
                    <textarea name="message" rows="5" required
                              class="w-full rounded border-gray-300 focus:border-brand-orange focus:ring-brand-orange">{{ old('message') }}</textarea>
                </div>
                <button type="submit" class="btn-orange">Send Message</button>
            </form>
        </div>

        <div class="bg-brand-gray rounded-lg p-8 h-fit">
            <h2 class="text-xl font-bold mb-4">Head Office</h2>
            <div class="text-gray-600 space-y-4 text-sm">
                <p class="flex gap-3"><span class="text-brand-orange font-bold">Address</span> Lahore, Pakistan</p>
                <p class="flex gap-3"><span class="text-brand-orange font-bold">Phone</span> +92 300 0000000</p>
                <p class="flex gap-3"><span class="text-brand-orange font-bold">Email</span> sales@tonkit.pro</p>
                <p class="flex gap-3"><span class="text-brand-orange font-bold">Hours</span> Mon–Sat, 10:00 – 19:00</p>
            </div>
        </div>
    </div>

@endsection
