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
                     <div class="main-wrapper">
                        <div class="container-fluid no-padding">
                           <div class="row no-gutters">
                              <div class="col-md-12">
                                 <nav>
                                    <ol class="breadcrumb page-title-top">
                                       <li class="breadcrumb-item"><a href="{{route('theme.food_products.index')}}">Products</a></li>
                                       <li class="breadcrumb-item active">Add New Product</li>
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
                                 <h2 class="table-title-custom">Add New Product</h2>
                              </div>
                              <div class="col-lg-12 col-xl-12 col-md-12">
                                 <div class="cat-box shadow-d data-table-wrapper">
                                    <div class="bd-example bd-example-tabs">
                                       <div class="row">
                                          <div class="col-3">
                                             <div class="nav flex-column nav-pills  nav-pills-own Add New Product">
                                                @foreach($categories as $category)
                                                <a class="nav-link category_nav {{ (request()->is('theme/add_product/'.$category->id)) ? 'active' : '' }}" href="{{route('theme.add_products',$category->id)}}">{{$category->name}}</a>
                                                @endforeach
                                             </div>
                                          </div>
                                          <div class="col-9">
                                             <div class="tab-content tab-leftcntnt">
                                                <div class="tab-pane tab-pane-own fade active show">
                                                   <div class="row">
                                                      <div class="col-lg-12">
                                                         <ul class="nav nav-tabs nav-tabs-prodt" id="myTab" role="tablist">
                                                            <li class="nav-item">
                                                               <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Add</a>
                                                            </li>
                                                            <li class="nav-item">
                                                               <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Products</a>
                                                            </li>
                                                         </ul>
                                                         <div class="tab-content tab-right-pr">
                                                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                               <form role="form" data-toggle="validator" action="{{url('theme/add_product/'.request()->route('id'))}}" method="post" enctype="multipart/form-data" id="saveProduct">
                                                                  @csrf
                                                                  <div class="row">
                                                                     <input type="hidden" class="form-control" name="category_id" value="{{request()->route('id')}}" >
                                                                     <input type="hidden" name="is_continoue" id="is_continoue">
                                                                     <div class="form-group">
                                                                        @if(Auth::user()->parent_id == 0)  
                                                                        <input type="hidden" class="inputtemp form-control inputtemp" id="user_id" name="owner_id" value="{{ Auth::user()->id}}">
                                                                        @else
                                                                        <input type="hidden" class="inputtemp form-control inputtemp" id="user_id" name="owner_id" value="{{ Auth::user()->parent_id}}">     
                                                                        @endif
                                                                     </div>
                                                                     <div class="form-group">
                                                                        <input type="hidden" class="form-control" name="template_id" value="{{$themetemplate->id}}">
                                                                     </div>
                                                                    
                                                                     <div class="col-lg-12 col-xl-4 col-md-6">
                                                                        <div class="form-group f-g-o">
                                                                           <label class="labeltemp" for="usr">Product Type  </label>
                                                                           <div class="d-flex prddflx">
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
                                                                     @if(count($subcategories)>0)
                                                                     <div class="col-lg-12">
                                                                        <div class="form-group f-g-o">
                                                                           <label class="labeltemp" for="usr">Select Subcategory</label>
                                                                           <select name="subcategory_id[]" class="select_multiple form-control inputtemp" id="subcategory_id"  multiple="multiple" required data-error="This field is required.">
                                                                              <label for="usr">Select Sub Category</label>
                                                                              <!-- <option value="" selected="selected">Choose...</option> -->
                                                                              @foreach($subcategories as $subcategory)
                                                                              <option {{ (old("subcategory_id") == $subcategory->id ? "selected":"") }}  value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                                                                              @endforeach
                                                                           </select>
                                                                           <div class="help-block with-errors"></div>
                                                                        </div>
                                                                     </div>
                                                                     @endif
                                                                     <div class="col-lg-12">
                                                                        <div class="form-group f-g-o">
                                                                           <label class="labeltemp" for="usr">Product Name</label>
                                                                           <input type="text" class="inputtemp form-control{{ $errors->has('product_name') ? ' is-invalid' : '' }}" placeholder="Enter Product Name" name="product_name" required data-error="This field is required." value="{{ old('product_name') }}">
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
                                                                                 <label class="labeltemp" for="usr">Product Price</label>
                                                                                 <input type="text" pattern="^[1-9]\d*(\.\d+)?$" class="inputtemp simple_req form-control inputtemp" placeholder="Enter Product Price" data-required-error="This field is required." data-pattern-error="Please enter a valid price." name="price" value="{{ old('price') }}" required>
                                                                                 <div class="help-block with-errors"></div>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-lg-12">
                                                                        <div class="form-group f-g-o">
                                                                           <label class="labeltemp" for="usr">Short Description</label>
                                                                           <textarea class="inputtemp form-control" placeholder="Add Description" required data-error="This field is required." name="short_description">{{ old('short_description') }}</textarea>
                                                                           <div class="help-block with-errors"></div>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-lg-12">
                                                                        <div class="form-group f-g-o">
                                                                           <label class="labeltemp" for="usr">Long Description</label>
                                                                           <textarea class="inputtemp form-control" placeholder="Add Long Description" required data-error="This field is required." name="long_description">{{ old('long_description') }}</textarea>
                                                                           <div class="help-block with-errors"></div>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-lg-12">
                                                                        <div class="form-group f-g-o">
                                                                           <div class="image_container">
                                                                              <div class="row">
                                                                                 <div class="col-lg-10">
                                                                                    <label class="labeltemp" for="usr">Product Image</label>
                                                                                    <input type="file" name="product_image" required id="file-7" data-error="This field is required." class="inputfile inputfile-6 form-control" accept="image/*">
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
                                                                     <div class="variable_product col-lg-12" style="display:none">
                                                                        <div class="row">
                                                                           <div class="col-lg-12">
                                                                              <div class="form-group f-g-o">
                                                                                 <label class="labeltemp" for="usr">Add Product Attributes</label>
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
                                                                                       <div class="col-lg-2">
                                                                                          <button type="button" class="btn btn-primary add_more_button">Add More</button>
                                                                                       </div>
                                                                                    </div>
                                                                                    <br>
                                                                                 </div>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-lg-6 col-xl-4 col-md-6">
                                                                        <div class="form-group f-g-o">
                                                                           <label for="usr">Status </label>
                                                                           <div class="d-flex prddflx">
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
                                                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                               <div class="col-lg-12 col-xl-12 col-md-12 products">
                                                                  <div class="cat-box shadow-d data-table-wrapper">
                                                                     <table  class="product_table table table-striped table-bordered" style="width:100%">
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
                                                                              <td><img src="{{$product->product_image}}" style="width:100px; height:100px"></td>
                                                                              <td class="text-capitalize">{{$product->product_name}}</td>
                                                                              <td class="text-capitalize">{{$product->price}}</td>
                                                                              <td class="text-capitalize">{{$product->status}}</td>
                                                                              <td>
                                                                                 <form action="{{route('theme.update_position')}}" method="post">	
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
            </div>
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
<script>
   function deleteData(url)
   {
   
       $("#deletefoodproductForm").attr('action', url);
       $('#myfoodproductModal').modal();
   }   
</script>
<script>
   $('#saveProducts').click(function()
   {
   	$('#saveProduct').find('#is_continoue').val('yes');
   	$('#saveProduct').submit();
   	$('#productModal').modal('hide');
   })
   
   
</script>
<script>
   // document.getElementsByClassName('submitSort').submit();
   
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
     			//console.log(data)
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
   var max_fields_limit = 10;
   var x = 1;
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
   
   $('.add_more_button').click(function(e)
   {
   	e.preventDefault();
   	if(x < max_fields_limit)
   	{
   		x++; 
   		var html = '<div class="row"><div class="col-lg-5"><input type="text" class="form-control variable_req" placeholder="Enter Attribute" data-error="This field is required." name="attr[]"><div class="help-block with-errors"></div></div><div class="col-lg-5"><input type="text" class="form-control variable_req" placeholder="Enter Product Price" data-error="This field is required." name="product_price[]"><div class="help-block with-errors"></div></div><div class="col-lg-2"><button type="button" class="btn btn-primary remove_field">Remove</button></div></div><br>';
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
   	$('.simple_product').find('.simple_req').prop('required',true);
   	$('.variable_product').css('display','none');
   	$('.variable_product').find('.variable_req').prop('required',false);
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