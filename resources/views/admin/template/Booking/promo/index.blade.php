@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Booking.partials.sidemenu')

<div class="main-home">
      <div class="main-wrapper maininnerallpagescontainer">
      <div class="container-fluid no-padding">
        <div class="row no-gutters">
            <div class="col-md-12">
				<nav>
					<ol class="breadcrumb page-title-top">
						<li class="breadcrumb-item active">Promo</li>
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

				<h2 class="table-title-custom">Promo</h2>
			</div>

			<div class="col-lg-12 col-xl-12 col-md-12">
				<div class="cat-box shadow-d data-table-wrapper">
					<table id="example" class="table table-striped table-bordered" style="width:100%">
        				<thead>
            				<tr>
            					<th>ID</th>
				                <th>Promo Code</th>
				                <th>Discount</th>
				                <th>Action</th>
            				</tr>
        				</thead>
        				<tbody>
        					@foreach($promos as $promo)
            				<tr>
            					<td>{{$promo->id}}</td>
				                <td>{{$promo->promo_code}}</td>
				                <td class="text-capitalize">{{$promo->discount}}</td>
				                <td>
								<a href="{{route('theme.booking_promo.edit', $promo->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a>
								<a onclick="deleteData('{{route('theme.booking_promo.destroy', $promo->id)}}')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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



@include('admin.template.Booking.partials.footer')

