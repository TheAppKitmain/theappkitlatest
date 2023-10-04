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
                  <div class="col-lg-12 col-xl-12 col-md-12 products">
                  <h2 class="table-title-custom">List of all new orders</h2>
				    <div class="cat-box shadow-d data-table-wrapper">
					<table id="example" class="table table-striped table-bordered" style="width:100%">
        				<thead>
            				<tr>
            					<th class="sorting_desc">ID</th>
				                <th>Order no</th>
				                <th>Customer Name</th>
				                <th>Total</th>
				                <!-- <th>Status</th> -->
				                <th>View</th>
            				</tr>
        				</thead>
        				<tbody>
        					@foreach($data['new_orders'] as $order)
            				<tr>
            					<td>{{$order->id}}</td>
            					<td class="text-capitalize">{{$order->order_number ?? ""}}</td>
				                <td class="text-capitalize">{{$order->app_user->name ?? ""}}</td>
                                @if(Auth::user()->country == 'United Kingdom')        
				                <td class="text-capitalize">&#163;{{$order->total}}</td>
                                @else
                                <td class="text-capitalize">${{$order->total}}</td>
                                @endif
				                <td>
									<a href="{{route('theme.myorders.show',$order->id)}}" class="btn btn-primary btn-xs">View</a>
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