@extends('backEnd.layouts.master')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Student</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item " aria-current="page"><a href="{{route('admin.student.all')}}">All Student</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Student</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('admin.student.all')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Personal Information</h5>
                <form class="row g-3" method="POST" id="update_student">
                    <input type="text" name="id" value="{{$student->id}}" hidden>
                    <div class="col-md-4">
                        <label for="input13" class="form-label required">Name</label>
                        <div class="position-relative input-icon">
                            <input type="text" name="full_name" class="form-control" id="full_name" placeholder="Full Name" value="{{$student->full_name??old('full_name')}}">
                            <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
                            <p class="error"></p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="input15" class="form-label required">Phone</label>
                        <div class="position-relative input-icon">
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" value="{{$student->phone??old('phone')}}">
                            <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-microphone'></i></span>
                            <p class="error"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="input17" class="form-label">Email</label>
                        <div class="position-relative input-icon">
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{$student->email??old('email')}}">
                            <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-microphone'></i></span>
                            <p class="error"></p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="gender" class="form-label required">Gender</label>
                        <select id="gender" class="form-select" name="gender">
                            <option value="male" {{ $student->gender === 'male'?'selected' :''}}>Male</option>
                            <option value="female" {{ $student->gender === 'female' ?'selected':''}}>Female</option>
                        </select>
                        <p class="error"></p>
                    </div>

                    <div class="col-md-4">
                        <label for="father_name" class="form-label">Fathers Name</label>
                        <div class="position-relative input-icon">
                            <input type="text" name="father_name" class="form-control" id="father_name" placeholder="Fathers Name" value="{{$student->father_name??old('father_name')}}">
                            <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
                            <p class="error"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="mother_name" class="form-label">Mother Name</label>
                        <div class="position-relative input-icon">
                            <input type="text" name="mother_name" class="form-control" id="mother_name" placeholder="Mother Name" value="{{$student->mother_name??old('mother_name')}}">
                            <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
                            <p class="error"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="institute" class="form-label">Institute</label>
                        <div class="position-relative input-icon">
                            <input type="text" name="institute" class="form-control" id="institute" placeholder="Institute" value="{{$student->institute??old('institute')}}">
                            <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-building'></i></span>
                            <p class="error"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="department" class="form-label">Department</label>
                        <div class="position-relative input-icon">
                            <select class="form-select" name="department" id="department">
                                <option value="">Select Department</option>
                                <option value="CSE" {{ $student->department === 'CSE'?'selected':'' }}>CSE</option>
                                <option value="EEE" {{ $student->department === 'EEE'?'selected':'' }}>EEE</option>
                                <option value="ME" {{ $student->department === 'ME'?'selected':'' }}>ME</option>
                                <option value="TE" {{ $student->department === 'TE'?'selected':'' }}>TE</option>
                                <option value="CIVIL" {{ $student->department === 'CIVIL'?'selected':'' }}>CIVIL</option>
                                <option value="ARC" {{ $student->department === 'ARC'?'selected':'' }}>Architecture</option>
                                <option value="IPE" {{ $student->department === 'IPE'?'selected':'' }}>IPE</option>
                                <option value="FE" {{ $student->department === 'FE'?'selected':'' }}>FE</option>
                                <option value="CE" {{ $student->department === 'CE'?'selected':'' }}>CE(Chemical Engineering)</option>
                            </select>
                            <p class="error"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="semester" class="form-label ">Semester</label>
                        <select class="form-select" name="semester" id="semester">
                            <option value="">Select Semester</option>
                            <option value="7th" {{ $student->semester === '7th' ? 'selected':'' }}>7th</option>
                            <option value="6th" {{ $student->semester === '6th' ? 'selected':'' }}>6th</option>
                            <option value="5th" {{ $student->semester === '5th' ? 'selected':'' }}>5th</option>
                            <option value="4th" {{ $student->semester === '4th' ? 'selected':'' }}>4th</option>
                            <option value="3rd" {{ $student->semester === '3th' ? 'selected':'' }}>3rd</option>
                            <option value="2nd" {{ $student->semester === '2th' ? 'selected':'' }}>2nd</option>
                            <option value="1st" {{ $student->semester === '1th' ? 'selected':'' }}>1st</option>
                        </select>
                        <p class="error"></p>
                    </div>
                    <div class="col-md-12">
                        <label for="input23" class="form-label">Address</label>
                        <textarea class="form-control" name="address" id="address" placeholder="Address ..." rows="3">{{$student->address??old('address')}}</textarea>
                        <p class="error"></p>
                    </div>
                    <div class="col-md-10 mb-3">
                        <label for="input23" class="form-label">Image Upload</label>
                        <input class="form-control" name="image" type="file" id="formFile">
                        <p class="error"></p>
                    </div>
                    <!-- Image Preview Element -->

                    <div class="col-md-2 mb-3">
                        <img id="imagePreview" src="{{ asset($student->image) }}" alt="Image Preview" class="img-thumbnail" style="max-width: 200px; display: {{ $student->image ? 'block' : 'none' }};">
                    </div>
                    <div class="col-md-12">
                        <p class="card-text"><small class="text-muted">Last updated {{ $student->updated_at->diffForHumans() }}</small>
                        </p>
                    </div>
                    <hr>

                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4"><i class=' bx bxs-check-circle me-0'></i> Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-js-section')
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
<!-- student Info Update -->
<script>
    $('#update_student').submit(function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        $("button[type='submit']").prop("disabled", true);

        $.ajax({
            url: "{{ route('admin.student.update') }}",
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
                    $('#update_student')[0].reset();
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

@endsection