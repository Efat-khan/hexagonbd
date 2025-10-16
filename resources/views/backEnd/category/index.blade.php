@extends('backEnd.layouts.master')

@section('content')
<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">{{!empty($page_name)?$page_name:'Page'}}</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">All {{!empty($page_name)?$page_name:'Page'}}</li>
					</ol>
				</nav>
			</div>
			<div class="ms-auto">
				<div class="btn-group">
				<button type="button" class="btn btn-primary" id="open_btn" value="0">Add {{!empty($page_name)?$page_name:'Page'}}</button>
				</div>
			</div>
		</div>
		<!--end breadcrumb-->
		<!-- ADD Category -->
		<div class="card" id="form_display" style="display: none;">
			<div class="card-body">

				<form method="post" id="add_Category">
					<div class="row">
						<div class="col-md-6 mb-3">
							<label class="form-label required">Name</label>
							<input type="text" class="form-control " name="name" value="{{old('name')}}">
							<p class="error"></p>
						</div>
						<div class="col-md-6 mb-3">
							<label for="input33" class="form-label">Status</label>
							<div class="input-group">
								<select class="form-select" id="input33" name="status">
									<option value="active">Show</option>
									<option value="block">Hide</option>
								</select>
							</div>
						</div>
						<div class="col-md-12 mb-3">
							<label for="input23" class="form-label">Description</label>
							<textarea class="form-control" name="description" id="input23" placeholder="Description..." rows="2"></textarea>
						</div>
		
						<div class="col-md-12 mb-3">
							<div class="d-md-flex d-grid align-items-center gap-3">
								<button type="submit" class="btn btn-primary px-4"><i class=' bx bxs-check-circle me-0'></i> Add Category</button>
							</div>
						</div>

					</div>
				</form>
			</div>
		</div>
		<!-- <h6 class="mb-0 text-uppercase">DataTable Import</h6> -->
		<hr />
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="example2" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>No</th>
								<th>Name</th>
								<th>Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($categories as $key=>$data)
							<tr id="Category_{{$data->id}}">
								<td>{{$key+1}}</td>
								<td><a href="{{route('admin.category.edit',$data->id)}}">{{$data->name}}</a></td>
								
								<td>
									@if($data->status == 'active')
									<div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
										<i class='bx bxs-circle align-middle me-1'></i>Show
									</div>
									@else
									<div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">
										<i class='bx bxs-circle align-middle me-1'></i>Hide
									</div>
									@endif
								</td>

								<td>
									<div class="d-flex order-actions">
										<a href="{{route('admin.category.edit',$data->id)}}"><i class='bx bx-edit'></i></a>
										<button class="btn delete_Category py-0" style="border:none;" value="{{$data->id}}"><i class='bx bx-trash text-danger'></i></button>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('custom-js-section')
<!-- Add event Btn -->
<script>
	$('#open_btn').click(function() {
		// alert($(this).val());
		if ($(this).val() == 0) {
			document.getElementById('form_display').style.display = 'block';
			$(this).val(1);
			$(this).html('Close');
		} else {
			document.getElementById('form_display').style.display = 'none';
			$(this).val(0);
			$(this).html('Add Category');
		}
	});
</script>
<!-- Add Category form -->
<script>
	$('#add_Category').submit(function(event) {
		event.preventDefault();

		var formData = new FormData(this);

		$("button[type='submit']").prop("disabled", true);

		$.ajax({
			url: "{{ route('admin.category.store') }}",
			type: "POST",
			data: formData,
			dataType: "json",
			processData: false,
			contentType: false,
			headers: {
				'X-CSRF-TOKEN': "{{ csrf_token() }}"
			},
			success: function(response) {
				$("button[type='submit']").prop("disabled", false);

				if (response.status === true) {
					$('#add_Category')[0].reset();
					$("input, select, textarea").removeClass('is-invalid');
					$(".error").removeClass('invalid-feedback').html('');
					window.location.reload();
				} else {
					displayErrors(response.errors);
				}
			},
			error: function(xhr) {
				$("button[type='submit']").prop("disabled", false);
				let response = xhr.responseJSON;
				displayErrors(response.errors || {
					general: "An unexpected error occurred."
				});
			}
		});
	});

	function displayErrors(errors) {
		$(".error").removeClass('invalid-feedback').html('');
		$("input, select, textarea").removeClass('is-invalid');
		$('#general-error').html(''); // Clear any general error message

		$.each(errors, function(field, messages) {
			// Check if field has multiple error messages
			if (Array.isArray(messages)) {
				$.each(messages, function(index, message) {
					$(`[name='${field}']`).addClass('is-invalid').siblings('.error')
						.addClass('invalid-feedback').html(message);
				});
			} else {
				// Handle single error message
				$(`[name='${field}']`).addClass('is-invalid').siblings('.error')
					.addClass('invalid-feedback').html(messages);
			}
		});
	}
</script>

<!-- Delete Event -->
<script>
	$('.delete_Category').click(function(event) {

		event.preventDefault();

		var Category_id = $(this).val();
		// alert(event_id);/
		Swal.fire({
			title: "Are you sure?",
			text: "You won't to delete this!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Yes, sure!"
		}).then((result) => {

			if (result.isConfirmed) {
				$.ajax({
					type: "POST",
					url: "{{route('admin.category.delete')}}",
					data: {
						'Category_id': Category_id
					},
					success: function(data) {
						if (data.status == true) {
							Swal.fire({
								title: "Deleted!",
								text: data.msg,
								icon: "success",
								timer: 2000
							});
							$('#Category_' + Category_id).hide(2000);
						} else {
							Swal.fire({
								title: "Error!",
								text: data.msg,
								icon: "error",
								timer: 2000
							});
						}
					}
				});
			}
		});
	});
</script>

@endsection