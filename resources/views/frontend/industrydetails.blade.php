@extends('frontend.layouts.app')

@section('content')

{{-- 1. Title & Hero Section --}}
@include('components.page-title', [
    'title' => $page->getTranslation('title', $lang),
    'description' => $page->getTranslation('content', 'en'),
    'image' => getPageImage($page->type),
    'theme' => 'dark'
])




{{-- 2. Products Used Section (Dark Theme) --}}
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
                        <h3 class="animate-on-scroll text-3xl font-light text-white" >
                            Products Used
                        </h3>
                        <p class="animate-on-scroll mt-2 text-gray-200" >
                            Our range of electric motors, engineered for industrial demands with proven efficiency and reliability.
                        </p>
                    </div>

                    {{-- Grid --}}
                    <div id="industryProductGrid" class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        {{-- IEC Motors Card --}}
                        <div class="group border border-[#3a4142] p-6 transition-all duration-300 hover:border-orange-500/80 hover:bg-[#3a4142]">
                            <h4 class="text-xl font-normal text-slate-100">IEC Motors</h4>
                            <p class="mt-1 text-sm text-gray-200">High-efficiency IEC three-phase motors for long-lasting industrial performance.</p>
                        </div>

                        {{-- Special Motors Card --}}
                        <div class="group border border-[#3a4142] p-6 transition-all duration-300 hover:border-orange-500/80 hover:bg-[#3a4142]">
                            <h4 class="text-xl font-normal text-slate-100">Special Motors</h4>
                            <p class="mt-1 text-sm text-gray-200">Purpose-built motors including dual-speed, inverter-duty, and brake motors.</p>
                        </div>

                        {{-- Custom Solutions Card --}}
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


{{-- 3. Applications Section (Light Theme) --}}
<section id="applicationSection" class="bg-white py-16 text-slate-800 md:py-24">
    <x-container>
        {{-- Section Header --}}
        <div id="applicationHeader" class="mb-12 border-l-2 border-orange-500 pl-4">
            <h3 class="animate-on-scroll text-3xl font-light text-slate-900">Applications</h3>
            <p class="animate-on-scroll mt-2 text-slate-600">
                Discover where our motors deliver value, from smart factories to mission-critical industrial equipment.
            </p>
        </div>

        {{-- Grid --}}
        <div id="applicationGrid" class="grid grid-cols-1 gap-6 md:grid-cols-2">
            {{-- Automation & CNC --}}
            <div class="application-card group border border-gray-300 bg-gray-100 p-6 transition-all duration-300 hover:border-orange-500 hover:bg-gray-50">
                <h4 class="text-xl font-normal text-slate-900">Automation & CNC</h4>
                <p class="mt-1 text-sm text-slate-600">
                    Powering assembly lines, robotic systems, and CNC machines that require precision and speed.
                </p>
            </div>

            {{-- Conveyors & Gearboxes --}}
            <div class="application-card group border border-gray-300 bg-gray-100 p-6 transition-all duration-300 hover:border-orange-500 hover:bg-gray-50">
                <h4 class="text-xl font-normal text-slate-900">Conveyors & Gearboxes</h4>
                <p class="mt-1 text-sm text-slate-600">
                    Driving conveyor systems and gearboxes in manufacturing and packaging plants.
                </p>
            </div>
        </div>
    </x-container>
</section>

@endsection