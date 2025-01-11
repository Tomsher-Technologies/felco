@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h1 class="mb-0 h6">Edit Product</h5>
    </div>
    <div class="">
        <form class="form form-horizontal mar-top" action="{{ route('products.update', $product->id) }}" method="POST"
            enctype="multipart/form-data" id="choice_form">
            <div class="row gutters-5">
                <div class="col-lg-8">
                    <input name="_method" type="hidden" value="POST">
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="hidden" name="lang" value="{{ $lang }}">
                    @csrf
                    <div class="card">
                        <div class="card-body p-0">
                            <ul class="nav nav-tabs nav-fill border-light">
                                @foreach (\App\Models\Language::all() as $key => $language)
                                    <li class="nav-item">
                                        <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3"
                                            href="{{ route('products.edit', ['id' => $product->id, 'lang' => $language->code]) }}">
                                            <img src="{{ static_asset('assets/img/flags/' . $language->code . '.png') }}"
                                                height="11" class="mr-1">
                                            <span>{{ $language->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class=" p-4">
                                <div class="form-group row ">
                                    <label class="col-lg-3 col-from-label">Display {{trans('messages.name') }} <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="name" placeholder="Enter {{ trans('messages.display').' '.trans('messages.name') }}"
                                            value="{{ $product->getTranslation('name',$lang) }}" required onkeyup="title_update(this)">
                                    </div>
                                </div>

                                <div class="form-group row @if($lang != 'en') d-none @endif">
                                    <label class="col-md-3 col-form-label">{{ trans('messages.slug') }}<span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" placeholder="Enter {{ trans('messages.slug') }}" id="slug" name="slug" required class="form-control" value="{{$product->slug}}">
                                        @error('slug')
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="form-group row @if($lang != 'en') d-none @endif">
                                    <label class="col-md-3 col-from-label">{{ trans('messages.product').' '.trans('messages.id') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="product_id" id="product_id"  value="{{$product->unique_id}}" placeholder="Enter {{ trans('messages.product').' '.trans('messages.id') }}" required>
                                    </div>
                                </div>

                                <div class="form-group row @if ($lang != 'en') d-none @endif" id="category">
                                    <label class="col-lg-3 col-from-label">{{ trans('messages.category') }}<span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <select class="form-control aiz-selectpicker" name="category_id" id="category_id"
                                            data-selected="{{ $product->category_id }}" data-live-search="true" required>
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

                                <div class="form-group row @if($lang != 'en') d-none @endif">
                                    <label class="col-md-3 col-from-label">{{ trans('messages.frame_size') }} <span
                                        class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="frame_size" id="frame_size"
                                            placeholder="Enter {{ trans('messages.frame_size') }}"  value="{{$product->frame_size}}" required>
                                    </div>
                                </div>
    
                                <div class="form-group row @if($lang != 'en') d-none @endif">
                                    <label class="col-md-3 col-from-label">{{ trans('messages.poles') }} <span
                                        class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="poles" id="poles"  value="{{$product->poles}}" placeholder="Enter {{ trans('messages.poles') }}" required>
                                    </div>
                                </div>
    
                                <div class="form-group row @if($lang != 'en') d-none @endif">
                                    <label class="col-md-3 col-from-label">{{ trans('messages.power') }} <span
                                        class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="power" id="power"  value="{{$product->power}}" placeholder="Enter {{ trans('messages.power') }}" required>
                                    </div>
                                </div>
    
                                <div class="form-group row @if($lang != 'en') d-none @endif">
                                    <label class="col-md-3 col-from-label">{{ trans('messages.mounting') }} <span
                                        class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="mounting" id="mounting"  value="{{$product->mounting}}" placeholder="Enter {{ trans('messages.mounting') }}" required>
                                    </div>
                                </div>
    
                                <div class="form-group row @if($lang != 'en') d-none @endif">
                                    <label class="col-md-3 col-from-label">{{ trans('messages.voltage') }} <span
                                        class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="voltage" id="voltage"  value="{{$product->voltage}}" placeholder="Enter {{ trans('messages.voltage') }}" required>
                                    </div>
                                </div>
    
                                <div class="form-group row @if($lang != 'en') d-none @endif">
                                    <label class="col-md-3 col-from-label">{{ trans('messages.speed') }}</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="speed" id="speed"  value="{{$product->speed}}" placeholder="Enter {{ trans('messages.speed') }}">
                                    </div>
                                </div>
    
                                <div class="form-group row @if($lang != 'en') d-none @endif">
                                    <label class="col-md-3 col-from-label">{{ trans('messages.efficiency') }}</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="efficiency" id="efficiency" value="{{$product->efficiency}}" placeholder="Enter {{ trans('messages.efficiency') }}">
                                    </div>
                                </div>
    
                                <div class="form-group row @if($lang != 'en') d-none @endif">
                                    <label class="col-md-3 col-from-label">{{ trans('messages.hz') }}</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="hz" id="hz"  value="{{$product->hz}}" placeholder="Enter {{ trans('messages.hz') }}">
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">{{ trans('messages.market') }}</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="market" id="market"  value="{{$product->getTranslation('market', $lang)}}" placeholder="Enter {{ trans('messages.market') }}">
                                    </div>
                                </div>
                               

                            </div>
                        </div>
                    </div>
                    <div class="card  @if ($lang != 'en') d-none @endif">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ trans('messages.product').' '.trans('messages.image') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row @if ($lang != 'en') d-none @endif">
                                <label class="col-md-3 col-form-label" for="signinSrEmail">{{ trans('messages.image') }}
                                    <small>({{ trans('messages.1000*1000') }})</small></label>
                                <div class="col-md-8">
                                    <input type="file" name="image" class="form-control" accept="image/*">

                                    @if ($product->image)
                                        <div class="file-preview box sm">
                                            <div
                                                class="d-flex justify-content-between align-items-center mt-2 file-preview-item">
                                                <div
                                                    class="align-items-center align-self-stretch d-flex justify-content-center thumb">
                                                    <img src="{{ $product->imageLink($product->image) }}"
                                                        class="img-fit">
                                                </div>
                                                <div class="remove">
                                                    <button class="btn btn-sm btn-link remove-thumbnail" type="button">
                                                        <i class="la la-close"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                       
                    </div>

                    <div class="card repeater">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ trans('messages.product') . ' ' . trans('messages.downloads') }}</h5>
                        </div>
                        <div class="card-body">
                            <div data-repeater-list="downloads">
                                <!-- Existing Items for Editing -->
                                @if(isset($product->files) && $product->files->count() > 0)
                                    @foreach($product->files as $download)
                                    {{-- @php
                                         echo '<pre>';
                                        print_r($download);
                                        die;
                                    @endphp --}}
                                    
                                        <div data-repeater-item>
                                            <!-- Hidden Input to Track IDs -->
                                            <input type="hidden" name="downloads_id" value="{{ $download->id }}" required>
                                            
                                            <!-- Heading Field -->
                                            <div class="form-group row">
                                                <label class="col-md-3 col-from-label">{{ trans('messages.heading') }} </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="heading" value="{{ $download->heading }}" required>
                                                </div>
                                            </div>
                                            
                                            <!-- Uploaded File Link + Replace Option -->
                                            <div class="form-group row">
                                                <label class="col-md-3 col-from-label">Uploaded File</label>
                                                <div class="col-md-8">
                                                   
                                                    <input type="file" name="pdf_file" class="form-control mt-2" accept="application/pdf">
                                                    <div>
                                                        <a href="{{ asset($download->file) }}" target="_blank">
                                                            <img src="{{ asset('assets/images/pdf.png') }}" width="100px">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Delete Button -->
                                            <div class="form-group row">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-8 text-right">
                                                    <input data-repeater-delete type="button" class="btn btn-danger action-btn ml-1" 
                                                           value="{{ trans('messages.delete') }}" />
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                    
                                <!-- Template for New Items -->
                                <div data-repeater-item>
                                    <input type="hidden" name="downloads_id">
                                    
                                    <!-- Heading Field -->
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">{{ trans('messages.heading') }}</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="heading">
                                        </div>
                                    </div>
                                    
                                    <!-- File Upload Field -->
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">PDF File</label>
                                        <div class="col-md-8">
                                            <input type="file" name="pdf_file" class="form-control" accept="application/pdf" >
                                        </div>
                                    </div>
                                    
                                    <!-- Delete Button -->
                                    <div class="form-group row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-8 text-right">
                                            <input data-repeater-delete type="button" class="btn btn-danger action-btn ml-1" 
                                                   value="{{ trans('messages.delete') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                            <!-- Add Button -->
                            <input data-repeater-create type="button" class="btn btn-success action-btn" value="{{ trans('messages.add') }}" />
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
                                    <input type="text" class="form-control"
                                        value="{{ $product->getSeoTranslation('meta_title',$lang) }}" name="meta_title"
                                        placeholder="Meta Title">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ trans('messages.meta_description') }}</label>
                                <div class="col-lg-8">
                                    <textarea name="meta_description" rows="8" class="form-control">{{ $product->getSeoTranslation('meta_description',$lang) }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ trans('messages.meta_keywords') }}</label>
                                <div class="col-md-8">
                                    {{-- data-max-tags="1" --}}
                                    <input type="text" class="form-control aiz-tag-input" name="meta_keywords[]"
                                        placeholder="Type and hit enter to add a keyword"
                                        value="{{ $product->getSeoTranslation('meta_keywords',$lang) }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ trans('messages.og_title') }}</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="og_title" placeholder="{{ trans('messages.og_title') }}"
                                        value="{{ $product->getSeoTranslation('og_title',$lang) }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ trans('messages.og_description') }}</label>
                                <div class="col-lg-8">
                                    <textarea name="og_description" rows="8" class="form-control">{{ $product->getSeoTranslation('og_description',$lang)  }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ trans('messages.twitter_title') }}</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="twitter_title"
                                        placeholder="{{ trans('messages.twitter_title') }}"
                                        value="{{ $product->getSeoTranslation('twitter_title',$lang) }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ trans('messages.twitter_description') }}</label>
                                <div class="col-lg-8">
                                    <textarea name="twitter_description" rows="8" class="form-control">{{ $product->getSeoTranslation('twitter_description',$lang) }}</textarea>
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
                                <div class="btn-group" role="group" aria-label="Second group">
                                    <button type="submit" name="button" value="publish"
                                        class="btn btn-info action-btn">{{ trans('messages.update').' '.trans('messages.product') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ trans('messages.publish').' '.trans('messages.status') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-6 col-from-label">{{ trans('messages.status') }}</label>
                                        <div class="col-md-6">
                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                <input type="checkbox" name="published" value="1"
                                                    @if ($product->published == 1) checked @endif>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3 text-right">
                        <button type="submit" name="button" class="btn btn-info">{{ trans('messages.update').' '.trans('messages.product') }}</button>
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
       

        $('.remove-thumbnail').on('click', function() {
            thumbnail = $(this)
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '{{ route('products.delete_thumbnail') }}',
                data: {
                    id: '{{ $product->id }}'
                },
                success: function(data) {
                    $(thumbnail).closest('.file-preview-item').remove();
                }
            });

        });
    
    </script>

    <script>

        // let downloadsData = @json($product->files);

        AIZ.plugins.tagify();


        $(document).ready(function() {
            let $repeater = $('.repeater').repeater({
                defaultValues: {},
                show: function () {
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this item?')) {
                        $(this).slideUp(deleteElement);
                    }
                },
                ready: function (setIndexes) {
                    console.log("Repeater is ready.");
                }
            });

            // $repeater.setList(downloadsData);
        });

        function title_update(e) {
            title = e.value;
            title = title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '')
            $('#slug').val(title)
        }
    </script>

@endsection
