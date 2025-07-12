@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 mx-auto">

            <div class="aiz-titlebar text-left mt-2 mb-3">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h1 class="h3">{{ trans('messages.all').' '.trans('messages.brochures') }}</h1>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <a href="{{ route('brochure.create') }}" class="btn btn-primary">
                            <span>{{ trans('messages.add_new').' '.trans('messages.brochure') }}</span>
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
                                    <th class="text-left">Title</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Sort Order</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Contents</th>
                                    <th class="text-center">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brochures as $key => $broch)
                                    <tr>
                                        <td>{{ $key + 1 + ($brochures->currentPage() - 1) * $brochures->perPage() }}</td>
                                        <td class="text-left">
                                            {{ $broch->title }}
                                        </td>
                                        <td class="text-center">
                                            {{-- w-200px w-md-300px mw-100 --}}
                                            @if ($broch->image)
                                                <div class="col-auto">
                                                    <a href="{{ uploaded_asset($broch->image) }}" target="_blank"><img src="{{ uploaded_asset($broch->image) }}" alt="Image" class="" style="width:100px; height:100px"></a>
                                                </div>
                                            @endif
                                        </td>
                                        
                                        <td class="text-center">
                                            {{ $broch->sort_order }}
                                        </td>

                                        <td class="text-center">
                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                <input onchange="update_published(this)" value="{{ $broch->id }}"
                                                    type="checkbox" {{ $broch->status == 1 ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>

                                        <td class="text-center">
                                            <a href="{{ route('brochure-files.all',['brochure_id' => $broch->id]) }}" class="btn btn-cancel">Manage Files</a>
                                        </td>

                                        <td class="text-center">
                                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                                href="{{ route('brochure.edit', ['id' => $broch->id, 'lang' => 'en']) }}" title="Edit">
                                                <i class="las la-edit"></i>
                                            </a>
                                            <a href="#"
                                                class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                                data-href="{{ route('brochure.delete', $broch->id) }}" title="Delete">
                                                <i class="las la-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="aiz-pagination">
                            {{ $brochures->links() }}
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

            $.post('{{ route('brochure.update-status') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', 'Status updated successfully');
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endsection
