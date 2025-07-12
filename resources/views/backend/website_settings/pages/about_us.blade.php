@extends('backend.layouts.app')

@section('header')
    <style>
        .section-heading {
            background-color: #f8f9fa;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
        }

        .section-heading h4 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
    </style>
@endsection

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
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.title') }} <span
                            class="text-danger">*</span> </label>
                    <div class="col-sm-10">
                        <input type="text" @if($lang == 'ae') dir="rtl" @endif  class="form-control" placeholder="{{ trans('messages.title') }}" name="title"
                            value="{{ $page->getTranslation('title', $lang) }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.sub_title') }} <span
                            class="text-danger">*</span> </label>
                    <div class="col-sm-10">
                        <textarea  class="form-control" placeholder="{{ trans('messages.sub_title') }}"
                           name="sub_title" >{!! $page->getTranslation('sub_title', $lang) !!}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Heading 1 <span
                            class="text-danger">*</span> </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Heading 1 " name="heading1"
                            value="{{ $page->getTranslation('heading1', $lang) }}" required>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.content') }} 1 <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <textarea  class="aiz-text-editor form-control" placeholder="{{ trans('messages.content') }} 1"
                            data-buttons='[["font", ["bold", "underline", "italic", "clear"]],["para", ["ul", "ol", "paragraph"]],["style", ["style"]],["color", ["color"]],["table", ["table"]],["insert", ["link", "picture", "video"]],["view", ["fullscreen", "codeview", "undo", "redo"]]]'
                            data-min-height="300" name="content1" required>{!! $page->getTranslation('content1', $lang) !!}</textarea>
                    </div>
                </div>

                <div class="form-group row @if ($lang != 'en') d-none @endif">
                    <label class="col-md-2 col-form-label" for="signinSrEmail">{{ trans('messages.image') }}</label>
                    <div class="col-md-10">
                        <input type="file" name="image" class="form-control" accept="image/*">

                        @if ($page->image)
                            <div class="file-preview box sm">
                                <div class="d-flex justify-content-between align-items-center mt-2 file-preview-item">
                                        <div class="align-items-center align-self-stretch d-flex justify-content-center thumb">
                                            <img src="{{ asset($page->image) }}" class="img-fit">
                                        </div>
                                        <div class="remove">
                                            <button class="btn btn-sm btn-link remove-galley"
                                                data-url="{{ $page->image }}" type="button">
                                                <i class="la la-close"></i></button>
                                        </div>
                                    </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <h5 class="mb-0 ml-3">Points Section</h5>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Point 1 <span
                            class="text-danger">*</span> </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Point 1" name="heading2"
                            value="{{ $page->getTranslation('heading2', $lang) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Content 1 <span
                            class="text-danger">*</span> </label>
                    <div class="col-sm-10">
                        <textarea  class="form-control" placeholder="Content 1"
                           name="content2" >{!! $page->getTranslation('content2', $lang) !!}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Point 2 <span
                            class="text-danger">*</span> </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Point 2" name="heading3"
                            value="{{ $page->getTranslation('heading3', $lang) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Content 2 <span
                            class="text-danger">*</span> </label>
                    <div class="col-sm-10">
                        <textarea  class="form-control" placeholder="Content 2"
                           name="content3" >{!! $page->getTranslation('content3', $lang) !!}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Point 3 <span
                            class="text-danger">*</span> </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Point 3" name="heading4"
                            value="{{ $page->getTranslation('heading4', $lang) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Content 3 <span
                            class="text-danger">*</span> </label>
                    <div class="col-sm-10">
                        <textarea  class="form-control" placeholder="Content 3"
                           name="content4" >{!! $page->getTranslation('content4', $lang) !!}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Point 4 <span
                            class="text-danger">*</span> </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Point 4" name="heading5"
                            value="{{ $page->getTranslation('heading5', $lang) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Content 4 <span
                            class="text-danger">*</span> </label>
                    <div class="col-sm-10">
                        <textarea  class="form-control" placeholder="Content 4"
                           name="content5" >{!! $page->getTranslation('content5', $lang) !!}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <h5 class="mb-0 ml-3">Why Choose Us Section</h5>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.heading') }} <span
                            class="text-danger">*</span> </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="{{ trans('messages.heading') }}" name="heading6"
                            value="{{ $page->getTranslation('heading6', $lang) }}" required>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.content') }} <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <textarea  class="aiz-text-editor form-control" placeholder="{{ trans('messages.content') }}"
                            data-buttons='[["font", ["bold", "underline", "italic", "clear"]],["para", ["ul", "ol", "paragraph"]],["style", ["style"]],["color", ["color"]],["table", ["table"]],["insert", ["link", "picture", "video"]],["view", ["fullscreen", "codeview", "undo", "redo"]]]'
                            data-min-height="300" name="content" required>{!! $page->getTranslation('content', $lang) !!}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <h5 class="mb-0 ml-3">FAQ Section</h5>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.heading') }} <span
                            class="text-danger">*</span> </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="{{ trans('messages.heading') }}" name="heading7"
                            value="{{ $page->getTranslation('heading7', $lang) }}" required>
                    </div>
                </div>

                @php
                    $faqs = \App\Models\Faq::where('type','about_us')->where('lang', $lang)->get();
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

        // function updateRepeaterHeadings() {
        //     $('.repeater [data-repeater-item]').each(function (index) {
        //         alert(index);
        //         $(this).find('.repeater-index').html(index + 1); // Update heading with correct number
        //     });
        // }

        // updateRepeaterHeadings();
        
    });
</script>

@endsection
