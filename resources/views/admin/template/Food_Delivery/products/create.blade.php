@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Food_Delivery.partials.sidemenu')

<div class="main-wrapper ">
    <div class="main-container-inner card">
    	<div class="card-main card">
        	<div class="container-fluid no-padding ">
           		<div class="row no-gutters">
              		<div class="col-md-12">
                 		<nav>
                    		<ol class="breadcrumb page-title-top">
                       			<li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                       			<li class="breadcrumb-item"><a href="{{route('products.index')}}">Products</a></li>
                       			<li class="breadcrumb-item active">Create</li>
                       			<li class="breadcrumb-item text-right"><a href="{{route('products.index')}}">Back</a></li>
                    		</ol>
                 		</nav>
              		</div>
           		</div>
        	</div>
        	<div class="container-fluid">
           		<div class="container-fluid">
           			<form role="form" data-toggle="validator" action="{{route('products.store')}}" method="post" enctype="multipart/form-data">@csrf
		   			<div class="row">
			
						<input type="hidden" name="category_id" value="" id="category_id">
						<input type="hidden" name="subcategory_id[]" value="" id="subcategory_id">
						<div class="col-lg-6 col-xl-4 col-md-6">
							<div class="form-group f-g-o">
					  			<label for="usr">Product Type  </label>
					  			<div class="d-flex">
					  				<div class="w3-half">
										<div class="custom-control custom-radio mt-3">
						  					<input type="radio" id="customRadio1" name="product_type" class="custom-control-input" checked="" value="simple">
						  					<label class="custom-control-label" for="customRadio1">Simple</label>
										</div>
					  				</div>
					  				<div class="w3-half">
										<div class="custom-control custom-radio mt-3">
						  					<input type="radio" id="customRadio2" name="product_type" class="custom-control-input" value="variable">
						  					<label class="custom-control-label" for="customRadio2">Variable</label>
										</div>
					  				</div>
					  			</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group f-g-o">
					  			<label for="usr">Product Name</label>
					  			<input type="text" class="form-control{{ $errors->has('product_name') ? ' is-invalid' : '' }}" placeholder="Enter Product Name" name="product_name" required data-error="This field is required." value="{{ old('product_name') }}">
					  			@if ($errors->has('product_name'))
	                                <span class="invalid-feedback" role="alert">
	                                    <strong>{{ $errors->first('product_name') }}</strong>
	                                </span>
	                            @endif
	                            <div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="simple_product col-lg-12" style="display:none">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group f-g-o">
										<label for="usr">Product Price</label>
										<input type="text" class="simple_req form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" placeholder="Enter Product Price" data-error="This field is required." name="price" value="{{ old('price') }}">
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
										<label for="usr">Product Stock</label>
										<input type="number" class="simple_req form-control{{ $errors->has('product_stock') ? ' is-invalid' : '' }}" placeholder="Enter Product Stock" name="product_stock" data-error="This field is required." value="{{ old('product_stock') }}">
										@if ($errors->has('product_stock'))
											<span class="invalid-feedback" role="alert">
												<strong>{{ $errors->first('product_stock') }}</strong>
											</span>
										@endif
										<div class="help-block with-errors"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-lg-12">
							<div class="form-group f-g-o">
					  			<label for="usr">Short Description</label>
					  			<textarea class="form-control" placeholder="Add Description" required data-error="This field is required." name="short_description">{{ old('short_description') }}</textarea>
					  			<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group f-g-o">
					  			<label for="usr">Long Description</label>
					  			<textarea class="form-control" placeholder="Add Long Description" required data-error="This field is required." name="long_description">{{ old('long_description') }}</textarea>
					  			<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group f-g-o">
						  		<label for="usr">Product Image</label>
						  		<input type="file" name="product_image" required id="file-7" data-error="This field is required." class="inputfile inputfile-6 form-control" accept="image/*">
						  		<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="variable_product col-lg-12" style="display:none">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group f-g-o">
										<label for="usr">Add Product Attributes</label>
										<div class="input_fields_container">
											<div class="row">
												<div class="col-lg-5">
													<input type="text" class="form-control variable_req" placeholder="Enter Attribute" data-error="This field is required." name="attr[]">
													<div class="help-block with-errors"></div>
												</div>
												<div class="col-lg-5">
													<input type="text" class="form-control variable_req" placeholder="Enter Product Price" data-error="This field is required." name="product_price[]">
													<div class="help-block with-errors"></div>
												</div>
												<!--<div class="col-lg-3">
													<input type="text" class="form-control variable_req" placeholder="Enter Stock" data-error="This field is required." name="stock[]">
													<div class="help-block with-errors"></div>
												</div>-->
												<div class="col-lg-2">
													<button type="button" class="btn btn-primary add_more_button">Add More</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-xl-4 col-md-6">
							<div class="form-group f-g-o">
					  			<label for="usr">Status </label>
					  			<div class="d-flex">
					  				<div class="w3-half">
										<div class="custom-control custom-radio mt-3">
						  					<input type="radio" id="customRadio1" name="status" class="custom-control-input" checked="" value="active">
						  					<label class="custom-control-label" for="customRadio1">Active</label>
										</div>
					  				</div>
					  				<div class="w3-half">
										<div class="custom-control custom-radio mt-3">
						  					<input type="radio" id="customRadio2" name="status" class="custom-control-input" value="inactive">
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



@include('admin.template.Food_Delivery.partials.footer')

<script>
var cat_id = localStorage.getItem("category_id");
var subcat_id = localStorage.getItem("subcategory_id");

$("#category_id").val(cat_id);
$("#subcategory_id").val(subcat_id);

function categoryChange(value)
{
	$("#subcategory_id").empty();
	$.ajax({
		type:'post',
		url:'{{route("get_category")}}',
		data:{'_token':'{{csrf_token()}}','id':value},
		success:function(data)
		{
			console.log(data)
			$("#subcategory_id").append(data.category);
		}
	});
}

var max_fields_limit      = 10;
var x = 1;
$('.add_more_button').click(function(e)
{
	e.preventDefault();
	if(x < max_fields_limit)
	{
		x++; 
		var html = '<div class="row"><div class="col-lg-5"><input type="text" class="form-control variable_req" placeholder="Enter Attribute" data-error="This field is required." name="attr[]"><div class="help-block with-errors"></div></div><div class="col-lg-5"><input type="text" class="form-control variable_req" placeholder="Enter Product Price" data-error="This field is required." name="product_price[]"><div class="help-block with-errors"></div></div><div class="col-lg-2"><button type="button" class="btn btn-primary remove_field">Remove</button></div></div>';
		$('.input_fields_container').append(html);
	}
});

$('.input_fields_container').on("click",".remove_field", function(e)
{
    e.preventDefault();
	$(this).parent('div').parent('div').remove(); x--;
});

if ($("input[name='product_type']").is(':checked'))
{
   $('.simple_product').css('display','block');
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