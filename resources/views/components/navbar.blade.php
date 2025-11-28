<nav x-data="{ open: false, profileOpen: false }" class="bg-white/90 backdrop-blur-md fixed w-full z-50 top-0 border-b border-gray-100 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            
            <div class="flex items-center">
                <a href="/" class="text-2xl font-bold text-hiyoucan-900 tracking-widest uppercase hover:text-hiyoucan-600 transition duration-300 transform hover:scale-105">
                    Hiyoucan.
                </a>
            </div>

            <div class="hidden sm:flex sm:items-center sm:space-x-8">
                <a href="/" class="relative group text-gray-500 hover:text-hiyoucan-700 font-medium transition duration-300 {{ request()->is('/') ? 'text-hiyoucan-700 font-bold' : '' }}">
                    Home
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-hiyoucan-700 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{ route('shop.index') }}" class="relative group text-gray-500 hover:text-hiyoucan-700 font-medium transition duration-300 {{ request()->routeIs('shop.*') ? 'text-hiyoucan-700 font-bold' : '' }}">
                    Shop
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-hiyoucan-700 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{ route('about') }}" class="relative group text-gray-500 hover:text-hiyoucan-700 font-medium transition duration-300 {{ request()->routeIs('about') ? 'text-hiyoucan-700 font-bold' : '' }}">
                    About
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-hiyoucan-700 transition-all duration-300 group-hover:w-full"></span>
                </a>
            </div>

            <div class="flex items-center space-x-6">
                <a href="{{ route('cart.index') }}" class="text-gray-500 hover:text-hiyoucan-700 relative transition transform hover:scale-110">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    @auth
                    <span class="absolute -top-1 -right-1 bg-hiyoucan-700 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center animate-bounce">
                        {{ Auth::user()->carts()->count() }}
                    </span>
                    @endauth
                </a>

                @if (Route::has('login'))
                    @auth
                        @if(Auth::user()->role === 'buyer' || Auth::user()->role === 'user')
                            <div class="relative">
                                <button @click="profileOpen = !profileOpen" @click.outside="profileOpen = false" class="flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-hiyoucan-700 focus:outline-none transition group">
                                    <div class="h-8 w-8 rounded-full bg-hiyoucan-100 flex items-center justify-center text-hiyoucan-700 font-bold border border-hiyoucan-200 group-hover:border-hiyoucan-500 transition">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <span class="hidden md:block group-hover:text-hiyoucan-900">{{ Auth::user()->name }}</span>
                                    <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': profileOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>

                                <div x-show="profileOpen" 
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                     x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                                     class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-2xl py-2 z-50 border border-gray-100"
                                     style="display: none;">
                                    
                                    <div class="px-4 py-3 border-b border-gray-100 bg-gray-50/50">
                                        <p class="text-xs text-gray-500">Signed in as</p>
                                        <p class="text-sm font-bold text-hiyoucan-900 truncate">{{ Auth::user()->email }}</p>
                                    </div>

                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-hiyoucan-50 hover:text-hiyoucan-700 transition flex items-center gap-2">
                                        <span>👤</span> Edit Profile
                                    </a>
                                    <a href="{{ route('wishlist.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-hiyoucan-50 hover:text-hiyoucan-700 transition flex items-center gap-2">
                                        <span>❤️</span> My Wishlist
                                    </a>
                                    <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-hiyoucan-50 hover:text-hiyoucan-700 transition flex items-center gap-2">
                                        <span>📦</span> My Orders
                                    </a>
                                    
                                    <div class="border-t border-gray-100 my-1"></div>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition flex items-center gap-2">
                                            <span>🚪</span> Log Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-white bg-hiyoucan-700 px-5 py-2.5 rounded-full hover:bg-hiyoucan-800 transition shadow-lg hover:shadow-hiyoucan-500/30 transform hover:-translate-y-0.5">Dashboard</a>
                        @endif
                    @else
                        <div class="flex items-center gap-4">
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-500 hover:text-hiyoucan-700 transition">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-sm font-medium text-white bg-hiyoucan-700 px-5 py-2.5 rounded-full hover:bg-hiyoucan-800 transition shadow-lg hover:shadow-hiyoucan-500/30 transform hover:-translate-y-0.5">Register</a>
                            @endif
                        </div>
                    @endauth
                @endif
            </div>
        </div>
    </div>
</nav>