@extends('appkit_frontend.layouts.main')
@section('content')

<!-- solution-ecommerce start -->
<div class="banner solution-ecommerce">
         <div class="container">
            <div class="row ">
               <div class="col-md-7 left-banner-text">
                  <h1> Build The Ultimate Ecommerce App For Your Business</h1>
                  <p class="mt-3">Generate 55% more revenue per customer with a mobile app for your online business
                  </p>
                  <div class="btn-container mt-5">
                     <a class="btn-color btn-style" href="{{ URL::to('buildapp') }}">Create an App</a>
                  </div>
               </div>
               <div class="col-md-5">
                  <div class="ecimg">
                        <img class="ecimg-inner" src="images/img-ec.png">
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
						<h4>Product Inventory Management</h4>
						<p>Easily enter your products, sizes and  prices into your management system. Already have a Shopify store? Enter your credentials to instantly import your product catalog.</p>
					    </div>
					 </div>
					 <div class="col-md-6">
						<div class="whatappinner">
						<h4>Group and Categorize All Your Products</h4>
						<p>We make it easy to create any custom product categories or import your existing ones.</p>
					    </div>
					 </div>
					  <div class="col-md-6">
						<div class="whatappinner">
						<h4>Powerful Search</h4>
						<p>Make product discovery easy and help shoppers find exactly what they are looking for.</p>
					    </div>
					 </div>
					  <div class="col-md-6">
						<div class="whatappinner">
						<h4>Match Your Brand With a Fully Custom Look and Feel</h4>
						<p>With our extensive branding and layout options, you'll be able to find the perfect fit for your brand.</p>
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
                        <img class="rghtwhat" src="images/what1.png">
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
