@extends('frontend.layouts.app')
@section('header')
<style>
    .active>.page-link, .page-link.active {
        z-index: 3;
        color: var(--bs-pagination-active-color);
        background-color: #000000;
        border-color: #000000;
    }
</style>
@endsection
@section('content')
    <section class="catagory_details section-padding">
        <div class="container  ">

            <div class="row">
                <div class="col col-xs-12">
                    <div class="catagory_start">
                        <h2>{{ $category->getTranslation('name',$lang) }}</h2>
                        <p>
                            {!! $category->getTranslation('description',$lang) !!}
                        </p>
                    </div>

                </div>
            </div>

            <div class="row ">
                <div class="col-md-12">
                    <div class="catagory_main_img">
                        <img src="{{ uploaded_asset($category->image) }}" alt="">
                    </div>
                </div>
            </div>
            <div class="row mb-3">

            </div>

            <div class="row mb-5">

                @if ($category->frame_size != NULL)
                    <div class="col-md-3 mb-1">
                        <div class="catagory_spec">
                            <h3>{{ trans('messages.frame_size') }}</h3>
                            <span>{{ $category->frame_size }}</span>
                        </div>
                    </div>
                @endif

                @if ($category->output != NULL)
                    <div class="col-md-3 mb-1">
                        <div class="catagory_spec">
                            <h3>{{ trans('messages.output') }}</h3>
                            <span>{{ $category->output }}</span>
                        </div>
                    </div>
                @endif

                @if ($category->ip_class != NULL)
                    <div class="col-md-3 mb-1">
                        <div class="catagory_spec">
                            <h3>{{ trans('messages.ip_class') }}</h3>
                            <span>{{ $category->ip_class }}</span>
                        </div>
                    </div>
                @endif

                @if ($category->insulation_class != NULL)
                    <div class="col-md-3 mb-1">
                        <div class="catagory_spec">
                            <h3>{{ trans('messages.insulation_class') }}</h3>
                            <span>{{ $category->insulation_class }}</span>
                        </div>
                    </div>
                @endif

                @if ($category->brake != NULL)
                    <div class="col-md-3 mb-1">
                        <div class="catagory_spec">
                            <h3>{{ trans('messages.brake') }}</h3>
                            <span>{{ $category->brake }}</span>
                        </div>
                    </div>
                @endif

                @if ($category->encoder != NULL)
                    <div class="col-md-3 mb-1">
                        <div class="catagory_spec">
                            <h3>{{ trans('messages.encoder') }}</h3>
                            <span>{{ $category->encoder }}</span>
                        </div>
                    </div>
                @endif

                @if ($category->voltages != NULL)
                    <div class="col-md-3 mb-1">
                        <div class="catagory_spec">
                            <h3>{{ trans('messages.voltages') }}</h3>
                            <span>{{ $category->voltages }}</span>
                        </div>
                    </div>
                @endif

                @if ($category->efficiency != NULL)
                    <div class="col-md-3 mb-1">
                        <div class="catagory_spec">
                            <h3>{{ trans('messages.efficiency') }}</h3>
                            <span>{{ $category->efficiency }}</span>
                        </div>
                    </div>
                @endif

                @if ($category->approvals != NULL)
                    <div class="col-md-3 mb-1">
                        <div class="catagory_spec">
                            <h3>{{ trans('messages.approvals') }}</h3>
                            <span>{{ $category->approvals }}</span>
                        </div>
                    </div>
                @endif
                
               
            </div>
            @if (!empty($products[0]) || $keyword != NULL || request('frame_size') != NULL || request('poles') != NULL || request('power') != NULL || request('mounting') != NULL || request('voltage') != NULL)
            
                <form method="GET" action="{{ route('products.category', $category->slug) }}">
                    <div class="row" id="productsDiv">
                        <div class="col-md-12">
                            <h3 class="filter_label">Search and Filter</h3>
                            <div class="catagory_filter">
                                <form action="#">
                                    <div class="row g-3">
                                        <div class="col-md-3">
                                            <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Search for product id..." value="{{ $keyword }}">
                                        </div>
                                        <div class="col-md-3">
                                            <select name="frame_size" id="frame_size" class="form-select">
                                                <option selected disabled>{{ trans('messages.frame_size') }}</option>
                                                @foreach($frameSizes as $frameSize)
                                                    <option value="{{ $frameSize }}" 
                                                        {{ request('frame_size') == $frameSize ? 'selected' : '' }}>
                                                        {{ $frameSize }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="poles" id="poles" class="form-select">
                                                <option selected disabled>{{ trans('messages.poles') }}</option>
                                                @foreach($poles as $pole)
                                                    <option value="{{ $pole }}" 
                                                        {{ request('poles') == $pole ? 'selected' : '' }}>
                                                        {{ $pole }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="power" id="power" class="form-select">
                                                <option selected disabled>{{ trans('messages.power') }}</option>
                                                @foreach($powers as $power)
                                                    <option value="{{ $power }}" 
                                                        {{ request('power') == $power ? 'selected' : '' }}>
                                                        {{ $power }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="mounting" id="mounting" class="form-select">
                                                <option selected disabled>{{ trans('messages.mounting') }}</option>
                                                @foreach($mountings as $mounting)
                                                    <option value="{{ $mounting }}" 
                                                        {{ request('mounting') == $mounting ? 'selected' : '' }}>
                                                        {{ $mounting }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="voltage" id="voltage" class="form-select">
                                                <option selected disabled>{{ trans('messages.voltage') }}</option>
                                                @foreach($voltages as $voltage)
                                                    <option value="{{ $voltage }}" 
                                                        {{ request('voltage') == $voltage ? 'selected' : '' }}>
                                                        {{ $voltage }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2 nextprev_wrarpper">
                                            <button type="submit" class="theme-btn fl-get-in-touch-icon" style="margin-top: 0px;background: #000;color: white;">Filter</button>
                                            <a href="{{ route('products.category', $category->slug) }}" class="theme-btn fl-get-in-touch-icon" style="margin-top: 0px;">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="row">
                    <div class="col-md-12">
                        <div class="product_card_head">
                            <span>{{ trans('messages.product') }} {{ trans('messages.id') }}</span>
                            <span>{{ trans('messages.frame_size') }}</span>
                            <span>{{ trans('messages.poles') }}</span>
                            <span>{{ trans('messages.power') }}</span>
                            <span>{{ trans('messages.mounting') }}</span>
                            <span>{{ trans('messages.voltage') }}</span>
                            <span>{{ trans('messages.display') }} {{ trans('messages.name') }}</span>
                        </div>
                        <div class="product_card_body">
                            @if (!empty($products[0]))
                                @foreach ($products as $prod)
                                    <a href="{{ route('product-detail',['slug' => $prod->slug]) }}">
                                        <div class="product_card_list">
                                            <span>{{ $prod->unique_id }}</span>
                                            <span>{{ $prod->frame_size }}</span>
                                            <span>{{ $prod->poles }}</span>
                                            <span>{{ $prod->power }}</span>
                                            <span>{{ $prod->mounting }}</span>
                                            <span>{{ $prod->voltage }}</span>
                                            <span>{{ $prod->getTranslation('name', $lang) }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                <div class="text-center mt-4">
                                    <span>{{ trans('messages.no_product') }}</span>
                                </div>
                            @endif

                            <div class="aiz-pagination mt-5">
                                {{ $products->appends(request()->input())->links('pagination::bootstrap-5') }}
                            </div>
                            
                        </div>
                    </div>
                </div>
            @endif

            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="category-brief">
                        <h4>{{ $category->getTranslation('title1',$lang) }}</h4>
                        <p>
                            {!! $category->getTranslation('content1',$lang) !!}
                        </p>

                        
                        <h4>{{ $category->getTranslation('title2',$lang) }}</h4>

                        <p>{!! $category->getTranslation('content2',$lang) !!}</p>
                    </div>

                </div>
            </div>
        </div>
    </section>
    @if ($category->childs)
        <section class="services-section-s2 product-category">
            <div class="container">
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="service-grids clearfix">
                        
                            
                            @foreach ($category->childs as $cat)
                                <div class="grid">
                                    <div class="img-holder">
                                        <img src="{{ uploaded_asset($cat->image) }}" alt>
                                    </div>
                                    <div class="details">
                            
                                        <h3><a href="{{ route('products.category',['category_slug' => $cat->slug]) }}">{{ $cat->getTranslation('name',$lang) }}</a></h3>
                                        <a href="{{ route('products.category',['category_slug' => $cat->slug]) }}" class="theme-btn fl-get-in-touch-icon w-full">{{ trans('messages.read_more') }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>
    @endif
    
@endsection

@section('script')
<script>
$(document).ready(function () {
    // Check if the URL contains the keyword 'page'
    if (window.location.search.includes('page') || window.location.search.includes('keyword')) {
        // $('html, body').animate({
        //     scrollTop: $('#productsDiv').offset().top
        // }, 1000); 
        const targetOffset = $('#productsDiv').offset().top;
        window.scrollTo(0, targetOffset);
    }
});
</script>
@endsection
