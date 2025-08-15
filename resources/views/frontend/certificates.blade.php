@extends('frontend.layouts.app')

@section('content')

@include('components.page-title', [
    'title' => $page->getTranslation('title', $lang),
    'description' => $page->getTranslation('content', $lang),
    'image' => asset('assets/images/page/certificates.jpg')
])

@if (!empty($certificates[0]))
    @foreach ($certificates as $key => $cert)
        <section class="py-16 @if((($key + 1) % 2) == 0) bg-white @else bg-gray-50 @endif">
            <x-container>

                <!-- Section Title -->
                <div class="mb-12">
                    <h2 class="text-3xl md:text-4xl font-light text-slate-800 tracking-tight mb-3">
                        {{ $cert->getTranslation('title', $lang) }}
                    </h2>
                    <div class="h-1 w-20 bg-gradient-to-r from-[#f06425] to-orange-400 "></div>
                </div>

                <!-- Content Grid -->
                <div class="grid md:grid-cols-2 gap-10 items-start">

                    <!-- Left: Image -->
                    <div class="overflow-hidden  shadow-md">
                        <img src="{{ uploaded_asset($cert->image) }}"
                             alt="{{ $cert->getTranslation('title', $lang) }}"
                             class="w-full h-auto object-cover transition-transform duration-500 hover:scale-105">
                    </div>

                    <!-- Right: Sections -->
                    <div class="space-y-6">
                        @foreach ($cert->sections ?? [] as $section)
                            <div class="group bg-white border border-slate-200 hover:border-[#f06425]  shadow-sm p-6 transition duration-300">
                                <!-- Section Title -->
                                <h5 class="text-lg font-semibold text-slate-800 mb-2">
                                    {{ $section->getTranslation('title', $lang) }}
                                </h5>

                                <!-- Description -->
                                <p class="text-sm text-slate-600 mb-4 whitespace-pre-line">
                                    {{ $section->getTranslation('content', $lang) }}
                                </p>

                                <!-- Download Files -->
                                @if (!empty($section->files[0]))
                                    <div class="space-y-2">
                                        <p class="text-sm font-medium text-slate-700 mb-1">
                                            {{ $section->getTranslation('button_text', $lang) }}
                                        </p>
                                        <ul class="list-disc pl-5 space-y-1 text-sm text-teal-700">
                                            @foreach ($section->files as $file)
                                                <li>
                                                    <a href="{{ asset($file->file) }}" target="_blank" class="hover:underline">
                                                        {{ $file->getTranslation('title', $lang) }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

            </x-container>
        </section>
    @endforeach
@endif

@endsection
