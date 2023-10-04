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
                      <div class="pricing-box-myplan payment-wrapper mb-0">
      <h4 class="text-left ">ADD PAYMENT METHOD</h4>

   </div>
                        <!-- <div class="planexpire"> -->
                           <!-- Your plan renews on March 4, 2021. -->
                        <!-- </div> -->
                        <div class="pricing-box-ch-top-wrapper">
                        <div class="globalContent">
                           <section class="container-lg">
                              <!--Example 1-->
                              
                              <div class="cell example example1 addpayment_method_data" id="example-1">
                                 <form id="publishform" method="post" action="{{route('theme.addpayment_method_data')}}">
                                    @csrf
                  <div class="chekoutbox">
                                    <fieldset>
                                       <div class="row">
                                          <div id="example1-card"></div>
                                       </div>
                                    </fieldset>
   
                                    <div class="error" role="alert">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
                                          <path class="base" fill="#000" d="M8.5,17 C3.80557963,17 0,13.1944204 0,8.5 C0,3.80557963 3.80557963,0 8.5,0 C13.1944204,0 17,3.80557963 17,8.5 C17,13.1944204 13.1944204,17 8.5,17 Z"></path>
                                          <path class="glyph" fill="#FFF" d="M8.5,7.29791847 L6.12604076,4.92395924 C5.79409512,4.59201359 5.25590488,4.59201359 4.92395924,4.92395924 C4.59201359,5.25590488 4.59201359,5.79409512 4.92395924,6.12604076 L7.29791847,8.5 L4.92395924,10.8739592 C4.59201359,11.2059049 4.59201359,11.7440951 4.92395924,12.0760408 C5.25590488,12.4079864 5.79409512,12.4079864 6.12604076,12.0760408 L8.5,9.70208153 L10.8739592,12.0760408 C11.2059049,12.4079864 11.7440951,12.4079864 12.0760408,12.0760408 C12.4079864,11.7440951 12.4079864,11.2059049 12.0760408,10.8739592 L9.70208153,8.5 L12.0760408,6.12604076 C12.4079864,5.79409512 12.4079864,5.25590488 12.0760408,4.92395924 C11.7440951,4.59201359 11.2059049,4.59201359 10.8739592,4.92395924 L8.5,7.29791847 L8.5,7.29791847 Z"></path>
                                       </svg>
                                       <span class="message"></span>
                                    </div>
                                    <input type="checkbox" id="card_default" value="yes" checked="">
                                    <input id='testNameHidden' type='hidden' value='yes' name='card_default'>
                                          <label id="card_default_label" for="vehicle1">Use as default payment method</label><br>
                                    </div>
                                    <input type="hidden" name="token" class="token">
                                    <!-- <input type="hidden" name="plan_id" value="price_1IH4wvLEpbblA2UrSSBzjqEN" class="token"> -->
                                    <button type="submit" data-tid="elements_examples.form.pay_button">Add Card</button>
                                 </form>
                              </div>
                           </section>
                        </div>
                        </div>

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
  $("#card_default").click(function(){
    $('#testNameHidden').val( $(this).is(':checked') ? 'yes' : 'no' );
  });
  });
  </script>