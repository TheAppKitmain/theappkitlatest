@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Food_Delivery.partials.sidemenu')

<div class="main-home">
<div class="main-wrapper maininnerallpagescontainer">
<div class="container-fluid no-padding">
        <div class="row no-gutters no-margin">
            <div class="col-md-12">
				<nav>
					<ol class="breadcrumb page-title-top">
					
						<li class="breadcrumb-item"><a href="{{route('theme.food_category.index')}}">Category</a></li>
						<li class="breadcrumb-item active">{{$category->name}}</li>
						<li class="breadcrumb-item text-right"><a href="{{route('theme.food_category.index')}}">Back</a></li>
					</ol>
				</nav>
            </div>
        </div>
    </div>
<div class="container-fluid">
		<div class="row no-gutters">
			<div class="col-md-4">
				<div class="product-details-box">
					<div class="product-details-images">
						<img src="{{$category->image}}">
					</div>
					<div class="w-100 float-left main-deatils	">
						<div class="w-100 float-left">
							<div class="float-left left-title">Parent Category:</div><div class="float-right right-desi">{{$category->parent->name ?? ''}}</div>
						</div>
						<div class="w-100 float-left">
							<div class="float-left left-title">Name:</div><div class="float-right right-desi">{{$category->name}}</div>
						</div>
						<div class="w-100 float-left">
							<div class="float-left left-title">Description:</div><div class="float-right right-desi">{{$category->description}}</div>
						</div>
						<div class="w-100 float-left">
							<div class="float-left left-title">Date :</div><div class="float-right right-desi">{{$category->created_at->format('d M Y h:i A')}}</div>
						</div>
						<div class="w-100 float-left">
							<div class="float-left left-title">Status :</div><div class="float-right right-desi text-capitalize">{{$category->status}} </div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-8 col-xl-8 col-md-8">
			<div class="m-l-20">
				<div class="cat-box shadow-d data-table-wrapper product-details-box">
					<table id="example" class="table table-striped table-bordered" style="width:100%">
        				<thead>
            				<tr>
            					<th>ID</th>
				                <th>Image</th>
				                <th>Parent Category</th>
				                <th>Name</th>
				                <th>Status</th>
				                <th>Action</th>
            				</tr>
        				</thead>
        				<tbody>
        					@foreach($category->children as $cat)
            				<tr>
            					<td>{{$cat->id}}</td>
				                <td>@if(!is_null($cat->image)) <img src="{{$cat->image}}" style="width:100px;height:100px;"> @endif
				                </td>
				                <td class="text-capitalize">
				                	{{$cat->parent->name ?? ""}}
				                </td>
				                <td class="text-capitalize">{{$cat->name}}</td>
				                <td class="text-capitalize">{{$cat->status}}</td>
				                <td>
									<a href="{{route('theme.food_category.show',$cat->id)}}" class="btn btn-success btn-xs"><i class="fa fa-eye" aria-hidden="true"></i></a>
									<a href="{{route('theme.food_category.edit',$cat->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									<a onclick="deleteData('{{route('theme.food_category.destroy',$cat->id)}}')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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

	<!--Product Delete Modal here -->

	<div id="myfoodcategoryModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Are you sure?</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<form method="post" action="" id="deleteForm">
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
	</div>

	<!--Product Delete Modal End here -->

	@include('admin.template.Food_Delivery.partials.footer')

<script>
function deleteData(url)
{
    $("#deleteForm").attr('action', url);
    $('#myfoodcategoryModal').modal();
}   
</script>