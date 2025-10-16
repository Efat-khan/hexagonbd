@extends('backEnd.layouts.master')

@section('content')
<div class="page-wrapper">
  <div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Service</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('admin.service')}}"></a>All Service</li>
            <li class="breadcrumb-item" aria-current="page">Edit Service</li>
          </ol>
        </nav>
      </div>
      <div class="ms-auto">
        <div class="btn-group">
          <a href="{{route('admin.service')}}" class="btn btn-primary">Back</a>
        </div>
      </div>
    </div>
    <!--end breadcrumb-->
    <!-- UPDATE SERVICE -->
    <div class="card">
      <div class="card-body">
        <form method="post" id="update_service">
        <input type="text" hidden class="form-control " name="id" value="{{$service->id}}">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label required">Service Title</label>
              <input type="text" class="form-control " name="title" value="{{!empty($service->title)?$service->title:''}}">
              <p class="error"></p>
            </div>
            <div class="col-md-6 mb-3">
              <label for="input33" class="form-label">Status</label>
              <div class="input-group">
                <select class="form-select" id="input33" name="status">
                  <option value="active" {{$service->status == 'active '?'selected':''}}>Show</option>
                  <option value="block" {{$service->status == 'block'?'selected':''}}>Hide</option>
                </select>
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <label for="input23" class="form-label required">Description</label>
              <textarea class="form-control" name="description" id="input23" placeholder="Description..." rows="2">{{!empty($service->description)?$service->description:''}}</textarea>
            </div>

            <div class="col-md-6 mb-3">
              <label for="input23" class="form-label required">Service Image Upload</label>
              <input class="form-control" name="image" type="file" id="formFile">
            </div>
            <!-- Image Preview Element -->
            <div class="col-md-6 mb-3">
              <img id="imagePreview"
              src="{{asset($service->image)}}"
              alt="Image Preview" class="img-thumbnail" 
              style="max-width: 200px; display: {{$service->image?'block':'none'}};">
            </div>
            <div class="col-md-12 mb-3">
              <div class="d-md-flex d-grid align-items-center gap-3">
                <button type="submit" class="btn btn-primary px-4"><i class=' bx bxs-check-circle me-0'></i> Update Service</button>
              </div>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('custom-js-section')
<!-- Image Preview -->
<script>
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
<!-- Event Info Update -->
<script>
  $('#update_service').submit(function(event) {
    event.preventDefault();
    var formData = new FormData(this); // Correct formData usage for file uploads
    $("button[type='submit']").prop("disabled", true);

    $.ajax({
      url: "{{route('admin.service.update')}}",
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
          $('#update_service')[0].reset();
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