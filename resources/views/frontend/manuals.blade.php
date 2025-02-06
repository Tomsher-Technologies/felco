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
    @if (!empty($manuals[0]))
        @foreach ($manuals as $key => $man)
            <section class="certificate_area @if((($key+1) % 2) == 0)  bg-white mt-0 @endif">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>{{ $man->getTranslation('title', $lang) }}</h3>
                        </div>
                        <div class="col-md-6">
                            <img src="{{ uploaded_asset($man->image) }}" class="img-fluid" alt="">
                        </div>
                        <div class="col-md-6">
                            <div class="row g-3">
                                @if (!empty($man->sections[0]))
                                    @foreach ($man->sections as $sections)
                                        <div class="col-md-12">
                                            <div class="cert_items">
                                                <div class="down_items_start">
                                                    <h5>{{ $sections->getTranslation('title',$lang) }}</h5>
                                                    <p>{{ $sections->getTranslation('content',$lang) }}</p>
                                                </div>
                                                <div class="dropdown">
                                                    @if (!empty($sections->files[0]))
                                                        <button class="theme-btn fl-get-in-touch-icon d-flex align-items-center gap-2 dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-expanded="false">
                                                            {{ $sections->getTranslation('button_text',$lang) }} 
                                                            <i class="bi bi-chevron-right"></i>
                                                        </button>
                                                   
                                                        <ul class="dropdown-menu">
                                                            @foreach ($sections->files as $files)
                                                                <li><a class="dropdown-item"  target="_blank" href="{{ asset($files->file) }}">{{ $files->getTranslation('title',$lang) }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                    </div>

                </div>
            </section>
        @endforeach
    @endif
@endsection
