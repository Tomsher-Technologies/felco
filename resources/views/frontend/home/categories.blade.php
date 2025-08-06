<section id="Pd-Categories" class="py-16 bg-gray-100 overflow-hidden">
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

            <div class="lg:grid lg:grid-cols-3 lg:gap-8">
                
                {{-- Left full-height card --}}
                <div class="lg:col-span-1 mb-6 lg:mb-0">
                    <a href="{{ route('products.category', ['category_slug' => $leftCategory->slug]) }}" 
                       class="group flex flex-col h-full border border-l-4 border-l-transparent rounded-lg p-6 bg-white shadow-sm 
                              transition-all duration-500 ease-in-out 
                              hover:shadow-xl hover:border-l-4 hover:border-l-primary">
                        
                        {{-- Top-aligned Title --}}
                        <h3 class="text-2xl font-normal mb-4 text-black group-hover:text-primary transition-colors duration-500">
                            {{ $leftCategory->getTranslation('name', $lang) }}
                        </h3>

                        {{-- Bottom-aligned Content (Description + Button) --}}
                        {{-- 'mt-auto' pushes this entire block to the bottom of the flex container --}}
                        <div class="mt-auto">
                            <p class="text-gray-600 group-hover:text-gray-800 transition-colors duration-500 line-clamp-4 mb-4">
                                {{ $leftCategory->getTranslation('home_content', 'en') }}
                            </p>

                            {{-- "View More" Button Area (appears on hover) --}}
                              <div class="group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 ease-in-out">
                                        <span class="flex w-full items-center justify-between bg-gray-500 group-hover:bg-primary !text-white font-medium py-2 px-4 rounded-md shadow-sm">
                                            <span>View More</span>
                                            <i class="fi fi-rr-arrow-right"></i>
                                        </span>
                                    </div>
                        </div>
                    </a>
                </div>

                {{-- Right grid with 2x2 cards --}}
                {{-- This grid only renders if there are categories available for it --}}
                @if($rightCategories->isNotEmpty())
                    <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach($rightCategories as $cat)
                            <a href="{{ route('products.category', ['category_slug' => $cat->slug]) }}" 
                               class="group flex flex-col h-full border rounded-lg p-6 bg-white shadow-sm 
                                      transition-all duration-500 ease-in-out 
                                      hover:shadow-lg hover:border-l-4 hover:border-l-primary border-l-4 border-l-transparent">

                                {{-- Top-aligned Title --}}
                                <h3 class="text-2xl font-normal text-black group-hover:text-primary transition-colors duration-500">
                                    {{ $cat->getTranslation('name', $lang) }}
                                </h3>

                                {{-- Bottom-aligned Content (Description + Button) --}}
                                <div class="mt-auto">
                                    <p class="text-gray-600 group-hover:text-gray-800 transition-colors duration-500 line-clamp-3 mb-4">
                                        {{ $cat->getTranslation('home_content', $lang) }}
                                    </p>

                                    {{-- "View More" Button Area (appears on hover) --}}
                                    <div class="group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 ease-in-out">
                                        <span class="flex w-full items-center justify-between bg-gray-500 group-hover:bg-primary !text-white font-medium py-2 px-4 rounded-md shadow-sm">
                                            <span>View More</span>
                                            <i class="fi fi-ts-arrow-right"></i>
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