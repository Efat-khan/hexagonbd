@php
$layout_setting = \App\Models\LandingPage::first();
@endphp
@extends('frontEnd.layouts.master')
@section('content')
<style>
    .team-img {
    width: 100%;
    height: 250px;       /* set the same height for all */
    object-fit: cover;   /* crop image nicely */
    border-radius: 8px;  /* optional: smooth corners */
}

</style>
<!-- page-header-->
<div class="page-header title-area">
    <div class="header-title" style="background:url({{asset('images/bg/page-header1.jpg')}})">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-title">Our Management</h1>
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
                        <span><span>Our Management</span></span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page-header end -->

<div id="content" class="site-content slider3">
    <!-- our team -->
    <div class="ourteam-style1 secpadd">
    <div class="container">
        <div class="row">
            @foreach ($teams as $team)
            <div class="col-sm-6">
                <div class="fp-team">
                    <div class="team-member">
                        <div class="overlay ybgo9"></div>
                        <img src="{{ asset($team->image??'/images/default/management.png') }}" alt="" class="team-img">
                        <div class="socials">
                            <ul class="list-social clearfix">
                                <li class="facebook"><a href="{{$team->fb_link??'#'}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li class="linkedin"><a href="{{$team->ln_link??'#'}}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                <li class="whatsapp"><a href="{{$team->wp_link??'#'}}" target="_blank"><i class="fa fa-whatsapp"></i></a></li>
                            </ul>
                        </div>
                        <div class="phone">
                            <i class="factory-technology"></i>
                            <div class="number">{{$team->phone??'N/A'}}</div>
                        </div>
                    </div>

                    <div class="info">
                        <h4 class="name">{{ $team->name }}</h4>
                        <span class="job">{{ $team->designation }}</span>

                        <p class="message">
                            <span class="short-text">
                                {!! \Illuminate\Support\Str::limit($team->description, 300, '...') !!}
                            </span>
                            <span class="full-text" style="display:none;">
                                {!! $team->description !!}
                            </span>
                        </p>
                        @if(strlen($team->description) > 200)
                            <button class="toggle-btn btn btn-link">Show More</button>
                        @endif
                    </div>

                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".toggle-btn").forEach(function(button) {
        button.addEventListener("click", function() {
            let infoBox = this.closest(".info");
            let shortText = infoBox.querySelector(".short-text");
            let fullText = infoBox.querySelector(".full-text");

            if (fullText.style.display === "none") {
                fullText.style.display = "inline";
                shortText.style.display = "none";
                this.textContent = "Show Less";
            } else {
                fullText.style.display = "none";
                shortText.style.display = "inline";
                this.textContent = "Show More";
            }
        });
    });
});
</script>

    <!-- our team end -->
</div>
@endsection
@section('customeJS')
@endsection