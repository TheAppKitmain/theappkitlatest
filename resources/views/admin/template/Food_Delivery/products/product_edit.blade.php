@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Food_Delivery.partials.sidemenu')

<div class="main-home">
<div class="main-wrapper maininnerallpagescontainer">
<div class="main-wrapper">
	<div class="container-fluid no-padding">
        <div class="row no-gutters">
            <div class="col-md-12">
				<nav>
					<ol class="breadcrumb page-title-top">
						<li class="breadcrumb-item"><a href="{{route('theme.food_products.index')}}">Products</a></li>
						<li class="breadcrumb-item active">Edit Product</li>
					</ol>
				</nav>
            </div>
        </div>
    </div>
	<div class="container-fluid addproduct-page">
		<div class="row"> 
			<div class="col-lg-12 col-xl-12 col-md-12">

				@if(Session::get('alert'))
				<div class="alert alert-{{Session::get('alert')}} alert-dismissible" role="alert">
				  <p>{{Session::get('message')}} </p>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				@endif

				<h2 class="table-title-custom">Edit Product</h2>
			</div>
			<div class="col-lg-12 col-xl-12 col-md-12">
				<div class="cat-box shadow-d data-table-wrapper">
					<div class="bd-example bd-example-tabs">
						<div class="row">
							<div class="col-3">
								<div class="nav flex-column nav-pills  nav-pills-own">
									@php $ids = explode(',',$product->category_id)@endphp
									@foreach($categories as $category)
										@if(in_array($category->id,$ids))
										<a class="nav-link category_nav {{ (request()->is('theme/edit_product/'.$category->id.'/'.$product->id)) ? 'active' : '' }}" href="{{url('theme/edit_product/'.$category->id.'/'.$product->id)}}">{{$category->name}}</a>
										@else
										<a class="nav-link category_nav" href="{{url('theme/add_product/'.$category->id)}}">{{$category->name}}</a>
										@endif
									@endforeach
								</div>
							</div>
							<div class="col-9">
								<div class="tab-content tab-leftcntnt">
									<div class="tab-pane tab-pane-own fade active show">
										<form role="form" data-toggle="validator" action="{{url('theme/edit_product/'.request()->route('id').'/'.$product->id)}}" method="post" enctype="multipart/form-data" id="saveProduct">
											@csrf
											<input type="hidden" name="is_continoue" id="is_continoue">
											<div class="row">
												<div class="col-lg-12">
													<ul class="nav nav-tabs nav-tabs-prodt" id="myTab" role="tablist">
														<li class="nav-item">
															<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Edit</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Products</a>
														</li>
													</ul>
													<div class="tab-content tab-right-pr">
														<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
															<div class="row">
																<input type="hidden" class="form-control" name="category_id" value="{{request()->route('id')}}" >

																{{-- @if(count($another_categories)>0)
																@php $match = explode(',',$product->category_id); @endphp
																<div class="col-lg-12 col-xl-4 col-md-6">
																	<div class="form-group f-g-o">
																		<label for="usr">Add product in another category ?  </label>
																	</div>
																</div>
																@foreach($another_categories as $cate)

                                                                <div class="col-lg-12">
                                                                	<div class="cat-main-container">
																		<div class="custom-control maincategory custom-checkbox text-left">
																			@if(in_array($cate->id,$match))
																			<input type="checkbox" class="custom-control-input inputtemp" name="subcategory_id[]" id="checkbox_{{$cate->id}}" value="{{$cate->id}}" checked>

																			@else

																			<input type="checkbox" class="custom-control-input inputtemp" name="subcategory_id[]" id="checkbox_{{$cate->id}}" value="{{$cate->id}}">

																			@endif
																			<label class="custom-control-label" for="checkbox_{{$cate->id}}">
																				<span class="catnamemain">{{$cate->name}}</span>
																			</label>
																		</div>
																	</div>
																</div>

																@if(count($cate->children)>0)

																<div class="col-lg-12">
																  	<ul class="subcategoryul">
																  		@foreach($cate->children as $cat)
																  		<li class="float-left">
																			<div class="custom-control custom-checkbox">
																			@if(in_array($cat->id,$match))
																			<input type="checkbox" class="custom-control-input inputtemp" name="subcategory_id[]" id="checkbox_{{$cat->id}}" value="{{$cat->id}}" checked>

																			@else

																			<input type="checkbox" class="custom-control-input inputtemp" name="subcategory_id[]" id="checkbox_{{$cat->id}}" value="{{$cat->id}}">

																			@endif

																				<label class="custom-control-label" for="checkbox_{{$cat->id}}">
																					<span class="subcatname">{{$cat->name}}</span></label>
																			</div>
																		</li>
																		@endforeach
																  	</ul>
																</div>

																@endif
																@endforeach
																@endif --}}

																@if(count($subcategories)>0)
																<div class="col-lg-12">
																	<div class="form-group f-g-o">
																		<label for="usr">Select Subcategory</label>
																		<select name="subcategory_id[]" class="select_multiple form-control inputtemp" id="subcategory_id" multiple="multiple" required data-error="This field is required.">
																		<label class="labeltemp" for="usr">Select Sub Category</label>
																			<!-- <option value="" selected="selected">Choose...</option> -->
																			@php $ids = explode(',',$product->category_id)@endphp
																			@foreach($subcategories as $subcategory)
																			@if(in_array($subcategory->id,$ids))
																				<option selected {{ (old("subcategory_id") == $subcategory->id ? "selected":"") }} value="{{$subcategory->id}}" class="{{$subcategory->id}}">{{$subcategory->name}}</option>
																			@else
																				<option value="{{$subcategory->id}}" class="{{$subcategory->id}}">{{$subcategory->name}}</option>
																			@endif
																			@endforeach
																		</select>
																		<div class="help-block with-errors"></div>
																	</div>
																</div>
																@endif
																
																<div class="col-lg-12">
																	<div class="form-group f-g-o">
																		<label class="labeltemp" for="usr">Product Name</label>
																		<input type="text" class="form-control{{ $errors->has('product_name') ? ' is-invalid' : '' }} inputtemp" placeholder="Enter Product Name" name="product_name" required data-error="This field is required." value="{{ old('product_name',$product->product_name) }}">
																		@if ($errors->has('product_name'))
																			<span class="invalid-feedback" role="alert">
																				<strong>{{ $errors->first('product_name') }}</strong>
																			</span>
																		@endif
																		<div class="help-block with-errors"></div>
																	</div>
																</div>
																<div class="simple_product col-lg-12" style="{{$product->product_type == "simple" ? "display:block" : "display:none"}}">
																	<div class="row">
																		<div class="col-lg-12">
																			<div class="form-group f-g-o">
																				<label class="labeltemp" for="usr">Product Price</label>
																				<input type="text" pattern="^[1-9]\d*(\.\d+)?$" class="simple_req form-control inputtemp" placeholder="Enter Product Price" data-required-error="This field is required." data-pattern-error="Please enter a valid price." name="price" required value="{{ old('price',$product->product_type == "simple" ? $product->price : 0) }}">
																				<div class="help-block with-errors"></div>
																			</div>
																		</div>
																	</div>
																</div>

																<div class="col-lg-12">
																	<div class="form-group f-g-o">
																		<label class="labeltemp" for="usr">Short Description</label>
																		<textarea class="form-control inputtemp" placeholder="Add Description" required data-error="This field is required." name="short_description">{{ old('short_description',$product->short_description) }}</textarea>
																		<div class="help-block with-errors"></div>
																	</div>
																</div>
																<div class="col-lg-12">
																	<div class="form-group f-g-o">
																		<label class="labeltemp" for="usr">Long Description</label>
																		<textarea class="form-control inputtemp" placeholder="Add Long Description" required data-error="This field is required." name="long_description">{{ old('long_description',$product->long_description) }}</textarea>
																		<div class="help-block with-errors"></div>
																	</div>
																</div>
																<div class="col-lg-12">
																	<div class="row">
																		<div class="col-md-3 text-left">
																			<img style="width:150px;height:150px;margin-bottom: 20px" src="{{$product->product_image ?? asset('images/default.jpg')}}" class="img-thumbnail">
																		</div>
																		<div class="col-md-9 text-left">
																			<div class="form-group f-g-o">
																				<label class="labeltemp" for="usr">Default Image</label>
																		  		<input type="file" name="product_image" id="file-7" class="inputfile inputfile-6 form-control inputtemp" accept="image/*">
																			</div>
																		</div>
																	</div>
																</div>
																<div class="col-lg-12">
																	<div class="form-group f-g-o">
																		<div class="image_container">
																			<div class="row">
																				@if(count($product->product_images)>0)
																					@foreach($product->product_images as $image)
																					<div class="col-lg-2" id="image_{{$image->id}}">
																						<img style="width:150px;height:150px" src="{{$image->product_image ?? asset('images/default.jpg')}}" class="img-thumbnail">
																						<button type="button" class="btn btn-danger mt-20" onclick="removeImage('{{$image->id}}')">Remove</button>
																					</div>
																					@endforeach
																				@endif
																			</div>
																			<div class="row">
																				<div class="col-lg-10" style="margin-top: 30px">
																					<label for="usr" class="labeltemp">Product Image</label>
																					<input type="file" name="product_images[]"  id="file-7" data-error="This field is required." class="inputfile inputfile-6 form-control" accept="image/*">
																					<div class="help-block with-errors"></div>
																				</div>
																				<div class="col-lg-2">
																					<label for="usr"></label>
																					<button type="button" class="btn btn-primary add_more_image mt-20">Add More</button>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="variable_product col-lg-12"  style="{{$product->product_type == "variable" ? "display:block" : "display:none"}}">
																	<div class="row">
																		<div class="col-lg-12">
																			<div class="form-group f-g-o">
																				<div class="row">
																					<label for="usr" class="col-md-10 labeltemp">Add Product Attributes</label>
																					<div class="col-md-2"><button type="button" class="btn btn-primary add_more_button">Add Row</button></div>
																					<br>
																				</div>
																				<br>
																				<div class="input_fields_container">
																					@foreach($product->product_informations as $attribute)
																					<div class="row">
																						<input type="hidden" name="attribute_id[]" value="{{$attribute->id}}">
																						<div class="col-lg-5">
																							<input type="text" class="form-control variable_req" placeholder="Enter Attribute" data-error="This field is required." required name="attr[]" value="{{$attribute->attribute_name}}">
																							<div class="help-block with-errors"></div>
																						</div>
																						<div class="col-lg-5">
																							<input type="text" class="form-control variable_req" placeholder="Enter Product Price" data-error="This field is required." required value="{{$attribute->product_price}}" name="product_price[]">
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<br>
																					@endforeach
																		 
																				</div>

																			</div>
																		</div>
																	</div>
																</div>
																<div class="col-lg-6 col-xl-4 col-md-6">
																	<div class="form-group f-g-o">
																		<label class="labeltemp" for="usr">Status </label>
																		<div class="d-flex">
																			<div class="w3-half">
																				<div class="custom-control custom-radio mt-3 mr15">
																					<input type="radio" id="customRadio1" name="status" class="custom-control-input" value="active" {{$product->status == "active" ? "checked" : ""}}>
																					<label class="custom-control-label" for="customRadio1">Active</label>
																				</div>
																			</div>
																			<div class="w3-half">
																				<div class="custom-control custom-radio mt-3">
																					<input type="radio" id="customRadio2" name="status" class="custom-control-input" value="inactive" {{$product->status == "inactive" ? "checked" : ""}}>
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
														</div>
														<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
															<div class="col-lg-12 col-xl-12 col-md-12 products">
																<div class="cat-box shadow-d data-table-wrapper">
																	<table class="product_table table table-striped table-bordered" style="width:100%">
																		<thead>
																			<tr>
																				<th>ID</th>
																				<th>Image</th>
																				<th>Name</th>
																				<th>Price</th>
																				<th>Status</th>
																				<th>Sort</th>
																				<th>Action</th>
																			</tr>
																		</thead>
																		<tbody>
																			@foreach($products as $product)
																			<tr>
																				<td>{{$product->id}}</td>
																				<td><img src="{{$product->product_image}}" style="width:100px; height:100px">
																				</td>
																				<td class="text-capitalize">{{$product->product_name}}</td>
																				<td class="text-capitalize">{{$product->price}}</td>
																				<td class="text-capitalize">{{$product->status}}</td>
																				<td>
																					<form action="{{route('theme.update_position')}}" method="post" class="submitSort">
																                		@csrf
																                		<input type="hidden" name="id" value="{{$product->id}}">
																                		<input id="{{$product->id}}" class="tableinput" type="number" name="position" value="{{$product->position}}">
																                		<input type="submit" value="Save" class="btn btn-sm btn-primary">
																                	</form>
																				</td>
																				<td>
																					<a href="{{route('theme.edit_product',['id'=>request()->route('id'),'product_id'=>$product->id])}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a>

																					<a onclick="deleteData('{{route('theme.food_products.destroy',$product->id)}}')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
										</form>
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
</div>

<div id="productModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header">	
				<h5 class="modal-title">The product name has already been taken,would you like to continue?</h5>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-danger" id="saveProducts">Save</button>
				</div>

		</div>
	</div>
</div>  


@include('admin.template.Food_Delivery.partials.footer')

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

<script>
function deleteData(url)
{

    $("#deletefoodproductForm").attr('action', url);
    $('#myfoodproductModal').modal();
}   
</script>



<script type="text/javascript">
	$('#saveProducts').click(function()
	{
		$('#saveProduct').find('#is_continoue').val('yes');
		$('#saveProduct').submit();
		$('#productModal').modal('hide');
	})
</script>

<script>


$(document).ready(function() {
    $('#subcategory_id').select2();
});


$('#saveProduct').on('submit',function(e)
{
	e.preventDefault();
	var url = $(this).attr('action');
	var data = new FormData($(this)[0]);
	for(let [name, value] of data)
	{
  		console.log(`${name} = ${value}`); 
	}
	$.ajax
	({
		type:'post',
		url:url,
		data:data,
		processData: false,
  		contentType: false,
  		success:function(data)
  		{
  			if(data.errors)
  			{
  				console.log(data)
  				$('#productModal').modal('show');
  			}
  			else
  			{
  				location.reload();
  			}
  		},
	})
});

function removeImage(id)
{

	$.ajax ({
		type:'post',
		url:'{{route("theme.removeProductImage")}}',
		data:{'id':id,'_token':'{{csrf_token()}}'},
		success:function(data)
		{
			location.reload();

		}
	})
}


function categoryChange(value)
{
	$('#category_id').val(value);
	$('.category_nav').removeClass('active');
	$("#button").prop("disabled", false);
	$("#subcategory_id").empty();
	$(".append_product").empty();
	$.ajax({
		type:'post',
		url:'{{route("theme.get_category")}}',
		data:{'_token':'{{csrf_token()}}','id':value},
		success:function(data)
		{
			$('#id_'+value).addClass('active');
			$("#subcategory_id").append(data.category);
			$(".append_product").append(data.products);
		}
	});
}

$('#button').click(function()
{
	var cat_id = $('#category_id').val();
	var subcat_id = $('#subcategory_id').val();
	localStorage.setItem("category_id", cat_id);
	localStorage.setItem("subcategory_id", subcat_id);
	window.location.replace("{{route('theme.food_products.create')}}");
});

var max_fields_limit      = 10;
var x = 1;
$('.add_more_button').click(function(e)
{
	e.preventDefault();
	if(x < max_fields_limit)
	{
		x++; 
		var html = '<div class="row"><input type="hidden" name="attribute_id[]" value=""><div class="col-lg-5"><input type="text" class="form-control variable_req" placeholder="Enter Attribute" data-error="This field is required." required name="attr[]"><div class="help-block with-errors"></div></div><div class="col-lg-5"><input type="text" class="form-control variable_req" placeholder="Enter Product Price" data-error="This field is required." required name="product_price[]"><div class="help-block with-errors"></div></div><div class="col-lg-2"><button type="button" class="btn btn-primary remove_field">Remove</button></div></div><br>';
		$('.input_fields_container').append(html);
	}
});

$('.input_fields_container').on("click",".remove_field", function(e)
{
    e.preventDefault();
	$(this).parent('div').parent('div').remove(); x--;
});

$('.add_more_image').click(function(e)
{
	e.preventDefault();
	if(x < max_fields_limit)
	{
		x++; 
		var html = '<div class="row"><div class="col-lg-10"><label class="labeltemp" for="usr">Product Image</label><input type="file" name="product_images[]" required id="file-7" data-error="This field is required." class="inputfile inputfile-6 form-control" accept="image/*"><div class="help-block with-errors"></div></div><div class="col-lg-2"><label for="usr"></label><button type="button" class="btn btn-primary remove_product mt-20">Remove</button></div></div>';
		$('.image_container').append(html);
	}
});

$('.image_container').on("click",".remove_product", function(e)
{
    e.preventDefault();
	$(this).parent('div').parent('div').remove(); x--;
});

if ($("input[name='product_type']").is(':checked'))
{
   var value = $(this).val();
	if(value == "simple")
	{
		$('.simple_product').css('display','block');
		$('.simple_product').find('.simple_req').prop('required',true);
		$('.variable_product').css('display','none');
		$('.variable_product').find('.variable_req').prop('required',false);
	}
	if(value == "variable")
	{

		$('.variable_product').css('display','block');
		$('.simple_product').css('display','none');
		$('.simple_product').find('.simple_req').prop('required',false);
		$('.variable_product').find('.variable_req').prop('required',true);
	}
}

$("input[name='product_type']").change(function()
{
	if($(this).is(':checked'))
	{
		var value = $(this).val();
		if(value == "simple")
		{
			$('.simple_product').css('display','block');
			$('.simple_product').find('.simple_req').prop('required',true);
			$('.variable_product').css('display','none');
			$('.variable_product').find('.variable_req').prop('required',false);
		}
		if(value == "variable")
		{

			$('.variable_product').css('display','block');
			$('.simple_product').css('display','none');
			$('.simple_product').find('.simple_req').prop('required',false);
			$('.variable_product').find('.variable_req').prop('required',true);
		}
	}
});
</script>
