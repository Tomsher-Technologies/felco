@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h5 class="mb-0 h6">{{ trans('messages.add').' '.trans('messages.new').' '.trans('messages.product') }}</h5>
    </div>
    <div class="">
        <form class="form form-horizontal mar-top" id="addNewProduct" action="{{ route('products.store') }}" method="POST"
            enctype="multipart/form-data" id="choice_form">
            <div class="row gutters-5">
                <div class="col-lg-8">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ trans('messages.product').' '.trans('messages.information') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">Display {{ trans('messages.name') }} <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="name" placeholder="Enter Display {{ trans('messages.name') }}"
                                    onkeyup="title_update(this)" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">{{ trans('messages.slug') }}<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" placeholder="Enter {{ trans('messages.slug') }}" id="slug" name="slug" required
                                        class="form-control">
                                    @error('slug')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ trans('messages.product').' '.trans('messages.id') }} <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="product_id" id="product_id" placeholder="Enter {{ trans('messages.product').' '.trans('messages.id') }}" required>
                                </div>
                            </div>

                            <div class="form-group row" id="category">
                                <label class="col-md-3 col-from-label">{{ trans('messages.category') }} <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <select class="form-control aiz-selectpicker" name="category_id" id="category_id"
                                        data-live-search="true" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}
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
                            
                            
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ trans('messages.frame_size') }} <span
                                    class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="frame_size" id="frame_size"
                                        placeholder="Enter {{ trans('messages.frame_size') }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ trans('messages.poles') }} <span
                                    class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="poles" id="poles"
                                        placeholder="Enter {{ trans('messages.poles') }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ trans('messages.power') }} <span
                                    class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="power" id="power"
                                        placeholder="Enter {{ trans('messages.power') }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ trans('messages.mounting') }} <span
                                    class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="mounting" id="mounting"
                                        placeholder="Enter {{ trans('messages.mounting') }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ trans('messages.voltage') }} <span
                                    class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="voltage" id="voltage"
                                        placeholder="Enter {{ trans('messages.voltage') }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ trans('messages.speed') }}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="speed" id="speed"
                                        placeholder="Enter {{ trans('messages.speed') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ trans('messages.efficiency') }}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="efficiency" id="efficiency"
                                        placeholder="Enter {{ trans('messages.efficiency') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ trans('messages.hz') }}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="hz" id="hz"
                                        placeholder="Enter {{ trans('messages.hz') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ trans('messages.market') }}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="market" id="market"
                                        placeholder="Enter {{ trans('messages.market') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ trans('messages.product').' '.trans('messages.image') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="signinSrEmail">{{ trans('messages.image') }}
                                    <small>({{ trans('messages.1000*1000') }})</small></label>
                                <div class="col-md-8">
                                    <input type="file" name="image" class="form-control" accept="image/*" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card repeater">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ trans('messages.product').' '.trans('messages.downloads') }}</h5>
                        </div>
                        <div class="card-body">
                            <div data-repeater-list="downloads">
                                <div data-repeater-item>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">{{ trans('messages.heading') }}</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="heading">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="signinSrEmail">PDF File</label>
                                        <div class="col-md-8">
                                            <input type="file" name="pdf_file" class="form-control" accept="application/pdf" required>
                                        </div>

                                    </div>
                                    <div class="form-group text-right">
                                        <input data-repeater-delete type="button" class="btn btn-danger action-btn  ml-1"
                                        value="{{ trans('messages.delete') }}" />
                                    </div> 
                                </div>
                            </div>
                            <input data-repeater-create type="button" class="btn btn-success action-btn"
                                value="{{ trans('messages.add') }}" />
                        </div>
                    </div>

                  
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ trans('messages.seo_section') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ trans('messages.meta_title') }}</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="meta_title"
                                        placeholder="Enter {{ trans('messages.meta_title') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ trans('messages.meta_description') }}</label>
                                <div class="col-lg-8">
                                    <textarea name="meta_description" rows="8" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ trans('messages.meta_keywords') }}</label>
                                <div class="col-md-8">
                                    {{-- data-max-tags="1" --}}
                                    <input type="text" class="form-control aiz-tag-input" name="meta_keywords[]"
                                        placeholder="{{ trans('messages.type_hit_enter_add_keyword') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ trans('messages.og_title') }}</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="og_title" placeholder="Enter {{ trans('messages.og_title') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ trans('messages.og_description') }}</label>
                                <div class="col-lg-8">
                                    <textarea name="og_description" rows="8" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ trans('messages.twitter_title') }}</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="twitter_title"
                                        placeholder="Enter {{ trans('messages.twitter_title') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ trans('messages.twitter_description') }}</label>
                                <div class="col-lg-8">
                                    <textarea name="twitter_description" rows="8" class="form-control"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">

                    <div class="card bg-transparent shadow-none border-0">
                        <div class="card-body p-0">
                            <div class="btn-toolbar justify-content-end" role="toolbar"
                                aria-label="Toolbar with button groups">
                                <div class="btn-group mr-2" role="group" aria-label="First group">
                                    <button type="submit" name="button" value="draft"
                                        class="btn btn-warning action-btn">{{ trans('messages.save_draft') }}</button>
                                </div>
                               
                                <div class="btn-group" role="group" aria-label="Second group">
                                    <button type="submit" name="button" value="publish"
                                        class="btn btn-success action-btn">{{ trans('messages.save_publish') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12">
                    <div class="btn-toolbar float-right mb-3" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            <button type="submit" name="button" value="draft" class="btn btn-warning action-btn">{{ trans('messages.save_draft') }}</button>
                        </div>
                        
                        <div class="btn-group" role="group" aria-label="Second group">
                            <button type="submit" name="button" value="publish"
                                class="btn btn-success action-btn">{{ trans('messages.save_publish') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('styles')
<style>
    .pro_variant_name{
        text-decoration: underline;
        text-underline-position: under;
    }
</style>
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

    <script type="text/javascript">
        $('form').bind('submit', function(e) {
            if ($(".action-btn").attr('attempted') == 'true') {
                //stop submitting the form because we have already clicked submit.
                e.preventDefault();
            } else {
                $(".action-btn").attr("attempted", 'true');
            }
           
        });

        function title_update(e) {
            title = e.value;
            title = title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '')
            $('#slug').val(title)
        }

      
    </script>
@endsection
