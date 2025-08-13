<section class="w-full overflow-hidden bg-gradient-to-b from-orange-50  via-white to-white pt-16 pb-16">
    <x-container>
        <div class="mx-auto grid min-h-[28rem] grid-cols-1 items-stretch md:grid-cols-2">

            <div class="relative drop-shadow-md z-10 flex flex-col justify-center bg-white p-10 text-black md:border-r md:border-slate-200 md:p-16">
                <h2 class="animate-on-scroll text-4xl font-light text-black md:text-5xl mb-4" data-anim="fade-up">
                    {{ $title ?? 'Default Page Title' }}
                </h2>
                <p class="animate-on-scroll max-w-xl text-lg text-gray-600" data-anim="fade-up">
                    {{ $description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla varius consequat magna, id molestie ipsum volutpat quis.' }}
                </p>
            </div>

            <div class="relative h-full w-full overflow-hidden bg-black">
                <div class="absolute -top-8 -right-8 z-10 h-16 w-16 rotate-45 bg-orange-50"></div>

                <div class="parallax-zoom-image h-full w-full scale-105 bg-cover bg-center"
                     style="background-image: url('{{ $image ?? asset("assets/images/default-header.jpg") }}');"
                     data-anim="zoom">
                </div>
            </div>

        </div>
    </x-container>
</section>