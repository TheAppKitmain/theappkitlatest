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
                     <div class="planbuttons">
                      <a class="update-plan-btn" href="{{route('theme.update_subscription_data')}}">Update plan</a>
                      <a class="cancel-plan-btn" href="{{route('theme.cancel_subscription_view')}}">Cancel plan</a>
                     </div>
                     </div>
                           </div>
                        </div>
                  <!-- <div class="pricing-box-myplan">
                     <h4>PAYMENT METHOD</h4>
                     <div class="d-flex biilinghistory-inner">
                        @foreach($card_lists as $list)
                         <span>{{$list->card->last4}}</span>
                        @endforeach
                         <a class="update-plan-btn" href="{{route('theme.addpayment_method')}}">Add payment method</a>        
                     </div>
                     </div>   -->
                  <div class="payment-wrapper-main">
   <div class="pricing-box-myplan payment-wrapper">
      <h4 class="text-left">PAYMENT METHOD</h4>
   </div>
   <div class="pricing-box-myplan">
      @foreach($card_lists as $list)
      <div class="d-flex biilinghistory-inner pym-inner">
         <h6 class="billpa1">
            <!-- <svg class="SVGInline-svg SVGInline--cleaned-svg SVG-svg BrandIcon-svg" height="24" width="24" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
               <g fill="none" fill-rule="evenodd">
                  <path d="M0 0h32v32H0z" fill="#00579f"></path>
                  <g fill="#fff" fill-rule="nonzero">
                     <path d="M13.823 19.876H11.8l1.265-7.736h2.023zm7.334-7.546a5.036 5.036 0 0 0-1.814-.33c-1.998 0-3.405 1.053-3.414 2.56-.016 1.11 1.007 1.728 1.773 2.098.783.379 1.05.626 1.05.963-.009.518-.633.757-1.216.757-.808 0-1.24-.123-1.898-.411l-.267-.124-.283 1.737c.475.213 1.349.403 2.257.411 2.123 0 3.505-1.037 3.521-2.641.008-.881-.532-1.556-1.698-2.107-.708-.354-1.141-.593-1.141-.955.008-.33.366-.667 1.165-.667a3.471 3.471 0 0 1 1.507.297l.183.082zm2.69 4.806l.807-2.165c-.008.017.167-.452.266-.74l.142.666s.383 1.852.466 2.239h-1.682zm2.497-4.996h-1.565c-.483 0-.85.14-1.058.642l-3.005 7.094h2.123l.425-1.16h2.597c.059.271.242 1.16.242 1.16h1.873zm-16.234 0l-1.982 5.275-.216-1.07c-.366-1.234-1.515-2.575-2.797-3.242l1.815 6.765h2.14l3.18-7.728z"></path>
                     <path d="M6.289 12.14H3.033L3 12.297c2.54.641 4.221 2.189 4.912 4.049l-.708-3.556c-.116-.494-.474-.633-.915-.65z"></path>
                  </g>
               </g>
            </svg> -->
            <span>{{$list->card->brand}}</span>
         </h6>
         <h6 class="billpa2">•••• {{$list->card->last4}} @if($list->default_card == 1)<span class="default-setcard">default</span>@endif</h6>
         <h6 class="billpa3">Expires {{$list->card->exp_month}}/{{$list->card->exp_year}}</h6>
         <div class="payment-rightdetail">
            @if($list->default_card != 1)
            <div class="dropdown-payment">
               <span class="btn-paym"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></span>
               <div class="dropdown-content">
                  <!-- <a href="">Make Default</a> -->
                  <!-- <a href="">Delete</a> -->
                  <form method="post" action="{{route('theme.defaultpayment_method')}}">
                     @csrf
                     <input type="hidden" name="card_id" value="{{$list->id}}">
                     <button type="submit">Make Default</button>
                  </form>
                  <form method="post" action="{{route('theme.deletepayment_method')}}">
                     @csrf
                     <input type="hidden" name="card_id" value="{{$list->id}}">
                     <button type="submit">Delete</button>
                  </form>
               </div>
            </div>
            @endif
         </div>
      </div>
      @endforeach
      <div class="addpaymentmethod">
         <a href="{{route('theme.addpayment_method')}}"><i class="fa fa-plus" aria-hidden="true"></i>Add payment method</a>
      </div>
   </div>
</div>       
                  <div class="pricing-box-myplan">
                           <h4>Billing history</h4>
                     <div class="d-flex biilinghistory-inner">
                                 <h6>{{date('d,F, Y', strtotime($subs['payment_start']))}} <a href="{{$subs['invoice']}}" target="_blank"> <i class="fa fa-download" aria-hidden="true"></i></a></h6>
                                 <h6>@if($subs['plan']->currency =='gbp') £@else$ @endif{{number_format((float)$subs['plan']->amount/100, 2, '.', '')}} Every {{$subs['plan']->interval_count}} {{$subs['plan']->interval}}</h6>
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
<!-- <div id="loader"></div> -->            
@include('admin.template.partials.footer')