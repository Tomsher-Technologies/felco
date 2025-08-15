@extends('frontend.layouts.app')

@section('content')

    @include('components.page-title', [
        'title' => $page->getTranslation('title', $lang),
        'description' => $page->getTranslation('content', $lang),
        'image' => asset('assets/images/page/industries.jpg'),
    ])

    <section class="py-16 md:py-24 bg-white">
        <x-container>

            @if ($industries->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 animate-on-scroll">
                    @foreach ($industries as $industry)
                        <a href="{{ route('industry.details', ['type' => $industry->slug]) }}"
                            class="group relative block h-80 overflow-hidden shadow-lg focus:outline-none focus:ring-2 focus:ring-[#f06425]"
                            style="transition-delay: {{ $loop->iteration * 80 }}ms">

                            <img src="{{ uploaded_asset($industry->image) }}"
                                alt="{{ $industry->getTranslation('name', $lang) ?? $industry->slug }}"
                                class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 ease-in-out group-hover:scale-105" />

                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/60 to-transparent
                                    transition-opacity duration-500 group-hover:from-black/90">
                            </div>

                            <div class="absolute inset-0 p-6 flex flex-col justify-end">
                                <div class="flex items-center justify-between">
                                    <h3
                                        class="text-2xl font-light text-white leading-7
                                           transition-transform duration-500 group-hover:-translate-y-2">
                                        {{ $industry->getTranslation('name', $lang) }}
                                    </h3>

                                    <span
                                        class="arrow-box ml-4 w-10 h-10 bg-white flex items-center justify-center
                                             shadow-md text-[#f06425] transition-all duration-300 rounded-lg
                                             hover:bg-[#f06425] hover:text-white"
                                        aria-hidden="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none"
                                            viewBox="0 0 128 128">
                                            <path d="M44 108c-1.023 0-2.047-.391-2.828-1.172
                                                         -1.563-1.563-1.563-4.094 0-5.656
                                                         l37.172-37.172-37.172-37.172
                                                         c-1.563-1.563-1.563-4.094 0-5.656
                                                         s4.094-1.563 5.656 0l40 40
                                                         c1.563 1.563 1.563 4.094 0 5.656
                                                         l-40 40c-.781.781-1.805 1.172-2.828 1.172z" fill="currentColor" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 text-stone-500">
                    <p>No industries have been listed yet.</p>
                </div>
            @endif

        </x-container>
    </section>
@endsection
