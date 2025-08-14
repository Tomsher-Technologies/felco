@php
    // --- MOCK DATA FOR DEMONSTRATION ---
    $currentLang = 'EN';
    $availableLangs = [
        'EN' => ['name' => 'English', 'route' => '#'],

        'FR' => ['name' => 'Français', 'route' => '#'],
    ];
    // --- END MOCK DATA ---

    $lang = getActiveLanguage();
    $details = getCategoryHeader();
    $industriesPages = \App\Models\Page::where('industy', 1)->where('status', 1)->get();
    $industries = \App\Models\Industry::where('is_active', 1)->get();

    $services = [
        [
            'route' => 'brochures',
            'title' => trans('messages.brochures'),
            'content' => get_setting('brochure_content', null, $lang),
        ],
        [
            'route' => 'certificates',
            'title' => trans('messages.certificates'),
            'content' => get_setting('certificate_content', null, $lang),
        ],
        [
            'route' => 'manuals',
            'title' => trans('messages.manuals'),
            'content' => get_setting('manuals_content', null, $lang),
        ],
        [
            'route' => 'service_sales',
            'title' => trans('messages.service_after_sales'),
            'content' => get_setting('service_sales_content', null, $lang),
        ],
    ];
@endphp

{{--
  The sticky positioning is correctly applied here with `sticky top-0 z-50`.
  If it's not working, check parent elements (like the <body> tag) for an `overflow: hidden`
  or `overflow-x: hidden` style in your CSS and remove it.
--}}
<nav id="site-header" x-data="{ openDropdown: null, mobileMenuOpen: false, langSwitcherOpen: false }" @click.away="openDropdown = null; langSwitcherOpen = false"
    class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50 w-full transition-all duration-300 ease-in-out">


    <x-container>
        <div class="flex flex-wrap justify-between items-center mx-auto w-full">

            {{-- Logo --}}
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img src="{{ asset('assets/images/logo/logo-color.svg') }}" class="h-[40px]" alt="Site Logo" />
                </a>
            </div>

            {{-- Desktop Menu & Megamenu Wrapper --}}
            <div class="hidden md:flex flex-1 justify-center">
                <div class="relative" @mouseleave="openDropdown = null">
                    {{-- Desktop Menu Links --}}
                    <ul class="flex flex-row space-x-6 rtl:space-x-reverse">
                        <li>
                            <a href="{{ route('home') }}"
                                class="text-black text-lg font-medium hover:text-orange-500 font-light py-2 inline-block">{{ trans('messages.home') }}</a>
                        </li>



                        {{-- PRODUCTS --}}
                        <li class="py-2">
                            <a href="{{ url('/products') }}" @mouseenter="openDropdown = 'products'"
                                @click.prevent="window.location.href='{{ url('/products') }}'"
                                class="flex items-center text-lg font-medium text-black hover:text-orange-500">
                                {{ trans('messages.products') }}
                                <svg class="w-2.5 h-2.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </a>
                        </li>

                        {{-- INDUSTRIES --}}
                        <li class="py-2">
                            <a href="{{ url('/industries') }}" @mouseenter="openDropdown = 'industries'"
                                @click.prevent="window.location.href='{{ url('/industries') }}'"
                                class="flex items-center text-lg font-medium text-black hover:text-orange-500">
                                {{ trans('messages.industries') }}
                                <svg class="w-2.5 h-2.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </a>
                        </li>



                        <li class="py-2">
                            <button @mouseenter="openDropdown = 'service'"
                                @click.prevent="openDropdown = (openDropdown === 'service' ? null : 'service')"
                                class="flex items-center text-lg font-medium text-black hover:text-orange-500">
                                {{ trans('messages.service_support') }}
                                <svg class="w-2.5 h-2.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                        </li>
                        <li>
                            <a href="{{ route('about_us') }}"
                                class="text-black  text-lg font-medium  hover:text-orange-500 font-light py-2 inline-block">{{ trans('messages.about_us') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}"
                                class="text-black text-lg font-medium hover:text-orange-500 font-light py-2 inline-block">{{ trans('messages.contact_us') }}</a>
                        </li>
                    </ul>

                    {{-- Megamenus Container --}}
                    <div class="absolute top-full left-1/2 -translate-x-1/2 w-screen" x-show="openDropdown" x-cloak
                        x-transition:enter="transition ease-in-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-2">

                        <div class="bg-white border-t border-gray-200 shadow-lg mt-2">
                            <x-container>



                                <div x-show="openDropdown === 'products'" class="px-6 py-8">
                                    <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-6 ">
                                        Products</h3>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                                        {{-- Loop through product categories --}}
                                        @foreach ($details['header_categories'] as $category)
                                            <a href="{{ route('products.category', ['category_slug' => $category->slug]) }}"
                                                class="group relative block bg-white border border-gray-200 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
                                                <div
                                                    class="absolute left-0 top-0 h-full w-1 bg-[#f06425] scale-y-0 group-hover:scale-y-100 transition-transform origin-top duration-300 ease-in-out">
                                                </div>
                                                <div class="p-5 space-y-1">
                                                    <h4
                                                        class="text-lg font-normal leading-tight text-gray-800 group-hover:text-[#f06425] transition-colors">
                                                        {{ $category->getTranslation('name', $lang) }}
                                                    </h4>
                                                    <p class="text-sm text-gray-500 line-clamp-2">
                                                        {{ $category->getTranslation('home_content', $lang) }}
                                                    </p>
                                                </div>
                                            </a>
                                        @endforeach

                                        {{-- "View All Products" card with a slightly darker gradient background --}}
                                        <a href="{{ url('/products') }}"
                                            class="group relative block bg-gradient-to-r from-orange-100 via-gray-50 to-white border border-gray-200 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
                                            <div
                                                class="absolute left-0 top-0 h-full w-1 bg-[#f06425] scale-y-0 group-hover:scale-y-100 transition-transform origin-top duration-300 ease-in-out">
                                            </div>
                                            <div class="p-5 space-y-1">
                                                <h4
                                                    class="text-lg font-normal leading-tight text-gray-800 group-hover:text-[#f06425] transition-colors">
                                                    View All Products
                                                </h4>
                                                <p class="text-sm text-gray-500 line-clamp-2">
                                                    Browse our complete collection and find what you need.
                                                </p>
                                            </div>
                                        </a>

                                    </div>
                                </div>

                                <div x-show="openDropdown === 'industries'" x-cloak class="px-6 py-8"
                                    @mouseenter="openDropdown = 'industries'" @mouseleave="openDropdown = null">

                                    <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-4">
                                        {{ trans('messages.industries') }}
                                    </h3>

                                    <nav aria-label="All industries list" class="grid grid-cols-2 md:grid-cols-4 gap-2">
                                        @foreach ($industries as $pdt)
                                            <a href="{{ route('industry.details', ['type' => $pdt->slug]) }}"
                                                class="group relative flex items-center px-4 py-3 bg-white border border-slate-200
                                                hover:border-[#f06425] hover:bg-orange-50 text-md font-normal text-slate-800
                                                transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#f06425]">
                                                <div
                                                    class="absolute left-0 top-0 h-full w-1 bg-[#f06425] scale-y-0
                                                    group-hover:scale-y-100 transition-transform origin-top duration-300 ease-in-out">
                                                </div>

                                                <span>{{ $pdt->getTranslation('name', $lang) }}</span>
                                            </a>
                                        @endforeach
                                    </nav>

                                    <div
                                        class="mt-6 py-4 pl-5 border-t border-slate-200 bg-gradient-to-r from-orange-50 via-white to-white">
                                        <a href="{{ route('industries.index') }}"
                                            class="group inline-flex items-center gap-2 font-normal text-[#f06425]
                                            text-base transition-all duration-300 hover:gap-3">
                                            {{ trans('messages.view') . ' ' . trans('messages.all') . ' ' . trans('messages.industries') }}
                                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <div x-show="openDropdown === 'service'" class="px-6 py-8">
                                    <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-6">
                                        Service & Support</h3>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                                        @foreach ($services as $service)
                                            <a href="{{ route($service['route']) }}"
                                                class="group relative block bg-white border border-gray-200 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
                                                <div
                                                    class="absolute left-0 top-0 h-full w-1 bg-[#f06425] scale-y-0 group-hover:scale-y-100 transition-transform origin-top duration-300 ease-in-out">
                                                </div>
                                                <div class="p-5 space-y-1">
                                                    <h4
                                                        class="text-lg font-normal leading-tight text-gray-800 group-hover:text-[#f06425] transition-colors">
                                                        {{ $service['title'] }}
                                                    </h4>
                                                    <p class="text-sm text-gray-500 line-clamp-2">
                                                        {{ $service['content'] }}
                                                    </p>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </x-container>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right-side actions: Language Switcher & CTA Button --}}
            <div class="flex items-center space-x-4">
                <div class="hidden md:flex items-center space-x-4">
                    {{-- Language Switcher --}}
                    <div class="relative">
                        <button @click="langSwitcherOpen = !langSwitcherOpen" type="button"
                            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 focus:outline-none">
                            {{ $currentLang }}
                            <svg class="w-4 h-4 ml-2 -mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="langSwitcherOpen" x-transition
                            class="origin-top-right absolute right-0 mt-2 w-40 shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                            x-cloak>
                            <div class="py-1">
                                @foreach ($availableLangs as $code => $langData)
                                    <a href="{{ $langData['route'] }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ $langData['name'] }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    {{-- CTA Button --}}
                    <a href="{{ route('contact') }}" id="contact-button"
                        class="relative inline-flex items-center justify-center gap-2 px-4 py-2 text-white font-semibold text-sm transition-all duration-300 shadow-lg group overflow-hidden bg-orange-500 hover:bg-white hover:text-white transform hover:-translate-y-1 hover:scale-95 hover:px-5 hover:py-2">

                        <span id="btn-fill-gsap"
                            class="absolute inset-0 z-0 bg-[#0a8268] transform scale-x-0 origin-left"></span>
                        <span
                            class="absolute inset-0 z-0 bg-[#f16c31] transform scale-x-0 origin-left transition-transform duration-300 ease-in-out group-hover:scale-x-100"></span>

                        <span id="btn-text-wrapper" class="relative z-10 flex items-center gap-2">
                            {{ trans('messages.get_in_to    uch') }}
                            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                    </a>









                    div>

                    {{-- Mobile Menu Hamburger Button --}}
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button"
                        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 md:hidden hover:bg-gray-100 focus:ou                    tline-none focus:ring-2 focus:ring-gray-200"
                        aria-controls="main-menu-mobile" :aria-expanded="mobileMenuOpen">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                        </svg>
                    </button>
                </div>
            </div>
    </x-container>

    {{-- Mobile Menu (Collapsible) --}}
    <div id="main-menu-mobile" :class="{ 'block': mobileMenuOpen, 'hidden': !mobileMenuOpen }"
        class="w-full md:hidden" x-cloak>
        <ul class="flex flex-col mt-4 font-medium space-y-2 p-4">
            <li><a href="{{ route('home') }}"
                    class="block py-2 px-3 text-gray-700 hover:bg-gray-100">{{ trans('messages.home') }}</a></li>
            <li>
                <button @click="openDropdown = (openDropdown === 'products' ? null : 'products')"
                    class="flex items-center justify-between w-full py-2 px-3 font-medium text-gray-700 hover:bg-gray-100">
                    <span>{{ trans('messages.products') }}</span>
                    <svg class="w-4 h-4 transition-transform duration-300"
                        :class="{ 'rotate-180': openDropdown === 'products' }" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </button>
                <div x-show="openDropdown === 'products'" x-collapse.duration.300ms class="pl-4 mt-2 space-y-2">
                    @foreach ($details['header_categories'] as $category)
                        <a href="{{ route('products.category', ['category_slug' => $category->slug]) }}"
                            class="block py-1 text-sm text-gray-600 hover:text-orange-500">{{ $category->getTranslation('name', $lang) }}</a>
                    @endforeach
                </div>
            </li>
            <li>
                <button @click="openDropdown = (openDropdown === 'industries' ? null : 'industries')"
                    class="flex items-center justify-between w-full py-2 px-3 font-medium text-gray-700 hover:bg-gray-100">
                    <span>{{ trans('messages.industries') }}</span>
                    <svg class="w-4 h-4 transition-transform duration-300"
                        :class="{ 'rotate-180': openDropdown === 'industries' }" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </button>
                <div x-show="openDropdown === 'industries'" x-collapse.duration.300ms class="pl-4 mt-2 space-y-2">
                    @foreach ($industriesPages as $pdt)
                        <a href="{{ route('industry.details', ['type' => $pdt->type]) }}"
                            class="block py-1 text-sm text-gray-600 hover:text-orange-500">{{ $pdt->getTranslation('title', $lang) }}</a>
                    @endforeach
                </div>
            </li>
            <li>
                <button @click="openDropdown = (openDropdown === 'service' ? null : 'service')"
                    class="flex items-center justify-between w-full py-2 px-3 font-medium text-gray-700 hover:bg-gray-100">
                    <span>{{ trans('messages.service_support') }}</span>
                    <svg class="w-4 h-4 transition-transform duration-300"
                        :class="{ 'rotate-180': openDropdown === 'service' }" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </button>
                <div x-show="openDropdown === 'service'" x-collapse.duration.300ms class="pl-4 mt-2 space-y-2">
                    @foreach ($services as $service)
                        <a href="{{ route($service['route']) }}"
                            class="block py-1 text-sm text-gray-600 hover:text-orange-500">{{ $service['title'] }}</a>
                    @endforeach
                </div>
            </li>
            <li><a href="{{ route('about_us') }}"
                    class="block py-2 px-3 text-gray-700 hover:bg-gray-100">{{ trans('messages.about_us') }}</a></li>
            <li><a href="{{ route('contact') }}"
                    class="block py-2 px-3 text-gray-700 hover:bg-gray-100">{{ trans('messages.contact_us') }}</a>
            </li>

            <li class="pt-4 mt-4 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <span class="font-medium text-gray-600 px-3">Language</span>
                    <div class="relative">
                        <button @click.stop="langSwitcherOpen = !langSwitcherOpen" type="button"
                            class="inline-flex items-center justify-center px-3 py-1 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300">
                            {{ $currentLang }}
                            <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="langSwitcherOpen" x-transition
                            class="origin-top-right absolute right-0 mt-2 w-40 shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                            <div class="py-1">
                                @foreach ($availableLangs as $code => $langData)
                                    <a href="{{ $langData['route'] }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ $langData['name'] }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <a href="{{ route('contact') }}"
                    class="block w-full mt-2 text-center text-sm px-4 py-2 leading-none border text-white bg-orange-500 hover:bg-orange-600">
                    {{ trans('messages.get_in_touch') }}
                </a>
            </li>
        </ul>
    </div>
</nav>
