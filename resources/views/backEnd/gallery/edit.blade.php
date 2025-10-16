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
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('admin.gallery')}}">All Gallery</a></li>
            <li class="breadcrumb-item " aria-current="page">Edit Gallery</li>
          </ol>
        </nav>
      </div>
      <div class="ms-auto">
        <div class="btn-group">
          <a href="{{route('admin.gallery')}}" class="btn btn-primary">Back</a>
        </div>
      </div>
    </div>
    <!--end breadcrumb-->
    <!-- UPDATE Gallery -->
    <div class="card">
      <div class="card-body">
        <form method="post" id="update_gallery" enctype="multipart/form-data">
          <input type="text" name="id" value="{{ $gallery->id }}" hidden>
          <div class="row">
            <div class="col-md-12 mb-3">
              <label class="form-label required">Gallery Title</label>
              <input type="text" class="form-control" name="title" id="title" value="{{ !empty($gallery->title) ? $gallery->title : '' }}">
              <p class="error"></p>
            </div>

            <div class="col-md-12 mb-3">
              <label for="formFile" class="form-label">Image Upload</label>
              <input class="form-control" name="image[]" type="file" id="formFile" multiple>
            </div>

            <!-- Image Preview Container -->
            <div class="col-md-12 mb-3">
              <div id="imagePreviewContainer" class="d-flex flex-wrap gap-2">
                @if (is_array(json_decode($gallery->image, true)))
                @foreach (json_decode($gallery->image, true) as $imagePath)
                <div class="position-relative" data-path="{{ $imagePath }}">
                  <img src="{{ asset($imagePath) }}" class="img-thumbnail" style="max-width: 100px; height: 100px; object-fit: cover;">
                  <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 rounded-circle remove-image" data-path="{{ $imagePath }}" style="width: 20px; height: 20px; padding: 0; text-align: center; line-height: 15px;">×</button>
                </div>
                @endforeach
                @else
                <div class="position-relative" data-path="{{ $gallery->image }}">
                  <img src="{{ asset($gallery->image) }}" class="img-thumbnail" style="max-width: 100px; height: 100px; object-fit: cover;">
                  <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 rounded-circle remove-image" data-path="{{ $gallery->image }}" style="width: 20px; height: 20px; padding: 0; text-align: center; line-height: 15px;">×</button>
                </div>
                @endif
              </div>
            </div>
          </div>
          <input type="hidden" name="removed_images" id="removedImages" value="">
          <div class="col-md-12 mb-3">
            <div class="d-md-flex d-grid align-items-center gap-3">
              <button type="submit" class="btn btn-primary px-4"><i class='bx bxs-check-circle me-0'></i> Update Notice</button>
            </div>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>
</div>
@endsection

@section('custom-js-section')
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const imagePreviewContainer = document.getElementById("imagePreviewContainer");
    const removedImagesInput = document.getElementById("removedImages");

    imagePreviewContainer.addEventListener("click", function (event) {
      if (event.target.classList.contains("remove-image")) {
        const button = event.target;
        const imageDiv = button.parentElement;
        const imagePath = button.getAttribute("data-path");

        // Remove the preview div
        imageDiv.remove();

        // Update the hidden input with removed image paths
        const removedImages = removedImagesInput.value ? JSON.parse(removedImagesInput.value) : [];
        removedImages.push(imagePath);
        removedImagesInput.value = JSON.stringify(removedImages);
      }
    });
  });
</script>
<!-- Image Preview -->
<script type="text/javascript">
  document.getElementById('formFile').addEventListener('change', function(event) {
    const files = Array.from(event.target.files);
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    files.forEach(file => {
      const fileExtension = file.name.split('.').pop().toLowerCase();
      if (!allowedExtensions.includes(fileExtension)) {
        alert(`${file.name} is not a supported image format.`);
        return;
      }

      // Create preview wrapper
      const previewWrapper = document.createElement('div');
      previewWrapper.className = 'position-relative';
      previewWrapper.style.width = '100px';
      previewWrapper.style.margin = '10px';

      const imgPreview = document.createElement('img');
      imgPreview.className = 'img-thumbnail';
      imgPreview.style.width = '100px';
      imgPreview.style.height = '100px';
      imgPreview.style.objectFit = 'cover';

      const reader = new FileReader();
      reader.onload = function(e) {
        imgPreview.src = e.target.result;
      };
      reader.readAsDataURL(file);

      // Create remove button
      const removeButton = document.createElement('button');
      removeButton.className = 'btn btn-danger btn-sm position-absolute top-0 end-0 rounded-circle';
      removeButton.style.width = '20px';
      removeButton.style.height = '20px';
      removeButton.style.lineHeight = '15px';
      removeButton.style.textAlign = 'center';
      removeButton.style.padding = '0';
      removeButton.textContent = '×';
      removeButton.onclick = function(e) {
        e.preventDefault();
        previewWrapper.remove();
      };

      previewWrapper.appendChild(imgPreview);
      previewWrapper.appendChild(removeButton);
      imagePreviewContainer.appendChild(previewWrapper);
    });
  });
</script>
<!-- Update -->
<script>
  $('#update_gallery').submit(function(event) {
    event.preventDefault();
    var formData = new FormData(this); // Correct formData usage for file uploads
    $("button[type='submit']").prop("disabled", true);

    $.ajax({
      url: "{{route('admin.gallery.update')}}",
      type: "POST", // Update method to match your route if needed
      data: formData,
      dataType: "json",
      processData: false, // Required for FormData
      contentType: false, // Required for FormData
      headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
      },
      success: function(response) {
        $("button[type='submit']").prop("disabled", false);

        if (response.status === true) {
          $('#update_gallery')[0].reset();
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

    $.each(errors, function(field, messages) {
      $(`[name='${field}']`).addClass('is-invalid').siblings('.error')
        .addClass('invalid-feedback').html(Array.isArray(messages) ? messages[0] : messages);
    });
  }
</script>

@endsection