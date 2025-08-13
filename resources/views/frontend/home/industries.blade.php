<section id="industries-clean" class="relative overflow-hidden bg-[#efefef] py-24">
    <x-container>

        @php
            $industries = \App\Models\Page::where('industy', 1)
                ->where('status', 1)
                ->take(9)
                ->get();
        @endphp

        <div class="mb-16 px-4 text-center md:text-left">
            <h2 class="font-light leading-tight tracking-tight text-4xl text-gray-800">
                {{ $page->getTranslation('heading8', $lang) }}
            </h2>
            <p class="mt-2 max-w-2xl text-lg text-gray-600">
                Explore the top industries we serve with commitment and expertise.
            </p>
        </div>

        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($industries as $index => $industry)
                {{-- The wrapper div's initial state is now handled by GSAP --}}
                <div class="industry-card">
                    <a href="{{ route('industry.details', ['type' => $industry->type]) }}"
                       class="group relative flex h-full flex-col overflow-hidden rounded  border-l-4 border-transparent bg-white p-6  transition-all duration-300 ease-in-out hover:-translate-y-2 hover:border-l-orange-400 hover:shadow-xl md:p-8">
                        
                        {{-- Top-right corner effect --}}
                        <!-- <div class="absolute -top-8 -right-8 z-10 h-16 w-16 rotate-45 bg-white transition-colors duration-300 group-hover:bg-orange-100"></div> -->

                         <div class=" absolute -top-8 -right-8 h-16 w-16 bg-[#efefef] rotate-45 z-10 transition-colors duration-300 group-hover:bg-[#efefef]"></div>
                    

                        {{-- Animated gradient overlay --}}
                        <div class="absolute inset-0 -translate-x-full transform bg-gradient-to-r from-orange-100 via-gray-50 to-white transition-transform duration-500 ease-in-out group-hover:translate-x-0"></div>

                        {{-- Content --}}
                        <div class="relative z-20 flex h-full flex-col justify-between">
                            <div>
                                <h3 class="mb-3 text-xl font-normal text-slate-800 md:text-2xl">
                                    {{ $industry->getTranslation('title', $lang) ?? $industry->slug }}
                                </h3>
                                <p class="line-clamp-4 mt-3 text-base text-gray-600">
                                    {{ $industry->getTranslation('excerpt', $lang) ?? 'Discover how we impact this industry with our dedicated solutions and expertise.' }}
                                </p>
                            </div>

                            <div class="mt-8">
                                <span class="inline-flex items-center text-sm font-medium text-orange-600 transition-opacity duration-300 ">
                                    Learn More
                                    <i class="fi fi-rr-arrow-right ml-2 h-5 w-5 transition-transform duration-300 group-hover:translate-x-1"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </x-container>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (typeof gsap !== 'undefined') {
                gsap.utils.toArray('.industry-card').forEach((card, i) => {
                    gsap.fromTo(card,
                        { opacity: 0, y: 40 }, // Initial state defined here
                        {
                            opacity: 1,
                            y: 0,
                            duration: 0.8,
                            delay: i * 0.1,
                            ease: "power2.out",
                            scrollTrigger: {
                                trigger: card,
                                start: "top 85%",
                                toggleActions: "play none none reverse"
                            }
                        }
                    );
                });
            }
        });
    </script>
</section>