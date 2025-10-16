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
                    <h1 class="page-title">Ventilation System</h1>
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
                        <span><span>Ventilation System</span></span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page-header end -->
<div id="content" class="site-content slider3">
    <div class="container" style="margin-top: 40px; >
        <div class=" row">
        <div id="primary" class="content-area col-md-12 col-sm-12 col-xs-12">
            <div class="service">
                <div class=" clearfix margbtm30">
                    <div class="img-item item-1"><img alt="img" src="{{asset('images/default/v-1.jpg')}}" style="height: 400px; width:100%; object-fit:cover"></div>

                </div>
                <div class="fp-section-title clearfix ">
                    <h2>Ventilation System</h2>
                </div>
                <p>Our ventilation solutions cover a wide range of equipment including fans, AC units, pumps, boilers, cooling towers, chillers, AHU, and FCU. We also specialize in dust, lint, and fume extraction, humidity and climate control, compressed air, humidification, dehumidification, and complete ducting and piping works. From planning and consultancy to implementation, execution, inspection, and maintenance — we deliver end-to-end ventilation system services tailored to client needs.</p>
                <div class="fp-section-title clearfix">
                    <h2>Our Services</h2>
                </div>
                <div class="row margbtm40">
                    <div class="col-md-12">
                        <div class="service clearfix">
                            <div class="fp-faq active">
                                <h2><i class="fa fa-fan" aria-hidden="true"></i> Ventilation System</h2>
                                <div class="toggle-content">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="list-unstyled service-list">
                                                <li><i class="fa fa-check-circle"></i> <strong>All Types of Fans</strong></li>
                                                <li><i class="fa fa-check-circle"></i> <strong>Air Conditioners (AC)</strong></li>
                                                <li><i class="fa fa-check-circle"></i> <strong>Pumps</strong></li>
                                                <li><i class="fa fa-check-circle"></i> <strong>Boilers</strong></li>
                                                <li><i class="fa fa-check-circle"></i> <strong>Cooling Towers</strong></li>
                                                <li><i class="fa fa-check-circle"></i> <strong>Chillers</strong></li>
                                                <li><i class="fa fa-check-circle"></i> <strong>AHU / FCU</strong></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="list-unstyled service-list">
                                                <li><i class="fa fa-check-circle"></i> <strong>Dust, Lint & Fume Extraction</strong></li>
                                                <li><i class="fa fa-check-circle"></i> <strong>Humidity & Climate Control</strong></li>
                                                <li><i class="fa fa-check-circle"></i> <strong>Compressed Air Systems</strong></li>
                                                <li><i class="fa fa-check-circle"></i> <strong>Humidification & Dehumidification</strong></li>
                                                <li><i class="fa fa-check-circle"></i> <strong>Ducting & Piping Works</strong></li>
                                                <li><i class="fa fa-check-circle"></i> <strong>Planning, Consultancy & Maintenance</strong></li>
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