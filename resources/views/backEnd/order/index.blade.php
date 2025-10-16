@extends('backEnd.layouts.master')

@section('content')
<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">Order</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">All Orders</li>
					</ol>
				</nav>
			</div>
			<div class="ms-auto">
				<div class="btn-group">
					<button type="button" class="btn btn-primary" id="add_order_display_btn" value="0">Add Order</button>
				</div>
			</div>
		</div>
		<!--end breadcrumb-->
		<!-- ADD order -->
		<div class="card" id="add_order_display" style="display: none;">
			<div class="card-body">
				<h5 class="mb-4">Course Order</h5>
				<form class="row g-3" method="POST" id="add_order">
					<div class="col-md-4">
						<label for="input13" class="form-label required">Name</label>
						<div class="position-relative input-icon">
							<input type="text" name="full_name" class="form-control" id="full_name" placeholder="Full Name" value="{{old('full_name')}}">
							<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
							<p class="error"></p>
						</div>
					</div>
					<div class="col-md-4">
						<label for="input15" class="form-label required">Phone</label>
						<div class="position-relative input-icon">
							<input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" value="{{old('phone')}}">
							<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-microphone'></i></span>
							<p class="error"></p>
						</div>
					</div>
					<div class="col-md-4">
						<label for="input17" class="form-label">Email</label>
						<div class="position-relative input-icon">
							<input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{old('email')}}">
							<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-microphone'></i></span>
							<p class="error"></p>
						</div>
					</div>
					<div class="col-md-4">
						<label for="gender" class="form-label required">Gender</label>
						<select id="gender" class="form-select" name="gender">
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select>
						<p class="error"></p>
					</div>
					<div class="col-md-4">
						<label for="father_name" class="form-label">Fathers Name</label>
						<div class="position-relative input-icon">
							<input type="text" name="father_name" class="form-control" id="father_name" placeholder="Fathers Name" value="{{old('father_name')}}">
							<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
							<p class="error"></p>
						</div>
					</div>
					<div class="col-md-4">
						<label for="mother_name" class="form-label">Mother Name</label>
						<div class="position-relative input-icon">
							<input type="text" name="mother_name" class="form-control" id="mother_name" placeholder="Mother Name" value="{{old('mother_name')}}">
							<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
							<p class="error"></p>
						</div>
					</div>
					<div class="col-md-4">
						<label for="institute" class="form-label">Institute</label>
						<div class="position-relative input-icon">
							<input type="text" name="institute" class="form-control" id="institute" placeholder="Institute" value="{{old('institute')}}">
							<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-building'></i></span>
							<p class="error"></p>
						</div>
					</div>
					<div class="col-md-4">
						<label for="department" class="form-label">Department</label>
						<div class="position-relative input-icon">
							<select class="form-select" name="department" id="department">
								<option value="">Select Department</option>
								<option value="CSE">CSE</option>
								<option value="EEE">EEE</option>
								<option value="ME">ME</option>
								<option value="TE">TE</option>
								<option value="CIVIL">CIVIL</option>
								<option value="ARC">Architecture</option>
								<option value="IPE">IPE</option>
								<option value="FE">FE</option>
								<option value="CE">CE(Chemical Engineering)</option>
							</select>
							<p class="error"></p>
						</div>
					</div>
					<div class="col-md-4">
						<label for="semester" class="form-label ">Semester</label>
						<select class="form-select" name="semester" id="semester">
							<option value="">Select Semester</option>
							<option value="7th">7th</option>
							<option value="6th">6th</option>
							<option value="5th">5th</option>
							<option value="4th">4th</option>
							<option value="3rd">3rd</option>
							<option value="2nd">2nd</option>
							<option value="1st">1st</option>
						</select>
						<p class="error"></p>
					</div>
					<div class="col-md-12">
						<label for="input23" class="form-label">Address</label>
						<textarea class="form-control" name="address" id="address" placeholder="Address ..." rows="3">{{old('address')}}</textarea>
						<p class="error"></p>
					</div>
					<div class="col-md-10 mb-3">
						<label for="input23" class="form-label">Image Upload</label>
						<input class="form-control" name="image" type="file" id="formFile">
					</div>
					<!-- Image Preview Element -->
					<div class="col-md-2 mb-3">
						<img id="imagePreview" alt="Image Preview" class="img-thumbnail" style="max-width: 200px; display:none">
					</div>
					<hr>
					<!-- select Course -->
					<div class="col-md-10">
						<label for="input23" class="form-label">Select Course</label>
						<select class="form-select" name="course_id" id="course_id">
							<option value="">Select Course</option>
							@foreach ($courses as $course)
							<option value="{{$course->id}}">{{$course->name}}</option>
							@endforeach
						</select>
						<p class="error"></p>
					</div>
					<div class="col-md-2">
						<label for="status" class="form-label">Payment Status</label>
						<select class="form-select" name="status" id="status">
							<option value="">Select Status</option>
							<option value="pending">Pending</option>
							<option value="completed">Completed</option>
							<option value="cancelled">Cancelled</option>
						</select>
						<p class="error"></p>
					</div>
					<div class="col-md-6">
						<label for="institute" class="form-label">Paid Amount</label>
						<div class="position-relative input-icon">
							<input type="number" name="amount" class="form-control" id="amount" placeholder="Paid Amount" value="{{old('amount')}}">
							<p class="error"></p>
						</div>
					</div>
					<div class="col-md-6">
						<label for="payment_method" class="form-label">Payment Method</label>
						<select class="form-select" name="payment_method" id="payment_method">
							<option value="">Select Method</option>
							<option value="bKash">Bkash</option>
							<option value="Nagad">Nagad</option>
							<option value="Rocket">Rocket</option>
							<option value="Upay">Upay</option>
							<option value="Cash">Cash</option>
							<option value="Other">Other</option>
						</select>
						<p class="error"></p>
					</div>
					<div class="col-md-6">
						<label for="institute" class="form-label">Sender Number</label>
						<div class="position-relative input-icon">
							<input type="text" name="sender_number" class="form-control" id="sender_number" placeholder="Sender Number" value="{{old('sender_number')}}">
							<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-doller'></i></span>
							<p class="error"></p>
						</div>
					</div>
					<div class="col-md-6">
						<label for="institute" class="form-label">Transaction Id</label>
						<div class="position-relative input-icon">
							<input type="text" name="transaction_id" class="form-control" id="transaction_id " placeholder="Transaction Id" value="{{old('transaction_id ')}}">
							<span class="position-absolute top-50 translate-middle-y"><i class='bx bx-doller'></i></span>
							<p class="error"></p>
						</div>
					</div>
					<div class="col-md-12">
						<label for="notes" class="form-label">Notes</label>
						<textarea class="form-control" name="notes" id="notes" placeholder="Notes..." rows="3">{{old('notes')}}</textarea>
						<p class="error"></p>
					</div>
					<div class="col-md-12">
						<div class="d-md-flex d-grid align-items-center gap-3">
							<button type="submit" class="btn btn-primary px-4"><i class=' bx bxs-check-circle me-0'></i> Submit</button>
							<a href="{{route('admin.order')}}" class="btn btn-light px-4">Reset</a>
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
								<th>Name</th>
								<th>Phone</th>
								<th>Course Name</th>
								<th>Paid Amount</th>
								<th>Sender Number</th>
								<th>Paid Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($orders as $key=>$order)
							<tr id="order_{{$order->id}}">
								<td>{{$key+1}}</td>
								<td><a href="{{route('admin.order.edit',$order->id)}}">{{$order['student']->full_name}}</a></td>
								<td>{{$order['student']->phone}}</td>
								<td>{{$order['course']->name}}</td>
								<td>{{$order->amount}}</td>
								<td>{{$order->sender_number}}</td>
								<td>
									@if($order->status == 'pending')
									<div class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3">
										<i class='bx bxs-circle align-middle me-1'></i>Pending
									</div>
									@elseif($order->status == 'completed')
									<div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
										<i class='bx bxs-circle align-middle me-1'></i>Completed
									</div>
									@else
									<div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">
										<i class='bx bxs-circle align-middle me-1'></i>Cancelled
									</div>
									@endif
								</td>

								<td>
									<div class="d-flex order-actions">
										<a href="{{route('admin.order.edit',$order->id)}}" class=""><i class='bx bx-edit'></i></a>
										<button class="btn delete_order py-0" style="border:none;" value="{{$order->id}}"><i class='bx bx-trash text-danger'></i></button>
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
<!-- Add order Btn -->
<script>
	$('#add_order_display_btn').click(function() {
		// alert($(this).val());
		if ($(this).val() == 0) {
			document.getElementById('add_order_display').style.display = 'block';
			$(this).val(1);
			$(this).html('Close');
		} else {
			document.getElementById('add_order_display').style.display = 'none';
			$(this).val(0);
			$(this).html('Add order');
		}
	});
</script>
<!-- Image Privew -->
<script type="text/javascript">
	document.getElementById('formFile').addEventListener('change', function(event) {
		// Check if a file is selected
		if (event.target.files && event.target.files[0]) {
			const reader = new FileReader();

			// Set up the callback for the `load` order
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
<!-- Add order form -->
<script>
	$('#add_order').submit(function(event) {
		event.preventDefault();

		var formData = new FormData(this);

		$("button[type='submit']").prop("disabled", true);

		$.ajax({
			url: "{{ route('admin.order.store') }}",
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
					$('#add_order')[0].reset();
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

<!-- Delete order -->
<script>
	$('.delete_order').click(function(event) {

		event.preventDefault();

		var order_id = $(this).val();
		// alert(order_id);/
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
					url: "{{route('admin.order.delete')}}",
					data: {
						'order_id': order_id
					},
					success: function(data) {
						if (data.status == true) {
							Swal.fire({
								title: "Deleted!",
								text: data.msg,
								icon: "success",
								timer: 2000
							});
							$('#order_' + order_id).hide(2000);
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