@extends('frontend.layouts.app')

@section('content')

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
                <h2 class="text-3xl font-light text-gray-800">Certifications & Quality Standards</h2>
                <p class="mt-4 text-lg text-gray-600">We proudly uphold the highest quality standards and certifications to ensure excellence in everything we do.</p>
            </div>

            <!-- Flexbox to keep items in a single row -->
            <div class="grid grid-cols-5 gap-6">
                <!-- Certification Logos using component -->
                <x-certification-logo src="{{ asset('assets/images/certifications/cert1.png') }}" alt="Certification 1" />
                <x-certification-logo src="{{ asset('assets/images/certifications/cert2.png') }}" alt="Certification 2" />
                <x-certification-logo src="{{ asset('assets/images/certifications/cert3.png') }}" alt="Certification 3" />
                <x-certification-logo src="{{ asset('assets/images/certifications/cert4.png') }}" alt="Certification 4" />
                <x-certification-logo src="{{ asset('assets/images/certifications/cert5.png') }}" alt="Certification 5" />
            </div>
        </x-container>
    </section>

@endsection
