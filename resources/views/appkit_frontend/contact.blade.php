@extends('appkit_frontend.layouts.main')
@section('content')
<?php
$ip = $_SERVER['REMOTE_ADDR'];
//dd($ip); // the IP address to query
$ip = '101.0.45.103';
$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
if($query && $query['status'] == 'success') {
  $countryCode = $query['countryCode'];
  $countryCodesmall =  strtolower($countryCode);
}
?>
<div class="contact-us-wrapper">
   <div class="container">
      <div class="row">
         <div class="col-md-6">
            <div class="getintouch-text">
               <h1 class="text-center">Get in touch</h1>
               <form name="captcha-contact-us" id="captcha-contact-us" method="post" action="{{route('contact_us_appkit')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group form-group-custome">
                     <input class="form-control" type="text" name="name" placeholder="Name" required>
                  </div>
                  <div class="form-group form-group-custome">
                     <input class="form-control" type="email" name="email" placeholder="Email" required>
                  </div>
                  <div class="form-group form-group-custome">
                  <input type="hidden" id="countryCode" data-country="{{$countryCodesmall}}" value="{{$countryCode}}">
                     <input id="country_selector" type="text" class="form-control" name="country">
                  </div>
                  <div class="form-group form-group-custome">
                     <textarea class="form-control area-text" type="text" name="msg" placeholder="Message" required></textarea>
                  </div>
                  <div class="form-group mt-4 mb-4">
                  <div class="captcha">
                  <span>{!! captcha_img() !!}</span>
                  <button type="button" class="btn btn-danger" class="reload" id="reload">
                  ↻
                  </button>
                  </div>
                  </div>
                  <div class="form-group mb-4">
                  <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
                  @error('captcha')
                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                  @enderror
                  </div>

                  <div class="btn-container mt-5 text-center buttonHolder">
                     <button type="submit" class="btn-color btn-style">Submit</button>
                  </div>

               </form>
            </div>
         </div>
         <div class="col-md-6">
            <div class="right-contact">
                <img class="right-img-contact" src="images/contact-us.jpg">
            </div>
         </div>
      </div>
   </div>
</div>
@endsection