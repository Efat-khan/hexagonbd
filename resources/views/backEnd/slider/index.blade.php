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
					<button type="button" class="btn btn-primary" id="add_slider_display_btn" value="0">Add {{!empty($page_name)?$page_name:'Page'}}</button>

				</div>
			</div>
		</div>
		<!--end breadcrumb-->
		<!-- ADD SLIDER -->
		<div class="card" id="add_slider_display" style="display: none;">
			<div class="card-body">

				<form method="post" id="add_slider">
					<div class="row">
						<div class="col-md-6 mb-3">
							<label class="form-label required">Slider Title</label>
							<input type="text" class="form-control " name="title" id="title" value="{{old('title')}}">
							<p class="error"></p>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label ">Slider link</label>
							<input type="text" class="form-control " name="link" id="link" value="{{old('link')}}">
							<p class="error"></p>
						</div>
						
						<div class="col-md-12 mb-3">
							<label for="input23" class="form-label ">Sort Description</label>
							<textarea class="form-control" name="sort_description" id="sort_description" placeholder="Description..." rows="2">{{old('sort_description')}}</textarea>
						</div>
		
						<div class="col-md-6 mb-3">
							<label for="input23" class="form-label required">Slider Image Upload</label>
							<input class="form-control" name="image" type="file" id="formFile">
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
						<!-- Image Preview Element -->
						<div class="col-md-6 mb-3">
							<img id="imagePreview" alt="Image Preview" class="img-thumbnail" style="max-width: 200px; display:none">
						</div>
						<div class="col-md-12 mb-3">
							<div class="d-md-flex d-grid align-items-center gap-3">
								<button type="submit" class="btn btn-primary px-4"><i class=' bx bxs-check-circle me-0'></i> Add Slider</button>
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
								<th width="20px">#</th>
								<th>Title</th>
								<th width="20px">Status</th>
								<th width="20px">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($slider as $key=>$data)
							<tr id="slider_{{$data->id}}">	
								<td>{{$key+1}}</td>
								<td><a href="{{route('admin.slider.edit',$data->id)}}">{{$data->title}}</a></td>
								
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
										<a href="{{route('admin.slider.edit',$data->id)}}" class=""><i class='bx bx-edit'></i></a>
										<button class="btn delete_slider py-0" style="border:none;" value="{{$data->id}}"><i class='bx bx-trash text-danger'></i></button>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th>No</th>
								<th>Title</th>
								<th>Status</th>
								<th>Actions</th>
							</tr>
						</tfoot>
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
	$('#add_slider_display_btn').click(function() {
		// alert($(this).val());
		if ($(this).val() == 0) {
			document.getElementById('add_slider_display').style.display = 'block';
			$(this).val(1);
			$(this).html('Close');
		} else {
			document.getElementById('add_slider_display').style.display = 'none';
			$(this).val(0);
			$(this).html('Add Event');
		}
	});
</script>
<!-- Image Privew -->
<script type="text/javascript">
	document.getElementById('formFile').addEventListener('change', function(event) {
		// Check if a file is selected
		if (event.target.files && event.target.files[0]) {
			const reader = new FileReader();

			// Set up the callback for the `load` event
			reader.onload = function(e) {
				// Update the `src` attribute of the preview image
				document.getElementById('imagePreview').src = e.target.result;
				document.getElementById('imagePreview').style.display = 'block'; // Make the preview visible
			}

			// Read the selected image file as a data URL
			reader.readAsDataURL(event.target.files[0]);
		}
	});
</script>
<!-- Add Event form -->
<script>
	$('#add_slider').submit(function(event) {
		event.preventDefault();

		var formData = new FormData(this);

		$("button[type='submit']").prop("disabled", true);

		$.ajax({
			url: "{{ route('admin.slider.store') }}",
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
					$('#add_slider')[0].reset();
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
	$('.delete_slider').click(function(event) {

		event.preventDefault();

		var slider_id = $(this).val();
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
					url: "{{route('admin.slider.delete')}}",
					data: {
						'slider_id': slider_id
					},
					success: function(data) {
						if (data.status == true) {
							Swal.fire({
								title: "Deleted!",
								text: data.msg,
								icon: "success",
								timer: 2000
							});
							$('#slider_' + slider_id).hide(2000);
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