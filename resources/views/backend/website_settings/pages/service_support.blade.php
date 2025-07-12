@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h3">Edit Page Information</h1>
            </div>
        </div>
    </div>
    <div class="card">
        <ul class="nav nav-tabs nav-fill border-light">
            @foreach (\App\Models\Language::all() as $key => $language)
                <li class="nav-item">
                    <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3" href="{{ route('custom-pages.edit', ['id'=>$page->type, 'lang'=> $language->code] ) }}">
                        <img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" height="11" class="mr-1">
                        <span>{{$language->name}}</span>
                    </a>
                </li>
            @endforeach
        </ul>

        <form class="p-4" action="{{ route('custom-pages.update', $page->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PATCH">
            <input  type="hidden" name='lang' value="{{$lang}}">
            <div class="card-header px-0">
                <h6 class="fw-600 mb-0">Page Content</h6>
            </div>
            <div class="card-body px-0">
                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.heading') }} <span
                            class="text-danger">*</span> </label>
                    <div class="col-sm-10">
                        <input type="text" @if($lang == 'ae') dir="rtl" @endif  class="form-control" placeholder="{{ trans('messages.heading') }}" name="title"
                            value="{{ $page->getTranslation('title', $lang) }}" required>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.content') }} <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <textarea  class="form-control" placeholder="{{ trans('messages.content') }}" rows="6" name="content" >{!! $page->getTranslation('content', $lang) !!}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Contact Title<span
                            class="text-danger">*</span> </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="{{ trans('messages.heading') }}" name="sub_title"
                            value="{{ $page->getTranslation('sub_title', $lang) }}" >
                    </div>
                </div>

                @php
                    $faqs = \App\Models\Faq::where('type','service_support')->where('lang', $lang)->get();
                @endphp
                <div class=" repeater">
                    <div data-repeater-list="faqs">
                        
                        @foreach($faqs as $faq)
                            <div data-repeater-item>
                                <hr>
                                
                                <div class="form-group row">
                                    <label class="col-sm-2 col-from-label">Question:</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="question" class="form-control"  value="{{ $faq->question }}" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-from-label">Answer:</label>
                                    <div class="col-sm-10">
                                        <textarea name="answer" class="form-control">{{ $faq->answer }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-from-label">Order:</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="order" class="form-control"  value="{{ $faq->sort_order }}">
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <button type="button" class="btn btn-danger" data-repeater-delete>Delete</button>
                                </div>
                            </div>
                        @endforeach


                        <div data-repeater-item style="display: none;">

                            <hr>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-from-label">Question:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="question" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-from-label">Answer:</label>
                                <div class="col-sm-10">
                                    <textarea name="answer" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-from-label">Order:</label>
                                <div class="col-sm-10">
                                    <input type="number" name="order" class="form-control" value="0">
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button type="button" class="btn btn-danger" data-repeater-delete>Delete</button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" data-repeater-create>Add FAQ</button>
                </div>
            </div>

            <div class="card-header px-0">
                <h6 class="fw-600 mb-0">Seo Fields</h6>
            </div>
            <div class="card-body px-0">

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.meta_title') }}</label>
                    <div class="col-sm-10">
                        <input type="text"  @if($lang == 'ae') dir="rtl" @endif  class="form-control" placeholder="{{ trans('messages.meta_title') }}" name="meta_title"
                            value="{{ $page->getTranslation('meta_title', $lang) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.meta_description') }}</label>
                    <div class="col-sm-10">
                        <textarea  @if($lang == 'ae') dir="rtl" @endif class="resize-off form-control" placeholder="{{ trans('messages.meta_description') }}" name="meta_description">{!! $page->getTranslation('meta_description', $lang) !!}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.meta_keywords') }}</label>
                    <div class="col-sm-10">
                        <textarea  @if($lang == 'ae') dir="rtl" @endif class="resize-off form-control" placeholder="{{ trans('messages.meta_keywords')}}" name="keywords">{!! $page->getTranslation('keywords', $lang) !!}</textarea>
                        <small class="text-muted">Separate with coma</small>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.og_title') }}</label>
                    <div class="col-sm-10">
                        <input type="text"  @if($lang == 'ae') dir="rtl" @endif class="form-control" placeholder="{{ trans('messages.og_title') }}"
                            name="og_title" value="{{ $page->getTranslation('og_title', $lang) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.og_description') }}</label>
                    <div class="col-sm-10">
                        <textarea  @if($lang == 'ae') dir="rtl" @endif class="resize-off form-control" placeholder="{{ trans('messages.og_description') }}" name="og_description">{!! $page->getTranslation('og_description', $lang) !!}</textarea>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.twitter_title') }}</label>
                    <div class="col-sm-10">
                        <input type="text"  @if($lang == 'ae') dir="rtl" @endif class="form-control" placeholder="{{ trans('messages.twitter_title') }}"
                            name="twitter_title" value="{{ $page->getTranslation('twitter_title', $lang) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.twitter_description') }}</label>
                    <div class="col-sm-10">
                        <textarea  @if($lang == 'ae') dir="rtl" @endif class="resize-off form-control" placeholder="{{ trans('messages.twitter_description') }}"
                            name="twitter_description">{!! $page->getTranslation('twitter_description', $lang) !!}</textarea>
                    </div>
                </div>

        
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Update Page</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/jquery.repeater/jquery.repeater.min.js"></script>

<script>
    $(document).ready(function () {
        var lang = '{{ $lang }}';
       
        $('.repeater').repeater({
            initEmpty: false,
            show: function() {
                $(this).slideDown();
                // updateRepeaterHeadings();
            },
            hide: function(deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                    // updateRepeaterHeadings();
                }
            },
        });
    });
</script>

@endsection
