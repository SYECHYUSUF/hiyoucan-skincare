<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>My Wishlist - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-earth-100/30 font-sans antialiased text-gray-700">

    @include('layouts.public-nav')

    <div class="max-w-7xl mx-auto px-4 py-24">
        <div class="flex justify-between items-end mb-8">
            <h1 class="text-3xl font-bold text-hiyoucan-900">My Wishlist</h1>
            <a href="{{ route('shop.index') }}" class="text-hiyoucan-700 hover:underline text-sm">Browse More</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-6">{{ session('success') }}</div>
        @endif

        @if($wishlists->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($wishlists as $item)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition group relative overflow-hidden">
                    <form action="{{ route('wishlist.toggle', $item->product->id) }}" method="POST" class="absolute top-3 right-3 z-10">
                        @csrf
                        <button type="submit" class="bg-white/80 backdrop-blur p-2 rounded-full text-red-500 hover:bg-red-50 transition shadow-sm" title="Remove">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"/></svg>
                        </button>
                    </form>

                    <a href="{{ route('shop.show', $item->product->slug) }}">
                        <div class="relative aspect-[4/5] bg-earth-100">
                            <img src="{{ $item->product->image }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                        <div class="p-4">
                            <p class="text-xs text-gray-500 mb-1">{{ $item->product->category->name }}</p>
                            <h3 class="font-bold text-gray-900 truncate">{{ $item->product->name }}</h3>
                            <p class="text-hiyoucan-700 font-bold mt-1">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $wishlists->links() }}
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-xl shadow-sm">
                <div class="text-6xl mb-4">💔</div>
                <p class="text-gray-500 mb-4">Your wishlist is empty.</p>
                <a href="{{ route('shop.index') }}" class="inline-block bg-hiyoucan-600 text-white px-6 py-2 rounded-lg hover:bg-hiyoucan-700">Discover Products</a>
            </div>
        @endif
    </div>

    <<footer class="bg-hiyoucan-900 text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div>
                    <h2 class="text-2xl font-bold tracking-widest uppercase mb-4">Hiyoucan.</h2>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Kami berdedikasi untuk menyediakan produk perawatan kulit organik terbaik untuk kecantikan alami
                        Anda.
                    </p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Shop</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white">All Products</a></li>
                        <li><a href="#" class="hover:text-white">Skin Care</a></li>
                        <li><a href="#" class="hover:text-white">Body Care</a></li>
                        <li><a href="#" class="hover:text-white">New Arrivals</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Support</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white">FAQ</a></li>
                        <li><a href="#" class="hover:text-white">Shipping & Returns</a></li>
                        <li><a href="#" class="hover:text-white">Contact Us</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Newsletter</h4>
                    <p class="text-gray-400 text-sm mb-4">Subscribe untuk mendapatkan update terbaru.</p>
                    <div class="flex">
                        <input type="email" placeholder="Your email"
                            class="px-4 py-2 bg-hiyoucan-800 border-none text-white rounded-l focus:ring-1 focus:ring-hiyoucan-500 w-full">
                        <button class="bg-hiyoucan-500 px-4 py-2 rounded-r hover:bg-hiyoucan-600">GO</button>
                    </div>
                </div>
            </div>
            <div class="border-t border-hiyoucan-800 pt-8 text-center text-gray-500 text-sm">
                &copy; 2024 Hiyoucan Skincare. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>