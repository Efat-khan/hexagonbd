@extends('backEnd.layouts.master')

@section('content')
<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">Gallery</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">All Gallery</li>
					</ol>
				</nav>
			</div>
			<div class="ms-auto">
				<div class="btn-group">
					<button type="button" class="btn btn-primary" id="open_btn" value="0">Add Gallery</button>
				</div>
			</div>
		</div>
		<!--end breadcrumb-->
		<!-- ADD Gallery -->
		<div class="card" id="form_display" style="display: none;">
			<div class="card-body">
				<form method="post" id="add_gallery" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-12 mb-3">
							<label class="form-label required">Title</label>
							<input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
						</div>

						<div class="col-md-12 mb-3">
							<label for="formFile" class="form-label">Image Upload</label>
							<input class="form-control" name="image[]" type="file" id="formFile" multiple>
						</div>

						<!-- Image Preview Container -->
						<div class="col-md-12 mb-3">
							<div id="imagePreviewContainer" class="d-flex flex-wrap gap-2"></div>
						</div>

						<div class="col-md-12 mb-3">
							<div class="d-md-flex d-grid align-items-center gap-3">
								<button type="submit" class="btn btn-primary px-4"><i class='bx bxs-check-circle me-0'></i> Add Images</button>
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
								<th>Title</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($gallery as $key=>$data)
							<tr id="gallery_{{$data->id}}">
								<td>{{$key+1}}</td>
								<td>
									<a href="{{ route('admin.gallery.edit', $data->id) }}">
										{{ $data->title }}
									</a>
								</td>

								<td>
									<div class="d-flex order-actions">
										<!-- <a href="{{route('admin.gallery.edit',$data->id)}}" class=""><i class='bx bx-cog'></i></a> -->
										<button class="btn delete_gallery py-0" style="border:none;" value="{{$data->id}}"><i class='bx bx-trash text-danger'></i></button>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th>No</th>
								<th>Title</th>
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
	$('#open_btn').click(function() {
		// alert($(this).val());
		if ($(this).val() == 0) {
			document.getElementById('form_display').style.display = 'block';
			$(this).val(1);
			$(this).html('Close');
		} else {
			document.getElementById('form_display').style.display = 'none';
			$(this).val(0);
			$(this).html('Add Gallery');
		}
	});
</script>
<!-- Image Privew -->
<script type="text/javascript">

document.getElementById('formFile').addEventListener('change', function (event) {
    const files = Array.from(event.target.files); // Convert FileList to an Array
    const imagePreviewContainer = document.getElementById('imagePreviewContainer'); // Container for previews
    const formFileInput = document.getElementById('formFile'); // File input element

    const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp']; // Allowed file formats

    files.forEach((file, index) => {
        const fileExtension = file.name.split('.').pop().toLowerCase();

        // Ensure the file is an image
        if (allowedExtensions.includes(fileExtension)) {
            const reader = new FileReader();

            reader.onload = function (e) {
                // Create a wrapper for the image and remove button
                const previewWrapper = document.createElement('div');
                previewWrapper.className = 'position-relative';
                previewWrapper.style.width = '100px';
                previewWrapper.style.margin = '10px';

                // Create the image preview element
                const imgPreview = document.createElement('img');
                imgPreview.className = 'img-thumbnail';
                imgPreview.style.width = '100px';
                imgPreview.style.height = '100px';
                imgPreview.style.objectFit = 'cover';
                imgPreview.src = e.target.result;

                // Add a remove button
                const removeButton = document.createElement('button');
                removeButton.className = 'btn btn-danger btn-sm position-absolute top-0 end-0 rounded-circle';
                removeButton.style.margin = '5px';
								removeButton.style.width = '20px';
        				removeButton.style.height = '20px';
        				removeButton.style.lineHeight = '15px';
        				removeButton.style.textAlign = 'center';
        				removeButton.style.padding = '0';
                removeButton.innerHTML = '&times;'; // Cross icon

                // Handle the remove button click
                removeButton.addEventListener('click', function () {
                    previewWrapper.remove(); // Remove the preview
                    removeFile(index); // Remove the file from the input
                });

                previewWrapper.appendChild(imgPreview);
                previewWrapper.appendChild(removeButton);
                imagePreviewContainer.appendChild(previewWrapper);
            };

            reader.readAsDataURL(file); // Read the file as a data URL
        } else {
            alert(`File "${file.name}" is not an allowed image type.`);
        }
    });

    // Remove a file from the input
    function removeFile(fileIndex) {
        const fileList = Array.from(formFileInput.files); // Get the current file list
        fileList.splice(fileIndex, 1); // Remove the file at the index
        const dataTransfer = new DataTransfer(); // Create a new DataTransfer object

        // Re-add the remaining files to the DataTransfer object
        fileList.forEach((file) => dataTransfer.items.add(file));

        // Update the input's file list
        formFileInput.files = dataTransfer.files;
    }
});

</script>
<!-- Add Event form -->
<script>
	$('#add_gallery').submit(function(event) {
		event.preventDefault();

		var formData = new FormData(this);

		$("button[type='submit']").prop("disabled", true);

		$.ajax({
			url: "{{ route('admin.gallery.store') }}",
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
					$('#add_gallery')[0].reset();
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
	$('.delete_gallery').click(function(event) {

		event.preventDefault();

		var gallery_id = $(this).val();
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
					url: "{{route('admin.gallery.delete')}}",
					data: {
						'gallery_id': gallery_id
					},
					success: function(data) {
						if (data.status == true) {
							Swal.fire({
								title: "Deleted!",
								text: data.msg,
								icon: "success",
								timer: 2000
							});
							$('#gallery_' + gallery_id).hide(2000);
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