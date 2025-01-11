@extends('frontend.layouts.app')
@section('content')
    <section class="page-title">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <h2>{{ $page->getTranslation('title', $lang) }}</h2>
                    {!! $page->getTranslation('content', $lang) !!}
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->


    <!-- start services-section-s2 -->
    <section class="services-section-s2 product-category section-padding">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="service-grids clearfix border">
                        @if (count($categories) > 0)
                            @foreach ($categories as $cat)
                                <div class="grid">
                                    <div class="img-holder">
                                        <img src="{{ uploaded_asset($cat->image) }}" alt>
                                    </div>
                                    <div class="details">
        
                                        <h3><a href="{{ route('products.category',['category_slug' => $cat->slug]) }}">{{ $cat->getTranslation('name', $lang) }}</a></h3>
                                        <a href="{{ route('products.category',['category_slug' => $cat->slug]) }}" class="theme-btn fl-get-in-touch-icon w-full">{{ trans('messages.read_more') }}</a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div> <!-- end container -->
    </section>
@endsection
