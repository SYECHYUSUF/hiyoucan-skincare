<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $product->name }} - {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans text-gray-700 bg-white">

    <nav x-data="{ open: false }" class="bg-white fixed w-full z-50 top-0 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-hiyoucan-900 tracking-widest uppercase">Hiyoucan.</a>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="{{ route('shop.index') }}" class="text-sm font-medium text-gray-500 hover:text-hiyoucan-700">Back to Shop</a>
                    <a href="{{ route('cart.index') }}" class="text-gray-500 hover:text-hiyoucan-700 relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        @auth
                        <span class="absolute -top-1 -right-1 bg-hiyoucan-700 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">
                            {{ Auth::user()->carts()->count() }}
                        </span>
                        @endauth
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="pt-28 pb-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="text-sm mb-8 text-gray-500">
            <a href="/" class="hover:text-hiyoucan-700">Home</a> <span class="mx-2">/</span>
            <a href="{{ route('shop.index') }}" class="hover:text-hiyoucan-700">Shop</a> <span class="mx-2">/</span>
            <span class="text-gray-900">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div class="bg-earth-100 rounded-2xl overflow-hidden aspect-square">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
            </div>

            <div>
                <h1 class="text-4xl font-bold text-hiyoucan-900 mb-2">{{ $product->name }}</h1>
                <div class="flex items-center space-x-4 mb-6">
                    <p class="text-2xl text-hiyoucan-700 font-medium">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <div class="flex items-center text-yellow-400 text-sm">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <span class="text-gray-500 ml-1">(4.8 Reviews)</span>
                    </div>
                </div>

                <p class="text-gray-600 leading-relaxed mb-8">
                    {{ $product->description }}
                </p>

                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="w-32">
                            <label class="text-xs font-bold text-gray-500 uppercase mb-1 block">Quantity</label>
                            <input type="number" name="quantity" value="1" min="1" class="w-full border-gray-300 rounded-lg focus:ring-hiyoucan-500 focus:border-hiyoucan-500 text-center">
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="flex-1 bg-hiyoucan-800 text-white px-8 py-4 rounded-full font-bold hover:bg-hiyoucan-900 transition shadow-lg flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            Add to Cart
                        </button>
                        <button type="button" class="p-4 border border-gray-300 rounded-full hover:bg-red-50 hover:border-red-200 hover:text-red-500 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </button>
                    </div>
                </form>

                <div class="mt-8 pt-8 border-t border-gray-200 text-sm text-gray-500 space-y-2">
                    <p><span class="font-bold text-gray-900">Category:</span> {{ $product->category ? $product->category->name : 'Uncategorized' }}</p>
                    <p><span class="font-bold text-gray-900">Stock:</span> {{ $product->stock }} items available</p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-16 bg-earth-100/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-2xl font-bold text-hiyoucan-900 mb-8">You May Also Like</h3>
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                <a href="{{ route('shop.show', $related->slug) }}" class="group block bg-white rounded-xl p-4 hover:shadow-md transition">
                    <div class="aspect-square bg-earth-100 rounded-lg overflow-hidden mb-3">
                        <img src="{{ $related->image }}" class="w-full h-full object-cover group-hover:scale-105 transition">
                    </div>
                    <h4 class="font-bold text-gray-900 truncate">{{ $related->name }}</h4>
                    <p class="text-hiyoucan-700 text-sm">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                </a>
                @endforeach
            </div>
        </div>
    </div>

</body>
</html> 