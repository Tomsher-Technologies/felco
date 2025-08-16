<section id="aboutUsContent" class="py-20 md:py-28 bg-white relative">
    <div class="absolute inset-0 bg-cover bg-left opacity-40" style="background-image: url('{{ asset('assets/images/bg-about-2.png') }}');" id="parallax-background"></div>

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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
            
            // Parallax effect for the background image
            gsap.to("#parallax-background", {
                scrollTrigger: {
                    trigger: "#aboutUsContent",
                    start: "top bottom",
                    end: "bottom top",
                    scrub: true,
                    pin: true,
                },
                yPercent: 30,
                ease: "none",
            });

            // Fade-in animation for the heading
            gsap.fromTo(".animate__fadeInLeft", {
                opacity: 0,
                x: -100,
            }, {
                opacity: 1,
                x: 0,
                duration: 1,
                scrollTrigger: {
                    trigger: ".animate__fadeInLeft",
                    start: "top 80%",
                    end: "top 60%",
                    scrub: true,
                }
            });

            // Fade-in animation for the paragraph text
            gsap.fromTo(".animate__fadeInRight", {
                opacity: 0,
                x: 100,
            }, {
                opacity: 1,
                x: 0,
                duration: 1,
                scrollTrigger: {
                    trigger: ".animate__fadeInRight",
                    start: "top 80%",
                    end: "top 60%",
                    scrub: true,
                }
            });

            // Hover animation for the button (expand fill layer and change text color)
            const triggerButton = document.querySelector("#learn-more-button");
            const fillLayer = document.querySelector("#btn-fill-gsap");
            const textWrapper = document.querySelector("#btn-text-wrapper");

            // Button Hover Animation with GSAP
            gsap.to(fillLayer, {
                scaleX: 1,
                ease: "none",
                duration: 0.3,
                scrollTrigger: {
                    trigger: triggerButton,
                    start: "top 90%",
                    end: "bottom 70%",
                    scrub: 0.5,
                }
            });

            gsap.to(textWrapper, {
                color: "#ffffff",
                ease: "none",
                duration: 0.3,
                scrollTrigger: {
                    trigger: triggerButton,
                    start: "top 90%",
                    end: "bottom 70%",
                    scrub: 0.5,
                }
            });

        } else {
            console.error("GSAP and/or ScrollTrigger is not loaded. The animation cannot run.");
        }
    });
</script>
