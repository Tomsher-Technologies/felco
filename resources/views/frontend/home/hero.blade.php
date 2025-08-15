<section id="felco-hero" class="hero-slider relative h-[600px] sm:h-[700px] md:h-[800px] lg:h-[900px] overflow-hidden">
    <!-- Swiper Container -->
    <div class="swiper hero-swiper relative inset-0 w-full h-full">
        <div class="swiper-wrapper">
            @if(!empty($data['slider']))
                @foreach($data['slider'] as $slider)
                    <div class="swiper-slide w-full h-full relative"
                         style="background-image: url('{{ uploaded_asset($slider->image) }}'); background-size: cover; background-position: center;">
                        
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-transparent"></div>

                        <!-- Slide Content -->
                        <div class="relative z-10 flex flex-col items-start justify-center px-6 sm:px-12 lg:px-24 w-full h-[800px] max-w-[1500px] mx-auto text-left text-white">
                            <div class="w-full max-w-4xl animate__animated animate__fadeInUp">
                                <h2 class="font-light tracking-tight leading-tight text-3xl md:text-5xl lg:text-6xl drop-shadow-lg text-white">
                                    {{ $slider->getTranslation('title', $lang) }}
                                </h2>
                            </div>

                            <div class="w-full max-w-4xl mt-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                                <p class="text-white/90 text-base sm:text-lg lg:text-xl font-extralight">
                                    {{ $slider->getTranslation('sub_title', $lang) }}
                                </p>
                            </div>

<div class="mt-8 animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
  

    <a href="{{ $slider->link }}" id="contact-button"
   class="relative inline-flex items-center justify-center gap-2 px-6 py-3 text-white font-semibold text-sm transition-all duration-300 shadow-lg group overflow-hidden bg-orange-500 hover:bg-white hover:text-white transform hover:-translate-y-1 hover:scale-95 hover:px-5 hover:py-2">

    <span id="btn-fill-gsap" class="absolute inset-0 z-0 bg-[#0a8268] transform scale-x-0 origin-left"></span>
    
    <span class="absolute inset-0 z-0 bg-[#f16c31] transform scale-x-0 origin-left transition-transform duration-300 ease-in-out group-hover:scale-x-100"></span>

    <span id="btn-text-wrapper" class="relative z-10 flex items-center gap-2">
        {{ $slider->getTranslation('btn_text', $lang) }}
        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none"
             stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
    </span>
</a>

</div>





                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Pagination -->
        <div class="swiper-pagination !bottom-6 !left-6 sm:!left-12 lg:!left-24 !w-auto z-10"></div>

        <!-- Navigation -->
        <div class="swiper-button-prev hidden md:flex items-center justify-center !w-[50px] !h-[50px]  bg-white/10 hover:bg-[#f06425] backdrop-blur-sm !text-white absolute top-1/2 left-6 z-10 transition-all duration-300 -translate-y-1/2 cursor-pointer">
            <!-- <svg class="!w-[20px] !h-[20px]" fill="white" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg> -->
        </div>
        <div class="swiper-button-next hidden md:flex items-center justify-center !w-[50px] !h-[50px]  bg-white/10 hover:bg-[#f06425] backdrop-blur-sm !text-white absolute top-1/2 right-6 z-10 transition-all duration-300 -translate-y-1/2 cursor-pointer">
            <!-- <svg class="!w-[20px] !h-[20px]" fill="white" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg> -->
        </div>
    </div>
</section>
