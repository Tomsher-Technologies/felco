@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col">
			<h1 class="h3">Website Header</h1>
		</div>
	</div>
	@php
		$categories = getAllCategories()->where('parent_id', 0);
	@endphp
</div>
<div class="row">
	<div class="col-md-8 mx-auto">
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0">Header Setting</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
					
            
					<div class="form-group row ">
						<h6 class="col-md-12 col-from-label"> Product Category Menu Settings</h6>
					</div>
					<div class="form-group row ">
	                    <label class="col-md-3 col-from-label">Category Section Image</label>
						<div class="col-md-8">
		                    <div class=" input-group " data-toggle="aizuploader" data-type="image">
		                        <div class="input-group-prepend">
		                            <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
		                        </div>
		                        <div class="form-control file-amount">Choose File</div>
								<input type="hidden" name="types[]" value="header_category_logo">
		                        <input type="hidden" name="header_category_logo" class="selected-files" value="{{ get_setting('header_category_logo') }}">
		                    </div>
		                    <div class="file-preview"></div>
						</div>
	                </div>
					
					<div class="form-group ">
						<label>Categories (Max 6)</label>
						<div class="new_collection-categories-target">
							<input type="hidden" name="types[]" value="header_categories">
							<input type="hidden" name="page_type" value="new_collection">
							
							@if (get_setting('header_categories') != null && get_setting('header_categories') != 'null')
								@foreach (json_decode(get_setting('header_categories'), true) as $key => $value)
									<div class="row gutters-5">
										<div class="col">
											<div class="form-group">
												<select class="form-control aiz-selectpicker" name="header_categories[]" data-live-search="true" data-selected={{ $value }}
													required>
													<option value="">Select Category</option>
													
													@foreach ($categories as $item)
														<option value="{{ $item->id }}">{{ $item->name }}</option>
														@if ($item->child)
															@foreach ($item->child as $cat)
																@include('backend.categories.menu_child_category', [
																	'category' => $cat,
																	'selected_id' => 0,
																])
															@endforeach
														@endif
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-auto">
											<button type="button"
												class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger"
												data-toggle="remove-parent" data-parent=".row">
												<i class="las la-times"></i>
											</button>
										</div>
									</div>
								@endforeach
							@endif
						</div>
						<button type="button" class="btn btn-soft-secondary btn-sm" data-toggle="add-more"
							data-content='<div class="row gutters-5">
							<div class="col">
								<div class="form-group">
									<select class="form-control aiz-selectpicker" name="header_categories[]" data-live-search="true" required>
										<option value="">Select Category</option>
										
										@foreach ($categories as $item)
											<option value="{{ $item->id }}">{{ $item->name }}</option>
											@if ($item->child)
												@foreach ($item->child as $cat)
													@include("backend.categories.menu_child_category", [
														"category" => $cat,
														"selected_id" => 0,
													])
												@endforeach
											@endif
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-auto">
								<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
									<i class="las la-times"></i>
								</button>
							</div>
						</div>'
							data-target=".new_collection-categories-target">
							Add New
						</button>
					</div>


					
					<div class="text-right">
						<button type="submit" class="btn btn-primary">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
