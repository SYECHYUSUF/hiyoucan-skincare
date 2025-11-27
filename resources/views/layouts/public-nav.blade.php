<nav x-data="{ open: false, profileOpen: false }" class="bg-white fixed w-full z-50 top-0 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            
            <div class="flex items-center">
                <a href="/" class="text-2xl font-bold text-hiyoucan-900 tracking-widest uppercase">
                    Hiyoucan.
                </a>
            </div>

            <div class="hidden sm:flex sm:items-center sm:space-x-8">
                <a href="/" class="text-gray-500 hover:text-hiyoucan-600 font-medium {{ request()->is('/') ? 'text-hiyoucan-700 font-bold' : '' }}">Home</a>
                <a href="{{ route('shop.index') }}" class="text-gray-500 hover:text-hiyoucan-600 font-medium {{ request()->routeIs('shop.*') ? 'text-hiyoucan-700 font-bold' : '' }}">Shop</a>
                <a href="{{ route('about') }}" class="text-gray-500 hover:text-hiyoucan-600 font-medium {{ request()->routeIs('about') ? 'text-hiyoucan-700 font-bold' : '' }}">About</a>
            </div>

            <div class="flex items-center space-x-6">
                <a href="{{ route('cart.index') }}" class="text-gray-500 hover:text-hiyoucan-700 relative">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    @auth
                    <span class="absolute -top-1 -right-1 bg-hiyoucan-700 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">
                        {{ Auth::user()->carts()->count() }}
                    </span>
                    @endauth
                </a>

                @if (Route::has('login'))
                    @auth
                        @if(Auth::user()->role === 'buyer' || Auth::user()->role === 'user')
                            
                            <div class="relative">
                                <button @click="profileOpen = !profileOpen" @click.outside="profileOpen = false" class="flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-hiyoucan-700 focus:outline-none transition">
                                    <div class="h-8 w-8 rounded-full bg-hiyoucan-100 flex items-center justify-center text-hiyoucan-700 font-bold border border-hiyoucan-200">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <span class="hidden md:block">{{ Auth::user()->name }}</span>
                                    <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': profileOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>

                                <div x-show="profileOpen" 
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="opacity-100 scale-100"
                                     x-transition:leave-end="opacity-0 scale-95"
                                     class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-xl py-1 z-50 border border-gray-100"
                                     style="display: none;">
                                    
                                    <div class="px-4 py-3 border-b border-gray-100 bg-gray-50">
                                        <p class="text-xs text-gray-500">Signed in as</p>
                                        <p class="text-sm font-bold text-hiyoucan-900 truncate">{{ Auth::user()->email }}</p>
                                    </div>

                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-hiyoucan-50 hover:text-hiyoucan-700 transition">Edit Profile</a>
                                    <a href="{{ route('wishlist.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-hiyoucan-50 hover:text-hiyoucan-700 transition">My Wishlist</a>
                                    <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-hiyoucan-50 hover:text-hiyoucan-700 transition">My Orders</a>
                                    
                                    <div class="border-t border-gray-100 my-1"></div>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                                            Log Out
                                        </button>
                                    </form>
                                </div>
                            </div>

                        @else
                            <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-white bg-hiyoucan-700 px-4 py-2 rounded hover:bg-hiyoucan-800 transition shadow-sm">Dashboard</a>
                        @endif

                    @else
                        <div class="flex items-center gap-4">
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-500 hover:text-hiyoucan-700">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-sm font-medium text-white bg-hiyoucan-700 px-4 py-2 rounded-full hover:bg-hiyoucan-800 transition shadow-sm">Register</a>
                            @endif
                        </div>
                    @endauth
                @endif
            </div>
        </div>
    </div>
</nav>