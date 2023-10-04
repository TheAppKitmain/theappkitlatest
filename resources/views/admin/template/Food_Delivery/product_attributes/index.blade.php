@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Food_Delivery.partials.sidemenu')
<div class="main-home">
<div class="main-wrapper maininnerallpagescontainer">
<div class="main-wrapper">
	<div class="container-fluid">
        <div class="row ">
            <div class="col-md-12">
				<nav>
					<ol class="breadcrumb page-title-top">
					
						<li class="breadcrumb-item active">Featured Product</li>
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

				<h2 class="table-title-custom">Featured Product</h2>
			</div>

			<div class="col-lg-12 col-xl-12 col-md-12">
				<div class="cat-box shadow-d data-table-wrapper">
					<table class="featured_product table table-striped table-bordered" style="width:100%">
        				<thead>
            				<tr>
            					<th>ID</th>
				                <th>Name</th>
				                <th>Sort</th>
				                <th>Delete</th>
            				</tr>
        				</thead>
        				<tbody>
        					@foreach($products as $product)
            				<tr>
            					<td>{{$product->id}}</td>
				                <td class="text-capitalize">{{$product->product->product_name}}</td>

				                <td class="text-capitalize">
				                	<form action="{{route('theme.position',$product->id)}}" method="post" enctype="multipart/form-data">	
										@csrf
										
										<input class="tableinput" type="number" name="position" value="{{$product->position}}">
										<input type="submit" value="Save" class="btn btn-sm btn-primary">
									</form>
				                </td>
								
				                <td>
				                	<a onclick="deleteData('{{route('theme.food_product_attributes.destroy',$product->id)}}')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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

<div id="myfoodproductModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Are you sure?</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<form method="post" action="" id="deletefoodproductForm">
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

@include('admin.template.Food_Delivery.partials.footer')

<script>
function deleteData(url)
{

    $("#deletefoodproductForm").attr('action', url);
    $('#myfoodproductModal').modal();
}   
</script>

