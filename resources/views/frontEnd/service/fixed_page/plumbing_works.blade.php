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
                    <h1 class="page-title">Plumbing Works</h1>
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
                        <span><span>Services</span></span>
                        </span><i class="fa fa-angle-right" aria-hidden="true"></i>
                        <span><span>Plumbing Works</span></span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page-header end -->
<div id="content" class="site-content slider3">
    <div class="container" style="margin-top: 40px;" >
        <div class=" row">
        <div id="primary" class="content-area col-md-12 col-sm-12 col-xs-12">
            <div class="service">
                <div class=" clearfix margbtm30">
                    <div class="img-item item-1"><img alt="img" src="{{asset('images/default/p-1.jpeg')}}" style="height: 400px; width:100%; object-fit:cover"></div>

                </div>
                <div class="fp-section-title clearfix ">
                    <h2>Plumbing Works</h2>
                </div>
                <p>We provide complete plumbing solutions, including all types of pumps, underground and overhead tanks, water filtration and treatment systems, rainwater drainage, manholes, gully traps, water supply, drainage systems, and toilet fixture installation. Our services cover planning, installation, inspection, and maintenance for reliable and efficient plumbing systems.</p>
                <div class="fp-section-title clearfix">
                    <h2>Our Services</h2>
                </div>
                <div class="row margbtm40">
                    <div class="col-md-12">
                        <div class="service clearfix">
                            <div class="fp-faq active">
                                <h2><i class="fa fa-fan" aria-hidden="true"></i> Plumbing Works</h2>
                                <div class="toggle-content">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="list-unstyled service-list">
                                                <li><i class="fa fa-check-circle"></i> <strong>All Types of Pumps</strong></li>
                                                <li><i class="fa fa-check-circle"></i> <strong>Underground & Overhead Tanks</strong></li>
                                                <li><i class="fa fa-check-circle"></i> <strong>Filtration, Softener & Water Treatment Systems</strong></li>
                                                <li><i class="fa fa-check-circle"></i> <strong>Rainwater Drainage Systems with Downpipes & Storm Drains</strong></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="list-unstyled service-list">
                                                <li><i class="fa fa-check-circle"></i> <strong>Manholes & Gully Traps</strong></li>
                                                <li><i class="fa fa-check-circle"></i> <strong>Water Supply Systems</strong></li>
                                                <li><i class="fa fa-check-circle"></i> <strong>Drainage Systems</strong></li>
                                                <li><i class="fa fa-check-circle"></i> <strong>Toilet Fixtures Installation</strong></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    .service-list li {
                        padding: 12px 0;
                        font-size: 18px;
                        /* Bigger text */
                        line-height: 1.6;
                        /* More spacing for readability */
                        color: #222;
                        border-bottom: 1px dashed #ddd;
                    }

                    .service-list li:last-child {
                        border-bottom: none;
                    }

                    .service-list i {
                        color: #0073e6;
                        margin-right: 10px;
                        font-size: 20px;
                    }

                    .fp-section-title h2 {
                        font-size: 34px;
                        font-weight: bold;
                        margin-bottom: 30px;
                        color: #222;
                    }
                </style>
            </div>
        </div>
    </div>
</div>

</div>
@endsection
@section('customeJS')
@endsection