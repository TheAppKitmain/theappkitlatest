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
               @if (\Session::has('success'))
               <div class="alert alert-success">
                  <ul>
                     <li>{!! \Session::get('success') !!}</li>
                  </ul>
               </div>
               @endif
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
                                       <h4 class="theme_name">{{$themetemplate->theme_name}}</h4>
                                      
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 p-r-0 payment-rightcol">
                  <div class="right-chk">
                     <!-- <div class="planexpire"> -->
                     <!-- Your plan renews on March 4, 2021. -->
                     <!-- </div> -->
                     <div class="pricing-box-ch-top-wrapper">
                        <div class="globalContent">
                           <h2 class="billing-title-top">Billing</h2>
                           <section class="container-lg">
                              <!--Example 1-->
                              <div class="cell example example1" id="example-1">
                                 <form id="publishform" method="post" action="{{route('theme.publish_app')}}">
                                    @csrf
                                    <div class="pricing-box-ch">
                                       <h4 class="text-centersel">Select Your Plan</h4>
                                       <div class="pricing-box-ch-inner mr-bt-40">
                                          <h5 class="plantitleh">Annual Plan</h5>
                                          <input id="planyear"  type="radio" data-currency="@if($usercountry->country == 'United Kingdom') £ @else $ @endif" data-price="{{number_format((float)$plans_retrieve_12->amount/100, 2, '.', '')}}" name="plan_id" value="@if($usercountry->country == 'United Kingdom'){{$themetemplate->yearly_gbp}}@else {{$themetemplate->yearly_usd}} @endif" checked>
                                          <label for="planyear" class="d-flex radio-planpayemnt">
                                             <div class="bootom-total-price-left">
                                                <!--  <h5 class="">Currency</h5> -->
                                                <h5 class="">Billing</h5>
                                                <h5 class="">Total Cost</h5>
                                             </div>
                                             <div class="bootom-total-price-right right-pric">
                                                @if($usercountry->country == 'United Kingdom')
                                                <!-- <h6 class="h6_dy_currency">{{$plans_retrieve_12->currency}}</h6> -->
                                                <h6>{{$plans_retrieve_12->interval_count}} year</h6>
                                                <h6>@if($plans_retrieve_12->currency =='gbp') £@endif{{number_format((float)$plans_retrieve_12->amount/100, 2, '.', '')}}</h6>
                                                @else
                                                <!--  <h6 class="h6_dy_currency">{{$plans_retrieve_12->currency}}</h6> -->
                                                <h6>{{$plans_retrieve_12->interval_count}} year</h6>
                                                <h6>@if($plans_retrieve_12->currency !='gbp') $@endif{{number_format((float)$plans_retrieve_12->amount/100, 2, '.', '')}}</h6>
                                                @endif
                                             </div>
                                          </label>
                                          @if($usercountry->country == 'United Kingdom')
                                          <h6 class="anlplan">Save £199</h6>
                                          @else
                                          <h6 class="anlplan">Save $249</h6>
                                          @endif
                                       </div>
                                       <div class="pricing-box-ch-inner">
                                          <h5 class="plantitleh">Quarterly Plan</h5>
                                          <input id="planmonth"  type="radio" name="plan_id" value="@if($usercountry->country == 'United Kingdom'){{$themetemplate->monthly_gbp}}@else{{$themetemplate->monthly_usd}}@endif" data-currency="@if($usercountry->country == 'United Kingdom') £ @else $ @endif" data-price="{{number_format((float)$plans_retrieve_3->amount/100, 2, '.', '')}}">
                                          <label for="planmonth" class="d-flex radio-planpayemnt">
                                             <div class="bootom-total-price-left ">
                                                <!--  <h5 class="">Currency</h5> -->
                                                <h5 class="">Billing</h5>
                                                <h5 class="">Total Cost</h5>
                                             </div>
                                             <div class="bootom-total-price-right right-pric">
                                                @if($usercountry->country == 'United Kingdom')
                                                <!--  <h6 class="h6_dy_currency">{{$plans_retrieve_3->currency}}</h6> -->
                                                <h6>Every {{$plans_retrieve_3->interval_count}} months</h6>
                                                <h6>@if($plans_retrieve_3->currency =='gbp') £@endif{{number_format((float)$plans_retrieve_3->amount/100, 2, '.', '')}}</h6>
                                                @else
                                                <!--  <h6 class="h6_dy_currency">{{$plans_retrieve_3->currency}}</h6> -->
                                                <h6>Every {{$plans_retrieve_3->interval_count}} months</h6>
                                                <h6>@if($plans_retrieve_3->currency =='usd') $@endif{{number_format((float)$plans_retrieve_3->amount/100, 2, '.', '')}}</h6>
                                                @endif
                                             </div>
                                          </label>
                                       </div>
                                       
                                    </div>
                                    <fieldset>
                                       <div class="row">
                                          <label for="example1-name" data-tid="elements_examples.form.name_label">Name on card</label>
                                          <input id="example1-name" data-tid="elements_examples.form.name_placeholder" type="text" name="customer_name" value="{{$usercountry->first_name}}" required="" autocomplete="name">
                                       </div>
                                       <div class="row">
                                          <label for="example1-email" data-tid="elements_examples.form.email_label">Email</label>
                                          <input id="example1-email" data-tid="elements_examples.form.email_placeholder" type="email" name="customer_email" value="{{$usercountry->email}}" required="" autocomplete="email">
                                       </div>
                                       <!-- <div class="row">
                                          <label for="example1-phone" data-tid="elements_examples.form.phone_label">Phone</label>
                                          <input id="example1-phone" data-tid="elements_examples.form.phone_placeholder" type="tel" name="customer_mobile" placeholder="(941) 555-0123" required="" autocomplete="tel">
                                          </div> -->
                                    </fieldset>
                                    <div class="chekoutbox">
                                       <fieldset>
                                          <div class="row">
                                             <div id="example1-card"></div>
                                          </div>
                                       </fieldset>
                                       <div class="bootom-total-price d-flex">
                                          <div class="bootom-total-price-left">
                                             <h5 class="">Total</h5>
                                          </div>
                                          <div class="bootom-total-price-right">
                                             <h6>
                                                @if($usercountry->country == 'United Kingdom')
                                                <span class="dy_currency">£</span>
                                                <span class="dy_price">{{number_format((float)$plans_retrieve_3->amount/100, 2, '.', '')}}</span>
                                                @else
                                                <span class="dy_currency">$</span>
                                                <span class="dy_price">{{number_format((float)$plans_retrieve_3->amount/100, 2, '.', '')}}</span>
                                                @endif
                                             </h6>
                                          </div>
                                       </div>
                                       <div class="error" role="alert">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
                                             <path class="base" fill="#000" d="M8.5,17 C3.80557963,17 0,13.1944204 0,8.5 C0,3.80557963 3.80557963,0 8.5,0 C13.1944204,0 17,3.80557963 17,8.5 C17,13.1944204 13.1944204,17 8.5,17 Z"></path>
                                             <path class="glyph" fill="#FFF" d="M8.5,7.29791847 L6.12604076,4.92395924 C5.79409512,4.59201359 5.25590488,4.59201359 4.92395924,4.92395924 C4.59201359,5.25590488 4.59201359,5.79409512 4.92395924,6.12604076 L7.29791847,8.5 L4.92395924,10.8739592 C4.59201359,11.2059049 4.59201359,11.7440951 4.92395924,12.0760408 C5.25590488,12.4079864 5.79409512,12.4079864 6.12604076,12.0760408 L8.5,9.70208153 L10.8739592,12.0760408 C11.2059049,12.4079864 11.7440951,12.4079864 12.0760408,12.0760408 C12.4079864,11.7440951 12.4079864,11.2059049 12.0760408,10.8739592 L9.70208153,8.5 L12.0760408,6.12604076 C12.4079864,5.79409512 12.4079864,5.25590488 12.0760408,4.92395924 C11.7440951,4.59201359 11.2059049,4.59201359 10.8739592,4.92395924 L8.5,7.29791847 L8.5,7.29791847 Z"></path>
                                          </svg>
                                          <span class="message"></span>
                                       </div>
                                    </div>
                                    <input type="hidden" name="template_id" value="{{$template_id}}">
                                    <input type="hidden" name="token" class="token">
                                    <!-- <input type="hidden" name="plan_id" value="price_1IH4wvLEpbblA2UrSSBzjqEN" class="token"> -->
                                    <button type="submit" data-tid="elements_examples.form.pay_button">Pay</button>
                                 </form>
                              </div>
                           </section>
                        </div>
                     </div>
                     <!-- <div class="pricing-box-myplan-wrapper">
                        <div class="pricing-box-myplan">
                                 <h4>Current Plan</h4>
                           <div class="currentplan-box">
                           <div class="currentplan-box-inner">
                           <h6>Every three months</h6>
                           <h6>$750 per month</h6>
                           <h6>Your plan renews on March 8, 2021.</h6>
                           <div class="planbuttons">
                            <a class="update-plan-btn" href="#">Update plan</a>
                            <a class="cancel-plan-btn" href="#">Cancel plan</a>
                           </div>
                           </div>
                                 </div>
                              </div>
                        <div class="pricing-box-myplan">
                                 <h4>Billing history</h4>
                           <div class="d-flex biilinghistory-inner">
                                       <h6>Feb 8, 2021 <a href="" target="_blank"> <i class="fa fa-download" aria-hidden="true"></i></a></h6>
                                       <h6>$5000</h6>
                                       <h6>Every year</h6>
                                 </div>
                              </div>
                              </div> -->
                     <!-- <div class="pricing-box-myplan cancel-plan-container">
                        <h4>Current Plan</h4>
                        <div class="currentplan-box">
                        <div class="currentplan-box-inner">
                        <h6>Every three months</h6>
                        <h6>$750 per month</h6>
                        <h6>Your plan will be canceled, but is still available until the end of your billing period on March 8, 2021.</h6><br>
                        <h6>If you change your mind, you can renew your subscription.</h6>
                        
                        <div class="planbuttons">
                        <a class="cancel-plan-btn" href="#">Cancel plan</a>
                        <a class="update-plan-btn" href="#">Go Back</a>
                        </div>
                        <p>By canceling your plan, you agree to Typographic's <b><a class="term-pp" href="#">Terms of Service and Privacy Policy</a></b>.</p>
                        </div>
                        </div>
                        </div> -->
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div id="loader"></div>
@include('admin.template.partials.footer')
<script>
   $(document).ready(function(){
     $("#planmonth").click(function(){
       var price = $(this).attr('data-price');
       var currency = $(this).attr('data-currency');
       $('.dy_price').text(price);
       $('.dy_currency').text(currency);
     });
     $("#planyear").click(function(){
       var price = $(this).attr('data-price');
       var currency = $(this).attr('data-currency');
       $('.dy_price').text(price);
       $('.dy_currency').text(currency);
     });
   });
</script>