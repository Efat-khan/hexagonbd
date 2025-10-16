@php
$layout_setting = App\Models\LandingPage::first();
@endphp
@extends('frontEnd.layouts.master')
@section('content')
<div id="content" class="site-content">
    <!-- SLIDER START -->
    @if ($sliders->count() > 0)
    <div class="slide-container">
        <!-- START REVOLUTION SLIDER-->
        <div id="slider1" class="rev_slider fullwidthabanner" data-version="5.4.1">
            <ul>
                @foreach ($sliders as $slider)
                <!-- SLIDE -->
                <li data-index="rs-{{ $loop->index }}"
                    data-transition="fade"
                    data-slotamount="default"
                    data-hideafterloop="0"
                    data-hideslideonmobile="off"
                    data-easein="default"
                    data-easeout="default"
                    data-masterspeed="300"
                    data-thumb="{{ asset($slider->image ?? 'default-thumb.jpg') }}"
                    data-rotate="0"
                    data-saveperformance="off"
                    data-title="Slide">

                    <!-- MAIN IMAGE -->
                    <img src="{{ asset($slider->image ?? 'default.jpg') }}"
                        alt="{{ $slider->title ?? 'Slide' }}"
                        width="1920" height="620"
                        data-bgposition="center center"
                        data-bgfit="cover"
                        data-bgrepeat="no-repeat"
                        data-bgparallax="14"
                        class="rev-slidebg"
                        data-no-retina>

                    <!-- LAYER: TITLE -->
                    <div class="tp-caption fp_title_layer tp-resizeme"
                        id="slide-{{ $loop->index }}-layer-1"
                        data-x="center" data-hoffset="0"
                        data-y="top" data-voffset="160"
                        data-fontsize="['48','48','48','30']"
                        data-lineheight="['60','60','60','30']"
                        data-frames='[{"delay":500,"speed":1000,"frame":"0","from":"y:[-100%];","to":"o:1;","ease":"Power3.easeInOut"}]'
                        style="color:#fff; z-index:5;">
                        {{ $slider->title ?? '' }}
                    </div>

                    @php
                    // prepare description: split at nearest space after 100 chars (no mid-word cut)
                    $desc = $slider->sort_description ?? '';

                    if (mb_strlen($desc) > 100) {
                    // find first space AFTER the 100th char
                    $pos = mb_strpos($desc, ' ', 100);
                    if ($pos === false) {
                    // no space found after 100 -> fallback to 100 chars
                    $pos = 100;
                    }
                    $first = mb_substr($desc, 0, $pos);
                    $rest = mb_substr($desc, $pos);
                    $desc = $first . '<br>' . ltrim($rest); // insert a single <br> at a word boundary
                    }
                    @endphp

                    <!-- SHORT DESCRIPTION -->
                    <div class="tp-caption fp_title_layer tp-resizeme"
                        id="slide-{{ $loop->index }}-layer-3"
                        data-x="center" data-hoffset="0"
                        data-y="top" data-voffset="270"
                        data-fontsize="['20','20','20','18']"
                        data-lineheight="['32','32','32','24']"
                        data-frames='[{"delay":700,"speed":1200,"frame":"0","from":"x:[-100%];","to":"o:1;","ease":"Power3.easeInOut"}]'>
                        {!! $desc !!}
                    </div>
                    <!-- LAYER: BUTTON -->
                    <a class="tp-caption fp_button_layer rev-btn tp-resizeme"
                        id="slide-{{ $loop->index }}-layer-4"
                        href="{{ $slider->link ?? route('home.team') }}" target="_blank"
                        data-x="center" data-hoffset="0"
                        data-y="top" data-voffset="390"
                        data-frames='[{"delay":900,"speed":500,"frame":"0","from":"y:[100%];opacity:0;","to":"o:1;","ease":"Power2.easeInOut"}]'
                        style="color:#fff; border:1px solid #fff; padding:20px 30px; z-index:9; text-decoration:none;">
                        Meet Our Experts
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    <!-- SLIDER END -->
    <!-- Who We Are START -->
    @include('frontEnd.home.components.who-we-are')
    <!-- Who We Are END -->

    <!-- Clients Section Start -->
    @include('frontEnd.home.components.clients')
    <!-- CLIENT SECTION END -->

    <!-- SERVICES SECTION START -->
    <div class="service-style1 secpadd">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <div class="fp-section-title clearfix">
                        <h2>Services We Do.</h2>
                    </div>
                    <div class="srtextwrp">
                        <p>Hexagon Engineering Ltd (HEL) is one of the leading engineering companies in Bangladesh, providing complete solutions in Ventilation, Plumbing & Drainage, Fire-Fighting, and Solar Works. With expert technical teams, modern tools, and strong global partnerships, HEL ensures maximum efficiency and reliable performance. Our services include ventilation systems (fans, ACs, chillers, ducting, humidity control), fire-fighting solutions (alarms, sprinklers, hydrants, extinguishers), and plumbing works (water supply, drainage, tanks, filtration, treatment systems). We also offer additional solutions like CCTV & access control, public address systems, CNG/LPG piping, LED lighting, and solar panel installations, supported by planning, consultancy, execution, inspection, and maintenance.
                        </p>

                        <!-- <br> -->
                        <!-- <a class="btn-style1 " href="#">Go to all services</a> -->
                    </div>
                </div>
                <div class="col-sm-12 col-md-8">
                    <div class="fp-service  style-1">
                        <div class="row service-list">
                            <div class="col-md-6 col-6 col-sm-6 col-xs-6 item-service ">
                                <div class="entry-thumbnail">
                                    <div class="overlay ybgo9"></div>
                                    <a href="{{route('home.service.fixed-ventilation-system-page')}}"></a>
                                    <img src="{{asset('images/default/service-we-do-1.jpg')}}" alt="image"><i class="factory-link"></i><span><i class="factory-mill"></i></span>
                                </div>
                                <h2 class="entry-title"><a href="{{route('home.service.fixed-ventilation-system-page')}}">Ventilation System</a></h2>
                                <p>We provide complete solutions for ventilation, including fans, ACs, pumps, boilers, chillers, cooling towers, AHUs, FCUs, dust/fume extraction, humidity & climate control, compressed air, ducting, and piping. Our services cover planning, consultancy, implementation, inspection, and maintenance.</p>
                                <a href="{{route('home.service.fixed-ventilation-system-page')}}" class="fp-btn-2nd readmore">Read More</a>
                            </div>
                            <div class="col-md-6 col-6 col-sm-6 col-xs-6 item-service ">
                                <div class="entry-thumbnail">
                                    <div class="overlay ybgo9"></div>
                                    <a href="{{route('home.service.fixed-fire-fighting-system-page')}}"></a>
                                    <img src="{{asset('images/default/service-we-do-2.jpg')}}" alt="image"><i class="factory-link"></i><span><i class="factory-mill"></i></span>
                                </div>
                                <h2 class="entry-title"><a href="{{route('home.service.fixed-fire-fighting-system-page')}}">Fire-Fighting System</a></h2>
                                <p>We deliver end-to-end fire safety solutions, including fire alarm panels, pumps, detectors, sprinklers, hydrants, hose reels, and portable extinguishers. Our expertise ensures full system design, execution, inspection, and maintenance.</p>
                                <a href="{{route('home.service.fixed-fire-fighting-system-page')}}" class="fp-btn-2nd readmore">Read More</a>
                            </div>
                            <div class="col-md-6 col-6 col-sm-6 col-xs-6 item-service ">
                                <div class="entry-thumbnail">
                                    <div class="overlay ybgo9"></div>
                                    <a href="{{route('home.service.fixed-plumbing-works-page')}}"></a>
                                    <img src="{{asset('images/default/service-we-do-3.jpg')}}" alt="image"><i class="factory-link"></i><span><i class="factory-interface"></i></span>
                                </div>
                                <h2 class="entry-title"><a href="{{route('home.service.fixed-plumbing-works-page')}}">Plumbing & Drainage Works</a></h2>
                                <p>From water supply and drainage systems to pumps, tanks, filtration, treatment, storm drains, manholes, and toilet fixture installations, HEL provides complete plumbing solutions with ongoing inspection and maintenance.</p>
                                <a href="{{route('home.service.fixed-plumbing-works-page')}}" class="fp-btn-2nd readmore">Read More</a>
                            </div>
                            <div class="col-md-6 col-6 col-sm-6 col-xs-6 item-service ">
                                <div class="entry-thumbnail">
                                    <div class="overlay ybgo9"></div>
                                    <a href="{{route('home.service.fixed-additional-works-page')}}"></a>
                                    <img src="{{asset('images/default/service-we-do-4.jpg')}}" alt="image"><i class="factory-link"></i><span><i class="factory-folder"></i></span>
                                </div>
                                <h2 class="entry-title"><a href="{{route('home.service.fixed-additional-works-page')}}">Additional Solutions</a></h2>
                                <p>We also offer advanced solutions in: CCTV & Access Control Systems, Public Address Systems, CNG/LPG Piping, LED Lighting, Solar Panel Installations.</p>
                                <a href="{{route('home.service.fixed-additional-works-page')}}" class="fp-btn-2nd readmore">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 text-center mt-4">
                    <img src="{{asset('images/default/web-core-service.png')}}" alt="image">
                </div>
            </div>
        </div>
    </div>
    <!-- SERVICES SECTION END -->
    <!-- what make special -->
    <div class="make-special paralex secpadd70" style="background-image:url(images/bg/count-parallax.jpg);">
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
    <!-- PROJECT START-->
    @if ($projects->count() > 0)
    <div class="project-style1 secpadd blackbg">
        <div class="container">
            <div class="fp-latest-project style-1">
                <h2>Latest Project</h2>
                <div class="list-project row">
                    @foreach ($projects as $project)
                    <div class="col-md-3 col-sm-6 col-xs-6 project project_category-chemical project_category-power-energy">
                        <div class="item-project">
                            <a href="{{route('home.project.show',$project->id)}}" class="pro-link"></a>
                            <div class="overlay ybgo9"></div>
                            <img src="{{ asset($project->image ?? '') }}" alt="image" />
                            <div class="project-summary">
                                <h3 class="project-title"><a href="{{route('home.project.show',$project->id)}}">{{ $project->title ?? '' }}</a></h3>
                                @if ($project->client_id)
                                <p>Company Name: {{ $project->client_id?$project['projectClient']->company_name:''}}</p>
                                @endif
                            </div>
                            <span><i class="factory-travel"></i></span>
                        </div>
                    </div>
                    @endforeach
                </div> <!-- ✅ row closes here -->
            </div>
        </div>
    </div>
    @endif
    <!-- PROJECT END -->

    <div class="site-content" style="margin-top: 50px; margin-bottom: 50px;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="fp-section-title clearfix custom-title ">
                        <h2>Contact Us</h2>
                    </div>
                    <div class="fp-form fp-form-3 paddtop40">
                        <form action="{{ route('home.contact.store') }}" method="POST" novalidate="novalidate">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group field">
                                        <input name="name" value="{{ old('name') }}" placeholder="Your Name*" type="text" required>
                                    </div>
                                    <p class="error text-danger">
                                        @error('name') {{ $message }} @enderror
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group field">
                                        <input name="email" value="{{ old('email') }}" placeholder="Email Address*" type="email" required>
                                    </div>
                                    <p class="error text-danger">
                                        @error('email') {{ $message }} @enderror
                                    </p>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group field">
                                        <input name="subject" value="{{ old('subject') }}" placeholder="subject" type="text">
                                    </div>
                                    <p class="error text-danger">
                                        @error('subject') {{ $message }} @enderror
                                    </p>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea name="message" placeholder="Message" required>{{ old('message') }}</textarea>
                                    </div>
                                    <p class="error text-danger">
                                        @error('message') {{ $message }} @enderror
                                    </p>
                                </div>

                                @if(session('success'))
                                <div class="text-success text-center">{{ session('success') }}</div>
                                @endif

                                @if(session('error'))
                                <div class="text-danger">{{ session('error') }}</div>
                                @endif

                                <div class="col-sm-12 submit text-center paddtop30">
                                    <input type="submit" value="Submit Now" class="fh-btn">
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- SLOGAN START -->
    <div class="paralexhd paralex secpadd70" style="background-image:url(images/bg/count-parallax.jpg);">
        <div class="container">
            <div class="prlsxwrp">
                <p class="main-color"><strong>{{$layout_setting->slogan??'We pour our passion and effort into everything we do because people like you deserve nothing less than an exceptional experience.'}}</strong></p>
            </div>
        </div>
    </div>
    <!-- SLOGAN END -->











</div>
@endsection