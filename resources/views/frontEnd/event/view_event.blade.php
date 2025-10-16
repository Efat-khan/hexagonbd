@extends('frontEnd.layouts.master')

@section('content')
<!-- Upcoming Event Section-->
@include('frontEnd.event.components.upcominEvent')
<!-- Event Details -->
@if($event->description)
@include('frontEnd.event.components.eventDetails')
@endif
<!-- our sponser-->

@endsection