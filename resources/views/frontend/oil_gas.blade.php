@extends('frontend.layouts.app')
@section('content')
    <section class="catagory_details section-padding">
        <div class="container  ">

            <div class="row">
                <div class="col col-xs-12">
                    <div class="catagory_start">
                        <h2>{{ $page->getTranslation('title', $lang) }}</h2>
                        <p>{{ $page->getTranslation('content', $lang) }}</p>
                    </div>

                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="category-brief">
                        <h4>{{ $page->getTranslation('heading1', $lang) }}</h4>
                        <p>{!! $page->getTranslation('content1', $lang) !!}</p>

                     
                        <h4>{{ $page->getTranslation('heading2', $lang) }}</h4>

                        <p>{!! $page->getTranslation('content2', $lang) !!}</p>
                    </div>

                </div>
            </div>


            <div class="row ">
                <div class="col-md-12">
                    <div class="catagory_main_img">
                        <img src="{{ asset($page->image) }}" style="width: 100%;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection
