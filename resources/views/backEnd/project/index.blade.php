@extends('backEnd.layouts.master')

@section('content')
<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">Project</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">All Project</li>
					</ol>
				</nav>
			</div>
			<div class="ms-auto">
				<div class="btn-group">
					<button type="button" class="btn btn-primary" id="add_Project_display_btn" value="0">Add Project</button>

				</div>
			</div>
		</div>
		<!--end breadcrumb-->
		<!-- ADD Project -->
		<div class="card" id="add_Project_display" style="display: none;">
			<div class="card-body">
				<form method="post" id="add_Project">
					<div class="row">
						<div class="col-md-12 mb-3">
							<label class="form-label required">Title</label>
							<input type="text" class="form-control " name="title" value="{{old('title')}}">
							<p class="error"></p>
						</div>
						<div class="col-md-4 mb-3">
							<label for="input33" class="form-label ">Client</label>
							<div class="input-group">
								<select class="form-select" id="client_id" name="client_id">
									<option value="">Select Client</option>
									@foreach ($clients as $client)
									<option value="{{$client->id}}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{$client->company_name}}</option>
									@endforeach
								</select>
								<p class="error"></p>
							</div>
						</div>
						<div class="col-md-2 mb-2">
							<label for="time" class="form-label">Start Date</label>
							<div class="input-group">
								<input type="datetime-local"
									name="start_date"
									id="time"
									class="form-control"
									value="{{ old('start_date') }}">
							</div>
						</div>
						<div class="col-md-2 mb-2">
							<label for="end_date" class="form-label">End Date</label>
							<div class="input-group">
								<input type="datetime-local"
									name="end_date"
									id="time"
									class="form-control"
									value="{{ old('end_date') }}">
							</div>
						</div>

						<div class="col-md-2 mb-2">
							<label for="show_on_home" class="form-label">Show on Home Page</label>
							<div class="input-group">
								<select class="form-select" id="show_on_home" name="show_on_home">
									<option value="1">Yes</option>
									<option value="0">No</option>
								</select>
							</div>
						</div>
						<div class="col-md-2 mb-2">
							<label for="input33" class="form-label">Project Status</label>
							<div class="input-group">
								<select class="form-select" id="input33" name="status">
									<option value="active">Active</option>
									<option value="block">Block</option>
								</select>
							</div>
						</div>
						<div class="col-md-12 mb-3">
							<label for="input23" class="form-label required">Sort Description</label>
							<textarea class="form-control" name="short_description" id="input23" placeholder="Sort Description..." rows="3"></textarea>
							<p class="error"></p>
						</div>
						<div class="col-md-12 mb-3">
							<label for="input23" class="form-label">Description</label>
							<textarea class="form-control" name="description" id="input23" placeholder="Description..." rows="3"></textarea>
						</div>

						<div class="col-md-12 mb-3">
							<label for="input23" class="form-label required">Image Upload</label>
							<input class="form-control" name="image" type="file" id="formFile">
						</div>
						<!-- Image Preview Element -->
						<div class="col-md-6 mb-3">
							<img id="imagePreview" alt="Image Preview" class="img-thumbnail" style="max-width: 200px; display:none">
						</div>
						<div class="col-md-12 mb-3">
							<div class="d-md-flex d-grid align-items-center gap-3">
								<button type="submit" class="btn btn-primary px-4"><i class=' bx bxs-check-circle me-0'></i> Add Project</button>
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
								<th>#</th>
								<th>Client</th>
								<th>Title</th>
								<th>Show on Home page</th>
								<th>Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($projects as $key=>$project)
							<tr id="project_{{$project->id}}">
								<td>{{$key+1}}</td>
								<td>{{$project['projectClient']->company_name??'N/A'}}</td>
								<td><a href="{{route('admin.project.edit',$project->id)}}">{{$project->title}}</a></td>
								<td>
									@if($project->show_on_home == 1)
									
									<div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
										<i class='bx bxs-circle align-middle me-1'></i>Yes
									</div>
									@else
									<div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">
										<i class='bx bxs-circle align-middle me-1'></i>No
									</div>
									@endif
								</td>
								<td>
									@if($project->status == 'active')
									<div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
										<i class='bx bxs-circle align-middle me-1'></i>Active
									</div>
									@else
									<div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">
										<i class='bx bxs-circle align-middle me-1'></i>Block
									</div>
									@endif
								</td>

								<td>
									<div class="d-flex order-actions">
										<a href="{{route('admin.project.edit',$project->id)}}" class=""><i class='bx bx-edit'></i></a>
										<button class="btn delete_project py-0" style="border:none;" value="{{$project->id}}"><i class='bx bx-trash text-danger'></i></button>
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
<!-- Add project Btn -->
<script>
	$('#add_Project_display_btn').click(function() {
		// alert($(this).val());
		if ($(this).val() == 0) {
			document.getElementById('add_Project_display').style.display = 'block';
			$(this).val(1);
			$(this).html('Close');
		} else {
			document.getElementById('add_Project_display').style.display = 'none';
			$(this).val(0);
			$(this).html('Add Project');
		}
	});
</script>
<!-- Image Privew -->
<script type="text/javascript">
	document.getElementById('formFile').addEventListener('change', function(event) {
		// Check if a file is selected
		if (event.target.files && event.target.files[0]) {
			const reader = new FileReader();

			// Set up the callback for the `load` project
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
<!-- Add project form -->
<script>
	$('#add_Project').submit(function(event) {
		event.preventDefault();

		var formData = new FormData(this);

		$("button[type='submit']").prop("disabled", true);

		$.ajax({
			url: "{{ route('admin.project.store') }}",
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
					$('#add_Project')[0].reset();
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

<!-- Delete project -->
<script>
	$('.delete_project').click(function(event) {

		event.preventDefault();

		var project_id = $(this).val();
		// alert(project_id);/
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
					url: "{{route('admin.project.delete')}}",
					data: {
						'project_id': project_id
					},
					success: function(data) {
						if (data.status == true) {
							Swal.fire({
								title: "Deleted!",
								text: data.msg,
								icon: "success",
								timer: 2000
							});
							$('#project_' + project_id).hide(2000);
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