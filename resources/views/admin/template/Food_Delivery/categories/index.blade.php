@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Food_Delivery.partials.sidemenu')

<div class="main-home">
<div class="main-wrapper maininnerallpagescontainer">

   <div class="main-container">
      <div class="main-container-inner">
         <div class="container-fluid">
            <div class="row clearfix text-left ">
               <div class="col-md-12">
                  <div class=" card-own">
                  <div class="container-fluid no-padding">
                    <div class="row no-gutters">
                        <div class="col-md-12">
                            <nav>
                                <ol class="breadcrumb page-title-top">
                          
                                    <li class="breadcrumb-item active">Categories</li>
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
				<h2 class="table-title-custom">List of all categories</h2>
			</div>

			<div class="col-lg-12 col-xl-12 col-md-12">
				<div class="cat-box shadow-d data-table-wrapper">
					<table class="category_table table table-striped table-bordered" style="width:100%">
        				<thead>
            				<tr>
            					<th>ID</th>
				                <th>Image</th>
				                <th>Sort</th>
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
				                	@if(is_null($category->parent))

				                	<form action="{{route('theme.food_category.update',$category->id)}}" method="post" enctype="multipart/form-data">
                                
                                        	
										@csrf
										{{ method_field('PUT') }}
										<!-- <input type="hidden" name="id" value="{{$category->id}}"> -->
										<input class="tableinput" type="number" name="position" value="{{$category->position}}">
										<input type="submit" value="Save" class="btn btn-sm btn-primary">
									</form>
									@endif
				                </td>
				             
				                <td class="text-capitalize">{{$category->name}}</td>
				                <td class="text-capitalize">{{$category->status}}</td>
				                <td>
									<a href="{{route('theme.food_category.show',$category->id)}}"class="btn btn-success btn-xs"><i class="fa fa-eye" aria-hidden="true"></i></a>
									<a href="{{route('theme.food_category.edit',$category->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									<a onclick="deleteCategory('{{route('theme.food_category.destroy',$category->id)}}')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
</div>
</div>

@include('admin.template.Food_Delivery.partials.footer')


	<!--Categroy Delete Modal here -->
	<div class="modal fade popup-template-modal" id="myfoodcategoryModal" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
         <!-- Modal content-->
         <div class="modal-content">
         <div class="modal-header">
         <img class="modallogoimg" src="{{asset('images/theapp.png')}}" alt="eyeimage">
         </div>
         <div class="">
            <form method="post" action="" id="deletefoodcategoryForm">
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
	<!--Category Delete Modal End here -->

<script>
function deleteCategory(url)
{

    $("#deletefoodcategoryForm").attr('action', url);
    $('#myfoodcategoryModal').modal();
}   
</script>