@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ trans('messages.category') . ' ' . trans('messages.information') }}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('categories.store') }}" method="POST"
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
                            <label
                                class="col-md-3 col-form-label">{{ trans('messages.parent') . ' ' . trans('messages.category') }}</label>
                            <div class="col-md-9">
                                <select class="select2 form-control aiz-selectpicker" name="parent_id" data-toggle="select2"
                                    data-placeholder="Choose ..." data-live-search="true">
                                    <option value="0">{{ trans('messages.no') . ' ' . trans('messages.parent') }}
                                    </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->getTranslation('name') }}
                                        </option>
                                        @foreach ($category->childrenCategories as $childCategory)
                                            @include('backend.categories.child_category', [
                                                'child_category' => $childCategory,
                                            ])
                                        @endforeach
                                    @endforeach
                                </select>
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

                        <h5 class="mb-0 h6">Brochure Section Contents</h5>
                        <hr>

                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="title2">Title</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="title 2" id="title2" name="title2"
                                    value="{{ old('title2') }}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Content</label>
                            <div class="col-md-9">
                                <textarea id="content2" name="content2" rows="3" class="form-control aiz-text-editor">{{ old('content2') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="brochure">{{ trans('messages.brochure') }}</label>
                            <div class="col-md-9">
                                <input type="file" name="brochure" id="brochure" class="form-control"
                                    accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx" />
                                @error('brochure')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror

                                @if (!empty(old('brochure')) || (!empty($category->brochure) && $category->brochure !== null))
                                    @php
                                        $filename = explode('/', $category->brochure);
                                        $filename = $filename[count($filename) - 1];
                                    @endphp
                                    <a href="{{ $category->brochure }}" target="_blank" class="mt-2 d-block">
                                        {{ $filename }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail">
                                {{ trans('messages.image') }} <small>({{ trans('messages.1000x1000') }})</small></label>
                            <div class="col-md-9">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ trans('messages.browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ trans('messages.choose_file') }}</div>
                                    <input type="hidden" name="icon" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>


                        <h5 class="mb-0 h6">Details Page Contents</h5>
                        <hr>


                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail">Image </label>
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

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Short Description</label>
                            <div class="col-md-9">
                                <textarea id="description" name="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                            </div>
                        </div>


                        {{-- <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="title1">Title 1</label>
                        <div class="col-sm-9">
                            <input  type="text" placeholder="title 1" id="title1"
                                name="title1" value="{{ old('title1') }}" class="form-control">
                        </div>
                    </div> --}}

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Long Description</label>
                            <div class="col-md-9">
                                <textarea id="content1" name="content1" rows="3" class="form-control aiz-text-editor">{{ old('content1') }}</textarea>
                            </div>
                        </div>



                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="frame_size">Frame Size</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Frame Size" id="frame_size" name="frame_size"
                                    value="{{ old('frame_size') }}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="output">Output</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Output" id="output" name="output"
                                    value="{{ old('output') }}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="ip_class">IP Class</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="IP Class" id="ip_class" name="ip_class"
                                    value="{{ old('ip_class') }}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="insulation_class">Insulation Class</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Insulation Class" id="insulation_class"
                                    name="insulation_class" value="{{ old('insulation_class') }}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="brake">Brake</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Brake" id="brake" name="brake"
                                    value="{{ old('brake') }}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="encoder">Encoder</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Encoder" id="encoder" name="encoder"
                                    value="{{ old('encoder') }}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="voltages">Voltages</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Voltages" id="voltages" name="voltages"
                                    value="{{ old('voltages') }}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="efficiency">Efficiency</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Efficiency" id="efficiency" name="efficiency"
                                    value="{{ old('efficiency') }}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="approvals">Approvals</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Approvals" id="approvals" name="approvals"
                                    value="{{ old('approvals') }}" class="form-control">
                            </div>
                        </div>


                        <div class="form-group row repeater">
                            <label class="col-md-3 col-form-label">{{ trans('messages.features') }}</label>
                            <div class="card-body col-md-9">
                                <div data-repeater-list="features">
                                    <div data-repeater-item>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">{{ trans('messages.heading') }}</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="heading">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label
                                                class="col-md-3 col-form-label">{{ trans('messages.feature') . ' ' . trans('messages.items') }}</label>
                                            <div class="col-md-8">
                                                <div class="inner-repeater">
                                                    <div data-repeater-list="feature_items">
                                                        <div data-repeater-item class="mb-2 d-flex align-items-center">
                                                            <input type="text" name="feature" class="form-control"
                                                                placeholder="Enter sub-feature">
                                                            <input data-repeater-delete type="button"
                                                                class="btn btn-danger btn-sm mt-1"
                                                                value="{{ trans('messages.delete') }}" />
                                                        </div>
                                                    </div>
                                                    <input data-repeater-create type="button"
                                                        class="btn btn-success btn-sm mt-2"
                                                        value="{{ trans('messages.add') . ' ' . trans('messages.item') }}" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group text-right">
                                            <input data-repeater-delete type="button"
                                                class="btn btn-danger action-btn ml-1"
                                                value="{{ trans('messages.delete') . ' ' . trans('messages.feature') }}" />
                                        </div>
                                    </div>
                                </div>

                                <input data-repeater-create type="button" class="btn btn-success action-btn mt-2"
                                    value="{{ trans('messages.add') }}" />
                            </div>
                        </div>



                        <h5 class="mb-0 h6">Home Page Contents</h5>
                        <hr>



                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Home Page Content</label>
                            <div class="col-md-9">
                                <textarea id="home_content" name="home_content" rows="3" class="form-control">{{ old('home_content') }}</textarea>
                                @error('home_content')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
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
                            <a href="{{ route('categories.index') }}"
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
            repeaters: [{
                selector: '.inner-repeater'
            }]
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
