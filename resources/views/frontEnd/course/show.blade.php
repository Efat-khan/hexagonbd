@extends('frontEnd.layouts.master')

@section('content')

<!-- Hero Section -->
<section class="bg-primary text-white py-5">
    <div class="container text-center">
        <h1 class="fw-bold">{{ $course->name ?? 'Course Title' }}</h1>
        <p class="mb-0">{{ $course->short_description ?? 'Learn and grow with this amazing course.' }}</p>
    </div>
</section>

<!-- Course Details -->
<div class="container my-5">

    <!-- Course Image -->
    <div class="mb-4">
        <img src="{{ asset($course->image ?? 'front-end-asset/img/course-1.jpg') }}"
            class="img-fluid rounded shadow-sm w-100"
            alt="{{ $course->name ?? 'Course Image' }}"
            style="max-height: 300px; object-fit: cover;">
    </div>

    <!-- Course Info -->
    <div class="card border-0 shadow-sm mb-5">
        <div class="card-body">
            <h3 class="fw-bold text-primary mb-3"> Overview</h3>
            <p class="text-muted">{!! $course->sort_description ?? 'No description available.' !!}</p>
            <p class="text-muted">{!! $course->description ?? 'No description available.' !!}</p>

            <div class="row mt-4">
                <div class="col-md-4 mb-2"><i class="fa fa-graduation-cap text-primary me-2"></i> {{ $course->course_type === 'online' ? 'Online' : 'Offline' }}</div>
                
                <div class="col-md-4 mb-2"><i class="fa fa-language text-primary me-2"></i> Language: {{ $course->language ?? 'Bangla' }}</div>
                <div class="col-md-4 mb-2"><i class="fa fa-certificate text-primary me-2"></i> Certificate: {{ $course->reg_status ? 'Yes' : 'No' }}</div>
            </div>
        </div>
    </div>

    <!-- Videos -->
    <div class="card border-0 shadow-sm mb-5">
        <div class="card-body">
            <h3 class="fw-bold text-primary mb-4"><i class="fa fa-play-circle me-2"></i> Videos</h3>
            <div class="row g-4">
                @if(isset($course->CourseResource) && count($course->CourseResource) > 0)
                @foreach($course->CourseResource as $video)
                <div class="col-md-6">
                    <div class="rounded shadow-sm overflow-hidden">
                        @php
                        $embedUrl = str_replace("watch?v=", "embed/", $video->resource_link);
                        @endphp
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ $embedUrl }}"
                                title="{{ $video->title ?? 'Course Video' }}"
                                frameborder="0"
                                allowfullscreen>
                            </iframe>
                        </div>

                        <!-- <div class="bg-light p-2">
                                    <h6 class="fw-bold text-center mb-0">{{ $video->title ?? 'Untitled Video' }}</h6>
                                </div> -->
                    </div>
                </div>
                @endforeach
                @else
                <p class="text-muted">🚫 No videos available yet.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Instructor & Mentors -->
    @if(isset($course->TeacherCourse) && count($course->TeacherCourse) > 0)
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h3 class="fw-bold text-primary mb-4">
                <i class="fa fa-chalkboard-teacher me-2"></i> Instructors & Mentors
            </h3>

            <div class="row g-4">
                @foreach ($course->TeacherCourse as $teacher)
                <div class="col-md-6">
                    <div class="d-flex align-items-center p-3 border rounded shadow-sm h-100">
                        <img src="{{ asset($teacher->Teacher->image ?? 'front-end-asset/fixed/default-teacher.png') }}"
                            class="rounded-circle me-3"
                            style="width: 70px; height: 70px; object-fit: cover;"
                            alt="Instructor">
                        <div>
                            <h5 class="fw-bold mb-1">{{ $teacher->Teacher->name ?? 'Instructor Name' }}</h5>
                            <small class="text-muted d-block">{{ $teacher->Teacher->designation ?? 'Instructor' }}</small>
                            <small class="text-muted d-block">{{ $teacher->Teacher->email ?? '' }}</small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
    @endif

</div>

@endsection