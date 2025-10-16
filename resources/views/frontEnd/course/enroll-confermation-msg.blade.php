@extends('frontEnd.layouts.master')

@section('content')
  <div class="container text-center" style="margin-top: 13%; margin-bottom: 13%;">
    <h2 class="text-success">Payment Successful!</h2>
    <p>Thank you <strong class="text-success">{{$order['student']->full_name}}</strong> for your payment. Your transaction has been successfully completed.</p>
    <p>We will contact you soon on your email and phone number. Save the Enroll Id for track yor course order.</p>
    <strong class="text-success">Enroll Id: {{$order->order_tracking_id}}</strong>
  </div>
@endsection