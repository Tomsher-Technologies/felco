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

    @if (!empty($brochures[0]))
        @foreach ($brochures as $key => $broch)
            <section class="brochure_down @if((($key+1) % 2) == 0)  bg-white mt-0 @endif">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-12 m-auto">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{ uploaded_asset($broch->image) }}" class="img-fluid" alt="">
                                    <h3>{{ $broch->getTranslation('title', $lang) }}</h3>
                                </div>
                                <div class="col-md-6">
                                    @if (!empty($broch->files[0]))
                                        @foreach ($broch->files as $files)
                                            <div class="down_items">
                                                <div class="down_items_start">
                                                    <h5>{{ $files->getTranslation('title',$lang) }}</h5>
                                                    <p>{{ $files->getTranslation('content',$lang) }}</p>
                                                </div>
                                                @if ($files->file != NULL)
                                                    <a href="{{ asset($files->file) }}" target="_blank" class="theme-btn fl-get-in-touch-icon d-flex align-items-center gap-2">{{ $files->getTranslation('button_text',$lang) }} <i class="bi bi-chevron-right"></i></a>
                                                @endif
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
    @endif
@endsection
