@extends('frontend.layouts.app')

@section('content')
    <!-- Page Title Section -->
@include('components.page-title', [
    'title' => $page->getTranslation('title', $lang),
    'description' => $page->getTranslation('sub_title', $lang),
    'image' => asset('assets/images/page/about.jpg')
])


    <!-- About Us Content -->
<!-- About Us Content -->
<section class="pt-20 bg-white">
    <x-container>
        <div class="grid lg:grid-cols-2 gap-12 items-start">
            <!-- Left: Title -->
            <div class="flex items-start">
                <h2 class="text-4xl font-light  text-gray-900 leading-tight">
                    {{ $page->getTranslation('heading1', $lang) }}
                </h2>
            </div>

            <!-- Right: Rich Text Content -->
            <div class="prose max-w-none text-gray-900">
                {!! $page->getTranslation('content1', $lang) !!}
            </div>
        </div>
    </x-container>
</section>









<section id="why-we-are-different-creative" class="py-20 md:py-24 bg-gray-50 text-gray-800 overflow-hidden">
    <x-container>
        <!-- Section Heading -->
        <div class="text-center mb-16" id="section-heading">
            <h2 class="text-3xl md:text-4xl font-light tracking-tight text-gray-900" id="heading">
                Our Unwavering Commitment
            </h2>
            <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto" id="desc">
                We've built our reputation on a foundation of four key promises. This is how we deliver excellence, every time.
            </p>
        </div>

        <!-- Section Content -->
        <div class="relative" id="section-content">
            <div class="hidden lg:block absolute left-1/2 top-2 bottom-1 w-1 bg-primary/10 rounded-full -translate-x-1/2"></div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-12 gap-y-16">
                <!-- Step 1 -->
                <div class="flex justify-start lg:justify-end" id="step1">
                    <div class="relative w-full lg:w-10/12 lg:text-right">
                        <div class="absolute -top-4 -left-4 lg:-right-4 lg:left-auto text-8xl font-black text-gray-100 z-0">01</div>
                        <div class="relative z-10 p-6 bg-white rounded-lg shadow-lg border-l-4 border-primary lg:border-l-0 lg:border-r-4">
                            <div class="flex items-center gap-4 lg:flex-row-reverse">
                                <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-primary/10 text-primary">
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 20.417l5.5-5.5a1 1 0 011.414 0l5.5 5.5a12.02 12.02 0 008.618-14.475z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-normal text-gray-900">2-Year Warranty</h3>
                                    <p class="mt-1 text-gray-600">Peace of mind is built-in with our comprehensive parts and labor coverage.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="flex justify-start" id="step2">
                     <div class="relative w-full lg:w-10/12">
                        <div class="absolute -top-4 -left-4 text-8xl font-black text-gray-100 z-0">02</div>
                        <div class="relative z-10 p-6 bg-white rounded-lg shadow-lg border-l-4 border-primary">
                            <div class="flex items-center gap-4">
                                <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-primary/10 text-primary">
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-normal text-gray-900">On-Site Support</h3>
                                    <p class="mt-1 text-gray-600">Expert help comes to you, ensuring fast and hassle-free resolutions.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="flex justify-start lg:justify-end" id="step3">
                    <div class="relative w-full lg:w-10/12 lg:text-right">
                        <div class="absolute -top-4 -left-4 lg:-right-4 lg:left-auto text-8xl font-black text-gray-100 z-0">03</div>
                        <div class="relative z-10 p-6 bg-white rounded-lg shadow-lg border-l-4 border-primary lg:border-l-0 lg:border-r-4">
                            <div class="flex items-center gap-4 lg:flex-row-reverse">
                                <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-primary/10 text-primary">
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-normal text-gray-900">Premium Quality</h3>
                                    <p class="mt-1 text-gray-600">Crafted from the finest materials for superior durability and elegance.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="flex justify-start" id="step4">
                     <div class="relative w-full lg:w-10/12">
                        <div class="absolute -top-4 -left-4 text-8xl font-black text-gray-100 z-0">04</div>
                        <div class="relative z-10 p-6 bg-white rounded-lg shadow-lg border-l-4 border-primary">
                            <div class="flex items-center gap-4">
                                <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-primary/10 text-primary">
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-normal text-gray-900">Seamless Installation</h3>
                                    <p class="mt-1 text-gray-600">Our professional team handles setup at no extra cost, perfected for your space.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </x-container>
</section>









<img src="{{ asset('assets/images/about.jpg') }}" alt="About Image"
     class="about-img-zoom w-full min-h-[300px] md:min-h-[450px] lg:min-h-[550px] max-h-[50vh] mx-auto object-cover"
     data-gsap="scroll-zoom">



<!-- 
<img src="{{ asset($page->image) }}" alt="About Image"
     class="about-img-zoom w-full h-auto object-cover"
     data-gsap="scroll-zoom">

 -->


 




 


<section class="bg-[#e8edf1] pt-[100px] pb-[100px] relative z-10">
    <x-container>
        <!-- Top Content -->
        <div class="flex flex-col md:flex-row items-start justify-between gap-6 mb-4">
            <div class="max-w-3xl">

             <span class="text-orange-400 text-sm uppercase tracking-wider font-semibold block mb-4">
                {{ trans('messages.why_choose_us') }}
            </span>
            <h2 class="text-4xl font-light  text-gray-900 mb-4">
                {{ $page->getTranslation('heading6', $lang) }}
            </h2>
            <div class="text-lg text-gray-600">
                {!! $page->getTranslation('content', $lang) !!}
            </div>


        
            </div>
            <div>
                <a href="#contact"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-primary hover:bg-black text-white font-medium text-sm shadow transition">
                    Schedule a call
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" stroke="currentColor"
                         stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </x-container>

    <!-- Cards Section Overlapping Below -->
    <div class="pt-10">
        <x-container>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @foreach (range(2, 5) as $i)
                    <div class="relative group bg-white p-6 shadow hover:shadow-md transition  overflow-hidden">
    <!-- Hover Overlay Background -->
    <div class="absolute inset-0 bg-[#0a8268] z-0 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500 ease-in-out"></div>

    <!-- Card Content -->
    <div class="relative z-10 transition duration-500 group-hover:text-white">
      <div class="text-[3rem] group-hover:text-[1.5rem] font-thin text-orange-500 group-hover:text-white mb-4 leading-none transition-all duration-500 ease-in-out">
    0{{ $i - 1 }}
</div>

        <h3 class="text-2xl font-normal text-gray-800 mb-4 group-hover:text-white transition">
            {{ $page->getTranslation('heading' . $i, $lang) }}
        </h3>
        <hr class="my-4 border-gray-200 group-hover:border-white transition">
        <p class="text-sm text-gray-600 group-hover:text-gray-100 transition">
            {{ $page->getTranslation('content' . $i, $lang) }}
        </p>
    </div>
</div>

                @endforeach
            </div>
        </x-container>
    </div>


    
</section>



<!-- FAQ Section -->
<!-- <section class="pt-[200px] pb-[100px] bg-gray-100 text-gray-800">
    <x-container>
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-10">
                <span class="text-orange-600 text-sm uppercase tracking-wider font-semibold block mb-3">
                    {{ trans('messages.faq') }}
                </span>
                <h2 class="text-4xl font-bold">
                    {{ $page->getTranslation('heading7', $lang) }}
                </h2>
            </div>

            <div class="space-y-4" id="accordionExample">
                @php
                    $faqs = \App\Models\Faq::where('type','about_us')->where('lang', $lang)->orderBy('sort_order','asc')->get();
                    if($faqs->isEmpty()){
                        $faqs = \App\Models\Faq::where('type','about_us')->where('lang', 'en')->orderBy('sort_order','asc')->get();
                    }
                @endphp

                @foreach ($faqs as $key => $faq)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                        <button class="w-full text-left px-6 py-4 flex justify-between items-center focus:outline-none focus:ring-2 focus:ring-orange-500"
                                data-bs-toggle="collapse" data-bs-target="#faq-{{ $key }}">
                            <span class="text-lg font-medium text-gray-800">{{ $faq->question }}</span>
                            <svg class="w-5 h-5 transform transition-transform duration-300 group-open:rotate-180"
                                 fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div id="faq-{{ $key }}" class="px-6 py-4 border-t bg-gray-50 text-gray-600 collapse @if($key == 0) show @endif"
                             data-bs-parent="#accordionExample">
                            <p>{{ $faq->answer }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </x-container>
</section>
 -->




<!-- FAQ Section with Smooth Flowbite Accordion -->


<!-- <section class="pt-[160px] pb-[70px] bg-white  text-gray-800">
    <x-container>
        <div class="grid lg:grid-cols-2 gap-12 items-start">
        
            <div>
                <span class="text-orange-600 text-sm uppercase tracking-wider font-light block mb-3">
                    {{ trans('messages.faq') }}
                </span>
                <h2 class="text-4xl font-light">
                    {{ $page->getTranslation('heading7', $lang) }}
                </h2>
                <p class="mt-4 text-gray-600 text-lg">
                    Find answers to some of the most common questions about our services and process.
                </p>
            </div>

            <div id="accordion-collapse" data-accordion="collapse" class="space-y-4">
                @php
                    $faqs = \App\Models\Faq::where('type','about_us')->where('lang', $lang)->orderBy('sort_order','asc')->get();
                    if ($faqs->isEmpty()) {
                        $faqs = \App\Models\Faq::where('type','about_us')->where('lang', 'en')->orderBy('sort_order','asc')->get();
                    }
                @endphp

                @foreach ($faqs as $key => $faq)
                    <div class="border border-gray-200 bg-white shadow-sm">
                        <h2 id="accordion-heading-{{ $key }}">
                            <button type="button"
                                class="flex items-center justify-between w-full p-4 font-light text-left text-gray-900 transition-all rounded-none duration-300"
                                data-accordion-target="#accordion-body-{{ $key }}"
                                aria-expanded="{{ $key === 0 ? 'true' : 'false' }}"
                                aria-controls="accordion-body-{{ $key }}">
                                <span clang="!text-black">{{ $faq->question }}</span>
                                <svg data-accordion-icon class="w-4 h-4 shrink-0 transform transition-transform duration-300"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-body-{{ $key }}"
                             class="transition-all duration-500 ease-in-out overflow-hidden hidden"
                             aria-labelledby="accordion-heading-{{ $key }}">
                            <div class="p-5 text-gray-600 leading-relaxed">
                                {!! $faq->answer !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </x-container>
</section> -->














@endsection
