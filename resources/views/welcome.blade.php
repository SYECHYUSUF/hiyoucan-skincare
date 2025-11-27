<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Hiyoucan') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans text-gray-700 bg-white">

    @include('layouts.public-nav')

    <header class="pt-20 bg-earth-100 relative overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 items-center min-h-[600px]">
                <div class="px-6 py-12 md:px-12 lg:pr-24 z-10">
                    <p class="text-hiyoucan-600 font-semibold tracking-wider uppercase mb-4 text-sm">100% Organic</p>
                    <h1 class="text-4xl md:text-6xl font-bold text-hiyoucan-900 leading-tight mb-6">
                        Wrinkle Removing <br> <span class="text-hiyoucan-600 italic">Creams</span>
                    </h1>
                    <p class="text-gray-600 mb-8 text-lg leading-relaxed">
                        Rasakan sentuhan alami untuk kulit sehatmu. Hiyoucan menghadirkan perawatan kulit organik yang
                        aman dan efektif.
                    </p>
                    <div class="flex gap-4">
                        <a href="#"
                            class="bg-hiyoucan-700 text-white px-8 py-3 rounded-full hover:bg-hiyoucan-800 transition shadow-lg">
                            Shop Now
                        </a>
                        <a href="#" class="flex items-center text-hiyoucan-800 font-medium hover:underline">
                            View Collection <span class="ml-2">→</span>
                        </a>
                    </div>
                </div>

                <div class="relative h-full w-full">
                    <img src="https://images.unsplash.com/photo-1616683693504-3ea7e9ad6fec?q=80&w=1887&auto=format&fit=crop"
                        alt="Hiyoucan Model" class="object-cover w-full h-[500px] md:h-[700px] rounded-bl-[100px]">

                    <div
                        class="absolute bottom-10 left-10 bg-white/80 backdrop-blur p-4 rounded-lg shadow-sm hidden md:block">
                        <p class="font-bold text-hiyoucan-900">Argan Oil Serum</p>
                        <p class="text-xs text-gray-500">Best Seller 2024</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="">

        <section class="py-12 bg-white border-b border-earth-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    <div class="flex flex-col items-center group">
                        <div
                            class="w-12 h-12 mb-3 text-hiyoucan-600 bg-earth-100 rounded-full flex items-center justify-center group-hover:bg-hiyoucan-600 group-hover:text-white transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900">Natural Ingredients</h3>
                        <p class="text-xs text-gray-500 mt-1">100% bahan organik pilihan</p>
                    </div>
                    <div class="flex flex-col items-center group">
                        <div
                            class="w-12 h-12 mb-3 text-hiyoucan-600 bg-earth-100 rounded-full flex items-center justify-center group-hover:bg-hiyoucan-600 group-hover:text-white transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900">Fragrance Free</h3>
                        <p class="text-xs text-gray-500 mt-1">Aman untuk kulit sensitif</p>
                    </div>
                    <div class="flex flex-col items-center group">
                        <div
                            class="w-12 h-12 mb-3 text-hiyoucan-600 bg-earth-100 rounded-full flex items-center justify-center group-hover:bg-hiyoucan-600 group-hover:text-white transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900">Allergy Tested</h3>
                        <p class="text-xs text-gray-500 mt-1">Teruji klinis dermatologi</p>
                    </div>
                    <div class="flex flex-col items-center group">
                        <div
                            class="w-12 h-12 mb-3 text-hiyoucan-600 bg-earth-100 rounded-full flex items-center justify-center group-hover:bg-hiyoucan-600 group-hover:text-white transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3">
                                </path>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900">Paraben Free</h3>
                        <p class="text-xs text-gray-500 mt-1">Bebas bahan kimia berbahaya</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-16 bg-earth-100/30">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-bold text-hiyoucan-900">Worldwide Fashion Collection</h2>
                    <p class="text-gray-500 mt-2">Temukan perawatan terbaik untuk jenis kulitmu</p>
                </div>

                {{-- bagian best --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 mb-12">
            <div class="group">
                <div class="relative aspect-square overflow-hidden rounded-xl bg-earth-100 mb-4">
                    <img src="https://images.unsplash.com/photo-1611930022073-b7a4ba5fcccd?q=80&w=1000&auto=format&fit=crop"
                        class="object-cover w-full h-full group-hover:scale-110 transition duration-500">
                    <button
                        class="absolute bottom-4 right-4 bg-white p-2 rounded-full shadow-md hover:bg-hiyoucan-600 hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </button>
                </div>
                <h3 class="font-medium text-gray-900">Apricot Melon</h3>
                <p class="text-sm text-gray-500">Softening Cream</p>
                <p class="text-hiyoucan-700 font-bold mt-1">Rp 145.000</p>
            </div>


            <div class="group">
                <div class="relative aspect-square overflow-hidden rounded-xl bg-earth-100 mb-4">
                    <img src="https://images.unsplash.com/photo-1601049541289-9b1b7bbbfe19?q=80&w=1000&auto=format&fit=crop"
                        class="object-cover w-full h-full group-hover:scale-110 transition duration-500">
                    <button
                        class="absolute bottom-4 right-4 bg-white p-2 rounded-full shadow-md hover:bg-hiyoucan-600 hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </button>
                </div>
                    <h3 class="font-medium text-gray-900">Birch Butter</h3>
                    <p class="text-sm text-gray-500">Silkiness Cream</p>
                    <p class="text-hiyoucan-700 font-bold mt-1">Rp 180.000</p>
            </div>

            <div class="group">
                <div class="relative aspect-square overflow-hidden rounded-xl bg-earth-100 mb-4">
                    <img src="https://images.unsplash.com/photo-1620916297397-a4a5402a3c6c?q=80&w=1000&auto=format&fit=crop"
                        class="object-cover w-full h-full group-hover:scale-110 transition duration-500">
                    <button
                        class="absolute bottom-4 right-4 bg-white p-2 rounded-full shadow-md hover:bg-hiyoucan-600 hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </button>
                </div>
                    <h3 class="font-medium text-gray-900">Azalea Fields</h3>
                    <p class="text-sm text-gray-500">Soothing Cream</p>
                    <p class="text-hiyoucan-700 font-bold mt-1">Rp 210.000</p>
            </div>

            <div class="group">
                <div class="relative aspect-square overflow-hidden rounded-xl bg-earth-100 mb-4">
                    <img src="https://images.unsplash.com/photo-1598440947619-2c35fc9aa908?q=80&w=1000&auto=format&fit=crop"
                        class="object-cover w-full h-full group-hover:scale-110 transition duration-500">
                    <button
                        class="absolute bottom-4 right-4 bg-white p-2 rounded-full shadow-md hover:bg-hiyoucan-600 hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </button>
                </div>
                <h3 class="font-medium text-gray-900">Aura Natural</h3>
                <p class="text-sm text-gray-500">Face Cream</p>
                <p class="text-hiyoucan-700 font-bold mt-1">Rp 195.000</p>
            </div>
        </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 h-auto">
                    <div class="relative group overflow-hidden rounded-2xl md:col-span-1 h-64 md:h-full bg-white">
                        <img src="{{ 'https://naturium.com/cdn/shop/files/multipeptide-jumbo_0408-crop.jpg?v=1716225420' }}"
                            class="w-full h-full object-cover transition duration-500 group-hover:scale-105"
                            alt="Face Cream">
                        <div class="absolute inset-0 bg-black/10 group-hover:bg-black/20 transition"></div>
                        <div class="absolute bottom-6 left-6 bg-white/90 backdrop-blur px-4 py-2 rounded-lg">
                            <p class="font-bold text-hiyoucan-900">Face Cream</p>
                            <a href="#" class="text-xs text-hiyoucan-600 hover:underline">Shop Now</a>
                        </div>
                        
                    </div>

                    <div class="md:col-span-2 grid grid-cols-2 grid-rows-2 gap-6 h-full">
                        <div class="col-span-2 relative group overflow-hidden rounded-2xl bg-white">
                            <img src="https://images.unsplash.com/photo-1556228578-0d85b1a4d571?q=80&w=1000&auto=format&fit=crop"
                                class="w-full h-full object-cover transition duration-500 group-hover:scale-105"
                                alt="Serum">
                            <div class="absolute top-6 left-6">
                                <h3 class="text-xl font-bold text-hiyoucan-900">Special Serum</h3>
                                <p class="text-gray-600 text-sm">For glowing skin</p>
                            </div>
                        </div>
                        <div class="relative group overflow-hidden rounded-2xl bg-white">
                            <img src="https://images.unsplash.com/photo-1620916566398-39f1143ab7be?q=80&w=1000&auto=format&fit=crop"
                                class="w-full h-full object-cover transition duration-500 group-hover:scale-105"
                                alt="Cleanser">
                            <div class="absolute bottom-4 left-4">
                                <button
                                    class="bg-white text-hiyoucan-900 px-4 py-1 rounded-full text-sm font-medium shadow">Cleanser</button>
                            </div>
                        </div>
                        <div class="relative group overflow-hidden rounded-2xl bg-white">
                            <img src="https://images.unsplash.com/photo-1629198688000-71f23e745b6e?q=80&w=1000&auto=format&fit=crop"
                                class="w-full h-full object-cover transition duration-500 group-hover:scale-105"
                                alt="Toner">
                            <div class="absolute bottom-4 left-4">
                                <button
                                    class="bg-white text-hiyoucan-900 px-4 py-1 rounded-full text-sm font-medium shadow">Toner</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-end mb-8">
                    <div>
                        <h2 class="text-2xl font-bold text-hiyoucan-900">Latest Worthwhile</h2>
                        <p class="text-gray-500">Collections</p>
                    </div>
                    <a href="#" class="text-hiyoucan-600 font-medium hover:underline">See All Products</a>
                </div>

            </div>
        </section>
        

    </div>

    <section class="py-16 bg-earth-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-hiyoucan-900">What Our Customers Say</h2>
                <p class="text-gray-500 mt-2">Testimonials from our happy customers</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <p class="text-gray-600 italic">"Hiyoucan's products have transformed my skin! I love the natural
                        ingredients and how gentle they are."</p>
                    <p class="mt-4 font-semibold text-hiyoucan-900">Sarah J.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <p class="text-gray-600 italic">"The best skincare line I've ever used. My skin feels so soft and
                        hydrated!"</p>
                    <p class="mt-4 font-semibold text-hiyoucan-900">Michael T.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <p class="text-gray-600 italic">"I love that Hiyoucan uses organic ingredients. My skin has never
                        looked better!"</p>
                    <p class="mt-4 font-semibold text-hiyoucan-900">Emily R.</p>
                </div>
            </div>
        </div>
    </section>
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
