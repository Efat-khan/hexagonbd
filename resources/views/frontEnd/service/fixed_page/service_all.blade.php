@extends('frontEnd.layouts.master')

@section('content')

<!-- Enhanced CSS Styling -->
<style>
    /* Section background */
    .service-section {
        padding: 80px 0;
        background: linear-gradient(to bottom right, #f9f9f9, #fff);
    }

    /* Section title */
    .service-section h2 {
        font-weight: 700;
        color: #222;
        font-size: 2.5rem;
        margin-bottom: 15px;
    }

    .service-section p {
        color: #555;
        font-size: 1.1rem;
    }

    /* Card container */
    .service-card {
        perspective: 1000px;
        margin-bottom: 40px;
        transition: transform 0.3s ease-in-out;
    }

    .card-inner {
        position: relative;
        width: 100%;
        transform-style: preserve-3d;
        transition: transform 0.8s cubic-bezier(0.4, 0.2, 0.2, 1);
    }

    .service-card:hover .card-inner {
        transform: rotateY(180deg);
    }

    /* Card sides */
    .card-front,
    .card-back {
        position: absolute;
        width: 100%;
        backface-visibility: hidden;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    /* Front side */
    .card-front {
        height:570px;
        background: linear-gradient(135deg, #ffc107, #ffb300);
        color: #fff;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 40px 20px;
    }

    .card-icon {
        font-size: 60px;
        margin-bottom: 15px;
    }

    .card-front h3 {
        font-weight: 700;
        font-size: 1.8rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: #fff;
    }

    /* Back side */
    .card-back {
        transform: rotateY(180deg);
        position: relative;
        text-align: center;
    }

    /* Image on the back */
    .card-image {
        width: 100%;
        height: auto;
        display: block;
    }

    /* Overlay for text */
    .card-back .overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background: rgba(0, 0, 0, 0.25); /* lighter overlay */
        color: #fff;
        padding: 25px;
        text-align: center;
    }

    .card-back h5 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: #ffc107;
    }

    .card-back p {
        font-size: 1rem;
        line-height: 1.6;
    }

    /* Page header */
    .page-header .header-title {
        background-size: cover;
        background-position: center;
        padding: 100px 0;
        text-align: center;
    }

    .page-header h1 {
        font-size: 3rem;
        font-weight: 700;
        color: #fff;
        text-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
    }

    .breadcrumb-area {
        background-color: #f5f5f5;
        padding: 20px 0;
    }

    nav.breadcrumb a {
        color: #ffc107;
    }

    nav.breadcrumb a:hover {
        color: #e6ac00;
    }

    /* Responsive */
    @media (max-width: 767px) {
        .card-icon {
            font-size: 50px;
        }

        .card-front h3 {
            font-size: 1.4rem;
        }

        .card-back h5 {
            font-size: 1.3rem;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header title-area">
    <div class="header-title" style="background:url({{asset('images/bg/page-header1.jpg')}})">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-title">All Services</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="breadcrumb">
                        <a href="{{route('home')}}">Home</a>
                        <i class="fa fa-angle-right mx-2"></i>
                        <span>All Services</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Service Section -->
<section class="service-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Our Core Services</h2>
            <p>
                Hexagon Engineering Limited delivers comprehensive solutions in ventilation, fire-fighting, plumbing & drainage, and other engineering systems — ensuring reliability, innovation, and safety.
            </p>
        </div>

        <div class="row justify-content-center">

            <!-- Card 1 -->
            <div class="col-md-6 col-lg-6">
                <div class="service-card">
                    <div class="card-inner">
                        <div class="card-front">
                            <div class="card-icon"><i class="fa fa-home"></i></div>
                            <h3>Ventilation System</h3>
                        </div>
                        <div class="card-back">
                            <img src="{{ asset('images/default/s3.png') }}" alt="Ventilation System" class="card-image">
                            <div class="overlay">
                                <h5>Ventilation System</h5>
                                <p>Complete HVAC and ventilation solutions ensuring optimal air quality and comfort in every space.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-6 col-lg-6">
                <div class="service-card">
                    <div class="card-inner">
                        <div class="card-front">
                            <div class="card-icon"><i class="fa fa-fire-extinguisher"></i></div>
                            <h3>Fire-Fighting System</h3>
                        </div>
                        <div class="card-back">
                            <img src="{{ asset('images/default/s1.png') }}" alt="Fire Fighting System" class="card-image">
                            <div class="overlay">
                                <h5>Fire-Fighting System</h5>
                                <p>Reliable protection with advanced fire detection, suppression, and automated safety systems.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-6 col-lg-6">
                <div class="service-card">
                    <div class="card-inner">
                        <div class="card-front">
                            <div class="card-icon"><i class="fa fa-tint"></i></div>
                            <h3>Plumbing & Drainage</h3>
                        </div>
                        <div class="card-back">
                            <img src="{{ asset('images/default/s2.png') }}" alt="Plumbing & Drainage Works" class="card-image">
                            <div class="overlay">
                                <h5>Plumbing & Drainage Works</h5>
                                <p>Efficient water supply, sanitation, and drainage systems engineered for durability and sustainability.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-md-6 col-lg-6">
                <div class="service-card">
                    <div class="card-inner">
                        <div class="card-front">
                            <div class="card-icon"><i class="fa fa-cogs"></i></div>
                            <h3>Additional Solutions</h3>
                        </div>
                        <div class="card-back">
                            <img src="{{ asset('images/default/s4.png') }}" alt="Additional Solutions" class="card-image">
                            <div class="overlay">
                                <h5>Additional Solutions</h5>
                                <p>Tailored engineering and project management services customized to your specific project needs.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@section('customeJS')
@endsection
