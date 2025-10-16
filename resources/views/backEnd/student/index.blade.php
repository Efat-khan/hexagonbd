@extends('backEnd.layouts.master')

@section('content')

<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">Student</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">All Student</li>
					</ol>
				</nav>
			</div>
			<div class="ms-auto">
				<div class="btn-group">
					<a href="{{route('admin.student.create')}}" class="btn btn-primary">Add student</a>
				</div>
			</div>
		</div>
	</div>
	<!--end breadcrumb-->
	<div class="card m-4">
		<div class="card-body ">
			<div class="table-responsive">
				<table id="example2" class="table table-striped table-bordered">
					@if (!empty($students))
					<thead>
						<tr>
							<th>Name</th>
							<th>Phone</th>
							<th>Email</th>
							<th>Institute</th>
							<th>Department</th>
							<th>Semester</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($students as $data)
						<tr id="student_{{$data->id}}">
							<td>{{$data->full_name}}</td>
							<td>{{$data->phone??''}}</td>
							<td>{{$data->email??''}}</td>
							<td>{{$data->institute??''}}</td>
							<td>{{$data->department??''}}</td>
							<td>{{$data->semester??''}}</td>
							<td>
								<div class="btn-group" role="group" aria-label="Basic example">
									<!-- <a type="button" class="btn btn-success" title="View Data"><i class='bx bx-search-alt me-0'></i>
											</a> -->
									<a type="button" href="{{route('admin.student.edit',$data->id)}}" class="btn btn-info" title="Edit Data"><i class='bx bx-pencil me-0'></i>
									</a>
									<button value="{{ $data->id }}" class="btn btn-danger delete_student" data-confirm-delete="true" title="Delete student"><i class="bx bx-trash me-0"></i></button>
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
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
	$('.delete_student').click(function(e) {
		e.preventDefault();
		var id = $(this).val();
		// alert(id);
		Swal.fire({
			title: "Are you sure?",
			text: "You won't to delete this student!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Yes, sure!"
		}).then((result) => {

			if (result.isConfirmed) {
				$.ajax({
					type: "POST",
					url: "{{route('admin.student.delete')}}",
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
							$('#student_' + id).hide(2000);
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