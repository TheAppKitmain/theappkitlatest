@extends('layouts.app')

@section('content')
<div class="main-wrapper">
   <div class="container-fluid no-padding">
      <div class="row no-gutters">
         <div class="col-md-12">
            <nav>
               <ol class="breadcrumb page-title-top">
                  <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Orders</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-xl-12 col-md-12">
            @if(Session::get('alert'))
            <div class="alert alert-{{Session::get('alert')}} alert-dismissible" role="alert">
              <p>{{Session::get('message')}} </p>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            @endif
            <h2 class="table-title-custom">Booking History</h2>
         </div>
            <div class="col-lg-12 col-xl-12 col-md-12">
               <div class="shadow-d data-table-wrapper text-left order-details-container">
                  <div class="bd-example bd-example-tabs">
                     <div class="row admin-status-row">
                        <div class="col-lg-12">
                           <h3 class="title-profile-order bgcolor5">Booking no: #0000{{$order->id}}</h3>
                        </div>
                        <div class="col-lg-4">
                           <h3 class="title-profile-order bgcolor5">Customer Information</h3>
                           <p class="addressp"><strong>Name : </strong> <span>{{$order->user->name}}</span></p>
                           <p class="addressp"><strong>Email : </strong> <span>{{$order->user->email}}</span></p>
                           <p class="addressp"><strong>Mobile : </strong> <span>{{$order->user->mobile}}</span></p> 
                           <p class="addressp"><strong>Postcode : </strong> <span>{{$order->user_information->postcode}}</span></p>
                           <p class="addressp"><strong>City : </strong> <span>{{$order->user_information->city}}</span></p>
                           <p class="addressp"><strong>Address : </strong> <span>{{$order->user_information->address}} , {{$order->user_information->address_line}}</span></p>
                        </div>
                        <div class="col-lg-4">
                           <h3 class="title-profile-order bgcolor5">Car Information</h3>
                           <p class="addressp"><strong>Licence Plate : </strong> <span>{{$order->licence_plate}}</span></p>
                           <p class="addressp"><strong>Make : </strong> <span>{{$order->make}}</span></p>
                           <p class="addressp"><strong>Model : </strong> <span>{{$order->model}}</span></p>
                           <p class="addressp"><strong>Year : </strong> <span>{{$order->year}}</span></p>
                           <?php if($order->status == 2):
                                 if(!is_null($booking_imgs['before'])): ?>
                                 <p class="addressp"><strong>Before Images : </strong></p>
                                 @foreach($booking_imgs['before'] as $before)
                                    <img src="<?php echo asset($before->image); ?>" onclick="window.open(this.src)" style="margin:2px;width: 100px;height: 100px;">
                                 @endforeach
                           <?php endif; endif; ?>
                           <?php if($order->status == 2):
                                 if(!is_null($booking_imgs['after'])): ?>
                                 <p class="addressp"><strong>After Images : </strong></p>
                                 @foreach($booking_imgs['after'] as $after)
                                   <img src="<?php echo asset($after->image); ?>" onclick="window.open(this.src)" style="margin:2px;width: 100px;height: 100px;">
                                 @endforeach
                           <?php endif; endif; ?> 
                        </div>
                        <div class="col-lg-4">
                           <div class="profile-container">
                              <h3 class="title-profile bgcolor5">Booking Information</h3>
                              <p class="addressp"><strong>Booking Date: </strong> <span>{{$order->created_at->format('d-m-Y')}}</span></p>
                              <p class="addressp"><strong>Car Type: </strong> <span>{{$order->cartype->name}}</span></p>
                              <p class="addressp"><strong>Deal : </strong> <span>{{$order->deal->name}}</span></p>
                              <?php if(!empty($services)): ?>
                              <p class="addressp"><strong>Deal services : </strong> 
                                 @foreach($services as $service)
                                   <span class="booking_services">{{$service->name}}</span>
                                 @endforeach
                              </p>
                             <?php endif; ?>
                              <p class="addressp"><strong>Payment Receipt : </strong> <a href="{{$order->payment_recipt}}">Receipt url</a></p>
                              <p class="addressp"><strong>Job Date : </strong> <span>{{$order->date}}</span></p>
                              <p class="addressp"><strong>Job Time : </strong> <span>{{$order->time}}</span></p>
                              <p class="addressp"><strong>Washprice : </strong> <span> {{$order->currency."".$order->deal->price ?? "-"}}</span></p>
                              <p class="addressp"><strong>Vat : </strong> <span> {{$order->vat ?? "-"}} %</span></p>
                              <p class="addressp"><strong>Service fee : </strong> <span> {{$order->currency."".$order->service_fee ?? "-"}}</span></p>
                              <p class="addressp"><strong>Total : </strong> <span> {{$order->currency."".$order->total ?? "-"}}</span></p>
                           </div>
                           <h3 class="title-profile-order bgcolor5" style="margin-top: 27px">Status</h3>
                           <h4 class="h4status text-capitalize">
                              @if ($order->status == 0)
                                 Pending
                              @elseif ($order->status == 1)
                                 Confirmed
                              @elseif ($order->status == 2)
                                 Completed
                              @elseif ($order->status == 3)
                                 Cancelled
                              @endif
                           </h4>
                        <?php if($order->status == 0 || $order->status == 1){ ?>
                           <form action="{{route('update_status')}}" method="POST">@csrf
                              <input type="hidden" name="id" value="{{$order->id}}">
                              <div class="statusbox d-flex">
                                 <div class="radiobox">
                                   <input type="radio" id="control_02" name="booking_status" value="0" {{$order->status == "0" ? "checked" : ""}}>
                                   <label for="control_02"><h2>Pending</h2></label>
                                 </div>
                                 <div class="radiobox">
                                   <input type="radio" id="control_03" name="booking_status" value="1" {{$order->status == "1" ? "checked" : ""}}>
                                   <label for="control_03"><h2>Confirmed</h2></label>
                                 </div>
                              </div>
                              <div class="float-right savebtn-box"><button class="btn-style btn-color stylistsavebtn-">Save</button></div>
                           </form>
                        <?php } ?>
                        </div>
                     </div>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection