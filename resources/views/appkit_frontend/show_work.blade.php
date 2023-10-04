@extends('appkit_frontend.layouts.main')
@section('content')
<div class="app-showcase-sec playstoresec">
         <div class="container">
            <div class="row">
               <div class="col-md-12 text-center">
                  @if($our_work->app_type !== "Web") 
                     <a href="{{$our_work->app_links}}" target="_blank"><img class="btnandroid" src="{{asset('asset/images/app_store.png')}}"></a>
                     <a href="{{$our_work->app_android_link}}" target="_blank"><img class="btnandroid" src="{{asset('asset/images/play_store.png')}}"></a>
                  @else
                     <a href="{{$our_work->app_links}}" target="_blank"><img class="btnandroid" src="{{asset('asset/images/visitwebsite.png')}}"></a>
                  @endif
			   </div>
			   </div>
			   </div>
			   </div>
      <!-- app-showcase-sec -->
      <div class="app-showcase-sec">
         <img class="bnrph sun" src="{{asset('asset/images/bleach-left.png')}}">
         <div class="container">
            <div class="row">
               <div class="col-md-12"> 
                  <div id="app-showcase" class="app-showcase-main owl-carousel ourworkslider">                  
                     @foreach($our_work->img_arry as $work)              
                        <div class="slide-itm">
                           <div class="app-show">
                              <div class="">
                                 <img class="slhomvm" src="{{asset('media/'.$work)}}"alt="">
                              </div>
                           </div>
                        </div>                
                     @endforeach
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- app-showcase-sec -->
         <!-- testimonial-sec -->
      <div class="testimonial-sec testimonial-sec-main">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h2 class="color-white text-center ourclienttitle">Our Clients Review</h2>
                  <div id="testimonial" class="owl-carousel">
                     <div class="slide-itm">
                        <div class="testimonial-inner">
                           <img class="bgslider" src="{{asset('asset/images/bleach-left.png')}}">
                           <div class="row sliderow">
                              <div class="col-md-5">

                                 <div class="testuserimg app_logo_image">
                                    <img class="tstimgl" src="{{asset($our_work->app_logo)}}">
                                 </div>

                              </div>
                              <div class="col-md-7">
                                 <div class="textbx">
                                    <p>{{$our_work->app_reviews}}</p>
                                 </div>
                                 <h3>{{$our_work->client_name}}</h3>
                                 <h5>{{$our_work->client_designation}}</h5>
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
      <!-- testimonial-sec -->
@endsection
