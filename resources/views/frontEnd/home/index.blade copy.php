@extends('frontEnd.layouts.master')

@section('content')

<!-- Carousel Start -->
<div class="container-fluid p-0 mb-5">
    <div class="owl-carousel header-carousel position-relative">
        @foreach($sliders as $slider)
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="{{asset($slider->image??'/public/front-end-asset/img/carousel-1.jpg')}}" alt="" style="object-fit:cover; height: 600px;">
            <!-- <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"> -->
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-sm-10 col-lg-8">
                            <!-- <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Best Online Courses</h5> -->
                            <h1 class="display-3 text-white animated slideInDown">{{$slider->title??''}}</h1>
                            @if (!empty($slider->sort_description))
                            <p class="fs-5 text-white mb-4 pb-2">{{$slider->sort_description??''}}</p>
                            @endif
                            <a href="{{$slider->link??'#'}}" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Read More</a>
                            <!-- <a href="" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Join Now</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">

            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                <h6 class="section-title bg-white text-start text-primary pe-3">About Us</h6>
                <h2 class="mb-1">{{$layout_data->about_title??'Welcome to Web'}}</h2>
                <p class="mb-1">{{ $layout_data->about_sort_description??'' }} <br> {!! $layout_data->about_description??'' !!}</p>
            </div>
            <div class="col-lg-6 wow fadeInUp pt-5" data-wow-delay="0.1s">
                <div class="position-relative overflow-hidden rounded shadow-lg" style="min-height: 400px;">
                    <img src="{{ asset($layout_data->about_image ?? 'front-end-asset/img/about.jpg') }}"
                        class="img-fluid w-100 h-100 "
                        alt="About Us"
                        style="object-fit: cover;">
                </div>
            </div>

        </div>
    </div>
</div>
<!-- About End -->
<!-- Mission & Vision Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Our Goals</h6>
            <h1 class="mb-5">Mission & Vision</h1>
        </div>
        <div class="row g-4">
            <!-- Vision -->
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="bg-light rounded shadow-sm p-4 h-100">
                    <i class="fa fa-3x fa-eye text-primary mb-4 d-block text-center"></i>
                    <h4 class="mb-3 text-center">Our Vision</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fa fa-check text-primary me-2"></i>To provide expert electrical consultancy, installation, maintenance, and troubleshooting services while delivering the highest level of service at minimal cost for any type of electrical project, including panel board design.</li>
                        <li><i class="fa fa-check text-primary me-2"></i>Through the Mother Trade Automation training department, we aim to develop a skilled workforce, creating employment opportunities both domestically and internationally to reduce unemployment.</li>
                    </ul>
                </div>
            </div>
            <!-- Mission -->
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="bg-light rounded shadow-sm p-4 h-100">
                    <i class="fa fa-3x fa-bullseye text-primary mb-4 d-block text-center"></i>
                    <h4 class="mb-3 text-center">Our Mission</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fa fa-check text-primary me-2"></i>To ensure all work complies with electrical codes and standards.</li>
                        <li class="mb-2"><i class="fa fa-check text-primary me-2"></i>To complete tasks with skilled and licensed professionals.</li>
                        <li class="mb-2"><i class="fa fa-check text-primary me-2"></i>To supervise work under ABC licensed supervisors.</li>
                        <li class="mb-2"><i class="fa fa-check text-primary me-2"></i>To use modern machinery, tools, and safety equipment in all operations.</li>
                        <li class="mb-2"><i class="fa fa-check text-primary me-2"></i>To maintain excellent conduct and commitment in every task.</li>
                        <li class="mb-2"><i class="fa fa-check text-primary me-2"></i>To strive for high-quality materials and provide guaranteed panel board solutions.</li>
                        <li><i class="fa fa-check text-primary me-2"></i>To arrange training programs for continuous skill development of employees.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Mission & Vision End -->
<!-- Message for Managing Director Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <!-- Image Section -->
            <div class="col-lg-5 wow fadeInLeft" data-wow-delay="0.1s">
                <div class="position-relative h-100 rounded shadow overflow-hidden">
                    <img class="img-fluid w-100 h-100"
                        src="{{ asset('front-end-asset/fixed/Managing Director.jpg') }}"
                        alt="Managing Director"
                        style="object-fit: cover; min-height: 400px; border-radius: 15px;">
                </div>
            </div>

            <!-- Content Section -->
            <div class="col-lg-7 wow fadeInRight" data-wow-delay="0.3s">
                <div class="bg-light p-4 p-lg-5 rounded shadow-sm">
                    <h6 class="section-title bg-white text-start text-primary pe-3">Message</h6>
                    <h1 class="mb-4">Message from the Managing Director</h1>

                    <div class="message-content" style="max-height: 350px; overflow-y: auto; padding-right: 10px;">
                        <p class="mb-3">
                            Mother Trade Automation, as a constituent institution, received approval in 2012
                            from the Bangladesh Technical Education Board under the name
                            <strong>"Mother Trade Training Center"</strong>, with institution code 53136.
                            This institution offers short courses as designated by the Bangladesh Technical Education Board
                            and provides government-certified certificates upon completion.
                        </p>

                        <p class="mb-3">
                            Through Mother Trade Automation, all types of governmental and private electrical work
                            are conducted continuously. To manage field-level work proficiently, we maintain a
                            modern-standard lab in Gazipur, complete with a three-phase power line. Here, training
                            for all personnel is conducted using a dedicated book titled
                            <em>"Electrical Maintenance and Viva Guide"</em>, alongside our proprietary training course modules.
                        </p>

                        <p class="mb-3">
                            Our training courses are categorized separately for engineers and non-engineers. A
                            distinct syllabus has been developed for engineers, covering the necessary theory
                            and practical skills for maintenance, troubleshooting, and entrepreneurship.
                        </p>

                        <p class="mb-3">
                            Students with backgrounds in BSc in EEE, Diploma in Electrical, Electronics,
                            Electromedical, Instrumentation & Process Control, Mechanical, Mechatronics, and
                            Computer Technology can enhance their skills through industrial attachments or
                            professional training here.
                        </p>

                        <p class="mb-3">
                            Furthermore, engineers and technicians currently working in factories, who wish to
                            increase their proficiency, can visit our lab. By completing professional courses,
                            they can establish themselves as skilled professionals within their companies,
                            contributing to reputation, salary increment, and promotion.
                        </p>

                        <p class="mb-0">
                            This book has been compiled based on real-world practical knowledge, integrating
                            theory and viva questions across various sectors. It is written in both Bengali
                            and English, ensuring broader accessibility. We welcome feedback and suggestions
                            for improvement.
                        </p>
                    </div>

                    <div class="mt-4 text-end">
                        <h5 class="text-primary mb-1">Engr. Jamal Hossain, B.Sc in EEE (DUET)</h5>
                        <small class="text-muted">Managing Director, Mother Trade Automation</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Message for Managing Director End -->

<!-- Service Start -->
<!-- <div class="container-xxl py-2">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item text-center pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-graduation-cap text-primary mb-4"></i>
                        <h5 class="mb-3">Skilled Instructors</h5>
                        <p>Learn from experienced educators who are experts in their fields and passionate about teaching.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item text-center pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-globe text-primary mb-4"></i>
                        <h5 class="mb-3">Online Classes</h5>
                        <p>Access flexible, interactive lessons from anywhere, at any time, tailored to your learning pace.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item text-center pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-home text-primary mb-4"></i>
                        <h5 class="mb-3">Job Preparation</h5>
                        <p>Get expert guidance, resources, and practice tools to boost your success in competitive job exams.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="service-item text-center pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-book-open text-primary mb-4"></i>
                        <h5 class="mb-3">Question Bank</h5>
                        <p>Access a vast collection of categorized questions with answers for effective exam practice and self-assessment.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- Company Activities Start -->
<div class="container-xxl py-5 category">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Activity</h6>
            <h1 class="mb-5">Company Activities</h1>
        </div>

        <!-- Activities Grid Start -->
        <div class="row g-4">
            @forelse($activities as $activity)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-lg rounded overflow-hidden hover-scale">
                    <!-- Activity Image -->
                    <div class="position-relative overflow-hidden">
                        <img src="{{ asset($activity->image ?? 'front-end-asset/fixed/default-activity.jpg') }}"
                            class="card-img-top img-fluid"
                            alt="{{ $activity->name ?? 'Activity' }}"
                            style="object-fit: cover; height: 250px;">
                        <!-- Optional Badge -->
                        <span class="position-absolute top-0 start-0 bg-primary text-white px-3 py-1 rounded-bottom-end">
                            {{ $activity->CourseCategory->name ?? 'General' }}
                        </span>
                    </div>

                    <!-- Activity Details -->
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $activity->name ?? 'Activity Title' }}</h5>
                        <p class="card-text text-muted">
                            {{ Str::limit($activity->sort_description, 120, '...') }}
                        </p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <a href="{{ route('home.course.show', $activity->id) }}" class="btn btn-outline-primary btn-sm">
                                View More
                            </a>
                            <span class="badge bg-success">{{ $activity->course_type ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <h5 class="text-muted">No activities found.</h5>
            </div>
            @endforelse
        </div>
        <!-- Activities Grid End -->

        <!-- Pagination -->
        @if($activities->hasPages())
        <div class="d-flex justify-content-center mt-5">
            <nav>
                {{ $activities->withQueryString()->onEachSide(1)->links() }}
            </nav>
        </div>
        @endif

    </div>
</div>
<!-- Company Activities End -->
@if (count($teachers)>0)
<!-- Team Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Instructors</h6>
            <h1 class="mb-5">Expert Instructor & Mentors</h1>
        </div>
        <div class="row g-4">
            @foreach ($teachers as $value)
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item bg-light">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="{{asset($value->image??'front-end-asset/fixed/default-teacher.png')}}" alt="" style="object-fit:cover; height:300px;">
                    </div>
                    <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                        <div class="bg-light d-flex justify-content-center pt-2 px-1">
                            <a class="btn btn-sm-square btn-primary mx-1" href="{{$value->fb_link??'#'}}"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-sm-square btn-primary mx-1" href="{{$value->ln_link??'#'}}"><i class="fab fa-linkedin"></i></a>
                            <a class="btn btn-sm-square btn-primary mx-1" href="{{$value->wp_link??'#'}}"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                    <div class="text-center p-4">
                        <h5 class="mb-0">{{$value->name??'Instructor Name'}}</h5>
                        <small>{{$value->designation??'Designation'}}</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Team End -->
@endif

<!-- Testimonial Start -->
@if(count($testimonials)>0)
<!-- Testimonial Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="text-center">
            <h6 class="section-title bg-white text-center text-primary px-3">Testimonial</h6>
            <h1 class="mb-5">Our Students Say!</h1>
        </div>
        <div class="owl-carousel testimonial-carousel position-relative">
            @foreach ($testimonials as $testimonial)
            <div class="testimonial-item text-center">
                <img class="border rounded-circle p-2 mx-auto mb-3" src="{{asset('/front-end-asset/img/student.png')}}" style="width: 80px; height: 80px;">
                <h5 class="mb-0">{{ $testimonial->name??'' }}e</h5>
                <div class="testimonial-text bg-light text-center p-4">
                    <p class="mb-0">{{$testimonial->message}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
<!-- Testimonial End -->
@endsection