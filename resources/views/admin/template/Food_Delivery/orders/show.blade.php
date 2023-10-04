@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Food_Delivery.partials.sidemenu')
<div class="main-home">
      <div class="main-wrapper maininnerallpagescontainer">
      <div class="main-wrapper">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-xl-12 col-md-12">
            @if(Session::get('alert'))
            <div class="alert alert-{{Session::get('alert')}} alert-dismissible" role="alert">
              <p>{{Session::get('message')}} </p>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            @endif
            <h2 class="table-title-custom">Order History</h2>
         </div>
            <div class="col-lg-12 col-xl-12 col-md-12">
               <div class="shadow-d data-table-wrapper text-left order-details-container">
                  <div class="bd-example bd-example-tabs">
                     <div class="row admin-status-row">
                        <div class="col-lg-12">
                           <h3 class="title-profile-order bgcolor5">Order no: {{$order->order_no}}</h3>
                        </div>
                        <div class="col-lg-4">
                           <h3 class="title-profile-order bgcolor5">Customer Information</h3>
                           <p class="addressp"><strong>Name : </strong> <span>{{$order->user->name}}</span></p>
                           <p class="addressp"><strong>Email : </strong> <span>{{$order->user->email}}</span></p>
                           <p class="addressp"><strong>Mobile : </strong> <span>{{$order->user->number}}</span></p>
                           @if($order->payment_type == "square")
                             <h3 class="title-profile-order bgcolor5">Shipping Address</h3>
                             <p class="addressp">{{$order->order_charges['shipping_address']['address_line_1']}}<br>
                              {{$order->order_charges['shipping_address']['locality']}}<br>{{$order->order_charges['shipping_address']['postal_code']}}</p>
                             <h3 class="title-profile-order bgcolor5">Billing Address</h3>
                             <p class="addressp">{{$order->order_charges['billing_address']['address_line_1']}}<br>
                              {{$order->order_charges['billing_address']['locality']}}<br>{{$order->order_charges['billing_address']['postal_code']}}</p>
                             <h3 class="title-profile-order bgcolor5">Card Details</h3>
                             <p class="addressp"><strong>Type : </strong> {{$order->order_charges['card_details']['card']['card_type']}}</p>
                             <p class="addressp"><strong>Card : </strong> {{$order->order_charges['card_details']['card']['card_brand']}}</p>
                             <p class="addressp"><strong>Last 4 No : </strong>{{$order->order_charges['card_details']['card']['last_4']}} </p>
                             <p class="addressp"><strong>Exp Year : </strong>{{$order->order_charges['card_details']['card']['exp_year']}} </p>
                             <p class="addressp"><strong>Exp Month : </strong>{{$order->order_charges['card_details']['card']['exp_month']}} </p>
                            @endif
                            @if($order->payment_type == "stripe")
                              <h3 class="title-profile-order bgcolor5">Shipping Address</h3>
                              <p class="addressp">
                                {{json_decode(json_encode($order->order_charges['shipping']['address']["line1"]))}}</br>
                                {{json_decode(json_encode($order->order_charges['shipping']['address']['line2']))}}</br>
                                {{json_decode(json_encode($order->order_charges['shipping']['address']['city']))}}</br>
                                {{json_decode(json_encode($order->order_charges['shipping']['address']['postal_code']))}}</br>
                                {{json_decode(json_encode($order->order_charges['shipping']['address']['state']))}}</br>
                                {{json_decode(json_encode($order->order_charges['shipping']['address']['country']))}}
                              </p>
                              <h3 class="title-profile-order bgcolor5">Billing Address</h3>
                              <p class="addressp">
                                {{json_decode(json_encode($order->order_charges['billing_details']['address']["line1"]))}}</br>
                                {{json_decode(json_encode($order->order_charges['billing_details']['address']['line2']))}}</br>
                                {{json_decode(json_encode($order->order_charges['billing_details']['address']['city']))}}</br>
                                {{json_decode(json_encode($order->order_charges['billing_details']['address']['postal_code']))}}</br>
                                {{json_decode(json_encode($order->order_charges['billing_details']['address']['state']))}}</br>
                                {{json_decode(json_encode($order->order_charges['billing_details']['address']['country']))}}
                              </p>
                              <h3 class="title-profile-order bgcolor5">Card Details</h3>
                              <p class="addressp"><strong>Type : </strong> {{json_decode(json_encode($order->order_charges['payment_method_details']['type']))}}</p>
                              <p class="addressp"><strong>Card : </strong> {{json_decode(json_encode($order->order_charges['payment_method_details']['card']['brand']))}}</p>
                              <p class="addressp"><strong>Last 4 No : </strong> {{json_decode(json_encode($order->order_charges['payment_method_details']['card']['last4']))}}</p>
                              <p class="addressp"><strong>Exp Year : </strong> {{json_decode(json_encode($order->order_charges['payment_method_details']['card']['exp_year']))}}</p>
                              <p class="addressp"><strong>Exp Month : </strong> {{json_decode(json_encode($order->order_charges['payment_method_details']['card']['exp_month']))}}</p>
                            @endif
                        </div>
                        <div class="col-lg-8">
                           <div class="profile-container">
                              <h3 class="title-profile bgcolor5">Order Information</h3>
                              <ul class="proinfo-ul">
                                 <li><span class="w-50 float-left lftlipro">Delivery Schedule :</span><span class="w-50 float-right rytlipro text-right text-uppercase">{{$order->schedule}}</span></li>
                                 <li><span class="w-50 float-left lftlipro">Delivery Charges :</span><span class="w-50 float-right rytlipro text-right">{{$order->currency."".$order->delivery_charges ?? "-"}}</span></li>
                                 @if(!is_null($order->apply_promo))
                                 <li><span class="w-50 float-left lftlipro">Promo :</span><span class="w-50 float-right rytlipro text-right">{{$order->apply_promo->promo->promo_code ?? "-"}}</span></li>
                                 <li><span class="w-50 float-left lftlipro">Discount :</span><span class="w-50 float-right rytlipro text-right">
                                    {{$order->apply_promo->promo->discount."%" ?? "-"}}
                                 </span></li>
                                 <li><span class="w-50 float-left lftlipro">Total :</span><span class="w-50 float-right rytlipro text-right">{{$order->currency."".$order->apply_promo->total ?? "-"}}</span></li>
                                 <li><span class="w-50 float-left lftlipro">Discount Price :</span><span class="w-50 float-right rytlipro text-right">{{$order->currency."".$order->apply_promo->discount_price ?? "-"}}</span></li>
                                 <li><span class="w-50 float-left lftlipro">Grand Total :</span><span class="w-50 float-right rytlipro text-right">{{$order->currency."".$order->apply_promo->grand_total ?? "-"}}</span></li>
                                 @else
                                 <li><span class="w-50 float-left lftlipro">Total :</span><span class="w-50 float-right rytlipro text-right">{{$order->currency."".$order->total ?? "-"}}</span></li>
                                 @endif
                                 <!-- <li><span class="w-50 float-left lftlipro">Payment Receipt :</span><span class="w-50 float-right rytlipro text-right"><a target="_blank" href="{{json_decode(json_encode($order->order_charges['receipt_url']))}}">Receipt url</a></span></li> -->
                                 @if($order->status == "1" || $order->status == "2")
                                    <li><span class="w-50 float-left lftlipro">Delivery Receipt :</span><span class="w-50 float-right rytlipro text-right"><a target="_blank" href="{{route('theme.food_delivery_receipts',['id'=>$order->id])}}">Receipt</a></span></li>
                                 @endif
                                 <li><span class="w-50 float-left lftlipro">Date :</span><span class="w-50 float-right rytlipro text-right text-capitalize">{{$order->created_at}}</span></li>
                                 @if($order->contact_info == "1")
                                    <li><span class="w-50 float-left lftlipro">Order Type :</span><span class="w-50 float-right rytlipro text-right">No Contact</span></li>
                                 @else
                                    <li><span class="w-50 float-left lftlipro">Order Type :</span><span class="w-50 float-right rytlipro text-right">Hand To Hand</span></li>
                                 @endif
                              </ul>
                           </div>
                           <h3 class="title-profile-order bgcolor5" style="margin-top: 27px">Status</h3>
                           
                           <h4 class="h4status text-capitalize">{{$order->order_status}}</h4>
                           
                           @if($order->status != "1")
                              <form action="{{route('theme.food_update_status')}}" method="POST">@csrf
                                 <input type="hidden" name="id" value="{{$order->id}}">
                                 <div class="statusbox d-flex">
                                    <div class="radiobox">
                                      <input type="radio" id="control_02" name="status" value="0" {{$order->status == "0" ? "checked" : ""}}>
                                      <label for="control_02"><h2>Confirmed</h2></label>
                                    </div>
                                    <div class="radiobox">
                                      <input type="radio" id="control_03" name="status" value="2" {{$order->status == "2" ? "checked" : ""}}>
                                      <label for="control_03"><h2>Delivery</h2></label>
                                    </div>
                                    <div class="radiobox">
                                       <input type="radio" id="control_01" name="status" value="1" {{$order->status == "1" ? "checked" : ""}}>
                                       <label for="control_01"><h2>Completed</h2></label>
                                    </div>
                                 </div>
                                 <div class="float-right savebtn-box"><button class="btn-style btn-color stylistsavebtn-">Save</button></div>
                              </form>
                           @endif
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="productitem">
                              <div class="row no-gutters bgcolor-itm">
                                 <div class="col-lg-9"><h6 class="pl-30">Items</h6></div>
                                 <div class="col-lg-1"><p>QTY</p></div>
                                 <div class="col-lg-1"><p>Price</p></div>
                                 <div class="col-lg-1"><p>Total</p></div>
                              </div>
                              
                              @foreach($order->items as $item)
                              <div class="row no-gutters product-row-detail">
                                 <div class="col-lg-9">
                                    <div class="media promedia">
                                       <img class="mr-3" src="{{$item->products->first()->product_image}}">
                                       <div class="media-body">
                                          <h5 class="mt-0">{{$item->products->first()->product_name}}</h5>
                                          <p>{{$item->products->first()->short_description}}</p>
                                          <h6>{{$item->product_informations->first()->attribute_name ?? ""}}</h6>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-1"><p>{{$item->qty}}</p></div>
                                 
                                 @if(count($item->product_informations)>0)
                                    <div class="col-lg-1"><p>{{$order->currency."".$item->product_informations->first()->product_price}}</p></div>
                                 @else
                                    <div class="col-lg-1"><p>{{$order->currency."".$item->products->first()->price}}</p></div>
                                 @endif
                                 @if(count($item->product_informations)>0)
                                    <div class="col-lg-1"><p>{{$order->currency."".number_format( $item->product_informations->first()->product_price*$item->qty, 2 )}}</p></div>
                                 @else

                                    <div class="col-lg-1"><p>{{$order->currency."".number_format( $item->products->first()->price*$item->qty, 2 )}}</p></div>
                                 @endif
                              </div>
                              @endforeach
                              <div class="row no-gutters product-row-detail">
                                 <div class="col-lg-10"></div>
                                 <div class="col-lg-1 "><p><b>Total</b></p></div>
                                 <div class="col-lg-1 "><p><b>{{$order->currency}}{{$order->subtotal}}</b></p></div>
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

@include('admin.template.Food_Delivery.partials.footer')