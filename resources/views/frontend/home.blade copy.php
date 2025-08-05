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






<section id="Pd-Categories" class="py-5 bg-light">
    <div class="container">
<div id="sec-title" class="text-center !bg-[#f06425] mb-5">
    <h2 class="main-title">{{ $page->getTranslation('heading1', $lang) }}</h2>
</div>


        @if(!empty($data['product_categories']))
            <div class="row g-4">
                @foreach($data['product_categories'] as $index => $product_categories)
                    @php
                        $colClass = match($index) {
                            0 => 'col-md-6',
                            1, 2 => 'col-md-3',
                            3, 4 => 'col-md-6',
                            default => null
                        };
                    @endphp

                    @if($colClass)
                        <div class="{{ $colClass }}">
                            <a href="{{ route('products.category', ['category_slug' => $product_categories->slug]) }}"
                               class="category-box d-block h-100 text-decoration-none text-dark position-relative overflow-hidden">
                                <div class="category-content p-4 rounded shadow-sm h-100 d-flex flex-column justify-content-between position-relative">
                                    <div>
                                        <h5 class="fw-semibold mb-2">{{ $product_categories->getTranslation('name', $lang) }}</h5>
                                        <p class="text-muted small">{{ $product_categories->getTranslation('home_content', $lang) }}</p>
                                    </div>
                                    <span class="view-more-btn mt-4">
                                        <span class="text">View</span>
                                        <i class="arrow-icon ms-2">&rarr;</i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</section>

<style>



/* Section background image */
#Pd-Categories {
    position: relative;
    background-image: url('/assets/images/felco-about-bg.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed; /* Optional: for parallax feel */
    z-index: 1;
}

#Pd-Categories::before {
    content: "";
    position: absolute;
    inset: 0;
    background-color: rgba(255, 255, 255, 0.9); /* Optional overlay */
    z-index: -1;
}
/* Start: Pd-Categories Styles */
#Pd-Categories .category-box {
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

#Pd-Categories .category-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.08);
}

#Pd-Categories .category-content {
    /* background: #fff;//// */
    height: 100%;
    padding-left: 1.5rem;
    transition: padding-left 0.4s ease;
    position: relative;
    overflow: hidden;
        border: 1px solid #eee;
}

/* Animated left fill bar */
#Pd-Categories .category-content::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 5px;
    height: 100%;
    background-color: #ff6a00;
    transform: scaleY(0);
    transform-origin: top;
    transition: transform 0.4s ease-in-out;
    z-index: 1;
}

#Pd-Categories .category-box:hover .category-content::before {
    transform: scaleY(1);
}

/* Ensure text sits above animated background */
#Pd-Categories .category-content > * {
    position: relative;
    z-index: 2;
}

/* View More Button */
#Pd-Categories .view-more-btn {
    display: inline-flex;
    align-items: center;
    justify-content: space-between;
    background-color: #ff6a00;
    color: #fff;
    padding: 6px 14px;
    font-size: 13px;
    font-weight: 500;
    border-radius: 20px;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.4s ease;
    pointer-events: none;
    gap: 8px;
}

#Pd-Categories .category-box:hover .view-more-btn {
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;
}

/* Arrow animation */
#Pd-Categories .arrow-icon {
    display: inline-block;
    transition: transform 0.3s ease;
}

#Pd-Categories .view-more-btn:hover .arrow-icon {
    transform: translateX(4px);
}
/* End: Pd-Categories Styles */
</style>



<style>

.features-bg {
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.features-bg::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('/assets/images/logo/wheel.gif') center center no-repeat;
    background-size: cover;
    opacity: 0.1; /* Adjust to your desired transparency */
    z-index: -1;
    pointer-events: none;
}

/* Hide background on small screens */
@media (max-width: 767.98px) {
    .features-bg::before {
        display: none;
    }
}


</style>



<section id="felcoIndustriesSliderUnique" class="section-padding py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <h2 class="fl-section-title mb-0">{{ $page->getTranslation('heading8', $lang) }}</h2>
            <div class="d-flex gap-2 industry-slider-controls slider-controls">
                <div class="industry-prev rounded-circle shadow-sm">
                    <img src="{{ asset('assets/images/arrow.png') }}" alt="Prev">
                </div>
                <div class="industry-next rounded-circle shadow-sm">
                    <img src="{{ asset('assets/images/arrow-right.png') }}" alt="Next">
                </div>
            </div>
        </div>

        @php
            $allIndustries = \App\Models\Page::where('industy', 1)->where('status', 1)->take(11)->get();
        @endphp

        <div class="swiper industry-swiper">
            <div class="swiper-wrapper">
                @foreach ($allIndustries as $industry)
                    <div class="swiper-slide">
                        <a href="{{ route('industry.details', ['type' => $industry->type]) }}" class="industry-card-unique d-block">
                            <div class="industry-img-container-unique position-relative rounded overflow-hidden">
                                <img src="{{ getPageImage($industry->type) }}" alt="{{ $industry->slug }}" class="industry-img-unique w-100">
                                <div class="industry-overlay-unique">
                                    <h3 class="industry-title-unique">{{ $industry->getTranslation('title', $lang) ?? $industry->slug }}</h3>
                                    <span class="industry-readmore-unique">
                                        {{ trans('messages.learn_more') }}
                                        <img src="{{ asset('assets/images/arrow-right.png') }}" alt="→" class="arrow-icon" />
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


<style>#felcoIndustriesSliderUnique .swiper-prev-unique,
#felcoIndustriesSliderUnique .swiper-next-unique {
    width: 40px;
    height: 40px;
    background: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    cursor: pointer;
    transition: background 0.3s ease;
}
#felcoIndustriesSliderUnique .swiper-prev-unique:hover,
#felcoIndustriesSliderUnique .swiper-next-unique:hover {
    background-color: #f06425;
}
#felcoIndustriesSliderUnique .swiper-prev-unique img,
#felcoIndustriesSliderUnique .swiper-next-unique img {
    max-width: 16px;
}

/* Industry card styling */
#felcoIndustriesSliderUnique .industry-card-unique {
    text-decoration: none;
    transition: transform 0.3s ease;
}
#felcoIndustriesSliderUnique .industry-card-unique:hover {
    transform: translateY(-6px);
}
#felcoIndustriesSliderUnique .industry-img-container-unique {
    height: 260px;
    border-radius: 12px;
    overflow: hidden;
    position: relative;
}
#felcoIndustriesSliderUnique .industry-img-unique {
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}
#felcoIndustriesSliderUnique .industry-card-unique:hover .industry-img-unique {
    transform: scale(1.05);
}
#felcoIndustriesSliderUnique .industry-overlay-unique {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 1.25rem;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.75), transparent);
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    height: 100%;
}
#felcoIndustriesSliderUnique .industry-title-unique {
    color: #fff;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}
#felcoIndustriesSliderUnique .industry-readmore-unique {
    display: inline-flex;
    align-items: center;
    font-size: 0.95rem;
    color: #fff;
    font-weight: 500;
    opacity: 0;
    transform: translateY(10px);
    transition: all 0.3s ease;
}
#felcoIndustriesSliderUnique .industry-card-unique:hover .industry-readmore-unique {
    opacity: 1;
    transform: translateY(0);
}
#felcoIndustriesSliderUnique .arrow-icon {
    width: 16px;
    margin-left: 6px;
    transition: transform 0.3s ease;
}
#felcoIndustriesSliderUnique .industry-card-unique:hover .arrow-icon {
    transform: translateX(4px);
}
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        new Swiper(".industry-swiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: false,
            navigation: {
                nextEl: ".industry-next",
                prevEl: ".industry-prev"
            },
            breakpoints: {
                640: { slidesPerView: 2 },
                992: { slidesPerView: 3 }
            }
        });
    });
</script>
















<!-- 
<section class="fl-industries-serve section-padding p-b-0 p-t-0 bg-light">
  

<div class="container">
    <div class="fl-section-title-area">
        <h2 class="fl-section-title">{{ $page->getTranslation('heading8', $lang) }}</h2>
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
                    <a href="{{ route('marine') }}">
                        <button class="fl-cta fl-button-style-2 fl-learn-more-btn">
                            {{ trans('messages.learn_more') }} 
                            <span><img src="{{ asset('assets/images/arrow-right.png') }}" alt=""></span>
                        </button>
                    </a>
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
                <a href="{{ route('oil_gas') }}">
                    <button class="fl-hover-cta fl-button-style-2 fl-learn-more-btn">
                        {{ trans('messages.learn_more') }}
                        <span><img src="{{ asset('assets/images/arrow-right.png') }}" alt=""></span>
                    </button>
                </a>
            </div>
        </div>
        <div class="fl-column fl-hover-column" data-content="Column 3">
            <img src="{{getPageImage('hvac')}}" class="fl-marine" alt="">
            <div class="fl-column-content">
                <h2>{{ $page->getTranslation('heading4', $lang) }}</h2>
                <p class="fl-hover-content fl-description2">
                    {{ $page->getTranslation('content4', $lang) }}
                </p>
                <a href="{{ route('hvac') }}">
                    <button class="fl-hover-cta fl-button-style-2 fl-learn-more-btn">
                        {{ trans('messages.learn_more') }}
                        <span><img src="{{ asset('assets/images/arrow-right.png') }}" alt=""></span>
                    </button>
                </a>
            </div>
        </div>
    </div>
</section> -->












<section id="ptListStyleUnique" class="products-section py-5 bg-dark text-white">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-title-unique">{{ $page->getTranslation('heading5', $lang) }}</h2>
            <div class="product-slider-controls d-flex gap-2 slider-controls">
                <div class="product-prev rounded-circle shadow-sm">
                    <img src="{{ asset('assets/images/arrow.png') }}" alt="Prev">
                </div>
                <div class="product-next rounded-circle shadow-sm">
                    <img src="{{ asset('assets/images/arrow-right.png') }}" alt="Next">
                </div>
            </div>
        </div>

        <div class="swiper product-swiper">
            <div class="swiper-wrapper">
                @foreach ($data['special_products'] ?? [] as $special_products)
                    <div class="swiper-slide">
                        <div class="product-card bg-white p-3 shadow-sm rounded h-100 d-flex flex-column justify-content-between">
                            <div class="product-image mb-3">
                                <a href="{{ route('product-detail', ['slug' => $special_products->slug]) }}">
                                    <img src="{{ asset($special_products->image) }}" class="img-fluid border-light" alt="{{ $special_products->getTranslation('name', $lang) }}">
                                </a>
                            </div>
                            <div class="text-start">
                                <p class="text-muted small mb-1">{{ $special_products->category->getTranslation('name', $lang) }}</p>
                                <h3 class="h6 m-0">
                                    <a href="{{ route('product-detail', ['slug' => $special_products->slug]) }}" class="text-dark text-decoration-none fw-semibold">
                                        {{ $special_products->unique_id }}
                                    </a>
                                </h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>



<style>
    /* Container */
#ptListStyleUnique {
    background-color: #111;
    color: #fff;
    padding-bottom: 100px !important;
}

/* Title */
#ptListStyleUnique .section-title-unique {
    font-size: 2rem;
    font-weight: 700;
    position: relative;
    padding-bottom: 8px;
    margin: 0;
    text-transform: uppercase;
    color: #fff;
}
#ptListStyleUnique .section-title-unique::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 3px;
    background-color: #ff6a00;
    border-radius: 2px;
}

/* Arrows */
#ptListStyleUnique .slider-controls-unique .slider-prev-unique,
#ptListStyleUnique .slider-controls-unique .slider-next-unique {
    width: 50px;
    height: 50px;
    padding: 5px 10px;
    background-color: rgba(255, 255, 255, 0.08);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}
#ptListStyleUnique .slider-controls-unique .slider-prev-unique:hover,
#ptListStyleUnique .slider-controls-unique .slider-next-unique:hover {
    background-color: #ff6a00;
}
#ptListStyleUnique .slider-controls-unique img {
    width: 30px;
    filter: brightness(0) invert(1);
}

/* Product card */
#ptListStyleUnique .card-pt-unique {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: none;
    background: #fff;
    height: 100%;
}
#ptListStyleUnique .card-pt-unique:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}

#ptListStyleUnique .slider-img-pt-unique {
    max-height: 100%;
    object-fit: contain;
    background-color: #f8f8f8;
    border: 1px solid #eee;
    border-radius: 4px;
    display: block;
    margin: 0 auto;
}

#ptListStyleUnique .product-details-pt-unique {
    text-align: left;
}

</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        new Swiper(".product-swiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: false,
            navigation: {
                nextEl: ".product-next",
                prevEl: ".product-prev"
            },
            breakpoints: {
                640: { slidesPerView: 2 },
                992: { slidesPerView: 3 },
                1200: { slidesPerView: 3 }
            }
        });
    });
</script>












<section class="about-us-section-s2 section-padding" style="background: url('{{ asset('assets/images/felco-website-bg.png') }}') center center no-repeat; background-size: cover; background-attachment: fixed;">
    <div class="container">
        <div class="fl-about-details">

            <div class="section-title fl-section-title fl-about-title">
                <div class="fl-title-area">
                    <span>{{ $page->getTranslation('heading6', $lang) }}</span>
                    <h2>{{ $page->getTranslation('heading7', $lang) }}</h2>
                </div>
                <a href="{{ route('about_us') }}" class="theme-btn fl-get-in-touch-icon fl-btn">{{ trans('messages.learn_more') }}</a>
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