@extends('appkit_frontend.layouts.main')
@section('content')
      <!-- banner-shopify start -->
      <div class="banner-shopify">
         <div class="container">
            <div class="row ">
               <div class="col-md-6">
                  <div class="shopifybannerleft">
                     <h1>CONVERT, ENGAGE AND SELL MORE ON MOBILE!</h1>
                     <p>Turn your Shopify store into a mobile app without any code or design skills. Increase conversion up to 5X with a fantastic shopping experience, fast checkout and push notifications.
                     </p>
                     <img class="soliboyimg_logo" src="images/Shopify-Logo.png" alt="Logo"/>
                     <div class="createappbtnbox">                        
                        <a href="{{ URL::to('buildapp') }}">Create an App</a>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="shopifybannerright">
                     <img class="sbrimg" src="images/shopifybannerright.png" alt="Logo"/>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- banner-shopify end -->
      <!-- our-shopify-mob start -->
      <div class="our-shopify-mob">
         <div class="container">
            <div class="row ">
               <div class="col-md-12">
                  <h2 class="ourshopititle">BOOST YOUR SALES!</h2>
                  <img class="buss-top-img" src="images/buss-top-img.png" alt="Logo"/>
               </div>
            </div>
            <div id="app-showcase1" class="app-showcase-main owl-carousel ourworkslider">
               <div class="slide-itm">
                  <div class="row ">
                     <div class="col-md-6">
                        <div class="our-shopify-mobleft">
                           <h3>MAKE BUYING EASY ON MOBILE</h3>
                           <p>Increase revenue with a faster checkout. 80% of eCommerce store traffic is on mobile and this is growing.
                               Push Notifications help bring customers back to your App.</p>
                           <div class="mobleftbox">
                              <a href="https://apps.apple.com/in/app/soleboy/id1579759164"><img class="appstoreimg" src="images/appstoreimg.png" alt="Logo"/></a>
                              <a href="#"><img class="appstoreimg" src="images/googleplayimg.png" alt="Logo"/></a>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="soliboyimgright">
                           <img class="soliboyimg" src="images/soliboyimg.png" alt="Logo"/>
                        </div>
                     </div>
                  </div>
               </div>
               
            </div>
			<div class="row slider2temprowtitle">
               <div class="col-md-12">
                  <h2 class="ourshopititle">Templates & Custom Designs</h2>
                  <img class="buss-top-img" src="images/buss-top-img.png" alt="Logo"/>
               </div>
            </div>
			<div id="app-showcase2" class="app-showcase-main owl-carousel ourworkslider slider2temp">
               <div class="slide-itm">
                  <div class="row ">
				     <div class="col-md-6">
                        <div class="soliboyimgright">
                           <img class="soliboyimg" src="images/rightndp.png" alt="Logo"/>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="our-shopify-mobleft">
                           <h3>Select a template or custom design
                           </h3>
                           <p>Choose from one of our Free template design or have our design team create you a custom design from scratch.
                           </p>
                           <div class="createappbtnbox">
                        <a href="{{ URL::to('buildapp') }}">Create an App</a>
                     </div>
                        </div>
                     </div>
                  </div>
               </div>
			   
               
              
            </div>
         </div>
      </div>
      <!-- our-shopify-mob end -->

      <!-- shopifycontact-us-wrapper start -->
      <div class="shopifycontact-us-wrapper testimonial-sec">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
               <div class="getintouch-text">
                  <h1 class="text-center">Get in touch</h1>
               <form method="post" action="{{route('shopifymail')}}" enctype="multipart/form-data" name="registration_form">
                  @csrf
				  <div class="row">
				     <div class="col-md-6">
					 <div class="form-group form-group-custome">
                        <input class="form-control" type="text" name="first_name" placeholder="First Name">
                     </div>
                     </div>
					 <div class="col-md-6">
					 <div class="form-group form-group-custome">
                        <input class="form-control" type="text" name="last_name" placeholder="Last Name">
                     </div>
                     </div>
					 <div class="col-md-6">
					 <div class="form-group form-group-custome">
                        <input class="form-control" type="text" name="business_name" placeholder="Business Name">
                     </div>
                     </div>
					 <div class="col-md-6">
					 <div class="form-group form-group-custome">
                        <input class="form-control" type="text" name="web_url" placeholder="Website URL">
                     </div>
                     </div>
					 <div class="col-md-6">
					 <div class="form-group form-group-custome">
                        <input class="form-control" type="email" name="email" placeholder="Email">
                     </div>
                     </div>
					 <div class="col-md-6">
					 <div class="form-group form-group-custome">
                        <input class="form-control" type="number" name="number" placeholder="Number">
                     </div>
                     </div>
					 <div class="col-md-12">
                  <div class="btn-container mt-5 text-center">
                     <input type="submit" class="btn-color btn-style shopify_submit" value="Send">
                  </div>
					</div>
					</div>
				  </form>
               </div>
               </div>
			   
               
            </div>
         </div>
      </div>
      <!-- shopifycontact-us-wrapper end -->



@endsection
