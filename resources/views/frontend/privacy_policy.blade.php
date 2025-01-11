@extends('frontend.layouts.app')
@section('content')
    <section class="privacy-policy">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>{{ $page->getTranslation('title', $lang) }}</h3>
                    {!! $page->getTranslation('content', $lang) !!}
                </div>
            </div>
        </div>
    </section>
@endsection
