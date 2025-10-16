<section class="service-sec space" id="service-sec" data-bg-src="frontEndAssets/img/bg/service_bg_1.png">
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-7 col-sm-10 px-xl-4">
                <div class="title-area text-center"><span class="sub-title">
                        <div class="icon-masking me-2"><span class="mask-icon" data-mask-src="{{asset('frontEndAssets/img/theme-img/title_shape_1.svg')}}"></span> <img src="{{asset('frontEndAssets/img/theme-img/title_shape_1.svg')}}" alt="shape"></div>{{ !empty($layout_data->web_title)?$layout_data->web_title:'N/A' }}
                    </span>
                    <h2 class="sec-title">Our <span class="text-theme">Sponsors</span> & <span class="text-theme">Partners</span>
                    </h2>
                </div>
            </div>

            <div class="container">
                <div class="slider-area text-center">
                    <div class="swiper th-slider"
                        data-slider-options='{"breakpoints":{"0":{"slidesPerView":2},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"3"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"},"1400":{"slidesPerView":"5"}}}'>
                        <div class="swiper-wrapper">
                        @foreach ($sponsor as $key=>$data )
                                @if ($data->status =='active')
                                <div class="swiper-slide">
                                    <div class="brand-box">
                                        <a href="{{!empty($data->link)?$data->link:''}}">
                                        <img src="{{asset(!empty($data->image)?$data->image:'')}}" alt="{{!empty($data->name)?$data->name:''}}">
                                        <p>{{!empty($data->type)?$data->type:''}}</p>
                                        </a>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                           
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
</section>