@extends('appkit_frontend.layouts.main')
@section('content')

<!-- solution-ecommerce start -->
<div class="banner solution-ecommerce">
         <div class="container">
            <div class="row ">
               <div class="col-md-7 left-banner-text">
                  <h1> Build The Ultimate Bookings App For Your Business</h1>
                  <p class="mt-3">A complete bookings platform to accept payments for your business
                  </p>
                  <div class="btn-container mt-5">
                     <a class="btn-color btn-style" href="{{ URL::to('buildapp') }}">Create an App</a>
                  </div>
               </div>
               <div class="col-md-5">
                  <div class="ecimg">
                        <img class="ecimg-inner" src="images/what11.png">
                  </div>
               </div>
            </div>
         </div>
</div>
      <!-- solution-ecommerce end -->
      <!-- inside-app start -->
      <div class="inside-app">
         <div class="container">
            <div class="row ">
               <div class="col-md-7 left-inside-app">
                  <h2> What's Inside The App</h2>
                  <div class="row">
                     <div class="col-md-6">
						<div class="whatappinner">
						<h4>Accept Online Bookings 24/7</h4>
						<p>Keep your booking channels open 24/7 and let your clients book their appointments on your App.</p>
					    </div>
					 </div>
					 <div class="col-md-6">
						<div class="whatappinner">
						<h4>Membership, Classes, Events or Tickets?</h4>
						<p>If you sell membership subscriptions to your clients, offer classes and events or want to issue tickets for your sessions we have got you covered!</p>
					    </div>
					 </div>
					  <div class="col-md-6">
						<div class="whatappinner">
						<h4>Reduce no shows & Double bookings</h4>
						<p>Send tailored reminders before scheduled appointments. Eliminate last-minute cancellations by charging a deposit upfront. Avoid double booking your time by synchronising your personal calendar with your online booking schedule.</p>
					    </div>
					 </div>
					  <div class="col-md-6">
						<div class="whatappinner">
						<h4>Client information upon booking</h4>
						<p>Create customised intake forms to gather client information during the booking process. You can request texts & digits, checkbox, drop-down or date responses.</p>
					    </div>
					 </div>
					 <div class="col-md-12">
					 <div class="btn-container mt-5 what-btn-box">
                     <a class="btn-color btn-style" href="{{ URL::to('buildapp') }}">Get Started</a>
                     </div>
					 </div>
                  </div>
               </div>
               <div class="col-md-5">
                  <div class="ecimg">
                        <img class="rghtwhat" src="images/what4.png">
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- inside-app end -->
	  <!-- inside-app start -->
      <div class="inside-app maximize-app">
         <div class="container">
            <div class="row ">
			   <div class="col-md-6">
                  <div class="ecimg">
                        <img class="rghtwhat" src="images/letsstart-imgright.png">
                  </div>
               </div>
               <div class="col-md-6 left-inside-app">
						<div class="whatappinner">
						<h4>Maximize Customer Engagement With Push Notifications</h4>
						<p>Push notifications are the ultimate tool to run promotions and generate additional sales by making sure your message is read. Customers are 10x more likely to read a Push Notification over a promotional email.</p>
					    </div>					 
					 <div class="btn-container mt-5 what-btn-box">
                     <a class="btn-color btn-style" href="{{ URL::to('buildapp') }}">Get Started</a>
                     </div>
               </div>
               
            </div>
         </div>
      </div>
      <!-- inside-app end -->

@endsection
