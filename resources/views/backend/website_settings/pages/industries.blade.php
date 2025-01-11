@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h3">Edit {{ $page->slug }} Page Information</h1>
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
            <input type="hidden" name="lang" value="{{ $lang }}">
            <div class="card-header px-0">
                <h6 class="fw-600 mb-0">Page Content</h6>
            </div>
            <div class="card-body px-0">
                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Title <span
                            class="text-danger">*</span> </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Title" name="title"
                            value="{{ $page->getTranslation('title',$lang) }}" required>
                            <input type="hidden" name="type" value="{{ $page->type }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.description') }}</label>
                    <div class="col-sm-10">
                        <textarea class="resize-off form-control" placeholder="{{ trans('messages.description') }}" name="content" rows="5"   >{!! $page->getTranslation('content',$lang) !!}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Heading 1 <span
                            class="text-danger">*</span> </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Heading 1" name="heading1"
                            value="{{ $page->getTranslation('heading1',$lang) }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Content 1<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <textarea class="aiz-text-editor form-control" placeholder="Content..."
                            data-buttons='[["font", ["bold", "underline", "italic", "clear"]],["para", ["ul", "ol", "paragraph"]],["style", ["style"]],["color", ["color"]],["table", ["table"]],["insert", ["link", "picture", "video"]],["view", ["fullscreen", "codeview", "undo", "redo"]]]'
                            data-min-height="300" name="content1" required>{!! $page->getTranslation('content1',$lang) !!}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Heading 2 <span
                            class="text-danger">*</span> </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Heading 2" name="heading2"
                            value="{{ $page->getTranslation('heading2',$lang) }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Content 2<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <textarea class="aiz-text-editor form-control" placeholder="Content..."
                            data-buttons='[["font", ["bold", "underline", "italic", "clear"]],["para", ["ul", "ol", "paragraph"]],["style", ["style"]],["color", ["color"]],["table", ["table"]],["insert", ["link", "picture", "video"]],["view", ["fullscreen", "codeview", "undo", "redo"]]]'
                            data-min-height="300" name="content2" required>{!! $page->getTranslation('content2',$lang) !!}</textarea>
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
            </div>

            <div class="card-header px-0">
                <h6 class="fw-600 mb-0">Seo Fields</h6>
            </div>
            <div class="card-body px-0">

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Meta Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Meta Title" name="meta_title"
                            value="{{ $page->getTranslation('meta_title', $lang) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Meta Description</label>
                    <div class="col-sm-10">
                        <textarea class="resize-off form-control" placeholder="Meta Description" name="meta_description">{!! $page->getTranslation('meta_description',$lang) !!}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Keywords</label>
                    <div class="col-sm-10">
                        <textarea class="resize-off form-control" placeholder="Keywords" name="keywords">{!! $page->getTranslation('keywords',$lang) !!}</textarea>
                        <small class="text-muted">Separate with coma</small>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">OG Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="OG Title"
                            name="og_title" value="{{ $page->getTranslation('og_title',$lang) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">OG Description</label>
                    <div class="col-sm-10">
                        <textarea class="resize-off form-control" placeholder="OG Description" name="og_description">{!! $page->getTranslation('og_description',$lang) !!}</textarea>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Twitter Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Twitter Title"
                            name="twitter_title" value="{{ $page->getTranslation('twitter_title',$lang) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Twitter Description</label>
                    <div class="col-sm-10">
                        <textarea class="resize-off form-control" placeholder="Twitter Description"
                            name="twitter_description">{!! $page->getTranslation('twitter_description',$lang) !!}</textarea>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-info">Update Page</button>
                    <a href="{{ route('website.pages') }}" class="btn btn-warning">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection
