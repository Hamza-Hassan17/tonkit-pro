<footer class="bg-gray-900 text-gray-300 mt-16">
    <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
            <div class="text-xl font-extrabold text-white">TONKIT<span class="text-orange-600">.PRO</span></div>
            <p class="text-xs text-orange-500 uppercase tracking-widest mb-4">Specialiste en Uniformes</p>
            <p class="text-sm">Quality caps and headwear, built for teams and everyday wear.</p>
        </div>

        <div>
            <h4 class="text-white font-semibold uppercase text-sm mb-3">Products</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('products.index') }}" class="hover:text-orange-500">All Caps</a></li>
                <li><a href="{{ route('cart.index') }}" class="hover:text-orange-500">Your Cart</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-white font-semibold uppercase text-sm mb-3">Information</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('about') }}" class="hover:text-orange-500">About Us</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-orange-500">Contact Us</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-white font-semibold uppercase text-sm mb-3">Contact</h4>
            <ul class="space-y-2 text-sm">
                <li>{{ config('mail.from.address', 'sales@tonkit.pro') }}</li>
            </ul>
        </div>
    </div>

    <div class="border-t border-gray-800 text-center text-xs py-4 text-gray-500">
        &copy; {{ date('Y') }} TonKit.Pro. All Rights Reserved.
    </div>
</footer>
