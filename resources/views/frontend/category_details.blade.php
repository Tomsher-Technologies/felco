@extends('frontend.layouts.app')

@section('content')

    @php
        $features = json_decode($category->getTranslation('features', $lang), true) ?? [];
    @endphp

    {{-- 1. Hero Section --}}
    @include('components.page-title', [
        'title' => $category->getTranslation('name', $lang),
        'description' => $category->getTranslation('description', $lang),
        'image' => uploaded_asset($category->image),
    ])

    @if (
        $category->frame_size ||
            $category->output ||
            $category->ip_class ||
            $category->insulation_class ||
            $category->efficiency)
        <section class="my-16">
            <x-container>
                <div class="grid grid-cols-2 gap-6 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                    @if ($category->frame_size)
                        <x-spec-card title="Frame Size" value="{{ $category->frame_size }}" />
                    @endif
                    @if ($category->output)
                        <x-spec-card title="Output" value="{{ $category->output }}" />
                    @endif
                    @if ($category->ip_class)
                        <x-spec-card title="IP Class" value="{{ $category->ip_class }}" />
                    @endif
                    @if ($category->insulation_class)
                        <x-spec-card title="Insulation" value="{{ $category->insulation_class }}" />
                    @endif
                    @if ($category->efficiency)
                        <x-spec-card title="Efficiency" value="{{ $category->efficiency }}" />
                    @endif
                </div>
            </x-container>
        </section>
    @endif

    @if ($category->getTranslation('content1', $lang))
        <section class="bg-gradient-to-tr from-stone-50 via-stone-100 to-stone-50 py-10 md:py-16">
            <x-container class="mx-auto max-w-4xl">
                <div class="animate-on-scroll relative overflow-hidden rounded-lg bg-white p-8 shadow-lg md:p-12">
                    {!! $category->getTranslation('content1', $lang) !!}
                </div>
            </x-container>
        </section>
    @endif


    @if (!empty($features) && count($features) > 0 && !empty($features[0]['feature_items']) && count($features[0]['feature_items']) > 0)
        <section class="mt-16 bg-[#454d4e] py-16 text-slate-300 md:py-24">
            <x-container>
                <div class="space-y-16">
                    @foreach ($features as $featureSection)
                        <div class="mb-8 border-l-2 border-orange-500 pl-4">
                            <h3 class="animate-on-scroll text-3xl font-light text-white">
                                {{ $featureSection['heading'] ?? '' }}
                            </h3>
                        </div>
                        @if (!empty($featureSection['feature_items']))
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                                @foreach ($featureSection['feature_items'] as $item)
                                    @if (!empty($item['feature']))
                                        <div
                                            class="group border border-[#3a4142] bg-[#313738] p-6 transition-all duration-300 hover:border-orange-500/80 hover:bg-[#3a4142]">
                                            <h4 class="text-xl font-normal text-slate-100">{{ $item['feature'] }}</h4>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>
            </x-container>
        </section>
    @endif


    @if (
        $products->isNotEmpty() ||
            collect(request()->query())->except(['page'])->isNotEmpty())
        <section class="bg-white py-16 md:py-20">
            <x-container>
                {{-- Filter UI --}}
                <div class="mb-12">
                    <div class="flex flex-col items-start justify-between gap-6 md:flex-row md:items-center">
                        <h2 class="text-3xl font-light text-gray-900">Filter Products</h2>
                        <form class="flex w-full overflow-hidden rounded-md md:max-w-md" method="GET"
                            action="{{ route('products.category', $category->slug) }}" autocomplete="off">
                            <input name="keyword" type="text" value="{{ request('keyword') }}"
                                placeholder="Search by ID or Name..."
                                class="form-input w-full border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500" />
                            <button type="submit"
                                class="bg-[#f16c31] px-5 py-2 text-white shadow transition hover:bg-[#f06425]">Search</button>
                        </form>
                    </div>

                    <div class="pt-6">
                        <form id="live-filter-form"
                            class="flex flex-wrap items-end gap-4 rounded-lg border border-gray-200 bg-white p-6 shadow-sm"
                            method="GET" action="{{ route('products.category', $category->slug) }}">
                            @php
                                $filterOptions = [
                                    'frame_size' => $frameSizes,
                                    'poles' => $poles,
                                    'power' => $powers,
                                    'mounting' => $mountings,
                                    'voltage' => $voltages,
                                ];
                            @endphp
                            @foreach ($filterOptions as $filter => $options)
                                @if (collect($options)->isNotEmpty())
                                    <div class="min-w-[150px] flex-1">
                                        <label
                                            class="mb-2 block text-sm font-semibold text-gray-800">{{ trans("messages.$filter") }}</label>
                                        <select name="{{ $filter }}"
                                            class="form-select w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                                            <option value="">All</option>
                                            @foreach ($options as $opt)
                                                <option value="{{ $opt }}" @selected(request($filter) == $opt)>
                                                    {{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            @endforeach
                            <div class="flex items-end gap-2 pt-6">
                                <button type="submit"
                                    class="rounded-md bg-orange-600 px-6 py-2 text-white shadow transition hover:bg-orange-700">Apply</button>
                                <a href="{{ route('products.category', $category->slug) }}"
                                    class="rounded-md border border-gray-300 bg-white px-6 py-2 text-center text-gray-700 shadow-sm transition hover:bg-gray-50">Reset</a>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Product Table --}}
                <main>
                    @if ($products->isNotEmpty())
                        <div class="mb-8">
                            {{-- Added data-total attribute to store the total count --}}
                            <h2 class="text-3xl font-light text-gray-900" data-total-products="{{ $products->total() }}">
                                Showing <span id="product-count">{{ $products->count() }}</span> of
                                {{ $products->total() }} Products
                            </h2>
                        </div>
                        <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
                            <div role="table" class="min-w-full">
                                <div role="rowheader"
                                    class="grid grid-cols-[minmax(300px,_3fr)_repeat(4,_1fr)_minmax(80px,_auto)] border-b-2 border-gray-200 bg-gray-50 text-xs font-semibold uppercase tracking-wider text-gray-600">
                                    <div class="py-3 px-4 text-left">Product</div>
                                    <div class="py-3 px-4 text-left">Power</div>
                                    <div class="py-3 px-4 text-left">Poles</div>
                                    <div class="py-3 px-4 text-left">Frame</div>
                                    <div class="py-3 px-4 text-left">Voltage</div>
                                    <div class="py-3 px-4 text-right"><span class="sr-only">Details</span></div>
                                </div>
                                <div id="product-table-body" role="rowgroup">
                                    @foreach ($products as $prod)
                                        <div role="row"
                                            class="group relative grid grid-cols-[minmax(300px,_3fr)_repeat(4,_1fr)_minmax(80px,_auto)] items-center border-b border-gray-200 transition-colors duration-300 last:border-b-0 hover:bg-orange-50/50">
                                            <div class="whitespace-nowrap py-4 px-4">
                                                <h4 class="truncate text-base font-bold text-gray-900">
                                                    {{ $prod->unique_id }}</h4>
                                                <p class="truncate text-sm text-gray-500">
                                                    {{ $prod->getTranslation('name', $lang) }}</p>
                                            </div>
                                            <div class="whitespace-nowrap py-4 px-4 text-sm text-gray-700">
                                                {{ $prod->power }}</div>
                                            <div class="whitespace-nowrap py-4 px-4 text-sm text-gray-700">
                                                {{ $prod->poles }}</div>
                                            <div class="whitespace-nowrap py-4 px-4 text-sm text-gray-700">
                                                {{ $prod->frame_size }}</div>
                                            <div class="whitespace-nowrap py-4 px-4 text-sm text-gray-700">
                                                {{ $prod->voltage }}</div>
                                            <div class="relative z-30 flex items-center justify-end pr-6">
                                                <div
                                                    class="flex h-10 w-10 scale-75 items-center justify-center  bg-[#f16c31] text-white opacity-0 shadow-lg transition-all duration-300 group-hover:scale-100 group-hover:opacity-100">
                                                    <i class="fi fi-rr-arrow-right text-lg"></i>
                                                </div>
                                            </div>
                                            <a href="{{ route('product-detail', ['slug' => $prod->slug]) }}"
                                                class="absolute inset-0 z-20"
                                                aria-label="View details for {{ $prod->unique_id }}"></a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        @if ($products->hasMorePages())
                            <div class="mt-12 flex justify-center" id="load-more-container">
                                <button id="load-more-button" data-next-page-url="{{ $products->nextPageUrl() }}"
                                    class="flex items-center gap-3  bg-[#f16c31] px-8 py-3 font-medium text-white shadow transition hover:bg-cyan-700">
                                    <svg class="h-5 w-5 animate-spin hidden" id="loader-icon"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V4a10 10 0 00-10 10h2z"></path>
                                    </svg>
                                    <span id="load-more-label">Load More</span>
                                </button>
                            </div>
                        @endif
                    @else
                        <div class="rounded-lg border border-dashed border-gray-300 bg-white p-12 text-center">
                            <h3 class="text-xl font-medium text-gray-800">No products found</h3>
                            <p class="mt-2 text-gray-500">Try adjusting your filters or search term.</p>
                            <a href="{{ route('products.category', $category->slug) }}"
                                class="mt-6 inline-block border border-orange-400 bg-white px-6 py-2 text-orange-700 shadow-sm transition hover:bg-orange-50">Reset
                                All Filters</a>
                        </div>
                    @endif
                </main>
            </x-container>
        </section>

        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const loadMoreContainer = document.getElementById('load-more-container');
                    if (!loadMoreContainer) return;

                    const loadMoreButton = document.getElementById('load-more-button');
                    const productTableBody = document.getElementById('product-table-body');
                    const productCountSpan = document.getElementById('product-count');
                    const loaderIcon = document.getElementById('loader-icon');
                    const buttonLabel = document.getElementById('load-more-label');
                    const totalCount = document.querySelector('[data-total-products]').dataset.totalProducts;

                    loadMoreButton.addEventListener('click', async function() {
                        let nextPageUrl = this.dataset.nextPageUrl;

                        // Show loader and disable button
                        loaderIcon.classList.remove('hidden');
                        buttonLabel.textContent = 'Loading...';
                        this.disabled = true;

                        try {
                            // Loop to fetch all remaining pages
                            while (nextPageUrl) {
                                const response = await fetch(nextPageUrl);
                                const html = await response.text();
                                const parser = new DOMParser();
                                const doc = parser.parseFromString(html, 'text/html');

                                const newProductsHtml = doc.getElementById('product-table-body').innerHTML;
                                productTableBody.insertAdjacentHTML('beforeend', newProductsHtml);

                                const newLoadMoreButton = doc.getElementById('load-more-button');
                                if (newLoadMoreButton) {
                                    nextPageUrl = newLoadMoreButton.dataset.nextPageUrl;
                                } else {
                                    nextPageUrl = null; // Exit loop if no more pages
                                }
                            }

                            // All products loaded, update count and remove the button
                            productCountSpan.textContent = totalCount;
                            loadMoreContainer.remove();

                        } catch (error) {
                            console.error('Error loading all products:', error);
                            buttonLabel.textContent = 'Failed to load';
                            loaderIcon.classList.add('hidden');
                            this.disabled = false;
                        }
                    });
                });
            </script>
        @endpush

    @endif

    @if ($category->getTranslation('title2', $lang))
        <section id="catalog-cta" class="overflow-hidden bg-slate-50 py-16 md:py-24">
            <x-container>
                <div class="grid grid-cols-1 items-center gap-8 lg:grid-cols-2 lg:gap-0">

                    <div class="animate-on-scroll" data-anim="clip-reveal">
                        <img src="{{ uploaded_asset($category->icon) }}"
                            alt="{{ $category->getTranslation('name', $lang) }} brochure image"
                            class="object-cover shadow-2xl">
                    </div>

                    <div class="relative z-10 lg:-ml-20">
                        <div class="animate-on-scroll rounded-lg bg-white p-10 shadow-2xl md:p-12" data-anim="fade-up">

                            <h2 class="text-4xl font-light text-gray-800 md:text-5xl mb-4">
                                {{ $category->getTranslation('title2', $lang) ?: 'Dive Into the Details' }}
                            </h2>

                            <p class="mt-4 text-lg text-gray-600 leading-relaxed whitespace-pre-line">
                                {!! $category->getTranslation('content2', $lang) !!}
                            </p>

                        <div class="mt-8">
    @if (!empty($category->brochure))
        <x-button 
            href="{{ asset($category->brochure) }}" 
            target="_blank" 
            text="Download Brochure"
            class="px-8 py-3 text-base font-medium"
        />
    @else
        <x-button 
            href="{{ url('/brochures') }}" 
            text="Explore Catalogues"
            class="px-8 py-3 text-base font-medium"
        />
    @endif
</div>


                        </div>
                    </div>

                </div>
            </x-container>
        </section>
    @endif


    {{-- 5. Related Categories Section --}}
    @if ($category->childs->where('is_active', 1)->isNotEmpty())
        <section class="border-t border-stone-200 bg-stone-100 py-16">
            <x-container>
                <div class="mb-8 flex items-end justify-between">
                    <h2 class="animate-on-scroll text-3xl font-light text-stone-900">Related Categories</h2>
                </div>
                <div class="custom-scrollbar animate-on-scroll -mx-4 overflow-x-auto pb-8">
                    <div class="flex gap-6 px-4">
                        @foreach ($category->childs->where('is_active', 1) as $cat)
                            <a href="{{ route('products.category', ['category_slug' => $cat->slug]) }}"
                                class="group relative block h-[28rem] w-80 flex-shrink-0 overflow-hidden rounded-lg shadow-lg md:w-96">
                                <img src="{{ uploaded_asset($cat->image) }}"
                                    alt="{{ $cat->getTranslation('name', $lang) }}"
                                    class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 ease-in-out group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                                <div class="absolute inset-0 flex flex-col justify-end p-8 text-white">
                                    <h3 class="text-xl font-normal leading-tight text-white">
                                        {{ $cat->getTranslation('name', $lang) }}</h3>
                                </div>
                                <div
                                    class="absolute bottom-6 right-6 z-10 flex h-12 w-12 scale-75 items-center justify-center  bg-orange-500 text-white opacity-0 shadow-lg transition-all duration-300 group-hover:scale-100 group-hover:opacity-100">
                                    <i class="fi fi-rr-arrow-right text-xl"></i>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </x-container>
        </section>
    @endif

@endsection
