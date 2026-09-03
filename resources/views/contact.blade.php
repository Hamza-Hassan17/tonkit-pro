@extends('layouts.site')

@section('title', 'Contact Us — TonKit.Pro')

@section('content')

    <div class="bg-gray-900 text-white py-10">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-3xl font-extrabold">CONTACT <span class="text-orange-600">US</span></h1>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 py-14 grid md:grid-cols-2 gap-12">
        <div>
            <h2 class="text-xl font-bold mb-4">Send Us a Message</h2>

            @error('name') <p class="text-red-600 text-sm mb-2">{{ $message }}</p> @enderror
            @error('email') <p class="text-red-600 text-sm mb-2">{{ $message }}</p> @enderror
            @error('message') <p class="text-red-600 text-sm mb-2">{{ $message }}</p> @enderror

            <form method="POST" action="{{ route('contact.submit') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="text-sm font-semibold block mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-4 py-2" required>
                </div>
                <div>
                    <label class="text-sm font-semibold block mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-4 py-2" required>
                </div>
                <div>
                    <label class="text-sm font-semibold block mb-1">Phone (optional)</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border rounded px-4 py-2">
                </div>
                <div>
                    <label class="text-sm font-semibold block mb-1">Message</label>
                    <textarea name="message" rows="5" class="w-full border rounded px-4 py-2" required>{{ old('message') }}</textarea>
                </div>
                <button type="submit" class="bg-orange-600 text-white font-semibold px-8 py-3 rounded hover:bg-orange-700">
                    Send Message
                </button>
            </form>
        </div>

        <div>
            <h2 class="text-xl font-bold mb-4">Head Office</h2>
            <div class="text-gray-600 space-y-3 text-sm">
                <p>8700 8th Ave.<br>Montreal, Quebec H1Z 2W9</p>
                <p>Phone: 514-326-6700<br>Toll-free: 1-800-419-8491</p>
                <p>Email: sales@tonkit.pro</p>
                <p>Hours: Mon–Sat, 9h–21h</p>
            </div>
        </div>
    </div>

@endsection
