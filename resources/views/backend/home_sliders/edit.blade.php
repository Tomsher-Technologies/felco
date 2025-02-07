@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h1 class="mb-0 h6">Update Slider</h5>
    </div>
    <div class="">
        <form class="form form-horizontal mar-top" method="POST" action="{{ route('home-slider.update', $homeSlider->id) }}">
            <div class="row gutters-5">
                <div class="col-lg-8 mx-auto">
                    <input name="_method" type="hidden" value="POST">
                    <input type="hidden" name="id" value="{{ $homeSlider->id }}">
                    <input type="hidden" name="lang" value="{{ $lang }}">
                    @csrf
                    <div class="card">
                        
                        <div class="card-body  p-0">
                            <ul class="nav nav-tabs nav-fill border-light">
                                @foreach (\App\Models\Language::all() as $key => $language)
                                    <li class="nav-item">
                                        <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3"
                                            href="{{ route('home-slider.edit', ['id' => $homeSlider->id, 'lang' => $language->code]) }}">
                                            <img src="{{ static_asset('assets/img/flags/' . $language->code . '.png') }}"
                                                height="11" class="mr-1">
                                            <span>{{ $language->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class=" p-4">
                                <div class="form-group row  @if($lang != 'en') d-none @endif">
                                    <label class="col-md-3 col-form-label">Name</label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="Name" value="{{ old('name', $homeSlider->name) }}"
                                            id="name" name="name" class="form-control" required>
                                        <input type="hidden" name="lang" value="{{ $lang }}">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row @if($lang != 'en') d-none @endif">
                                    <label class="col-md-3 col-form-label" for="signinSrEmail">
                                        Banner
                                        {{-- <small>(1300x650)</small> --}}
                                    </label>
                                    <div class="col-md-9">
                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-soft-secondary font-weight-medium">
                                                    Browse
                                                </div>
                                            </div>
                                            <div class="form-control file-amount">Choose File</div>
                                            <input value="{{ old('banner', $homeSlider->image) }}" type="hidden" name="banner"
                                                class="selected-files" required>
                                        </div>
                                        <div class="file-preview box sm">
                                        </div>
                                        @error('banner')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row  @if($lang != 'en') d-none @endif">
                                    <label class="col-md-3 col-form-label" for="signinSrEmail">
                                        Mobile Banner
                                        {{-- <small>(1300x650)</small> --}}
                                    </label>
                                    <div class="col-md-9">
                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-soft-secondary font-weight-medium">
                                                    Browse
                                                </div>
                                            </div>
                                            <div class="form-control file-amount">Choose File</div>
                                            <input value="{{ old('mobile_banner', $homeSlider->mobile_image) }}" type="hidden"
                                                name="mobile_banner" class="selected-files" required>
                                        </div>
                                        <div class="file-preview box sm">
                                        </div>
                                        @error('mobile_banner')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Title</label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="Enter Title" value="{{ old('title', $homeSlider->getTranslation('title', $lang)) }}" id="title"
                                            name="title" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Subtitle</label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="Enter Subtitle" value="{{ old('sub_title', $homeSlider->getTranslation('sub_title', $lang)) }}" id="sub_title"
                                            name="sub_title" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Button Text</label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="Enter Button Text" value="{{ old('btn_text', $homeSlider->getTranslation('btn_text', $lang)) }}" id="btn_text"
                                            name="btn_text" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row @if($lang != 'en') d-none @endif">
                                    <label class="col-md-3 col-form-label">Link</label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="Enter Link" value="{{ old('link',$homeSlider->link) }}" id="link"
                                            name="link" class="form-control">
                                    </div>
                                </div>


                                <div class="form-group row @if($lang != 'en') d-none @endif">
                                    <label class="col-md-3 col-form-label">Sort Order</label>
                                    <div class="col-md-9">
                                        <input type="number" placeholder="Sort Order"
                                            value="{{ old('sort_order', $homeSlider->sort_order) }}" id="sort_order"
                                            name="sort_order" class="form-control" required>
                                        @error('sort_order')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row @if($lang != 'en') d-none @endif">
                                    <label class="col-md-3 col-form-label">Status</label>
                                    <div class="col-md-9">
                                        <select class="form-control aiz-selectpicker" name="status" id="status" required>
                                            <option {{ old('status', $homeSlider->status) == '1' ? 'selected' : '' }}
                                                value="1">
                                                Enabled</option>
                                            <option {{ old('status', $homeSlider->status) == '0' ? 'selected' : '' }}
                                                value="0">
                                                Disabled</option>
                                        </select>
                                        @error('status')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group mb-0 text-right">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            banner_form();
        });

        function banner_form() {
            var link_type = $('#link_type').val();
            var link_error = "{{ $errors->getBag('default')->first('link') }}"
            var link_id_error = "{{ $errors->getBag('default')->first('link_ref_id') }}"
            var old_data = "{{ $homeSlider->link ?? $homeSlider->link_ref_id }}"
            $.post('{{ route('banners.get_form') }}', {
                _token: '{{ csrf_token() }}',
                link_type: link_type,
                old_data: old_data,
            }, function(data) {
                $('#banner_form').html(data);
            });
        }
    </script>
@endsection
