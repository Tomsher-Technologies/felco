@extends('frontend.layouts.app')

@section('content')

{{-- Page Title --}}
<x-page-title
    :title="$page->getTranslation('title', $lang) ?? 'Our Products'"
    :description="$page->getTranslation('content', $lang) ?? 'Explore our wide range of high-performance electric motors and industrial solutions tailored to meet your needs.'"
    :image="!empty($page->banner) ? uploaded_asset($page->banner) : asset('assets/images/page/default-products.webp')"
/>

{{-- Services Section (Product Categories) --}}
<section class="py-16 md:py-24 bg-white">
         <x-container>
        @if (count($categories) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($categories as $cat)
                    <a href="{{ route('products.category', ['category_slug' => $cat->slug]) }}"
                       class="group relative bg-white border border-slate-200 shadow hover:shadow-xl overflow-hidden transition-all duration-300 flex flex-col">

                        {{-- Image --}}
                        <div class="relative w-full h-60 overflow-hidden">
                            <img src="{{ uploaded_asset($cat->image) }}"
                                 alt="{{ $cat->getTranslation('name', $lang) }}"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        </div>

                        {{-- Details --}}
                        <div class="p-6 flex flex-col gap-3">
                            <h3 class="text-xl font-normal text-slate-900 group-hover:text-orange-600 transition-colors">
                                {{ $cat->getTranslation('name', $lang) }}
                            </h3>
                            {{-- Read more removed, replaced by SVG arrow below --}}
                        </div>

                        {{-- Arrow Action --}}
                        <div class="absolute bottom-6 right-6 z-10 text-white bg-[#0a8268] p-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform scale-75 group-hover:scale-100 shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 128 128">
                                <path d="M44 108c-1.023 0-2.047-.391-2.828-1.172-1.563-1.563-1.563-4.094 0-5.656l37.172-37.172-37.172-37.172c-1.563-1.563-1.563-4.094 0-5.656s4.094-1.563 5.656 0l40 40c1.563 1.563 1.563 4.094 0 5.656l-40 40c-.781.781-1.805 1.172-2.828 1.172z" fill="currentColor"></path>
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-center text-slate-500">No categories found.</p>
        @endif
    </x-container>
</section>

@endsection
