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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"><path d="M16 9a4 4 0 1 1-8 0a4 4 0 0 1 8 0m-2 0a2 2 0 1 1-4 0a2 2 0 0 1 4 0"/><path d="M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11s11-4.925 11-11S18.075 1 12 1M3 12c0 2.09.713 4.014 1.908 5.542A8.99 8.99 0 0 1 12.065 14a8.98 8.98 0 0 1 7.092 3.458A9 9 0 1 0 3 12m9 9a8.96 8.96 0 0 1-5.672-2.012A6.99 6.99 0 0 1 12.065 16a6.99 6.99 0 0 1 5.689 2.92A8.96 8.96 0 0 1 12 21"/></g></svg>Edit Profile
                                    </a>
                                    <a href="{{ route('wishlist.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-hiyoucan-50 hover:text-hiyoucan-700 transition flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-bag-heart"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.5 21h-2.926a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304h11.339a2 2 0 0 1 1.977 2.304c-.057 .368 -.1 .644 -.127 .828" /><path d="M9 11v-5a3 3 0 0 1 6 0v5" /><path d="M18 22l3.35 -3.284a2.143 2.143 0 0 0 .005 -3.071a2.242 2.242 0 0 0 -3.129 -.006l-.224 .22l-.223 -.22a2.242 2.242 0 0 0 -3.128 -.006a2.143 2.143 0 0 0 -.006 3.071l3.355 3.296z" /></svg>My Wishlist
                                    </a>
                                    <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-hiyoucan-50 hover:text-hiyoucan-700 transition flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-bag"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6.331 8h11.339a2 2 0 0 1 1.977 2.304l-1.255 8.152a3 3 0 0 1 -2.966 2.544h-6.852a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304z" /><path d="M9 11v-5a3 3 0 0 1 6 0v5" /></svg>My Orders
                                    </a>
                                    
                                    <div class="border-t border-gray-100 my-1"></div>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-logout"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" /><path d="M9 12h12l-3 -3" /><path d="M18 15l3 -3" /></svg>Log Out
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