<x-public-layout>
    <div class="pt-32 pb-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-12">
            
            <aside class="w-full lg:w-1/4 flex-shrink-0" data-aos="fade-right">
                <form action="{{ route('shop.index') }}" method="GET" class="sticky top-32 space-y-8 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                        <h3 class="text-xl font-bold text-hiyoucan-900">Filters</h3>
                        <a href="{{ route('shop.index') }}" class="text-xs text-red-500 hover:text-red-700 font-bold uppercase">Reset</a>
                    </div>

                    <div>
                        <h4 class="font-bold text-gray-800 mb-3 text-sm uppercase">Search</h4>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Find products..." class="w-full border-gray-200 bg-gray-50 rounded-lg text-sm focus:ring-hiyoucan-500 focus:border-hiyoucan-500">
                    </div>

                    <div>
                        <h4 class="font-bold text-gray-800 mb-3 text-sm uppercase">Categories</h4>
                        <div class="space-y-3">
                            @foreach($categories as $category)
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }} class="rounded border-gray-300 text-hiyoucan-600 focus:ring-hiyoucan-500">
                                <span class="text-gray-600 text-sm flex-1">{{ $category->name }}</span>
                                <span class="text-xs text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">{{ $category->products_count }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-hiyoucan-800 text-white py-3 rounded-xl font-bold hover:bg-hiyoucan-900 transition">Apply Filters</button>
                </form>
            </aside>

            <main class="w-full lg:w-3/4">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($products as $index => $product)
                    <div class="bg-white rounded-2xl p-4 shadow-sm hover:shadow-xl transition group relative border border-gray-100" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                        
                        @auth
                        <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST" class="absolute top-6 right-6 z-30">
                            @csrf
                            <button type="submit" class="bg-white rounded-full p-2 shadow-md hover:scale-110 transition border border-gray-100">
                                @php $isWishlisted = Auth::user()->wishlists->contains('product_id', $product->id); @endphp
                                <svg class="w-5 h-5 {{ $isWishlisted ? 'fill-red-500 text-red-500' : 'fill-none text-gray-400' }}" stroke="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </button>
                        </form>
                        @endauth

                        <a href="{{ route('shop.show', $product->slug) }}" class="block">
                            <div class="relative aspect-[4/5] bg-earth-100 rounded-xl overflow-hidden mb-5">
                                <img src="{{ $product->image }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            </div>
                            <p class="text-xs font-bold text-hiyoucan-600 uppercase">{{ $product->category->name ?? 'General' }}</p>
                            <h3 class="font-bold text-gray-900 text-lg mb-2 truncate">{{ $product->name }}</h3>
                            <span class="text-xl text-hiyoucan-900 font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </a>
                    </div>
                    @empty
                    <div class="col-span-3 text-center py-20">
                        <p class="text-gray-500">No products found.</p>
                    </div>
                    @endforelse
                </div>
                <div class="mt-12">{{ $products->links() }}</div>
            </main>
        </div>
    </div>
</x-public-layout>