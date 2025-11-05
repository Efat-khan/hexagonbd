@php
$layout_setting = \App\Models\LandingPage::first();
@endphp
<style>
    .main-nav a {
        font-weight: 550;
        font-size: 19px;
    }
</style>
<!-- topbar -->
<div id="topbar" class="topbar">
    <div class="container">
        <div class="row">
            <div class="topbar-left topbar-widgets text-left col-md-10 col-sm-12 col-xs-12">
                <div id="text-8" class="widget widget_text">
                    <div class="textwidget">
                        <p><i class="fa fa-phone" aria-hidden="true"></i> {{$layout_setting->phone??'+880017****'}}</p>
                    </div>
                </div>
                <div id="text-10" class="widget widget_text">
                    <div class="textwidget"><i class="fa fa-envelope" aria-hidden="true"></i> {{$layout_setting->email??'N/A'}}</div>
                </div>
                <div id="text-9" class="widget widget_text">
                    <div class="textwidget"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$layout_setting->location??'N/A'}}</div>
                </div>
            </div>
            <div class="topbar-right topbar-widgets text-right col-md-2 col-sm-12 col-xs-12">
                <div id="text-11" class="widget widget_text">
                    <div class="textwidget">
                        <p class="inlineblock"><span class="text">Stay connected:</span></p>
                        <ul class="topbar-socials">
                            @if ($layout_setting && $layout_setting->fb_link)
                            <li><a href="{{$layout_setting->fb_link??''}}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"> </i></a></li>
                            @endif
                            @if ($layout_setting && $layout_setting->in_link)
                            <li><a href="{{$layout_setting->in_link??''}}" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"> </i></a></li>
                            @endif
                            @if ($layout_setting && $layout_setting->in_wp_linklink)
                            <li><a href="{{$layout_setting->wp_link??''}}" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"> </i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="topbar-border"></div>
            </div>
        </div>
    </div>
</div>
<!-- masthead -->
<header id="masthead" class="site-header clearfix">
    <div class="header-main">
        <div class="container">
            <div class="row">
                <div class="site-logo col-md-1 col-sm-6 col-xs-6">
                    <a href="{{route('home')}}" class="logo">
                        <img src="{{asset($layout_setting->logo_image??'')}}" alt="{{asset($layout_setting->web_title??'')}}" class="logo-light hide-logo" width="60px">
                        <img src="{{asset($layout_setting->logo_image??'')}}" alt="{{asset($layout_setting->web_title??'')}}" class="logo-dark show-logo" width="60px">
                    </a>
                    <h1 class="site-title"><a href="#">{{asset($layout_setting->web_title??'')}}</a></h1>
                </div>
                <div class="site-menu col-md-11 col-sm-6 col-xs-6">
                    <div class="navbar-toggle toggle-navs">
                        <a href="#" class="navbars-icon">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </a>
                    </div>
                    <nav id="site-navigation" class="main-nav primary-nav nav">
                        <ul id="primary-menu" class="menu">
                            <li class="current-menu-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="dropdown-item"><a href="#"> Who We Are</a>
                                <ul class="sub-menu">
                                    <li><a href="{{route('home.about')}}">About Us</a></li>
                                    <li><a href="{{route('home.management')}}">Our Management</a></li>
                                    <li><a href="{{route('home.team')}}">Hexagon Team</a></li>
                                    <li><a href="{{route('home.org-chart')}}">Organization Chart
                                        </a></li>
                                    <li><a href="{{route('home.client')}}"> Our Clients & Partner</a>
                                    <li><a href="{{route('home.achievement.all')}}"> Achievements</a>
                                </ul>
                            </li>
                            <li class=""><a href="{{route('home.service.service_all')}}"> Services</a>
                            <!-- <li class="dropdown-item"><a href="{{route('home.service.service_all')}}"> Services</a> -->
                                <!-- <ul class="sub-menu">
                                    <li><a href="{{route('home.service.fixed-ventilation-system-page')}}"> Ventilation System</a></li>
                                    <li><a href="{{route('home.service.fixed-fire-fighting-system-page')}}"> Fire-Fighting System</a></li>
                                    <li><a href="{{route('home.service.fixed-plumbing-works-page')}}"> Plumbing Works
                                        </a></li>
                                    <li><a href="{{route('home.service.fixed-additional-works-page')}}"> Additional Solutions & Services

                                        </a></li>
                                </ul> -->
                            </li>
                            <li class=""><a href="{{route('home.project.all')}}"> Projects</a>

                            </li>
                            <!-- <li><a href="{{route('home.client')}}"> Our Clients & Partner</a> -->
                            </li>
                            <li class=""><a href="{{route('home.gallery.view')}}">Gallery</a></li>
                            <li><a href="{{route('home.brand')}}"> Brands</a>
                            <li class=""><a href="{{route('home.career.all')}}">Career</a></li>

                            <!-- <li><a href="contact.html"></a></li> -->
                            <li class="extra-menu-item menu-item-button-link">
                                <a href="{{route('home.contact.view')}}" class="fp-btn btn">Contact Us</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- masthead end -->