@extends('backend.layouts.app')

@section('content')
<style>
    .bread .breadcrumb {
        all: unset;
    }

    .bread .breadcrumb li {
        display: inline-block;
    }

    .bread nav {
        display: inline-block;
        max-width: 250px;
    }

    .bread .breadcrumb-item+.breadcrumb-item::before {
        content: "->";
    }

    .breadcrumb-item+.breadcrumb-item {
        padding-left: 0;
    }

    .bread a {
        pointer-events: none;
        cursor: sw-resize;
    }
</style>
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="h3">All products</h1>
            </div>
            @if ($type != 'Seller')
                <div class="col text-right">
                    <a href="{{ route('products.create') }}" class="btn btn-circle btn-info">
                        <span>Add New Product</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
    <br>

    <div class="card">
        <form class="" id="sort_products" action="" method="GET">
            <div class="card-header row gutters-5">
                <div class="col">
                    <h5 class="mb-md-0 h6">All Product</h5>
                </div>

               
                <div class="col-md-2 ml-auto bootstrap-select">
                    
                    <select class="form-control form-control-sm aiz-selectpicker mb-md-0" data-live-search="true"
                            name="category" id="" data-selected={{ $category }}>
                        <option value="0">All</option>
                        @foreach (getAllCategories()->where('parent_id', 0) as $item)
                            <option value="{{ $item->id }}" @if( $category == $item->id)  {{ 'selected' }} @endif )>{{ $item->name }}</option>
                            @if ($item->child)
                                @foreach ($item->child as $cat)
                                    @include('backend.categories.menu_child_category', [
                                        'category' => $cat,
                                        'old_data' => $category,
                                    ])
                                @endforeach
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 ml-auto bootstrap-select">
                    
                    <select class="form-control form-control-sm aiz-selectpicker mb-md-0" name="status" id="status" >
                        <option value="" @if ($status_search == null ) {{ 'selected' }} @endif >All</option>
                        <option value="1" @if ($status_search == 1 ) {{ 'selected' }} @endif >Published</option>
                        <option value="0" @if ($status_search == 2 ) {{ 'selected' }} @endif >Unpublished</option>
                    </select>
                </div>
               
                <div class="col-md-2">
                    <div class="form-group mb-0">
                        <input type="text" class="form-control form-control-sm" id="search"
                            name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset
                            placeholder="Type & Enter">
                    </div>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-info " type="submit">Filter</button>
                    <a href="{{ route('products.all') }}" class="btn btn-warning">Reset</a>
                </div>
            </div>

            <div class="card-body">
                <table class="table aiz-table mb-0">
                    <thead>
                        <tr>
                            
                            <th>#</th>
                            
                            <th>{{ trans('messages.display') }} {{ trans('messages.name') }}</th>
                            <th>{{ trans('messages.product') }} {{ trans('messages.id') }}</th>
                            <th >{{ trans('messages.category') }}</th>
                            <th >{{ trans('messages.frame_size') }}</th>
                            <th >{{ trans('messages.poles') }}</th>
                            <th >{{ trans('messages.power') }}</th>
                            <th >{{ trans('messages.mounting') }}</th>
                            <th >{{ trans('messages.voltage') }}</th>
                            
                            <th class="text-center">{{ trans('messages.published') }}</th>
                            <th class="text-center">{{ trans('messages.options') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <tr>
                                <td>{{ $key + 1 + ($products->currentPage() - 1) * $products->perPage() }}</td>
                            
                                <td>
                                    <div class="row gutters-5 w-200px w-md-250px mw-100">

                                        @if ($product->image)
                                            <div class="col-auto">
                                                <img src="{{ asset($product->image) }}"
                                                    alt="Image" class="size-50px img-fit">
                                            </div>
                                        @endif


                                        <div class="col">
                                            <span class="text-muted text-truncate-2">{{ $product->name }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ $product->unique_id }}
                                </td>
                                <td class="bread">
                                    {{ Breadcrumbs::render('product_admin', $product) }}
                                </td>
                                <td>
                                    {{ $product->frame_size }}
                                </td>
                                <td>
                                    {{ $product->poles }}
                                </td>
                                <td>
                                    {{ $product->power }}
                                </td>
                                <td>
                                    {{ $product->mounting }}
                                </td>
                                <td>
                                    {{ $product->voltage }}
                                </td>
                                
                                <td class="text-center">
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input onchange="update_published(this)" value="{{ $product->id }}"
                                            type="checkbox" <?php if ($product->published == 1) {
                                                echo 'checked';
                                            } ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                
                                <td class="text-center">
                                    
                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                        href="{{ route('products.edit', ['id' => $product->id, 'lang' => env('DEFAULT_LANGUAGE')]) }}"
                                        title="Edit">
                                        <i class="las la-edit"></i>
                                    </a>
                                    
                                    {{-- <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                        data-href="{{ route('products.destroy', $product->id) }}" title="Delete">
                                        <i class="las la-trash"></i>
                                    </a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination">
                    {{ $products->appends(request()->input())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </form>
    </div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')
    <script type="text/javascript">
       
        $(document).ready(function() {
            //$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
        });

      
        function update_published(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('products.published') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', 'Published products updated successfully');
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong');
                }
            });
        }

    </script>
@endsection
