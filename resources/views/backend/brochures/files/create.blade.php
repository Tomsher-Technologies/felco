@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6 d-flex">Create Brochure File</h5>
                    <span>{{ $brochure->title }}</span>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('brochure-files.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Title</label>
                            <div class="col-md-9">
                                <input type="text" placeholder="Enter..." value="{{ old('title') }}" id="title"
                                    name="title" class="form-control" required>

                                    <input type="hidden" name="brochure_id"  id="brochure_id" value="{{$brochure->id}}">
                                @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Content</label>
                            <div class="col-md-9">
                                <textarea placeholder="Enter..." id="content" name="content" rows="6" class="form-control" required>{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Button Text</label>
                            <div class="col-md-9">
                                <input type="text" placeholder="Enter..." value="{{ old('button_text') }}" id="button_text"
                                    name="button_text" class="form-control" required>
                                @error('button_text')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail">PDF File</label>
                            <div class="col-md-9">
                                <input type="file" name="pdf_file" class="form-control" accept="application/pdf" required>
                                @error('pdf_file')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Sort Order</label>
                            <div class="col-md-9">
                                <input type="number" placeholder="Sort Order" value="{{ old('sort_order', 0) }}" id="sort_order"
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
                            <a href="{{ route('brochure-files.all',['brochure_id' => $brochure->id]) }}" class="btn btn-md btn-cancel">{{trans('messages.cancel')}}</a>
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
