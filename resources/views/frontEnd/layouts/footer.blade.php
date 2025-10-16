@php
$layout_setting=App\Models\LandingPage::first();
@endphp
<!-- footer -->
<div id="footer-widgets" class="footer-widgets widgets-area">

    <div class="contact-widget">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="footer-contact clearfix">
                        <div id="text-7" class="widget widget_text">
                            <div class="textwidget">
                                <a href="{{route('home')}}" class="footer-logo">
                                    <img src="{{asset($layout_setting->logo_image??'')}}" alt="logo-light" class="logo-footer" width="100px" />
                                </a>
                            </div>
                        </div>
                        <div id="text-4" class="widget widget_text">
                            <div class="textwidget"><i class="factory-technology"></i>
                                <h4>Have a Questions? Call Us</h4>
                                <p class="number">+(88) {{$layout_setting->phone??''}}</p>
                            </div>
                        </div>
                        <div id="text-6" class="widget widget_text">
                            <div class="textwidget"><i class="factory-travel"></i>
                                <h4>Visit Our Company at</h4>
                                <p>{{$layout_setting->location??'N/A'}}</p>
                            </div>
                        </div>
                        <div id="text-5" class="widget widget_text">
                            <div class="textwidget"><i class="factory-wall-clock"></i>
                                <h4>We are Working Between</h4>
                                <p>{{$layout_setting->office_time_text??'N/A'}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-sidebars">
        <div class="container">
            <div class="row">

                <div class="footer-sidebar footer-1 col-xs-12 col-sm-6 col-md-4">
                    <div id="text-2" class="widget widget_text">
                        <h4 class="widget-title">About</h4>
                        <div class="textwidget">
                            <p class="linhgt2">
                                {{$layout_setting->about_sort_description??''}}
                            </p>
                            <ul class="footer-widget-socials">
                                @if ($layout_setting && $layout_setting->fb_link)
                                <li><a href="{{$layout_setting->fb_link??''}}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                @endif
                                @if ($layout_setting && $layout_setting->in_link)
                                <li><a href="{{$layout_setting->in_link??''}}"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                @endif
                                @if ($layout_setting && $layout_setting->x_link)
                                <li><a href="{{$layout_setting->x_link??''}}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="footer-sidebar footer-2 col-xs-12 col-sm-6 col-md-4">
                    <div id="nav_menu-2" class="widget widget_nav_menu">
                        <h4 class="widget-title">Quick Link</h4>
                        <div class="menu-service-menu-container">
                            <ul id="menu-service-menu" class="menu">
                                    <li class=""><a href="{{route('home')}}">Home</a>
                                </li>
                                <li class=""><a href="{{route('home.project.all')}}">Projects</a>
                                </li>
                                <li class=""><a href="{{route('home.client')}}">Our Clients</a>
                                </li>
                                <li class=""><a href="{{route('home.gallery.view')}}">Gallery</a>
                                </li>

                                <li class="">
                                    <a href="{{route('home.about')}}" >About Us</a>
                                </li>
                                <li class="">
                                    <a href="{{route('home.contact.view')}}">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="footer-sidebar footer-3 col-xs-12 col-sm-6 col-md-4">
                    <div id="latest-project-widget-2" class="widget latest-project-widget">
                        <h4 class="widget-title">Location</h4>
                        <div class="latest-project-list clearfix">
                            <div class="row g-2 pt-2">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d14605.75087917938!2d90.42148339681451!3d23.767422417075036!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1s31%2Fa%20l-block%20aftab%20nagar%20dhaka-1212!5e0!3m2!1sen!2sbd!4v1758918338988!5m2!1sen!2sbd" width="600" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<!-- footer end -->

<!-- copyright-->
<footer id="colophon" class="site-footer">
    <div class="container">
        <div class="row">
            <div class="footer-copyright col-md-6 col-sm-12 col-sx-12">
                <div class="site-info">
                    © {{ $layout_setting->web_title??'' }} , All Right Reserved. </div>
            </div>
            <div class="footer-text col-md-6 col-sm-12 col-xs-12 text-right">
                <a href="{{ $layout_setting->developer_link??'https://www.linkedin.com/in/efat-khan/' }}">Developed By Efat Khan</a>
            </div>
        </div>
    </div>
</footer>
<!-- copyright end -->

</div>
</div>
<!--End pagewrapper-->

<!--primary-mobile-nav-->
<div class="primary-mobile-nav header-v1" id="primary-mobile-nav" role="navigation">
    <a href="#" class="close-canvas-mobile-panel">×</a>
    <ul id="primary-menu2" class="menu">
        <li class="current-menu-item"><a href="{{route('home')}}">Home</a>
        </li>
        <li class="dropdown-item menu-item-has-children"><a href="{{route('home.project.all')}}">Projects</a>
        </li>
        <li class="current-menu-item"><a href="{{route('home.client')}}">Our Clients</a>
        </li>
        <li class="current-menu-item"><a href="{{route('home.gallery.view')}}">Gallery</a>
        </li>

        <li class="extra-menu-item menu-item-button-link">
            <a href="{{route('home.about')}}" class="fp-btn btn">About Us</a>
        </li>
        <li class="extra-menu-item menu-item-button-link">
            <a href="{{route('home.contact.view')}}" class="fp-btn btn">Contact Us</a>
        </li>
    </ul>

</div>
<div id="off-canvas-layer" class="off-canvas-layer"></div>
<!--primary-mobile-nav end-->

<!--Scroll to top-->
<a id="scroll-top" class="backtotop" href="#page-top">
    <i class="fa fa-angle-up"></i>
</a>

<!-- jquery Liabrary -->
<script src="{{asset('front-end-asset/js/jquery-1.12.4.min.js')}}"></script>
<!-- bootstrap v3.3.6 js -->
<script src="{{asset('front-end-asset/js/bootstrap.min.js')}}"></script>
<!-- fancybox js -->
<script src="{{asset('front-end-asset/js/jquery.fancybox.pack.js')}}"></script>
<script src="{{asset('front-end-asset/js/jquery.fancybox-media.js')}}"></script>
<!-- owl.carousel js -->
<script src="{{asset('front-end-asset/js/owl.js')}}"></script>
<!-- counter js -->
<script src="{{asset('front-end-asset/js/jquery.appear.js')}}"></script>
<script src="{{asset('front-end-asset/js/jquery.countTo.js')}}"></script>
<!-- isotop js -->
<script src="{{asset('front-end-asset/js/isotope.pkgd.min.js')}}"></script>
<!-- validate js -->
<script src="{{asset('front-end-asset/js/validate.js')}}"></script>
<!-- switcher js -->
<script src="{{asset('front-end-asset/js/switcher.js')}}"></script>

<!-- REVOLUTION JS FILES -->
<script type="text/javascript" src="{{asset('front-end-asset/js/revolution/jquery.themepunch.tools.min.js')}}"></script>
<script type="text/javascript" src="{{asset('front-end-asset/js/revolution/jquery.themepunch.revolution.min.js')}}"></script>
<script type="text/javascript" src="{{asset('front-end-asset/js/revolution/extensions/revolution.extension.actions.min.js')}}"></script>
<script type="text/javascript" src="{{asset('front-end-asset/js/revolution/extensions/revolution.extension.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{asset('front-end-asset/js/revolution/extensions/revolution.extension.kenburn.min.js')}}"></script>
<script type="text/javascript" src="{{asset('front-end-asset/js/revolution/extensions/revolution.extension.layeranimation.min.js')}}"></script>
<script type="text/javascript" src="{{asset('front-end-asset/js/revolution/extensions/revolution.extension.migration.min.js')}}"></script>
<script type="text/javascript" src="{{asset('front-end-asset/js/revolution/extensions/revolution.extension.navigation.min.js')}}"></script>
<script type="text/javascript" src="{{asset('front-end-asset/js/revolution/extensions/revolution.extension.parallax.min.js')}}"></script>
<script type="text/javascript" src="{{asset('front-end-asset/js/revolution/extensions/revolution.extension.slideanims.min.js')}}"></script>
<script type="text/javascript" src="{{asset('front-end-asset/js/revolution/extensions/revolution.extension.video.min.js')}}"></script>

<!-- script JS  -->
<script src="{{asset('front-end-asset/js/scripts.min.js')}}"></script>
<script src="{{asset('front-end-asset/js/script.js')}}"></script>
</body>



</html>