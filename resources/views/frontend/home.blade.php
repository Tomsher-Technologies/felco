@extends('frontend.layouts.app')
@section('content')
<section class="hero-slider hero-style-3">
    <div class="swiper-container">
        <div class="swiper-wrapper">

            
            @if(!empty($data['slider']))
                @foreach($data['slider'] as $slider)
                    <div class="swiper-slide">
                        <div class="slide-inner slide-bg-image" data-background="{{ uploaded_asset($slider->image) }}">
                            <div class="container">
                                <div data-swiper-parallax="300" class="slide-title fl-slide-title">
                                    <h2>{{ $slider->getTranslation('title', $lang) }}</h2>
                                </div>
                                <div data-swiper-parallax="400" class="slide-text fl-slide-text">
                                    <p>{{ $slider->getTranslation('sub_title', $lang) }}</p>
                                </div>
                                <div class="clearfix"></div>
                                <div data-swiper-parallax="500" class="slide-btns">
                                    <a href="{{ $slider->link }}" class="fl-btn fl-btn-banner">{{ $slider->getTranslation('btn_text', $lang) }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>
<section class="features-section-s2">
    <div class="container">
        <h2 class="fl-section-title">{{ $page->getTranslation('heading1', $lang) }}</h2>
        <div class="fl-grid-container">

            
            @if(!empty($data['product_categories']))
                @foreach($data['product_categories'] as $product_categories)
                    <div class="fl-grid-item">
                        <a href="{{ route('products.category',['category_slug' => $product_categories->slug]) }}">
                            <div class="fl-category-title">
                                <img src="{{ uploaded_asset($product_categories->icon) }}" alt="{{ $product_categories->getTranslation('name', $lang) }}">
                                <span class="fl-divider"></span>
                                <h3>{{ $product_categories->getTranslation('name', $lang) }}</h3>
                            </div>
                            <p>{{ $product_categories->getTranslation('home_content', $lang) }}</p>
                        </a>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
</section>
<section class="fl-industries-serve section-padding p-b-0 p-t-0">
    <div class="container">
        <div class="fl-section-title-area">
            <h2 class="fl-section-title">{{ $page->getTranslation('heading8', $lang) }}</h2>
            {{-- <a href="#" class="theme-btn fl-get-in-touch-icon">View More</a> --}}
        </div>
    </div>

    <div class="fl-industries">
        <div class="fl-column fl-main-column active">
            <img src="{{getPageImage('marine')}}" class="fl-marine" alt="">
            <div class="fl-column-content">
                <h2>{{ $page->getTranslation('heading2', $lang) }}</h2>
                <div>
                    <p class="fl-description">
                        {{ $page->getTranslation('content2', $lang) }}
                    </p>
                    <button class="fl-cta fl-button-style-2 fl-learn-more-btn">{{ trans('messages.learn_more') }} <span><img src="{{ asset('assets/images/arrow-right.png') }}" alt=""></span></button>
                </div>
            </div>
        </div>
        <div class="fl-column fl-hover-column" data-content="Column 2">
            <img src="{{getPageImage('oil_gas')}}" class="fl-marine" alt="">
            <div class="fl-column-content">
                <h2>{{ $page->getTranslation('heading3', $lang) }}</h2>
                <p class="fl-hover-content fl-description2">
                    {{ $page->getTranslation('content3', $lang) }}
                </p>
                <button class="fl-hover-cta fl-button-style-2 fl-learn-more-btn">{{ trans('messages.learn_more') }}
                    <span><img src="{{ asset('assets/images/arrow-right.png') }}" alt=""></span></button>
            </div>
        </div>
        <div class="fl-column fl-hover-column" data-content="Column 3">
            <img src="{{getPageImage('hvac')}}" class="fl-marine" alt="">
            <div class="fl-column-content">
                <h2>{{ $page->getTranslation('heading4', $lang) }}</h2>
                <p class="fl-hover-content fl-description2">
                    {{ $page->getTranslation('content4', $lang) }}
                </p>
                <button class="fl-hover-cta fl-button-style-2 fl-learn-more-btn">{{ trans('messages.learn_more') }}
                    <span><img src="{{ asset('assets/images/arrow-right.png') }}" alt=""></span></button>
            </div>
        </div>
    </div>
</section>
<section class="products-section fl-product-section">
    <div class="container">
        <div class="fl-section-title-area">
            <h2 class="section-title">{{ $page->getTranslation('heading5', $lang) }}</h2>
            <div class="fl-slider-control">
                <div class="swiper-button-prev fl-slide-prev animate__animated animate__bounc">
                    <img src="{{ asset('assets/images/arrow.png') }}" alt="">
                     <!-- prev -->
                </div>
                <div class="swiper-button-next fl-slide-next">
                    <img src="{{ asset('assets/images/arrow.png') }}" alt="">
                     <!-- next -->
                </div>
            </div>
        </div>
    </div>



    <div class="container">


        <div class="swiper">
            <div class="swiper-wrapper">

                @if (!empty($data['special_products']))
                    @foreach ($data['special_products'] as $special_products)
                        <div class="swiper-slide">
                            <div class="product-card fl-product-card">
                                <div class="product-image">
                                    <a href="{{ route('product-detail',['slug' => $special_products->slug]) }}">
                                        <img src="{{ asset($special_products->image) }}" class="fl-slider-img" alt="{{ $special_products->getTranslation('name', $lang) }}" />
                                    </a>
                                </div>
                                <div class="fl-product-details">
                                    {{-- <p>{{ trans('messages.category') }}</p> --}}
                                    <p>{{ $special_products->category->getTranslation('name', $lang) }}</p>
                                    <h3><a  style="color:#000" href="{{ route('product-detail',['slug' => $special_products->slug]) }}">{{ $special_products->unique_id }}</a></h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

    </div>
</section>
<section class="about-us-section-s2 section-padding">
    <div class="container">
        <div class="fl-about-details">

            <div class="section-title fl-section-title fl-about-title">
                <div class="fl-title-area">
                    <span>{{ $page->getTranslation('heading6', $lang) }}</span>
                    <h2>{{ $page->getTranslation('heading7', $lang) }}</h2>
                </div>
                <a href="#" class="theme-btn fl-get-in-touch-icon fl-btn">{{ trans('messages.learn_more') }}</a>
            </div>

            <div class="details fl-details">
                <img src="{{ asset($page->image) }}" class="img-fluid" alt="About Felco">
                <div class="fl-about-content">
                    <p>{{ $page->getTranslation('content5', $lang) }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection