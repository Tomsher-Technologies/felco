@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h5 class="mb-0 h6">{{ trans('messages.industry') . ' ' . trans('messages.information') }}</h5>
    </div>


    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body p-0">
                    <ul class="nav nav-tabs nav-fill border-light">
                        @foreach (\App\Models\Language::all() as $key => $language)
                            <li class="nav-item">
                                <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3"
                                    href="{{ route('industries.edit', ['id' => $industry->id, 'lang' => $language->code]) }}">
                                    <img src="{{ static_asset('assets/img/flags/' . $language->code . '.png') }}"
                                        height="11" class="mr-1">
                                    <span>{{ $language->name }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <form class="p-4 form-horizontal" action="{{ route('industries.update', $industry->id) }}"
                        method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="lang" value="{{ $lang }}">
                        @csrf
                        @method('PUT')


                        {{-- Name --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{ trans('messages.name') }}<span
                                    class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" placeholder="{{ trans('messages.name') }}" id="name"
                                    name="name" onkeyup="makeSlug(this.value)" class="form-control"
                                    value="{{ old('name', $industry->getTranslation('name', $lang)) }}">
                                @error('name')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Slug --}}
                        <div class="form-group row @if ($lang != 'en') d-none @endif">
                            <label class="col-sm-3 col-from-label" for="slug">{{ trans('messages.slug') }}<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="{{ trans('messages.slug') }}" id="slug"
                                    name="slug" value="{{ old('slug', $industry->slug) }}" class="form-control">
                                @error('slug')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Industry image --}}
                        <div class="form-group row @if ($lang != 'en') d-none @endif">
                            <label class="col-md-3 col-form-label">{{ trans('messages.image') }}</label>
                            <div class="col-md-9">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ trans('messages.browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ trans('messages.choose_file') }}</div>
                                    <input type="hidden" name="image" class="selected-files"
                                        value="{{ old('image', $industry->image) }}">
                                </div>
                                <div class="file-preview box sm">
                                    @if ($industry->image)
                                        <img src="{{ uploaded_asset($industry->image) }}" class="img-fluid mt-2"
                                            width="100">
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="form-group row @if ($lang != 'en') d-none @endif">
                            <label class="col-md-3 col-form-label">{{ trans('messages.status') }}</label>
                            <div class="col-md-9">
                                <select class="select2 form-control" name="status">
                                    <option value="1"
                                        {{ old('status', $industry->is_active ? 1 : 2) == 1 ? 'selected' : '' }}>
                                        {{ trans('messages.enabled') }}
                                    </option>
                                    <option value="2"
                                        {{ old('status', $industry->is_active ? 1 : 2) == 2 ? 'selected' : '' }}>
                                        {{ trans('messages.disabled') }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        {{-- Product section --}}
                        <h5 class="mb-0 h6">
                            {{ trans('messages.product') . ' ' . trans('messages.section') . ' ' . trans('messages.content') }}
                        </h5>
                        <hr>

                        {{-- Title1 --}}
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label">{{ trans('messages.title') }}</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="title" id="title1" name="title1"
                                    value="{{ old('title1', $industry->getTranslation('title1', $lang)) }}"
                                    class="form-control">
                            </div>
                        </div>

                        {{-- Content1 --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{ trans('messages.content') }}</label>
                            <div class="col-md-9">
                                <textarea id="content1" name="content1" rows="3" class="form-control aiz-text-editor">{{ old('content1', $industry->getTranslation('content1', $lang)) }}</textarea>
                            </div>
                        </div>

                        {{-- Content1 Image --}}
                        <div class="form-group row @if ($lang != 'en') d-none @endif">
                            <label class="col-md-3 col-form-label">{{ trans('messages.image') }}</label>
                            <div class="col-md-9">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ trans('messages.browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ trans('messages.choose_file') }}</div>
                                    <input type="hidden" name="content_image" class="selected-files"
                                        value="{{ old('content_image', $industry->content_image) }}">
                                </div>
                                <div class="file-preview box sm">
                                    @if ($industry->content_image)
                                        <img src="{{ uploaded_asset($industry->content_image) }}" class="img-fluid mt-2"
                                            width="100">
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Categories --}}

                        <div class="form-group row  @if ($lang != 'en') d-none @endif">
                            <label class="col-md-3 col-form-label">{{ trans('messages.categories') }}</label>
                            <div class="col-md-9">
                                @php
                                    $selectedCats = old(
                                        'selected_categories',
                                        json_decode($industry->selected_categories, true) ?? [],
                                    );
                                @endphp
                                <select class="form-control aiz-selectpicker" name="selected_categories[]" multiple
                                    data-live-search="true" data-placeholder="Select Category">
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}"
                                            {{ in_array($item->id, $selectedCats) ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                        @if ($item->child)
                                            @foreach ($item->child as $cat)
                                                @include('backend.categories.menu_child_category', [
                                                    'category' => $cat,
                                                    'selected_id' => $selectedCats,
                                                ])
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Application section --}}
                        <h5 class="mb-0 h6">
                            {{ trans('messages.application') . ' ' . trans('messages.section') . ' ' . trans('messages.content') }}
                        </h5>
                        <hr>

                        {{-- Title2 --}}
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label">{{ trans('messages.title') }}</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="title" id="title2" name="title2"
                                    value="{{ old('title2', $industry->getTranslation('title2', $lang)) }}"
                                    class="form-control">
                            </div>
                        </div>

                        {{-- Content2 --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{ trans('messages.content') }}</label>
                            <div class="col-md-9">
                                <textarea id="content2" name="content2" rows="3" class="form-control aiz-text-editor">{{ old('content2', $industry->getTranslation('content2', $lang)) }}</textarea>
                            </div>
                        </div>

                        {{-- Applications repeater --}}
                        <div class="form-group row repeater">
                            <label class="col-md-3 col-form-label">{{ trans('messages.applications') }}</label>
                            <div class="card-body col-md-9">
                                <div data-repeater-list="applications">
                                    @php
                                        $apps = old(
                                            'applications',
                                            json_decode($industry->getTranslation('applications', $lang), true) ?? [],
                                        );
                                    @endphp
                                    @forelse ($apps as $app)
                                        <div data-repeater-item>
                                            <div class="form-group row">
                                                <label
                                                    class="col-md-3 col-from-label">{{ trans('messages.heading') }}</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="heading"
                                                        value="{{ $app['heading'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label
                                                    class="col-md-3 col-form-label">{{ trans('messages.description') }}</label>
                                                <div class="col-md-8">
                                                    <textarea name="content" rows="3" class="form-control">{{ $app['content'] ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group text-right">
                                                <input data-repeater-delete type="button"
                                                    class="btn btn-danger action-btn ml-1"
                                                    value="{{ trans('messages.delete') }}" />
                                            </div>
                                        </div>
                                    @empty
                                        <div data-repeater-item>
                                            <div class="form-group row">
                                                <label
                                                    class="col-md-3 col-from-label">{{ trans('messages.heading') }}</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="heading">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label
                                                    class="col-md-3 col-form-label">{{ trans('messages.description') }}</label>
                                                <div class="col-md-8">
                                                    <textarea name="content" rows="3" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group text-right">
                                                <input data-repeater-delete type="button"
                                                    class="btn btn-danger action-btn ml-1"
                                                    value="{{ trans('messages.delete') }}" />
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                                <input data-repeater-create type="button" class="btn btn-success action-btn"
                                    value="{{ trans('messages.add') }}" />
                            </div>
                        </div>

                        {{-- SEO Section --}}
                        <h5 class="mb-0 h6">{{ trans('messages.seo_section') }}</h5>
                        <hr>

                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label">{{ trans('messages.meta_title') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="meta_title"
                                    value="{{ old('meta_title', $industry->getTranslation('meta_title', $lang)) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label">{{ trans('messages.meta_description') }}</label>
                            <div class="col-sm-9">
                                <textarea name="meta_description" rows="5" class="form-control">{{ old('meta_description', $industry->getTranslation('meta_description', $lang)) }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label">{{ trans('messages.meta_keywords') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="meta_keywords"
                                    value="{{ old('meta_keywords', $industry->getTranslation('meta_keyword', $lang)) }}">
                            </div>
                        </div>

                        {{-- OG --}}
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label">{{ trans('messages.og_title') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="og_title"
                                    value="{{ old('og_title', $industry->getTranslation('og_title', $lang)) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label">{{ trans('messages.og_description') }}</label>
                            <div class="col-sm-9">
                                <textarea name="og_description" rows="5" class="form-control">{{ old('og_description', $industry->getTranslation('og_description', $lang)) }}</textarea>
                            </div>
                        </div>

                        {{-- Twitter --}}
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label">{{ trans('messages.twitter_title') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="twitter_title"
                                    value="{{ old('twitter_title', $industry->getTranslation('twitter_title', $lang)) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label">{{ trans('messages.twitter_description') }}</label>
                            <div class="col-sm-9">
                                <textarea name="twitter_description" rows="5" class="form-control">{{ old('twitter_description', $industry->getTranslation('twitter_description', $lang)) }}</textarea>
                            </div>
                        </div>

                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">{{ trans('messages.update') }}</button>
                            <a href="{{ route('industries.index') }}"
                                class="btn btn-sm btn-cancel">{{ trans('messages.cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
    <script>
        $('.repeater').repeater({
            initEmpty: false,
            show: function() {
                $(this).slideDown();
            },
            hide: function(deleteElement) {
                if (confirm('Are you sure?')) {
                    $(this).slideUp(deleteElement);
                }
            },
        });
    </script>
    <script>
        function makeSlug(val) {
            let str = val;
            let output = str.replace(/\s+/g, '-').toLowerCase();
            $('#slug').val(output);
        }
    </script>
@endsection
