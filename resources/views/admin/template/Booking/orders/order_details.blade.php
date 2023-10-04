@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Booking.partials.sidemenu')
<main>
<div class="main-home">
         <div class="main-wrapper maininnerallpagescontainer">
            <div class="main-container">
               <div class="main-container-inner-shipping">
                  <div class="container-fluid">
					    <div class="row">
						   <div class="col-lg-12">
							  <h3 class="title-order-number">Order no: {{$order->order_number}}</h3>
						   </div>
						   <div class="col-lg-5">
						   <div class="left-cutomer-details">
							  <h3 class="title-profile-dt">Customer Information</h3>
							  <div class="left-cutomer-inner">
							  <p class="addressp"><strong>Name : </strong> <span>{{$order->app_user->name}}</span></p>
							  <p class="addressp"><strong>Email : </strong> <span>{{$order->app_user->email}}</span></p>
							  <p class="addressp"><strong>Mobile : </strong> <span>{{$order->app_user->number}}</span></p>
							  </div>
							  <div class="left-cutomer-inner">
							  <h3 class="title-profile-order bgcolor5">Shipping Address</h3>
                       <p class="addressp mainaddress">
                                {{$address->house_no}} {{$address->area}}<br>
                                {{$address->city}}<br>
                                {{$address->state}}<br>
                                {{$address->pincode}}<br>
                       </p>
                       </div>
                       <div class="left-cutomer-inner">
							  <h3 class="title-profile-order bgcolor5">Billing Address</h3>
                       <!-- <p class="addressp mainaddress">
                             
                       </p> -->
							  </div>
							  <div class="left-cutomer-inner">
							  <h3 class="title-profile-order bgcolor5">Card Details</h3>
							  <p class="addressp"><strong>Type : </strong> DEBIT</p>
							  <p class="addressp"><strong>Card : </strong> VISA</p>
							  <p class="addressp"><strong>Last 4 No : </strong>5976 </p>
							  <p class="addressp"><strong>Exp Year : </strong>2023 </p>
							  <p class="addressp"><strong>Exp Month : </strong>1 </p>
							  </div>
						   </div>
						   </div>
						   <div class="col-lg-7 ">
						   <div class="right-product-detail">
                      <h3 class="title-profile-dt">Order Information</h3>
                   
							  <div class="profile-container-right">
								 <ul class="proinfo-ul">
                              <li><span class="w-50 float-left lftlipro">Delivery Schedule :</span><span class="w-50 float-right rytlipro text-right">Next day</span></li>
                              @if(Auth::user()->country == 'United Kingdom')   
                              <li><span class="w-50 float-left lftlipro">Delivery Charges :</span><span class="w-50 float-right rytlipro text-right">&#163;{{$shipping->shipping_price}}</span></li>
                              @else
                              <li><span class="w-50 float-left lftlipro">Delivery Charges :</span><span class="w-50 float-right rytlipro text-right">${{$shipping->shipping_price}}</span></li>
                              @endif
                              <li><span class="w-50 float-left lftlipro">Total :</span><span class="w-50 float-right rytlipro text-right">{{$order->total}}</span></li>
                              <li><span class="w-50 float-left lftlipro">Payment Receipt :</span><span class="w-50 float-right rytlipro text-right"><a target="_blank" href="#">Receipt url</a></span></li>
                              <li><span class="w-50 float-left lftlipro">Date :</span><span class="w-50 float-right rytlipro text-right text-capitalize">{{$created_at}}</span></li>
                           </ul>
                       </div>
                      
							  <div class="profile-container-right">
							  <div class=" profile-container-right-inner">
							  <h3 class="title-profile-order status-h3">Status</h3>
                        @if($order->status == "0")   
							   <h4 class="h4status text-capitalize">Confirmed</h4>
                        @elseif($order->status == "2")
                        <h4 class="h4status text-capitalize">Completed</h4>
                        @else
                        <h4 class="h4status text-capitalize">Delivery</h4>
                        @endif

                       </div>
                        @if($order->status != "2")
                           <form action="{{route('theme.update_status')}}" method="POST">@csrf
                              <input type="hidden" name="id" value="{{$order->id}}">
                              <div class="statusbox d-flex">
                                 <div class="radiobox">
                                    <input type="radio" id="control_02" name="status" value="0" {{$order->status == "0" ? "checked" : ""}}>
                                    <label for="control_02"><h2>Confirmed</h2></label>
                                 </div>
                                 <div class="radiobox">
                                    <input type="radio" id="control_03" name="status" value="1" {{$order->status == "1" ? "checked" : ""}}>
                                    <label for="control_03"><h2>Delivery</h2></label>
                                 </div>
                                 <div class="radiobox">
                                    <input type="radio" id="control_01" name="status" value="2" {{$order->status == "2" ? "checked" : ""}}>
                                    <label for="control_01"><h2>Completed</h2></label>
                                 </div>
                              </div>
                              <div class=" form-group d-block-fg">
                                    <button class="savebtn">Save</button>
                              </div>
                           </form>
                        @endif
                       </div>                       
						   </div>
                     </div>
                     <div class="col-md-12 mt-20 template-orders">
                  <div class="card card-own table-wrapper">
                    
                     <div class="card-body">
                        <table class="table table-bordered table-striped table-main" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Items</th>
                                    <th>QTY</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>                        
                            <tbody>
                            @foreach($order->items as $items)                              
                                 <tr>
                                    <td class="pd-2"scope="col"><div class="media promedia">
                                       <img class="mr-3" src="{{asset('images/yellow_mesh_men_sport_sneaker.jpg')}}">
                                       <div class="media-body protable-media">
                                          <h5 class="mt-0">{{$items->products->product_name}}</h5>
                                          @if(Auth::user()->country == 'United Kingdom')   
                                          <p>&#163;{{$items->products->product_price}}</p>
                                          @else
                                          <p>${{$items->products->product_price}}</p>
                                          @endif
                                          <h6></h6>
                                       </div>
                                    </div></td>
                                    <td class="pd-2">{{$items->qty}}</td>
                                    @if(Auth::user()->country == 'United Kingdom')                                                                 
                                    <td class="pd-2">&#163;{{$items->products->product_price}}</td>
                                    <td class="pd-2">&#163;{{$items->products->product_price*$items->qty, 2 }}</td>
                                    @else
                                    <td class="pd-2">${{$items->products->product_price}}</td>
                                    <td class="pd-2">${{$items->products->product_price*$items->qty, 2 }}</td>
                                    @endif
                                 </tr>
                            @endforeach    
                            </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 mt-20 prcl">
               <div class="form-group">
                  <label class="pr-label" for="">Enter shipping company :</label>
                     <input type="text" class="form-control " id="product_name" name="product_name" placeholder="Enter shipping company" required="">
                  </div>
               </div>
               <div class="col-md-6 mt-20 prcl">
               <div class="form-group">
                  <label class="pr-label" for="">Tracking Number:</label>
                     <input type="text" class="form-control " id="product_name" name="product_name" placeholder="Tracking Number" required="">
                  </div>
               </div>
               <div class="col-md-6">
               <div class="form-group">
               <button type="submit" class="btn btn-primary">Send</button>
               </div>
						</div>
                  </div>
               </div>
            </div>
         </div>
</div>
              
</main>

<!-- Delete Modal here -->
<div id="myProductModal" class="modal fade">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header">  
        <h4 class="modal-title">Are you sure?</h4>  
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <form method="post" action="" id="deleteProductForm">
        @csrf
        {{ method_field('DELETE') }}
        <div class="modal-body">
          <p>Do you really want to delete these records? This process cannot be undone.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>                 
<!-- Delete Modal End here -->

@include('admin.template.partials.footer')