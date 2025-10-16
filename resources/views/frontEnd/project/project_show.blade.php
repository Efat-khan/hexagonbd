@php
$layout_setting = \App\Models\LandingPage::first();
@endphp
@extends('frontEnd.layouts.master')
@section('content')
<style>
  .project-documents {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    /* spacing between images */
    justify-content: center;
    /* or center if you prefer */
  }

  .project-documents img {
    width: 200px;
    /* fixed width */
    height: 200px;
    /* fixed height -> square */
    object-fit: cover;
    /* keep proportions but crop */
    border-radius: 10px;
    /* rounded corners */
    margin: 10px 0;
    /* vertical spacing */
    cursor: pointer;
    /* clickable */
    transition: transform 0.3s ease;
  }

  .project-documents img:hover {
    transform: scale(1.05);
    /* zoom effect on hover */
  }
  .image-popup {
    display: none;
    position: fixed;
    z-index: 10000;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    justify-content: center;
    align-items: center;
}

.image-popup img {
    max-width: 90%;
    max-height: 90%;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.5);
}

.image-popup .close {
    position: absolute;
    top: 20px;
    right: 30px;
    color: white;
    font-size: 35px;
    font-weight: bold;
    cursor: pointer;
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
            </span><i class="fa fa-angle-right" aria-hidden="true"></i>
            <span><span>{{$project->title??''}}</span></span>
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
      <div id="primary" class="content-area col-md-12">
        <div class="site-main">
          <div class="single-project row">
            <div class="entry-thumbnail gallery-carousel col-md-8 col-sm-12 col-xs-12">
              <div class="item"><img src="{{asset($project->image??'')}}" alt="" /></div>
            </div>
            <div class="entry-info col-md-4 col-sm-12 col-xs-12">
              <h2 class="single-project-title info-title">Project Info</h2>
              <div class="metas row">
                <div class="info-left col-md-6">
                  <div class="meta client">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <h4>Client</h4>
                    <p>{{$project['projectClient']->company_name??'N/A'}}</p>
                  </div>
                  <div class="meta location">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <h4>Location</h4>
                    <p>{{$project['projectClient']->address??'N/A'}}</p>
                  </div>
                </div>
                <div class="info-right col-md-6">
                  <div class="meta start-date">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <h4>Date</h4>
                    <p>{{ \Carbon\Carbon::parse($project->start_date)->format('d-M-Y') }}</p>
                  </div>
                  <div class="meta end-date">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <h4>End Date</h4>
                    <p>{{ \Carbon\Carbon::parse($project->end_date)->format('d-M-Y') }}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="project-content col-md-12 col-sm-12 col-xs-12">
              <h2 class="single-project-title">Description</h2>
              <p>{!! $project->short_description??'' !!}</p>
              <p>{!! $project->description??'' !!}</p>
            </div>
          </div>
          <div class="fp-related-project">
            <h3>PROJECTS DOCUMENTS</h3>
            <div class="project-documents d-flex flex-wrap">
              @foreach($project->ProjectImage as $doc)
              <img src="{{ asset($doc->file) }}" alt="Document">
              @endforeach
            </div>
            <!-- Image Popup -->
            <div id="imagePopup" class="image-popup">
              <span class="close">&times;</span>
              <img class="popup-content" id="popupImage">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const popup = document.getElementById("imagePopup");
    const popupImg = document.getElementById("popupImage");
    const closeBtn = document.querySelector(".image-popup .close");

    document.querySelectorAll(".project-documents img").forEach(img => {
        img.addEventListener("click", function() {
            popup.style.display = "flex";
            popupImg.src = this.src;
        });
    });

    closeBtn.addEventListener("click", function() {
        popup.style.display = "none";
    });

    popup.addEventListener("click", function(e) {
        if (e.target === popup) {
            popup.style.display = "none";
        }
    });
});
</script>
@endsection
@section('customeJS')


@endsection