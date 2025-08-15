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
    @include('frontend.home.certifications')
@endsection
