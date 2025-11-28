<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop - {{ config('app.name', 'Hiyoucan') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans text-gray-700 bg-earth-100/30">

    <x-navbar />

    <div class="pt-32 pb-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-12">
            
            <aside class="w-full lg:w-1/4 flex-shrink-0" data-aos="fade-right">
                <form action="{{ route('shop.index') }}" method="GET" class="sticky top-32 space-y-8 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    
                    <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                        <h3 class="text-xl font-bold text-hiyoucan-900">Filters</h3>
                        <a href="{{ route('shop.index') }}" class="text-xs text-red-500 hover:text-red-700 font-bold uppercase tracking-wider">Reset</a>
                    </div>

                    <div>
                        <h4 class="font-bold text-gray-800 mb-3 text-sm uppercase tracking-wide">Search</h4>
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Find products..." class="w-full pl-10 border-gray-200 bg-gray-50 rounded-lg text-sm focus:ring-hiyoucan-500 focus:border-hiyoucan-500 transition">
                            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-bold text-gray-800 mb-3 text-sm uppercase tracking-wide">Categories</h4>
                        <div class="space-y-3">
                            @foreach($categories as $category)
                            <label class="flex items-center space-x-3 cursor-pointer group">
                                <div class="relative flex items-center">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}" 
                                        {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}
                                        class="peer h-5 w-5 cursor-pointer appearance-none rounded border border-gray-300 shadow-sm checked:bg-hiyoucan-600 checked:border-hiyoucan-600 focus:ring-hiyoucan-500 transition">
                                    <svg class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-3.5 h-3.5 text-white opacity-0 peer-checked:opacity-100 pointer-events-none transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="text-gray-600 group-hover:text-hiyoucan-700 transition flex-1 text-sm font-medium">
                                    {{ $category->name }}
                                </span>
                                <span class="text-xs text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">{{ $category->products_count }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-hiyoucan-800 text-white py-3 rounded-xl font-bold hover:bg-hiyoucan-900 transition shadow-lg transform hover:-translate-y-1">
                        Apply Filters
                    </button>
                </form>
            </aside>

            <main class="w-full lg:w-3/4">
                <div class="flex flex-col sm:flex-row justify-between items-center mb-8 bg-white p-4 rounded-xl shadow-sm border border-gray-100" data-aos="fade-down">
                    <p class="text-sm text-gray-500 font-medium">
                        Showing <span class="font-bold text-hiyoucan-900">{{ $products->count() }}</span> results
                    </p>
                    <div class="flex items-center space-x-3">
                        <label class="text-sm text-gray-500">Sort:</label>
                        <select onchange="window.location.href=this.value" class="border-none bg-gray-50 text-sm font-bold text-gray-700 rounded-lg focus:ring-0 cursor-pointer hover:bg-gray-100 transition py-2 pl-3 pr-8">
                            <option value="{{ route('shop.index', array_merge(request()->all(), ['sort' => 'newest'])) }}" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                            <option value="{{ route('shop.index', array_merge(request()->all(), ['sort' => 'price_asc'])) }}" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low</option>
                            <option value="{{ route('shop.index', array_merge(request()->all(), ['sort' => 'price_desc'])) }}" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($products as $index => $product)
                    <div class="bg-white rounded-2xl p-4 shadow-sm hover:shadow-xl transition-all duration-300 group relative border border-gray-100 flex flex-col h-full" 
                         data-aos="zoom-in-up" data-aos-delay="{{ $index * 50 }}">
                        
                        @if($product->created_at->diffInDays() < 7)
                        <div class="absolute top-6 left-6 z-20 pointer-events-none">
                            <span class="bg-hiyoucan-900 text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-md uppercase tracking-wider">New</span>
                        </div>
                        @endif

                        @auth
                        <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST" class="absolute top-6 right-6 z-30">
                            @csrf
                            <button type="submit" class="bg-white rounded-full p-2 shadow-md hover:scale-110 transition duration-200 group/btn border border-gray-100">
                                @php $isWishlisted = Auth::user()->wishlists->contains('product_id', $product->id); @endphp
                                <svg class="w-5 h-5 {{ $isWishlisted ? 'fill-red-500 text-red-500' : 'fill-none text-gray-400 group-hover/btn:text-red-500' }}" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </form>
                        @endauth
                        
                        <a href="{{ route('shop.show', $product->slug) }}" class="block relative aspect-[4/5] bg-earth-100 rounded-xl overflow-hidden mb-5">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700 ease-in-out">
                            <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                                <span class="bg-white text-hiyoucan-900 px-6 py-2 rounded-full text-sm font-bold shadow-lg transform translate-y-4 group-hover:translate-y-0 transition duration-300">View Details</span>
                            </div>
                        </a>

                        <div class="flex flex-col flex-grow">
                            <div class="flex justify-between items-start mb-2">
                                <p class="text-xs font-bold text-hiyoucan-600 uppercase tracking-wide">{{ $product->category->name ?? 'General' }}</p>
                                <div class="flex items-center text-yellow-400 text-xs gap-1 bg-yellow-50 px-2 py-1 rounded-md">
                                    <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    <span class="text-gray-700 font-bold">{{ $product->average_rating }}</span>
                                </div>
                            </div>
                            
                            <h3 class="font-bold text-gray-900 text-lg mb-2 leading-tight group-hover:text-hiyoucan-700 transition">{{ $product->name }}</h3>
                            
                            <div class="mt-auto pt-4 border-t border-gray-100 flex justify-between items-center">
                                <span class="text-xl text-hiyoucan-900 font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <a href="{{ route('shop.show', $product->slug) }}" class="w-10 h-10 rounded-full bg-earth-100 flex items-center justify-center text-hiyoucan-800 hover:bg-hiyoucan-800 hover:text-white transition shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-3 text-center py-20 bg-white rounded-2xl shadow-sm border border-dashed border-gray-300">
                        <div class="text-6xl mb-4">🔍</div>
                        <h3 class="text-lg font-bold text-gray-900">No products found</h3>
                        <p class="text-gray-500">Try adjusting your search or filters.</p>
                        <a href="{{ route('shop.index') }}" class="text-hiyoucan-700 font-bold hover:underline mt-4 block">Clear All Filters</a>
                    </div>
                    @endforelse
                </div>

                <div class="mt-12">
                    {{ $products->links() }}
                </div>
            </main>
        </div>
    </div>

    <x-footer />

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 50,
        });
    </script>
</body>
</html>