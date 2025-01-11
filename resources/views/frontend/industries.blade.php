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
                    <div class="service-grids clearfix">
                        <div class="grid">
                            <div class="img-holder">
                                <img src="{{ getPageImage('marine') }}" alt>
                            </div>
                            <div class="details">

                                <h3><a href="{{ route('marine') }}">{{ trans('messages.marine') }}</a></h3>
                                <a href="{{ route('marine') }}" class="theme-btn fl-get-in-touch-icon w-full">{{ trans('messages.read_more') }}</a>
                            </div>
                        </div>
                        <div class="grid">
                            <div class="img-holder">
                                <img src="{{ getPageImage('oil_gas') }}" alt>
                            </div>
                            <div class="details">

                                <h3><a href="{{ route('oil_gas') }}">{{ trans('messages.oil_gas') }}</a></h3>
                                <a href="{{ route('oil_gas') }}" class="theme-btn fl-get-in-touch-icon w-full">{{ trans('messages.read_more') }}</a>
                            </div>
                        </div>
                        <div class="grid">
                            <div class="img-holder">
                                <img src="{{ getPageImage('hvac') }}" alt>
                            </div>
                            <div class="details">
                                <h3><a href="{{ route('hvac') }}">{{ trans('messages.hvac') }}</a></h3>
                                <a href="{{ route('hvac') }}" class="theme-btn fl-get-in-touch-icon w-full">{{ trans('messages.read_more') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end container -->
    </section>
@endsection
