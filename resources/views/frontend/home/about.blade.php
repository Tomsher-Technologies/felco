<section id="aboutUsContent" class="py-20 md:py-28 bg-white">
    <x-container>
        {{-- A two-column grid to creatively separate the heading from the descriptive text. --}}
        <div class="grid md:grid-cols-2 gap-12 md:gap-16 items-start">

            <div class="wow animate__animated animate__fadeInLeft">
                <span class="text-sm uppercase tracking-widest text-emerald-600 font-semibold block mb-4">
                    {{ $page->getTranslation('heading6', $lang) }}
                </span>
                <h2 class="text-4xl md:text-5xl font-thin leading-tight text-gray-800">
                    {{ $page->getTranslation('heading7', $lang) }}
                </h2>
            </div>

            <div class="wow animate__animated animate__fadeInRight">
                <p class="text-lg text-gray-600 leading-relaxed mb-8">
                    {{ $page->getTranslation('content5', $lang) }}
                </p>
                
                {{-- Button structure updated with unique IDs for animation targets --}}
<a href="{{ route('about_us') }}" id="learn-more-button"
   class="relative inline-flex items-center justify-center gap-2 px-4 py-2 text-white font-semibold text-sm transition-all duration-300 shadow-lg group overflow-hidden bg-orange-500 hover:bg-white hover:text-white transform hover:-translate-y-1 hover:scale-95 hover:px-5 hover:py-2">

    <span id="btn-fill-gsap" class="absolute inset-0 z-0 bg-[#0a8268] transform scale-x-0 origin-left"></span>
    
    <span class="absolute inset-0 z-0 bg-[#f16c31] transform scale-x-0 origin-left transition-transform duration-300 ease-in-out group-hover:scale-x-100"></span>

    <span id="btn-text-wrapper" class="relative z-10 flex items-center gap-2">
        {{ trans('messages.learn_more') }}
        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none"
             stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
    </span>
</a>






            </div>

        </div>
    </x-container>
</section>

{{-- GSAP Animation Script --}}
{{-- IMPORTANT: Ensure GSAP and ScrollTrigger libraries are loaded in your project's <head> or before this script. --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
            

            // MODIFIED: Select elements using their new, unique IDs
            const triggerButton = document.querySelector("#about-us-button");
            const fillLayer = document.querySelector("#btn-fill-gsap");
            const textWrapper = document.querySelector("#btn-text-wrapper");

            // Ensure all elements were found before creating the animation
            if (triggerButton && fillLayer && textWrapper) {
                let tl = gsap.timeline({
                    scrollTrigger: {
                        trigger: triggerButton,
                        start: "top 90%",
                        end: "bottom 70%",
                        scrub: 0.5,
                    }
                });

                // Animate the fill layer and the text color
                tl.to(fillLayer, { scaleX: 1, ease: "none" })
                  .to(textWrapper, { color: "#ffffff", ease: "none" }, "<");
            }

        } else {
            console.error("GSAP and/or ScrollTrigger is not loaded. The button animation cannot run.");
        }
    });
</script>