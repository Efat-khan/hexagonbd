@extends('frontEnd.layouts.master')

@section('content')
<div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white animated slideInDown">All Notice's</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-white" href="{{route('home.notice.all')}}">Notice</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">{{$notice->title}}</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="th-blog-wrapper blog-details space-top space-extra-bottom">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-8 col-lg-10">

        <!-- Single Blog / Notice Card -->
        <div class="th-blog blog-single p-4 p-md-5 bg-white rounded shadow-sm">

          <!-- Notice Image -->
          <div class="blog-img mb-4 text-center">
            <img src="{{ asset('back-end-assets/notice/notice.jpg') }}" alt="Notice Image" class="img-fluid rounded" style="max-height: 200px; object-fit: cover;">
          </div>

          <!-- Notice Content -->
          <div class="blog-content">
            <!-- Date -->
            <div class="blog-meta mb-3">
              <a href="javascript:void(0);"><i class="fa-light fa-calendar-days me-2"></i>{{ \Carbon\Carbon::parse($notice->created_at)->format('d M, Y') }}</a>
            </div>

            <!-- Title -->
            <blockquote class="blockquote mb-4">
              <p class="mb-0">“{{ $notice->title }}”</p>
            </blockquote>

            <!-- Message -->
            <p class="fs-6 text-dark">{{ $notice->message }}</p>
          </div>

          <!-- File Actions -->
          @php
            $filePath = $notice->file ? asset($notice->file) : null;
            $fileExtension = $notice->file ? pathinfo($notice->file, PATHINFO_EXTENSION) : '';
            $allowedImageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $allowedViewExtensions = array_merge($allowedImageExtensions, ['pdf']);
          @endphp

          @if($filePath)
          <div class="share-links mt-4 pt-4 border-top">
            <div class="row justify-content-between align-items-center">

              <div class="col-md-auto mb-2 mb-md-0">
                <div class="d-flex gap-3 flex-wrap">

                  @if(in_array(strtolower($fileExtension), $allowedViewExtensions))
                  <a href="{{ $filePath }}" target="_blank" class="btn btn-sm btn-outline-success">
                    <i class="fas fa-eye me-1"></i> View
                  </a>
                  @endif

                  <a href="{{ $filePath }}" download class="btn btn-sm btn-outline-danger">
                    <i class="fas fa-download me-1"></i> Download
                  </a>

                </div>
              </div>

              <!-- Optional Share Section -->
              <!-- 
              <div class="col-md-auto text-end">
                <span class="fw-semibold">Share:</span>
                <ul class="social-links d-inline-flex gap-2 ms-2">
                  <li><a href="https://facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                  <li><a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a></li>
                  <li><a href="https://linkedin.com/" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                  <li><a href="https://instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a></li>
                </ul>
              </div>
              -->
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>



@endsection