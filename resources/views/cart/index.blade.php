<x-public-layout>
    <div class="pt-32 pb-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-hiyoucan-900 mb-8" data-aos="fade-right">Shopping Cart</h1>

        @if($cartItems->count() > 0)
        <div class="flex flex-col lg:flex-row gap-12" data-aos="fade-up">
            
            <div class="lg:w-2/3 space-y-6">
                @php $total = 0; @endphp
                @foreach($cartItems as $item)
                @php $subtotal = $item->product->price * $item->quantity; $total += $subtotal; @endphp
                
                <div class="flex items-center gap-6 bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                    <img src="{{ $item->product->image }}" class="w-24 h-24 object-cover rounded-lg bg-earth-100 flex-shrink-0">
                    
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-gray-900 text-lg truncate">{{ $item->product->name }}</h3>
                        <p class="text-sm text-gray-500 mb-1">{{ $item->product->category->name ?? 'General' }}</p>
                        <p class="text-hiyoucan-700 font-bold">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                    </div>
                    
                    <div class="text-right flex flex-col items-end gap-3">
                        
                        <form action="{{ route('cart.update', $item->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="flex items-center gap-2">
                                <label class="text-xs text-gray-500 hidden sm:block">Qty:</label>
                                <input 
                                    type="number" 
                                    name="quantity" 
                                    value="{{ $item->quantity }}" 
                                    min="1" 
                                    class="w-16 border-gray-200 bg-gray-50 rounded-lg text-center text-sm focus:ring-hiyoucan-500 focus:border-hiyoucan-500 py-1 font-bold text-gray-700"
                                    onchange="this.form.submit()"
                                >
                            </div>
                        </form>

                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-600 text-xs font-medium flex items-center gap-1 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Remove
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="lg:w-1/3">
                <div class="bg-white rounded-2xl shadow-sm p-8 sticky top-32 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Order Summary</h3>
                    
                    <div class="flex justify-between mb-4 text-gray-600 text-sm">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between mb-6 text-gray-600 text-sm">
                        <span>Shipping</span>
                        <span class="text-green-600 font-bold">Free</span>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-4 flex justify-between mb-8">
                        <span class="text-lg font-bold text-gray-900">Total</span>
                        <span class="text-2xl font-bold text-hiyoucan-700">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <form action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Shipping Address</label>
                            <textarea name="address" rows="3" class="w-full border-gray-300 rounded-xl text-sm focus:ring-hiyoucan-500 focus:border-hiyoucan-500 shadow-sm" placeholder="Enter your full delivery address..." required></textarea>
                        </div>
                        <button type="submit" class="w-full bg-hiyoucan-800 text-white py-4 rounded-xl font-bold hover:bg-hiyoucan-900 transition shadow-lg hover:shadow-hiyoucan-500/20 transform hover:-translate-y-0.5 flex justify-center items-center gap-2">
                            Checkout Now
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @else
            <div class="text-center py-32 bg-white rounded-3xl shadow-sm border border-dashed border-gray-200" data-aos="zoom-in">
                <div class="text-6xl mb-4">🛒</div>
                <p class="text-gray-500 mb-8 text-lg">Your cart is currently empty.</p>
                <a href="{{ route('shop.index') }}" class="inline-flex items-center bg-hiyoucan-600 text-white px-8 py-3 rounded-full hover:bg-hiyoucan-700 transition shadow-md font-medium">
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
</x-public-layout>