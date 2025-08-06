@extends('frontend.layouts.app')

@section('content')

@include('components.page-title', [
    'title' => $page->getTranslation('title', $lang),
    'description' => $page->getTranslation('content', $lang),
    'image' => asset('assets/images/page/after-sales.png')
])

<section class="py-16 bg-gray-50">
    <x-container>
        @if (!empty($service_sales[0]))
            @foreach ($service_sales as $key => $sale)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center mb-16 group">
                    
                    @if ($key % 2 === 0)
                        <!-- Left Image -->
                        <div class="overflow-hidden  shadow-md">
                            <img src="{{ uploaded_asset($sale->image) }}"
                                 alt="{{ $sale->title }}"
                                 class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-105">
                        </div>

                        <!-- Right Content -->
                        <div>
                            <h3 class="text-2xl md:text-3xl font-semibold text-slate-800 mb-4">
                                {{ $sale->title }}
                            </h3>
                            <div class="text-slate-600 text-sm leading-relaxed prose max-w-none">
                                {!! nl2br(e($sale->content)) !!}
                            </div>
                        </div>

                    @else
                        <!-- Left Content -->
                        <div class="order-2 md:order-1">
                            <h3 class="text-2xl md:text-3xl font-semibold text-slate-800 mb-4">
                                {{ $sale->title }}
                            </h3>
                            <div class="text-slate-600 text-sm leading-relaxed prose max-w-none">
                                {!! nl2br(e($sale->content)) !!}
                            </div>
                        </div>

                        <!-- Right Image -->
                        <div class="overflow-hidden  shadow-md order-1 md:order-2">
                            <img src="{{ uploaded_asset($sale->image) }}"
                                 alt="{{ $sale->title }}"
                                 class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-105">
                        </div>
                    @endif

                </div>
            @endforeach
        @endif
    </x-container>
</section>

@endsection
