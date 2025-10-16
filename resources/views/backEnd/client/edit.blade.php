@extends('backEnd.layouts.master')

@section('content')
<div class="page-wrapper">
  <div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Client & Portfolio</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit Client & Portfolio</li>
          </ol>
        </nav>
      </div>
      <div class="ms-auto">
        <div class="btn-group">
          <a href="{{route('admin.client')}}" class="btn btn-primary ">Back</a>
        </div>
      </div>
    </div>
    <!--end breadcrumb-->
    <!-- Update client -->
    <div class="card">
      <div class="card-body">
        <h5 class="mb-4">Client & Portfolio Info</h5>

        <form method="POST" name="update_client" id="update_client">
          <input type="hidden" name="id" value="{{$client->id}}">
          <div class="row">
            <div class="col-md-4 mb-3">
							<label class="form-label">Name</label>
							<input type="text" class="form-control" name="company_name" value="{{$client->company_name??''}}" placeholder="ex.BDcalling.">
							<p class="error"></p>
						</div>
						<div class="col-md-4 mb-3">
							<label class="form-label">Contact Person Number</label>
							<input type="text" class="form-control" name="contact_person" value="{{$client->contact_person??''}}" placeholder="ex.017XXXXXXXX">
							<p class="error"></p>
						</div>
						<div class="col-md-4 mb-3">
							<label class="form-label">Email</label>
							<input type="text" class="form-control" name="email" value="{{$client->email??''}}" placeholder="ex. efatkhan@gmil.com">
							<p class="error"></p>
						</div>
						<div class="col-md-4 mb-3">
							<label class="form-label">Phone</label>
							<input type="text" class="form-control" name="phone" value="{{$client->phone??''}}" placeholder="ex.017XXXXXXXX">
							<p class="error"></p>
						</div>
						<div class="col-md-4 mb-3">
							<label class="form-label">Alt Phone</label>
							<input type="text" class="form-control" name="alt_phone" value="{{$client->alt_phone??''}}" placeholder="ex.017XXXXXXXX">
							<p class="error"></p>
						</div>
						<div class="col-md-4 mb-3">
							<label class="form-label">Website Link</label>
							<input type="text" class="form-control" name="website" value="{{$client->website??''}}" placeholder="https://hexagon.com/">
							<p class="error"></p>
						</div>
						<div class="col-md-4 mb-3">
							<label class="form-label">Fb Address</label>
							<input type="text" class="form-control" name="fb_address" value="{{$client->fb_address??''}}" placeholder="https://www.facebook.com/hexagon">
							<p class="error"></p>
						</div>
						<div class="col-md-4 mb-3">
							<label class="form-label">Linked In Address</label>
							<input type="text" class="form-control" name="ln_address" value="{{$client->ln_address??''}}" placeholder="https://www.linkedin.com/in/efat-khan/">
							<p class="error"></p>
						</div>
						<div class="col-md-4 mb-3">
							<label class="form-label">Whatsapp Address</label>
							<input type="text" class="form-control" name="wp_link" value="{{$client->wp_link??''}}" placeholder="https://wa.me/88017XXXXXXX">
							<p class="error"></p>
						</div>
						<div class="col-md-12 mb-3">
							<label class="form-label">Address</label>
							<textarea type="text" class="form-control" name="address" value="{{$client->address??''}}" placeholder="ex. House # 12, Road # 02, Block # C, Banani, Dhaka-1213" rows="3">{{$client->address??''}}
							</textarea>
							<p class="error"></p>
						</div>
						<div class="col-md-12 mb-3">
							<label class="form-label">Description</label>
							<textarea type="text" class="form-control" name="description" value="" placeholder="Company description" rows="3">{{$client->description??''}}
							</textarea>
							<p class="error"></p>
						</div>
						<div class="col-md-6 mb-3">
							<label for="input23" class="form-label">Image Upload</label>
							<input class="form-control" name="image" type="file" id="formFile">
						</div>
						
						<div class="col-md-6 mb-3">
							<label for="input33" class="form-label">Status</label>
							<div class="input-group">
								<select class="form-select" id="input33" name="status">
									<option value="active">Show</option>
									<option value="blocked">Hide</option>
								</select>
							</div>
						</div>
            <div class="col-md-6 mb-3">
              <img id="imagePreview"
              src="{{asset($client->image)}}"
              alt="Image Preview" class="img-thumbnail" 
              style="max-width: 200px; display: {{$client->image?'block':'none'}};">
            </div>
            <div class="col-md-12 mb-3">
              <div class="d-md-flex d-grid align-items-center gap-3">
                <button type="submit" class="btn btn-primary px-4"><i class=' bx bxs-check-circle me-0'></i> Update client</button>
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
<!-- client Info Update -->
<script>
  $('#update_client').submit(function(event) {
    event.preventDefault();
    var formData = new FormData(this); // Correct formData usage for file uploads
    $("button[type='submit']").prop("disabled", true);

    $.ajax({
      url: "{{route('admin.client.update')}}",
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
          $('#update_client')[0].reset();
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