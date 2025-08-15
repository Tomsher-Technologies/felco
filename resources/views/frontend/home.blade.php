@extends('frontend.layouts.app')

@section('content')
    @php
        $certificationImages = explode(',', $page->getTranslation('image1', $lang) ?? '');
    @endphp


    {{-- Hero Slider Section --}}
    @include('frontend.home.hero')

    {{-- About Us Section --}}
    @include('frontend.home.about')

    {{-- Product Categories Section --}}
    @include('frontend.home.categories')

    {{-- Industries Slider Section --}}
    @include('frontend.home.industries')

    {{-- Certifications & Quality Standards Section --}}
    <section class="py-16 bg-white">
        <x-container>
            <div class="text-center mb-12">
                <h2 class="text-3xl font-light text-gray-800">{{ $page->getTranslation('heading5', $lang) }}</h2>
                <p class="mt-4 text-lg text-gray-600">{!! $page->getTranslation('content3', $lang) !!}</p>
            </div>

            @if (!empty($certificationImages) && count($certificationImages))
                <div class="grid grid-cols-5 gap-6">
                    @foreach ($certificationImages as $img)
                        <x-certification-logo src="{{ uploaded_asset($img) }}" alt="Certification 1" />
                    @endforeach
                </div>
            @endif
        </x-container>
    </section>
@endsection
