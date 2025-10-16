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
            <li class="breadcrumb-item active" aria-current="page">Edit Order</li>
          </ol>
        </nav>
      </div>
      <div class="ms-auto">
        <div class="btn-group">
          <a href="{{route('admin.order')}}" class="btn btn-primary">Back</a>
        </div>
      </div>
    </div>
    <!--end breadcrumb-->
    <!-- Update order -->
    <div class="card">
      <div class="card-body">
        <h5 class="mb-4">Order Info</h5>
        <form method="POST" name="update_order" id="update_order">
          <input type="hidden" name="id" value="{{$order->id}}">
          <div class="row">
            <div class="col-md-4">
              <label for="input13" class="form-label required">Name</label>
              <div class="position-relative input-icon">
                <input type="text" name="full_name" class="form-control" id="full_name" placeholder="Full Name" value="{{$order['student']->full_name??old('full_name')}}">
                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
                <p class="error"></p>
              </div>
            </div>
            <div class="col-md-4">
              <label for="input15" class="form-label required">Phone</label>
              <div class="position-relative input-icon">
                <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" value="{{$order['student']->phone??old('phone')}}">
                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-microphone'></i></span>
                <p class="error"></p>
              </div>
            </div>
            <div class="col-md-4">
              <label for="input17" class="form-label">Email</label>
              <div class="position-relative input-icon">
                <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{$order['student']->email??old('email')}}">
                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-microphone'></i></span>
                <p class="error"></p>
              </div>
            </div>
            <div class="col-md-4">
              <label for="gender" class="form-label required">Gender</label>
              <select id="gender" class="form-select" name="gender">
                <option value="male" {{ $order['student']->gender === 'male'?'selected': '' }}>Male</option>
                <option value="female" {{ $order['student']->gender === 'female'?'selected': '' }}>Female</option>
              </select>
              <p class="error"></p>
            </div>
            <div class="col-md-4">
              <label for="father_name" class="form-label">Fathers Name</label>
              <div class="position-relative input-icon">
                <input type="text" name="father_name" class="form-control" id="father_name" placeholder="Fathers Name" value="{{$order['student']->father_name??old('father_name')}}">
                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
                <p class="error"></p>
              </div>
            </div>
            <div class="col-md-4">
              <label for="mother_name" class="form-label">Mother Name</label>
              <div class="position-relative input-icon">
                <input type="text" name="mother_name" class="form-control" id="mother_name" placeholder="Mother Name" value="{{$order['student']->mother_name??old('mother_name')}}">
                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
                <p class="error"></p>
              </div>
            </div>
            <div class="col-md-4">
              <label for="institute" class="form-label">Institute</label>
              <div class="position-relative input-icon">
                <input type="text" name="institute" class="form-control" id="institute" placeholder="Institute" value="{{$order['student']->institute??old('institute')}}">
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
                  <option value="EEE" {{ $order['student']->department ==='EEE' }}>EEE</option>
                  <option value="ME" {{ $order['student']->department ==='ME' }}>ME</option>
                  <option value="TE" {{ $order['student']->department ==='TE' }}>TE</option>
                  <option value="CIVIL" {{ $order['student']->department ==='CIVIL' }}>CIVIL</option>
                  <option value="ARC" {{ $order['student']->department ==='' }}>Architecture</option>
                  <option value="IPE" {{ $order['student']->department ==='' }}>IPE</option>
                  <option value="FE" {{ $order['student']->department ==='' }}>FE</option>
                  <option value="CE" {{ $order['student']->department ==='' }}>CE(Chemical Engineering)</option>
                </select>
                <p class="error"></p>
              </div>
            </div>
            <div class="col-md-4">
              <label for="semester" class="form-label ">Semester</label>
              <select class="form-select" name="semester" id="semester">
                <option value="">Select Semester</option>
                <option value="7th" {{ $order['student']->semester === '7th'? 'selected':'' }}>7th</option>
                <option value="6th" {{ $order['student']->semester === '6th'? 'selected':'' }}>6th</option>
                <option value="5th" {{ $order['student']->semester === '5th'? 'selected':'' }}>5th</option>
                <option value="4th" {{ $order['student']->semester === '4th'? 'selected':'' }}>4th</option>
                <option value="3rd" {{ $order['student']->semester === '3th'? 'selected':'' }}>3rd</option>
                <option value="2nd" {{ $order['student']->semester === '2th'? 'selected':'' }}>2nd</option>
                <option value="1st" {{ $order['student']->semester === '1th'? 'selected':'' }}>1st</option>
              </select>
              <p class="error"></p>
            </div>
            <div class="col-md-12">
              <label for="input23" class="form-label">Address</label>
              <textarea class="form-control" name="address" id="address" placeholder="Address ..." rows="3">{{$order['student']->address ?? old('address')}}</textarea>
              <p class="error"></p>
            </div>
            <div class="col-md-10 mb-3">
              <label for="input23" class="form-label">Image Upload</label>
              <input class="form-control" name="image" type="file" id="formFile">
              <p class="error"></p>
            </div>
            <!-- Image Preview Element -->

            <div class="col-md-2 mb-3">
              <img id="imagePreview" src="{{ asset($order['student']->image) }}" alt="Image Preview" class="img-thumbnail" style="max-width: 200px; display: {{ $order['student']->image ? 'block' : 'none' }};">
            </div>
            <hr>
            <!-- select Course -->
            <div class="col-md-10">
              <label for="input23" class="form-label">Select Course</label>
              <select class="form-select" name="course_id" id="course_id">
                <option value="">Select Course</option>
                @foreach ($courses as $course)
                <option value="{{$course->id}}" {{ $course->id === $order->course_id ? 'selected': '' }}>{{$course->name}}</option>
                @endforeach
              </select>
              <p class="error"></p>
            </div>
            <div class="col-md-2">
              <label for="status" class="form-label">Payment Status</label>
              <select class="form-select" name="status" id="status">
                <option value="">Select Status</option>
                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
              </select>
              <p class="error"></p>
            </div>
            <div class="col-md-6">
              <label for="institute" class="form-label">Paid Amount</label>
              <div class="position-relative input-icon">
                <input type="number" name="amount" class="form-control" id="amount" placeholder="Paid Amount" value="{{$order->amount??old('amount')}}">
                <p class="error"></p>
              </div>
            </div>
            <div class="col-md-6">
              <label for="payment_method" class="form-label">Payment Method</label>
              <select class="form-select" name="payment_method" id="payment_method">
                <option value="">Select Method</option>
                <option value="bKash" {{ $order->payment_method === 'bKash' ? 'selected':'' }}>Bkash</option>
                <option value="Nagad" {{ $order->payment_method === 'Nagad' ? 'selected':'' }}>Nagad</option>
                <option value="Rocket" {{ $order->payment_method === 'Rocket' ? 'selected':'' }}>Rocket</option>
                <option value="Upay" {{ $order->payment_method === 'Upay' ? 'selected':'' }}>Upay</option>
                <option value="Cash" {{ $order->payment_method === 'Cash' ? 'selected':'' }}>Cash</option>
                <option value="Other" {{ $order->payment_method === 'Other' ? 'selected':'' }}>Other</option>
              </select>
              <p class="error"></p>
            </div>
            <div class="col-md-6">
              <label for="institute" class="form-label">Sender Number</label>
              <div class="position-relative input-icon">
                <input type="text" name="sender_number" class="form-control" id="sender_number" placeholder="Sender Number" value="{{$order->sender_number??old('sender_number')}}">
                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-doller'></i></span>
                <p class="error"></p>
              </div>
            </div>
            <div class="col-md-6">
              <label for="institute" class="form-label">Transaction Id</label>
              <div class="position-relative input-icon">
                <input type="text" name="transaction_id" class="form-control" id="transaction_id " placeholder="Transaction Id" value="{{$order->transaction_id??old('transaction_id ')}}">
                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-doller'></i></span>
                <p class="error"></p>
              </div>
            </div>
            <div class="col-md-12">
              <label for="notes" class="form-label">Notes</label>
              <textarea class="form-control" name="notes" id="notes" placeholder="Notes..." rows="3">{{$order->note??old('notes')}}</textarea>
              <p class="error"></p>
            </div>
            <div class="col-md-12">
              <div class="col-md-6 mb-3">
                <img id="imagePreview"
                  src="{{ isset($order->image) ? asset($order->image) : '' }}"
                  alt="Image Preview"
                  class="img-thumbnail"
                  style="max-width: 200px; display: {{ $order->image ? 'block' : 'none' }};">
              </div>
              <div class="col-md-12">
                <p class="card-text"><small class="text-muted">Last updated {{ $order->updated_at->diffForHumans() }}</small>
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
<!-- order Info Update -->
<script>
  $('#update_order').submit(function(order) {
    order.preventDefault();
    var formData = new FormData(this); // Correct formData usage for file uploads
    $("button[type='submit']").prop("disabled", true);

    $.ajax({
      url: "{{route('admin.order.update')}}",
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
          $('#update_order')[0].reset();
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