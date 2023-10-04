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
						<li class="breadcrumb-item active">Deal</li>
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
				<h2 class="table-title-custom">List of all car types</h2>
			</div>

			<div class="col-lg-12 col-xl-12 col-md-12">
				<div class="cat-box shadow-d data-table-wrapper">
					<table id="example" class="table table-striped table-bordered" style="width:100%">
        				<thead>
            				<tr>
            					<th>ID</th>
            					<th>Image</th>
				                <th>Name</th>
				                <th>Price</th>
				                <th>Status</th>
				                <th>Action</th>
            				</tr>
        				</thead>
        				<tbody>
        					@foreach($deals as $deal)
            				<tr>
            					<td>{{$deal->id}}</td>
            					<td>@if(!is_null($deal->image)) <img src="{{$deal->image}}" style="width:100px;height:100px"> @endif </td>
				                <td class="text-capitalize">{{$deal->name}}</td>
				                <td class="text-capitalize">{{$deal->price}}</td>
				                <td class="text-capitalize">{{$deal->status}}</td>	
				                <td>
									<a href="{{ route ('theme.deals.show', $deal->id) }}" class="btn btn-success btn-xs"><i class="fa fa-eye" aria-hidden="true"></i></a>
									<a href="{{ route ('theme.deals.edit', $deal->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									<a onclick="deleteData('{{route ('theme.deals.destroy', $deal->id ) }}')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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

