<div class="space" id="about-sec" style="padding-top: 2%; padding-bottom:4%">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 mb-10 mb-xl-0">
                <div class="img-box1">
                    <div class="year-counter" style="margin-bottom:-80px;margin-left:350px;">
                        @php
                        $daysLeft = \Carbon\Carbon::now()->diffInDays($event->date, false);
                        @endphp
                        <h3 class="year-counter_number"><span class="counter-number">
                                {{abs($daysLeft)}}
                            </span></h3>
                        <p class="year-counter_text">
                        @if ($daysLeft > 0)
                        Day's Left
                        @elseif ($daysLeft === 0)
                        Today is the Event
                        @else
                        Day's ago, Event passed
                        @endif
                        </p>
                    </div>
                    <div class="img1" style="margin-top: -10px;"><img style="border-radius: 5%; height:400px; object-fit:cover;" src="{{asset(!empty($event['Gallery']->image)?$event['Gallery']->image:'')}}" alt="Event Image">

                    </div>

                </div>

            </div>
            <div class="col-xl-6">
                <div class="ps-xxl-2 ms-xl-3">
                    <div class="title-area mb-35"><span class="sub-title">
                            <div class="icon-masking me-2"><span class="mask-icon" data-mask-src="{{asset('frontEndAssets/img/theme-img/title_shape_1.svg')}}"></span> <img src="{{asset('frontEndAssets/img/theme-img/title_shape_1.svg')}}" alt="shape"></div>Up Coming Event
                        </span>
                        <h2 class="sec-title"><span class="text-theme"></span>{{!empty($event->title)?$event->title:'N/A'}}</h2>
                    </div>
                    <p class="mt-n2 mb-25">{{!empty($event->sort_description)?$event->sort_description:'N/A'}}</p>
                    <div class="about-feature-wrap">
                        <div class="about-feature">
                            <div class="about-feature_icon">
                                <img src="{{asset('frontEndAssets/img/icon/service_card_3.svg')}}" alt="Icon">
                            </div>
                            <div class="media-body">
                                <h3 class="about-feature_title">Event Date</h3>
                                <h2 class="title"><span class="text-theme">{{!empty($event->date)?\Carbon\Carbon::parse($event->date)->format('d M Y'):'N/A'}}</span></h2>
                            </div>
                        </div>
                        <div class="about-feature">
                            <div class="about-feature_icon"><img src="{{asset('frontEndAssets/img/icon/counter_1_2.svg')}}" alt="Icon"></div>
                            <div class="media-body">
                                <h3 class="about-feature_title">Prize Money</h3>
                                <h2 class="title"><span class="text-theme">{{!empty($event->prize_money)?$event->prize_money:'N/A'}}</span></h2>
                            </div>
                        </div>
                    </div>
                    <div class="btn-group">
                        <a href="{{!empty($event->reg_link)?$event->reg_link:'#'}}" class="th-btn">Register<i class="fa-regular fa-arrow-right ms-2"></i></a>
                        <a href="#" class="th-btn">Rules<i class="fa-regular fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>