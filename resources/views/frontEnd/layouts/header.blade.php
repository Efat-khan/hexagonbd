@php
$layout_setting = \App\Models\LandingPage::first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{$layout_setting->web_title??'Hexagon Engineering Ltd.'}}</title>
    <!-- Stylesheets -->
    <!-- bootstrap v3.3.6 css -->
    <link href="{{asset('/front-end-asset/css/bootstrap.css')}}" rel="stylesheet">
    <!-- font-awesome css -->
    <link href="{{asset('/front-end-asset/css/font-awesome.css')}}" rel="stylesheet">
    <!-- flaticon css -->
    <link href="{{asset('/front-end-asset/css/flaticon.css')}}" rel="stylesheet">
    <!-- factoryplus-icons css -->
    <link href="{{asset('/front-end-asset/css/factoryplus-icons.css')}}" rel="stylesheet">
    <!-- animate css -->
    <link href="{{asset('/front-end-asset/css/animate.css')}}" rel="stylesheet">
    <!-- owl.carousel css -->
    <link href="{{asset('/front-end-asset/css/owl.css')}}" rel="stylesheet">
    <!-- fancybox css -->
    <link href="{{asset('/front-end-asset/css/jquery.fancybox.css')}}" rel="stylesheet">
    <link href="{{asset('/front-end-asset/css/hover.css')}}" rel="stylesheet">
    <link href="{{asset('/front-end-asset/css/frontend.css')}}" rel="stylesheet">
    <link href="{{asset('/front-end-asset/css/style.css')}}" rel="stylesheet">
    <!-- switcher css -->
    <link href="{{asset('/front-end-asset/css/switcher.css')}}" rel="stylesheet">
    <link id="factoryplus-color-switcher-css" href="{{asset('/front-end-asset/css/color/default.css')}}" rel="stylesheet">
    <!-- revolution slider css -->
    <link rel="stylesheet" type="text/css" href="{{asset('/front-end-asset/css/revolution/settings.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/front-end-asset/css/revolution/layers.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/front-end-asset/css/revolution/navigation.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!--Favicon-->
    <link rel="shortcut icon" href="{{asset($layout_setting->logo_image??'')}}" type="image/x-icon">
    <link rel="icon" href="{{asset($layout_setting->logo_image??'')}}" type="image/x-icon">
    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('front-end-asset/css/responsive.css')}}" rel="stylesheet">
    <!-- Toaster message -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        .colored-toast.swal2-icon-success {
            background-color: #a5dc86 !important;
        }

        .colored-toast.swal2-icon-error {
            background-color: #f27474 !important;
        }

        .colored-toast.swal2-icon-warning {
            background-color: #f8bb86 !important;
        }

        .colored-toast.swal2-icon-info {
            background-color: #3fc3ee !important;
        }

        .colored-toast.swal2-icon-question {
            background-color: #87adbd !important;
        }

        .colored-toast .swal2-title {
            color: white;
        }

        .colored-toast .swal2-close {
            color: white;
        }

        .colored-toast .swal2-html-container {
            color: white;
        }
    </style>
</head>

<body class="header-sticky page-template  page-homepage  home-header-v1 blog-classic topbar-v1 footer-v1 hide-topbar-mobile">
    <div id="page" class="site">
        <!-- Preloader -->
        <div class="preloader"></div>