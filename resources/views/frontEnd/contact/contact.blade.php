@extends('frontEnd.layouts.master')
@section('content')
<!-- page-header-->
<div class="page-header title-area">
    <div class="header-title" style="background:url(images/bg/page-header1.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-title">Contact </h1>
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
                        <span><span>Contact</span></span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page-header end -->
<div class="site-content" style="margin-top: 40px;">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="fp-section-title clearfix">
                    <h2>Contact details</h2>
                </div>
                <div class="fp-icon-box-5 icon-center dark-version ">
                    <span class="fp-icon"><i class="factory-technology"></i></span>
                    <h4>Have a Questions? Call Us</h4>
                    <div class="sub-title"></div>
                    <div class="desc">
                        <p>+(88) {{ $layout_data->phone??'N/A' }} </p>
                    </div>
                </div>
                <div class="fp-icon-box-5 icon-center dark-version ">
                    <span class="fp-icon"><i class="factory-travel"></i></span>
                    <h4>Visit Our Company at</h4>
                    <div class="sub-title"></div>
                    <div class="desc">
                        <p>{{ $layout_data->location??'N/A' }}</p>
                    </div>
                </div>
                <div class="fp-icon-box-5 icon-center dark-version ">
                    <span class="fp-icon"><i class="factory-business"></i></span>
                    <h4>Send Your Mail</h4>
                    <div class="sub-title"></div>
                    <div class="desc">
                        <p>{{ $layout_data->email??'N/A' }}</p>
                    </div>
                </div>
                <div class="fp-icon-box-5 icon-center dark-version ">
                    <span class="fp-icon"><i class="factory-wall-clock"></i></span>
                    <h4>Working Hours</h4>
                    <div class="sub-title"></div>
                    <div class="desc">
                        <p>{{ $layout_data->office_time_text??'N/A' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
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

<!--google map-->
<div class="google-map-area" style="margin-top: 10px;">
    <div class="google-map" style="height:450px;width:100%;">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d14605.75087917938!2d90.42148339681451!3d23.767422417075036!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1s31%2Fa%20l-block%20aftab%20nagar%20dhaka-1212!5e0!3m2!1sen!2sbd!4v1758918338988!5m2!1sen!2sbd"
            width="100%"
            height="450"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
            </https:>
    </div>
</div>

<!--google map end-->
@endsection

@section('customeJS')
@endsection