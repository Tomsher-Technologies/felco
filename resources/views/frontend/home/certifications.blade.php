<section class="py-12 md:py-16 bg-white">
    <x-container>
        <div class="text-center mb-8 md:mb-12">
            {{-- Adjusted font sizes for mobile and desktop --}}
            <h2 class="text-2xl md:text-3xl font-light text-gray-800">{{ $page->getTranslation('heading5', $lang) }}</h2>
            <p class="mt-4 text-base md:text-lg text-gray-600">{!! $page->getTranslation('content3', $lang) !!}</p>
        </div>

        @if (!empty($certificationImages) && count($certificationImages))
            <div class="flex justify-center">
                {{-- This grid now changes columns based on screen size --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6 md:gap-8 max-w-5xl w-full">
                    @foreach ($certificationImages as $img)
                        <x-certification-logo src="{{ uploaded_asset($img) }}" alt="Certification 1" />
                    @endforeach
                </div>
            </div>
        @endif
    </x-container>
</section>