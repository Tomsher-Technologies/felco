<section id="felco-pd" class="relative py-24 overflow-hidden" style="background-color: #DDD;">

  <x-container>

    @php
      $industries = \App\Models\Page::where('industy', 1)->where('status', 1)->take(9)->get();
      $bgColors = ['from-orange-500', 'from-blue-600', 'from-rose-500', 'from-teal-500', 'from-indigo-600', 'from-green-600', 'from-red-500', 'from-yellow-500', 'from-purple-600'];
    @endphp

    <!-- Heading + Arrows -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-16 px-2">
      <div class="text-center md:text-left">
        <h2 class="font-light tracking-tight text-4xl text-white leading-tight drop-shadow-lg">
          {{ $page->getTranslation('heading8', $lang) }}
        </h2>
        <p class=" text-lg text-gray-300 max-w-2xl">
          Explore the top industries we serve with commitment and expertise.
        </p>
      </div>

      <!-- Custom Arrows -->
      <div id="industry-arrows" class="flex gap-4 mt-6 md:mt-0 justify-center md:justify-end">
        <button id="industryPrev"
                class="!p-3 !bg-white/10 hover:!bg-white/20 backdrop-blur-lg !text-white transition duration-300 group ">
          <svg class="w-6 h-6 group-hover:scale-110 transition-transform duration-300" fill="none"
               stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
          </svg>
        </button>
        <button id="industryNext"
                class="!p-3 !bg-white/10 hover:!bg-white/20 backdrop-blur-lg !text-white transition duration-300 group ">
          <svg class="w-6 h-6 group-hover:scale-110 transition-transform duration-300" fill="none"
               stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
          </svg>
        </button>
      </div>
    </div>

    <!-- Swiper -->
    <div class="swiper industrySwiper px-2 pb-8">
      <div class="swiper-wrapper">
        @foreach ($industries as $index => $industry)
          <div class="swiper-slide">
            <a href="{{ route('industry.details', ['type' => $industry->type]) }}"
               class="industry-card group block w-full bg-gradient-to-br {{ $bgColors[$index % count($bgColors)] }} to-black shadow-xl hover:scale-[1.03] transition-transform duration-300 ">
              <div class="relative h-[30rem] overflow-hidden ">
                <img src="{{ getPageImage($industry->type) }}" alt="{{ $industry->slug }}"
                     class="absolute inset-0 w-full h-full object-cover brightness-90 group-hover:brightness-105 transition duration-700 ease-in-out z-0" />
                <div class="absolute inset-0 bg-black/40 z-10"></div>

                <div class="absolute bottom-0 left-0 right-0 z-20 p-8">
                  <span class="inline-block mb-3 text-xs font-bold uppercase tracking-widest px-3 py-1 bg-white/20 text-white shadow-md">
                    Industry {{ $index + 1 }}
                  </span>
                  <h3 class="text-3xl font-light text-white leading-tight drop-shadow-lg">
                    {{ $industry->getTranslation('title', $lang) ?? $industry->slug }}
                  </h3>
                  <div class="mt-4 opacity-80 group-hover:opacity-100 transition-opacity">
                    <span class="inline-flex items-center text-sm text-white font-semibold tracking-wide">
                      {{ trans('messages.learn_more') }}
                      <svg class="w-6 h-6 ml-2 transition-transform group-hover:translate-x-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 10a.75.75 0 0 1 .75-.75h10.638L10.23 5.29a.75.75 0 1 1 1.04-1.08l5.5 5.25a.75.75 0 0 1 0 1.08l-5.5 5.25a.75.75 0 1 1-1.04-1.08l4.158-3.96H3.75A.75.75 0 0 1 3 10Z" clip-rule="evenodd"/>
                      </svg>
                    </span>
                  </div>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    </div>

  </x-container>
</section>
