@extends('frontend.layouts.app')
@section('header')
<style>
    .help-search {
    position: relative;
}

.search-input {
    padding-right: 40px; /* Add space for the icon inside the input */
}

.search-icon {
    position: absolute;
    right: 10px; /* Adjust this value to position the icon */
    top: 50%;
    transform: translateY(-50%);
    width: 20px; /* Icon size */
    height: 20px; /* Icon size */
    color: #6c757d; /* Adjust the color */
    cursor: pointer; /* Optional: Make the icon clickable */
}

</style>
@endsection
@section('content')
    <section class="page-title">
        <div class="container ">
            <div class="row">
                <div class="col col-xs-12">
                    <h2>{{ $page->getTranslation('title', $lang) }}</h2>
                        <p>{{ $page->getTranslation('content', $lang) }}</p>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->


    <section class="help_section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 m-auto">
                    <form name="Searchform" method="GET">
                        <div class="help-search position-relative w-100 mb-5">
                            <input type="text" class="form-control search-input" id="keyword" name="keyword" placeholder="Search here" value="{{ request('keyword')}}">
                            <svg class="search-icon" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </form>

                    <div class="accordion mb-5" id="accordionExample">

                        @php
                            $query = \App\Models\Faq::where('type','faq')->where('lang', $lang)->orderBy('sort_order','asc');
                            if(request('keyword') != NULL){
                                $query = $query->where(function ($subQuery) {
                                            $subQuery->where('question', 'LIKE', '%' . request('keyword') . '%')
                                                    ->orWhere('answer', 'LIKE', '%' . request('keyword') . '%');
                                        });
                            }
                            $faqs = $query->get();
                            if(empty($faqs[0])){
                                $query = \App\Models\Faq::where('type','faq')->where('lang', 'en')->orderBy('sort_order','asc');
                                if(request('keyword') != NULL){
                                    $query = $query->where(function ($subQuery) {
                                            $subQuery->where('question', 'LIKE', '%' . request('keyword') . '%')
                                                    ->orWhere('answer', 'LIKE', '%' . request('keyword') . '%');
                                        });
                                }
                                $faqs = $query->get();
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
                                <div id="collapseOne_{{$key}}" class="accordion-collapse collapse  @if($key == 0) show @endif"
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
    </section>
@endsection
