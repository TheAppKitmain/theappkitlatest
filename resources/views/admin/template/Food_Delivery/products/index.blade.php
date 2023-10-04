@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Food_Delivery.partials.sidemenu')
<div class="main-home">
<div class="main-wrapper maininnerallpagescontainer">
<div class="main-wrapper">
	<div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
				<nav>
					<ol class="breadcrumb page-title-top">
					
						<li class="breadcrumb-item active">Products</li>
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

				<h2 class="table-title-custom">List of all products</h2>
			</div>

			<div class="col-lg-12 col-xl-12 col-md-12 products">
				<div class="cat-box shadow-d data-table-wrapper">
					<table id="example" class="table table-striped table-bordered" style="width:100%">
        				<thead>
            				<tr>
            					<th class="sorting_desc">ID</th>
				                <th>Image</th>
				                <th>Product Type</th>
				                <th>Category</th>
				                <th>Name</th>
				                <th>Price</th>
				                <th>Status</th>
				                <th>Action</th>
            				</tr>
        				</thead>
        				<tbody>
        					@foreach($products as $product)
            				<tr>
            					<td>{{$product->id}}</td>
            					<td><img src="{{$product->product_image}}" style="width:100px; height:100px">
            					</td>
									<td class="text-capitalize">{{$product->product_type ?? ""}}</td>
									<td class="text-capitalize">{{$product->category_name ?? ""}}</td>
									<td class="text-capitalize">{{$product->product_name}}</td>
									<td class="text-capitalize">{{$product->price}}</td>
									<td class="text-capitalize">{{$product->status}}</td>
				                <td>
									<a href="{{route('theme.edit_product',['id'=>$product->cat_id,'product_id'=>$product->id])}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									<a onclick="deleteData('{{route('theme.food_products.destroy',$product->id)}}')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
								</td>
            				</tr>	
            				@endforeach
            			</tbody>
    				</table>
					{{ $products->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>

<!-- <div id="myfoodproductModal" class="modal fade">
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
</div> -->


<div class="modal fade popup-template-modal" id="myfoodproductModal" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
         <!-- Modal content-->
         <div class="modal-content">
         <div class="modal-header">
         <img class="modallogoimg" src="{{asset('images/theapp.png')}}" alt="eyeimage">
         </div>
         <div class="">
            <form method="post" action="" id="deletefoodproductForm">
               @csrf
               {{ method_field('DELETE') }}
               <div class="modal-body">
                  <p>Do you really want to delete these records? This process cannot be undone.</p>
               </div>
               <div class="modal-footer mdl-ftr-del">
                  <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-danger">Delete</button>
               </div>
            </form>
         </div>
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
