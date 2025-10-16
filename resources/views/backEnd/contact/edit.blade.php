@extends('backEnd.layouts.master')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Contact Question</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item " aria-current="page"><a href="{{route('admin.contact.all')}}">All Member</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Contact Question</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('admin.contact.all')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Personal Information</h5>
                <form class="row g-3" method="POST" id="update_contact">
                    <input type="text" name="id" value="{{$contact->id}}" hidden>
                    
                    <div class="col-md-3">
                        <label for="input13" class="form-label required">Name</label>
                        <div class="position-relative input-icon">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{!empty($contact->name)?$contact->name:''}}" readonly>
                            <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
                            <p class="error"></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="input13" class="form-label ">Email</label>
                        <div class="position-relative input-icon">
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{!empty($contact->email)?$contact->email:''}}" readonly>
                            <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-email'></i></span>
                            <p class="error"></p>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="input15" class="form-label required">Phone</label>
                        <div class="position-relative input-icon">
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" value="{{!empty($contact->phone)?$contact->phone:''}}" readonly>
                            <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-microphone'></i></span>
                            <p class="error"></p>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <label for="read" class="form-label required">Read</label>
                        <select id="read" class="form-select" name="read">
                            <option {{$contact->read==1?'selected':''}} value="1">Yes</option>
                            <option {{$contact->read==0?'selected':''}} value="0">No</option>
                        </select>
                        <p class="error"></p>
                    </div>
                    <div class="col-md-2">
                        <label for="status" class="form-label required">Status</label>
                        <select id="status" class="form-select" name="status">
                            <option {{$contact->status==1?'selected':''}} value="1">Active</option>
                            <option {{$contact->status==0?'selected':''}} value="0">Block</option>
                        </select>
                        <p class="error"></p>
                    </div>
                    <div class="col-md-12">
                        <label for="input22" class="form-label required">Message</label>
                        <div class="position-relative input-icon">
                            <textarea name="message" id="message" class="form-control" rows="3" readonly>{{!empty($contact->message)?$contact->message:''}}</textarea></span>
                            <p class="error"></p>
                        </div>
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

<!--Info Update -->
<script>
    $('#update_contact').submit(function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        $("button[type='submit']").prop("disabled", true);

        $.ajax({
            url: "{{ route('admin.contact.update') }}",
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
                    $('#update_contact')[0].reset();
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