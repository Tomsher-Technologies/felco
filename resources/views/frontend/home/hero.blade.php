<section id="felco-hero" class="hero-slider relative h-[600px] sm:h-[700px] md:h-[800px] lg:h-[900px] overflow-hidden">
    <div class="swiper hero-swiper relative inset-0 w-full h-full">
        <div class="swiper-wrapper">
            @if(!empty($data['slider']))
                @foreach($data['slider'] as $slider)
                    <div class="swiper-slide w-full h-full relative"
                         style="background-image: url('{{ uploaded_asset($slider->image) }}'); background-size: cover; background-position: center;">
                        
                        <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-transparent"></div>

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
                                <x-button 
                                    href="{{ $slider->link }}" 
                                    id="contact-button"
                                    class="px-6 py-3"
                                    :text="$slider->getTranslation('btn_text', $lang)"
                                />
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="swiper-pagination !bottom-6 !left-6 sm:!left-12 lg:!left-24 !w-auto z-10"></div>

        {{-- Arrows are now visible on all screen sizes --}}
        <div class="swiper-button-prev flex items-center justify-center !w-[50px] !h-[50px] bg-white/10 hover:bg-[#f06425] backdrop-blur-sm !text-white absolute !bottom-6 right-20 z-10 transition-all duration-300 cursor-pointer">
            {{-- SVG icon would go here --}}
        </div>
        
        <div class="swiper-button-next flex items-center justify-center !w-[50px] !h-[50px] bg-white/10 hover:bg-[#f06425] backdrop-blur-sm !text-white absolute !bottom-6 right-6 z-10 transition-all duration-300 cursor-pointer">
            {{-- SVG icon would go here --}}
        </div>
    </div>
</section>