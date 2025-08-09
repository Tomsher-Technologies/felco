<section id="Pd-Categories" class="py-16 md:py-24 bg-slate-50 overflow-hidden">
    <x-container>
        @php
            // Ensure $data['product_categories'] is a collection and handle if it's null
            $categories = collect($data['product_categories'] ?? []);

            // Separate the first category for the large left card
            $leftCategory = $categories->shift(); 

            // Take the next 4 categories for the right-side grid
            $rightCategories = $categories->take(4);
        @endphp

        {{-- Only render the section if there is at least one category to display --}}
        @if($leftCategory)
       <div class="mb-12 text-center lg:text-left">
                <h2 class="font-light tracking-tight leading-tight text-4xl drop-shadow-lg text-black">Product Categories</h2>
            </div>


            <div class="lg:grid lg:grid-cols-2 lg:gap-4 items-stretch">
                
                {{-- Left full-height card --}}
                <div class="lg:col-span-1 mb-8 lg:mb-0">
                    <a href="{{ route('products.category', ['category_slug' => $leftCategory->slug]) }}" 
                       class="group relative flex flex-col h-full bg-white border border-slate-200 p-8 shadow-md transition-all duration-300 ease-in-out hover:shadow-xl hover:border-slate-300 hover:-translate-y-2">
                        
                        {{-- Animated Border --}}
                        <div class="absolute top-0 left-0 h-full w-1 bg-orange-500 scale-y-0 group-hover:scale-y-100 transition-transform duration-300 ease-in-out origin-top"></div>

                        {{-- Icon --}}
                        <div class="mb-6 text-orange-500">
                            <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z" /></svg>
                        </div>

                        {{-- Content --}}
                        <div class="flex flex-col flex-grow">
                            <h3 class="text-2xl font-normal mb-3 text-slate-800">
                                {{ $leftCategory->getTranslation('name', $lang) }}
                            </h3>
                            <p class="text-slate-600 line-clamp-4 mb-6">
                                {{ $leftCategory->getTranslation('home_content', 'en') }}
                            </p>
                            <div class="mt-auto">
                                <span class="inline-flex items-center gap-2 font-medium text-orange-600 group-hover:text-orange-700 transition-colors duration-300">
                                    View Products
                                    <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" /></svg>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Right grid with 2x2 cards --}}
                @if($rightCategories->isNotEmpty())
                    <div class="lg:col-span-1 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($rightCategories as $cat)
                            <a href="{{ route('products.category', ['category_slug' => $cat->slug]) }}" 
                               class="group relative flex flex-col h-full bg-white rounded-lg border border-slate-200 p-6 shadow-md transition-all duration-300 ease-in-out hover:shadow-xl hover:border-slate-300 hover:-translate-y-2">
                                
                                {{-- Animated Border --}}
                                <div class="absolute top-0 left-0 h-full w-1 bg-orange-500 scale-y-0 group-hover:scale-y-100 transition-transform duration-300 ease-in-out origin-top"></div>

                                {{-- Icon --}}
                                <div class="mb-4 text-orange-500">
                                    <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" /></svg>
                                </div>
                                
                                {{-- Content --}}
                                <div class="flex flex-col flex-grow">
                                    <h3 class="text-xl font-normal text-slate-800">
                                        {{ $cat->getTranslation('name', $lang) }}
                                    </h3>
                                    <div class="mt-auto pt-4">
                                        <span class="inline-flex items-center text-sm font-medium text-orange-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            Explore
                                            <svg class="w-4 h-4 ml-1 transition-transform duration-300 group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" /></svg>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
    </x-container>
</section>
