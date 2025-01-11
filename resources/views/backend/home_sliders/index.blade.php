@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 mx-auto">

            <div class="aiz-titlebar text-left mt-2 mb-3">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h1 class="h3">{{ trans('messages.all').' '.trans('messages.sliders') }}</h1>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <a href="{{ route('home-slider.create') }}" class="btn btn-primary">
                            <span>{{ trans('messages.add_new').' '.trans('messages.sliders') }}</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card">
                <form class="" id="sort_customers" action="" method="GET">

                    <div class="card-body">
                        <table class="table aiz-table mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">Sl No</th>
                                    <th class="text-left">Name</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-left">Title</th>
                                    <th class="text-left">Sub Title</th>
                                    <th class="text-left">Button Text</th>
                                    <th class="text-left">Link</th>
                                    <th class="text-center">Sort Order</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-right">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $key => $slider)
                                    <tr>
                                        <td>{{ $key + 1 + ($sliders->currentPage() - 1) * $sliders->perPage() }}</td>
                                        <td class="text-left">
                                            {{ $slider->name }}
                                        </td>
                                        <td class="text-center">
                                            {{-- w-200px w-md-300px mw-100 --}}
                                            <div class="row gutters-5 ">
                                                @if ($slider->image)
                                                    <div class="col-auto">
                                                        <img src="{{ uploaded_asset($slider->image) }}" alt="Image"
                                                            class="img-fit">
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-left">
                                            {{ $slider->getTranslation('title','en') }}
                                        </td>
                                        <td class="text-left">
                                            {{ $slider->getTranslation('sub_title','en') }}
                                        </td>
                                        <td class="text-left">
                                            {{ $slider->getTranslation('btn_text','en') }}
                                        </td>
                                        <td class="text-left">
                                            {{ $slider->link }}
                                        </td>
                                        
                                        <td class="text-center">
                                            {{ $slider->sort_order }}
                                        </td>

                                        <td class="text-center">
                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                <input onchange="update_published(this)" value="{{ $slider->id }}"
                                                    type="checkbox" {{ $slider->status == 1 ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td class="text-right">
                                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                                href="{{ route('home-slider.edit', ['id' => $slider->id, 'lang' => 'en']) }}" title="Edit">
                                                <i class="las la-edit"></i>
                                            </a>
                                            <a href="#"
                                                class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                                data-href="{{ route('home-slider.delete', $slider->id) }}" title="Delete">
                                                <i class="las la-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="aiz-pagination">
                            {{ $sliders->links() }}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
    <script>
        function update_published(el) {

            var status = 0

            if (el.checked) {
                status = 1;
            }

            $.post('{{ route('home-slider.update-status') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', 'Slider updated successfully');
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endsection
