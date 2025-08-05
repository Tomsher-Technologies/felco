<section class="w-full pt-16 overflow-hidden bg-gradient-to-b from-orange-50 via-white to-white">
         <x-container>
    <div class="mx-auto grid grid-cols-1 md:grid-cols-2 min-h-[28rem] items-stretch">

        <!-- Left: Dark Content -->
        <div class="bg-black text-white flex flex-col justify-center p-10 md:p-16 relative z-10">
            <h2 class="text-4xl md:text-5xl font-light mb-4 text-white animate-on-scroll" data-anim="fade-up">
                {{ $title ?? 'Default Page Title' }}
            </h2>
            <p class="text-lg text-gray-300 max-w-xl animate-on-scroll" data-anim="fade-up">
                {{ $description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla varius consequat magna, id molestie ipsum volutpat quis.' }}
            </p>
        </div>

        <!-- Right: Parallax Image -->
        <div class="w-full bg-black h-full overflow-hidden relative">
            <div class="parallax-zoom-image h-full w-full bg-center bg-cover scale-105"
                 style="background-image: url('{{ $image ?? asset("assets/images/default-header.jpg") }}');"
                 data-anim="zoom">
            </div>
        </div>

    </div>
    </x-container>
</section>
