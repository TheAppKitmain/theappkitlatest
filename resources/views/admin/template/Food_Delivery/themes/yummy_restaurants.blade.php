@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Food_Delivery.partials.sidemenu')
<!-- main start-->
<main onload="checkCookie()">
   <div class="main-home">
   <div class="main-wrapper ">
   <div class="main-container">
   <div class="main-container-inner maininnerallpagescontainer">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="row owncard addprdctrow mt-20 addprdctrowmaintabs">
               <div class="col-md-12">
                  <div class="tab">                 
                  @if($splashscreen == NULL)
                     <button id="splashscreen1" class="tablinks active" onclick="openCity(event, 'splashscreen') "><span class="theme-tab-number-w">1</span> Splash Screen  </button>
                  @else
                     <button id="splashscreen1" class="tablinks active template-tab-color" onclick="openCity(event, 'splashscreen') ">
                     <span class="theme-tab-number-green">1</span> Splash Screen  </button>
                  @endif

                     @if ($tempsignupsetting == NULL)
                     <button id="signup1" class="tablinks" onclick="openCity(event, 'signup')"><span class="theme-tab-number-w">2</span> Sign Up  </button>
                     @else
                     <button id="signup1" class="tablinks template-tab-color" onclick="openCity(event, 'signup')"><span class="theme-tab-number-green">2</span> Sign Up  </button>
                     @endif
                     @if ($temploginsetting == NULL)
                     <button id="login1" class="tablinks" onclick="openCity(event, 'login')"><span class="theme-tab-number-w">3</span> Login  </button>
                     @else
                     <button id="login1" class="tablinks template-tab-color" onclick="openCity(event, 'login')"><span class="theme-tab-number-green">3</span> Login  </button>
                     @endif
                     @if(count($categories) == 0)
                     <button id="home1" class="tablinks" onclick="openCity(event, 'home')"><span class="theme-tab-number-w">4</span> Home  </button>
                     @else
                     <button id="home1" class="tablinks template-tab-color" onclick="openCity(event, 'home')"><span class="theme-tab-number-green">4</span> Home  </button>
                     @endif
                     @if(count($food_products) == 0)
                     <button id="add_prodcut1" class="tablinks" onclick="openCity(event, 'add_prodcut')"><span class="theme-tab-number-w">5</span> Add Product  </button>
                     @else
                     <button id="add_prodcut1" class="tablinks template-tab-color" onclick="openCity(event, 'add_prodcut')"><span class="theme-tab-number-green">5</span> Add Product </button>
                     @endif

                     <button id="my_account1" class="tablinks" onclick="openCity(event, 'rest_screens')">Other Screeens</button>
                  </div>
                  <!-------------------------------------============================  Add Product  ==========================----------------------------------------------->
                  <div id="add_prodcut" class="tabcontent">
                     <div class="col-lg-12 col-xl-12 col-md-12 addproduct-page">
                        <div class="cat-box shadow-d data-table-wrapper">
                           <div class="bd-example bd-example-tabs">
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
                                 <div class="col-md-8 own-8-col">
                                    <div class="row">
                                       <div class="col-md-4">
                                          <div class="nav flex-column nav-pills  nav-pills-own Add New Product">
                                             @foreach($categories as $category)
                                             <a class="nav-link category_nav {{ (request()->is('theme/theme_add_product/'.$category->id)) ? 'active' : '' }}" href="{{route('theme.theme_add_products',$category->id)}}">{{$category->name}}</a>
                                             @endforeach
                                          </div>
                                       </div>
                                       <div class="col-md-8">
                                          <div class="tab-content tab-leftcntnt">
                                             <div class="tab-pane tab-pane-own fade active show">
                                                <div class="row">
                                                   <div class="col-lg-12">
                                                      <ul class="nav nav-tabs nav-tabs-prodt" id="myTab" role="tablist">
                                                         <li class="nav-item">
                                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#product_home" role="tab" aria-controls="home" aria-selected="true">Add</a>
                                                         </li>
                                                         <li class="nav-item">
                                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Products</a>
                                                         </li>
                                                      </ul>
                                                      <div class="tab-content tab-right-pr food1tbpro">
                                                         <div class="tab-pane fade show active" id="product_home" role="tabpanel" aria-labelledby="home-tab">
                                                            <form role="form" data-toggle="validator" action="{{url('theme/add_product/'.request()->route('id'))}}" method="post" enctype="multipart/form-data" id="saveProduct">
                                                               @csrf
                                                               <div class="row">
                                                                  <input type="hidden" class="form-control" name="category_id" value="{{request()->route('id')}}" >
                                                                  <input type="hidden" name="is_continoue" id="is_continoue">
                                                                  <div class="form-group">
                                                                  @if(Auth::user()->parent_id == 0)  
                                                                  <input type="hidden" class="inputtemp form-control inputtemp" name="owner_id" value="{{ Auth::user()->id}}">
                                                                  @else
                                                                  <input type="hidden" class="inputtemp form-control inputtemp" name="owner_id" value="{{ Auth::user()->parent_id}}">     
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
                                                                        <input type="text" class="inputtemp form-control{{ $errors->has('product_name') ? ' is-invalid' : '' }}" placeholder="Enter Product Name" id="product_name" name="product_name" required data-error="This field is required." value="{{ old('product_name') }}">
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
                                                                              <input type="text" pattern="^[1-9]\d*(\.\d+)?$" class="inputtemp simple_req form-control inputtemp" placeholder="Enter Product Price" id="product_price" data-required-error="This field is required." data-pattern-error="Please enter a valid price." name="price" value="{{ old('price') }}" required>
                                                                              <div class="help-block with-errors"></div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-lg-12">
                                                                     <div class="form-group f-g-o">
                                                                        <label class="labeltemp" for="usr">Short Description</label>
                                                                        <textarea class="inputtemp form-control" placeholder="Add Description" required data-error="This field is required." id="short_description" name="short_description">{{ old('short_description') }}</textarea>
                                                                        <div class="help-block with-errors"></div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-lg-12">
                                                                     <div class="form-group f-g-o">
                                                                        <label class="labeltemp" for="usr">Long Description</label>
                                                                        <textarea class="inputtemp form-control" placeholder="Add Long Description" required data-error="This field is required." id="long_description" name="long_description">{{ old('long_description') }}</textarea>
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
                                                                                 <input type="radio" id="customRadio3" name="status" class="custom-control-input" checked="" value="active">
                                                                                 <label class="custom-control-label" for="customRadio3">Active</label>
                                                                              </div>
                                                                           </div>
                                                                           <div class="w3-half">
                                                                              <div class="custom-control custom-radio mt-3">
                                                                                 <input type="radio" id="customRadio4" name="status" class="custom-control-input" value="inactive">
                                                                                 <label class="custom-control-label" for="customRadio4">Inactive</label>
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
                                                                  <table  class="product_table table table-striped table-bordered"  style="width:100%">
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
                                 <div class="col-md-3 own-4-col own-4-col-food-del-1">
                                    <div class="preview-box">
                                       <h2 class="text-center preview-title "><img class="" src="{{asset('asset/images/eyeimage.png')}}" alt="eyeimage">Preview</h2>
                                       <div class="tutorial-video-box text-center">
                                          <div class="app-preview cor-1-app-preview">
                                             <div class="background-color-ver"></div>
                                             <div class="product-preview-container">
                                                <div id="demo-5" class="carousel slide" data-ride="carousel">
                                                   <!-- Indicators -->
                                                   <ul class="carousel-indicators">
                                                      <li data-target="#demo-5" data-slide-to="0" class=""></li>
                                                      <li data-target="#demo-5" data-slide-to="1" class=""></li>
                                                      <li data-target="#demo-5" data-slide-to="2" class="active"></li>
                                                      <li data-target="#demo-5" data-slide-to="3"></li>
                                                   </ul>
                                                   <!-- The slideshow -->
                                                   <div class="carousel-inner">
                                                      <div class="carousel-item">
                                                         <div class="e-com-3-product-image-box">                                                          
                                                            <img class="e-com-3-productimgprv product_image_screen" src="{{asset('asset/images/max-panama.png')}}" id="product_image_screen" alt="toggle image">
                                                         </div>
                                                      </div>
                                                      <div class="carousel-item">
                                                         <div class="e-com-3-product-image-box">                                                           
                                                            <img class="e-com-3-productimgprv display_image_screen" src="{{asset('asset/images/max-panama.png')}}" id="product_image_screen" alt="toggle image">
                                                         </div>
                                                      </div>
                                                      <div class="carousel-item active">
                                                         <div class="e-com-3-product-image-box">                                                         
                                                            <img class="e-com-3-productimgprv display_image_screen_2" src="{{asset('asset/images/max-panama.png')}}" id="product_image_screen" alt="toggle image">
                                                         </div>
                                                      </div>
                                                      <div class="carousel-item">
                                                         <div class="e-com-3-product-image-box">                                                          
                                                            <img class="e-com-3-productimgprv display_image_screen_3" src="{{asset('asset/images/max-panama.png')}}" id="product_image_screen" alt="toggle image">
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <img class=" foodfaviconbg" src="{{asset('asset/images/faviconbg.png')}}" id="product_image_screen" alt="toggle image">
                                                <div class="e-com-3-p-product-des-box">
                                                   <h4 class="productnamefood1" id="pro_name">Dark Chocolate Cake</h4>

                                                   @if(Auth::user()->country == 'United Kingdom')
                                                   <h3 class="productnamefood1">&#163;                                            
                                                   @else
                                                   <h3 class="productnamefood1">$
                                                   @endif

                                                   <span id="pro_price" >10</span></h3>
                                                   <div class="descriptiontabwrapper">
                                                      <ul class="nav nav-tabs tabfood1  nav-tabs-prodt" id="destabfood" role="tablist">
                                                         <li class="nav-item">
                                                            <a class="nav-link active" id="short-des" data-toggle="tab" href="#short-des" role="tab" aria-controls="home" aria-selected="true">Short Descrption</a>
                                                         </li>
                                                         <li class="nav-item">
                                                            <a class="nav-link" id="long-des" data-toggle="tab" href="#long-des" role="tab" aria-controls="profile" aria-selected="false">Long Descrption</a>
                                                         </li>
                                                      </ul>
                                                      <div class="tab-content tab-right-pr food1tbpro">

                                                         <div class="tab-pane fade show active" id="short-des" role="short-des" aria-labelledby="home-tab">
                                                            <p id="e-com-3-pro_description" class="pro_short_desc">Lorem ipsum is placeholder text commonly used in the graphic.</p>
                                                         </div>

                                                         <div class="tab-pane fade" id="long-des" role="long-des" aria-labelledby="profile-tab">
                                                            <p id="e-com-3-pro_description" class="pro_long_desc">Lorem is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>
                                                         </div>

                                                      </div>
                                                   </div>
                                                   <h5>Description</h5>
                                                </div>
                                                <div class="e-com-3-bottom-fav-container">
                                                   <img class="food-1bottom" src="{{asset('asset/images/foodapp-btn.png')}}" id="product_image_screen" alt="toggle image">
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-12 col-xl-12 col-md-12 products productsfood">
                                    <div class="cat-box shadow-d data-table-wrapper">
                                       <table id="product_details" class="table table-striped table-bordered" style="width:100%">
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
                                             @foreach($food_products as $product)
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
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  
                  <!-------------------------------------============================ Product End ==========================----------------------------------------------->
                  <!-------------------------------------============================  Splash Screen =============================----------------------------------------------->
                  <div id="splashscreen" class="tabcontent" style="display: block;">
                     <div class="tab-content-inner">
                        <div class="row">
                           <div class="col-md-8 own-8-col">
                              <div class="card-body m-t-20">
                                 <form  method ="POST" action="{{route('theme.splashscreen')}}" enctype="multipart/form-data" name="splashscreen_form">
                                    @csrf
                                    <div class="form-group">
                                    @if(Auth::user()->parent_id == 0)  
								<input type="hidden" class="inputtemp form-control inputtemp" id="user_id" name="user_id" value="{{ Auth::user()->id}}">
								@else
								<input type="hidden" class="inputtemp form-control inputtemp" id="user_id" name="user_id" value="{{ Auth::user()->parent_id}}">     
								@endif
                                    </div>
                                    <div class="form-group">
                                       <input type="hidden" class="form-control" id="template_id" name="template_id" value="{{$themetemplate->id}}">
                                    </div>
                                    <div class="form-group">
                                       <input type="hidden" class="form-control" id="template_name" name="template_name" value="{{$themetemplate->theme_name}}">
                                    </div>
                                    <div class="d-flex form-group formgrouplabel">
                                       <label class="lbh">Upload Logo <a class="tooltip-btn" data-tooltip="Upload Image 1000 x 1000px" data-tooltip-location="right"> ?</a></label>                
                                       <input id="inp1" type="file" accept="image/*" class="form-control splash_logo" name="splash_logo">
                                       <label for="inp1" class="splogoinput"><i class="fa fa-upload" aria-hidden="true"></i> Upload </label>
                                       <div class="delete-box-cm" id="remove_logo_image" onClick="removelogoimg()" style="display: none;"><i class="fa fa-trash-o delete-icon-cm" aria-hidden="true"></i> Remove logo image</div>
                                    </div>
                                    <div class="d-flex form-group formgrouplabel">
                                       <label class="lbh">Splash Background Image <a class="tooltip-btn" data-tooltip="Upload Image 1535 x 3600px" data-tooltip-location="right"> ?</a></label>
                                       <input type="file" accept="image/*" id="inp2"  class="form-control splash_bg_image" name="splash_background_image" onchange="splshbgimgshow()">
                                       <label for="inp2" class="spbginput"><i class="fa fa-upload" aria-hidden="true"></i> Upload </label>
                                       <div class="delete-box-cm" id="remove_splash_image" onClick="removesplashimg()" style="display: none;"><i class="fa fa-trash-o delete-icon-cm" aria-hidden="true"></i> Remove splash image
                                       </div>
                                    </div>
                                    <h6  class="text-left ortitle">Or</h6>
                                    <div class="d-flex form-group">
                                       <label class="lbh">Splash Background Color</label>
                                       @if($splashscreen == NULL)
                                       <input type="color" id="splash_bg_color" name="splash_bg_color" onchange="splshbgshow()" value="#ffffff"> 
                                       @else
                                       @if($splashscreen->splash_background_color !== "#ffffff")
                                       <input type="color" id="splash_bg_color" name="splash_bg_color" onchange="splshbgshow()" value="{{$splashscreen->splash_background_color}}">
                                       @else
                                       <input type="color" id="splash_bg_color" name="splash_bg_color" onchange="splshbgshow()" value="{{$splashscreen->splash_background_color}}">
                                       @endif 
                                       @endif
                                    </div>
                                    <div class=" form-group">
                                       <button class="savebtn">Next</button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                           <!--======  Splash Screen Preview =====-->                    
                           <div class="col-md-4 own-4-col">
                              <div class="preview-box">
                                 <h2 class="text-center preview-title "><img class="" src="{{asset('asset/images/eyeimage.png')}}" alt="eyeimage">Preview</h2>
                                 <div class="tutorial-video-box text-center">
                                    <div class="tutorial-video-box-inner">
                                       <div class="preview-right-main-wrapper">
                                      
                                          @if(!isset($splashscreen))
                                          <div class="splash-bgimage" id="splash_screen_bg">
                                             <img class="splashbg" src="{{asset('template/images/yummy_restaurants/splashbgyummy.png')}}" id="splash_bg" alt="eyeimage" >
                                             <img class="applogoimg preview" src="{{asset('template/images/yummy_restaurants/yummy-logo.png')}}" id="splash_logo" alt="eyeimage">
                                          </div>
                                          @else
                                          @if($splashscreen->splash_background_color == "#ffffff" && !is_null($splashscreen->splash_background_image))
                                          <div class="splash-bgimage" id="splash_screen_bg">
                                             <img class="splashbg" src="{{asset($splashscreen->splash_background_image)}}" id="splash_bg" alt="" >
                                             @if($splashscreen->splash_logo == NULL)
                                             <img class="applogoimg preview" src="{{asset('template/images/yummy_restaurants/yummy-logo.png')}}" id="splash_logo" alt="eyeimage">   
                                             @else
                                             <img class="applogoimg preview" src="{{asset($splashscreen->splash_logo)}}" id="splash_logo" alt="eyeimage">
                                             @endif
                                             <div>
                                          @elseif($splashscreen->splash_background_color == "#ffffff" && $splashscreen->splash_background_image == null)
                                          <div class="splash-bgimage" id="splash_screen_bg">
                                             <img class="splashbg" src="{{asset('template/images/yummy_restaurants/splashbgyummy.png')}}" id="splash_bg">
                                             @if($splashscreen->splash_logo == NULL)   
                                             <img class="applogoimg preview" src="{{asset('template/images/yummy_restaurants/yummy-logo.png')}}" id="splash_logo" alt="eyeimage">
                                             @else 
                                             <img class="applogoimg preview" src="{{asset($splashscreen->splash_logo)}}" id="splash_logo" alt="eyeimage">
                                             @endif
                                          </div>   
                                          @else
                                          <div class="splash-bgimage" id="splash_screen_bg" style="background-color:{{$splashscreen->splash_background_color}};">
                                             <img class="splashbg" src="{{asset($splashscreen->splash_background_image)}}" id="splash_bg" alt="" style="display:none;" >
                                             @if($splashscreen->splash_logo == NULL)   
                                             <img class="applogoimg preview" src="{{asset('template/images/yummy_restaurants/yummy-logo.png')}}" id="splash_logo" alt="eyeimage">
                                             @else 
                                             <img class="applogoimg preview" src="{{asset($splashscreen->splash_logo)}}" id="splash_logo" alt="eyeimage">
                                             @endif
                                          </div>
                                          @endif
                                          @endif
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
                        <!-------------------------------------============================  Splash Screen End ==========================----------------------------------------------->
                        
                        <!-------------------------------------============================  Sign Up ==========================----------------------------------------------->
                        <div id="signup" class="tabcontent">
                           <div class="tab-content-inner">
                              <div class="row">
                                 <div class="col-md-8 own-8-col">
                                    <div class="left-template-bx">
                                       <div class="card-body m-t-20">
                                          <form  method ="POST" action="{{route('theme.signupscreen')}}" enctype="multipart/form-data" name="signup_form">
                                             @csrf
                                             <div class="form-group">
                                             @if(Auth::user()->parent_id == 0)  
								<input type="hidden" class="inputtemp form-control inputtemp" id="user_id" name="user_id" value="{{ Auth::user()->id}}">
								@else
								<input type="hidden" class="inputtemp form-control inputtemp" id="user_id" name="user_id" value="{{ Auth::user()->parent_id}}">     
								@endif
                                             </div>
                                             <div class="form-group">
                                                <input type="hidden" class="form-control" id="template_id" name="template_id" value="{{$themetemplate->id}}">
                                             </div>
                                             @if($tempsignupsetting == NULL)
                                             <div class="d-flex form-group">
                                                <label class="lbh">SignUp Background Color</label>
                                                <input type="color" id="signup_bg_color2" name="signup_bg_color" onchange="signupbgshow(event)" value="#ffffff">                     
                                             </div>
                                             <div class="d-flex form-group">
                                                <label class="lbh">SignUp Button Color</label>
                                                <input type="color" id="signup_bg_color1" name="signup_btn_color" onchange="signupbtnshow()" value="#f58124">                     
                                             </div>
                                             @else
                                             <div class="d-flex form-group">
                                                <label class="lbh">SignUp Background Color</label>
                                                <input type="color" id="signup_bg_color2" name="signup_bg_color" onchange="signupbgshow(event)" value="{{$tempsignupsetting->signup_bg_color}}">                     
                                             </div>
                                             <div class="d-flex form-group">
                                                <label class="lbh">SignUp Button Color</label>
                                                <input type="color" id="signup_bg_color1" name="signup_btn_color" onchange="signupbtnshow()" value="{{$tempsignupsetting->signup_btn_color}}">                     
                                             </div>
                                             @endif
                                             <div class="d-flex form-group">
                                                <label class="lbh">Font Size</label>
                                                <select  id="signup_dropdown" onchange="signupdropshow()" type="text" name="signup_btn_font_size" placeholder="select Font Size">
                                                   @if($tempsignupsetting == NULL)
                                                   <option value="20" >20px</option>
                                                   <option value="18">18px</option>
                                                   <option value="16" selected="selected">16px</option>
                                                   <option value="14" >14px</option>
                                                   <option value="12" >12px</option>
                                                </select>
                                                @elseif($tempsignupsetting->signup_btn_font_size !== "16")
                                                <option value="20" {{$tempsignupsetting->signup_btn_font_size == "20" ? "selected" : ""}} >20px</option>
                                                <option value="18" {{$tempsignupsetting->signup_btn_font_size == "18" ? "selected" : ""}} >18px</option>
                                                <option value="16" {{$tempsignupsetting->signup_btn_font_size == "16" ? "selected" : ""}}  >16px</option>
                                                <option value="14" {{$tempsignupsetting->signup_btn_font_size == "14" ? "selected" : ""}} >14px</option>
                                                <option value="12" {{$tempsignupsetting->signup_btn_font_size == "12" ? "selected" : ""}} >12px</option>
                                                </select>
                                                @else
                                                <option value="20" >20px</option>
                                                <option value="18" >18px</option>
                                                <option value="16" selected="selected">16px</option>
                                                <option value="14" >14px</option>
                                                <option value="12" >12px</option>
                                                </select>
                                                @endif
                                             </div>
                                             @if(!is_null($tempsignupsetting))
                                             @if($tempsignupsetting->status !== 0)
                                             <div class="custom-control custom-checkbox cust-chk">
                                                <input type="checkbox" class="custom-control-input" id="signup_status" value="1" name="signup_status" checked>
                                                <label class="custom-control-label" for="signup_status">Allow customers to browse without signing up</label>
                                             </div>
                                             @else
                                             <div class="custom-control custom-checkbox cust-chk">
                                                <input type="checkbox" class="custom-control-input" id="signup_status" value="0" name="signup_status">
                                                <label class="custom-control-label" for="signup_status">Allow customers to browse without signing up</label>
                                             </div>
                                             @endif
                                             @else
                                             <div class="custom-control custom-checkbox cust-chk">
                                                <input type="checkbox" class="custom-control-input" id="signup_status" value="0" name="signup_status">
                                                <label class="custom-control-label" for="signup_status">Allow customers to browse without signing up</label>
                                             </div>
                                             @endif
                                             <div class=" form-group">
                                                <button class="savebtn" type="submit">Next</button>
                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                                 <!----====== Signup Preview =====---->
                                 <div class="col-md-4 own-4-col">
                                    <div class="preview-box">
                                       <h2 class="text-center preview-title "><img class="" src="{{asset('asset/images/eyeimage.png')}}" alt="eyeimage">Preview</h2>
                                       <div class="tutorial-video-box text-center">
                                          @if(!isset($tempsignupsetting))
                                           <div class="tutorial-video-box-inner" id="signup_back_color">
                                          @elseif($tempsignupsetting->signup_bg_color == NULL)
                                           <div class="tutorial-video-box-inner" id="signup_back_color">
                                          @else
                                          <div class="tutorial-video-box-inner" id="signup_back_color" style="background-color:{{$tempsignupsetting->signup_bg_color}};">
                                          @endif
                                         
                                             <div class="preview-right-main-wrapper loginsign-ecom">
                                                <div class="splash-bgimage">
                                                   <div class="ecom-6-beauty-sign">
                                                      <h3 class="foodtitleh">Sign Up</h3>
                                                      <p class="foodtitlep">Add your details to login</p>
                                                      <div class="e-com-6-form-grp-container e-com-6-form-mr">
                                                         <div class="form-group e-com-6-email-group">
                                                            <div class="e-com-6-group-icn-inp">
                                                               <input class="form-cantrol" type="text" placeholder="Name">
                                                            </div>
                                                         </div>
                                                         <div class="form-group e-com-6-email-group">
                                                            <div class="e-com-6-group-icn-inp">
                                                               <input class="form-cantrol" type="email" placeholder="Email">
                                                            </div>
                                                         </div>
                                                         <div class="form-group e-com-6-password-group">
                                                            <div class="e-com-6-group-icn-inp">
                                                               <input class="form-cantrol" type="Password" placeholder="Enter Your Password">
                                                            </div>
                                                         </div>
                                                         <div class="form-group e-com-6-email-group">
                                                            <div class="e-com-6-group-icn-inp">
                                                               <input class="form-cantrol" type="text" placeholder="Mobile Number">
                                                            </div>
                                                         </div>
                                                         <div class="form-group e-com-6-email-group">
                                                            <div class="e-com-6-group-icn-inp">
                                                               <input class="form-cantrol" type="text" placeholder="Address">
                                                            </div>
                                                         </div>
                                                         <div class="form-group e-com-6-email-group">
                                                            <div class="e-com-6-group-icn-inp">
                                                               <input class="form-cantrol" type="password" placeholder="Password">
                                                            </div>
                                                         </div>
                                                         <div class="form-group e-com-6-email-group">
                                                            <div class="e-com-6-group-icn-inp">
                                                               <input class="form-cantrol" type="password" placeholder="Confirm Password">
                                                            </div>
                                                         </div>
                                                         <div class="form-group">
                                                            @if(!isset($tempsignupsetting))
                                                            <button type="button" id="signup_button" class="e-com-6-right-button ecom-5-logo-inbtn ecom-mt-20" href="#">Sign Up </button>
                                                            @else
                                                            <button type="button" id="signup_button" class="e-com-6-right-button ecom-5-logo-inbtn ecom-mt-20" href="#" style="background-color:{{$tempsignupsetting->signup_btn_color}}; font-size:{{$tempsignupsetting->signup_btn_font_size}}px;">Sign Up </button>
                                                            @endif
                                                         </div>
                                                         <p class="e-com-6-crate-acount-p e_comm_food_link_bottom">Have an account?<a class="cor-1-crate-acount" href="#"> Log In</a></p>
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
                        <!-------------------------------------============================  Sign Up End ==========================----------------------------------------------->

                        <!-------------------------------------============================  Login  ==========================----------------------------------------------->
                        <div id="login" class="tabcontent">
                           <div class="tab-content-inner">
                              <div class="row">
                                 <div class="col-md-8 own-8-col">
                                    <div class="left-template-bx">
                                       <div class="card-body m-t-20">
                                          <form  method ="POST" action="{{route('theme.loginscreen')}}" enctype="multipart/form-data" name="login_form">
                                             @csrf
                                             <div class="form-group">
                                             @if(Auth::user()->parent_id == 0)  
								<input type="hidden" class="inputtemp form-control inputtemp" id="user_id" name="user_id" value="{{ Auth::user()->id}}">
								@else
								<input type="hidden" class="inputtemp form-control inputtemp" id="user_id" name="user_id" value="{{ Auth::user()->parent_id}}">     
								@endif
                                             </div>
                                             <div class="form-group">
                                                <input type="hidden" class="form-control" id="template_id" name="template_id" value="{{$themetemplate->id}}">
                                             </div>
                                             @if($temploginsetting == NULL)
                                             <div class="d-flex form-group formgrouplabel">
                                                <label class="lbh">Login Background Color </label>
                                                <input type="color" id="login_bg_color2" name="login_bg_color" onchange="loginbgshow(event)" value="#ffffff">                     
                                             </div>
                                             <div class="d-flex form-group">
                                                <label class="lbh">Login Button Color</label>
                                                <input type="color" id="login_bg_color1" name="login_btn_color" onchange="loginbtnshow()" value="#f58124">                     
                                             </div>
                                             @else
                                             <div class="d-flex form-group">
                                                <label class="lbh">Login Background Color</label>
                                                <input type="color" id="login_bg_color2" name="login_bg_color" onchange="loginbgshow(event)" value="{{$temploginsetting->login_bg_color}}">                     
                                             </div>
                                             <div class="d-flex form-group">
                                                <label class="lbh">Login Button Color</label>
                                                <input type="color" id="login_bg_color1" name="login_btn_color" onchange="loginbtnshow()" value="{{$temploginsetting->login_btn_color}}">                     
                                             </div>
                                             @endif
                                             <div class="d-flex form-group">
                                                <label class="lbh">Font Size</label>
                                                <select  id="login_dropdown" onchange="logindropshow()" type="text" name="login_btn_font_size" placeholder="select Font Size">
                                                   @if($temploginsetting == NULL)
                                                   <option value="20" >20px</option>
                                                   <option value="18">18px</option>
                                                   <option value="16" selected="selected">16px</option>
                                                   <option value="14" >14px</option>
                                                   <option value="12" >12px</option>
                                                </select>
                                                @elseif($temploginsetting->login_btn_font_size !== "16")
                                                <option value="20" {{$temploginsetting->login_btn_font_size == "20" ? "selected" : ""}} >20px</option>
                                                <option value="18" {{$temploginsetting->login_btn_font_size == "18" ? "selected" : ""}} >18px</option>
                                                <option value="16" {{$temploginsetting->login_btn_font_size == "16" ? "selected" : ""}}  >16px</option>
                                                <option value="14" {{$temploginsetting->login_btn_font_size == "14" ? "selected" : ""}} >14px</option>
                                                <option value="12" {{$temploginsetting->login_btn_font_size == "12" ? "selected" : ""}} >12px</option>
                                                </select>
                                                @else
                                                <option value="20" >20px</option>
                                                <option value="18" >18px</option>
                                                <option value="16" selected="selected">16px</option>
                                                <option value="14" >14px</option>
                                                <option value="12" >12px</option>
                                                </select>
                                                @endif
                                             </div>
                                             <div class=" form-group">
                                                <button class="savebtn" type="submit">Next</button>
                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                                 <!----====== Login Preview =====---->
                                 <div class="col-md-4 own-4-col ">
                                    <div class="preview-box">
                                       <h2 class="text-center preview-title "><img class="" src="{{asset('asset/images/eyeimage.png')}}" alt="eyeimage">Preview</h2>
                                       <div class="tutorial-video-box text-center">
                                          @if(!isset($temploginsetting))
                                           <div class="tutorial-video-box-inner" id="back_image">
                                          @elseif($temploginsetting->login_bg_color == NULL)
                                           <div class="tutorial-video-box-inner" id="back_image">
                                          @else
                                          <div class="tutorial-video-box-inner" id="back_image" style="background-color:{{$temploginsetting->login_bg_color}};">
                                          @endif
                                          
                                             <div class="preview-right-main-wrapper loginsign-ecom">
                                                <div class="splash-bgimage">
                                                   <div class="ecom-6-beauty-sign">
                                                      <h3 class="foodtitleh foodligintitleh">Login</h3>
                                                      <p class="foodtitlep">Add your details to login</p>
                                                      <div class="e-com-6-form-grp-container e-com-6-form-mr login-food">
                                                         <div class="form-group e-com-6-email-group">
                                                            <div class="e-com-6-group-icn-inp">
                                                               <input class="form-cantrol" type="email" placeholder="Email">
                                                            </div>
                                                         </div>
                                                         <div class="form-group e-com-6-password-group">
                                                            <div class="e-com-6-group-icn-inp">
                                                               <input class="form-cantrol" type="Password" placeholder="Enter Your Password">
                                                            </div>
                                                         </div>
                                                         <div class="form-group">
                                                            @if(!isset($temploginsetting))
                                                            <button type="button" id="login_button" class="e-com-6-right-button ecom-5-logo-inbtn ecom-mt-20" href="#">Sign in</button>
                                                            @else
                                                            <button type="button" id="login_button" class="e-com-6-right-button ecom-5-logo-inbtn ecom-mt-20" href="#" style="background-color:{{$temploginsetting->login_btn_color}}; font-size:{{$temploginsetting->login_btn_font_size}}px;">Sign in</button>
                                                            @endif
                                                         </div>
                                                         <p class="e-com-6-forgotpswrd"><a class="cor-1-crate-acount" href="#">Forgot your password?</a></p>
                                                         <p class="e-com-6-crate-acount-p ligin-crnt e_comm_food_link_bottom">Create a new account?<a class="cor-1-crate-acount" href="#"> Log In</a></p>
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
                        <!-------------------------------------============================  Login End  ==========================----------------------------------------------->

                        <!-------------------------------------============================  Home Screen ==========================----------------------------------------------->
                        <div id="home" class="tabcontent">
                           <div class="tab-content-inner">
                              <div class="row">
                                 <div class="col-md-8 own-8-col">
                                    <div class="left-template-bx">
                                       <div class=" m-t-20">
                                          <form role="form" data-toggle="validator" action="{{route('theme.food_category.store')}}" method="post" enctype="multipart/form-data">
                                             @csrf
                                             <div class="row">
                                                <div class="col-lg-12">
                                                   <div class="form-group">
                                                   @if(Auth::user()->parent_id == 0)  
								<input type="hidden" class="inputtemp form-control inputtemp" id="user_id" name="user_id" value="{{ Auth::user()->id}}">
								@else
								<input type="hidden" class="inputtemp form-control inputtemp" id="user_id" name="user_id" value="{{ Auth::user()->parent_id}}">     
								@endif
                                                   </div>
                                                   <div class="form-group">
                                                      <input type="hidden" class="form-control" id="template_id" name="template_id" value="{{$themetemplate->id}}">
                                                   </div>
                                                   <div class="form-group f-g-o">
                                                      <label class="labeltemp" for="usr">Select Category</label>
                                                      <select data-error="This field is required." name="parent_id" class="form-control inputtemp" value="{{ old('parent_id') }}">
                                                         <option value="0">Choose...</option>
                                                         @foreach($parents as $parent)
                                                         <option value="{{$parent->id}}">{{$parent->name}}</option>
                                                         @endforeach
                                                      </select>
                                                   </div>
                                                </div>
                                                <div class="col-lg-12">
                                                   <div class="form-group f-g-o">
                                                      <label class="labeltemp" for="usr">Name</label>
                                                      <input type="text" class="inputtemp form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" name="name" required value="{{ old('name') }}" data-error="This field is required.">
                                                      @if ($errors->has('name'))
                                                      <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $errors->first('name') }}</strong>
                                                      </span>
                                                      @endif
                                                      <div class="help-block with-errors"></div>
                                                   </div>
                                                </div>
                                                <div class="col-lg-12">
                                                   <div class="form-group f-g-o">
                                                      <label class="labeltemp" for="usr">Short Description</label>
                                                      <textarea class="form-control inputtemp" placeholder="Add Description" name="description"></textarea>
                                                   </div>
                                                </div>
                                                <div class="col-lg-12">
                                                   <div class="form-group f-g-o">
                                                      <label class="labeltemp" for="usr">Image</label>
                                                      <input type="file" name="image" id="imgInp file-7" class="inputfile inputfile-6 form-control" accept="image/*">
                                                   </div>
                                                </div>
                                                <div class="col-lg-6 col-xl-4 col-md-6">
                                                   <div class="form-group f-g-o fgo-food">
                                                      <label class="labeltemp" for="usr">Status</label>
                                                      <div class="d-flex">
                                                         <div class="w3-half">
                                                            <div class="custom-control custom-radio">
                                                               <input type="radio" id="customRadio5" name="status" class="custom-control-input" checked="" value="active">
                                                               <label class="custom-control-label" for="customRadio5">Active</label>
                                                            </div>
                                                         </div>
                                                         <div class="w3-half">
                                                            <div class="custom-control custom-radio">
                                                               <input type="radio" id="customRadio6" name="status" class="custom-control-input" value="inactive">
                                                               <label class="custom-control-label" for="customRadio6">Inactive</label>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="col-lg-12 col-xl-12 col-md-12 catgory-btn-save">
                                                   <div class="form-group">
                                                      <button type="submit" class="btn btn-primary">Add Collection</button>
                                                      @if(count($categories) > 0)
                                                      <button class="savebtn" id="add_prodcut1" onclick="openCity(event, 'add_prodcut')">Next</button>
                                                      @endif                        
                                                   </div>
                                                </div>
                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                                 <!----====== Home Screen Preview =====---->
                                 <div class="col-md-4 own-4-col">
                                    <div class="preview-box">
                                       <h2 class="text-center preview-title "><img class="" src="{{asset('asset/images/eyeimage.png')}}" alt="eyeimage">Preview</h2>
                                       <div class="tutorial-video-box text-center">
                                          <div class="tutorial-video-box-inner">
                                             <div class="ecom-6home-top-image">
                                                <img class="ecom-6-homelogo" src="{{asset('template/images/yummy_restaurants/yummy-logo.png')}}" alt="">
                                             </div>
                                             <div class="ecom-6home-top-searchbar">
                                                <div class="e-com-6-group-searchbar">
                                                   <img class="ecom-6-searchbaricon" src="{{asset('template/images/yummy_restaurants/srachbar-ecomfood.png')}}" alt="">
                                                   <input class="form-cantrol" type="text" placeholder="Search Food">
                                                </div>
                                             </div>
                                             <div class="ecom-6home-inner-catgory">
                                                <div class="left-home-shape-food">
                                                </div>
                                                @if(count($categories) == 0)
                                                <div class="ecom-6home-food-catgory">
                                                   <div class="ecom-6home-food-catgory-inner">
                                                      <img class="com-6-catimages-food" src="{{asset('template/images/yummy_restaurants/food-itm-one.png')}}" alt="">
                                                      <div class="food-ecom-6-catgorybox">
                                                         <h4>Moisturizing</h4>
                                                         <p>200 Items</p>
                                                      </div>
                                                      <div class="arrowright-food">
                                                         <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="ecom-6home-food-catgory">
                                                   <div class="ecom-6home-food-catgory-inner">
                                                      <img class="com-6-catimages-food" src="{{asset('template/images/yummy_restaurants/food-itm-2.png')}}" alt="">
                                                      <div class="food-ecom-6-catgorybox">
                                                         <h4>Beverages</h4>
                                                         <p>89 Items</p>
                                                      </div>
                                                      <div class="arrowright-food">
                                                         <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="ecom-6home-food-catgory">
                                                   <div class="ecom-6home-food-catgory-inner">
                                                      <img class="com-6-catimages-food" src="{{asset('template/images/yummy_restaurants/foodcakes.png')}}" alt="">
                                                      <div class="food-ecom-6-catgorybox">
                                                         <h4>Desserts</h4>
                                                         <p>321 Items</p>
                                                      </div>
                                                      <div class="arrowright-food">
                                                         <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="ecom-6home-food-catgory">
                                                   <div class="ecom-6home-food-catgory-inner">
                                                      <img class="com-6-catimages-food" src="{{asset('template/images/yummy_restaurants/drinkf.png')}}" alt="">
                                                      <div class="food-ecom-6-catgorybox">
                                                         <h4>Drinks</h4>
                                                         <p>68 Items</p>
                                                      </div>
                                                      <div class="arrowright-food">
                                                         <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                      </div>
                                                   </div>
                                                </div>
                                                @else
                                                @foreach($categories as $category)
                                                <div class="ecom-6home-food-catgory">
                                                   <div class="ecom-6home-food-catgory-inner">
                                                      @if(!isset($category->image))
                                                      <p class="w-50 text-right"><i class="fa fa-snowflake-o" aria-hidden="true"></i></p>
                                                      @else
                                                      <img class="com-6-catimages-food" src="{{$category->image}}" alt="">
                                                      @endif
                                                      <div class="food-ecom-6-catgorybox">
                                                         <h4>{{$category->name ?? ""}}</h4>
                                                         <?php  $count = App\Models\Template\Food_Delivery\FoodProduct::where('category_id',$category->id)->count(); ?>
                                                         @if($count > 1)                                                         
                                                         <p>{{$count}} Items</p>
                                                         @else
                                                         <p>{{$count}} Item</p>
                                                         @endif
                                                      </div>
                                                      <div class="arrowright-food">
                                                         <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                      </div>
                                                   </div>
                                                </div>
                                                @endforeach
                                                @endif
                                             </div>
                                             <div class="ecom-6home-footer">
                                                <img class="com-6-footerimage" src="{{asset('template/images/yummy_restaurants/footerfood.png')}}" alt="">
                                                <div class="row footerrow-food">
                                                   <div class="col-sm-4">
                                                      <div class="footer-food-ecom">
                                                         <img class="com-6-f-sc" src="{{asset('template/images/yummy_restaurants/shopping-cart.png')}}" alt="">
                                                         <p>Cart</p>
                                                      </div>
                                                   </div>
                                                   <div class="col-sm-4">
                                                      <div class="footer-food-ecom footer-food-homeicon">
                                                         <i class="fa fa-home" aria-hidden="true"></i>
                                                      </div>
                                                   </div>
                                                   <div class="col-sm-4">
                                                      <div class="footer-food-ecom footer-food-homeicon-right">
                                                         <img class="com-6-f-list" src="{{asset('template/images/yummy_restaurants/footermenu.png')}}" alt="">
                                                         <p>More</p>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
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
                                                <td>{{$loop->iteration}}</td>
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
                        <!-------------------------------------============================  My Account  ==========================----------------------------------------------->
                        <div id="rest_screens" class="tabcontent">
                           <div class="tab-content-inner">
                              <div class="row justify-content-center">
                                 <!--====== Add Collection =====-->  
                                 <!--======  home Screen Preview =====-->  
                                 <div class="col-md-4 own-4-col allscreensaslidercol-4">
                                    <div class="preview-box">
                                       <h3 class="app_screens_title">App Screens</h3>
                                       <div class="tutorial-video-box">
                                          <div class="app-preview cor-1-app-preview cor-1-group-container">
                                             <div id="theme-showcase-all" class="app-showcase-main owl-carousel">
                                                <div class="theme-slide-itm">
                                                   <img class="appfrm appscreenprewe " src="{{asset('template/images/yummy_restaurants/13.png')}}" alt="">
                                                </div>
                                                <div class="theme-slide-itm">
                                                   <img class="appfrm appscreenprewe " src="{{asset('template/images/yummy_restaurants/16.png')}}" alt="">
                                                </div>
                                                <div class="theme-slide-itm">
                                                   <img class="appfrm appscreenprewe" src="{{asset('template/images/yummy_restaurants/17.png')}}"  alt="">
                                                </div>
                                                <div class="theme-slide-itm">
                                                   <img class="appfrm appscreenprewe"  src="{{asset('template/images/yummy_restaurants/21.png')}}" alt="">
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
</main>
<!-- Modal -->
<div class="modal fade popup-template-modal" id="splash_screen" role="dialog">
   <div class="modal-dialog modal-dialog-centered">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <img class="modallogoimg" src="{{asset('images/theapp.png')}}" alt="eyeimage">
         </div>
         <div class="modal-body">
            <h1>First screen users see when they open your App. This screen appears for a couple seconds.</h1>
            <button class="btn-ok"  data-dismiss="modal">Ok</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade popup-template-modal" id="signup_screen" role="dialog">
   <div class="modal-dialog modal-dialog-centered">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <img class="modallogoimg" src="{{asset('images/theapp.png')}}" alt="eyeimage">
         </div>
         <div class="modal-body">
            <h1>Change the image, background color and font size</h1>
            <button class="btn-ok"  data-dismiss="modal">Ok</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade popup-template-modal" id="login_screen" role="dialog">
   <div class="modal-dialog modal-dialog-centered">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <img class="modallogoimg" src="{{asset('images/theapp.png')}}" alt="eyeimage">
         </div>
         <div class="modal-body">
            <h1>Change the image, background color and font size</h1>
            <button class="btn-ok" data-dismiss="modal">Ok</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade popup-template-modal" id="home_screen" role="dialog">
   <div class="modal-dialog modal-dialog-centered">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <img class="modallogoimg" src="{{asset('images/theapp.png')}}" alt="eyeimage">
         </div>
         <div class="modal-body">
            <h1>The first screen a users will view after logging in</h1>
            <button class="btn-ok" data-dismiss="modal">Ok</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade popup-template-modal" id="account_screen" role="dialog">
   <div class="modal-dialog modal-dialog-centered">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <img class="modallogoimg" src="{{asset('images/theapp.png')}}" alt="eyeimage">
         </div>
         <div class="modal-body">
            <h1>The screen will show a users other sections</h1>
            <button class="btn-ok" data-dismiss="modal">Ok</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade popup-template-modal" id="add_product_screen" role="dialog">
   <div class="modal-dialog modal-dialog-centered">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <img class="modallogoimg" src="{{asset('images/theapp.png')}}" alt="eyeimage">
         </div>
         <div class="modal-body">
            <h1>List your products with variants of color and size if required </h1>
            <button class="btn-ok" data-dismiss="modal">Ok</button>
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
<script>
   function openCity(evt, cityName) { 
   
      if(cityName == "splashscreen"){
   
         var screen1 = $.cookie("splashscreen");
    
         if(screen1 == undefined)
         {   
            $('body').find('#splash_screen').modal('show');
            $.cookie("splashscreen", 1);   
         }else(screen1 == 1)
         {
            $('body').find('#splash_screen').modal('hide');
         }
          
      }
      else if(cityName == "signup"){
   
         var screen2 =  $.cookie("signup");
         if(screen2 == undefined)
         {
            $('body').find('#signup_screen').modal('show');
            $.cookie("signup", 1);
   
         }else(screen2 == 1)
         {
   
            $('body').find('#signup_screen').modal('hide');
   
         }
   
      }
      else if(cityName == "login"){
   
         var screen3 =  $.cookie("login");
   
         if(screen3 == undefined)
         {
            $('body').find('#login_screen').modal('show');
            $.cookie("login", 1);
   
         }else(screen3 == 1)
         {
            $('body').find('#login_screen').modal('hide');
         }   
   
      }
   
      else if(cityName == "home"){
   
         var screen4 =  $.cookie("home");
   
         if(screen4 == undefined)
         {
   
         $('body').find('#home_screen').modal('show');
         $.cookie("home", 1);
   
         }else(screen4 == 1)
         {
   
            $('body').find('#home_screen').modal('hide');
   
         } 
   
      }
      else if(cityName == "add_prodcut"){
   
         var screen5 =  $.cookie("add_prodcut");
   
         if(screen5 == undefined)
         {
   
            $('body').find('#add_product_screen').modal('show');
            $.cookie("add_prodcut", 1);
   
         }else(screen5 == 1)
         {
   
            $('body').find('#add_product_screen').modal('hide');
   
         } 
   
      }
      else if(cityName == "my_account"){
   
         var screen6 =  $.cookie("my_account");
   
         if(screen6 == undefined)
         {
   
         $('body').find('#account_screen').modal('show');
   
         $.cookie("my_account", 1);
   
         }else(screen6 == 1)
         {
   
            $('body').find('#account_screen').modal('hide');
   
         } 
   
      }
     
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
         tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
         tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
      document.cookie = "cityName="+cityName+"1; expires=Thu, 18 Dec 2090 12:00:00 UTC; path=/";
   }
   
   document.addEventListener("DOMContentLoaded", function(event){
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
         tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
         tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      var selectedCity = getCookie("cityName");
      if(selectedCity){
         var result = selectedCity.match(/[^\d]+|\d+/g);
         if(result[0] != ""){
           document.getElementById(result[0]).style.display = "block";
           document.getElementById(selectedCity).className+= " active";
         } else {
            document.getElementById('splashscreen').style.display = "block";
            document.getElementById('splashscreen1').className+= " active"
         }
       } else {
            document.getElementById('splashscreen').style.display = "block";
            document.getElementById('splashscreen1').className+= " active"
      }
   });
      
   function getCookie(cname) {
          var name = cname + "=";
          var decodedCookie = decodeURIComponent(document.cookie);
          var ca = decodedCookie.split(';');
          for(var i = 0; i <ca.length; i++) {
              var c = ca[i];
              while (c.charAt(0) == ' ') {
                  c = c.substring(1);
              }
              if (c.indexOf(name) == 0) {
                  return c.substring(name.length, c.length);
              }
          }
          return "";
      }    
            
</script>
<script>
   var loadFile = function(event) {
     var reader = new FileReader();
     reader.onload = function(){
       var output = document.getElementById('output');
       output.src = reader.result;
     };
     reader.readAsDataURL(event.target.files[0]);
   };
</script>
@include('admin.template.Food_Delivery.partials.footer')
<!---------------------============================================Products scripts start here=============================================------------------------------->
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
   $("#product_name").keyup
     (function (e) {
         var value = this.value;
         $("#pro_name").html(value);
   
   });
   
   $("#short_description").keyup
     (function (e) {
         var value = this.value;
         $(".pro_short_desc").html(value);
   
   });
   
   $("#product_price").keyup
     (function (e) {
         var value = this.value;
         $("#pro_price").html(value);
   
   });
   
   $("#long_description").keyup
     (function (e) {
         var value = this.value;
         $(".pro_long_desc").html(value);
   
   });
   
   
   // Product Image
   
   $("#file-7").change(function (e) {
   
   url = URL.createObjectURL(e.target.files[0]),
   $(".product_image_screen").attr("src",url);
   console.log(url);
   
   });
   
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
<!---------------------============================================Products scripts end here=============================================------------------------------->
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
<script>
   $('#signup_status').on('click' , function(){
   
      $('#signup_status').val('0');
   
      if($('#signup_status').is(":checked")){
   
         $('#signup_status:checked').val('1');
   
      }else{
   
         $('#signup_status').val('0');
      }
   });
</script>
<script>
   /* --------------------------=========================  Splash Screen =======================----------------------- */
   
   // Splash BG Color
   
   function splshbgshow() {
   
   $('.splashbg').hide();
   var x = document.getElementById("splash_bg_color").value;
   document.getElementById("splash_screen_bg").style.backgroundColor = x;
   document.getElementById("inp2").value = "";
   
   }
   
   
   function splshbgimgshow() {  
   
   $('.splashbg').show();
   document.getElementById("splash_bg_color").value = "#ffffff";  
   }
   
   function splshbgshopimgshow() { 
   
   $('.e-com-3-splashbg').show();
   document.getElementById("splash_bg_color").value = "#ffffff";  
   
   }
   
   // Splash Logo
   
   $(".splash_logo").change(function (e) {
   
    $('#remove_logo_image').show();  
    url = URL.createObjectURL(e.target.files[0]),
    $(".preview").attr("src",url);
    console.log(url);
   
   });
   
   
   // Remove Splash Logo
   
   function removelogoimg() {
      document.getElementById("splash_logo").src = "{{asset('template/images/yummy_restaurants/yummy-logo.png')}}";
      $('#remove_logo_image').hide();
      $('#inp1').val('');
   }
   
   // Splash BG Image 
   
   $(".splash_bg_image").change(function (e) {
    $('#remove_splash_image').show();
    $('#splash_bg').show();
    url = URL.createObjectURL(e.target.files[0]),
    $("#splash_bg").attr("src",url);
    console.log(url);        
   });
   
   // Remove Splash BG Image 
   
   function removesplashimg() {
   document.getElementById("splash_bg").src = "{{asset('template/images/yummy_restaurants/splashbgyummy.png')}}";
   $('#remove_splash_image').hide();
   }  

   /* --------------------------=========================  Splash Screen End =======================----------------------- */
   
   /* --------------------------=========================  Login Screen =======================----------------------- */
   
   $("#inp3").change(function (e) {
   
   $('.loginsignbg').css("display", "block");
   $('#remove_login_image').show();
   url = URL.createObjectURL(e.target.files[0]),
   $("#login_image").attr("src",url);
   console.log(url); 
   
   });
   
   // Remove login Image 
   
   function removeloginimg() {
   document.getElementById("login_image").src = "{{asset('images/econ-1-top-bg.png')}}";
   $('#remove_login_image').hide();
   $('#inp3').val('');
   }
   
   function loginbgshow() {
   var x = document.getElementById("login_bg_color2").value;
   
   $('.loginsignbg').css("display", "none");
   
   document.getElementById("back_image").style.backgroundColor = x;
   document.getElementById("login_image1").style.backgroundColor = x;
   document.getElementById("login_image2").style.backgroundColor = x;
   }
   
   function loginbtnshow() {
   var x1 = document.getElementById("login_bg_color1").value;
   document.getElementById("login_button").style.backgroundColor = x1;
   }
   
   const logindropshow = () => {
   
   var x = document.getElementById("login_dropdown").value;
   if(x==='20'){
   document.getElementById("login_button").style.fontSize = '20px';}
   else if (x==='18'){
   document.getElementById("login_button").style.fontSize = '18px';}
   else if(x==='16'){
   document.getElementById("login_button").style.fontSize = '16px';}
   else if (x==='14'){
   document.getElementById("login_button").style.fontSize = '14px';}
   else if (x==='12'){
   document.getElementById("login_button").style.fontSize = '12px';}
   }
   
   
   
   /* --------------------------=========================  Login Screen End =======================----------------------- */
   
   
   /* --------------------------=========================  signup Screen =======================----------------------- */
   
   $(".signup_bg_img").change(function (e) {
   $('#remove_signup_image').show(); 
   url = URL.createObjectURL(e.target.files[0]),
   $("#signup_back").attr("src",url);
   console.log(url);
   });
   
   // Remove signup Image 
   
   function removesignupimg() {
   document.getElementById("signup_back").src = "{{asset('images/econ-1-top-bg.png')}}";
   $('#remove_signup_image').hide();
   $('#inp4').val('');
   }
   
   function signupbgshow() {
   var x = document.getElementById("signup_bg_color2").value;

      document.getElementById("signup_back_color").style.backgroundColor = x;
      document.getElementById("signup_back1").style.backgroundColor = x;
      document.getElementById("signup_back2").style.backgroundColor = x;

   }
   
   function signupbtnshow() {
   var x1 = document.getElementById("signup_bg_color1").value;
   document.getElementById("signup_button").style.backgroundColor = x1;
   }
   
   
   const signupdropshow = () => {
   
   var x = document.getElementById("signup_dropdown").value;
   if(x==='20'){
   document.getElementById("signup_button").style.fontSize = '20px';}
   else if (x==='18'){
   document.getElementById("signup_button").style.fontSize = '18px';}
   else if(x==='16'){
   document.getElementById("signup_button").style.fontSize = '16px';}
   else if (x==='14'){
   document.getElementById("signup_button").style.fontSize = '14px';}
   else if (x==='12'){
   document.getElementById("signup_button").style.fontSize = '12px';}
   }
   
   /* --------------------------=========================  signup Screen End =======================----------------------- */
   
</script>