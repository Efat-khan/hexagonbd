@extends('backEnd.layouts.master')

@section('content')
<div class="page-wrapper">
  <div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Notice</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('admin.notification')}}">All Notice</a></li>
            <li class="breadcrumb-item " aria-current="page">Edit Notice</li>
          </ol>
        </nav>
      </div>
      <div class="ms-auto">
        <div class="btn-group">
          <a href="{{route('admin.notification')}}" class="btn btn-primary">Back</a>
        </div>
      </div>
    </div>
    <!--end breadcrumb-->
    <!-- UPDATE SERVICE -->
    <div class="card">
      <div class="card-body">
        <form method="post" id="update_notice">
          <input type="text" name="id" value="{{$notification->id}}" hidden>
          <div class="row">
            <div class="col-md-10 mb-3">
              <label class="form-label required">Notice Title</label>
              <input type="text" class="form-control " name="title" id="title" value="{{!empty($notification->title)?$notification->title:''}}">
              <p class="error"></p>
            </div>
            <div class="col-md-2 mb-3">
              <label for="input33" class="form-label">Status</label>
              <div class="input-group">
                <select class="form-select" id="status" name="status">
                  <option value="active" {{$notification->status == 'active'?'selected':''}}>Show</option>
                  <option value="block" {{$notification->status == 'block'?'selected':''}}>Hide</option>
                </select>
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <label for="input23" class="form-label ">Message</label>
              <textarea class="form-control" name="message" id="message" placeholder="Message..." rows="3">
              {{!empty($notification->message)?$notification->message:''}}
              </textarea>
              <p class="error"></p>
            </div>
            <div class="col-md-6 mb-3">
              <label for="input23" class="form-label ">Notice Image/file Upload</label>
              <input class="form-control" name="file" type="file" id="formFile">
              <p class="error"></p>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label ">Notice link</label>
              <input type="text" class="form-control " name="link" id="link" value="{{!empty($notification->link)?$notification->link:''}}">
              <p class="error"></p>
            </div>


            <!-- Image Preview Element -->
            @php
            $filePath = $notification->file ? asset($notification->file) : null;
            $fileExtension = $notification->file ? pathinfo($notification->file, PATHINFO_EXTENSION) : '';
            $allowedImageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            @endphp

            <img id="imagePreview"
              src="{{ $filePath && in_array(strtolower($fileExtension), $allowedImageExtensions) ? $filePath : asset('back-end-assets/notice/doc_docx.jpg') }}"
              alt="File Preview"
              class="img-thumbnail"
              style="max-width: 200px; display:{{ $filePath ? 'block' : 'none' }};">

          </div>
          <div class="col-md-12 mb-3">
            <div class="d-md-flex d-grid align-items-center gap-3">
              <button type="submit" class="btn btn-primary px-4"><i class=' bx bxs-check-circle me-0'></i> Update Notice</button>
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
<script type="text/javascript">
  document.getElementById('formFile').addEventListener('change', function(event) {
    const fileInput = event.target;
    const file = fileInput.files ? fileInput.files[0] : null; // Get the selected file
    const imagePreview = document.getElementById('imagePreview'); // Image preview element

    if (file) {
      // Allowed image extensions
      const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
      const fileExtension = file.name.split('.').pop().toLowerCase(); // Get file extension
      // Check if the file has a valid image extension
      if (allowedExtensions.includes(fileExtension)) {
        const reader = new FileReader();
        // Set up the callback for the `load` event
        reader.onload = function(e) {
          imagePreview.src = e.target.result; // Set preview to the image
          imagePreview.style.display = 'block'; // Make the preview visible
        };

        reader.readAsDataURL(file); // Read the selected image file as a data URL
      } else if (fileExtension == 'xlsx' || fileExtension == 'xls') {
        imagePreview.style.display = 'block';
        imagePreview.src = "{{asset('back-end-assets/notice/xls_xlsx.png')}}";
      } else if (fileExtension == 'docx' || fileExtension == 'doc') {
        imagePreview.style.display = 'block';
        imagePreview.src = "{{asset('back-end-assets/notice/doc_docx.jpg')}}";
      } else if (fileExtension == 'pdf') {
        imagePreview.style.display = 'block';
        imagePreview.src = "{{asset('back-end-assets/notice/pdf.png')}}";
      } else {
        // Hide the preview if no file is selected
        imagePreview.style.display = 'none';
        imagePreview.src = '';
      }
    } else {
      // Hide the preview if no file is selected
      imagePreview.style.display = 'none';
      imagePreview.src = '';
    }
  });
</script>
<!-- Update -->
<script>
  $('#update_notice').submit(function(event) {
    event.preventDefault();
    var formData = new FormData(this); // Correct formData usage for file uploads
    $("button[type='submit']").prop("disabled", true);

    $.ajax({
      url: "{{route('admin.notification.update')}}",
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
          $('#update_notice')[0].reset();
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