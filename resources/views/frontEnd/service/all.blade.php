@extends('frontEnd.layouts.master')
@section('content')
<div class="breadcumb-wrapper p-5" data-bg-src="assets/img/bg/breadcumb-bg.jpg">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">All Service's</h1>
            <ul class="breadcumb-menu">
                <li><a href="{{route('home')}}">Home</a></li>
                <li>All Service's</li>
            </ul>
        </div>
    </div>
</div>
<section class="th-blog-wrapper space-extra-bottom">
    <div class="container z-index-common">
        <!-- Series loop -->
        <section class="py-3">
            <div class="row gy-40">
            @foreach ($services as $key=>$value )
                
                <div class="col-md-6 col-xl-4">
                    <div class="service-card">
                        <div class="service-card_number">{{$key+1}}</div>
                        <div class="shape-icon"><img src="{{!empty($value->image)?asset($value->image):''}}" alt="Icon" style="border-radius:20%; object-fit:cover; height:90px;"> <span class="dots"></span></div>
                        <h3 class="box-title"><a href="{{route('home.service.show',$value->id)}}">{{!empty($value->title)?$value->title:''}}</a></h3>
                        <p class="service-card_text">{{!empty($value->description)?$value->description:''}}</p>
                        <a href="{{route('home.service.show',$value->id)}}" class="th-btn">Read More<i class="fa-regular fa-arrow-right ms-2"></i></a>
                        <div class="bg-shape"><img src="frontEndAssets/img/bg/service_card_bg.png" alt="bg"></div>
                    </div>
                </div>
                @endforeach
   
            </div>
        </section>
        <!-- Series loop end -->
    </div>
    <div class="shape-mockup" data-bottom="0" data-left="0">
        <div class="particle-2" id="particle-2"></div>
    </div>
</section>
@endsection

@section('customeJS')


@endsection