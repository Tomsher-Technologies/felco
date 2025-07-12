@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6 d-flex">Create Manual Section File</h5>
                    <span>{{ $section->title }}</span>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('manual-files.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Title</label>
                            <div class="col-md-9">
                                <input type="text" placeholder="Enter..." value="{{ old('title') }}" id="title"
                                    name="title" class="form-control" required>

                                    <input type="hidden" name="manual_section_id"  id="manual_section_id" value="{{$section->id}}">
                                @error('title')
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
                            <a href="{{ route('manual-files.all',['manual_id' => $section->manual_id, 'section_id' => $section->id]) }}" class="btn btn-md btn-cancel">{{trans('messages.cancel')}}</a>
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
