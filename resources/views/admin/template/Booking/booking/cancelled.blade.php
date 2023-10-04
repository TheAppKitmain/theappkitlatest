@extends('layouts.app')

@section('content')
<div class="main-wrapper">
	<div class="container-fluid no-padding">
        <div class="row no-gutters">
            <div class="col-md-12">
				<nav>
					<ol class="breadcrumb page-title-top">
						<li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="{{route('bookings')}}">Bookings</a></li>
						<li class="breadcrumb-item active">Cancelled Jobs</li>
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

				<h2 class="table-title-custom">List of all cancelled jobs</h2>
			</div>

			<div class="col-lg-12 col-xl-12 col-md-12 products">
				<div class="cat-box shadow-d data-table-wrapper">
					<table id="example" class="table table-striped table-bordered" style="width:100%">
        				<thead>
            				<tr>
            					<th class="sorting_desc">ID</th>
				                <th>Order no</th>
				                <th>Customer Name</th>
				                <th>Total</th>
				                <th>View</th>
            				</tr>
        				</thead>
        				<tbody>
        					@foreach($cancelled_jobs as $order)
            				<tr>
            					<td>{{$order->id}}</td>
            					<td class="text-capitalize">#00000{{$order->id}}</td>
				                <td class="text-capitalize">{{$order->user->name ?? ""}}</td>
				                <td class="text-capitalize">£{{$order->total}}</td>
				                <td>
									<a href="{{route('view_job',['id'=>$order->id])}}" class="btn btn-primary btn-xs">View</a>
								</td>
            				</tr>	
            				@endforeach
            			</tbody>
    				</table>
				</div>
			</div>
		</div>
	</div>
</div>

@stop