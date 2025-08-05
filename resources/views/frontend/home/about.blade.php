<section id="aboutUsBanner" class="relative h-[80vh] w-full overflow-hidden flex items-center">
    {{-- Background image with scroll-based width animation --}}
    <div class="absolute top-0 left-0 h-full z-0 w-0 bg-cover bg-center transition-all duration-1000 ease-out"
         style="background-image: url('{{ asset($page->image) }}');"
         data-gsap="bg-width">
    </div>

    {{-- Dark overlay --}}
    <div class="absolute inset-0 bg-black/70 z-10"></div>

    {{-- Full content block on top of image --}}

     <x-container>
    <div class="relative z-20  mx-auto px-4">
        <div class="max-w-3xl" data-gsap="hero-content">
            <span class="text-sm uppercase tracking-widest text-emerald-400 font-semibold block mb-4">
                {{ $page->getTranslation('heading6', $lang) }}
            </span>
            <h2 class="text-4xl md:text-5xl font-thin leading-tight text-white mb-6">
                {{ $page->getTranslation('heading7', $lang) }}
            </h2>
            <p class="text-lg text-gray-300 leading-relaxed mb-8">
                {{ $page->getTranslation('content5', $lang) }}
            </p>
            <a href="{{ route('about_us') }}"
               class="inline-flex items-center gap-2 px-6 py-3  bg-[#0a8268] hover:bg-[#f16c31] text-white hover:text-white  font-semibold text-sm transition duration-300 shadow-lg group">
                {{ trans('messages.learn_more') }}
                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition duration-300" fill="none"
                     stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>


</x-container>

</section>
