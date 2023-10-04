@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.booking.partials.sidemenu')
<div class="main-home">
      <div class="main-wrapper maininnerallpagescontainer">
      <div class="main-wrapper">
	<div class="container-fluid no-padding">
        <div class="row no-gutters">
            <div class="col-md-12">
				<nav>
					<ol class="breadcrumb page-title-top">
						<li class="breadcrumb-item active">Customers</li>
					</ol>
				</nav>
            </div>
        </div>
    </div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-xl-12 col-md-12">
				<h2 class="table-title-custom">List of all customers</h2>
			</div>
			<div class="col-lg-12 col-xl-12 col-md-12">
				<div class="cat-box shadow-d data-table-wrapper">
					<table id="example" class="table table-striped table-bordered" style="width:100%">
        				<thead>
            				<tr>
            					<th>ID</th>
				                <th>Image</th>
				                <th>Name</th>
				                <th>Email</th>
				                <th>Mobile</th>
				                <th>Status</th>
				   
				                <!-- <th>Action</th> -->
            				</tr>
        				</thead>
        				<tbody>
        					@foreach($users as $user)
            				<tr>
            					<td>{{$user->id}}</td>
								@if(!is_null($user->image))
				                <td><img src="{{$user->image}}" style="width:100px;height:100px"></td>
								@else
								<td><img src="{{asset('template/images/no_user.png')}}" style="width:100px;height:100px"></td>
								@endif
				                <td class="text-capitalize">{{$user->name}}</td>
				                <td>{{$user->email}}</td>
				                <td>{{$user->number}}</td>
				                <td class="text-capitalize">{{$user->status}}</td>
				 
				                <!-- <td>
									<button class="btn btn-success btn-xs" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-eye" aria-hidden="true"></i></button>
									<button class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></button>
									<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
								</td> -->
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
@include('admin.template.Booking.partials.footer')

