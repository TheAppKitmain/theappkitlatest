@include('admin.template.partials.head')
@include('admin.template.partials.header')

<?php $theme_code = session('theme_code'); 

if($theme_code == 'yummy-restuarant_5ELQQ8'){
?>
   @include('admin.template.Food_Delivery.partials.sidemenu')
<?php
}
elseif($theme_code == 'car-wash_13MZEO'){
?>   
@include('admin.template.Booking.partials.sidemenu')
<?php
}
else{
?>   
   @include('admin.template.partials.sidemenu')
<?php   
} 
?>




<div class="main-home">
<div class="maininnerallpagescontainer">
   <div class="main-container mainpageappstore">
      <div class="main-container-inner">
         <div class="container-fluid">
            <div class="row clearfix">
            <div class="col-md-12">
            <div class="mt-20">
            <div class="card-header mb-20">
               <h2>Payment Information</h2>
            </div>
            <h2 class="add_title mt-10 main-title-top">Select the payment methods you wish to receive payments</h2> 
            <ul class="nav nav-tabs customnvtab mt-20 paymentdetails-ul template_payment_detail" id="myTab" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" required><i class="fa fa-cc-stripe" aria-hidden="true"></i> Stripe</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" required><i class="fa fa-cc-paypal" aria-hidden="true"></i> PayPal</a>
               </li>

               <li class="nav-item">
                  <a class="nav-link" id="apple-tab" data-toggle="tab" href="#apple_pay" role="tab" aria-controls="apple_pay" aria-selected="false" required><i class="fa fa-apple" aria-hidden="true"></i> Apple pay</a>
               </li>
            </ul>
            <div class="tab-content custom-tab-content" id="myTabContent">
               <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
               <div class="card-body">
               
               Please create a Stripe account to start accepting payments with the following cards:
               
               <ul class="template-card-list">
                  <li>VISA</li>
                  <li>VISA Debit</li>
                  <li>MasterCard</li>
                  <li>Discover</li>
                  <li>JCB</li>
                  <li>American Express</li>
               </ul>

               <ul class="follow-step">
               <li>1) Go to - www.stripe.com</li>

               <li>2) Register as a new account</li>

               <li>3) Click settings</li>

               <li>4) Click teams</li>

               <li>5) Add New Member</li>

               <li>6) Select Developer and add our email documents@theappkit.co.uk</li>

               <li>Note - If you have any question, please email support@theappkit.co.uk</li>
            </ul>
            </div>


               </div>
               <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
               <div class="card-body">
              
               
               
               </div>


               </div>

               <div class="tab-pane fade" id="apple_pay" role="apple_pay" aria-labelledby="profile-tab">
               <div class="card-body">
             
               
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
@include('admin.template.partials.footer')