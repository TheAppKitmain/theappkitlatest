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
         <div class="payment-wrapper">
            <div class="payment-wrapper-inner">
               <div class="container-fluid">
                  <div class="row">
                     
                     <div class="col-md-6 left-pay-col">
                
                        <!-- <h2 class="shpcarttitle">Template Detail</h2> -->
                     
                        <div class="leftchakoutcart">
                           <div class="item-wrapper-main">
                              <div class="item-wrapper-main-inner">
                                 <div id="themeprecard" class="carousel slide" data-ride="carousel">
                                    <div class="row">
                                       <div class="col-md-12">
                                          <!-- The slideshow -->
                                           <div class="carousel-inner append_img">
                                                   @php
                                                    $i = 0;
                                                   @endphp
                                                   @foreach($temp as $data)

                                                   <div class="carousel-item @if($i == 0) active @endif"><img src="{{ asset('media/'.$data) }}"></div>
                                                   @php
                                                    $i++;
                                                   @endphp
                                                   @endforeach

                                          </div>
                                          <!--  Left and right controls --> 
                                          <!-- <a class="carousel-control-prev" href="#themeprecard" data-slide="prev"> -->
                                          <!-- <span class="carousel-control-prev-icon"></span> -->
                                          <!-- </a> -->
                                          <!-- <a class="carousel-control-next" href="#themeprecard" data-slide="next"> -->
                                          <!-- <span class="carousel-control-next-icon"></span> -->
                                          <!-- </a> -->
                                       </div>
                                       <div class="col-md-12">
                                          <div class="theme-right-checkout">
                                             <h4 class="theme_name">E-Com-Theme1</h4>
                                             <p class="theme_details">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 p-r-0 payment-rightcol">
                <!-- <h2 class="shpcarttitle">Checkout</h2> -->
                <h2 class="billing-title-top">Billing</h2>
                     <div class="right-chk">
                  <div class="pricing-box-myplan cancel-plan-container">
                           <h4>Current Plan</h4>
                     <div class="currentplan-box">
                     <div class="currentplan-box-inner">
                     <h6>@if($subs['plan']->currency =='gbp') £@else$ @endif{{number_format((float)$subs['plan']->amount/100, 2, '.', '')}} Every {{$subs['plan']->interval_count}} {{$subs['plan']->interval}}</h6>
                     <h6>Your plan will be canceled, but is still available until the end of your billing period on {{date('d,F, Y', strtotime($subs['next_payment']))}}.</h6><br>
                     <h6>If you change your mind, you can renew your subscription.</h6>
                     
                     <div class="planbuttons">
                     	<form method="post" action="{{route('theme.cancel_subscription')}}">
                     		@csrf
                     		<input type="hidden" name="template_id" value="{{$template_id}}">
                     		<button class="cancel-plan-btn" type="submit">Cancel plan</button>
                     	</form>
                     <a class="update-plan-btn" href="{{route('theme.publish.index')}}">Go Back</a>
                     </div>
                     <p>By canceling your plan, you agree to Typographic's <b><a class="term-pp" href="#">Terms of Service and Privacy Policy</a></b>.</p>
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