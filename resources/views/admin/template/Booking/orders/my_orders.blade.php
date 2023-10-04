@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Booking.partials.sidemenu')
<main>
   <div class="main-home">
      <div class="main-wrapper maininnerallpagescontainer">
         <div class="main-container">
            <div class="main-container-inner-shipping">
               <div class="container-fluid">
                  @if(count($orders) == 0)
                  <div class="row">
                     <h1 class="template_order_title">No Orders Yet</h1>
                  </div>
                  @else
                  <div class="row">
                     <div class="col-md-4 color-1-col">
                        <h3 class="order-heading color-1"><a href="#">New Orders</a></h3>                        
                        <div class="tasklisting-container-scroll order-scroll">
                        @if(count($data['new_orders']))
                        @foreach($data['new_orders']->slice(0,5) as $order)
                              <a href="{{route('theme.booking_orders.show',$order->id)}}">
                              <div class="customer-box">
                                <div class="d-flex own-media-box">
                                  <div class="left-cus-fl">
                                    <p class="customername-fl">{{$order->app_user->name[0] ?? ""}}</p>
                              	  </div>
                              	  <div class="right-cus-fl">
                                    <h5>{{$order->app_user->name}}</h5>
                                    <p class="orderdate"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>{{$order->created_at}}</p>                                                  
                              	  </div>
                                </div>
                                 <p class="orderidnumber">Order no: <span>{{$order->order_number}}</span></p>
                              </div>
                              </a>
                        @endforeach
                        @if(count($data['new_orders'])>5)
                           <button onclick="window.location.href='{{route('theme.booking_new_orders')}}';" class="btn-seemore">See More <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                        @endif 
                        @endif                               
                        </div>                       
                     </div>                   

                   
                     <div class="col-md-4 color-2-col p-l-0">
                        <h3 class="order-heading color-2"><a href="#">Confirmed orders</a></h3>
                        <div class="tasklisting-container-scroll order-scroll">
                        @if(count($data['confirmed_orders']))
                          @foreach($data['confirmed_orders']->slice(0,5) as $order)
                                <a href="{{route('theme.booking_orders.show',$order->id)}}">
                                <div class="customer-box">
                                  <div class="d-flex own-media-box">
                                    <div class="left-cus-fl">
                                      <p class="customername-fl">{{$order->app_user->name[0]}}</p>
                                    </div>
                                    <div class="right-cus-fl">
                                      <h5>{{$order->app_user->name}}</h5>
                                      <p class="orderdate"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>{{$order->created_at}}</p>                                                  
                                    </div>
                                  </div>
                                  <p class="orderidnumber">Order no: <span>{{$order->order_number}}</span></p>
                                </div>
                                </a>
                          @endforeach
                          @if(count($data['confirmed_orders'])>5)
                           <button onclick="window.location.href='{{route('theme.booking_confirmed_orders')}}';" class="btn-seemore">See More <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                        @endif
                          @endif    
                        </div>
                     </div>
                  
                    
                     <div class="col-md-4 color-3-col p-l-0">
                        <h3 class="order-heading color-3"><a href="#">Shipped Orders</a></h3>
                        <div class="tasklisting-container-scroll order-scroll">
                        @if(count($data['shipped_orders']))
                        @foreach($data['shipped_orders']->slice(0,5) as $order)
                          <a href="{{route('theme.booking_orders.show',$order->id)}}">
                          <div class="customer-box">
                            <div class="d-flex own-media-box">
                              <div class="left-cus-fl">
                                <p class="customername-fl">M</p>
                              </div>
                              <div class="right-cus-fl">
                                <h5>{{$order->app_user->name}}</h5>
                                <p class="orderdate"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>{{$order->created_at}}</p>                                                  
                              </div>
                            </div>
                            <p class="orderidnumber">Order no: <span>{{$order->order_number}}</span></p>
                          </div>
                          </a>
                        @endforeach
                        @if(count($data['shipped_orders'])>5)
                           <button onclick="window.location.href='{{route('theme.booking_shipped_orders')}}';" class="btn-seemore">See More <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                        @endif
                        @endif                             
                        </div>
                     </div>
                   


                  </div>
                  @endif
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- <h1 class="text-center">No Orders Yet </h1> -->
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