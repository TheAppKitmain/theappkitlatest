@extends('appkit_frontend.layouts.main')
@section('content')

      <div class="row">
               <div class="col-md-12" class="error_handling">
                  @if(Session::get('alert'))
                        <div class="alert alert-{{Session::get('alert')}} alert-dismissible" role="alert">
                           <p>{{Session::get('message')}} </p>
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               </div>
                     @endif
               </div>
      </div>
      <!-- header end -->
      <!-- banner start -->
      <div class="banner">
         <div class="container">
            <div class="row ">
               <div class="col-md-7 left-banner-text">
                  <h1> Turn your App idea into a reality!</h1>
                  <p class="mt-3">   Reach millions of customers instantly with a Mobile App
                     for your business. Whether you have an Online Store,
                     Restaurant / takeaway or an App in the business sector,
                     we can turn that idea into reality!
                  </p>
                  <div class="btn-container mt-5">
                     <a class="btn-color btn-style" href="{{ URL::to('buildapp') }}">Create an App</a>
                  </div>
               </div>
               <div class="col-md-5">
                  <div class="video-box-banner">
                     <div class="video-box-container">
                        <img class="bnrph" src="images/banner-right-bg.png">
                        <div class="video-box-right">
                           <video  width="235" height="536" loop autoplay muted controls id="vid">
                              <source src="videos/IMG_5279.mp4" type="video/mp4">
                              <source src="videos/IMG_5279.ogg" type="video/ogg">
                           </video>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- banner end -->
      <!-- app-showcase-sec -->
      <div class="app-showcase-sec">
	  <img class="bnrph sun" src="images/bleach-left.png">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div id="app-showcase" class="app-showcase-main owl-carousel">
                     <div class="slide-itm">
                        <div class="app-show">
						<img class="appfrm" src="images/mdlimg.png"alt="">
                        <div class="app-video">
                        <video width="340" height="663" loop autoplay muted controls id="vid2">
                              <source src="videos/IMG_5255.mp4" type="video/mp4">
                              <source src="videos/IMG_5255.ogg" type="video/ogg">
                        </video>
                        </div>
                        </div>
                     </div>
                     <div class="slide-itm">
                        <div class="app-show">
						<img class="appfrm" src="images/mdlimg.png"alt="">
                        <div class="app-video">
                        <video width="340" height="663" loop autoplay muted controls id="vid3">
                              <source src="videos/IMG_5257.mp4" type="video/mp4">
                              <source src="videos/IMG_5257.ogg" type="video/ogg">
                        </video>
                        </div>
                        </div>
                     </div>
                     <div class="slide-itm">
                        <div class="app-show">
						<img class="appfrm" src="images/mdlimg.png"alt="">
                        <div class="app-video">
                        <video width="340" height="663" loop autoplay muted controls id="vid4">
                              <source src="videos/IMG_5258.mp4" type="video/mp4">
                              <source src="videos/IMG_5258.ogg" type="video/ogg">
                        </video>
                        </div>
                        </div>
                     </div>
                     <div class="slide-itm">
                        <div class="app-show">
						<img class="appfrm" src="images/mdlimg.png"alt="">
                        <div class="app-video">
                        <video width="340" height="663" loop autoplay muted controls id="vid5">
                              <source src="videos/IMG_5256.mp4" type="video/mp4">
                              <source src="videos/IMG_5256.ogg" type="video/ogg">
                        </video>
                        </div>
                        </div>
                     </div>
                     <div class="slide-itm">
                        <div class="app-show">
						<img class="appfrm" src="images/mdlimg.png"alt="">
                        <div class="app-video">
                        <video width="340" height="663" loop autoplay muted controls id="vid6">
                              <source src="videos/IMG_5258.mp4" type="video/mp4">
                              <source src="videos/IMG_5258.ogg" type="video/ogg">
                        </video>
                        </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- app-showcase-sec -->
	  <!-- onlinestore start -->
      <div class="onlinestore">
         <div class="container-fluid p-0">
            <div class="row no-gutters justify-c">
               <div class="col-md-6 left-onlinestore-text">
                  <h2>Start an Online Store <br> in minutes</h2><br>
                  <h4>Grow your business with a Mobile App that is always on your customers fingertips. Cultivate brand loyalty with special in-app discounts.</h4>

                  <p class="mt-3">Select a template and start adding in <br>your products.
                  </p>
                  <div class="btn-container mt-5">

                   
                     <a class="btn-color btn-style" href="{{ URL::to('themes') }}">Start Now</a>
               

                  </div>
               </div>
               <div class="col-md-6 right-onlinestore-text">
                  <div class="onlinestore-box-banner">
                     <div class="onlinestore-box-container">
                        <img class="onlinestoreimg" src="images/onlinestore-right-image.png"alt="">
                        <div class="onlinestore-box-right">
                           <video width="240" height="435" loop autoplay muted controls id="vid7">
                              <source src="videos/IMG_1718.mp4" type="video/mp4">
                              <source src="videos/IMG_1718.ogg" type="video/ogg">
                           </video>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- onlinestore end -->
	  <!-- createapp start -->
      <div class="createapp">
	  <img class="createapp-lftimg" src="images/bleach.png">
         <div class="container-fluid p-0">
            <div class="row no-gutters justify-c">
               <div class="col-md-6 left-reateapp">
                  <div class="onlinestore-box-banner">
                        <img class="ocrpimg" src="images/team.jpg"alt="">


                  </div>
               </div>
			    <div class="col-md-6 left-onlinestore-text">
                  <h2>Want us to create<br> the App for you?</h2>
                  <p class="mt-3">Have our talented design and development<br> team build you a custom App for your<br>  business.</p>
                  <div class="btn-container mt-5">
                     <!-- <a class="btn-color btn-style" href="#">Let’s talk!</a> -->
                     <form method ="GET" action="{{route('register')}}">
                            <input type="hidden" id="name" name="name" value="custom">
                           <!--  <button type="submit" class="btn-color btn-style lt_tk">Let's talk</button> -->
                            <a href="javascript:void(Tawk_API.toggle())" class="btn-color btn-style lt_tk">Let's talk</a>
                     </form>
                  </div>
               </div>
            </div>
         </div>
		 <img class="createapp-rytimg" src="images/bleach.png">
      </div>
      <!-- createapp end -->
	  <!-- testimonial-sec -->
      <div class="testimonial-sec">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div id="testimonial" class="owl-carousel">
                     <div class="slide-itm">
					    <div class="testimonial-inner">
                        <img class="bgslider" src="images/bgslider.png">
						<div class="row sliderow">
							<div class="col-md-5">
							<div class="testuserimg">
							   <img class="tstimgl" src="images/textimg.png">
							</div>
							</div>
							<div class="col-md-7">
							<div class="textbx">
							<p>The App kit was the best decision I made. Very kind and honest very reasonable and they walk you through the whole process.
						    </p>
							</div>
							<h3>Shante Robinson</h3>
							<h5>CEO/Credit Specialist</h5>
							</div>
						</div>
                        </div>
                     </div>
					 <!-- <div class="slide-itm">
					    <div class="testimonial-inner">
                        <img class="bgslider" src="images/bgslider.png">
						<div class="row sliderow">
							<div class="col-md-5">
							<div class="testuserimg">
							   <img class="tstimgl" src="images/textimg1.png">
							</div>
							</div>
							<div class="col-md-7">
							<div class="textbx">
							<p>Lorem ipsum dolor sit amet, consectetur
								adipiscing elit. Duis rhoncus dictum nisl, non
								faucibus lacus consectetur bibendum. Praesent
								quis sapien vel lectus tempus mollis.
						    </p>
							</div>
							<h3>John Doe</h3>
							<h5>CEO | Altis PVT Ltd.</h5>
							</div>
						</div>
                        </div>
                     </div> -->
					 <div class="slide-itm">
					    <div class="testimonial-inner">
                        <img class="bgslider" src="images/bgslider.png">
						<div class="row sliderow">
							<div class="col-md-5">
							<div class="testuserimg">
							   <img class="tstimgl" src="images/textimg2.png">
							</div>
							</div>
							<div class="col-md-7">
							<div class="textbx">
							<p>When we worked with The App Kit things were really smooth right from the jump. The process was really seamless. Not only do they have a great team, but they have exceptional customer support overall professionalism and service. We had very good success with them in terms of understanding the requirements. Everything was delivered perfectly and did an amazing job of bringing my ideas to life. They’re an efficient and professional company. Anyone who works with them will be happy with the results.
						    </p>
							</div>
							<h3>Cesiah Lopez</h3>
							<h5>CEO | Vamos </h5>
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
	  <!-- getstartapp start -->
      <div class="getstartapp">
         <div class="container-fluid p-0">
            <div class="row no-gutters justify-c">
			   <div class="col-md-6 left-onlinestore-text">
                   <h2 class="letsh">Let’s get<br> started!</h2>
                  <div class="btn-container mt-5">
                     <!-- <a class="btn-color btn-style" href="#">Let’s talk!</a> -->
                     <form method ="GET" action="{{route('register')}}">
                            <input type="hidden" id="name" name="name" value="custom">
                               <a href="javascript:void(Tawk_API.toggle())" class="btn-color btn-style lt_tk">Let's talk</a>
                     </form>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="getstartapp-img">
                        <img class="mobshow" src="images/letsstart-imgright.png"alt="">
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- getstartapp end -->
      <!-- footer start-->
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/60055d69c31c9117cb6fb561/1esaf9pl3';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

      <!-- footer end -->
      @endsection
