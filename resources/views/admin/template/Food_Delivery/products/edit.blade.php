@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Food_Delivery.partials.sidemenu')

<div class="main-home">
<div class="main-wrapper maininnerallpagescontainer">
<div class="main-wrapper ">
    <div class="main-container-inner card">
    	<div class="card-main card">
        	<div class="container-fluid no-padding ">
           		<div class="row no-gutters">
              		<div class="col-md-12">
                 		<nav>
                    		<ol class="breadcrumb page-title-top">
                       			<li class="breadcrumb-item"><a href="{{route('theme.food_products.index')}}">Products</a></li>
                       			<li class="breadcrumb-item active">Edit</li>
                       			<li class="breadcrumb-item text-right"><a href="{{route('theme.food_products.index')}}">Back</a></li>
                    		</ol>
                 		</nav>
              		</div>
           		</div>
        	</div>
        	<div class="container-fluid addproduct-page">
           		<div class="">
           			<form role="form" data-toggle="validator" action="{{route('theme.food_products.update',$product->id)}}" method="post" enctype="multipart/form-data">
           			@csrf
		   			<div class="row">
						<div class="col-lg-12">
							<div class="form-group f-g-o">
					  			<label for="usr">Select Category</label>
							   	<select name="category_id" class="form-control" onchange="categoryChange(this.value)" data-error="This field is required.">
							   		<option value="">Choose...</option>
									@foreach($categories as $category)
										@if(in_array($category->id,$categoryid))
										<option {{old('category_id')}} selected
											value="{{$category->id}}">{{$category->name}}</option>
										@else
											<option {{old('category_id')}}
											value="{{$category->id}}">{{$category->name}}</option>
										@endif

									@endforeach
								</select>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-lg-12">
							
							<div class="form-group f-g-o">
					  			<label for="usr">Select Sub Category</label>
							   	<select name="subcategory_id[]" class="select_multiple form-control" id="subcategory_id" multiple="multiple">
									@foreach($categoryyy as $cats)
									@if(!empty($cats->children))
									@foreach($cats->children as $cat)
									@if(in_array($cat->id,$categoryid))
									<option selected value="{{$cat->id}}">{{$cat->name}}</option>
									@else
									<option value="{{$cat->id}}">{{$cat->name}}</option>
									@endif
									@endforeach
									@endif
									@endforeach
									
								</select>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group f-g-o">
					  			<label for="usr">Product Name</label>
					  			<input type="text" class="form-control{{ $errors->has('product_name') ? ' is-invalid' : '' }}" placeholder="Enter Product Name" name="product_name" required value="{{old('product_name', $product->product_name)}}" data-error="This field is required.">
					  			@if ($errors->has('product_name'))
	                                <span class="invalid-feedback" role="alert">
	                                    <strong>{{ $errors->first('product_name') }}</strong>
	                                </span>
	                            @endif
	                            <div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group f-g-o">
					  			<label for="usr">Product Price</label>
					  			<input type="number" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" placeholder="Enter Product Price" name="price" required value="{{old('price', $product->price)}}" data-error="This field is required.">
					  			@if ($errors->has('price'))
	                                <span class="invalid-feedback" role="alert">
	                                    <strong>{{ $errors->first('price') }}</strong>
	                                </span>
	                            @endif
	                            <div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group f-g-o">
					  			<label for="usr">Short Description</label>
					  			<textarea class="form-control" placeholder="Add Description" name="short_description" data-error="This field is required."> {{old('short_description', $product->short_description)}}</textarea>
					  			<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group f-g-o">
					  			<label for="usr">Long Description</label>
					  			<textarea class="form-control" placeholder="Add Long Description" name="long_description" data-error="This field is required.">{{old('long_description', $product->long_description)}}</textarea>
					  			<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group f-g-o">
						  		<label for="usr">Product Image</label>
						  		</br>
						  		<img style="width:150px;height:150px" src="{{$product->product_image}}">
						  		</br>
						  		<input type="file" name="product_image" id="file-7" class="inputfile inputfile-6 form-control" accept="image/*">
							</div>
						</div>
						<div class="col-lg-6 col-xl-4 col-md-6">
							<div class="form-group f-g-o">
					  			<label for="usr">Status </label>
					  			<div class="d-flex">
					  				<div class="w3-half">
										<div class="custom-control custom-radio mt-3">
						  					<input type="radio" id="customRadio1" name="status" class="custom-control-input"value="active" {{$product->status == "active" ? "checked" : ""}}>
						  					<label class="custom-control-label" for="customRadio1">Active</label>
										</div>
					  				</div>
					  				<div class="w3-half">
										<div class="custom-control custom-radio mt-3">
						  					<input type="radio" id="customRadio2" name="status" class="custom-control-input" {{$product->status == "inactive" ? "checked" : ""}} value="inactive">
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
</div>



@include('admin.template.Food_Delivery.partials.footer')
<script>
function categoryChange(value)
{
	$("#subcategory_id").empty();
	$.ajax({
		type:'post',
		url:'{{route("theme.get_category")}}',
		data:{'_token':'{{csrf_token()}}','id':value},
		success:function(data)
		{
			console.log(data)
			$("#subcategory_id").append(data.category);
		}
	});
}
</script>
