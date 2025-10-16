@extends('frontEnd.layouts.master')
@section('content')
<div class="breadcumb-wrapper p-5" data-bg-src="assets/img/bg/breadcumb-bg.jpg">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">Password</h1>
            <ul class="breadcumb-menu">
                <li><a href="{{route('home')}}">Home</a></li>
                <li><a href="{{route('member.dashboard')}}">Account</a></li>
                <li>Password</li>
            </ul>
        </div>
    </div>
</div>
<div class="th-checkout-wrapper space-top space-extra-bottom">
    <div class="container">
        <!-- <div class="woocommerce-form-login">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div> -->
        <div class="woocommerce-form-login">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>
    </div>
</div>
@endsection