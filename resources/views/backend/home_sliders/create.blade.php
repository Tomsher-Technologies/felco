@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">Create Slider</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('home-slider.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Name</label>
                            <div class="col-md-9">
                                <input type="text" placeholder="Name" value="{{ old('name') }}" id="name"
                                    name="name" class="form-control" required>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
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
                                    <input value="{{ old('banner') }}" type="hidden" name="banner" class="selected-files"
                                        required>
                                </div>
                                <div class="file-preview box sm">
                                </div>
                                @error('banner')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
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
                                    <input value="{{ old('mobile_banner') }}" type="hidden" name="mobile_banner"
                                        class="selected-files" required>
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
                                <input type="text" placeholder="Enter Title" value="{{ old('title') }}" id="title"
                                    name="title" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Subtitle</label>
                            <div class="col-md-9">
                                <input type="text" placeholder="Enter Subtitle" value="{{ old('sub_title') }}" id="sub_title"
                                    name="sub_title" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Button Text</label>
                            <div class="col-md-9">
                                <input type="text" placeholder="Enter Button Text" value="{{ old('btn_text') }}" id="btn_text"
                                    name="btn_text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Link</label>
                            <div class="col-md-9">
                                <input type="text" placeholder="Enter Link" value="{{ old('link') }}" id="link"
                                    name="link" class="form-control">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Sort Order</label>
                            <div class="col-md-9">
                                <input type="number" placeholder="Sort Order" value="{{ old('sort_order') }}" id="sort_order"
                                    name="sort_order" class="form-control" required>
                                @error('sort_order')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Status</label>
                            <div class="col-md-9">
                                <select class="form-control aiz-selectpicker" name="status" id="status" required>
                                    <option {{ old('status') == '1' ? 'selected' : '' }} value="1">Enabled</option>
                                    <option {{ old('status') == '0' ? 'selected' : '' }} value="0">Disabled</option>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
       
    </script>
@endsection
