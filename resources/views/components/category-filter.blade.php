{{-- resources/views/components/category-filter.blade.php --}}

@php
    // expects:
    // $category, $frameSizes, $poles, $powers, $mountings, $voltages, $lang
    $filterOptions = [
        'frame_size' => $frameSizes ?? [],
        'poles'      => $poles ?? [],
        'power'      => $powers ?? [],
        'mounting'   => $mountings ?? [],
        'voltage'    => $voltages ?? [],
    ];
@endphp

<section class="py-8 md:py-12 bg-orange-50 border-b border-stone-100">
    <x-container>
        <div class="flex items-center justify-between mb-6 gap-4 flex-wrap">
            <!-- Drawer Toggle Button -->
            <button
                type="button"
                data-drawer-target="cat-filter-drawer"
                data-drawer-show="cat-filter-drawer"
                data-drawer-placement="bottom"
                aria-controls="cat-filter-drawer"
                class="inline-flex items-center px-6 py-2 bg-orange-600 text-white font-medium rounded shadow hover:bg-orange-700 transition"
            >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm3 4h8M7 8v8m6-8v8" />
                </svg>
                Filters
            </button>
            <!-- Search Form (Always Visible) -->
            <form class="w-full md:w-auto max-w-md ml-auto flex" method="GET" action="{{ route('products.category', $category->slug) }}" autocomplete="off">
                <input name="keyword" type="text" value="{{ request('keyword') }}"
                    placeholder="Search by ID or Name..."
                    class="form-input w-full border-gray-300 rounded-l-md shadow-sm focus:border-orange-400 focus:ring-orange-300" />
                <button type="submit" class="bg-orange-600 text-white px-6 py-2 rounded-r-md shadow hover:bg-orange-700 transition">
                    Search
                </button>
            </form>
        </div>

        <!-- Flowbite Bottom Drawer Filter -->
        <div id="cat-filter-drawer"
            class="fixed z-40 w-full overflow-y-auto bg-white border-t border-gray-200 rounded-t-lg transition-transform bottom-0 left-0 right-0 translate-y-full"
            tabindex="-1"
            aria-labelledby="cat-filter-drawer-label">

            <!-- Drawer Handle + Header -->
            <div class="p-4 cursor-pointer hover:bg-gray-50 relative" data-drawer-toggle="cat-filter-drawer">
                <span class="absolute w-8 h-1 -translate-x-1/2 bg-gray-300 rounded-lg top-3 left-1/2"></span>
                <h2 id="cat-filter-drawer-label" class="inline-flex items-center text-xl font-bold text-slate-700">Filter Products</h2>
                <button type="button"
                    data-drawer-hide="cat-filter-drawer"
                    aria-controls="cat-filter-drawer"
                    class="absolute right-4 top-4 text-gray-500 hover:text-orange-600 focus:outline-none">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            <form id="live-filter-form" class="space-y-5 p-6" method="GET" action="{{ route('products.category', $category->slug) }}">
                @foreach (['frame_size', 'poles', 'power', 'mounting', 'voltage'] as $filter)
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2 capitalize">{{ trans("messages.$filter") }}</label>
                        <select name="{{ $filter }}"
                            class="form-select w-full border-gray-300 rounded-md shadow-sm focus:border-orange-400 focus:ring-orange-300">
                            <option value="">{{ trans("messages.$filter") }}</option>
                            @foreach($filterOptions[$filter] as $opt)
                                <option value="{{ $opt }}" @selected(request($filter) == $opt)>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                @endforeach

                <div class="flex gap-3 pt-2">
                    <button type="submit" class="bg-orange-600 text-white px-6 py-2 rounded shadow hover:bg-orange-700 transition w-full">
                        Apply
                    </button>
                    <a href="{{ route('products.category', $category->slug) }}"
                        class="bg-white text-orange-700 border border-orange-200 px-6 py-2 rounded shadow hover:bg-orange-50 transition w-full text-center">
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </x-container>
</section>
