@php
$layout_setting = \App\Models\LandingPage::first();
@endphp
@extends('frontEnd.layouts.master')
@section('content')
<!-- page-header-->
<div class="page-header title-area">
    <div class="header-title" style="background:url({{asset('images/bg/page-header1.jpg')}})">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-title">Organization Chart 
</h1>
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
                        <span><span>Organization Chart 
</span></span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page-header end -->

<div id="content" class="site-content slider3">
    <div class="latestnews-1  secpadd">
        <div class="container">
            <div class="row">
                <div class="col-sm-12" style="text-align: center;">
                    <div class="wwrimg margbtm20"><img src="{{asset('images/default/org-graph.jpg')}}" alt="image" ></div>
                </div>
            </div>
        </div>
    </div>
    <!-- what make special -->
    <div class="make-special paralex secpadd70" style="background-image:url({{asset('images/bg/count-parallax.jpg')}});">
        <div class="container">
            <div class="col-sm-12 col-md-6 col-lg-3">
                <h1 class="wmshd">What Makes <br>us<span class="main-color"> Special?</span></h1>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="fp-counter  style-1">
                    <div class="counter">
                        <div class="value">{{$layout_setting->successful_project_number??'N/A'}}</div>
                        <span>+</span>
                    </div>
                    <h4>Sucessful Projects</h4>
                    <span class="fp-icon"><i class="factory-tool2"></i></span>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="fp-counter  style-1">
                    <div class="counter">
                        <div class="value">{{$layout_setting->satisfied_client_percentage_number??'N/A'}}</div>
                        <span>%</span>
                    </div>
                    <h4>Satisfied Clients</h4>
                    <span class="fp-icon"><i class="factory-people"></i></span>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="fp-counter  style-1">
                    <div class="counter">
                        <div class="value">{{$layout_setting->awards_own_number??'N/A'}}</div>
                        <span>+</span>
                    </div>
                    <h4>Awards Won</h4>
                    <span class="fp-icon"><i class="factory-tool2"></i></span>
                </div>
            </div>
        </div>
    </div>
    <!--  what make special  end -->
    <!-- WHY CHOSE US START -->
    <div class="latestnews-1  secpadd">
        <div class="container">
            <div class="fp-section-title clearfix  ">
                <h2>Why Choosing Us</h2>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <div class="fp-icon-box icon-center dark-version">
                        <span class="fp-icon"><i class="fa fa-industry"></i></span>
                        <h4>Proven Expertise</h4>
                        <div class="desc">
                            <p>Years of experience in Mechanical, Electrical & Plumbing works across commercial, industrial, and residential projects.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="fp-icon-box icon-center dark-version">
                        <span class="fp-icon"><i class="fa fa-cubes"></i></span>
                        <h4>End-to-End Solutions</h4>
                        <div class="desc">
                            <p>Comprehensive MEP services under one roof — from design and engineering to installation, testing, and maintenance.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="fp-icon-box icon-center dark-version">
                        <span class="fp-icon"><i class="fa fa-shield"></i></span>
                        <h4>Quality & Safety First</h4>
                        <div class="desc">
                            <p>We follow international standards and strict safety practices to ensure durable and risk-free solutions.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <div class="fp-icon-box icon-center dark-version">
                        <span class="fp-icon"><i class="fa fa-users"></i></span>
                        <h4>Skilled Team</h4>
                        <div class="desc">
                            <p>A highly qualified team of engineers, technicians, and project managers committed to precision and efficiency.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="fp-icon-box icon-center dark-version">
                        <span class="fp-icon"><i class="fa fa-hourglass"></i></span>
                        <h4>On-Time Delivery</h4>
                        <div class="desc">
                            <p>Strong project management ensures timely completion without compromising quality.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="fp-icon-box icon-center dark-version">
                        <span class="fp-icon"><i class="fa fa-leaf"></i></span>
                        <h4>Innovation & Sustainability</h4>
                        <div class="desc">
                            <p>We integrate modern technology and eco-friendly practices to deliver energy-efficient, cost-effective solutions.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <div class="fp-icon-box icon-center dark-version">
                        <span class="fp-icon"><i class="fa fa-cog"></i></span>
                        <h4>Seamless Coordination</h4>
                        <div class="desc">
                            <p>We ensure smooth teamwork, detailed planning, and client-focused execution for successful project delivery.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="fp-icon-box icon-center dark-version">
                        <span class="fp-icon"><i class="fa fa-bolt"></i></span>
                        <h4>Fast Response</h4>
                        <div class="desc">
                            <p>Our team can reach the site within 4 hours for urgent breakdowns, minimizing downtime and production loss.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="fp-icon-box icon-center dark-version">
                        <span class="fp-icon"><i class="fa fa-phone"></i></span>
                        <h4>Client-Centric Approach</h4>
                        <div class="desc">
                            <p>We listen, understand, and customize solutions to meet the unique requirements of every client.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- WHY CHOSE US END -->
</div>
@endsection
@section('customeJS')
@endsection