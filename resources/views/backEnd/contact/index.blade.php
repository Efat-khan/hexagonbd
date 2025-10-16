@extends('backEnd.layouts.master')
@section('content')

<!--start page wrapper -->
<div class="page-wrapper">
  <div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Contact Question</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">All Contact Question</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <!--end breadcrumb-->
  <div class="card m-4">
    <div class="card-body ">
      <div class="table-responsive">
        <table id="example2" class="table table-striped table-bordered">
          @if (!empty($contact))
          <thead>
            <tr>
              <th>Name</th>
              <th>Contact</th>
              <th>Email</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($contact as $key=>$data)

            <tr id="contact_{{$data->id}}">
              <td>{{$data->name}}</td>
              <td>{{$data->phone}}</td>
              <td>{{$data->email}}</td>
              <td>{{$data->read == 0?'Not Read':'Read'}}</td>
              <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                  <!-- <a type="button" class="btn btn-success" title="View Data"><i class='bx bx-search-alt me-0'></i>
											</a> -->
                  <a type="button" href="{{route('admin.contact.edit',$data->id)}}" class="btn btn-info" title="Edit Data"><i class='bx bx-pencil me-0'></i>
                  </a>
                  <button value="{{ $data->id }}" class="btn btn-danger delete_contact" data-confirm-delete="true" title="Delete Member"><i class="bx bx-trash me-0"></i></button>

                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>Name</th>
              <th>Contact</th>
              <th>Email</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </tfoot>
          @else
          <h1 class="h2"> No Data Available.</h1>
          @endif
        </table>
      </div>
    </div>
  </div>
</div>
</div>
@endsection

@section('custom-js-section')
<script>
	$('.delete_contact').click(function(e) {
		e.preventDefault();
		var id = $(this).val();
		// alert(user_id);
		Swal.fire({
			title: "Are you sure?",
			text: "You won't to delete this member!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Yes, sure!"
		}).then((result) => {

			if (result.isConfirmed) {
				$.ajax({
					type: "POST",
					url: "{{route('admin.contact.delete')}}",
					data: {
						'id': id
					},
					success: function(data) {
						if (data.status == true) {
							Swal.fire({
								title: "Deleted!",
								text: data.msg,
								icon: "success",
								timer: 2000
							});
							$('#contact_' + id).hide(2000);
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