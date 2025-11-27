<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop - {{ config('app.name', 'Hiyoucan') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans text-gray-700 bg-earth-100/30">

    @include('layouts.public-nav')

    <div class="pt-28 pb-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <aside class="w-full lg:w-1/4 flex-shrink-0">
                <form action="{{ route('shop.index') }}" method="GET" class="sticky top-28 space-y-8">
                    
                    <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                        <h3 class="text-xl font-bold text-hiyoucan-900">Filter Options</h3>
                        <a href="{{ route('shop.index') }}" class="text-xs text-gray-400 hover:text-hiyoucan-600">Clear All</a>
                    </div>

                    <div>
                        <h4 class="font-semibold text-gray-900 mb-3">Search</h4>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product..." class="w-full border-gray-300 rounded-md shadow-sm focus:ring-hiyoucan-500 focus:border-hiyoucan-500 text-sm">
                    </div>

                    <div>
                        <h4 class="font-semibold text-gray-900 mb-3">By Categories</h4>
                        <div class="space-y-2">
                            @foreach($categories as $category)
                            <label class="flex items-center space-x-3 cursor-pointer group">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" 
                                    {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}
                                    class="form-checkbox h-4 w-4 text-hiyoucan-600 rounded border-gray-300 focus:ring-hiyoucan-500">
                                <span class="text-gray-600 group-hover:text-hiyoucan-700 transition flex-1">
                                    {{ $category->name }}
                                    <span class="text-xs text-gray-400 ml-1">({{ $category->products_count }})</span>
                                </span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h4 class="font-semibold text-gray-900 mb-3">Price Range</h4>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="text-xs text-gray-500">Min</label>
                                <input type="number" name="min_price" value="{{ request('min_price') }}" class="w-full border-gray-300 rounded-md text-sm focus:ring-hiyoucan-500 focus:border-hiyoucan-500" placeholder="0">
                            </div>
                            <div>
                                <label class="text-xs text-gray-500">Max</label>
                                <input type="number" name="max_price" value="{{ request('max_price') }}" class="w-full border-gray-300 rounded-md text-sm focus:ring-hiyoucan-500 focus:border-hiyoucan-500" placeholder="Max">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-hiyoucan-700 text-white py-2 rounded-md font-bold hover:bg-hiyoucan-800 transition shadow-sm">
                        Apply Filters
                    </button>

                    @if(request('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif
                </form>
            </aside>

            <main class="w-full lg:w-3/4">
                <div class="flex flex-col sm:flex-row justify-between items-center mb-6 bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                    <p class="text-sm text-gray-500 mb-2 sm:mb-0">
                        Showing <span class="font-bold text-gray-900">{{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }}</span> of {{ $products->total() }} results
                    </p>
                    
                    <div class="flex items-center space-x-3">
                        <label class="text-sm text-gray-500">Sort by:</label>
                        <select onchange="window.location.href=this.value" class="border-none bg-gray-50 text-sm rounded-md focus:ring-0 cursor-pointer hover:bg-gray-100">
                            <option value="{{ route('shop.index', array_merge(request()->all(), ['sort' => 'newest'])) }}" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                            <option value="{{ route('shop.index', array_merge(request()->all(), ['sort' => 'price_asc'])) }}" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="{{ route('shop.index', array_merge(request()->all(), ['sort' => 'price_desc'])) }}" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                        </select>
                    </div>
                </div>

                @if(request('search') || request('categories') || request('min_price'))
                <div class="flex flex-wrap gap-2 mb-6">
                    @if(request('search'))
                    <span class="px-3 py-1 bg-hiyoucan-100 text-hiyoucan-800 text-xs rounded-full flex items-center border border-hiyoucan-200">
                        Search: "{{ request('search') }}"
                    </span>
                    @endif
                    
                    @if(request('min_price') || request('max_price'))
                    <span class="px-3 py-1 bg-hiyoucan-100 text-hiyoucan-800 text-xs rounded-full flex items-center border border-hiyoucan-200">
                        Price Filter
                    </span>
                    @endif

                    <a href="{{ route('shop.index') }}" class="text-xs text-red-500 underline ml-2 pt-1">Reset All</a>
                </div>
                @endif

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                   @forelse($products as $product)
                    <div class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition group relative border border-gray-100">
                        
                        @if($product->created_at->diffInDays() < 7)
                        <div class="absolute top-6 left-6 z-10 pointer-events-none">
                            <span class="bg-hiyoucan-800 text-white text-[10px] font-bold px-2 py-1 rounded">NEW</span>
                        </div>
                        @endif

                        @auth
                        <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST" class="absolute top-6 right-6 z-20">
                            @csrf
                            <button type="submit" class="bg-white rounded-full p-1.5 shadow-sm hover:scale-110 transition duration-200 group/btn">
                                @php $isWishlisted = Auth::user()->wishlists->contains('product_id', $product->id); @endphp
                                <svg class="w-5 h-5 {{ $isWishlisted ? 'fill-red-500 text-red-500' : 'fill-none text-gray-400 group-hover/btn:text-red-500' }}" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </form>
                        @endauth
                        
                        <a href="{{ route('shop.show', $product->slug) }}" class="block">
                            <div class="relative aspect-[4/5] bg-earth-100 rounded-lg overflow-hidden mb-4">
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 mb-1">{{ $product->category->name ?? 'General' }}</p>
                                <h3 class="font-bold text-gray-900 text-lg mb-1 truncate">{{ $product->name }}</h3>
                                <div class="flex justify-between items-center">
                                    <span class="text-hiyoucan-700 font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    <div class="flex items-center text-yellow-400 text-xs">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        <span class="text-gray-400 ml-1">{{ $product->average_rating }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @empty
                    @endforelse
                </div>

                <div class="mt-12">
                    {{ $products->links() }}
                </div>
            </main>
        </div>
    </div>

    <footer class="bg-hiyoucan-900 text-white pt-16 pb-8">
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