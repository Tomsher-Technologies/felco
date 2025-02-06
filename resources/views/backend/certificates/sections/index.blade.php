@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 mx-auto">

            <div class="aiz-titlebar text-left mt-2 mb-3">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h1 class="h3">{{ trans('messages.all').' '.trans('messages.certificates') }} Sections</h1>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <a href="{{ route('certificates.all') }}" class="btn btn-cancel">
                            <span>All Certificates</span>
                        </a>
                        <a href="{{ route('sections.create',['id'=>$certificate->id]) }}" class="btn btn-primary">
                            <span>{{ trans('messages.add_new') }} Section</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">{{ $certificate->title }}</h5>
                </div>

                <form class="" id="sort_customers" action="" method="GET">

                    <div class="card-body">
                        <table class="table aiz-table mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">Sl No</th>
                                    <th class="text-left">Title</th>
                                    <th class="text-center">Sort Order</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Contents</th>
                                    <th class="text-right">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sections as $key => $sec)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 + ($sections->currentPage() - 1) * $sections->perPage() }}</td>
                                        <td class="text-left">
                                            {{ $sec->title }}
                                        </td>
                                        
                                        <td class="text-center">
                                            {{ $sec->sort_order }}
                                        </td>

                                        <td class="text-center">
                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                <input onchange="update_published(this)" value="{{ $sec->id }}"
                                                    type="checkbox" {{ $sec->status == 1 ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>

                                        <td class="text-center">
                                            <a href="{{ route('certificate-files.all',['certificate_id' => $certificate->id, 'section_id' => $sec->id]) }}" class="btn btn-cancel">Manage Files</a>
                                        </td>

                                        <td class="text-right">
                                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                                href="{{ route('sections.edit', ['id' => $sec->id, 'lang' => 'en']) }}" title="Edit">
                                                <i class="las la-edit"></i>
                                            </a>
                                            <a href="#"
                                                class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                                data-href="{{ route('sections.delete', $sec->id) }}" title="Delete">
                                                <i class="las la-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="aiz-pagination">
                            {{ $sections->links() }}
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

            $.post('{{ route('sections.update-status') }}', {
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
