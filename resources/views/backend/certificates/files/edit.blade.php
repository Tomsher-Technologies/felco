@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h1 class="mb-0 h6">Update Certificate File</h5>
    </div>
    <div class="">
        <form class="form form-horizontal mar-top" method="POST" action="{{ route('certificate-files.update', $file->id) }}" enctype="multipart/form-data">
            <div class="row gutters-5">
                <div class="col-lg-8 mx-auto">
                    <input name="_method" type="hidden" value="POST">
                    <input type="hidden" name="id" value="{{ $file->id }}">
                    <input type="hidden" name="lang" value="{{ $lang }}">
                    @csrf
                    <div class="card">
                        
                        <div class="card-body  p-0">
                            <ul class="nav nav-tabs nav-fill border-light">
                                @foreach (\App\Models\Language::all() as $key => $language)
                                    <li class="nav-item">
                                        <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3"
                                            href="{{ route('certificate-files.edit', ['id' => $file->id, 'lang' => $language->code]) }}">
                                            <img src="{{ static_asset('assets/img/flags/' . $language->code . '.png') }}"
                                                height="11" class="mr-1">
                                            <span>{{ $language->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class=" p-4">
                                <div class="form-group row ">
                                    <label class="col-md-3 col-form-label">Title</label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="Enter..." value="{{ old('title', $file->getTranslation('title', $lang)) }}"
                                            id="title" name="title" class="form-control" required>
                                        
                                        @error('title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row @if($lang != 'en') d-none @endif">
                                    <label class="col-md-3 col-from-label">PDF File</label>
                                    <div class="col-md-8">
                                        <input type="file" name="pdf_file" class="form-control mt-2" accept="application/pdf">
                                        @if ($file->file != NULL)
                                            <div>
                                                <a href="{{ asset($file->file) }}" target="_blank">
                                                    <img src="{{ asset('assets/images/pdf.png') }}" width="100px">
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row @if($lang != 'en') d-none @endif">
                                    <label class="col-md-3 col-form-label">Sort Order</label>
                                    <div class="col-md-9">
                                        <input type="number" placeholder="Sort Order"
                                            value="{{ old('sort_order', $file->sort_order) }}" id="sort_order"
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
                                            <option {{ old('status', $file->status) == '1' ? 'selected' : '' }}
                                                value="1">
                                                Enabled</option>
                                            <option {{ old('status', $file->status) == '0' ? 'selected' : '' }}
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
                                    <a href="{{ route('certificate-files.all',['certificate_id' => $section->certificate_id, 'section_id' => $section->id]) }}" class="btn btn-md btn-cancel">{{trans('messages.cancel')}}</a>
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
      
    </script>
@endsection
