<section id="page-tit-p" class="w-full overflow-hidden bg-gradient-to-b from-orange-50 via-white to-white py-10 md:py-16">
    <x-container>
        {{-- Added md:min-h-[32rem] to set a minimum height on desktop --}}
        <div class="mx-auto grid grid-cols-1 items-stretch md:grid-cols-2 md:min-h-[32rem]">

            <div class="relative drop-shadow-md z-10 flex flex-col justify-center bg-white p-6 text-black md:border-r md:border-slate-200 md:p-16 row-start-2 md:row-start-auto">
                <h2 class="animate-on-scroll text-3xl font-light text-black sm:text-4xl md:text-5xl mb-4" data-anim="fade-up">
                    {{ $title ?? '' }}
                </h2>
                @if(!empty($description))
                <p class="animate-on-scroll max-w-xl text-base text-gray-600 md:text-lg" data-anim="fade-up">
                    {!! $description !!}
                </p>
                @endif
            </div>

            <div class="relative h-80 w-full overflow-hidden bg-black md:h-auto row-start-1 md:row-start-auto">
                <div class="absolute -top-8 -right-8 z-10 h-16 w-16 rotate-45 bg-orange-50"></div>
                <div class="parallax-zoom-image h-full w-full scale-105 bg-cover bg-center"
                     style="background-image: url('{{ $image ?? asset("assets/images/default-header.jpg") }}');"
                     data-anim="zoom">
                </div>
            </div>

        </div>
    </x-container>
</section>