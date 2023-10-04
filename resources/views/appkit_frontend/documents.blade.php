@extends('appkit_frontend.layouts.main')
@section('content')

<!-- solution-ecommerce start -->
<div class="banner solution-ecommerce">
         <div class="container">
            <div class="row ">
               <div class="col-md-7 left-banner-text">
                  <h1>All your files. All in one app</h1>
                  <p class="mt-3">Request documents from clients through your app. Allow clients to upload, access and manage their files all in one convenient place.
                  </p>
                  <div class="btn-container mt-5">
                     <a class="btn-color btn-style" href="{{ URL::to('buildapp') }}">Create an App</a>
                  </div>
               </div>
               <div class="col-md-5">
                  <div class="ecimg">
                        <img class="ecimg-inner" src="images/documentapp1.png">
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
						<h4>Upload secure documents, Images & Videos</h4>
						<p>Clients can instantly send and manage secure documents from their Mobile App.</p>
					    </div>
					 </div>
					 <div class="col-md-6">
						<div class="whatappinner">
						<h4>Schedule Meetings </h4>
						<p>Allow clients to book a meeting with you via your in app calendar.<br>
Accept Payments</p>
					    </div>
					 </div>
					  <div class="col-md-6">
						<div class="whatappinner">
						<h4>Accept Payments</h4>
						<p>Take a one time payment or place clients on a subscription service so you don’t have to worry about the hassle of collecting money.</p>
					    </div>
					 </div>
					  <div class="col-md-6">
						<div class="whatappinner">
						<h4>Instant Chat</h4>
						<p>With the built in messenger chat, you can respond instantly to client questions.</p>
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
                        <img class="rghtwhat" src="images/what2.png">
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
