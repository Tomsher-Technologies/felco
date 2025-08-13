<section id="Pd-Categories" class="py-16 md:py-24 bg-slate-200 overflow-hidden">
    <x-container>
        @php
            $categories = collect($data['product_categories'] ?? []);
            $leftCategory = $categories->shift();
            $rightCategories = $categories->take(4);
        @endphp

        @if($leftCategory)
            <div class="mb-12 text-center lg:text-left">
                <h2 class="font-light tracking-tight leading-tight text-3xl lg:text-4xl text-black">Product Categories</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                {{-- Left full-height card --}}
                <a href="{{ route('products.category', ['category_slug' => $leftCategory->slug]) }}" 
                   class="group relative  flex flex-col h-full bg-white rounded border-transparent border-l-4 p-6 md:p-8  transition-all duration-300 ease-in-out hover:shadow-xl hover:border-l-orange-400 hover:-translate-y-2 overflow-hidden md:row-span-2">
                    
                    {{-- Increased size and corrected z-index --}}
                    <div class=" absolute -top-8 -right-8 h-16 w-16 bg-slate-200 rotate-45 z-10 transition-colors duration-300 group-hover:bg-slate-200"></div>
                    
                    <div class="absolute inset-0 bg-gradient-to-r from-orange-100 via-gray-50 to-white transform -translate-x-full transition-transform duration-500 ease-in-out group-hover:translate-x-0"></div>

                    <div class="relative z-20 flex flex-col flex-grow">
                        <h3 class="text-xl md:text-2xl font-normal mb-3 text-slate-800">
                            {{ $leftCategory->getTranslation('name', $lang) }}
                        </h3>
                        <div class="mt-auto">
                            <span class="inline-flex items-center gap-2 font-medium text-orange-600 group-hover:text-orange-700 transition-colors duration-300">
                                View Products
                                <i class="fi fi-rr-arrow-right w-5 h-5 transition-transform duration-300 group-hover:translate-x-1"></i>
                            </span>
                        </div>
                    </div>
                </a>

                {{-- Right grid with 2x2 cards --}}
                @if($rightCategories->isNotEmpty())
                    @foreach($rightCategories as $cat)
                        <a href="{{ route('products.category', ['category_slug' => $cat->slug]) }}" 
                           class="group relative flex flex-col h-full bg-white rounded  border-transparent border-l-4 p-5 sm:p-6 transition-all duration-300 ease-in-out hover:shadow-xl hover:border-l-orange-400 hover:-translate-y-2 overflow-hidden lg:min-h-[200px]">
                            
                            {{-- ADDED: Corner effect applied to all cards --}}
                            <div class="absolute -top-8 -right-8 h-16 w-16 bg-slate-200 rotate-45 z-10 transition-colors duration-300 group-hover:bg-slate-200"></div>

                            <div class="absolute inset-0 bg-gradient-to-r from-orange-100 via-gray-50 to-white transform -translate-x-full transition-transform duration-500 ease-in-out group-hover:translate-x-0"></div>
                            
                            {{-- Corrected z-index for content --}}
                            <div class="relative z-20 flex flex-col flex-grow">
                                <h3 class="text-lg sm:text-xl font-normal text-slate-800">
                                    {{ $cat->getTranslation('name', $lang) }}
                                </h3>
                                <div class="mt-auto pt-4">
                                    <span class="inline-flex items-center gap-2 font-medium text-orange-600 group-hover:text-orange-700 transition-colors duration-300">
                                        Explore
                                        <i class="fi fi-rr-arrow-right w-4 h-4 ml-1 transition-transform duration-300 group-hover:translate-x-1"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        @endif
    </x-container>
</section>