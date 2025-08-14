@extends('frontend.layouts.app')

@section('content')

{{-- 1. Title & Hero Section --}}
@include('components.page-title', [
    'title' => $page->getTranslation('title', $lang),
    'description' => $page->getTranslation('content', 'en'),
    'image' => getPageImage($page->type),
    'theme' => 'dark'
])

{{-- 2. Products Used Section (Static Content) --}}
<section class="mt-16 bg-[#454d4e] py-16 text-slate-300 md:py-24">
    <x-container>
        <div class="grid grid-cols-1 items-start gap-12 lg:grid-cols-5 lg:gap-10">
            {{-- Left Column: Sticky Image --}}
            <div id="industryStickyImage" class="self-start lg:col-span-2 lg:sticky lg:top-24">
                <div class="relative h-full max-h-[800px] overflow-hidden shadow-2xl shadow-black/30">
                    <img src="{{ getPageImage($page->type) }}"
                         alt="{{ $page->getTranslation('title', $lang) }}"
                         class="h-full w-full object-cover">
                </div>
            </div>

            {{-- Right Column: Scroll Content --}}
            <div id="industryScrollContent" class="space-y-16 lg:col-span-3">
                {{-- Section Header --}}
                <div>
                    <div class="mb-8 border-l-2 border-orange-500 pl-4">
                        <h3 class="animate-on-scroll text-3xl font-light text-white">
                            Products Used
                        </h3>
                        <p class="animate-on-scroll mt-2 text-gray-200">
                            Our range of electric motors, engineered for industrial demands with proven efficiency and reliability.
                        </p>
                    </div>

                    {{-- Static Products Grid --}}
                    <div id="industryProductGrid" class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        {{-- Static Products --}}
                        <div class="group border border-[#3a4142] p-6 transition-all duration-300 hover:border-orange-500/80 hover:bg-[#3a4142]">
                            <h4 class="text-xl font-normal text-slate-100">IEC Motors</h4>
                            <p class="mt-1 text-sm text-gray-200">High-efficiency IEC three-phase motors for long-lasting industrial performance.</p>
                        </div>

                        <div class="group border border-[#3a4142] p-6 transition-all duration-300 hover:border-orange-500/80 hover:bg-[#3a4142]">
                            <h4 class="text-xl font-normal text-slate-100">Special Motors</h4>
                            <p class="mt-1 text-sm text-gray-200">Purpose-built motors including dual-speed, inverter-duty, and brake motors.</p>
                        </div>

                        <div class="group border border-[#3a4142] bg-[#313738] p-6 transition-all duration-300 hover:border-orange-500/80 hover:bg-[#3a4142] md:col-span-2">
                            <h4 class="text-xl font-normal text-slate-100">Custom Solutions</h4>
                            <p class="mt-1 text-sm text-gray-200">Fully tailored motor solutions to meet your application's unique mechanical and electrical needs.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</section>



{{-- Static Products Section --}}
<section class="mt-16 bg-[#454d4e] py-16 text-slate-300 md:py-24">
    <x-container>

                        <div class="mb-16 border-l-2 border-orange-500 pl-4">
                        <h3 class="animate-on-scroll text-3xl font-light text-white">
                            Products Used
                        </h3>
                        <p class="animate-on-scroll mt-2 text-gray-200">
                            Our range of electric motors, engineered for industrial demands with proven efficiency and reliability.
                        </p>
                    </div>



        <div id="industryProductGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            {{-- Static Product Cards --}}
            <a href="#" class="group relative bg-white border border-slate-200 shadow hover:shadow-xl overflow-hidden transition-all duration-300 flex flex-col">
                {{-- Image --}}
                <div class="relative w-full h-60 overflow-hidden">
                    <img src="path/to/your/image.jpg" alt="3 Phase Electric Motors"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                </div>
                {{-- Details --}}
                <div class="p-6 flex flex-col gap-3">
                    <h3 class="text-xl font-normal text-slate-900 group-hover:text-orange-600 transition-colors">
                        3 Phase Electric Motors
                    </h3>
                </div>
                {{-- Arrow Action --}}
                <div class="absolute bottom-6 right-6 z-10 text-white bg-[#0a8268] p-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform scale-75 group-hover:scale-100 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 128 128">
                        <path d="M44 108c-1.023 0-2.047-.391-2.828-1.172-1.563-1.563-1.563-4.094 0-5.656l37.172-37.172-37.172-37.172c-1.563-1.563-1.563-4.094 0-5.656s4.094-1.563 5.656 0l40 40c1.563 1.563 1.563 4.094 0 5.656l-40 40c-.781.781-1.805 1.172-2.828 1.172z" fill="currentColor"></path>
                    </svg>
                </div>
            </a>

            <a href="#" class="group relative bg-white border border-slate-200 shadow hover:shadow-xl overflow-hidden transition-all duration-300 flex flex-col">
                {{-- Image --}}
                <div class="relative w-full h-60 overflow-hidden">
                    <img src="path/to/your/image.jpg" alt="Single Phase Motors"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                </div>
                {{-- Details --}}
                <div class="p-6 flex flex-col gap-3">
                    <h3 class="text-xl font-normal text-slate-900 group-hover:text-orange-600 transition-colors">
                        Single Phase Motors
                    </h3>
                </div>
                {{-- Arrow Action --}}
                <div class="absolute bottom-6 right-6 z-10 text-white bg-[#0a8268] p-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform scale-75 group-hover:scale-100 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 128 128">
                        <path d="M44 108c-1.023 0-2.047-.391-2.828-1.172-1.563-1.563-1.563-4.094 0-5.656l37.172-37.172-37.172-37.172c-1.563-1.563-1.563-4.094 0-5.656s4.094-1.563 5.656 0l40 40c1.563 1.563 1.563 4.094 0 5.656l-40 40c-.781.781-1.805 1.172-2.828 1.172z" fill="currentColor"></path>
                    </svg>
                </div>
            </a>

            <a href="#" class="group relative bg-white border border-slate-200 shadow hover:shadow-xl overflow-hidden transition-all duration-300 flex flex-col">
                {{-- Image --}}
                <div class="relative w-full h-60 overflow-hidden">
                    <img src="path/to/your/image.jpg" alt="High Temperature Electric Motors"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                </div>
                {{-- Details --}}
                <div class="p-6 flex flex-col gap-3">
                    <h3 class="text-xl font-normal text-slate-900 group-hover:text-orange-600 transition-colors">
                        High Temperature Electric Motors
                    </h3>
                </div>
                {{-- Arrow Action --}}
                <div class="absolute bottom-6 right-6 z-10 text-white bg-[#0a8268] p-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform scale-75 group-hover:scale-100 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 128 128">
                        <path d="M44 108c-1.023 0-2.047-.391-2.828-1.172-1.563-1.563-1.563-4.094 0-5.656l37.172-37.172-37.172-37.172c-1.563-1.563-1.563-4.094 0-5.656s4.094-1.563 5.656 0l40 40c1.563 1.563 1.563 4.094 0 5.656l-40 40c-.781.781-1.805 1.172-2.828 1.172z" fill="currentColor"></path>
                    </svg>
                </div>
            </a>

            <a href="#" class="group relative bg-white border border-slate-200 shadow hover:shadow-xl overflow-hidden transition-all duration-300 flex flex-col">
                {{-- Image --}}
                <div class="relative w-full h-60 overflow-hidden">
                    <img src="path/to/your/image.jpg" alt="Medium & High Electric Voltage Motors"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                </div>
                {{-- Details --}}
                <div class="p-6 flex flex-col gap-3">
                    <h3 class="text-xl font-normal text-slate-900 group-hover:text-orange-600 transition-colors">
                        Medium & High Electric Voltage Motors
                    </h3>
                </div>
                {{-- Arrow Action --}}
                <div class="absolute bottom-6 right-6 z-10 text-white bg-[#0a8268] p-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform scale-75 group-hover:scale-100 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 128 128">
                        <path d="M44 108c-1.023 0-2.047-.391-2.828-1.172-1.563-1.563-1.563-4.094 0-5.656l37.172-37.172-37.172-37.172c-1.563-1.563-1.563-4.094 0-5.656s4.094-1.563 5.656 0l40 40c1.563 1.563 1.563 4.094 0 5.656l-40 40c-.781.781-1.805 1.172-2.828 1.172z" fill="currentColor"></path>
                    </svg>
                </div>
            </a>

            <a href="#" class="group relative bg-white border border-slate-200 shadow hover:shadow-xl overflow-hidden transition-all duration-300 flex flex-col">
                {{-- Image --}}
                <div class="relative w-full h-60 overflow-hidden">
                    <img src="path/to/your/image.jpg" alt="Felco Special Motors & Slip Ring Motors"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                </div>
                {{-- Details --}}
                <div class="p-6 flex flex-col gap-3">
                    <h3 class="text-xl font-normal text-slate-900 group-hover:text-orange-600 transition-colors">
                        Felco Special Motors & Slip Ring Motors
                    </h3>
                </div>
                {{-- Arrow Action --}}
                <div class="absolute bottom-6 right-6 z-10 text-white bg-[#0a8268] p-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform scale-75 group-hover:scale-100 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 128 128">
                        <path d="M44 108c-1.023 0-2.047-.391-2.828-1.172-1.563-1.563-1.563-4.094 0-5.656l37.172-37.172-37.172-37.172c-1.563-1.563-1.563-4.094 0-5.656s4.094-1.563 5.656 0l40 40c1.563 1.563 1.563 4.094 0 5.656l-40 40c-.781.781-1.805 1.172-2.828 1.172z" fill="currentColor"></path>
                    </svg>
                </div>
            </a>
        </div>
    </x-container>
</section>









{{-- 3. Applications Section (Static Content) --}}
<section id="applicationSection" class="bg-white py-16 text-slate-800 md:py-24">
    <x-container>
        {{-- Section Header --}}
        <div id="applicationHeader" class="mb-12 border-l-2 border-orange-500 pl-4">
            <h3 class="animate-on-scroll text-3xl font-light text-slate-900">
                Applications
            </h3>
            <p class="animate-on-scroll mt-2 text-slate-600">
                Discover where our motors deliver value, from smart factories to mission-critical industrial equipment.
            </p>
        </div>

        {{-- Applications Grid --}}
        <div id="applicationGrid" class="grid grid-cols-1 gap-6 md:grid-cols-3">
            {{-- Air Handling Units --}}
            <div class="application-card group border border-gray-300 bg-gray-100 p-6 transition-all duration-300 hover:border-orange-500 hover:bg-gray-50">
                <h4 class="text-xl font-normal text-slate-900">Air handling units (AHUs) and ventilation fans</h4>
          
            </div>

            {{-- Chillers, Condensers, and Cooling Towers --}}
            <div class="application-card group border border-gray-300 bg-gray-100 p-6 transition-all duration-300 hover:border-orange-500 hover:bg-gray-50">
                <h4 class="text-xl font-normal text-slate-900">Chillers, condensers, and cooling towers</h4>
    
            </div>

            {{-- Water Circulation and Pumps --}}
            <div class="application-card group border border-gray-300 bg-gray-100 p-6 transition-all duration-300 hover:border-orange-500 hover:bg-gray-50">
                <h4 class="text-xl font-normal text-slate-900">Water circulation, booster pumps, and hydronic systems</h4>
         
            </div>
        </div>
    </x-container>
</section>


@endsection
