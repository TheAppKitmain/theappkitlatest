@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Food_Delivery.partials.sidemenu')
<main>
<div class="main-home">
         <div class="main-wrapper maininnerallpagescontainer">
            <div class="main-container">
               <div class="main-container-inner-shipping">
                  <div class="container-fluid">
                     <div class="row">

                        <!-- <div class="col-md-4 color-1-col">
                        <h3 class="order-heading color-1"><a href="#">New Orders</a></h3>
                        <div class="tasklisting-container-scroll order-scroll">
                        </div>
                        </div> -->

                        @if(count($data['recent_orders']))
                        <div class="col-md-3 color-1-col">
                        <div class="status-details card newcard-status">
                        <h3 class="order-heading color-1"><a href="#">New Orders</a></h3>
                            @foreach($data['recent_orders']->slice(0,5) as $order)
                            <div class="stylist-box" onclick="window.location.href='{{route('theme.orders.show',['id'=>$order->id])}}';">
                              <div class=" own-media-box">
                                  <img class="mr-3" src="{{asset('asset/images/customerimage.png')}}">
                                  <div class="media-body">
                                    <h5>{{$order->user->name}}</h5>
                                    <!-- <p>£{{$order->total}}</p>  -->
                                    <p class="text-uppercase">{{$order->schedule}}</p> 
                                  </div>
                                  <p class="orderdate"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>{{$order->created_at}}</p>
                                  <p class="orderidnumber">Order no: <span> {{$order->order_no}}</span></p>
                              </div>
                            </div>
                            @endforeach
                            @if(count($data['recent_orders'])>1)
                              <button onclick="window.location.href='{{route('theme.recent_orders')}}';" class="btn-seemore">See More <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                            @endif
                        </div>   
                      </div>
                      @endif

                      @if(count($data['pending_orders']))
                        <div class="col-md-3 color-1-col">
                        <div class="status-details card newcard-status">
                        <h3 class="order-heading color-1"><a href="#">Delivery Orders</a></h3>
                            @foreach($data['pending_orders']->slice(0,5) as $order)
                            <div class="stylist-box" onclick="window.location.href='{{route('theme.orders.show',['id'=>$order->id])}}';">
                              <div class=" own-media-box">
                                  <img class="mr-3" src="{{asset('asset/images/customerimage.png')}}">
                                  <div class="media-body">
                                    <h5>{{$order->user->name}}</h5>
                                    <!-- <p>£{{$order->total}}</p>  -->
                                    <p class="text-uppercase">{{$order->schedule}}</p> 
                                  </div>
                                  <p class="orderdate"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>{{$order->created_at}}</p>
                                  <p class="orderidnumber">Order no: <span> {{$order->order_no}}</span></p>
                              </div>
                            </div>
                            @endforeach
                            @if(count($data['pending_orders'])>1)
                              <button onclick="window.location.href='{{route('theme.pending_orders')}}';" class="btn-seemore">See More <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                            @endif
                        </div>   
                      </div>
                      @endif

                      @if(count($data['delivery_orders']))
                        <div class="col-md-3 color-1-col">
                        <div class="status-details card newcard-status">
                        <h3 class="order-heading color-1"><a href="#">Delivery Orders</a></h3>
                            @foreach($data['delivery_orders']->slice(0,5) as $order)
                            <div class="stylist-box" onclick="window.location.href='{{route('theme.orders.show',['id'=>$order->id])}}';">
                              <div class=" own-media-box">
                                  <img class="mr-3" src="{{asset('asset/images/customerimage.png')}}">
                                  <div class="media-body">
                                    <h5>{{$order->user->name}}</h5>
                                    <!-- <p>£{{$order->total}}</p>  -->
                                    <p class="text-uppercase">{{$order->schedule}}</p> 
                                  </div>
                                  <p class="orderdate"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>{{$order->created_at}}</p>
                                  <p class="orderidnumber">Order no: <span> {{$order->order_no}}</span></p>
                              </div>
                            </div>
                            @endforeach
                            @if(count($data['delivery_orders'])>1)
                              <button onclick="window.location.href='{{route('theme.delivery_orders')}}';" class="btn-seemore">See More <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                            @endif
                        </div>   
                      </div>
                      @endif

                      @if(count($data['completed_orders']))
                        <div class="col-md-3 color-1-col">
                        <div class="status-details card newcard-status">
                        <h3 class="order-heading color-1"><a href="#">Completed Orders</a></h3>
                            @foreach($data['completed_orders']->slice(0,5) as $order)
                            <div class="stylist-box" onclick="window.location.href='{{route('theme.orders.show',['id'=>$order->id])}}';">
                              <div class=" own-media-box">
                                  <img class="mr-3" src="{{asset('asset/images/customerimage.png')}}">
                                  <div class="media-body">
                                    <h5>{{$order->user->name}}</h5>
                                    <!-- <p>£{{$order->total}}</p>  -->
                                    <p class="text-uppercase">{{$order->schedule}}</p> 
                                  </div>
                                  <p class="orderdate"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>{{$order->created_at}}</p>
                                  <p class="orderidnumber">Order no: <span> {{$order->order_no}}</span></p>
                              </div>
                            </div>
                            @endforeach
                            @if(count($data['completed_orders'])>1)
                              <button onclick="window.location.href='{{route('theme.completed_orders')}}';" class="btn-seemore">See More <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                            @endif
                        </div>   
                      </div>
                      @endif


                     

                        

                     </div>
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
@include('admin.template.Food_Delivery.partials.footer')