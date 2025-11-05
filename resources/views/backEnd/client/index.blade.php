@extends('backEnd.layouts.master')

@section('content')
<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">Client & Brand</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">All Client & Brand</li>
					</ol>
				</nav>
			</div>
			<div class="ms-auto">
				<div class="btn-group">
					<button type="button" class="btn btn-primary" id="add_client_display_btn" value="0">Add Client & Brand</button>
				</div>
			</div>
		</div>
		<!--end breadcrumb-->
		<!-- ADD client -->
		<div class="card" id="add_client_display" style="display: none;">
			<div class="card-body">
				<form method="post" id="add_client">
					<div class="row">
						<div class="col-md-4 mb-3">
							<label class="form-label required">Name</label>
							<input type="text" class="form-control" name="company_name" value="{{old('company_name')}}" placeholder="ex.BDcalling.">
							<p class="error"></p>
						</div>
						<div class="col-md-4 mb-3">
							<label class="form-label">Contact Person Number</label>
							<input type="text" class="form-control" name="contact_person" value="{{old('contact_person')}}" placeholder="ex.017XXXXXXXX">
							<p class="error"></p>
						</div>
						<div class="col-md-4 mb-3">
							<label class="form-label">Email</label>
							<input type="text" class="form-control" name="email" value="{{old('email')}}" placeholder="ex. efatkhan@gmil.com">
							<p class="error"></p>
						</div>
						<div class="col-md-4 mb-3">
							<label class="form-label">Phone</label>
							<input type="text" class="form-control" name="phone" value="{{old('phone')}}" placeholder="ex.017XXXXXXXX">
							<p class="error"></p>
						</div>
						<div class="col-md-4 mb-3">
							<label class="form-label">Alt Phone</label>
							<input type="text" class="form-control" name="alt_phone" value="{{old('alt_phone')}}" placeholder="ex.017XXXXXXXX">
							<p class="error"></p>
						</div>
						<div class="col-md-4 mb-3">
							<label class="form-label">Website Link</label>
							<input type="text" class="form-control" name="website" value="{{old('website')}}" placeholder="https://hexagon.com/">
							<p class="error"></p>
						</div>
						<div class="col-md-4 mb-3">
							<label class="form-label">Fb Address</label>
							<input type="text" class="form-control" name="fb_address" value="{{old('fb_address')}}" placeholder="https://www.facebook.com/hexagon">
							<p class="error"></p>
						</div>
						<div class="col-md-4 mb-3">
							<label class="form-label">Linked In Address</label>
							<input type="text" class="form-control" name="ln_address" value="{{old('ln_address')}}" placeholder="https://www.linkedin.com/in/efat-khan/">
							<p class="error"></p>
						</div>
						<div class="col-md-4 mb-3">
							<label class="form-label">Whatsapp Address</label>
							<input type="text" class="form-control" name="wp_link" value="{{old('wp_link')}}" placeholder="https://wa.me/88017XXXXXXX">
							<p class="error"></p>
						</div>
						<div class="col-md-12 mb-3">
							<label class="form-label">Address</label>
							<textarea type="text" class="form-control" name="address" value="{{old('address')}}" placeholder="ex. House # 12, Road # 02, Block # C, Banani, Dhaka-1213" rows="3">{{ old('address') }}
							</textarea>
							<p class="error"></p>
						</div>
						<div class="col-md-12 mb-3">
							<label class="form-label">Description</label>
							<textarea type="text" class="form-control" name="description" value="{{old('description	')}}" placeholder="Company description" rows="3">{{ old('description') }}
							</textarea>
							<p class="error"></p>
						</div>
						<div class="col-md-4 mb-3">
							<label for="input23" class="form-label">Image Upload</label>
							<input class="form-control" name="image" type="file" id="formFile">
						</div>

						<div class="col-md-4 mb-3">
							<label for="input33" class="form-label">Type</label>
							<div class="input-group">
								<select class="form-select" id="input33" name="type">
									<option value="client">Client</option>
									<option value="brand">Brand</option>
								</select>
							</div>
						</div>
						<div class="col-md-4 mb-3">
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
								<button type="submit" class="btn btn-primary px-4"><i class=' bx bxs-check-circle me-0'></i> Add </button>
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
								<th>Contact</th>
								<th>Type</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@if ($clients == null)
							<p class="text-center">No data added.</p>
							@else
							@foreach ($clients as $key=>$data)
							<tr id="client_{{$data->id}}">
								<td>{{$key+1}}</td>
								<td><a href="{{route('admin.client.edit',$data->id)}}">{{$data->company_name}}</a></td>
								<td>
									<p class="mb-0"><b>Phone:</b> {{$data->phone}}</p>
									<p class="mb-0"><b>Email:</b> {{$data->email}}</p>
									<p class="mb-0"><b>Website:</b> <a href="{{$data->website}}" target="_blank">{{$data->website}}</a></p>
									<p class="mb-0"><b>Fb:</b> <a href="{{$data->fb_address}}" target="_blank">{{$data->fb_address}}</a></p>
									<p class="mb-0"><b>Linked In:</b> <a href="{{$data->ln_address}}" target="_blank">{{$data->ln_address}}</a></p>
									<p class="mb-0"><b>Whatsapp:</b> <a href="{{$data->wp_link}}" target="_blank">{{$data->wp_link}}</a></p>
								</td>
								<td>{{$data->type == 'client'?'Client':'Brand'}}</td>
								<td>
									<div class="d-flex order-actions">
										<a href="{{route('admin.client.edit',$data->id)}}" class=""><i class='bx bx-cog'></i></a>
										<button class="btn py-0 delete_client" style="border:none;" value="{{$data->id}}"><i class='bx bx-trash text-danger'></i></button>
									</div>
								</td>
							</tr>
							@endforeach
							@endif
						</tbody>
						<tfoot>
							<tr>
								<th>No</th>
								<th>Name</th>
								<th>Contact</th>
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
<!-- Add client Btn -->
<script>
	$('#add_client_display_btn').click(function() {
		// alert($(this).val());
		if ($(this).val() == 0) {
			document.getElementById('add_client_display').style.display = 'block';
			$(this).val(1);
			$(this).html('Close');
		} else {
			document.getElementById('add_client_display').style.display = 'none';
			$(this).val(0);
			$(this).html('Add client');
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
<!-- Add client form -->
<script>
	$('#add_client').submit(function(event) {
		event.preventDefault();

		var formData = new FormData(this);

		$("button[type='submit']").prop("disabled", true);

		$.ajax({
			url: "{{ route('admin.client.store') }}",
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
					$('#add_client')[0].reset();
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
	$('.delete_client').click(function(event) {

		event.preventDefault();

		var client_id = $(this).val();
		// alert(client_id);/
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
					url: "{{route('admin.client.delete')}}",
					data: {
						'client_id': client_id
					},
					success: function(data) {
						if (data.status == true) {
							Swal.fire({
								title: "Deleted!",
								text: data.msg,
								icon: "success",
								timer: 2000
							});
							$('#client_' + client_id).hide(2000);
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