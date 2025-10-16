@php
$layout_setting = \App\Models\LandingPage::first();
@endphp
@extends('frontEnd.layouts.master')
@section('content')
<style>
  .blog-wrapper {
    display: flex;
    align-items: flex-start;
    /* align top */
    gap: 20px;
    /* spacing between image and text */
    margin-bottom: 0px;
    padding-bottom: 0px;
  }

  .entry-thumbnail {
    flex: 0 0 270px;
    /* lock image container width */
  }

  .blog-img {
    width: 270px;
    /* fixed width */
    height: 180px;
    /* fixed height */
    object-fit: cover;
    /* crop nicely */
    border-radius: 6px;
  }

  .entry-details {
    flex: 1;
    /* take remaining space */
  }
</style>
<!-- page-header-->
<div class="page-header title-area">
  <div class="header-title" style="background:url({{asset('images/bg/page-header1.jpg')}})">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="page-title">Projects</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="breadcrumb-area">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <nav class="breadcrumb"><span>
              <a class="home" href="{{route('home')}}"><span>Home</span></a>
            </span><i class="fa fa-angle-right" aria-hidden="true"></i>
            <span><span>Projects</span></span>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- page-header end -->
<div id="content" class="site-content" style="margin-top: 20px; margin-bottom: 20px;">
  <div class="container">
    <div class="row">
      <div id="primary" class="content-area col-md-12 col-sm-12 col-xs-12">
        <div class="site-main">
          @foreach ($projects as $project)
          
          <article class="blog-wrapper d-flex">
            <!-- Image -->
            <div class="entry-thumbnail">
              <a href="{{route('home.project.show',$project->id)}}">
                <img src="{{asset($project->image??'')}}" alt="" class="project-img">
                <i class="factory-link"></i>
              </a>
            </div>

            <!-- Content -->
            <div class="entry-details">
              <header class="entry-header">
                <h2 class="entry-title"><a href="{{route('home.project.show',$project->id)}}">{{$project->title??'N/A'}}</a></h2>
                <div class="entry-meta">
                  <span class="meta byline">Client: <a href="#">{{$project['projectClient']->company_name??'N/A'}}</a></span>
                  <span class="meta posted-on">
                    <small>|</small>Date: 
                    <a href="#">{{ \Carbon\Carbon::parse($project->start_date)->format('d-M-Y') }}</a>
                  </span>
                </div>
              </header>
              <div class="entry-content">
                <p>Explain to you how all this mistaken idea of denouncing pleasure and praising pain sed was born and I will give you a complete account of the system, and expound…</p>
              </div>
              <a href="{{route('home.project.show',$project->id)}}" class="read-more">Read More <i class="fa fa-caret-right" aria-hidden="true"></i></a>
            </div>
          </article>
          @endforeach
        </div>
        <!-- <nav class="navigation paging-navigation numeric-navigation">
          <span class="page-numbers current">1</span>
          <a class="page-numbers" href="#">2</a>
          <a class="next page-numbers" href="#"><i class="fa fa-caret-right" aria-hidden="true"></i></a>
        </nav> -->
      </div>
    </div>
  </div>
</div>
@endsection
@section('customeJS')
@endsection