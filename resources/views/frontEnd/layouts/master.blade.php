@include('frontEnd.layouts.header')
@include('frontEnd.layouts.menue')

@yield('content')
<!-- All models -->
@include('frontEnd.layouts.models')
@include('sweetalert::alert')
@include('frontEnd.layouts.footer')