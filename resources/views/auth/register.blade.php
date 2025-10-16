@extends('frontEnd.layouts.master')
@section('content')
<div class="breadcumb-wrapper p-5" data-bg-src="assets/img/bg/breadcumb-bg.jpg">
        <div class="container">
                <div class="breadcumb-content">
                        <h1 class="breadcumb-title">Member Sign-up</h1>
                        <ul class="breadcumb-menu">
                                <li><a href="{{route('home')}}">Home</a></li>
                                <li>Member Sign-up</li>
                        </ul>
                </div>
        </div>
</div>
<div class="th-checkout-wrapper space-top space-extra-bottom">
        <div class="container">
                <div class="row">
                        <div class="col-12">
                                <form method="POST" action="{{ route('register') }}" class="woocommerce-form-login">
                                        @csrf
                                        <div class="col-md-12 form-group"><label>Username*</label>
                                                <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Member Name" required>
                                                <x-input-error :messages="$errors->get('name')" class="mt-2 text-error" />
                                        </div>
                                        <div class="col-md-12 form-group"><label>Email*</label>
                                                <input type="text" class="form-control" name="email" value="{{old('email')}}" placeholder="Email" required>
                                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-error" />
                                        </div>
                                        <div class="col-md-12 form-group"><label>Password*</label>
                                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-error" />
                                        </div>
                                        <div class="col-md-12 form-group"><label>Confirm Password*</label>
                                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                                        </div>
                                                <button type="submit" class="th-btn">Sign Up</button>
                                                <p class="fs-xs mt-2 mb-0">
                                                        <a class="text-reset" href="{{route('login')}}">Already have an account? Login</a>
                                                </p>
                                        </div>
                                </form>
                        </div>
                </div>
        </div>
</div>

@endsection