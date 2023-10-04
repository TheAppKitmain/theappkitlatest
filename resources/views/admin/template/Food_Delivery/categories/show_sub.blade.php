@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Food_Delivery.partials.sidemenu')

<div class="main-home">

<div class="container-fluid no-padding">
        <div class="row no-gutters">
            <div class="col-md-12">
				<nav>
					<ol class="breadcrumb page-title-top">
				
						<li class="breadcrumb-item active">Sub Categories</li>
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
				<h2 class="table-title-custom">List of all sub categories</h2>
			</div>

			<div class="col-lg-12 col-xl-12 col-md-12">
				<div class="cat-box shadow-d data-table-wrapper">
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
        					@foreach($categories as $category)
            				<tr>
            					<td>{{$category->id}}</td>
				                <td>@if(!is_null($category->image)) <img src="{{$category->image}}" style="width:100px;height:100px"> @endif
				                </td>
				                <td class="text-capitalize">
				                	{{$category->parent->name ?? ""}}
				                </td>
				                <td class="text-capitalize">{{$category->name}}</td>
				                <td class="text-capitalize">{{$category->status}}</td>
				                <td>
									<a href="{{route('theme.food_categories.show',$category->id)}}" class="btn btn-success btn-xs"><i class="fa fa-eye" aria-hidden="true"></i></a>
									<a href="{{route('theme.food_categories.edit',$category->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									<a onclick="deleteData('{{route('theme.food_categories.destroy',$category->id)}}')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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

@include('admin.template.Food_Delivery.partials.footer')
<script>
function deleteData(url)
{
    $("#deleteForm").attr('action', url);
    $('#myfoodcategoryModal').modal();
}   
</script>