@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Food_Delivery.partials.sidemenu')

<div class="main-home">
   <div class="main-container">
      <div class="main-container-inner  mt-40">

      <div class="container-fluid no-padding ">
        <div class="row no-gutters">
            <div class="col-md-12">
                <nav>
                    <ol class="breadcrumb page-title-top">
                     
                        <li class="breadcrumb-item"><a href="{{route('theme.food_category.index')}}">Categories</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                        <li class="breadcrumb-item text-right"><a href="{{route('theme.food_category.index')}}">Back</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
      <div class="container-fluid">
               			<form action="{{route('theme.food_category.update',$category->id)}}" method="post" enctype="multipart/form-data">
                      
               			@csrf
               			{{ method_field('PUT') }}
			   			<div class="row">
							<div class="col-lg-12">
								<div class="form-group f-g-o">
						  			<label for="usr">Select Category</label>
								   	<select name="parent_id" class="form-control" value="{{old('parent_id', $category->parent_id)}}">
										<option value="0">Choose...</option>
										@foreach($parents as $parent)
											<option {{ old('parent_id',$category->parent_id) == $parent->id ? "selected" : "" }} value="{{$parent->id}}">{{$parent->name}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group f-g-o">
						  			<label for="usr">Name</label>
						  			<input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" name="name" required value="{{old('name', $category->name)}}">
						  			@if ($errors->has('name'))
		                                <span class="invalid-feedback" role="alert">
		                                    <strong>{{ $errors->first('name') }}</strong>
		                                </span>
		                            @endif
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group f-g-o">
						  			<label for="usr">Short Description</label>
						  			<textarea class="form-control" placeholder="Add Description" name="description">{{old('description', $category->description)}}</textarea>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group f-g-o">
							  		<label for="usr">Image</label>
							  		</br>
							  		<img style="width:150px;height:150px" src="{{$category->image}}">
							  		</br>
							  		<input type="file" name="image" id="file-7" class="inputfile inputfile-6 form-control" accept="image/*">
								</div>
							</div>
							<div class="col-lg-6 col-xl-4 col-md-6">
								<div class="form-group f-g-o">
						  			<label for="usr">Status </label>
						  			<div class="d-flex">
						  				<div class="w3-half">
											<div class="custom-control custom-radio mt-3">
							  					<input type="radio" id="customRadio1" name="status" class="custom-control-input" {{$category->status == "active" ? "checked" : ""}} value="active">
							  					<label class="custom-control-label" for="customRadio1">Active</label>
											</div>
						  				</div>
						  				<div class="w3-half">
											<div class="custom-control custom-radio mt-3">
							  					<input type="radio" id="customRadio2" name="status" class="custom-control-input" value="inactive" {{$category->status == "inactive" ? "checked" : ""}}>
							  					<label class="custom-control-label" for="customRadio2">Inactive</label>
											</div>
						  				</div>
						  			</div>
								</div>
							</div>
					
							<div class="col-lg-12 col-xl-12 col-md-12 catgory-btn-save">
								<div class="form-group"><button type="submit" class="btn-style btn-color">Save</button></div>
							</div>

			   			</div>
			   			</form>
			   		</div>
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