@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ trans('messages.industry') . ' ' . trans('messages.information') }}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('industries.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{ trans('messages.name') }}<span
                                    class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" placeholder="{{ trans('messages.name') }}" id="name"
                                    name="name" onkeyup="makeSlug(this.value)" class="form-control"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="slug">{{ trans('messages.slug') }}<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="{{ trans('messages.slug') }}" id="slug"
                                    name="slug" value="{{ old('slug') }}" class="form-control">
                                @error('slug')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{ trans('messages.description') }}</label>
                            <div class="col-md-9">
                                <textarea id="description" name="description" rows="3" class="form-control ">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{ trans('messages.image') }}
                            </label>
                            <div class="col-md-9">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ trans('messages.browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ trans('messages.choose_file') }}</div>
                                    <input type="hidden" name="image" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group  row">
                            <label class="col-md-3 col-form-label">{{ trans('messages.status') }}</label>
                            <div class="col-md-9">
                                <select class="select2 form-control" name="status">
                                    <option {{ old('status') == 1 ? 'selected' : '' }} value="1">
                                        {{ trans('messages.enabled') }}
                                    </option>
                                    <option {{ old('status') == 2 ? 'selected' : '' }} value="2">
                                        {{ trans('messages.disabled') }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <h5 class="mb-0 h6">
                            {{ trans('messages.product') . ' ' . trans('messages.section') . '' . trans('messages.content') }}
                        </h5>
                        <hr>

                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="title1">{{ trans('messages.title') }}</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="title" id="title1" name="title1"
                                    value="{{ old('title1') }}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{ trans('messages.content') }}</label>
                            <div class="col-md-9">
                                <textarea id="content1" name="content1" rows="3" class="form-control ">{{ old('content1') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{ trans('messages.image') }}
                            </label>
                            <div class="col-md-9">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ trans('messages.browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ trans('messages.choose_file') }}</div>
                                    <input type="hidden" name="content_image" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-form-label">{{ trans('messages.categories') }}</label>
                            <div class="col-md-9">
                                <select class="form-control aiz-selectpicker" name="selected_categories[]"
                                    data-live-search="true" required multiple data-placeholder="Select Category">

                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @if ($item->child)
                                            @foreach ($item->child as $cat)
                                                @include('backend.categories.menu_child_category', [
                                                    'category' => $cat,
                                                    'selected_id' => 0,
                                                ])
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <h5 class="mb-0 h6">
                            {{ trans('messages.application') . ' ' . trans('messages.section') . '' . trans('messages.content') }}
                        </h5>
                        <hr>

                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="title2">{{ trans('messages.title') }}</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="title" id="title2" name="title2"
                                    value="{{ old('title2') }}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{ trans('messages.content') }}</label>
                            <div class="col-md-9">
                                <textarea id="content2" name="content2" rows="3" class="form-control ">{{ old('content2') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row repeater">
                            <label class="col-md-3 col-form-label">{{ trans('messages.applications') }}</label>
                            <div class="card-body col-md-9">
                                <div data-repeater-list="applications">
                                    <div data-repeater-item>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-from-label">{{ trans('messages.heading') }}</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="heading">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label"
                                                for="signinSrEmail">{{ trans('messages.description') }}</label>
                                            <div class="col-md-8">
                                                <textarea id="content" name="content" rows="3" class="form-control"></textarea>
                                            </div>

                                        </div>

                                        <div class="form-group text-right">
                                            <input data-repeater-delete type="button"
                                                class="btn btn-danger action-btn  ml-1"
                                                value="{{ trans('messages.delete') }}" />
                                        </div>
                                    </div>
                                </div>
                                <input data-repeater-create type="button" class="btn btn-success action-btn"
                                    value="{{ trans('messages.add') }}" />
                            </div>
                        </div>


                        <h5 class="mb-0 h6">{{ trans('messages.seo_section') }}</h5>
                        <hr>

                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label">{{ trans('messages.meta_title') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="meta_title"
                                    value="{{ old('meta_title') }}" placeholder="{{ trans('messages.meta_title') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label">{{ trans('messages.meta_description') }}</label>
                            <div class="col-sm-9">
                                <textarea name="meta_description" rows="5" class="form-control">{{ old('meta_description') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label">{{ trans('messages.meta_keywords') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="meta_keywords"
                                    value="{{ old('meta_keywords') }}"
                                    placeholder="{{ trans('messages.meta_keywords') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label">{{ trans('messages.og_title') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="og_title"
                                    value="{{ old('og_title') }}" placeholder="{{ trans('messages.og_title') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label">{{ trans('messages.og_description') }}</label>
                            <div class="col-sm-9">
                                <textarea name="og_description" rows="5" class="form-control">{{ old('og_description') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label">{{ trans('messages.twitter_title') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="twitter_title"
                                    value="{{ old('twitter_title') }}"
                                    placeholder="{{ trans('messages.twitter_title') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label">{{ trans('messages.twitter_description') }}</label>
                            <div class="col-sm-9">
                                <textarea name="twitter_description" rows="5" class="form-control">{{ old('twitter_description') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">{{ trans('messages.Save') }}</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"
        integrity="sha512-foIijUdV0fR0Zew7vmw98E6mOWd9gkGWQBWaoA1EOFAx+pY+N8FmmtIYAVj64R98KeD2wzZh1aHK0JSpKmRH8w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('.repeater').repeater({
            initEmpty: true,
            show: function() {
                $(this).slideDown();

            },
            hide: function(deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
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
