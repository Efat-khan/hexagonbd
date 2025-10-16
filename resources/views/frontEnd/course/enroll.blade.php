@extends('frontEnd.layouts.master')

@section('content')

<!-- Hero Banner -->
<div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white fw-bold">{{ $course->name }}</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-white" href="{{ route('home.course') }}">Courses</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">{{ $course->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Course Overview -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <img src="{{ asset($course->image) }}" onerror="this.src='{{ asset('front-end-asset/img/default-course.jpg') }}'" class="img-fluid rounded shadow" alt="Course Image">
            </div>
            <div class="col-lg-6">
                <h2 class="mb-4 text-primary">{{ $course->name }}</h2>
                <ul class="list-unstyled">
                    <li><strong>Price:</strong>
                        @if($course->discounted_price)
                            <span class="text-danger fw-bold">{{ $course->discounted_price }} Tk</span>
                            <span class="text-muted text-decoration-line-through ms-2">{{ $course->regular_price }} Tk</span>
                        @else
                            <span class="fw-bold">{{ $course->regular_price }} Tk</span>
                        @endif
                    </li>
                    @if ($course->total_batch)
                        <li><strong>Total Batch:</strong> {{ $course->total_batch }}</li>
                        <li><strong>Student/Batch:</strong> {{ $course->number_of_student_per_batch }}</li>
                    @endif
                    @if ($course->date)
                        <li><strong>Course Start:</strong> {{ \Carbon\Carbon::parse($course->date)->format('d M Y') }}</li>
                    @endif
                    <!-- <br>
                    <li><a href="{{route('home.course.enroll',$course->id)}}" class="btn btn-primary">Enroll Now</a></li> -->
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container-xxl py-5">
    <div class="container">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="text-center text-success mb-4">Enroll Now</h4>

                {{-- Show top-level error list --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="row g-3" method="POST" enctype="multipart/form-data" action="{{ route('home.course.enroll.order.store') }}">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">

                    {{-- Full Name --}}
                    <div class="col-md-6">
                        <label class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" value="{{ old('full_name') }}">
                        @error('full_name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    {{-- Phone --}}
                    <div class="col-md-6">
                        <label class="form-label">Phone <span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                        @error('phone') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    {{-- Email --}}
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        @error('email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    {{-- Father's Name --}}
                    <div class="col-md-6">
                        <label class="form-label">Father's Name <span class="text-danger">*</span></label>
                        <input type="text" name="father_name" class="form-control @error('father_name') is-invalid @enderror" value="{{ old('father_name') }}">
                        @error('father_name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    {{-- Mother's Name --}}
                    <div class="col-md-6">
                        <label class="form-label">Mother's Name <span class="text-danger">*</span></label>
                        <input type="text" name="mother_name" class="form-control @error('mother_name') is-invalid @enderror" value="{{ old('mother_name') }}">
                        @error('mother_name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    {{-- Institute --}}
                    <div class="col-md-6">
                        <label class="form-label">Institute <span class="text-danger">*</span></label>
                        <input type="text" name="institute" class="form-control @error('institute') is-invalid @enderror" value="{{ old('institute') }}">
                        @error('institute') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    {{-- Address --}}
                    <div class="col-md-12">
                        <label class="form-label">Address</label>
                        <textarea name="address" rows="3" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                        @error('address') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    {{-- Gender --}}
                    <div class="col-md-6">
                        <label class="form-label">Gender <span class="text-danger">*</span></label>
                        <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    {{-- Department --}}
                    <div class="col-md-3">
                        <label class="form-label">Department <span class="text-danger">*</span></label>
                        <select name="department" class="form-select @error('department') is-invalid @enderror">
                            <option value="">Select Department</option>
                            @foreach(['CSE', 'EEE', 'ME', 'TE', 'CIVIL', 'ARC', 'IPE', 'FE', 'CE'] as $dept)
                                <option value="{{ $dept }}" {{ old('department') == $dept ? 'selected' : '' }}>{{ $dept }}</option>
                            @endforeach
                        </select>
                        @error('department') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    {{-- Semester --}}
                    <div class="col-md-3">
                        <label class="form-label">Semester <span class="text-danger">*</span></label>
                        <select name="semester" class="form-select @error('semester') is-invalid @enderror">
                            <option value="">Select Semester</option>
                            @foreach(range(1, 7) as $sem)
                                <option value="{{ $sem }}" {{ old('semester') == $sem ? 'selected' : '' }}>
                                    {{ $sem }}{{ ['st','nd','rd','th'][$sem-1] ?? 'th' }}
                                </option>
                            @endforeach
                        </select>
                        @error('semester') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    {{-- Upload Image --}}
                    <div class="col-md-6">
                        <label class="form-label">Upload Image</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                        @error('image') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    {{-- Amount --}}
                    <div class="col-md-6">
                        <label class="form-label">Amount <span class="text-danger">*</span></label>
                        <input type="text" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}">
                        @error('amount') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    {{-- Payment Method --}}
                    <div class="col-md-6">
                        <label class="form-label">Payment Method <span class="text-danger">*</span></label>
                        <select name="payment_method" class="form-select @error('payment_method') is-invalid @enderror">
                            <option value="">Select Method</option>
                            @foreach(['bKash', 'Nagad', 'Rocket', 'Upay', 'Cash', 'Other'] as $method)
                                <option value="{{ $method }}" {{ old('payment_method') == $method ? 'selected' : '' }}>{{ $method }}</option>
                            @endforeach
                        </select>
                        @error('payment_method') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    {{-- Sender Number --}}
                    <div class="col-md-6">
                        <label class="form-label">Sender Number <span class="text-danger">*</span></label>
                        <input type="text" name="sender_number" class="form-control @error('sender_number') is-invalid @enderror" value="{{ old('sender_number') }}">
                        @error('sender_number') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    {{-- Transaction ID --}}
                    <div class="col-md-6">
                        <label class="form-label">Transaction ID <span class="text-danger">*</span></label>
                        <input type="text" name="transaction_id" class="form-control @error('transaction_id') is-invalid @enderror" value="{{ old('transaction_id') }}">
                        @error('transaction_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    {{-- Notes --}}
                    <div class="col-md-12">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" rows="3" class="form-control @error('notes') is-invalid @enderror">{{ old('notes') }}</textarea>
                        @error('notes') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    {{-- Submit --}}
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-success px-5">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
