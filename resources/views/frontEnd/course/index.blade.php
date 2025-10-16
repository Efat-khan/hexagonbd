@extends('frontEnd.layouts.master')

@section('content')

<!-- Header Start -->
<div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white animated slideInDown">Company Activities</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Activities</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Header End -->

<!-- Filter/Search Start -->
<div class="container mb-5">
    <form method="GET" action="{{ route('home.course') }}" class="row g-3 align-items-center">
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control shadow-sm" placeholder="Search Activities...">
        </div>
        <div class="col-md-4">
            <select name="category" class="form-select shadow-sm" onchange="this.form.submit()">
                <option value="">All Activities</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 d-grid">
            <button type="submit" class="btn btn-primary btn-lg shadow">Filter</button>
        </div>
    </form>
</div>
<!-- Filter/Search End -->

<!-- Course Grid Start -->
<div class="container pb-5">
    <div class="row g-4">
        @forelse($courses as $course)
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-lg rounded overflow-hidden hover-scale">
                <div class="position-relative overflow-hidden">
                    <img src="{{ asset($course->image) }}" 
                         class="card-img-top img-fluid" 
                         alt="{{ $course->name }}" 
                         onerror="this.src='{{ asset('front-end-asset/fixed/default-activity.jpg') }}'">
                    <!-- Optional Badge -->
                    <span class="position-absolute top-0 start-0 bg-primary text-white px-3 py-1 rounded-bottom-end">
                        {{ $course->CourseCategory->name ?? 'General' }}
                    </span>
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $course->name }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($course->sort_description, 120) }}</p>
                    <div class="mt-auto d-flex justify-content-between align-items-center">
                        <a href="{{route('home.course.show',$course->id)}}" class="btn btn-outline-primary btn-sm">View More</a>
                        <span class="badge bg-success">{{ $course->course_type ?? 'Online' }}</span>
                    </div>
                </div>
                <!-- <div class="card-footer bg-white border-0 d-flex justify-content-between">
                    <small class="text-muted"><i class="fa fa-calendar me-1"></i>{{ $course->date ?? 'N/A' }}</small>
                    <small class="text-muted"><i class="fa fa-user me-1"></i>{{ $course->number_of_student_per_batch ?? 0 }} Students</small>
                </div> -->
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <h5 class="text-muted">No activities found.</h5>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
        {{ $courses->withQueryString()->links() }}
    </div>
</div>
<!-- Course Grid End -->

@endsection

<!-- Custom Styles -->
@push('styles')
<style>
    /* Hover effect */
    .hover-scale:hover {
        transform: translateY(-5px);
        transition: all 0.3s ease-in-out;
        box-shadow: 0 15px 25px rgba(0,0,0,0.2);
    }

    /* Badge styling */
    .card .badge {
        font-size: 0.8rem;
        padding: 0.25em 0.5em;
    }

    /* Smooth card transition */
    .card {
        transition: all 0.3s ease-in-out;
    }
</style>
@endpush
