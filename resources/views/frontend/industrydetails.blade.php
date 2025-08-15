@extends('frontend.layouts.app')

@section('content')
    @include('components.page-title', [
        'title' => $industry->getTranslation('name', $lang),
        'description' => $industry->getTranslation('description', $lang),
        'image' => uploaded_asset($industry->image),
        'theme' => 'dark',
    ])

    <section class="mt-16 bg-[#454d4e] py-16 text-slate-300 md:py-24">
        <x-container>
            <div class="mb-16 border-l-2 border-orange-500 pl-4">
                <h3 class="animate-on-scroll text-3xl font-light text-white">
                    {{ $industry->getTranslation('title1', $lang) }}
                </h3>
                <p class="animate-on-scroll mt-2 text-gray-200">
                    {{ $industry->getTranslation('content1', $lang) }}
                </p>
            </div>

            <div id="industryProductGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse ($categories as $category)
                    <a href="{{ route('products.category', ['category_slug' => $category->slug]) }}"
                        class="group relative bg-white border border-slate-200 shadow hover:shadow-xl overflow-hidden transition-all duration-300 flex flex-col">
                        <div class="relative w-full h-60 overflow-hidden">
                            @if ($category->image)
                                <img src="{{ uploaded_asset($category->image) }}"
                                    alt="{{ $category->getTranslation('name', $lang) }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">
                                    {{ trans('messages.no') . ' ' . trans('messages.products') . ' ' . trans('messages.found') }}
                                </div>
                            @endif
                        </div>
                        <div class="p-6 flex flex-col gap-3">
                            <h3 class="text-xl font-normal text-slate-900 group-hover:text-orange-600 transition-colors">
                                {{ $category->getTranslation('name', $lang) }}
                            </h3>
                        </div>
                        <div
                            class="absolute bottom-6 right-6 z-10 text-white bg-[#f16c31] p-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform scale-75 group-hover:scale-100 shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none"
                                viewBox="0 0 128 128">
                                <path
                                    d="M44 108c-1.023 0-2.047-.391-2.828-1.172-1.563-1.563-1.563-4.094 0-5.656l37.172-37.172-37.172-37.172c-1.563-1.563-1.563-4.094 0-5.656s4.094-1.563 5.656 0l40 40c1.563 1.563 1.563 4.094 0 5.656l-40 40c-.781.781-1.805 1.172-2.828 1.172z"
                                    fill="currentColor" />
                            </svg>
                        </div>
                    </a>
                @empty
                    <p class="text-gray-400">
                        {{ trans('messages.no') . ' ' . trans('messages.products') . ' ' . trans('messages.found') }}.</p>
                @endforelse
            </div>
        </x-container>
    </section>


    @if (!empty($industry->getTranslation('applications', $lang)))
        @php
            $applications = json_decode($industry->getTranslation('applications', $lang), true) ?? [];
        @endphp

        @if (count($applications) > 0)
            <section id="applicationSection" class="bg-white py-16 text-slate-800 md:py-24">
                <x-container>
                    {{-- Section Header --}}
                    <div id="applicationHeader" class="mb-12 border-l-2 border-orange-500 pl-4">
                        <h3 class="animate-on-scroll text-3xl font-light text-slate-900">
                            {{ $industry->getTranslation('title2', $lang) }}
                        </h3>
                        @if (!empty($industry->getTranslation('content2', $lang)))
                            <p class="animate-on-scroll mt-2 text-slate-600">
                                {!! $industry->getTranslation('content2', $lang) !!}
                            </p>
                        @endif
                    </div>

                    <div id="applicationGrid" class="grid grid-cols-1 gap-6 md:grid-cols-3">
                        @foreach ($applications as $app)
                            <div
                                class="application-card group border border-gray-300 bg-gray-100 p-6 transition-all
                                duration-300 hover:border-orange-500 hover:bg-gray-50">
                                @if (!empty($app['heading']))
                                    <h4 class="text-xl font-normal text-slate-900">
                                        {{ $app['heading'] }}
                                    </h4>
                                @endif

                                @if (!empty($app['content']))
                                    <p class="mt-2 text-gray-600">
                                        {!! nl2br(e($app['content'])) !!}
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </x-container>
            </section>
        @endif
    @endif

@endsection
