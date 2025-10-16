@extends('frontEnd.layouts.master')

@section('content')
<div class="breadcumb-wrapper p-5" data-bg-src="assets/img/bg/breadcumb-bg.jpg">
  <div class="container">
    <div class="breadcumb-content">
      <h1 class="breadcumb-title">Service</h1>
      <ul class="breadcumb-menu">
        <li><a href="{{route('home')}}">Home</a></li>
        <li><a href="{{route('home.service.all')}}">Service</a></li>
        <li><a href="#">{{$service->title}}</a></li>
      </ul>
    </div>
  </div>
</div>
<section class="th-blog-wrapper blog-details space-top space-extra-bottom">
  <div class="container">
    <div class="row">


      <div class="col-xxl-12 col-lg-12">
        <div class="th-blog blog-single">
          
          <div class="blog-img">
            <!-- It's an image -->
            <img src="{{ !empty($service->image)?asset($service->image):'' }}" alt="Service file" style="height:350px; object-fit:cover;width:100%;">
          </div>
          <div class="blog-content">
            <div class="blog-meta"> <a href="blog.html"><i class="fa-light fa-calendar-days"></i>{{ \Carbon\Carbon::parse($service->created_at)->format('d M, Y') }}</a></div>
            <!-- <h2 class="blog-title">{{$service->title}}</h2> -->
            <blockquote>
              <p>“{{$service->title}}”</p>
            </blockquote>
            
          <h3>Description:</h3>
            <p>{{$service->description}}</p>
          </div>
          <div class="share-links clearfix">
            <div class="row justify-content-between">
              
              <!-- <div class="col-sm-auto text-xl-end"><span class="share-links-title">Share:</span>
                <ul class="social-links">
                  <li><a href="https://facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                  <li><a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a></li>
                  <li><a href="https://linkedin.com/" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                  <li><a href="https://instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a></li>
                </ul>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


@endsection