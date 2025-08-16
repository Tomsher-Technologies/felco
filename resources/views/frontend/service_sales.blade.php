@extends('frontend.layouts.app')

@section('content')

@include('components.page-title', [
    'title' => $page->getTranslation('title', $lang),
    'description' => $page->getTranslation('content', $lang),
    'image' => asset('assets/images/page/after-sales.png')
])

<section class="py-16 bg-gray-50">
    <x-container>
        @if (!empty($service_sales[0]))
            @foreach ($service_sales as $key => $sale)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center mb-16 group">
                    
                    @if ($key % 2 === 0)
                        <!-- Left Image -->
                        <div class="overflow-hidden  shadow-md">
                            <img src="{{ uploaded_asset($sale->image) }}"
                                 alt="{{ $sale->title }}"
                                 class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-105">
                        </div>

                        <!-- Right Content -->
                        <!-- <div>
                            <h3 class="text-2xl md:text-3xl font-semibold text-slate-800 mb-4">
                                {{ $sale->title }}
                            </h3>
                            <div id="saleContent"  class="text-slate-600 text-sm leading-relaxed prose max-w-none">
                                {!! nl2br(e($sale->content)) !!}
                            </div>
                        </div> -->


                        <div>
    <h3 class="text-2xl md:text-3xl font-semibold text-slate-800 mb-4">
        Support & Services
    </h3>
    <div class="text-slate-600 text-sm leading-relaxed max-w-none">
        <ul class="list-disc pl-5 space-y-2 mb-4">
            <li>Technical consultation and application engineering</li>
            <li>On-site commissioning and start-up support</li>
            <li>Preventive maintenance programs tailored to customer needs</li>
            <li>Spare parts availability and fast response for critical components</li>
            <li>Motor rewinding and refurbishment services</li>
            <li>Condition monitoring and diagnostics (vibration, temperature, insulation)</li>
            <li>Training programs for customer maintenance personnel</li>
        </ul>
        <div class="bg-orange-50 border-l-4 border-orange-400 p-4 text-slate-700 rounded">
            Felco ensures that every motor installation is backed by dependable support, helping customers reduce downtime, optimize energy efficiency, and extend equipment lifespan.
        </div>
    </div>
</div>





                    @else
                        <!-- Left Content -->
                        <div class="order-2 md:order-1">
                            <h3 class="text-2xl md:text-3xl font-semibold text-slate-800 mb-4">
                                {{ $sale->title }}
                            </h3>
                            <div id="saleContent"  class="text-slate-600 text-sm leading-relaxed prose max-w-none">
                                {!! nl2br(e($sale->content)) !!}
                            </div>
                        </div>

                        <!-- Right Image -->
                        <div class="overflow-hidden  shadow-md order-1 md:order-2">
                            <img src="{{ uploaded_asset($sale->image) }}"
                                 alt="{{ $sale->title }}"
                                 class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-105">
                        </div>
                    @endif

                </div>
            @endforeach
        @endif
    </x-container>
</section>



<section id="why-we-are-different-creative" class="overflow-hidden bg-[#b7bbac]/30 py-20 text-gray-800 md:py-24">
    <x-container>
        <div class="text-center mb-16" id="section-heading">
            <h2 class="text-3xl font-light tracking-tight text-gray-900 md:text-4xl" id="heading">
                Our Unwavering Commitment
            </h2>
            <p class="mx-auto mt-4 max-w-3xl text-lg text-gray-600" id="desc">
                We've built our reputation on a foundation of four key promises. This is how we deliver excellence, every time.
            </p>
        </div>

        <div class="relative" id="section-content">
            <div class="hidden lg:block absolute top-2 bottom-1 left-1/2 w-1 -translate-x-1/2 rounded-full bg-primary/10"></div>

            <div class="grid grid-cols-1 gap-x-12 gap-y-16 lg:grid-cols-2">
                
                <div class="flex justify-start lg:justify-end" id="step1">
                    <div class="relative w-full lg:w-10/12 lg:text-right">
                        <!-- <div class="absolute -top-4 -left-4 z-0 font-black text-gray-100 text-8xl lg:-right-4 lg:left-auto">01</div> -->
                        <div class="relative z-10 border-l-4 border-primary bg-white p-6 shadow-lg lg:border-l-0 lg:border-r-4">
                            <div>
                                <h3 class="text-xl font-normal text-gray-900">2-Year Warranty</h3>
                                <p class="mt-1 text-gray-600">Peace of mind is built-in with our comprehensive parts and labor coverage.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-start" id="step2">
                    <div class="relative w-full lg:w-10/12">
                        <!-- <div class="absolute -top-4 -left-4 z-0 font-black text-gray-100 text-8xl">02</div> -->
                        <div class="relative z-10 border-l-4 border-primary bg-white p-6 shadow-lg">
                            <div>
                                <h3 class="text-xl font-normal text-gray-900">On-Site Support</h3>
                                <p class="mt-1 text-gray-600">Expert help comes to you, ensuring fast and hassle-free resolutions.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-start lg:justify-end" id="step3">
                    <div class="relative w-full lg:w-10/12 lg:text-right">
                        <!-- <div class="absolute -top-4 -left-4 z-0 font-black text-gray-100 text-8xl lg:-right-4 lg:left-auto">03</div> -->
                        <div class="relative z-10 border-l-4 border-primary bg-white p-6 shadow-lg lg:border-l-0 lg:border-r-4">
                            <div>
                                <h3 class="text-xl font-normal text-gray-900">Premium Quality</h3>
                                <p class="mt-1 text-gray-600">Crafted from the finest materials for superior durability and elegance.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-start" id="step4">
                    <div class="relative w-full lg:w-10/12">
                        <!-- <div class="absolute -top-4 -left-4 z-0 font-black text-gray-100 text-8xl">04</div> -->
                        <div class="relative z-10 border-l-4 border-primary bg-white p-6 shadow-lg">
                            <div>
                                <h3 class="text-xl font-normal text-gray-900">Seamless Installation</h3>
                                <p class="mt-1 text-gray-600">Our professional team handles setup at no extra cost, perfected for your space.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </x-container>
</section>

@endsection
