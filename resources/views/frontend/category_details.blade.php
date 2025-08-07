@extends('frontend.layouts.app')

@push('styles')
<style>
    /* A subtle grid background pattern for the dark sections */
    .dark-grid-background {
        background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        background-size: 2rem 2rem;
    }
    /* Suggestion for premium headings */
    @import url('https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&display=swap');
    .premium-heading {
        font-family: 'Libre Baskerville', serif;
    }
</style>
@endpush

@section('content')

{{-- 1. Hero Section --}}
@include('components.page-title', [
    'title' => $category->getTranslation('name', $lang),
    'description' => $category->getTranslation('description', $lang),
    'image' => uploaded_asset($category->image),
    'theme' => 'dark',
])

{{-- 2. Key Specs "Dashboard" Section (Light Theme) --}}
@if ($category->frame_size || $category->output || $category->ip_class || $category->insulation_class || $category->efficiency)
<section class="my-16">
    <x-container>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-6">
            {{-- Frame Size --}}
            @if ($category->frame_size)
            <div class="group animate-on-scroll relative flex items-center gap-4 bg-white py-5 px-5 border border-gray-200 overflow-hidden hover:border-orange-400 transition-colors shadow-sm">
                <div class="absolute inset-0 bg-orange-400/10 -translate-x-full group-hover:translate-x-0 transition-transform duration-500 ease-in-out z-10 pointer-events-none"></div>
                <div class="relative flex items-center gap-4 z-20">
                    <div class="text-orange-500 bg-orange-50 p-3 transition-transform duration-500 ease-in-out group-hover:scale-110 shadow">
                        <svg class="w-[38px] h-[38px]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m0 0v2.25m0-2.25h1.5m-1.5 0H7.5m6-9v1.5m0 0v1.5m0-1.5h1.5m-1.5 0H12m6 0v1.5m0 0v1.5m0-1.5h1.5m-1.5 0H18M9 21l-1.5-1.5m0 0l-1.5-1.5m3 3l1.5-1.5m0 0l1.5-1.5m-3-3l-1.5 1.5m0 0l-1.5 1.5m3-3l1.5 1.5m0 0l1.5 1.5M3 9l1.5 1.5m0 0l1.5 1.5m-3-3L6 12m0 0l1.5-1.5M9 3l1.5 1.5m0 0l1.5 1.5M12 6l1.5-1.5m0 0l1.5-1.5m-3 3L15 3m0 0l1.5 1.5m0 0l1.5 1.5M21 9l-1.5 1.5m0 0l-1.5 1.5m3-3L18 12m0 0l-1.5-1.5" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider group-hover:text-orange-700 transition-all">Frame Size</h3>
                        <span class="text-xl font-semibold text-gray-800 block transition-all duration-500 ease-in-out group-hover:text-2xl">
                            {{ $category->frame_size }}
                        </span>
                    </div>
                </div>
            </div>
            @endif

            {{-- Output --}}
            @if ($category->output)
            <div class="group animate-on-scroll relative flex items-center gap-4 bg-white py-5 px-5 border border-gray-200 overflow-hidden hover:border-orange-400 transition-colors shadow-sm">
                <div class="absolute inset-0 bg-orange-400/10 -translate-x-full group-hover:translate-x-0 transition-transform duration-500 ease-in-out z-10 pointer-events-none"></div>
                <div class="relative flex items-center gap-4 z-20">
                    <div class="text-orange-500 bg-orange-50 p-3 transition-transform duration-500 ease-in-out group-hover:scale-110 shadow">
                        <svg class="w-[38px] h-[38px]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider group-hover:text-orange-700 transition-all">Output</h3>
                        <span class="text-xl font-semibold text-gray-800 block transition-all duration-500 ease-in-out group-hover:text-2xl">
                            {{ $category->output }}
                        </span>
                    </div>
                </div>
            </div>
            @endif

            {{-- IP Class --}}
            @if ($category->ip_class)
            <div class="group animate-on-scroll relative flex items-center gap-4 bg-white py-5 px-5 border border-gray-200 overflow-hidden hover:border-orange-400 transition-colors shadow-sm">
                <div class="absolute inset-0 bg-orange-400/10 -translate-x-full group-hover:translate-x-0 transition-transform duration-500 ease-in-out z-10 pointer-events-none"></div>
                <div class="relative flex items-center gap-4 z-20">
                    <div class="text-orange-500 bg-orange-50 p-3 transition-transform duration-500 ease-in-out group-hover:scale-110 shadow">
                        <svg class="w-[38px] h-[38px]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider group-hover:text-orange-700 transition-all">IP Class</h3>
                        <span class="text-xl font-semibold text-gray-800 block transition-all duration-500 ease-in-out group-hover:text-2xl">
                            {{ $category->ip_class }}
                        </span>
                    </div>
                </div>
            </div>
            @endif

            {{-- Insulation --}}
            @if ($category->insulation_class)
            <div class="group animate-on-scroll relative flex items-center gap-4 bg-white py-5 px-5 border border-gray-200 overflow-hidden hover:border-orange-400 transition-colors shadow-sm">
                <div class="absolute inset-0 bg-orange-400/10 -translate-x-full group-hover:translate-x-0 transition-transform duration-500 ease-in-out z-10 pointer-events-none"></div>
                <div class="relative flex items-center gap-4 z-20">
                    <div class="text-orange-500 bg-orange-50 p-3 transition-transform duration-500 ease-in-out group-hover:scale-110 shadow">
                        <svg class="w-[38px] h-[38px]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider group-hover:text-orange-700 transition-all">Insulation</h3>
                        <span class="text-xl font-semibold text-gray-800 block transition-all duration-500 ease-in-out group-hover:text-2xl">
                            {{ $category->insulation_class }}
                        </span>
                    </div>
                </div>
            </div>
            @endif

            {{-- Efficiency --}}
            @if ($category->efficiency)
            <div class="group animate-on-scroll relative flex items-center gap-4 bg-white py-5 px-5 border border-gray-200 overflow-hidden hover:border-orange-400 transition-colors shadow-sm">
                <div class="absolute inset-0 bg-orange-400/10 -translate-x-full group-hover:translate-x-0 transition-transform duration-500 ease-in-out z-10 pointer-events-none"></div>
                <div class="relative flex items-center gap-4 z-20">
                    <div class="text-orange-500 bg-orange-50 p-3 transition-transform duration-500 ease-in-out group-hover:scale-110 shadow">
                        <svg class="w-[38px] h-[38px]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider group-hover:text-orange-700 transition-all">Efficiency</h3>
                        <span class="text-xl font-semibold text-gray-800 block transition-all duration-500 ease-in-out group-hover:text-2xl">
                            {{ $category->efficiency }}
                        </span>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </x-container>
</section>
@endif


{{-- 4. Description Sections --}}
@if($category->getTranslation('title1', $lang) || $category->getTranslation('title2', $lang))
<section class="py-10 md:py-16 bg-gradient-to-tr from-stone-50 via-stone-100 to-stone-50">
    <x-container class="max-w-4xl mx-auto space-y-20">
        @if($category->getTranslation('title1', $lang))
        <div class="relative bg-white animate-on-scroll shadow-lg px-8 py-12 md:px-12 md:py-16 overflow-hidden">
            <span class="absolute top-15 left-8 h-10 w-1 bg-[#0a8268]"></span>
            <h3 class="relative animate-on-scroll text-4xl md:text-3xl font-light text-stone-900 mb-8 tracking-wide drop-shadow-sm">
                {{ $category->getTranslation('title1', $lang) }}
            </h3>
            <div class="prose animate-on-scroll prose-lg max-w-none text-stone-700 leading-relaxed drop-shadow-[0_0_1px_rgba(0,0,0,0.03)]">
                {!! $category->getTranslation('content1', $lang) !!}
            </div>
        </div>
        @endif

        @if($category->getTranslation('title2', $lang))
        <div class="relative bg-white shadow-lg px-8 py-12 md:px-12 md:py-16 overflow-hidden mt-16">
            <span class="absolute top-15 left-8 h-10 w-1 bg-orange-400"></span>
            <h3 class="relative animate-on-scroll text-4xl md:text-3xl font-light text-stone-900 mb-8 tracking-wide drop-shadow-sm">
                {{ $category->getTranslation('title2', $lang) }}
            </h3>
            <div class="prose animate-on-scroll prose-lg max-w-none text-stone-700 leading-relaxed drop-shadow-[0_0_1px_rgba(0,0,0,0.03)]">
                {!! $category->getTranslation('content2', $lang) !!}
            </div>
        </div>
        @endif
    </x-container>
</section>
@endif


{{-- Conditionally display Filter and Product sections --}}
@if ($products->isNotEmpty() || collect(request()->query())->except(['page', 'keyword'])->isNotEmpty())
    
    {{-- Filter Bar --}}
    <section class="pt-[50px] pb-[20px] bg-white" x-data="{ open: false }">
        <x-container>
            @php
                $filterOptions = [
                    'frame_size' => $frameSizes ?? [],
                    'poles'      => $poles ?? [],
                    'power'      => $powers ?? [],
                    'mounting'   => $mountings ?? [],
                    'voltage'    => $voltages ?? [],
                ];
            @endphp
    
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 w-full">
                <div class="w-full md:w-full">
                    <button
                        type="button"
                        class="mb-4 bg-orange-600 text-white px-6 py-2 shadow hover:bg-orange-700 transition font-medium flex items-center gap-2"
                        @click="open = !open"
                        :aria-expanded="open"
                    >
                        <svg :class="{'rotate-180': open}" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                        <span x-text="open ? 'Hide Filters' : 'Show Filters'"></span>
                    </button>
    
                    <div
                        x-show="open"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                        class="w-full"
                    >
                        <form id="live-filter-form"
                              class="mt-4 w-full flex flex-wrap gap-4"
                              method="GET"
                              action="{{ route('products.category', $category->slug) }}"
                        >
                            @foreach (['frame_size', 'poles', 'power', 'mounting', 'voltage'] as $filter)
                                <div class="flex flex-col min-w-[120px]">
                                    <label class="block text-sm font-semibold text-gray-800 mb-2 capitalize">
                                        {{ trans("messages.$filter") }}
                                    </label>
                                    <select name="{{ $filter }}"
                                            class="form-select w-full bg-white text-gray-900 border-gray-300 shadow-sm focus:border-orange-400 focus:ring-orange-300"
                                    >
                                        <option value="">{{ trans("messages.$filter") }}</option>
                                        @foreach($filterOptions[$filter] as $opt)
                                            <option value="{{ $opt }}" @selected(request($filter) == $opt)>{{ $opt }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
    
                            <div class="flex justify-end gap-2 items-end mt-6 md:mt-0">
                                <button type="submit"
                                        class="bg-orange-600 text-white px-6 py-2 h-[40px] shadow hover:bg-orange-700 transition w-full"
                                >
                                    Apply
                                </button>
                                <a href="{{ route('products.category', $category->slug) }}"
                                   class="bg-white text-orange-700 border border-orange-400 px-6 py-2 shadow hover:bg-orange-50 transition w-full text-center"
                                >
                                    Reset
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
    
                <form class="w-full md:w-auto max-w-lg ml-auto flex mt-4 md:mt-0"
                      method="GET"
                      action="{{ route('products.category', $category->slug) }}"
                      autocomplete="off">
                    <input name="keyword"
                           type="text"
                           value="{{ request('keyword') }}"
                           placeholder="Search by ID or Name..."
                           class="form-input w-full bg-white text-gray-900 border-gray-300 shadow-sm focus:border-orange-400 focus:ring-orange-300" />
                    <button type="submit"
                            class="bg-[#0a8268] text-white px-6 py-2 shadow hover:bg-[#f06425] transition">
                        Search
                    </button>
                </form>
            </div>
        </x-container>
    </section>
    
    {{-- Main Product Table --}}
    <section class="pt-[30px] pb-[70px] bg-gray-50">
        <x-container>
            <main>
                @if ($products->isNotEmpty())
                    <div class="mb-8">
                        <h2 class="text-3xl font-light text-gray-900">
                            Showing {{ $products->total() }} Products
                        </h2>
                    </div>
    
                    <div class="bg-white border border-gray-200 shadow-sm overflow-x-auto">
                        <div role="table" class="min-w-full">
                            <div role="rowheader" class="grid grid-cols-[minmax(300px,_3fr)_repeat(4,_1fr)_minmax(80px,_auto)] bg-gray-100/70 text-xs font-semibold text-gray-600 uppercase tracking-wider border-b-2 border-gray-200">
                                <div class="p-4 text-left">Product</div>
                                <div class="p-4 text-left">Power</div>
                                <div class="p-4 text-left">Poles</div>
                                <div class="p-4 text-left">Frame</div>
                                <div class="p-4 text-left">Voltage</div>
                                <div class="p-4 text-right"><span class="sr-only">Details</span></div>
                            </div>
    
                            <div id="product-table-body" role="rowgroup">
                                @foreach ($products as $prod)
                                    <div role="row" class="group relative grid grid-cols-[minmax(300px,_3fr)_repeat(4,_1fr)_minmax(80px,_auto)] items-center border-b border-gray-200 last:border-b-0 hover:bg-orange-50/50 transition-colors duration-300">
                                        <div class="p-4 whitespace-nowrap">
                                            <h4 class="text-base font-bold text-gray-900 truncate">{{ $prod->unique_id }}</h4>
                                            <p class="text-sm text-gray-500 truncate">{{ $prod->getTranslation('name', $lang) }}</p>
                                        </div>
    
                                        <div class="p-4 text-sm text-gray-700 whitespace-nowrap">{{ $prod->power }}</div>
                                        <div class="p-4 text-sm text-gray-700 whitespace-nowrap">{{ $prod->poles }}</div>
                                        <div class="p-4 text-sm text-gray-700 whitespace-nowrap">{{ $prod->frame_size }}</div>
                                        <div class="p-4 text-sm text-gray-700 whitespace-nowrap">{{ $prod->voltage }}</div>
                                        
                                        <div class="relative z-30 flex justify-end items-center pr-6">
                                            <div class="text-white bg-[#0a8268] p-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform scale-75 group-hover:scale-100 shadow-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 128 128">
                                                    <path d="M44 108c-1.023 0-2.047-.391-2.828-1.172-1.563-1.563-1.563-4.094 0-5.656l37.172-37.172-37.172-37.172c-1.563-1.563-1.563-4.094 0-5.656s4.094-1.563 5.656 0l40 40c1.563 1.563 1.563 4.094 0 5.656l-40 40c-.781.781-1.805 1.172-2.828 1.172z" fill="currentColor"></path>
                                                </svg>
                                            </div>
                                        </div>
    
                                        <a href="{{ route('product-detail', ['slug' => $prod->slug]) }}" class="absolute inset-0 z-20" aria-label="View details for {{ $prod->unique_id }}"></a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
    
                    @if ($products->hasMorePages())
                        <div class="mt-12 flex justify-center">
                            <button id="load-more"
                                    data-next-page="{{ $products->currentPage() + 1 }}"
                                    class="bg-[#0a8268] text-white px-8 py-3 shadow hover:bg-cyan-700 transition font-medium text-lg flex items-center gap-2">
                                <svg class="w-5 h-5 animate-spin hidden" id="loader-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                                </svg>
                                <span id="load-more-label">Load More</span>
                            </button>
                        </div>
                    @endif
                @endif
            </main>
        </x-container>
    </section>

@endif


{{-- 5. Related Categories --}}
@if ($category->childs->where('is_active', 1)->isNotEmpty())
<section class="py-14 md:py-14 bg-stone-100 border-t border-stone-200">
    <x-container>
        <div class="flex justify-between items-end mb-8">
            <h2 class="text-3xl font-light text-stone-900 animate-on-scroll">Related Categories</h2>
        </div>
        <div class="custom-scrollbar animate-on-scroll -mx-4 overflow-x-auto pb-8">
            <div class="flex gap-6 px-4">
            @foreach ($category->childs->where('is_active', 1) as $cat)
                <a href="{{ route('products.category',['category_slug' => $cat->slug]) }}" class="group relative block w-80 md:w-96 flex-shrink-0 h-[28rem] overflow-hidden shadow-lg">
                    <img src="{{ uploaded_asset($cat->image) }}" alt="{{ $cat->getTranslation('name', $lang) }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 ease-in-out group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                    <div class="absolute inset-0 p-8 flex flex-col justify-end text-white">
                        <h3 class="text-xl font-normal leading-tight text-white">{{ $cat->getTranslation('name', $lang) }}</h3>
                    </div>
                    <div class="absolute bottom-6 right-6 z-10 text-white bg-[#0a8268] p-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform scale-75 group-hover:scale-100 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 128 128">
                            <path d="M44 108c-1.023 0-2.047-.391-2.828-1.172-1.563-1.563-1.563-4.094 0-5.656l37.172-37.172-37.172-37.172c-1.563-1.563-1.563-4.094 0-5.656s4.094-1.563 5.656 0l40 40c1.563 1.563 1.563 4.094 0 5.656l-40 40c-.781.781-1.805 1.172-2.828 1.172z" fill="currentColor"></path>
                        </svg>
                    </div>
                </a>
            @endforeach
            </div>
        </div>
    </x-container>
</section>
@endif

@endsection