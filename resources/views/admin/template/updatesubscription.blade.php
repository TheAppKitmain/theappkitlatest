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
 
                  <div class="pricing-box-myplan-wrapper">
                  <div class="pricing-box-myplan">
                           <h4>Current Plan</h4>
                     <div class="currentplan-box">
                     <div class="currentplan-box-inner">
                     <h6>@if($subs['plan']->currency =='gbp') £@else$ @endif{{number_format((float)$subs['plan']->amount/100, 2, '.', '')}} Every {{$subs['plan']->interval_count}} {{$subs['plan']->interval}}</h6>
                     <h6>Your plan renews on {{date('d,F, Y', strtotime($subs['next_payment']))}}.</h6>
                     </div>
                           </div>
                        </div>

                  <div class="pricing-box-myplan pricing-plan-current">
  
                     <div class="pricing-box-ch">
                     <div class="pricing-box-ch-inner rey">
                           <label for="planmonth" class="d-flex radio-planpayemnt">
                              <div class="bootom-total-price-left ">
                                 <!-- <h5 class="">Currency</h5> -->
                                 <h5 class="">Billing</h5>
                                 <h5 class="">Total Cost</h5>
                              </div>
                              <div class="bootom-total-price-right right-pric">
                                 @if($usercountry->country == 'United Kingdom')
                                 @if($plans_retrieve_3->id == $subs['plan']->id)
                                  <span class="mycurrentplan">Current plan</span>
                                  @else
                                  <a class="continue-link re" href="{{route('theme.update_subscription_single',[$template_id,$themetemplate->monthly_gbp])}}">continue</a>
                                 @endif
                                    <!-- <h6 class="h6_dy_currency">{{$plans_retrieve_3->currency}}</h6> -->
                                    <h6>Every {{$plans_retrieve_3->interval_count}} months</h6>
                                    <h6>@if($plans_retrieve_3->currency =='gbp') £@endif{{number_format((float)$plans_retrieve_3->amount/100, 2, '.', '')}}</h6>
                                 @else
                                    @if($plans_retrieve_3->id == $subs['plan']->id)
                                     <span class="mycurrentplan">Current plan</span>
                                     @else
                                     <a class="continue-link re" href="{{route('theme.update_subscription_single',[$template_id,$themetemplate->monthly_usd])}}">continue</a>
                                    @endif
                                    <!-- <h6 class="h6_dy_currency">{{$plans_retrieve_3->currency}}</h6> -->
                                    <h6>Every {{$plans_retrieve_3->interval_count}} months</h6>
                                    <h6>@if($plans_retrieve_3->currency =='usd') $@endif{{number_format((float)$plans_retrieve_3->amount/100, 2, '.', '')}}</h6>
                                 @endif
                              </div>
                           </label>
                           </div>
                     <div class="pricing-box-ch-inner mt-10">
                     <!-- <input id="planyear"  type="radio" data-currency="@if($usercountry->country == 'United Kingdom') £ @else $ @endif" data-price="{{number_format((float)$plans_retrieve_12->amount/100, 2, '.', '')}}" name="plan_id" value="@if($usercountry->country == 'United Kingdom'){{$themetemplate->yearly_gbp}}@else {{$themetemplate->yearly_usd}} @endif"> -->
                           <label for="planyear" class="d-flex radio-planpayemnt">
                              <div class="bootom-total-price-left">
                                 <!-- <h5 class="">Currency</h5> -->
                                 <h5 class="">Billing</h5>
                                 <h5 class="">Total Cost</h5>
                              </div>
                              <div class="bootom-total-price-right right-pric">
                                 @if($usercountry->country == 'United Kingdom')
                                 @if($plans_retrieve_12->id == $subs['plan']->id)
                                 <span class="mycurrentplan">Current plan</span>
                                 @else
                                 <a class="continue-link re" href="{{route('theme.update_subscription_single',[$template_id,$themetemplate->yearly_gbp])}}">continue</a>
                                 @endif
                                    <!-- <h6 class="h6_dy_currency">{{$plans_retrieve_12->currency}}</h6> -->
                                    <h6>{{$plans_retrieve_12->interval_count}} year</h6>
                                    <h6>@if($plans_retrieve_12->currency =='gbp') £@endif{{number_format((float)$plans_retrieve_12->amount/100, 2, '.', '')}}</h6>
                                 @else
                                 @if($plans_retrieve_12->id == $subs['plan']->id)
                                 <span class="mycurrentplan">Current plan</span>
                                 @else
                                 <a class="continue-link re" href="{{route('theme.update_subscription_single',[$template_id,$themetemplate->yearly_usd])}}">continue</a>
                                 @endif
                                    <!-- <h6 class="h6_dy_currency">{{$plans_retrieve_12->currency}}</h6> -->
                                    <h6>{{$plans_retrieve_12->interval_count}} year</h6>
                                    <h6>@if($plans_retrieve_12->currency !='gbp') $@endif{{number_format((float)$plans_retrieve_12->amount/100, 2, '.', '')}}</h6>
                                 @endif
                              </div>
                              
                           </label>
                           </div>
                        </div>

                  </div>   

                  <!-- <div class="pricing-box-myplan">
                           <h4>Billing history</h4>
                     <div class="d-flex biilinghistory-inner">
                                 <h6>{{date('d,F, Y', strtotime($subs['payment_start']))}} <a href="{{$subs['invoice']}}" target="_blank"> <i class="fa fa-download" aria-hidden="true"></i></a></h6>
                                 <h6>@if($subs['plan']->currency =='gbp') £@else$ @endif{{number_format((float)$subs['plan']->amount/100, 2, '.', '')}} Every {{$subs['plan']->interval_count}} {{$subs['plan']->interval}}</h6>
                           </div>
                        </div> -->
                        </div>
                     </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
@include('admin.template.partials.footer')