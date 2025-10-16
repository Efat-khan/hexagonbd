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
            <li class="breadcrumb-item active" aria-current="page">Edit Project</li>
          </ol>
        </nav>
      </div>
      <div class="ms-auto">
        <div class="btn-group">
          <a href="{{route('admin.project')}}" class="btn btn-primary">Back</a>
        </div>
      </div>
    </div>
    <!--end breadcrumb-->
    <!-- Update Project -->
    <div class="card">
      <div class="card-body">
        <h5 class="mb-4">Project Info</h5>
        <form method="POST" name="update_project" id="update_project">
          <input type="hidden" name="id" value="{{$project->id}}">
          <div class="row">
            <div class="col-md-12 mb-3">
              <label class="form-label required">Title</label>
              <input type="text" class="form-control " name="title" value="{{$project->title??old('title')}}">
              <p class="error"></p>
            </div>
            <div class="col-md-4 mb-3">
              <label for="input33" class="form-label required">Client</label>
              <div class="input-group">
                <select class="form-select" id="client_id" name="client_id">
                  <option value="">Select Client</option>
                  @foreach ($clients as $client)
                  <option value="{{$client->id}}" {{ $project->client_id == $client->id ? 'selected' : '' }}>{{$client->company_name}}</option>
                  @endforeach
                </select>
                <p class="error"></p>
              </div>
            </div>
            <div class="col-md-2 mb-2">
							<label for="start_date" class="form-label">Start Date</label>
							<div class="input-group">
								<input type="datetime-local"
									name="start_date"
									id="start_date"
									class="form-control"
									value="{{ $project->start_date??old('start_date') }}">
							</div>
						</div>
            <div class="col-md-2 mb-2">
							<label for="end_date" class="form-label">End Date</label>
							<div class="input-group">
								<input type="datetime-local"
									name="end_date"
									id="end_date"
									class="form-control"
									value="{{ $project->end_date??old('end_date') }}">
							</div>
						</div>
            <div class="col-md-2 mb-3">
              <label for="show_on_home" class="form-label">Show on Home Page</label>
              <div class="input-group">
                <select class="form-select" id="show_on_home" name="show_on_home">
                  <option value="1" {{ $project->show_on_home == 1 ? 'selected':'' }}>Yes</option>
                  <option value="0" {{ $project->show_on_home == 0 ? 'selected':'' }}>No</option>
                </select>
              </div>
            </div>
            <div class="col-md-2 mb-3">
              <label for="input33" class="form-label">Project Status</label>
              <div class="input-group">
                <select class="form-select" id="input33" name="status">
                  <option value="active" {{ $project->status == 'active' ? 'selected':'' }}>Active</option>
                  <option value="block" {{ $project->status == 'block' ? 'selected':'' }}>Block</option>
                </select>
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <label for="input23" class="form-label required">Sort Description</label>
              <textarea class="form-control" name="short_description" id="input23" placeholder="Sort Description..." rows="3" value="{{$project->short_description??''}}">{{$project->short_description??''}}</textarea>
              <p class="error"></p>
            </div>
            <div class="col-md-12 mb-3">
              <label for="input23" class="form-label">Description</label>
              <textarea class="form-control" name="description" id="input23" placeholder="Description..." rows="3" value="{{$project->description??''}}">{{$project->description??''}}</textarea>
            </div>
            <div class="col-md-10 mb-3">
              <label for="input23" class="form-label">Image Upload</label>
              <input class="form-control" name="image" type="file" id="formFile">
            </div>

            <div class="col-md-2 mb-3">
              <img id="imagePreview"
                src="{{ isset($project->image) ? asset($project->image) : '' }}"
                alt="Image Preview"
                class="img-thumbnail"
                style="max-width: 200px; display: {{ $project->image ? 'block' : 'none' }};">
            </div>
            <div class="col-md-12">
              <p class="card-text"><small class="text-muted">Last updated {{ $project->updated_at->diffForHumans() }}</small>
              </p>
            </div>
            <div class="col-md-12 mb-3">
              <div class="d-md-flex d-grid align-items-center gap-3">
                <button type="submit" class="btn btn-primary px-4"><i class=' bx bxs-check-circle me-0'></i>Update</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- ADD + UPDATE + DELETE Image-->
    <div class="card">
      <div class="card-body p-4">
        <h5 class="mb-4">Project Image</h5>
        <!-- ADD project FAQ -->
        <form method="POST" id="project_image_add">
          <div class="row">
            <input type="hidden" name="project_id" value="{{$project->id}}">
            <div class="col-md-8">
              <label for="input22" class="form-label required">Image</label>
              <div class="position-relative input-icon">
                 <input class="form-control" name="file" type="file" id="formFile_new">
                <p class="error"></p>
              </div>
            </div>
            <div class="col-md-2 mb-3">
              <label for="input33" class="form-label">Status:</label>
              <div class="input-group">
                <select class="form-select" id="input33" name="status">
                  <option value="active">Show</option>
                  <option value="blocked">Hide</option>
                </select>
              </div>
            </div>
            <div class="col-md-2" style="padding-top: 29px;">
              <div class="btn-group " role="group" aria-label="Basic example">
                <button type="submit" id="add_resource_btn" class="btn btn-success" title="Add Resource"><i class=' bx bxs-check-circle me-0'></i> Add Resource
                </button>
              </div>
            </div>
            <!-- Image Preview Element -->
						<div class="col-md-6 mb-3">
							<img id="imagePreview_new" alt="Image Preview" class="img-thumbnail" style="max-width: 200px; display:none">
						</div>
          </div>
        </form>
        @if ($project['ProjectImage'] != null)
        @foreach ($project['ProjectImage'] as $data )
        <!-- Update project resource -->
        <form action="{{route('admin.project.resource.update')}}" method="POST">
          @csrf
          <div class="row" id="project_resource_{{$data->id}}">
            <input type="hidden" name="id" value="{{$data->id}}">
            <input type="hidden" name="project_image_id" value="{{$data->project_id}}">
            <div class="col-md-8">
              <label for="input22" class="form-label">Image/File</label>
              <div class="position-relative input-icon">
                <input class="form-control" name="file" type="file" id="formFile">
              </div>
            </div>
            <div class="col-md-2 mb-3">
              <label for="input33" class="form-label">Status:</label>
              <div class="input-group">
                <select class="form-select" id="input33" name="status">
                  <option value="active"
                    {{ $data->status == 'active'?'selected':'' }}>Show</option>
                  <option value="blocked"
                    {{ $data->status == 'blocked'?'selected':'' }}>Hide</option>
                </select>
              </div>
            </div>
            <div class="col-md-2" style="padding-top: 29px;">
              <div class="btn-group " role="group" aria-label="Basic example">
                <button type="submit" class="btn btn-success" title="Edit Data"><i class=' bx bxs-check-circle me-0'></i>
                </button>
                <button value="{{ $data->id }}" class="btn btn-danger delete_project_resource" data-confirm-delete="true" title="Delete Data"><i class="bx bx-trash me-0"></i></button>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <img id="imagePreview_{{$data->id}}"
                src="{{ isset($data->file) ? asset($data->file) : '' }}"
                alt="Image Preview"
                class="img-thumbnail"
                style="max-width: 200px; display: {{ $data->file ? 'block' : 'none' }};">
            </div>
          </div>
        </form>
        @endforeach
        @endif
      </div>
    </div>
  </div>
</div>
@endsection

@section('custom-js-section')
<!-- Image Preview -->
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
<!-- Image Preview -->
<script type="text/javascript">
  document.getElementById('formFile_new').addEventListener('change', function(event) {
    // Check if a file is selected
    if (event.target.files && event.target.files[0]) {
      const reader = new FileReader();

      // Set up the callback for the `load` project
      reader.onload = function(e) {
        // Update the `src` attribute of the preview image
        document.getElementById('imagePreview_new').src = e.target.result;
        document.getElementById('imagePreview_new').style.display = 'block'; // Make the preview visible
      }

      // Read the selected image file as a data URL
      reader.readAsDataURL(event.target.files[0]);
    }
  });
</script>
<!-- project Info Update -->
<script>
  $('#update_project').submit(function(project) {
    project.preventDefault();
    var formData = new FormData(this); // Correct formData usage for file uploads
    $("button[type='submit']").prop("disabled", true);

    $.ajax({
      url: "{{route('admin.project.update')}}",
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
          $('#update_project')[0].reset();
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
<!-- ADD project Resource -->
<script>
  $('#project_image_add').submit(function(event) {
    // alert('ok');
    event.preventDefault();
    var formData = new FormData(this);
    $("#add_resource_btn").prop("disabled", true);
    $.ajax({
      url: "{{route('admin.project.resource.store')}}",
      type: "POST",
      data: formData,
      dataType: "json",
      processData: false, // Required for FormData
      contentType: false, // Required for FormData
      headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
      },
      success: function(response) {
        $("#add_resource_btn").prop("disabled", false);

        if (response.status === true) {
          $('#project_image_add')[0].reset();
          $("input, select, textarea").removeClass('is-invalid');
          $(".error").removeClass('invalid-feedback').html('');
          window.location.reload();
        } else {
          displayErrors(response.errors);
        }
      },
      error: function(xhr) {
        $("#add_resource_btn").prop("disabled", false);
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
<!-- Delete project Resource -->
<script>
  $('.delete_project_resource').click(function(project) {

    project.preventDefault();

    var project_resource_id = $(this).val();

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
          url: "{{route('admin.project.resource.delete')}}",
          data: {
            'project_resource_id': project_resource_id
          },
          success: function(data) {
            if (data.status == true) {
              Swal.fire({
                title: "Deleted!",
                text: data.msg,
                icon: "success",
                timer: 2000
              });
              $('#project_resource_' + project_resource_id).hide(2000);
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