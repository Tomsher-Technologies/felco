<section id="ptListStyleUnique" class="py-16 bg-white text-gray-900">
  
    <x-container>
        <!-- Section Heading -->
        <div class="flex justify-between items-center mb-10">
            <h2 class="font-light tracking-tight leading-tight text-3xl drop-shadow-lg text-black">
                {{ $page->getTranslation('heading5', $lang) }}
            </h2>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach ($data['special_products'] ?? [] as $special_product)
                <div class="group bg-white border border-gray-200 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col">
                    
                    <!-- Product Image -->
                    <div class="relative w-full h-64 bg-white overflow-hidden">
                        <a href="{{ route('product-detail', ['slug' => $special_product->slug]) }}">
                            <img src="{{ asset($special_product->image) }}"
                                 alt="{{ $special_product->getTranslation('name', $lang) }}"
                                 class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                        </a>
                        <span class="absolute top-3 left-3 bg-emerald-600 text-white text-xs font-semibold px-3 py-1 shadow">
                            {{ $special_product->getTranslation('name', $lang) }}
                        </span>
                    </div>

                    <!-- Product Info -->
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-base font-semibold mb-1">
                            <a href="{{ route('product-detail', ['slug' => $special_product->slug]) }}"
                               class="text-gray-800 hover:text-emerald-600 transition-colors duration-300">
                                {{ $special_product->unique_id }}
                            </a>
                        </h3>
                    </div>
                </div>
            @endforeach
        </div>
   </x-container>
</section>
