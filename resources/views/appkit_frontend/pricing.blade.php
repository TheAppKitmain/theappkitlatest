@extends('appkit_frontend.layouts.main')

@section('content')<?php
$ip = $_SERVER['REMOTE_ADDR'];
   //dd($ip); // the IP address to query
//  $ip = '23.106.56.19';
   $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
   if($query && $query['status'] == 'success') {
    $countryCode = $query['countryCode'];
    $countryCodesmall =  strtolower($countryCode);
   }
   ?>
<!-- pricing-container start -->
<div class="pricing-wrapper">
   <div class="container">
      <div class="row ">
         <div class="col-md-12">
            <div class="pricing-container">
               <h2>Pricing Plans</h2>
               <div class="price-tabs">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Monthly</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Yearly</a>
                     </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                     <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row ">
                        <div class="col-md-4">
                              <div class="pricebox pricebox-custom">
                                 <div class="pricebox-top">
                                    <h3>Shopify Plan</h3>
                                    @if($countryCode == 'GB')
                                    <h4>£ 199 / mo</h4>
                                    @else
                                    <h4>$ 199 / mo</h4>
                                    @endif
                                   
                                 </div>
                                 <div class="pricebox-inner">
                                    <h5>Turn your Shopify website into an App</h5>
                                    <h4>What we offer</h4>
                                    <ul class="feturs-ul" >
                                       <li class=""> <img class="tick" src="images/tick1.png"> <img class="im" src="images/im2.png"> iOS App</li>
                                       <li class=""><img class="tick" src="images/tick1.png"> <img class="im" src="images/im1.png">  Android App</li>
                                      
                                    </ul>
                                    <h6 class="pricnew">
                                       
                                       <div class="cus-p"><img class="tick" src="images/tick1.png"> Launch a world-class mobile app for your Shopify store.</div>
                                       <br>
                                       <div class="cus-p"><img class="tick" src="images/tick1.png"> Enhance your mobile app with your custom fonts.</div>
                                       <br>
                                       <div class="cus-p"><img class="tick" src="images/tick1.png"> Automate your push notification campaigns.</div>
                                    </h6>
                                    <!-- <ul class="feturs-ul" >
                                       <li class=""><img class="tick" src="images/tick1.png"> <img class="im" src="images/im1.png">  Android App</li>
                                       <li class=""> <img class="tick" src="images/tick1.png"> <img class="im" src="images/im2.png"> iOS App</li>
                                       <li class=""><img class="tick" src="images/tick1.png"> <img class="im" src="images/im3.png">  Product Inventory Management</li>
                                       <li class=""><img class="tick" src="images/tick1.png"> <img class="im" src="images/im4.png"> Advanced Admin Panel</li>
                                       </ul> -->
                                    <div class="btn-container mt-5 price-btnbox">
                                       @if(Auth::check())
                                       <div class="btn-container mt-5 selectplan-btnbox">
                                          <a class="btn-color btn-style appkit_pricing" href="{{ URL::to('shopify_page') }}">Let's talk</a>
                                       </div>
                                       @else
                                       <form method ="GET" action="{{route('register')}}">
                                          <input type="hidden" id="name" name="name" value="shopify">
                                          <button type="submit" class="btn-color btn-style lt_tk appkit_pricing">Let's talk</button>
                                       </form>
                                       @endif
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="pricebox">
                                 <div class="pricebox-top">
                                    <h3>DIY Plan</h3>
                                    @if($countryCode == 'GB')
                                    <h4>£ 199 / mo</h4>
                                    @else
                                    <h4>$ 199 / mo</h4>
                                    @endif
                                 </div>
                                 <div class="pricebox-inner">
                                    <h5>Select a template and start customising your App </h5>
                                    <h4>Platform features</h4>
                                    <ul class="feturs-ul" >
                                       <li class=""> <img class="tick" src="images/tick1.png"> <img class="im" src="images/im2.png"> iOS App</li>
                                       <li class=""><img class="tick" src="images/tick1.png"> <img class="im" src="images/im1.png">  Android App</li>
                                       <li class=""><img class="tick" src="images/tick1.png"> Product Inventory Management</li>
                                       <li class=""><img class="tick" src="images/tick1.png"> Advanced Admin Panel</li>
                                       <li class=""><img class="tick" src="images/tick1.png"> Free Templates</li>
                                       <li class=""><img class="tick" src="images/tick1.png"> Push Notifications</li>
                                       <li class=""><img class="tick" src="images/tick1.png"> Payment Integration</li>
                                    </ul>
                                    <div class="btn-container mt-5 price-btnbox">
                                       <a class="btn-color btn-style" href="{{ URL::to('buildapp') }}">Start Now</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="pricebox pricebox-custom">
                                 <div class="pricebox-top">
                                    <h3>Custom Plan</h3>
                                    <h4>Let's Talk</h4>
                                 </div>
                                 <div class="pricebox-inner">
                                    <h5>Have our talent team build you a Custom App</h5>
                                    <h4>What we offer</h4>
                                    <ul class="feturs-ul" >
                                       <li class=""> <img class="tick" src="images/tick1.png"> <img class="im" src="images/im2.png"> iOS App</li>
                                       <li class=""><img class="tick" src="images/tick1.png"> <img class="im" src="images/im1.png">  Android App</li>
                                      
                                    </ul>
                                    <h6 class="pricnew">
                                       <div class="cus-p"><img class="tick" src="images/tick1.png"> Have a top-notch team aligned with your business goals bring your app to life</div>
                                       <br>
                                       <div class="cus-p"><img class="tick" src="images/tick1.png"> At every stage of the app lifecycle our team will drive your idea towards success</div>
                                       <br>
                                       <div class="cus-p"><img class="tick" src="images/tick1.png">Leverage our years of experience bringing thousands of apps to market</div>
                                    </h6>
                                    <!-- <ul class="feturs-ul" >
                                       <li class=""><img class="tick" src="images/tick1.png"> <img class="im" src="images/im1.png">  Android App</li>
                                       <li class=""> <img class="tick" src="images/tick1.png"> <img class="im" src="images/im2.png"> iOS App</li>
                                       <li class=""><img class="tick" src="images/tick1.png"> <img class="im" src="images/im3.png">  Product Inventory Management</li>
                                       <li class=""><img class="tick" src="images/tick1.png"> <img class="im" src="images/im4.png"> Advanced Admin Panel</li>
                                       </ul> -->
                                    <div class="btn-container mt-5 price-btnbox">
                                       @if(Auth::check())
                                       <div class="btn-container mt-5 selectplan-btnbox">
                                          <a class="btn-color btn-style appkit_pricing" href="{{ URL::to('home') }}">Let's talk</a>
                                       </div>
                                       @else
                                       <form method ="GET" action="{{route('register')}}">
                                          <input type="hidden" id="name" name="name" value="custom">
                                          <button type="submit" class="btn-color btn-style lt_tk appkit_pricing">Let's talk</button>
                                       </form>
                                       @endif
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row ">
                        <div class="col-md-4">
                              <div class="pricebox pricebox-custom">
                                 <div class="pricebox-top">
                                    <h3>Shopify Plan</h3>
                                    @if($countryCode == 'GB')
                                    <h4>£ 199 / mo</h4>
                                    @else
                                    <h4>$ 199 / mo</h4>
                                    @endif
                                 </div>
                                 <div class="pricebox-inner">
                                    <h5>Have our talent team build you a Custom App</h5>
                                    <h4>What we offer</h4>
                                    <ul class="feturs-ul" >
                                       <li class=""> <img class="tick" src="images/tick1.png"> <img class="im" src="images/im2.png"> iOS App</li>
                                       <li class=""><img class="tick" src="images/tick1.png"> <img class="im" src="images/im1.png">  Android App</li>
                                      
                                    </ul>
                                    <h6 class="pricnew">
                                       <div class="cus-p"><img class="tick" src="images/tick1.png"> Launch a world-class mobile app for your Shopify store.</div>
                                       <br>
                                       <div class="cus-p"><img class="tick" src="images/tick1.png"> Enhance your mobile app with your custom fonts.</div>
                                       <br>
                                       <div class="cus-p"><img class="tick" src="images/tick1.png"> Automate your push notification campaigns.</div>
                                    </h6>
                                    <!-- <ul class="feturs-ul" >
                                       <li class=""><img class="tick" src="images/tick1.png"> <img class="im" src="images/im1.png">  Android App</li>
                                       <li class=""> <img class="tick" src="images/tick1.png"> <img class="im" src="images/im2.png"> iOS App</li>
                                       <li class=""><img class="tick" src="images/tick1.png"> <img class="im" src="images/im3.png">  Product Inventory Management</li>
                                       <li class=""><img class="tick" src="images/tick1.png"> <img class="im" src="images/im4.png"> Advanced Admin Panel</li>
                                       </ul> -->
                                    <div class="btn-container mt-5 price-btnbox">
                                       @if(Auth::check())
                                       <div class="btn-container mt-5 selectplan-btnbox">
                                          <a class="btn-color btn-style appkit_pricing" href="{{ URL::to('shopify_page') }}">Let's talk</a>
                                       </div>
                                       @else
                                       <form method ="GET" action="{{route('register')}}">
                                          <input type="hidden" id="name" name="name" value="shopify">
                                          <button type="submit" class="btn-color btn-style lt_tk appkit_pricing">Let's talk</button>
                                       </form>
                                       @endif
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="pricebox">
                                 <div class="pricebox-top">
                                    <h3>DIY Plan</h3>
                                    @if($countryCode =='GB')
                                    <h4>£ 2189 / year billed annually</h4>
                                    @else
                                    <h4> $ 2739 / year billed annually</h4>
                                    @endif
                                 </div>
                                 <div class="pricebox-inner">
                                    <h5>Select templates and start customising your App</h5>
                                    <h4>Platform features</h4>
                                    <ul class="feturs-ul" >
                                       <li class=""> <img class="tick" src="images/tick1.png"> <img class="im" src="images/im2.png"> iOS App</li>
                                       <li class=""><img class="tick" src="images/tick1.png"> <img class="im" src="images/im1.png">  Android App</li>
                                       <li class=""><img class="tick" src="images/tick1.png"> Product Inventory Management</li>
                                       <li class=""><img class="tick" src="images/tick1.png"> Advanced Admin Panel</li>
                                       <li class=""><img class="tick" src="images/tick1.png"> Free Templates</li>
                                       <li class=""><img class="tick" src="images/tick1.png"> Push Notifications</li>
                                       <li class=""><img class="tick" src="images/tick1.png"> Payment Integration</li>
                                    </ul>
                                    <div class="btn-container mt-5 price-btnbox">
                                       <a class="btn-color btn-style" href="{{ URL::to('buildapp') }}">Start Now</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="pricebox pricebox-custom">
                                 <div class="pricebox-top">
                                    <h3>Custom Plan</h3>
                                    <h4>Let's Talk</h4>
                                 </div>
                                 <div class="pricebox-inner">
                                    <h5>Have our talent team build you a Custom App</h5>
                                    <h4>What we offer</h4>
                                    <ul class="feturs-ul" >
                                       <li class=""> <img class="tick" src="images/tick1.png"> <img class="im" src="images/im2.png"> iOS App</li>
                                       <li class=""><img class="tick" src="images/tick1.png"> <img class="im" src="images/im1.png">  Android App</li>                                     
                                    </ul>
                                    <h6 class="pricnew">
                                       <div class="cus-p"><img class="tick" src="images/tick1.png"> Have a top-notch team aligned with your business goals bring your app to life</div>
                                       <br>
                                       <div class="cus-p"><img class="tick" src="images/tick1.png"> At every stage of the app lifecycle our team will drive your idea towards success</div>
                                       <br>
                                       <div class="cus-p"><img class="tick" src="images/tick1.png"> Leverage our years of experience bringing thousands of apps to market</div>
                                    </h6>
                                    <div class="btn-container mt-5 price-btnbox">
                                       @if(Auth::check())
                                       <div class="btn-container mt-5 selectplan-btnbox">
                                          <a class="btn-color btn-style appkit_pricing" href="{{ URL::to('home') }}">Let's talk</a>
                                       </div>
                                       @else
                                       <form method ="GET" action="{{route('register')}}">
                                          <input type="hidden" id="name" name="name" value="custom">
                                          <button type="submit" class="btn-color btn-style lt_tk appkit_pricing">Let's talk</button>
                                       </form>
                                       @endif
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
@endsection