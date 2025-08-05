<section id="Pd-Categories" class="py-16 bg-gray-100 overflow-hidden">
    <x-container>
        @if(!empty($data['product_categories']) && $data['product_categories']->count() > 0)
            @php
                $first = $data['product_categories']->first();
                $shortCode = strtoupper(Str::limit($first->getTranslation('name', $lang), 3, ''));
            @endphp

            <!-- Section Title -->
            <div class="text-center mb-12 gsap-fade-up">
                <h2 class="font-light tracking-tight leading-tight text-4xl text-left  drop-shadow-lg text-black">Product Categories</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 min-h-[80vh] gap-6">
                <!-- Left Card -->
                <div class="relative group bg-white text-black overflow-hidden shadow-lg transition-all duration-500 gsap-fade-up">
                    <!-- Animated Background Image -->
                    <div class="absolute inset-0 z-0 bg-cover bg-center opacity-100 bg-parallax"
                         style="background-image: url('{{ asset('assets/images/felco-website-bg.png') }}'); will-change: transform;"></div>

                    <!-- Green Hover Overlay -->
                    <div class="absolute inset-0 bg-[#0a8268] z-10 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500 ease-in-out"></div>

                    <a href="{{ route('products.category', ['category_slug' => $first->slug]) }}"
                       class="flex flex-col justify-between p-6 w-full h-full z-20 relative">
                        <div class="flex justify-end text-sm opacity-60 group-hover:opacity-90 transition">
                            <span class="group-hover:text-white">01</span>
                        </div>
                        <div class="flex-grow flex items-center justify-center text-center py-10">
                            <h1 class="text-7xl sm:text-8xl font-extrabold tracking-tight leading-none group-hover:text-white transition">{{ $shortCode }}</h1>
                        </div>
                        <div class="pt-6 border-t border-black/10 group-hover:border-white/20 transition">
                            <h5 class="text-2xl font-light mb-2 group-hover:text-white transition">
                                {{ $first->getTranslation('name', $lang) }}
                            </h5>
                            <p class="text-sm leading-relaxed text-gray-600 group-hover:text-gray-300 transition">
                                {{ $first->getTranslation('home_content', $lang) }}
                            </p>
                            <div class="flex justify-end pt-4 text-sm mt-3 font-medium">
                                <span class="transition group-hover:text-white">View Products →</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Right Cards -->
                <div class="grid grid-cols-2 gap-6 h-full">
                    @foreach($data['product_categories']->slice(1, 4) as $i => $cat)
                        @php
                            $short = strtoupper(Str::limit($cat->getTranslation('name', $lang), 3, ''));
                            $blockIndex = str_pad($i + 2, 2, '0', STR_PAD_LEFT);
                        @endphp

                        <div class="relative group bg-white text-black overflow-hidden shadow-lg transition-all duration-500 gsap-fade-up">
                            <!-- Animated Background Image -->
                            <div class="absolute inset-0 z-0 bg-cover bg-center opacity-100 bg-parallax"
                                 style="background-image: url('{{ asset('assets/images/felco-website-bg.png') }}'); will-change: transform;"></div>

                            <!-- Green Hover Overlay -->
                            <div class="absolute inset-0 bg-[#0a8268] z-10 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500 ease-in-out"></div>

                            <a href="{{ route('products.category', ['category_slug' => $cat->slug]) }}"
                               class="flex flex-col justify-between p-6 w-full h-full z-20 relative">
                                <div class="flex justify-end text-sm opacity-60 group-hover:opacity-90 transition">
                                    <span class="group-hover:text-white">{{ $blockIndex }}</span>
                                </div>
                                <div class="flex-grow flex items-center justify-center text-center py-10">
                                    <h1 class="text-5xl sm:text-6xl font-extrabold tracking-tight group-hover:text-white transition">{{ $short }}</h1>
                                </div>
                                <div class="pt-6 border-t border-black/10 group-hover:border-white/20 transition">
                                    <h5 class="text-2xl font-light mb-2 group-hover:text-white transition">
                                        {{ $cat->getTranslation('name', $lang) }}
                                    </h5>
                                    <p class="text-sm leading-relaxed text-gray-600 group-hover:text-gray-300 transition">
                                        {{ $cat->getTranslation('home_content', $lang) }}
                                    </p>
                                    <div class="flex justify-end pt-4 text-sm mt-3 font-medium">
                                        <span class="transition group-hover:text-white">View Products →</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </x-container>
</section>
