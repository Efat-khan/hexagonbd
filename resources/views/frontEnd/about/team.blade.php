@php 
    $layout_setting = \App\Models\LandingPage::first(); 
@endphp

@extends('frontEnd.layouts.master')

@section('content')
<style>
    /* === TEAM PAGE CUSTOM STYLES === */

    /* Team intro section */
    .team-intro {
        padding: 60px 0 40px 0;
        text-align: center;
    }
    .team-intro h2 {
        color: #FFD700; /* Deep yellow */
        font-size: 36px;
        font-weight: 800;
        margin-bottom: 20px;
    }
    .team-intro p {
        color: black;
        font-size: 18px;
        line-height: 1.8;
        max-width: 900px;
        margin: 0 auto;
    }

    /* Team member cards */
    .team-img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 8px;
        transition: transform 0.4s ease;
    }
    .fp-team {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        background: #fff;
        transition: all 0.3s ease;
    }
    .fp-team:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }
    .team-info {
        text-align: center;
        padding: 15px;
        border-top: 1px solid #eee;
    }
    .team-info h4 {
        margin-bottom: 5px;
        font-weight: 700;
        color: #222;
    }
    .team-info span {
        color: #002a52;
        font-size: 15px;
        font-weight: 700;
    }

    /* Hover Overlay */
    .team-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255,255,255,0.97);
        color: #333;
        opacity: 0;
        visibility: hidden;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 20px;
        transition: all 0.4s ease;
    }
    .fp-team:hover .team-overlay {
        opacity: 1;
        visibility: visible;
    }
    .team-overlay h4 {
        font-size: 18px;
        font-weight: 600;
        color: #222;
        margin-bottom: 5px;
    }
    .team-overlay span {
        color: #002a52;
        font-weight: 600;
        margin-bottom: 15px;
    }
    .team-overlay p {
        font-size: 14px;
        color: #444;
        line-height: 1.6;
        margin-bottom: 15px;
    }
    .team-overlay .social-icons a {
        color: #FFD700;
        font-size: 16px;
        margin: 0 6px;
        transition: color 0.3s;
    }
    .team-overlay .social-icons a:hover {
        color: #000;
    }
</style>

<!-- page-header -->
<div class="page-header title-area">
    <div class="header-title" style="background:url({{asset('images/bg/page-header1.jpg')}})">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-title">Hexagon Team</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <nav class="breadcrumb">
                        <span>
                            <a class="home" href="{{route('home')}}"><span>Home</span></a>
                        </span>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                        <span><span>Hexagon Team</span></span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page-header end -->

<!-- Meet Our Team Intro Section -->
<section class="team-intro">
    <div class="container">
        <h2>Meet Our Team</h2>
        <p>
            Hexagon Engineering Limited is powered by a skilled team of full-time professionals working across three core divisions — 
            Design and Engineering (DE), Project Execution and Management (PEM), and Business Development and Operations (BDO).<br><br>
            The Design and Engineering (DE) division specializes in comprehensive HVAC, Plumbing, Fire Safety, and Electrical system design, 
            ensuring innovative, sustainable, and cost-effective MEP solutions. Along with our in-house engineers and designers, the division 
            is supported by a strong network of technical consultants, site supervisors, and field specialists, ensuring excellence, safety, 
            and precision in every project we deliver.
        </p>
    </div>
</section>
<!-- Meet Our Team Intro End -->

<div id="content" class="site-content slider3">
    <div class="ourteam-style1 secpadd">
        <div class="container">
            <div class="row">
                @foreach ($teams as $team)
                    <div class="col-sm-6 col-md-4 mb-4">
                        <div class="fp-team">
                            <img src="{{ asset($team->image ?? '/images/default/management.png') }}" alt="{{ $team->name }}" class="team-img">

                            <div class="team-info">
                                <h4>{{ $team->name }}</h4>
                                <span>{{ $team->designation }}</span>
                            </div>

                            <!-- Hover Details -->
                            <div class="team-overlay">
                                <h4>{{ $team->name }}</h4>
                                <span>{{ $team->designation }}</span>
                                <p>{{ $team->description ?? 'No description available.' }}</p>
                                <div class="social-icons">
                                    @if(!empty($team->fb_link))
                                        <a href="{{ $team->fb_link }}" target="_blank"><i class="fa fa-facebook"></i></a>
                                    @endif
                                    @if(!empty($team->ln_link))
                                        <a href="{{ $team->ln_link }}" target="_blank"><i class="fa fa-linkedin"></i></a>
                                    @endif
                                    @if(!empty($team->wp_link))
                                        <a href="{{ $team->wp_link }}" target="_blank"><i class="fa fa-whatsapp"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

@section('customeJS')
@endsection
