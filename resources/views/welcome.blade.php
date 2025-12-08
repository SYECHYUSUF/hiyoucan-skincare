<x-public-layout>
    
    <header class="pt-20 bg-earth-100 relative overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 items-center min-h-[650px]">
                <div class="px-6 py-12 md:px-12 lg:pr-24 z-10" data-aos="fade-right" data-aos-duration="1000">
                    <span class="inline-block px-3 py-1 bg-hiyoucan-100 text-hiyoucan-700 rounded-full text-xs font-bold tracking-wider uppercase mb-6">100% Organic & Certified</span>
                    <h1 class="text-5xl md:text-7xl font-bold text-hiyoucan-900 leading-tight mb-6">
                        Natural Glow <br> <span class="text-hiyoucan-600 italic">Everyday.</span>
                    </h1>
                    <p class="text-gray-600 mb-8 text-lg leading-relaxed max-w-lg">
                        Rasakan sentuhan alami untuk kulit sehatmu. Hiyoucan menghadirkan perawatan kulit organik yang aman dan efektif dari bahan terbaik.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('shop.index') }}" class="bg-hiyoucan-700 text-white px-8 py-4 rounded-full hover:bg-hiyoucan-800 transition shadow-xl hover:shadow-hiyoucan-500/30 transform hover:-translate-y-1 font-medium">
                            Shop Now
                        </a>
                        <a href="{{ route('about') }}" class="flex items-center px-8 py-4 bg-white text-hiyoucan-800 rounded-full font-medium hover:bg-gray-50 transition border border-gray-200">
                            Learn More <span class="ml-2">→</span>
                        </a>
                    </div>
                </div>

                <div class="relative h-full w-full" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <img src="https://i.pinimg.com/1200x/47/9b/64/479b6469425861cad26db981bd9e08cb.jpg" 
                            alt="Hiyoucan Model" 
                            class="object-cover w-full h-[500px] md:h-[750px] rounded-bl-[150px] shadow-2xl">
                    
                    <div class="absolute bottom-20 left-10 md:left-[-20px] bg-white/90 backdrop-blur-lg p-5 rounded-2xl shadow-xl hidden md:block border border-white" data-aos="zoom-in" data-aos-delay="600">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-hiyoucan-100 rounded-full flex items-center justify-center text-xl">🌿</div>
                            <div>
                                <p class="font-bold text-hiyoucan-900 text-lg">Best Seller</p>
                                <p class="text-xs text-gray-500">Argan Oil Serum</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="py-20 bg-white border-b border-earth-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="flex flex-col items-center group p-6 rounded-xl hover:bg-earth-50 transition duration-300" data-aos="fade-up" data-aos-delay="0">
                    <div class="w-16 h-16 mb-4 text-hiyoucan-600 bg-earth-100 rounded-full flex items-center justify-center group-hover:bg-hiyoucan-600 group-hover:text-white transition duration-300 transform group-hover:rotate-12">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg">Natural</h3>
                    <p class="text-sm text-gray-500 mt-2">100% bahan organik</p>
                </div>
                <div class="flex flex-col items-center group p-6 rounded-xl hover:bg-earth-50 transition duration-300" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 mb-4 text-hiyoucan-600 bg-earth-100 rounded-full flex items-center justify-center group-hover:bg-hiyoucan-600 group-hover:text-white transition duration-300 transform group-hover:rotate-12">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg">Safe</h3>
                    <p class="text-sm text-gray-500 mt-2">Aman kulit sensitif</p>
                </div>
                <div class="flex flex-col items-center group p-6 rounded-xl hover:bg-earth-50 transition duration-300" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 mb-4 text-hiyoucan-600 bg-earth-100 rounded-full flex items-center justify-center group-hover:bg-hiyoucan-600 group-hover:text-white transition duration-300 transform group-hover:rotate-12">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg">Tested</h3>
                    <p class="text-sm text-gray-500 mt-2">Teruji klinis</p>
                </div>
                <div class="flex flex-col items-center group p-6 rounded-xl hover:bg-earth-50 transition duration-300" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 mb-4 text-hiyoucan-600 bg-earth-100 rounded-full flex items-center justify-center group-hover:bg-hiyoucan-600 group-hover:text-white transition duration-300 transform group-hover:rotate-12">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg">Eco</h3>
                    <p class="text-sm text-gray-500 mt-2">Ramah lingkungan</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-earth-100/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-hiyoucan-900 mb-4">Curated Collections</h2>
                <p class="text-gray-500 text-lg">Temukan perawatan terbaik untuk jenis kulitmu</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 h-auto">
                <div class="relative group overflow-hidden rounded-3xl md:col-span-1 h-80 md:h-full bg-white shadow-lg" data-aos="fade-right">
                    <img src="https://witwhimsy.com/wp-content/uploads/2022/03/necessaire-body-lotion-scaled.jpg" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="Face Cream">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-8 left-8 text-white">
                        <h3 class="text-3xl font-bold mb-2">Face Cream</h3>
                        <a href="{{ route('shop.index', ['categories[]' => 1]) }}" class="inline-block border-b border-white pb-1 hover:text-hiyoucan-300 hover:border-hiyoucan-300 transition">Shop Now</a>
                    </div>
                </div>

                <div class="md:col-span-2 grid grid-cols-2 grid-rows-2 gap-6 h-full">
                    <div class="col-span-2 relative group overflow-hidden rounded-3xl bg-white shadow-lg" data-aos="fade-left">
                        <img src="https://images.unsplash.com/photo-1556228578-0d85b1a4d571?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="Serum">
                        <div class="absolute inset-0 bg-black/10 group-hover:bg-black/20 transition"></div>
                        <div class="absolute top-8 left-8 bg-white/90 backdrop-blur px-6 py-3 rounded-xl shadow-sm">
                            <h3 class="text-xl font-bold text-hiyoucan-900">Special Serums</h3>
                            <p class="text-gray-600 text-sm">For glowing skin</p>
                        </div>
                    </div>
                    <div class="relative group overflow-hidden rounded-3xl bg-white shadow-lg" data-aos="fade-up" data-aos-delay="100">
                        <img src="https://images.unsplash.com/photo-1620916566398-39f1143ab7be?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="Cleanser">
                        <div class="absolute bottom-6 left-6">
                            <span class="bg-white text-hiyoucan-900 px-5 py-2 rounded-full text-sm font-bold shadow-md hover:bg-hiyoucan-900 hover:text-white transition cursor-pointer">Cleanser</span>
                        </div>
                    </div>
                    <div class="relative group overflow-hidden rounded-3xl bg-white shadow-lg" data-aos="fade-up" data-aos-delay="200">
                        <img src="https://i.pinimg.com/1200x/88/12/e8/8812e8bdf2f4bcb357161ed2851115d2.jpg" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="Toner">
                        <div class="absolute bottom-6 left-6">
                            <span class="bg-white text-hiyoucan-900 px-5 py-2 rounded-full text-sm font-bold shadow-md hover:bg-hiyoucan-900 hover:text-white transition cursor-pointer">Toner</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-hiyoucan-900 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <img src="https://images.unsplash.com/photo-1552693673-1bf958298935?q=80&w=2000" class="w-full h-full object-cover">
        </div>
        <div class="relative max-w-4xl mx-auto text-center px-4" data-aos="fade-up">
            <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">Ready to find your perfect match?</h2>
            <p class="text-hiyoucan-200 text-lg mb-10">Bergabunglah dengan ribuan pelanggan yang telah beralih ke perawatan kulit organik.</p>
            <a href="{{ route('shop.index') }}" class="inline-block bg-white text-hiyoucan-900 px-10 py-4 rounded-full font-bold text-lg hover:bg-hiyoucan-100 transition shadow-2xl transform hover:-translate-y-1">
                Start Shopping
            </a>
        </div>
    </section>

</x-public-layout>