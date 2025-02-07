@extends('frontend.layouts.app')
@section('content')
    <section class="page-title">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <h2>{{ $page->getTranslation('title', $lang) }}</h2>
                    <p>{!! $page->getTranslation('content', $lang) !!}</p>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->

    <section class="after-sales">
        <div class="container">
            @if (!empty($service_sales[0]))
                @foreach ($service_sales as $key => $sale)
                    @if ($key % 2 == 0)
                        <div class="row mb-3 g-3">
                            <div class="col-md-4">
                                <img src="{{ uploaded_asset($sale->image) }}" class="img-fluid w-100" alt="">
                            </div>
                            <div class="col-md-8">
                                <div class="manuals_items">
                                    <div class="down_items_start">
                                        <h5>{{ $sale->title }}</h5>
                                        <p>{!! $sale->content !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row g-3 mb-3">
                            <div class="col-md-8 order-2 order-md-1">
                                <div class="manuals_items">
                                    <div class="down_items_start">
                                        <h5>{{ $sale->title }}</h5>
                                        <p>{!! $sale->content !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 order-1 order-md-2">
                                <img src="{{ uploaded_asset($sale->image) }}" class="img-fluid w-100" alt="">
                            </div>
                        </div>
                    @endif
                    
                @endforeach
            @endif
            
        </div>
    </section>
@endsection
