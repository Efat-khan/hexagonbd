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
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('admin.team')}}">All team</a></li>
            <li class="breadcrumb-item" aria-current="page">{{!empty($page_name)?$page_name:'Page'}}</li>
          </ol>
        </nav>
      </div>
      <div class="ms-auto">
        <div class="btn-group">
          <a href="{{route('admin.team')}}" class="btn btn-primary">Back</a>
        </div>
      </div>
    </div>
    <!--end breadcrumb-->
    <!-- UPDATE  -->
    <div class="card">
      <div class="card-body">
        <form method="post" id="update">
          <div class="row">
            <input type="text" class="form-control " name="id" id="id" value="{{!empty($team->id)?$team->id:''}}" hidden>
            <div class="col-md-4 mb-3">
              <label class="form-label required">Name</label>
              <input type="text" class="form-control " name="name" id="name" value="{{!empty($team->name)?$team->name:'N/A'}}">
              <p class="error"></p>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label required">Phone </label>
              <input type="text" class="form-control " name="phone" id="phone" value="{{$team->phone ?? 'N/A'}}">
              <p class="error"></p>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label ">Tel-phone </label>
              <input type="text" class="form-control " name="tel_phone" id="tel_phone" value="{{$team->tel_phone ?? 'N/A'}}">
              <p class="error"></p>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label ">Email </label>
              <input type="text" class="form-control " name="email" id="email" value="{{$team->email ?? 'N/A'}}">
              <p class="error"></p>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label ">Designation </label>
              <input type="text" class="form-control " name="designation" id="designation" value="{{!empty($team->designation)?$team->designation:'N/A'}}">
              <p class="error"></p>
            </div>
            <div class="col-md-4 mb-3">
							<label for="member_type" class="form-label">Management Or Team Member</label>
							<div class="input-group">
								<select class="form-select" id="input33" name="member_type">
									<option value="team" {{ $team->member_type =='team'?'selected':'' }}>Team Member</option>
									<option value="management" {{ $team->member_type =='management'?'selected':'' }}>Management</option>
								</select>
							</div>
						</div>
            <div class="col-md-12 mb-3">
              <label class="form-label required">Address </label>
              <input type="text" class="form-control " name="address" id="address" value="{{!empty($team->address)?$team->address:'N/A'}}">
              <p class="error"></p>
            </div>
            <div class="col-md-12 mb-3">
              <label class="form-label required">Qualification </label>
              <input type="text" class="form-control " name="qualification" id="qualification" value="{{!empty($team->qualification)?$team->designation:'N/A'}}">
              <p class="error"></p>
            </div>
            
            <div class="col-md-4 mb-3">
							<label class="form-label">Facebook Link </label>
							<input type="text" class="form-control " name="fb_link" id="fb_link" value="{{$team->fb_link??''}}">
							<p class="error"></p>
						</div>
						<div class="col-md-4 mb-3">
							<label class="form-label ">LinkedIna Link </label>
							<input type="text" class="form-control " name="ln_link" id="ln_link" value="{{$team->ln_link??''}}">
							<p class="error"></p>
						</div>
						<div class="col-md-4 mb-3">
							<label class="form-label">WhatsApp Number </label>
							<input type="text" class="form-control " name="wp_link" id="wp_link" value="{{$team->wp_link??''}}">
							<p class="error"></p>
						</div>
						<div class="col-md-4 mb-3">
							<label for="input23" class="form-label required">Image Upload</label>
							<input class="form-control" name="image" type="file" id="formFile">
						</div>
           
            <div class="col-md-4 mb-3">
              <label class="form-label ">Order </label>
              <input type="number" class="form-control " name="order" id="order" value="{{$team->order ?? 'N/A'}}">
              <p class="error"></p>
            </div>
            
            <div class="col-md-4 mb-3">
              <label for="input33" class="form-label">Status</label>
              <div class="input-group">
                <select class="form-select" id="input33" name="status">
                  <option {{ $team->status =='active'?'selected':'' }} value="active">Show</option>
                  <option {{ $team->status =='block'?'selected':'' }} value="block">Hide</option>
                </select>
              </div>
            </div>
            <!-- Image Preview Element -->
            <div class="col-md-6 mb-3">
              <img id="imagePreview"
                src="{{asset($team->image)}}"
                alt="Image Preview" class="img-thumbnail"
                style="max-width: 200px; display: {{$team->image?'block':'none'}};">
            </div>
            <div class="col-md-12 mb-3">
							<label class="form-label ">Description </label>
							<textarea class="form-control" name="description" id="description" rows="6">{!!$team->description??''!!}</textarea>
							<p class="error"></p>
						</div>
            <div class="col-md-12 mb-3">
              <div class="d-md-flex d-grid align-items-center gap-3">
                <button type="submit" class="btn btn-primary px-4"><i class=' bx bxs-check-circle me-0'></i> Update</button>
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
<!-- team Info Update -->
<script>
  $('#update').submit(function(event) {
    event.preventDefault();
    var formData = new FormData(this); // Correct formData usage for file uploads
    $("button[type='submit']").prop("disabled", true);

    $.ajax({
      url: "{{route('admin.team.update')}}",
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
          $('#update')[0].reset();
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