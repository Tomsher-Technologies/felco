@extends('frontend.layouts.app')

@section('content')

    {{-- Hero Slider Section --}}
    @include('frontend.home.hero')

    {{-- Product Categories Section --}}
    @include('frontend.home.categories')

    {{-- Industries Slider Section --}}
    @include('frontend.home.industries')

    {{-- Special Products Section --}}
    @include('frontend.home.special-products')

    {{-- About Us Section --}}
    @include('frontend.home.about')

@endsection
