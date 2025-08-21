<section id="aboutUsContent" class="py-20 md:py-28 bg-white relative">
    <div class="absolute inset-0 bg-cover bg-left opacity-40" style="background-image: url('{{ asset('assets/images/bg-about-2.png') }}');" id="parallax-background"></div>

    <x-container>
        <div class="grid md:grid-cols-2 gap-12 md:gap-16 items-start">

            <div class="wow animate__animated animate__fadeInLeft">
                <span class="text-sm uppercase tracking-widest text-emerald-600 font-semibold block mb-4">
                    {{ $page->getTranslation('heading6', $lang) }}
                </span>
                
                {{-- Font size now scales from 3xl on mobile to 5xl on medium screens --}}
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-normal leading-tight text-gray-800">
                    {{ $page->getTranslation('heading7', $lang) }}
                </h2>
            </div>

            <div class="wow animate__animated animate__fadeInRight">
                {{-- Font size now scales from base on mobile to large on medium screens --}}
                <p class="text-base md:text-lg text-gray-600 leading-relaxed mb-8">
                    {{ $page->getTranslation('content5', $lang) }}
                </p>
                
                {{-- Reusable button component --}}
                <x-button 
                    href="{{ route('about_us') }}" 
                    id="learn-more-button" 
                    text="{{ trans('messages.learn_more') }}" 
                />
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

            // Button Hover Animation with GSAP
            const triggerButton = document.querySelector("#learn-more-button");
            const fillLayer = document.querySelector("#btn-fill-gsap");
            const textWrapper = document.querySelector("#btn-text-wrapper");

            if (triggerButton && fillLayer && textWrapper) {
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
            }
        } else {
            console.error("GSAP and/or ScrollTrigger is not loaded. The animation cannot run.");
        }
    });
</script>
