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
<div class="main-wrapper ">
    <div class="main-container-inner card">
    	<div class="card-main card">
        	<div class="container-fluid no-padding ">
           		<div class="row no-gutters">
              		<div class="col-md-12">
                 		<nav>
                    		<ol class="breadcrumb page-title-top">
                
                       			<li class="breadcrumb-item"><a href="{{route('theme.food_product_attributes.index')}}">Featured Product</a></li>
                       			<li class="breadcrumb-item active">Edit</li>
                       			<li class="breadcrumb-item text-right"><a href="{{route('theme.food_product_attributes.index')}}">Back</a></li>
                    		</ol>
                 		</nav>
              		</div>
           		</div>
        	</div>
        	<div class="">
           		<div class="">
           			<form action="{{route('theme.food_product_attributes.update',$attribute->id)}}" method="post" enctype="multipart/form-data">
           				@csrf
           				{{ method_field('PUT') }}
		   			<div class="row">
						<div class="col-lg-12">
							<div class="form-group f-g-o">
					  			<label for="usr">Name</label>
					  			<input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Enter Name" name="name" required value="{{old('name', $attribute->name)}}">
					  			@if ($errors->has('name'))
	                                <span class="invalid-feedback" role="alert">
	                                    <strong>{{ $errors->first('name') }}</strong>
	                                </span>
	                            @endif
							</div>
						</div>

						<div class="col-lg-12">
							<div class="form-group f-g-o">
					  			<label for="usr">Select Product</label>
							   	<select name="product_id[]" class="form-control select_multiple" id="product_id" value="{{ old('product_id') }}" multiple="multiple" required="">
									@foreach($products as $product)
									@if(in_array($product->id,$productId))
										<option {{ old('product_id') }} value="{{$product->id}}"selected="selected">{{$product->product_name}}</option>
									@else
										<option {{ old('product_id') }} value="{{$product->id}}">{{$product->product_name}}</option>
									@endif
									@endforeach
								</select>
							</div>
						</div>

						<div class="col-lg-6 col-xl-4 col-md-6">
							<div class="form-group f-g-o">
					  			<label for="usr">Status </label>
					  			<div class="d-flex">
					  				<div class="w3-half">
										<div class="custom-control custom-radio mt-3">
						  					<input type="radio" id="customRadio1" name="status" class="custom-control-input" {{$attribute->status == "active" ? "checked" : "" }} value="active">
						  					<label class="custom-control-label" for="customRadio1">Active</label>
										</div>
					  				</div>
					  				<div class="w3-half">
										<div class="custom-control custom-radio mt-3">
						  					<input type="radio" id="customRadio2" name="status" class="custom-control-input" {{$attribute->status == "inactive" ? "checked" : "" }} value="inactive">
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
     	</div>
    </div>
</div>
</div>
</div>



@include('admin.template.Food_Delivery.partials.footer')

<script>
function categoryChange(value)
{
	$("#category_id").empty();
	$("#product_id").empty();
	$.ajax({
		type:'post',
		url:'{{route("theme.get_category")}}',
		data:{'_token':'{{csrf_token()}}','id':value},
		success:function(data)
		{
			console.log(data)
			$("#category_id").append(data.category);
			$("#product_id").append(data.products);
		}
	});
}

$(document.body).on('change','#category_id',function()
{
	$("#product_id").empty();
    $.ajax({
		type:'post',
		url:'{{route("theme.get_subcategory")}}',
		data:{'_token':'{{csrf_token()}}','id':this.value},
		success:function(data)
		{
			console.log(data)
			$("#product_id").append(data);
		}
	});
});
</script>