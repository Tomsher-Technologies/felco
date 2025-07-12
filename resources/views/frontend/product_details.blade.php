@extends('frontend.layouts.app')
@section('content')
    <section class="product_details section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $product->unique_id }}</h2>
                </div>
                <div class="col-md-8">
                    <img src="{{ asset($product->image) }}" class="img-fluid w-100 h-100" alt="">
                </div>
                <div class="col-md-4">
                    <div class="product_details_info">
                        <ul>
                            <li class="pt-0">
                                <b>{{ trans('messages.display') }} {{ trans('messages.name') }}:</b>
                                <span>{{ $product->getTranslation('name', $lang) }}</span>
                            </li>
                            <li>
                                <b>{{ trans('messages.frame_size') }}:</b>
                                <span>{{ $product->frame_size }}</span>
                            </li>
                            <li>
                                <b>{{ trans('messages.power') }}:</b>
                                <span>{{ $product->power }}</span>
                            </li>
                            <li>
                                <b>{{ trans('messages.poles') }}:</b>
                                <span>{{ $product->poles }}</span>
                            </li>
                            <li>
                                <b>{{ trans('messages.mounting') }}:</b>
                                <span>{{ $product->mounting }}</span>
                            </li>
                            <li>
                                <b>{{ trans('messages.voltage') }}:</b>
                                <span>{{ $product->voltage }}</span>
                            </li>
                            <li>
                                <b>{{ trans('messages.speed') }}:</b>
                                <span>{{ $product->speed }}</span>
                            </li>
                            <li>
                                <b>{{ trans('messages.efficiency') }}:</b>
                                <span>{{ $product->efficiency }}</span>
                            </li>
                            <li>
                                <b>{{ trans('messages.market') }}:</b>
                                <span>{{ $product->getTranslation('market', $lang) }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            @if(isset($product->files) && $product->files->count() > 0)
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h3 class="filter_label">{{ trans('messages.downloads') }}</h3>
                        <div class="product_downloads">
                            @foreach($product->files as $download)
                                <a href="{{ asset($download->file) }}" target="_blank" class="theme-btn fl-get-in-touch-icon w-full"><span>{{ $download->heading }}</span> <i class="bi bi-chevron-right"></i></a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="nextprev_wrarpper">
                        {{-- <a href="#" class="theme-btn fl-get-in-touch-icon"><i
                                class="bi bi-arrow-left"></i><span>Previous Product</span></a> --}}
                        <a href="{{ Session::has('last_url') ? Session::get('last_url') : '#' }}"
                        class="theme-btn fl-get-in-touch-icon"><i
                        class="bi bi-arrow-left"></i><span>{{ trans('messages.go_back') }}</span> </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
