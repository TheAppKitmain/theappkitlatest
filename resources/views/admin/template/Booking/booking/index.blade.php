@extends('layouts.app')

@section('content')
<div class="main-wrapper">
   <div class="container-fluid no-padding">
      <div class="row no-gutters">
         <div class="col-md-12">
            <nav>
               <ol class="breadcrumb page-title-top">
                  <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Booking</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
   <div class="container-fluid ">
      <div class="row no-gutters shadow-d data-table-wrapper bgcolor-status">
         <div class="col-md-12">
            <div class="product-details-box border0">
               <div class="row">
                  @if(count($data['new_booking']))
                  <div class="col-md-3">
                     <div class="status-details card">
                        <h3 class="stylist-heading color-1">New Jobs</h3>
                        @foreach($data['new_booking']->slice(0,5) as $order)
                       <div class="stylist-box" onclick="window.location.href='{{route('view_job',['id'=>$order->id])}}';">
                           <div class=" own-media-box">
                              <img class="mr-3" src="{{asset('images/customer.png')}}">
                              <div class="media-body">
                                 <h5>{{$order->user->name}}</h5>
                                 <p class="text-uppercase">{{$order->created_at->format('d/m/Y')}}</p> 
                                
                              </div> 
                              <p class="orderdate">Job Date: <i class="fa fa-calendar-check-o" aria-hidden="true"></i>{{$order->date}}</p>
                              <p class="orderdate">Job Time: <i class="fa fa-calendar-check-o" aria-hidden="true"></i>{{$order->time}}</p>
                              <p class="orderidnumber">Order no: <span>{{$order->order_no}}</span></p>
                           </div>
                        </div>
                        @endforeach
                        @if(count($data['new_booking'])>5)
                           <button onclick="window.location.href='{{route('new_booking')}}';" class="btn-seemore">See More <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                        @endif
                     </div>   
                  </div>
                  @endif

                  @if(count($data['accept_jobs']))
                  <div class="col-md-3">
                     <div class="status-details card">
                        <h3 class="stylist-heading color-1">Accepted Jobs</h3>
                        @foreach($data['accept_jobs']->slice(0,5) as $order)
                       <div class="stylist-box" onclick="window.location.href='{{route('view_job',['id'=>$order->id])}}';">
                        <div class=" own-media-box">
                              <img class="mr-3" src="{{asset('images/customer.png')}}">
                              <div class="media-body">
                                 <h5>{{$order->user->name}}</h5>
                                 <p class="text-uppercase">{{$order->created_at->format('d/m/Y')}}</p> 
                                
                              </div>
                              <p class="orderdate">Job Date: <i class="fa fa-calendar-check-o" aria-hidden="true"></i>{{$order->date}}</p>
                              <p class="orderdate">Job Time: <i class="fa fa-calendar-check-o" aria-hidden="true"></i>{{$order->time}}</p>
                              <p class="orderidnumber">Order no: <span>{{$order->order_no}}</span></p>
                           </div>
                        </div>
                        @endforeach
                        @if(count($data['accept_jobs'])>5)
                           <button onclick="window.location.href='{{route('accept_jobs')}}';" class="btn-seemore">See More <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                        @endif
                     </div>   
                  </div>
                  @endif

                  <!-- @if(count($data['started_jobs']))
                  <div class="col-md-3">
                     <div class="status-details card">
                        <h3 class="stylist-heading color-1">Started Jobs</h3>
                        @foreach($data['started_jobs']->slice(0,5) as $order)
                       <div class="stylist-box" onclick="window.location.href='{{route('view_job',['id'=>$order->id])}}';">
                     <div class=" own-media-box">
                              <img class="mr-3" src="{{asset('images/customer.png')}}">
                              <div class="media-body">
                                 <h5>{{$order->user->name}}</h5>
                                 <p class="text-uppercase">{{$order->created_at->format('d/m/Y')}}</p> 
                                
                              </div>
                              <p class="orderdate">Job Date: <i class="fa fa-calendar-check-o" aria-hidden="true"></i>{{$order->date}}</p>
                              <p class="orderdate">Job Time: <i class="fa fa-calendar-check-o" aria-hidden="true"></i>{{$order->time}}</p>
                              <p class="orderidnumber">Order no: <span>{{$order->order_no}}</span></p>
                           </div>
                        </div>
                        @endforeach
                        @if(count($data['started_jobs'])>5)
                           <button onclick="window.location.href='{{route('started_jobs')}}';" class="btn-seemore">See More <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                        @endif
                     </div>   
                  </div>
                  @endif -->

                  @if(count($data['completed_jobs']))
                  <div class="col-md-3">
                     <div class="status-details card">
                        <h3 class="stylist-heading color-1">Completed Jobs</h3>
                        @foreach($data['completed_jobs']->slice(0,5) as $order)
                       <div class="stylist-box" onclick="window.location.href='{{route('view_job',['id'=>$order->id])}}';">
                           <div class=" own-media-box">
                              <img class="mr-3" src="{{asset('images/customer.png')}}">
                              <div class="media-body">
                                 <h5>{{$order->user->name}}</h5>
                                 <p class="text-uppercase">{{$order->created_at->format('d/m/Y')}}</p> 
                                
                              </div>
                              <p class="orderdate">Job Date: <i class="fa fa-calendar-check-o" aria-hidden="true"></i>{{$order->date}}</p>
                              <p class="orderdate">Job Time: <i class="fa fa-calendar-check-o" aria-hidden="true"></i>{{$order->time}}</p>
                              <p class="orderidnumber">Order no: <span>{{$order->order_no}}</span></p>
                           </div>
                        </div>
                        @endforeach
                        @if(count($data['completed_jobs'])>5)
                           <button onclick="window.location.href='{{route('completed_jobs')}}';" class="btn-seemore">See More <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
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
@endsection