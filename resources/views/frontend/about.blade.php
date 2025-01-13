@extends('frontend.layouts.app')
@section('content')
    <section class="page-title">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <h2>{{ $page->getTranslation('title', $lang) }}</h2>
                    <p>{{ $page->getTranslation('sub_title', $lang) }}</p>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->



    <!-- start about-us-section -->
    <section class="about-us-section about-us-page-section section-padding p-b-0">
        <div class="container ">
            <div class="row">
                <div class="col-12 col-md-7">
                    <div class="section-title">

                        <h2>{{ $page->getTranslation('heading1', $lang) }}</h2>
                    </div>
                    <div class="details">
                        {!! $page->getTranslation('content1', $lang) !!}
                    </div>

                </div>
                <div class="col-12 col-md-5">
                    <div class="img-holder about-image">
                        <img src="{{ asset($page->image) }}" class="h-100 img-fluid" alt>
                    </div>
                </div>
            </div>
        </div> <!-- end container -->
    </section>
    <!-- end about-us-section -->


    <!-- start features-section-s2 -->
    <section class="features-section-s2 about-us-page-feature">
        <div class="container ">
            <div class="row">
                <div class="col-12 col-xs-12">
                    <div class="feature-grids clearfix">
                        <div class="grid">
                            <!-- <div class="img-holder">
                    <img src="assets/images/features/01.png" alt>
                </div> -->
                            <h3>01. {{ $page->getTranslation('heading2', $lang) }}</h3>
                            <p>{{ $page->getTranslation('content2', $lang) }}</p>
                        </div>
                        <div class="grid">
                            <!-- <div class="img-holder">
                    <img src="assets/images/features/02.png" alt>
                </div> -->
                            <h3>02. {{ $page->getTranslation('heading3', $lang) }}</h3>
                            <p>{{ $page->getTranslation('content3', $lang) }}</p>
                        </div>
                        <div class="grid">
                            <!-- <div class="img-holder">
                    <img src="assets/images/features/03.png" alt>
                </div> -->
                            <h3>03. {{ $page->getTranslation('heading4', $lang) }}</h3>
                            <p> {{ $page->getTranslation('content4', $lang) }}
                            </p>
                        </div>
                        <div class="grid">
                            <!-- <div class="img-holder">
                    <img src="assets/images/features/04.png" alt>
                </div> -->
                            <h3>04. {{ $page->getTranslation('heading5', $lang) }}</h3>
                            <p>{{ $page->getTranslation('content5', $lang) }} </p>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end container -->
    </section>
    <!-- end features-section-s2 -->


    <!-- start why-choose-us-section -->
    <section class="why-choose-us-section why-choose-faq-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="inner-area">
                        <div class="section-title">
                            <span>{{ trans('messages.why_choose_us') }}</span>
                            <h2>{{ $page->getTranslation('heading6', $lang) }}</h2>
                        </div>
                        <div class="details">
                            {!! $page->getTranslation('content', $lang) !!}
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="section-title">
                        <span>{{ trans('messages.faq') }}</span>
                        <h2>{{ $page->getTranslation('heading7', $lang) }}</h2>
                    </div>
                    <div class="faq-section">
                        <div class="accordion" id="accordionExample">
                            @php
                                $faqs = \App\Models\Faq::where('type','about_us')->where('lang', $lang)->orderBy('sort_order','asc')->get();
                                if(empty($faqs[0])){
                                    $faqs = \App\Models\Faq::where('type','about_us')->where('lang', 'en')->orderBy('sort_order','asc')->get();
                                }
                            @endphp

                            @foreach ($faqs as $key => $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne_{{$key}}" aria-expanded="true" aria-controls="collapseOne_{{$key}}">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="collapseOne_{{$key}}" class="accordion-collapse collapse @if($key == 0) show @endif"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>{{ $faq->answer }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
