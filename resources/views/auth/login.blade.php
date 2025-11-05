@extends('frontEnd.layouts.master')

@section('content')
<!-- page-header-->
<div class="page-header title-area">
    <div class="header-title" style="background:url(images/bg/page-header1.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-title">Login </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <nav class="breadcrumb"><span>
                            <a class="home" href="#"><span>Home</span></a>
                        </span><i class="fa fa-angle-right" aria-hidden="true"></i>
                        <span><span>Login</span></span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page-header end -->
<section class="login-register-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="form">
                    <div class="sec-title">
                        <h2>Login Now</h2>
                        <span class="border"></span>
                    </div>
                    <div class="row">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="col-md-12">
                                <div class="input-field">
                                    <input type="text" name="email" placeholder="Enter Mail id *" value="{{ old('email') }}"  autocomplete="off">
                                    <div class="icon-holder">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-field">
                                    <input type="text" name="password" placeholder="Enter Password" >
                                    <div class="icon-holder">
                                        <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-field">
                                    <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"></div>
                                    <div class="icon-holder">
                                        <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <button class="thm-btn bg-clr1" type="submit">Login</button>
                                        <div class="remember-text">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="remember" id="remembermylogin">
                                                    <span>Remember Me</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection