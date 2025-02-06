@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 mx-auto">

            <div class="aiz-titlebar text-left mt-2 mb-3">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h1 class="h3">{{ trans('messages.all').' '.trans('messages.manuals') }}</h1>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <a href="{{ route('manual.create') }}" class="btn btn-primary">
                            <span>{{ trans('messages.add_new').' '.trans('messages.manual') }}</span>
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
                                    <th class="text-right">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($manuals as $key => $cert)
                                    <tr>
                                        <td>{{ $key + 1 + ($manuals->currentPage() - 1) * $manuals->perPage() }}</td>
                                        <td class="text-left">
                                            {{ $cert->title }}
                                        </td>
                                        <td class="text-center">
                                            {{-- w-200px w-md-300px mw-100 --}}
                                            @if ($cert->image)
                                                <div class="col-auto">
                                                    <a href="{{ uploaded_asset($cert->image) }}" target="_blank"><img src="{{ uploaded_asset($cert->image) }}" alt="Image" class="" style="width:100px; height:100px"></a>
                                                </div>
                                            @endif
                                        </td>
                                        
                                        <td class="text-center">
                                            {{ $cert->sort_order }}
                                        </td>

                                        <td class="text-center">
                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                <input onchange="update_published(this)" value="{{ $cert->id }}"
                                                    type="checkbox" {{ $cert->status == 1 ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>

                                        <td class="text-center">
                                            <a href="{{ route('manual-sections.all',['id' => $cert->id]) }}" class="btn btn-cancel">Manage Sections</a>
                                        </td>

                                        <td class="text-right">
                                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                                href="{{ route('manual.edit', ['id' => $cert->id, 'lang' => 'en']) }}" title="Edit">
                                                <i class="las la-edit"></i>
                                            </a>
                                            <a href="#"
                                                class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                                data-href="{{ route('manual.delete', $cert->id) }}" title="Delete">
                                                <i class="las la-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="aiz-pagination">
                            {{ $manuals->links() }}
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

            $.post('{{ route('manual.update-status') }}', {
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
